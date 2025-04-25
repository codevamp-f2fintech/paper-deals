<?php
include_once('header.php');
include('../connection/config.php');

?>
<div class="content-wrapper">
    <section class="content mt-2">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <?php
                if (isset($_GET['prod_id'])) {
                    $product_id = $_GET['prod_id'];
                    $role_id = $_GET['role'];
                    $query = "select * from consultant_slots where id='$product_id'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                ?>
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="card-header">
                                <h4>
                                    Consultant Slot
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post">
                                        <div class="row">
                                            <input type="hidden" name="user_id" value="<?= $prodItem['id'] ?>">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>From Time</label>
                                                    <select name="slot_id" class="form-control" value="<?= $prodItem['slot_id']; ?>">
                                                        <?php $query = mysqli_query($conn, "select * from slot");
                                                        foreach ($query as $row) { ?>
                                                            <option value="<?= $row["id"]; ?>">
                                                                <?= $row["from_time"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>To Time</label>
                                                    <select name="slot_id" class="form-control" value="<?= $prodItem['slot_id'] ?>">
                                                        <?php $query = mysqli_query($conn, "select * from slot");
                                                        foreach ($query as $row) { ?>
                                                            <option value="<?= $row["id"]; ?>">
                                                                <?= $row["to_time"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Consultant Price</label>
                                                    <input type="text" value="<?= $prodItem['consultant_price'] ?>" name="consultant_price" id="ntitle" cols="30" rows="10" class="form-control" placeholder="Enter Consultant Price" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <div class="input-group date" id="datemask2" data-target-input="nearest">
                                                        <input type="text" name="created_on" value="<?= $prodItem['created_on'] ?>" class="form-control datetimepicker-input" data-target="#datemask2" placeholder="DD-MM-YY" />
                                                        <div class="input-group-append" data-target="#datemask2" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-4">-->
                                            <!--    <div class="form-group">-->
                                            <!--        <label>To Date</label>-->
                                            <!--        <div class="input-group date" id="datemask3" data-target-input="nearest">-->
                                            <!--            <input type="text" name="to_date" value="<?= $prodItem['to_date'] ?>" class="form-control datetimepicker-input" data-target="#datemask2" placeholder="DD-MM-YY" />-->
                                            <!--            <div class="input-group-append" data-target="#datemask3" data-toggle="datetimepicker">-->
                                            <!--                <div class="input-group-text"><i class="fa fa-calendar"></i></div>-->
                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="col-md-2 float-right">
                                                <div class="form-group">
                                                    <label class="text-white">Save</label>
                                                    <button type="submit" name="consultant_booking_slot_update" class="btn btn-primary btn-block">Update</button>
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