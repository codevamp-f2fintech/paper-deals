<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from news where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
    ?>
            <section class="content mt-4">
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="card-header">
                                <h4>
                                    Edit News
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                            
                                            
                                            
                                              <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Title</label>

                                                    <input name="title" value="<?= $prodItem['title']; ?>" id="ntitle" cols="30" rows="10" class="form-control" placeholder="Enter Title">
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Image</label>

                                            <input type="file" name="edit_image" id="edit_image"class="form-control">
                                            <a href="<?= $prodItem['image']; ?>">View Image</a>
                                            <input type="hidden" name="old_image" value="<?= $prodItem['image']; ?>" id="old_image"class="form-control">

                                        </div>
                                    </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <label>News Description</label>

                                                    <textarea type="text" name="data" cols="10" rows="5" class="form-control" required placeholder="News Description"><?= $prodItem['data']; ?></textarea>
                                                </div>
                                            </div>
                                          
                                        

                                            <div class="col-md-2 float-right">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button type="submit" name="news_update" class="btn btn-primary btn-block">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php
        } else {
            echo "No such products found.";
        }
    }
    ?>
</div>
</div>
<?php
include("footer.php");
?>