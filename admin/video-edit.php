<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from videos where id='$product_id'";
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
                                    Edit Video
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post">
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                           <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Video</label>

                                            <input type="text" name="video" class="form-control" value="<?= $prodItem['video'] ?>" placeholder="Enter Video URL">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Video Title</label>
                                            <input type="text" value="<?= $prodItem['video_title']?>" name="video_title" class="form-control" required placeholder="Video Title">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2 ">
                                        <div class="form-group mt-4">
                                            <button type="submit" name="update_video" class="btn btn-primary btn-block">Update</button>
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