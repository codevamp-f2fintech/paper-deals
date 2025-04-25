<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-2">
                        <h4 style="font-size:28px;color:#1C2434;margin:40px 0 15px 3px">
                            Edit Spot Price Enquiry
                        </h4>
                    </div>
                    <div class="card">
                        <?php include("message.php"); ?>

                        <div class="card-body">
                            <form action="code.php" method="post">
                                <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                                <input type="hidden" name="table_name" value="spot_price_enquiry"></input>
                                <?php
                                if (isset($_GET['prod_id'])) {
                                    $id = $_GET['prod_id'];
                                    $query = "SELECT * from spot_price_enquiry where id='$id'";
                                    $query_run = mysqli_query($conn, $query);
                                    $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input name="name" value="<?= $prodItem['name']; ?>" class="form-control" placeholder="Enter Paragraph" disabled></input>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone No.</label>
                                                <input type="phone" value="<?= $prodItem['phone']; ?>" name="phone" class="form-control" required placeholder="Enter Phone No." disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Email ID</label>

                                                <input type="email" value="<?= $prodItem['email_id']; ?>" name="email_id" class="form-control" required placeholder="Enter Email ID" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>Message</label>

                                                <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Enter Your Message" disabled><?= $prodItem['message']; ?></textarea>
                                            </div>
                                        </div>
                                        <?php if ($role == 1) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Status</label>
                                                    <select name='status' class="form-control">
                                                        <option value="0" <?php if ($prodItem['status'] == 0) {
                                                                                echo 'selected';
                                                                            } ?>>
                                                            Pending</option>
                                                        <option value="1" <?php if ($prodItem['status'] == 1) {
                                                                                echo 'selected';
                                                                            } ?>>
                                                            Completed</option>
                                                        <option value="2" <?php if ($prodItem['status'] == 2) {
                                                                                echo 'selected';
                                                                            } ?>>
                                                            Rejected</option>
                                                    </select>
                                                </div>
                                            </div><?php } ?>
                                        <?php if ($role == 1) { ?>
                                            <div class="col-md-2 float-right">
                                                <div class="form-group">
                                                    <label class="text-white">save</label>
                                                    <button type="submit" name="update_status" class="btn btn-primary btn-block">Update</button>
                                                </div><?php } ?>
                                            </div>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php
include("footer.php");
?>