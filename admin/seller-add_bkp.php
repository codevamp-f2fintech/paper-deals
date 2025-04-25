<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="col-md-12">
    <div class="content-wrapper" style="background-color:#fff;">
        <section class="content mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Seller-ADD
                    </h4>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">

                                <label>Name</label>

                                <input type="text" name="name" class="form-control" required placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email_address" name="email" class="form-control" required rows="3"
                                    placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required
                                    placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile (to be verified)</label>
                                <input type="phone" name="phone_no" class="form-control" required
                                    placeholder="Enter Mobile">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Join Date</label>
                                <div class="input-group date" id="datemask2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#datemask2" placeholder="DD-MM-YY" />
                                    <div class="input-group-append" data-target="#datemask2"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>WhatsApp No.</label>
                                <input type="phone" name="phone" class="form-control" required
                                    placeholder="WhatsApp No.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control">
                                    <option>--Select Status--</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" name="seller_add"
                                    class="btn btn-primary btn-block float-left">Save</button>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </section>
    </div>
</div>
<?php
include ("footer.php");
?>