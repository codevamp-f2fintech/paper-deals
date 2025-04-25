<?php
include_once('header.php');

if (isset($_POST['update_logo_save'])) {
    $product_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_id']));
    $logo_name = mysqli_real_escape_string($conn, $_POST['logo_name']);
    $doc_img = mysqli_real_escape_string($conn, $_FILES['logo_picture']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_image']));

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["logo_picture"]["tmp_name"];
        $folder = "uploads/profile/" . date('dmyHis') . '_' . $img_name;
        if (move_uploaded_file($tempname, $folder)) {
            $uploaded_doc = $folder;
        } else {
            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }
    $query = "update bottom_logo set logo_name='$logo_name',logo_picture='$uploaded_doc' where id='$product_id'";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = "Bottom Logo Updated Successfully!";
        header("Location: bottom_logo.php");
    } else {
        $_SESSION['error'] = "Bottom Logo Not Updated Due to Some Error!";
        header("Location: bottom_logo.php");
    }
}
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <style>
                #gmm>input {
                    border-radius: 4px;
                }

                #gmm>input::file-selector-button {
                    /* font-weight: bold; */
                    height: 35px;
                    color: #666666;
                    /* padding: 0.5em; */
                    border: thin solid grey;
                    border-radius: 3px;
                }
            </style>
            <div class="row">
                <?php
                if (isset($_GET['prod_id'])) {
                    $product_id = $_GET['prod_id'];
                    $query = "select * from bottom_logo where id='$product_id'";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                ?>
                        <div class="col-md-12">
                            <div class="card-header">
                                <a class="btn btn-danger float-right" href="bottom_logo.php">Back</a>
                                <h4>
                                    Edit ASSOCIATION PARTNER
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form  method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" id="gmm">
                                                    <label>Main Logo</label>
                                                    <input type="file" name="logo_picture" class="border" style="width:100%">
                                                    <br>
                                                    <input type="hidden" name="old_image" value="<?= $prodItem['logo_picture']; ?>">
                                                    <?php if (!empty($prodItem['logo_picture'])) { ?>
                                                        <a href="<?php echo $prodItem['logo_picture']; ?>" download>Download
                                                            Now</a> |
                                                        <a href="<?php echo $prodItem['logo_picture']; ?>" target="_blank">View
                                                            Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Bottom Logo Name</label>

                                                    <input name="logo_name" value="<?= $prodItem['logo_name']; ?>" cols="30" rows="7" class="form-control" placeholder="Logo Name">
                                                </div>
                                            </div>
                                            <div class="col-md-2 float-right">
                                                <div class="form-group mt-2">
                                                    <label></label>
                                                    <button type="submit" name="update_logo_save" class="btn btn-primary btn-block">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    } else {
                        echo "No such products found.";
                    }
                }
                ?>
            </div>
        </div>
    </section>
</div>
<?php
include("footer.php");
?>