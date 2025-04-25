<?php
include_once('header.php');
include ('../connection/config.php');
if (isset($_POST['main_logo_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['logo_delete_nac']); // Sanitize input (optional if using prepared statement)

    // Prepare delete query
    $delete_query = "DELETE FROM bottom_logo WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);

    if ($stmt === false) {
        $_SESSION['error'] = "MySQL prepare error: " . mysqli_error($conn);
        header("Location: bottom_logo.php");
        exit();
    }

    // Bind parameter and execute delete query
    mysqli_stmt_bind_param($stmt, "i", $cate_id);
    $execute_result = mysqli_stmt_execute($stmt);

    if ($execute_result === false) {
        $_SESSION['error'] = "Error deleting ASSOCIATION PARTNER : " . mysqli_error($conn);
    } else {
        $_SESSION['success'] = "ASSOCIATION PARTNER deleted successfully!";
    }

    mysqli_stmt_close($stmt);
    header("Location: bottom_logo.php");
}
if (isset($_POST['bottom_logo_save'])) {
    $type_of_seller = mysqli_real_escape_string($conn, $_POST['logo_name']);
    $target_dir = "uploads/profile/";
    $profile_picture = basename($_FILES["logo_picture"]["name"]);
    $folder = $target_dir . date('dmyHis') . '_' . $profile_picture;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($profile_picture, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["logo_picture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($profile_picture)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["logo_picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["logo_picture"]["tmp_name"], $folder)) {
         "The file " . htmlspecialchars(basename($_FILES["logo_picture"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $query = "insert into bottom_logo(logo_name,logo_picture) values('$type_of_seller','$folder')";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = "Logo Added Successfully!";
        header("Location: bottom_logo.php");
    } else {
        $_SESSION['error'] = "Logo Not Added Due to Some Error!";
        header("Location: bottom_logo.php");
    }
}
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">
                            Add ASSOCIATION PARTNER
                        </h4>
                    </div>
                    <div class="card">
                        <style>
                            #lmm>input {
                                border-radius: 4px;
                            }

                            #lmm>input::file-selector-button {
                                /* font-weight: bold; */
                                height: 35px;
                                color: #666666;
                                /* padding: 0.5em; */
                                border: thin solid grey;
                                border-radius: 3px;
                            }
                        </style>
                        <div class="card-body">
                            <form  method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="lmm">
                                            <label>Bottom Logo</label><br />
                                            <input type="file" name="logo_picture" class="border" style="width:100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Logo Name</label>

                                            <input name="logo_name" cols="30" rows="7" class="form-control" placeholder="Logo Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2 float-right">
                                        <div class="form-group mt-2">
                                            <label></label>
                                            <button type="submit" name="bottom_logo_save" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">
                            ASSOCIATION PARTNER
                         
                        </h4>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table " id="dataTable">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th>ID</th>
                                        <th>Main Logo</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from  bottom_logo ORDER BY id DESC";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $i = 1;
                                        foreach ($query_run as $prod_item) {
                                            // echo $row['name'];
                                    ?>
                                            <tr style="text-align:center;">

                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['logo_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <!-- <td style="text-align:center;">
                                                    <div class="hide">
                                                        <a href="edit_logo.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">Edit</a>
                                                        <hr>
                                                        <form action="code.php" method="post">
                                                            <input type="hidden" name="logo_delete_nac" value="<?= $prod_item['id']; ?>">
                                                            <button type="submit" name="main_logo_delete_btn" class="dropdown-item">Delete</button>
                                                        </form>
                                                        <?php if ($role == 1) { ?>
                                                    </div>
                                                    <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td> -->
                                                <!-- ================= -->
                                                <td style="text-align:center;   ">
                                                    <div class=" dropdown">
                                                        <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                            <li>
                                                                <a href="edit_bottom_logo.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">Edit</a>
                                                            </li>
                                                            <hr>
                                                            <li>
                                                                <form method="post">
                                                                    <input type="hidden" name="logo_delete_nac" value="<?= $prod_item['id']; ?>">
                                                                    <button type="submit" name="main_logo_delete_btn" class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                        </div>
                        </td>
                        <!-- ==================== -->
                        </tr>
                <?php
                                                            $i++;
                                                        }
                                                    }
                                                } else {
                ?>
                <tr>
                    <td class="colspan-8">No Record found</td>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<?php
include("footer.php");
?>