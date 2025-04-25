<?php
include_once('header.php');
include('../connection/config.php');
date_default_timezone_set('Asia/Kolkata');
if (isset($_POST['news_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['news_delete_id']); // Sanitize input (optional if using prepared statement)

    // Prepare delete query
    $delete_query = "DELETE FROM image WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);

    if ($stmt === false) {
        $_SESSION['error'] = "MySQL prepare error: " . mysqli_error($conn);
        header("Location: image.php");
        exit();
    }

    // Bind parameter and execute delete query
    mysqli_stmt_bind_param($stmt, "i", $cate_id);
    $execute_result = mysqli_stmt_execute($stmt);

    if ($execute_result === false) {
        $_SESSION['error'] = "Error deleting image details: " . mysqli_error($conn);
    } else {
        $_SESSION['success'] = "Image details deleted successfully!";
    }

    mysqli_stmt_close($stmt);
    header("Location: image.php");
}
if (isset($_POST['news_image'])) {
    $title = $_POST['title'];
    $created_at = date("Y-m-d H:i:s");

    // Insert record into 'image' table
    $insert_query = "INSERT INTO image (title, created_at) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt, "ss", $title, $created_at);

    if (mysqli_stmt_execute($stmt)) {
        $last_id = mysqli_insert_id($conn);

        // Handle multiple file uploads
        if (!empty(array_filter($_FILES['image']['name']))) {
            $file_names = $_FILES['image']['name'];
            $file_tmps = $_FILES['image']['tmp_name'];

            for ($i = 0; $i < count($file_names); $i++) {
                $file_name = $file_names[$i];
                $file_tmp = $file_tmps[$i];
                $upload_directory = "uploads/image_group/";

                // Generate unique filename to avoid overwriting
                $new_filename = uniqid() . '_' . $file_name;

                // Move uploaded file to destination directory
                if (move_uploaded_file($file_tmp, $upload_directory . $new_filename)) {
                    // Insert each image file into 'products_image' table with the same title ID
                    $insert_image_query = "INSERT INTO products_image (p_id, image, created_at) VALUES (?, ?, ?)";
                    $stmt_image = mysqli_prepare($conn, $insert_image_query);
                    mysqli_stmt_bind_param($stmt_image, "iss", $last_id, $new_filename, $created_at);

                    if (mysqli_stmt_execute($stmt_image)) {
                        // Image inserted successfully
                    } else {
                        echo "Error inserting image: " . mysqli_error($conn);
                        // Handle error if image insertion fails
                    }
                } else {
                    echo "Error uploading file: " . $file_name;
                    // Handle error if file upload fails
                }
            }
        }

        $_SESSION['success'] = "Images uploaded and data inserted successfully!";
        header("Location: image.php"); // Replace with your actual page name
       
    } else {
        $_SESSION['error'] = "Error inserting data: " . mysqli_error($conn);
        header("Location: image.php"); // Replace with your actual page name
     
    }

    mysqli_stmt_close($stmt);

}

// Fetch all images with their associated titles
$query = "SELECT  *
          FROM image 
          ORDER BY id DESC";
$query_run = mysqli_query($conn, $query);
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="c">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:1% 0 1% 0.6%;">
                            Add Image
                        </h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" id="ntitle" class="form-control" placeholder="Enter Event Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Images</label>
                                            <input type="file" name="image[]" id="images" class="form-control" accept="image/*" multiple required>
                                        </div>
                                    </div>
                                    <div class="col-md-2 float-right">
                                        <div class="form-group mt-2">
                                            <label></label>
                                            <button type="submit" name="news_image" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="c">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                            Images
                        </h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $i = 1;
                                        while ($prod_item = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $prod_item['title']; ?></td>
                                                
                                                <td><?php echo $prod_item['created_at']; ?></td>
                                                <td><a href="edit_image.php?p_id=<?php echo $prod_item['id']; ?>" class="btn btn-success btn-sm">Edit</a></td>
                                                <td>
                                                    <form  method="post">
                                                        <input type="hidden" name="news_delete_id" value="<?php echo $prod_item['id']; ?>">
                                                        <button type="submit" name="news_delete_btn" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="6">No records found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include("footer.php");
?>
