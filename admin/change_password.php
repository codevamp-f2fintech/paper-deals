<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">

                        <div class="card-header">
                            <h4>
                                Change Password
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post">
                                <input type="hidden" name="user_id" value="<?= $_REQUEST["prod_id"]; ?>">
                                <input type="hidden" name="role" value="<?= $_REQUEST["role"]; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>New Password</label>

                                            <input type="password" name="new_password" cols="30" rows="10"
                                                class="form-control" placeholder="New Password">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Confirm Password</label>

                                            <input type="password" name="confirm_password" class="form-control"
                                                placeholder="Confirm Password">
                                        </div>
                                    </div>

                                    <div class="col-md-4 float-right">
                                        <div class="form-group">
                                            <label></label>
                                            <button type="submit" name="update_password" class="btn btn-primary">Update
                                                Password</button>
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
include ("footer.php");
?>