<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<!--Date Picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Organization Information
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post">

                                <div class="row">


                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>Organization</label>

                                            <input type="text" name="organizations" class="form-control" required
                                                placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" name="contact_person" class="form-control" required
                                                placeholder="Contact Persons">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email (to be verified)</label>
                                            <input type="email" name="email" class="form-control" required rows="3"
                                                placeholder="Enter Email">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile (to be verified)</label>
                                            <input type="phone" name="phone"
                                                onKeyPress="if(this.value.length==10) return false;"
                                                class="form-control" required placeholder="Enter Mobile">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" required
                                                placeholder="Enter Address">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control" required
                                                placeholder="Enter City">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>District</label>
                                            <input type="text" name="district" class="form-control" required
                                                placeholder="Enter District">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>

                                            <select name="state" class="form-control">
                                                <option>--Select--</option>
                                                <option>Andhra Pradesh</option>
                                                <option>Arunachal Pradesh</option>
                                                <option>Assam</option>
                                                <option>Bihar</option>
                                                <option>Chhattisgarh</option>
                                                <option>Goa</option>
                                                <option>Gujarat</option>
                                                <option>Haryana</option>
                                                <option>Himachal Pradesh</option>
                                                <option>Jammu and Kashmir</option>
                                                <option>Jharkhand</option>
                                                <option>Karnataka</option>
                                                <option>Kerala</option>
                                                <option>Madhya Pradesh</option>
                                                <option>Maharashtra</option>
                                                <option>Manipur</option>
                                                <option>Meghalaya</option>
                                                <option>Mizoram</option>
                                                <option>Nagaland</option>
                                                <option>Odisha</option>
                                                <option>Punjab</option>
                                                <option>Rajasthan</option>
                                                <option>Sikkim</option>
                                                <option>Tamil Nadu</option>
                                                <option>Telangana</option>
                                                <option>Tripura</option>
                                                <option>Uttarakhand</option>
                                                <option>Uttar Pradesh</option>
                                                <option>West Bengal</option>
                                                <option>Andaman and Nicobar Islands</option>
                                                <option>Chandigarh</option>
                                                <option>Dadra and Nagar Haveli</option>
                                                <option>Daman and Diu</option>
                                                <option>Delhi</option>
                                                <option>Lakshadweep</option>
                                                <option>Puducherry</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <input type="text" name="pincode" class="form-control" required
                                                placeholder="Pincode">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Production Capacity</label>
                                            <input type="text" name="production_capacity" class="form-control"
                                                placeholder="Production Capacity">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Production Specification</label>
                                            <input type="text" name="production_specification" class="form-control"
                                                placeholder="Production Capacity">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Type of Organization</label>
                                            <input type="text" name="organization_type" class="form-control"
                                                placeholder="Type of Organization">
                                        </div>
                                    </div>



                                    <div class="col-md-4 float-right">
                                        <div class="form-group">

                                            <button type="submit" name="organzn_inform_save"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Personal Information
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label>Name</label>

                                            <input type="text" name="per_name" class="form-control" required
                                                placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Father's Name</label>
                                            <input type="text" name="fname" class="form-control" required
                                                placeholder="Enter Father's Name">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>DOB</label>
                                            <div class="input-group date" id="datemask4" data-target-input="nearest">
                                                <input type="text" value="<?= $prodItem["dob"]; ?>"
                                                    class="form-control datetimepicker-input" data-target="#datemask4"
                                                    placeholder="DD-MM-YY" />
                                                <div class="input-group-append" data-target="#datemask4"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Designation</label>
                                            <input type="text" name="designation" class="form-control"
                                                placeholder="Enter Designation" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="per_address" class="form-control" required
                                                placeholder="Enter Address">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Voter ID NO.</label>

                                            <input type="text" name="voter_id" class="form-control" required
                                                placeholder="Enter Voter ID NO.">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Adhhar Card No.</label>

                                            <input type="text" name="addhar_id" class="form-control" required
                                                placeholder="Enter Adhhar Card No.">
                                        </div>
                                    </div>


                                    <div class="col-md-4 float-right">
                                        <div class="form-group">

                                            <button type="submit" name="per_inform_save"
                                                class="btn btn-primary btn-block float-right">Save</button>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Documents Upload
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">

                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>GST Number</label>

                                            <input type="text" name="gst_number" class="form-control" required
                                                placeholder="Enter GST Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>PAN Card</label>
                                            <input type="file" name="pan_card_img" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>VOTER ID</label>
                                            <input type="file" name="voter_id_img" class="form-control" rows="3">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                CERTIFICATE OF INCORPORATION</label>
                                            <input type="file" name="cert_of_incorp" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>GST CERTIFICATE</label>
                                            <input type="file" name="gst_cert" class="form-control">
                                        </div>
                                    </div>



                                    <div class="col-md-4 float-right">
                                        <div class="form-group">

                                            <button type="submit" name="doc_upload_save"
                                                class="btn btn-primary btn-block float-right">Save</button>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Logo & Subscription
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Description Type</label>

                                            <select name="desc_type" class="form-control">
                                                <option>--Select--</option>
                                                <option>Lorem</option>
                                                <option>Subscription</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Logo</label>
                                            <input type="file" name="logo" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-4 float-right">
                                        <div class="form-group">

                                            <button type="submit" name="logo_save"
                                                class="btn btn-primary btn-block float-right">Save</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
    });
</script>
<?php
include ("footer.php");
?>