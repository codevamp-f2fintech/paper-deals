<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $user_id = $_GET['prod_id'];
                            $query = "SELECT users.*,organization.* from users
                        left join organization on users.id=organization.user_id
                        where users.id=$user_id";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>

                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Buyer- Edit

                                        </h4>
                                    </div>
                                    <div class="card-body">


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Name</label>

                                                    <input type="text" name="name" value="<?= $prodItem['name'] ?>"
                                                        class="form-control" required placeholder="Enter Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email_address" value="<?= $prodItem["email_address"]; ?>"
                                                        name="email" class="form-control" required rows="3"
                                                        placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" value="<?= $prodItem["password"]; ?>" name="password"
                                                        class="form-control" required placeholder="Enter Password">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mobile (to be verified)</label>
                                                    <input type="phone" value="<?= $prodItem["phone_no"]; ?>" name="phone_no"
                                                        class="form-control" required placeholder="Enter Mobile">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Join Date</label>
                                                    <div class="input-group date" id="datemask5" data-target-input="nearest">
                                                        <input type="text" value="<?= $prodItem["created_on"]; ?>"
                                                            class="form-control datetimepicker-input" data-target="#datemask5"
                                                            placeholder="DD-MM-YY" />
                                                        <div class="input-group-append" data-target="#datemask5"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>WhatsApp No.</label>
                                                    <input type="phone" value="<?= $prodItem["phone_no"]; ?>" name="phone_no"
                                                        class="form-control" required placeholder="WhatsApp No.">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control">
                                                        <option><?php if ($prodItem["status"] == 1) {
                                                            echo "Active";
                                                        } elseif ($prodItem["status"] == 2) {
                                                            echo "Inactive";
                                                        } else {
                                                            echo "Pending";
                                                        } ?></option>
                                                        <option>--Select Status--</option>
                                                        <option>Active</option>
                                                        <option>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

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
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $product_id = $_GET['prod_id'];
                            $query = "select * from organization where user_id='$product_id'";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <?php include ("message.php"); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Organization Information
                                        </h4>
                                    </div>
                                    <div class="card-body">


                                        <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>organization</label>

                                                    <input type="text" name="organizations"
                                                        value="<?= $prodItem["organizations"] ?>" class="form-control" required
                                                        placeholder="Enter Organization">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person</label>
                                                    <input type="text" name="contact_person" class="form-control"
                                                        value="<?= $prodItem["contact_person"] ?>" required
                                                        placeholder="Contact Persons">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email (to be verified)</label>
                                                    <input type="email" value="<?= $prodItem["email"]; ?>" name="email"
                                                        class="form-control" required rows="3" placeholder="Enter Email">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mobile (to be verified)</label>
                                                    <input type="phone" value="<?= $prodItem["phone"]; ?>" name="phone"
                                                        class="form-control" required placeholder="Enter Mobile">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" value="<?= $prodItem["address"]; ?>" name="address"
                                                        class="form-control" required placeholder="Enter Address">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" value="<?= $prodItem["city"]; ?>" name="city"
                                                        class="form-control" required placeholder="Enter City">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>District</label>
                                                    <input type="text" value="<?= $prodItem["district"]; ?>" name="district"
                                                        class="form-control" required placeholder="Enter District">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>State</label>

                                                    <select name="state" class="form-control"
                                                        value="<?= $prodItem["state"]; ?>">
                                                        <option>
                                                            <?= $prodItem["state"]; ?>
                                                        </option>
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
                                                    <input type="text" value="<?= $prodItem["pincode"]; ?>" name="pincode"
                                                        class="form-control" required placeholder="Pincode">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Production Capacity</label>
                                                    <input type="text" value="<?= $prodItem["production_capacity"]; ?>"
                                                        name="production_capacity" class="form-control"
                                                        placeholder="Production Capacity">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Production Specification</label>
                                                    <input type="text" value="<?= $prodItem["production_specification"]; ?>"
                                                        name="production_specification" class="form-control"
                                                        placeholder="Production Capacity">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Type of Organization</label>
                                                    <input type="text" value="<?= $prodItem["organization_type"]; ?>"
                                                        name="organization_type" class="form-control"
                                                        placeholder="Type of Organization">
                                                </div>
                                            </div>
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

                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $product_id = $_GET['prod_id'];
                            $query = "select * from personal where user_id='$product_id'";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <?php include ("message.php"); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Personal Information
                                        </h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <label>Name</label>

                                                    <input type="text" name="per_name" value="<?= $prodItem['per_name'] ?>"
                                                        class="form-control" required placeholder="Enter Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Father's Name</label>
                                                    <input type="text" name="fname" value="<?= $prodItem["fname"]; ?>"
                                                        class="form-control" required placeholder="Enter Father's Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>DOB</label>
                                                    <div class="input-group date" id="datemask3" data-target-input="nearest">
                                                        <input type="text" value="<?= $prodItem["dob"]; ?>"
                                                            class="form-control datetimepicker-input" data-target="#datemask3"
                                                            placeholder="DD-MM-YY" />
                                                        <div class="input-group-append" data-target="#datemask3"
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
                                                    <input type="text" name="designation"
                                                        value="<?= $prodItem["designation"]; ?>" class="form-control"
                                                        placeholder="Enter Designation" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="per_address"
                                                        value="<?= $prodItem["per_address"]; ?>" class="form-control" required
                                                        placeholder="Enter Address">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Voter ID NO.</label>

                                                    <input type="text" name="voter_id" value="<?= $prodItem["voter_id"]; ?>"
                                                        class="form-control" required placeholder="Enter Voter ID NO.">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Adhhar Card No.</label>

                                                    <input type="text" name="addhar_id" value="<?= $prodItem["addhar_id"]; ?>"
                                                        class="form-control" required placeholder="Enter Adhhar Card No.">
                                                </div>
                                            </div>
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
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $product_id = $_GET['prod_id'];
                            $query = "select * from document where user_id='$product_id'";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <?php include ("message.php"); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Documents Upload
                                        </h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">


                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>GST Number</label>

                                                    <input type="text" name="gst_number" class="form-control"
                                                        value="<?= $prodItem["gst_number"]; ?>" required
                                                        placeholder="Enter GST Number">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>PAN Card</label>
                                                    <input type="file" name="pan_card_img" class="form-control">
                                                    <input type="hidden" name="old_image"
                                                        value="<?= $prodItem['pan_card_img']; ?>">
                                                    <?php if (!empty($prodItem['pan_card_img'])) { ?>
                                                        <img src="<?= $prodItem['pan_card_img'] ?>" width="60px" height="60px">
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>VOTER ID</label>
                                                    <input type="file" name="voter_id_img" class="form-control" rows="3">
                                                    <input type="hidden" name="old_image"
                                                        value="<?= $prodItem['voter_id_img']; ?>">
                                                    <?php if (!empty($prodItem['voter_id_img'])) { ?>
                                                        <img src="<?= $prodItem['voter_id_img'] ?>" width="60px" height="60px">
                                                    <?php } ?>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        CERTIFICATE OF INCORPORATION</label>
                                                    <input type="file" name="cert_of_incorp" class="form-control">
                                                    <input type="hidden" name="old_image"
                                                        value="<?= $prodItem['cert_of_incorp']; ?>">
                                                    <?php if (!empty($prodItem['cert_of_incorp'])) { ?>
                                                        <img src="<?= $prodItem['cert_of_incorp'] ?>" width="60px" height="60px">
                                                    <?php } ?>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>GST CERTIFICATE</label>
                                                    <input type="file" name="gst_cert" class="form-control">
                                                    <input type="hidden" name="old_image" value="<?= $prodItem['gst_cert']; ?>">
                                                    <?php if (!empty($prodItem['gst_cert'])) { ?>
                                                        <img src="<?= $prodItem['gst_cert'] ?>" width="60px" height="60px">
                                                    <?php } ?>

                                                </div>
                                            </div>





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
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $product_id = $_GET['prod_id'];
                            $query = "select * from logosub where user_id='$product_id'";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <?php include ("message.php"); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            Logo & Subscription
                                        </h4>
                                    </div>
                                    <div class="card-body">


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Description Type</label>

                                                    <select name="desc_type" class="form-control">
                                                        <option><?= $prodItem["desc_type"]; ?></option>
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
                                                    <input type="hidden" name="old_image" value="<?= $prodItem['logo']; ?>">
                                                    <?php if (!empty($prodItem['logo'])) { ?>
                                                        <img src="<?= $prodItem['logo'] ?>" width="60px" height="60px" alt="logo">
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="col-md-4 float-right">
                                                <div class="form-group">

                                                    <button type="submit" name="seller_save"
                                                        class="btn btn-primary btn-block float-right">Update</button>
                                                </div>
                                            </div>


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
            </form>
        </div>
</div>
</section>
</div>
<?php
include ("footer.php");
?>