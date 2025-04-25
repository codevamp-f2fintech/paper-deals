<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <?php
                if (isset($_GET['prod_id'])) {
                    $product_id = $_GET['prod_id'];
                    $role_id = $_GET['role'];
                    $query = "select * from magazine where id='$product_id'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                ?>
                        <div class="col-md-12">
                            <div class="mt-4">
                                <h4 style="font-size:25px;color:#1C2434;margin:40px 0 20px 3px">
                                    Update Magazine
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" name="user_id" value="<?= $product_id; ?>">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Magazine Name</label>
                                                    <input type="text" name="name" value="<?= $prodItem['name']; ?>" class="form-control" placeholder="Magazine Name">
                                                </div>
                                            </div>
                                            <style>
                                                #fmm>input {
                                                    border-radius: 4px;
                                                }

                                                #fmm>input::file-selector-button {
                                                    /* font-weight: bold; */
                                                    height: 35px;
                                                    color: #666666;
                                                    /* padding: 0.5em; */
                                                    border: thin solid grey;
                                                    border-radius: 3px;
                                                }
                                            </style>

                                            <div class="col-md-4">
                                                <div class="form-group" id="fmm">
                                                    <label>Upload Document</label>
                                                    <input type="file" name="import_pdf" class="border" style="width:100%">
                                                    <input type="hidden" name="old_documen" value="<?php echo isset($prodItem['import_pdf']) ? $prodItem['import_pdf'] : ''; ?>">
                                                    <?php if (!empty($prodItem['import_pdf'])) { ?>

                                                        <a href="download_magazine.php?prod_id=<?php echo $product_id; ?>">Download
                                                            Now</a> | <a href="<?= $prodItem['import_pdf']; ?>" target="_blank">View
                                                            Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="text-white">Save</label>
                                                    <button type="submit" name="magazine_update" class="btn btn-primary btn-block float-right">Update Magazine</button>
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