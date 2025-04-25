<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from contact_us where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
    ?>
            <section class="content mt-2">
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 15px 3px">
                                    View Contact Us Details
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="id" value="<?= $prodItem['id'] ?>"></input>
                                        <input type="hidden" name="table_name" value="contact_us"></input>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" value="<?= $prodItem['name']; ?>" name="name" class="form-control" required placeholder="Name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email Id</label>
                                                    <input type="text" value="<?= $prodItem['email_id']; ?>" name="email_id" class="form-control" required placeholder="Email Id" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Mobile Number</label>
                                                    <input type="text" value="<?= $prodItem['mobile_no']; ?>" name="mobile_no" class="form-control" required placeholder="Mobile Number" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Message</label>
                                                    <textarea name="para" cols="30" rows="7" class="form-control" placeholder="Message" disabled><?= $prodItem["message"]; ?></textarea>
                                                </div>
                                            </div>

                                            <?php if ($role == 1) { ?><div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Status</label>
                                                        <select name='status' class="form-control">
                                                            <option value="0" <?php if ($prodItem['status'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>Pending</option>
                                                            <option value="1" <?php if ($prodItem['status'] == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>Completed</option>
                                                            <option value="2" <?php if ($prodItem['status'] == 2) {
                                                                                    echo 'selected';
                                                                                } ?>>Rejected</option>
                                                        </select>
                                                    </div>
                                                </div><?php } ?>

                                            <?php if ($role == 1) { ?><div class="col-md-2">
                                                    <div class="form-group" style="margin-top: 7px;">
                                                        <label></label>
                                                        <button type="submit" name="update_status" class="btn btn-primary btn-block">Update</button>
                                                    </div><?php } ?>
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