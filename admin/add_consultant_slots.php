<?php
include_once('header.php');
include('../connection/config.php');

?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:25px;color:#1C2434;margin:40px 0 20px 3px">
                            Add Consultant Slot
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>From Time</label>
                                            <input type="text" name="from_time" cols="10" rows="5" class="form-control" required placeholder="Enter From Time">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>To Time</label>
                                            <input name="to_time" cols="30" rows="10" class="form-control" placeholder="Enter To Time">
                                        </div>
                                    </div>

                                    <div class="col-md-2 float-right">
                                        <div class="form-group">
                                            <label class="text-white">save</label>
                                            <button type="submit" name="add_consultant_booking_slot_save" class="btn btn-primary btn-block">Save</button>
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
</div>
<?php
include("footer.php");
?>