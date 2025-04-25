<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from testimonials where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
    ?>
            <section class="content mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        Edit Testimonial
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="post" enctype='multipart/form-data'>
                                        <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Writer</label>

                                                    <input type="text" value="<?= $prodItem['writer']; ?>" name="writer" class="form-control" required placeholder="Writer">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Image</label>

                                            <input type="file" name="profile" class="form-control" placeholder="Image">
                                            <a href="<?= $prodItem['profile']; ?>" target="_blank">View Profile</a>
                                            <input type="hidden" name="old_profile" class="form-control" value="<?= $prodItem['profile']; ?>">

                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Company</label>

                                            <input type="text" name="company" class="form-control" required placeholder="Company" value="<?= $prodItem['company']; ?>">
                                        </div>
                                    </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Post</label>

                                                    <input type="text" value="<?= $prodItem['post']; ?>" name="post" class="form-control" required placeholder="Post">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <label>Paragraph</label>

                                                    <textarea name="para" id="tpara" cols="30" rows="7" class="form-control" placeholder="Enter Paragraph"><?= $prodItem["para"]; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 float-right">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button type="submit" name="testimonial_update" class="btn btn-primary btn-block">Update</button>
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
<?php
include("footer.php");
?>