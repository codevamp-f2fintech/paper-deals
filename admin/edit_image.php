<?php
include_once('header.php');
include('../connection/config.php');

// Check if form for editing product image is submitted
if (isset($_POST['edit_product_image'])) {
    $product_image_id = $_POST['product_image_id'];
    $p_id = $_POST['p_id'];

    // Check if a new image file is uploaded
    if (!empty($_FILES['new_image']['name'])) {
        $file_name = $_FILES['new_image']['name'];
        $file_tmp = $_FILES['new_image']['tmp_name'];
        $upload_directory = "uploads/image_group/";

        // Move uploaded file to destination directory
        if (move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
            // Update query to replace the old image with the new one
            $update_query = "UPDATE products_image SET image = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $update_query);

            if ($stmt === false) {
                $_SESSION['error'] = "MySQL prepare error: " . mysqli_error($conn);
            } else {
                // Bind parameters and execute update
                mysqli_stmt_bind_param($stmt, "si", $file_name, $product_image_id);
                $execute_result = mysqli_stmt_execute($stmt);

                if ($execute_result === false) {
                    $_SESSION['error'] = "Error updating product image: " . mysqli_error($conn);
                } else {
                    $_SESSION['success'] = "Product image updated successfully!";
                }

                mysqli_stmt_close($stmt);
            }
        } else {
            $_SESSION['error'] = "Error uploading file.";
        }
    } else {
        $_SESSION['error'] = "No new image selected.";
    }
}

// Function to delete an image from 'products_image' table
if (isset($_POST['delete_image'])) {
    $image_id = $_POST['delete_image_id'];

    $delete_query = "DELETE FROM products_image WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $image_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Image deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting image: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

// Function to update title in 'image' table
if (isset($_POST['edit_title'])) {
    $title_id = $_POST['title_id'];
    $new_title = $_POST['new_title'];

    $update_query = "UPDATE image SET title = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);

    if ($stmt === false) {
        $_SESSION['error'] = "MySQL prepare error: " . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "si", $new_title, $title_id);
        $execute_result = mysqli_stmt_execute($stmt);

        if ($execute_result === false) {
            $_SESSION['error'] = "Error updating title: " . mysqli_error($conn);
        } else {
            $_SESSION['success'] = "Title updated successfully!";
        }

        mysqli_stmt_close($stmt);
    }
}

 if (isset($_GET['p_id'])) {
$product_id = $_GET['p_id'];
$select_query = "
    SELECT pi.id AS product_image_id, pi.p_id, pi.image AS product_image, i.id AS title_id, i.title AS image_title
    FROM products_image pi
    LEFT JOIN image i ON pi.p_id = i.id
    WHERE pi.p_id = $product_id
    ORDER BY pi.id DESC";
// $select_query = "
//     SELECT pi.id AS product_image_id, pi.p_id, pi.image AS product_image, i.id AS title_id, i.title AS image_title
//     FROM products_image pi
//     LEFT JOIN image i ON pi.p_id = i.id
//     ORDER BY pi.id DESC";
$query_run = mysqli_query($conn, $select_query);
}
?>

<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width: 98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="c">
                        <h4 style="font-weight: 500; font-size: 28px; color: #1C2434; margin: 1% 0 1% 0.6%;">
                            Edit Images
                        </h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Image</th>
                                        <th>Image Title</th>
                                        <th>Edit Title</th>
                                        <th>Delete Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                            <tr>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="product_image_id" value="<?php echo $row['product_image_id']; ?>">
                                                    <input type="hidden" name="p_id" value="<?php echo $row['p_id']; ?>">
                                                    <td><?php echo $row['product_image_id']; ?></td>
                                                    <td><img src="<?php echo $row['product_image']; ?>" width="100" height="100" /></td>
                                                    <td><?php echo $row['image_title']; ?></td>
                                                    <td>
                                                        <input type="text" class="form-control" name="new_title" value="<?php echo $row['image_title']; ?>" placeholder="New Title">
                                                        <input type="hidden" name="title_id" value="<?php echo $row['title_id']; ?>">
                                                        <br>
                                                        <button type="submit" name="edit_title" class="btn btn-primary btn-sm">Update Title</button>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="delete_image_id" value="<?php echo $row['product_image_id']; ?>">
                                                        <button type="submit" name="delete_image" class="btn btn-danger btn-sm">Delete Image</button>
                                                    </td>
                                                    <td>
                                                        <input type="file" name="new_image" accept="image/*">
                                                        <button type="submit" name="edit_product_image" class="btn btn-primary btn-sm">Update Image</button>
                                                    </td>
                                                </form>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No product images found.</td>
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
