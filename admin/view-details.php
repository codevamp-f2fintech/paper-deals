<?php
session_start();
include_once('header.php');
if ($role != '1') {
    $class = 'disabled';
} else {
    $class = '';
}
$pin = $_GET['user_type'];
?>

<style>
    .error-message {
        display: none;
        color: red;
        font-size: 14px;
        margin-top: 5px;
      }
  
</style>
<div class="content-wrapper">
    <section class="content mt-2">
        <div class="mx-auto" style="width:98%">
            <form action="code.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="hidden" name="user_id" value="<?= $_REQUEST['prod_id']; ?>">
                <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $user_id = $_GET['prod_id'];
                            $query = "SELECT users.*,organization.* from users
                left join organization on users.id=organization.user_id
                where users.id=$user_id";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);


                        ?>
                            <div class=" mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    <?= IsUser_Role($_REQUEST['role']) ?> - Edit
                                </h4>
                            </div>
                            <?php include("message.php"); ?>
                            <div class="card">


                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name <span>*</span> :</label>
                                                <input type="text" name="name" value="<?php echo isset($prodItem['name']) ? $prodItem['name'] : ''; ?>" class="form-control" required placeholder="Enter Name" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email <span>*</span> : </label>
                                                <input type="email" value="<?php echo isset($prodItem['email_address']) ? $prodItem['email_address'] : ''; ?>" name="email_address" class="form-control" required rows="3" placeholder="Enter Email" >
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" value="<?php echo isset($prodItem['password']) ? $prodItem['password'] : ''; ?>" name="password"
                                        class="form-control" placeholder="Enter Password">
                                </div>
                            </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile (to be verified) <span>*</span> :</label>
                                                <input type="phone" id="phone" value="<?php echo isset($prodItem['phone_no']) ? $prodItem['phone_no'] : ''; ?>" name="phone_no" class="form-control" required placeholder="Enter Mobile" maxlength="10" title="Please enter 10 digits Mobile No." pattern="\d{10}" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Join Date</label>
                                                <div class="input-group date" id="datemask2" data-target-input="nearest">
                                                    <input type="text" value="<?php echo isset($prodItem['created_on']) ? date('d-m-y', strtotime($prodItem['created_on'])) : ''; ?>" name="created_on" class="form-control datetimepicker-input" data-target="#datemask2" placeholder="DD-MM-YY"  />
                                                    <div class="input-group-append" data-target="#datemask2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>WhatsApp No.</label>
                                                <input type="whatsapp_no" id="whatsapp" value="<?php echo isset($prodItem['whatsapp_no']) ? $prodItem['whatsapp_no'] : ''; ?>" name="whatsapp_no" class="form-control" placeholder="WhatsApp No." maxlength="10" title="Please enter 10 digits WhatsApp No." pattern="\d{10}" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control"  name="approved" <?php if($_SESSION['role']==1) { echo ""; } else{ echo "disabled";
                                                 } ?>>
                                                    <option value="">--Select Status--</option>
                                                    <option value="0" <?php if (isset($prodItem["approved"]) && $prodItem["approved"] == '0') {
                                                                            echo 'Selected';
                                                                        } ?>>Pending
                                                    </option>
                                                    <option value="1" <?php if (isset($prodItem["approved"]) && $prodItem["approved"] == '1') {
                                                                            echo 'Selected';
                                                                        } ?>>Approved
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $product_id = $_GET['prod_id'];
                            $query = "select * from organization where user_id='$product_id'";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                        ?> <div class=" mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    Company Information
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">

                                    <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Company</label>

                                                <input type="text" name="organizations" value="<?php echo isset($prodItem['organizations']) ? $prodItem['organizations'] : ''; ?>" class="form-control"  placeholder="Enter Company" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Contact Person  <span>*</span> :</label>
                                                <input type="text" name="contact_person" class="form-control" value="<?php echo isset($prodItem['contact_person']) ? $prodItem['contact_person'] : ''; ?>" required placeholder="Contact Persons" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email (to be verified)</label>
                                                <input type="email" value="<?php echo isset($prodItem['email']) ? $prodItem['email'] : ''; ?>" name="organization_email" class="form-control" rows="3" placeholder="Enter Email" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile (to be verified) <span>*</span> : </label>
                                                <input type="phone" value="<?php echo isset($prodItem['phone']) ? $prodItem['phone'] : ''; ?>" name="organization_phone" id="orgNumber" class="form-control" placeholder="Enter Mobile" required maxlength="10" title="Please enter 10 digits Mobile No." pattern="\d{10}" >
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address <span>*</span> : </label>
                                                <input type="text" value="<?php echo isset($prodItem['address']) ? $prodItem['address'] : ''; ?>" name="address" class="form-control" required placeholder="Enter Address" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City <span>*</span> : </label>
                                                <input type="text" value="<?php echo isset($prodItem['city']) ? $prodItem['city'] : ''; ?>" name="city" class="form-control" required placeholder="Enter City" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>District</label>
                                                <input type="text" value="<?php echo isset($prodItem['district']) ? $prodItem['district'] : ''; ?>" name="district" class="form-control" required placeholder="Enter District" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State <span>*</span> : </label>
                                                <select name="state" class="form-control" required>
                                                    <option value="">--Select--</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "Select * From state_list");
                                                    while ($data = mysqli_fetch_array($query)) { ?>
                                                        <option value="<?= $data['state_id'] ?>" <?php if (isset($prodItem["state"]) && $prodItem["state"] == $data['state_id']) {
                                                                                                        echo 'Selected';
                                                                                                    } ?>>
                                                            <?= $data['state_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pincode <span>*</span> : </label>
                                                <input type="text" value="<?php echo isset($prodItem['pincode']) ? $prodItem['pincode'] : ''; ?>" name="pincode" class="form-control" required placeholder="Pincode" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                          
                                    <?php if($_GET['user_type']==2 || $_GET['role']==2){ ?>
                                        <label>Production Capacity (TPM)</label>
                                    <?php } else if($_GET['user_type']==3 || $_GET['role']==3){ ?>

                                        <label>Consumption capacity (TPM)</label>
                                    <?php } ?>
                                                <input type="text" value="<?php echo isset($prodItem['production_capacity']) ? $prodItem['production_capacity'] : ''; ?>" name="production_capacity" class="form-control" placeholder="Production Capacity" >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Deals In</label>
                                                <input type="text" value="<?php echo isset($prodItem['materials_used']) ? $prodItem['materials_used'] : ''; ?>" name="materials_used" class="form-control" placeholder="Materials Used" >
                                            </div>
                                        </div>

                                     

                                      
                                    

                                         <div class="col-md-4">
                                            <div class="form-group">

                

                                                <?php if($_GET['user_type']==2 || $_GET['role']==2) { ?>
                                                                                    <label>Type of Seller<span>*</span> : </label>
                                                <select required name="organization_type" class="form-control" >
                                                  

                                                    <option disabled selected hidden value="">--Select Type of Seller--</option>
                                                    <option value="0" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '0') {
                                                                            echo 'Selected';
                                                                        } ?>>Importer
                                                    </option>
                                                    <option value="1" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '1') {
                                                                            echo 'Selected';
                                                                        } ?>>Wholeseller</option>
                                                    <option value="2" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '2') {
                                                                            echo 'Selected';
                                                                        } ?>>Manufacturer</option>
                                                                          <option value="3" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '3') {
                                                                            echo 'Selected';
                                                                        } ?>>Distributor</option>
                                                                          <option value="4" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '4') {
                                                                            echo 'Selected';
                                                                        } ?>>Other</option>
                                                                         
                                                </select>
                                                <?php } else if($_GET['user_type']==3  || $_GET['role']==3){ ?>
                                                <label>Type of Buyer<span>*</span> : </label>
                                               <select required name="organization_type" class="form-control" >
                                                                                                     

                                                    <option disabled selected hidden value="">--Select Type of Buyer--</option>
                                                    <option value="5" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '5') {
                                                                            echo 'Selected';
                                                                        } ?>>Printing offset
                                                    </option>
                                                    <option value="6" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '6') {
                                                                            echo 'Selected';
                                                                        } ?>>Corrugated Box Convrter</option>
                                                    <option value="7" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '7') {
                                                                            echo 'Selected';
                                                                        } ?>>Tissue Converter</option>
                                                                          <option value="8" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '8') {
                                                                            echo 'Selected';
                                                                        } ?>>Retailer</option>
                                                                          <option value="9" <?php if (isset($prodItem["organization_type"]) && $prodItem["organization_type"] == '9') {
                                                                            echo 'Selected';
                                                                        } ?>>Other</option>
                                                                         
                                                </select>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                          <?php  
                                        $Verified="SELECT * FROM `subscription` WHERE user_id='$user_id' and type='Verified'";
                                        
                                        $Verifiedresult=mysqli_query($conn, $Verified);
                                          $Verifieddata=mysqli_fetch_assoc($Verifiedresult);
                                        
                                        ?>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Verified</label>
                                                
                                                 <input type="text" readonly value="<?php if ($Verifieddata["status"] == '1') {
                                                                            echo 'Verified';
                                                                        }else{ echo 'Not Verified'; } ?>" style="width:100%;height:37px; border:1px solid #dbdbdb;border-radius:4px;outline:none; padding:0 5px;">
                                            </div>
                                        </div>

                                        <?php  
                                        $subs="SELECT * FROM `subscription` WHERE user_id='$user_id' and type='Vip'";
                                        
                                        $subs_result=mysqli_query($conn, $subs);
                                          $data=mysqli_fetch_assoc($subs_result);
                                          //print_r($data);
                                        ?>
                                        <div class="col-md-4">
                                            <div class="form-group">


                                                <label>VIP</label><br />
                                                <input type="text" readonly value="<?php if ($data["status"] == '1') {
                                                                            echo 'Vip';
                                                                        }else{ echo 'Not Vip'; } ?>" style="width:100%;height:37px; border:1px solid #dbdbdb;border-radius:4px;outline:none; padding:0 5px;">
                                                <!-- <select readonly  id="slt" name="vip" >
                                                  <option  disabled>--Select Status--</option>
                                                    <option   >Not VIP
                                                    </option>
                                                    <option  >VIP</option>
                                                </select> -->
                                            </div>
                                        </div>
                                       
                                        <style>
                                            #fmm>input {
                                                border-radius: 4px;
                                            }

                                            #fmm>input::file-selector-button {
                                                /* font-weight: bold; */
                                                height: 35px;
                                                color: #666666;
                                                /* padding: 0.5em; */
                                                border: thin solid grey;
                                                border-radius: 3px;
                                            }
                                        </style>
                                        <div class="col-md-4">
                                            <div class="form-group" id="fmm">
                                                <label>Logo/Image (335*190)</label>
                                                <input type="file" class="border " style="width:100%;"  name="image_banner">
                                                <input type="hidden" name="old_image_banner" value="<?php echo isset($prodItem['image_banner']) ? $prodItem['image_banner'] : ''; ?>">
                                                <?php if (!empty($prodItem['image_banner'])) { ?>
                                                    <a href="download_organization.php?prod_id=<?php echo  $user_id; ?>">Download
                                                        Now</a> | <a href="<?= $prodItem['image_banner']; ?>" target="_blank">View Document</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                              
                                           <textarea name="description" rows="5" class="form-control" placeholder="Description" ><?php echo isset($prodItem['description']) ? $prodItem['description'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                 
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $product_id = $_GET['prod_id'];
                            $query = "select * from personal where user_id='$product_id'";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                        ?> <div class=" mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    Personal Information (Owner)
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Name <span>*</span> : </label>

                                                <input type="text" name="per_name" value="<?php echo isset($prodItem['per_name']) ? $prodItem['per_name'] : ''; ?>" class="form-control" required placeholder="Enter Name" >
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Father's Name</label>
                                                <input type="text" name="father_name" value="<?php //echo isset($prodItem['fname']) ? $prodItem['fname'] : ''; ?>" class="form-control" placeholder="Enter Father's Name" >
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>DOB</label>
                                                <div class="input-group date" id="datemask3" data-target-input="nearest">
                                                    <input type="text" name="dob" value="<?php //echo isset($prodItem['dob']) ? $prodItem['dob'] : ''; ?>" class="form-control datetimepicker-input" data-target="#datemask3" placeholder="DD-MM-YY"  />
                                                    <div class="input-group-append" data-target="#datemask3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Designation <span>*</span> : </label>
                                                <input type="text" name="designation" value="<?php echo isset($prodItem['designation']) ? $prodItem['designation'] : ''; ?>" class="form-control" required placeholder="Enter Designation">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address <span>*</span> : </label>
                                                <input type="text" name="per_address" value="<?php echo isset($prodItem['per_address']) ? $prodItem['per_address'] : ''; ?>" class="form-control" required placeholder="Enter Address" >
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4">
                                            <div class="form-group" class="fmm">

                                                <label>Pan Card</label>

                                                <input type="text" name="pan_card" value="<?php //echo isset($prodItem['pan_card']) ? $prodItem['pan_card'] : ''; ?>" class="form-control" placeholder="Enter Pan Card" id="panInput" maxlength="10">
                                                 <div class="error-message" id="panError">
      Please enter a valid PAN card number (e.g., ABCDE1234F).
    </div>
                                            </div>
                                        </div> -->


                                        <!-- <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Adhhar Card No.</label>

                                                <input type="text" name="addhar_id" value="<?php //echo isset($prodItem['addhar_id']) ? $prodItem['addhar_id'] : ''; ?>" class="form-control" placeholder="Enter Adhhar Card No." id="aadharInput" maxlength="14">
                                                 
  <div class="error-message" id="aadharError">Please enter a valid Aadhar card number (12 digits e.g. 8947 8397 2978)</div>
                                            </div>
                                        </div> -->
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['prod_id'])) {
                            $product_id = $_GET['prod_id'];
                            $query = "select * from document where user_id='$product_id'";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                        ?> <div class=" mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    Documents Upload
                                </h4>
                            </div>
                            <div class="card">
                                <style>
                                    #gmm>input {
                                        border-radius: 4px;
                                    }

                                    #gmm>input::file-selector-button {
                                        /* font-weight: bold; */
                                        height: 35px;
                                        color: #666666;
                                        /* padding: 0.5em; */
                                        border: thin solid grey;
                                        border-radius: 3px;
                                    }
                                </style>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>GST Number <span>*</span> : </label>

                                                <input type="text" name="gst_number" class="form-control" value="<?php echo isset($prodItem['gst_number']) ? $prodItem['gst_number'] : ''; ?>" required placeholder="Enter GST Number"  id="gstInput" maxlength="15">
                                                  <div class="error-message" id="gstError">Please enter a valid GST number (e.g. 29ABCDE1234F1Z5 or 07AAECC1234D1ZW).</div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="gmm">
                                                <label>PAN Card ( .png,.jpeg,.jpg  Only)</label><br />
                                                <input type="file" name="pan_card_img" style="width:100%;" class="border" maxlength="10">
                                                <input type="hidden" name="old_pan_card_img" value="<?php echo isset($prodItem['pan_card_img']) ? $prodItem['pan_card_img'] : ''; ?>">
                                                <?php if (!empty($prodItem['pan_card_img'])) { ?>

                                                    <a href="download_du.php?prod_id=<?php echo  $user_id; ?>">Download
                                                        Now</a> | <a href="<?= $prodItem['pan_card_img']; ?>" target="_blank">View Document</a>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group" id="gmm">
                                                <label>ISO Certificate ( .pdf Only)</label>
                                                <input type="file" name="voter_id_img" style="width:100%;" class="border" rows="3" >
                                                <input type="hidden" name="old_voter_id_img" value="<?php echo isset($prodItem['voter_id_img']) ? $prodItem['voter_id_img'] : ''; ?>">
                                                <?php if (!empty($prodItem['voter_id_img'])) { ?>

                                                    <a href="download_du2.php?prod_id=<?php echo  $user_id; ?>">Download
                                                        Now</a> | <a href="<?= $prodItem['voter_id_img']; ?>" target="_blank">View Document</a>
                                                <?php } ?>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group" id="gmm">
                                                <label>
                                                    CERTIFICATE OF INCORPORATION ( .pdf Only)
                                                    </label><br />
                                                <input type="file" name="cert_of_incorp" style="width:100%;" class="border " >
                                                <input type="hidden" name="old_cert_of_incorp" value="<?php echo isset($prodItem['cert_of_incorp']) ? $prodItem['cert_of_incorp'] : ''; ?>">
                                                <?php if (!empty($prodItem['cert_of_incorp'])) { ?>

                                                    <a href="download_du3.php?prod_id=<?php echo  $user_id; ?>">Download
                                                        Now</a> | <a href="<?= $prodItem['cert_of_incorp']; ?>" target="_blank">View Document</a>
                                                <?php } ?>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group" id="gmm">
                                                <label>GST CERTIFICATE ( .pdf Only)</label><br />
                                                <input type="file" name="gst_cert" style="width:100%;" class="border">
                                                <input type="hidden" name="old_gst_cert" value="<?php echo isset($prodItem['gst_cert']) ? $prodItem['gst_cert'] : ''; ?>">
                                                <?php if (!empty($prodItem['gst_cert'])) { ?>

                                                    <a href="download_du4.php?prod_id=<?php echo  $user_id; ?>">Download
                                                        Now</a> | <a href="<?= $prodItem['gst_cert']; ?>" target="_blank">View
                                                        Document</a>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    
                     <?php if ($role == 1 || $role == 2 || $role == 3) { ?>
                                            <div class="col-md-3 my-4">
                                                <br>
                                                <div class="form-group">
                                                    <button type="submit" name="update_user_organization" class="btn btn-primary btn-block float-right">Update</button>
                                                </div>
                                            </div>
                                        <?php } ?>
                </div>
            </form>
        </div>
</div>
</section>
</div>
<script>


    // JavaScript code for GST number validation
    function validateGSTNumber(input) {
      // GSTIN format: 29ABCDE1234F1Z5
  var gstRegex = /^\d{2}[A-Z]{5}\d{4}[A-Z]\d[A-Z]{1}[\dA-Z]$/;
      return gstRegex.test(input);
    }

    document.getElementById("gstInput").addEventListener("input", function () {
      var gstInput = this.value.trim().toUpperCase();
      this.value = gstInput;

      var isValidGST = validateGSTNumber(gstInput);
      var errorMessage = document.getElementById("gstError");

      if (isValidGST) {
        this.style.borderColor = "green";
        errorMessage.style.display = "none";
      } else {
        this.style.borderColor = "red";
        errorMessage.style.display = "block";
      }
    });

     function validateAadharNumber(input) {
      // Aadhar number format: 12 digits
      var aadharRegex = /^\d{12}$/;
      return aadharRegex.test(input);
    }

    document.getElementById("aadharInput").addEventListener("input", function () {
      // Remove any non-numeric characters using regular expression
      var formattedValue = this.value.replace(/\D/g, ''); // Remove non-numeric characters
      formattedValue = formattedValue.replace(/(.{4})/g, '$1 ').trim(); // Insert space after every 4 characters
      
      this.value = formattedValue; // Update input value to formatted version

      var isValidAadhar = validateAadharNumber(formattedValue.replace(/\s/g, '')); // Remove spaces for validation
      var errorMessage = document.getElementById("aadharError");

      if (isValidAadhar) {
        // Valid Aadhar number
        this.style.borderColor = "green";
        errorMessage.style.display = "none";
      } else {
        // Invalid Aadhar number
        this.style.borderColor = "red";
        errorMessage.style.display = "block";
      }
    });

         function validatePanNumber(input) {
      // PAN format: 5 uppercase letters + 4 digits + 1 uppercase letter
      var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
      return panRegex.test(input);
    }

    document.getElementById("panInput").addEventListener("input", function () {
      var panInput = this.value.trim().toUpperCase(); // Convert input to uppercase
      this.value = panInput; // Update input value to uppercase version

      var errorMessage = document.getElementById("panError");
      var isValidPan = false;

      // Check conditions for showing error
      if (panInput.length === 0) {
        // No input entered yet
        this.style.borderColor = "#ccc";
        errorMessage.style.display = "none";
      } else if (panInput.length < 10) {
        // Less than 10 characters entered
        this.style.borderColor = "red";
        errorMessage.style.display = "block";
        errorMessage.textContent = "Please enter at least 10 characters.";
      } else if (/^\d+$/.test(panInput) || /^[A-Z]+$/.test(panInput)) {
        // Only digits or only letters entered
        this.style.borderColor = "red";
        errorMessage.style.display = "block";
        errorMessage.textContent = "Please enter a valid PAN card number (e.g., ABCDE1234F).";
      } else {
        // Check PAN format
        isValidPan = validatePanNumber(panInput);
        if (isValidPan) {
          // Valid PAN number
          this.style.borderColor = "green";
          errorMessage.style.display = "none";
        } else {
          // Invalid PAN number
          this.style.borderColor = "red";
          errorMessage.style.display = "block";
          errorMessage.textContent = "Please enter a valid PAN card number (e.g., ABCDE1234F).";
        }
      }
    });


    function validateForm() {
        var phoneInput = document.getElementById("phone").value;
        var whatsappInput = document.getElementById("whatsapp").value;
        var orgNumberInput = document.getElementById("orgNumber").value;
        var phonePattern = /^\d{10}$/; // Regular expression for 10-digit phone number

        if (!phonePattern.test(phoneInput)) {
            alert("Please enter a valid 10-digit phone number.");
            return false; // Prevent form submission
        }

        // if (!phonePattern.test(whatsappInput)) {
        //     alert("Please enter a valid 10-digit WhatsApp number.");
        //     return false; // Prevent form submission
        // }

        if (!phonePattern.test(orgNumberInput)) {
            alert("Please enter a valid 10-digit organization number.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>