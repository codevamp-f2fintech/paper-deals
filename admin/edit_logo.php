<?php
include_once('header.php');
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
                    $query = "select * from site_logo where id='$product_id'";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                ?>
                        <div class="col-md-12">
                            <div class="card-header">
                                <a class="btn btn-danger float-right" href="site_logo.php">Back</a>
                                <h4>
                                    Edit Main Logo
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" id="gmm">
                                                    <label>Main Logo</label>
                                                    <input type="file" name="logo_picture" class="border" style="width:100%">
                                                    <br>
                                                    <input type="hidden" name="old_image" value="<?= $prodItem['logo_picture']; ?>">
                                                    <?php if (!empty($prodItem['logo_picture'])) { ?>
                                                        <a href="download_logo2.php?prod_id=<?php echo $product_id; ?>">Download
                                                            Now</a> |
                                                        <a href="<?php echo $prodItem['logo_picture']; ?>" target="_blank">View
                                                            Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Logo Name</label>

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