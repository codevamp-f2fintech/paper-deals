<?php
include_once('header.php');
include('../connection/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_number = $_POST["mobile_no"];

    // Remove all characters except digits
    $phone_number = preg_replace('/[^0-9]/', '', $phone_number);

    // Check if the phone number is exactly 10 digits
    if (strlen($phone_number) === 10) {
        echo "Phone number is valid: " . $phone_number;
    } else {
        echo "Please enter a valid 10-digit phone number.";
    }
}
$deal_status = IsDeal_PD_Status($_GET['prod_id']);

if ($role != '1') {
    $class = 'disabled';
} else {
    $class = '';
}

?>
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

    .toggle-icon {
        font-size: 27px;
        font-weight: 900;
        color: black;
        cursor: pointer;
        margin-left: 12px;
        padding: 12px 30px;

    }

    .divheading {
        border-radius: 4px;
        background: white;
        padding-left: 12px;


    }

    .big-button {
        background: #666666;
        border-radius: 50px;
        display: flex;
        margin: 2% auto;
        width: fit-content;
    }

    .WhyChooseUs__chooseBuyerBtn--V_l0B,
    .WhyChooseUs__chooseSupplierBtn--uf8lm {
        align-items: center;
        border-radius: 1000px;
        box-shadow: 0 4px 6px -2px rgba(16, 24, 40, 0.03),
            0 12px 16px -4px rgba(16, 24, 40, 0.08);
        color: #fff;
        cursor: pointer;
        display: flex;
        flex-shrink: 0;
        font-size: 16px;
        font-weight: 600;
        height: 47px;
        justify-content: center;
        line-height: 30px;
        transition: background-image 0.3s ease;
        width: 124px;
    }

    .WhyChooseUs__active--YOzBf {
        background-image: linear-gradient(259deg, #006efa, #07cdbe 84.05%);
    }
</style>
<div class="content-wrapper">
    <section class="content mt-2">
        <div class="mx-auto" style="width:98%">
            <div class="row">


                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="divheading">
                        <form action="code.php" method="post" onsubmit="return validateForm()">
                            <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                            <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                            <div class=" mt-4">
                                <h4 style="font-size:25px;color:#1C2434;" id="toggleSamplingSection">
                                    PD Deal Details <span class="toggle-icon">+</span>
                                </h4>
                            </div>
                            <div class="card">
                                <?php
                                if (isset($_GET['prod_id'])) {
                                    $id = $_GET['prod_id'];
                                    $role = $_GET['role'];
                                    $return_url = "edit-pd-deal.php?role=$role&prod_id=$id";
                                    if ($role == "master") {
                                        $query = "SELECT * from pd_deals_master where id=$id";
                                    } else {
                                        $query = "SELECT * from pd_deals where id=$id";
                                    }
                                    $query_run = mysqli_query($conn, $query);
                                    $prodItem = mysqli_fetch_array($query_run);
                                ?>

                                    <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                    <div id="samplingContent" style="display: none;">

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Deal Id</label>
                                                        <input type="hidden" name="deal_id" class="form-control" value="<?= $prodItem["deal_id"]; ?>">

                                                        <input style="width:450px;" type="text" name="deal_id_bkp" class="form-control" value="000<?php if ($role == "master") {
                                                                                                                                                        echo $prodItem["id"];
                                                                                                                                                    } else {
                                                                                                                                                        echo $prodItem["deal_id"];
                                                                                                                                                    } ?>" required placeholder="Enter PD Deal Id" readonly>

                                                    </div>
                                                </div>
                                                <?php if ($_SESSION['role'] == 3 || $_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">

                                                            <label>Buyer</label>


                                                            <?php
                                                            $query2 = mysqli_query($conn, "SELECT users.*, organization.organizations, organization.contact_person,organization.phone
                                                FROM users 
                                                LEFT JOIN organization ON users.id = organization.user_id 
                                                WHERE users.user_type = 3 
                                                AND users.active_status = 1 
                                                ORDER BY users.id");
                                                            $data2 = mysqli_fetch_assoc($query2);
                                                            ?>
                                                            <input type="hidden" name="buyer_id" value="<?= $data2['id']; ?>" />
                                                            <input type="text" readonly name="buyer_bkp" class="form-control" required placeholder="Buyer" value="<?php echo $data2['organizations']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Contact Person</label>

                                                            <input type="text" readonly name="buyer_bkp" class="form-control" required placeholder="Contact Person" value="<?php echo $data2['contact_person']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Mobile No.</label>

                                                            <input type="text" readonly name="buyer_bkp" class="form-control" required placeholder="Mobile No." value="<?php echo $data2['phone']; ?>">

                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>PD Executive</label>
                                                        <input type="hidden" name="user_id" value="<?= $prodItem['user_id']; ?>" />
                                                        <?php
                                                        $Id = $prodItem['user_id'];
                                                        $query = mysqli_query($conn, "Select * from users where user_type=1 and active_status=1 AND id=$Id");
                                                        $data1 = mysqli_fetch_assoc($query);
                                                        ?>


                                                        <input type="text" readonly name="user_id_bkp" class="form-control" required placeholder="PD Executive" value="<?php echo $data1['name']; ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" name="contact_person" class="form-control" required placeholder="Contact Person" value="<?= $data1['contact_person'] ?>" readonly>
                                        </div>
                                    </div> -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Mobile Number:</label>
                                                        <input type="phone" name="mobile_no" onKeyPress="if(this.value.length==10) return false;" class="form-control" required placeholder="Mobile Number" value="<?= $data1['phone_no'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" required placeholder="Email" value="<?= $data1['email_address'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Seller</label>
                                                            <?php
                                                            $s_id = $prodItem['seller_id'];
                                                            $query3 = mysqli_query($conn, "SELECT users.*, organization.organizations, organization.contact_person,organization.phone
                                                FROM users 
                                                LEFT JOIN organization ON users.id = organization.user_id 
                                                WHERE users.user_type = 2 
                                                AND users.active_status = 1 
                                                AND users.id=$s_id
                                                ORDER BY users.id");

                                                            $data3 = mysqli_fetch_assoc($query3);

                                                            ?>
                                                            <input type="hidden" name="seller_id" value="<?= $data3['id'] ?>" />

                                                            <input type="text" readonly class="form-control" required placeholder="Seller" value="<?php echo $data3['organizations']; ?>">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Contact Person</label>
                                                            <input type="text" readonly class="form-control" required placeholder="Contact Person" value="<?php echo $data3['name']; ?>">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Mobile No.</label>
                                                            <input type="text" readonly class="form-control" required placeholder="Mobile No." value="<?php echo $data3['phone_no']; ?>">

                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($_SESSION['role'] == 1) { ?>
                                                    <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" value="<? //$prodItem["contact_person"]; 
                                                                            ?>" name="contact_person" class="form-control" required placeholder="Contact Person" <? //$class; 
                                                                                                                                                                    ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile Number:</label>
                                                <input type="phone" name="mobile_no" onKeyPress="if(this.value.length==10) return false;" value="<? //$prodItem["mobile_no"]; 
                                                                                                                                                    ?>" class="form-control" id="phone" required placeholder="Mobile Number" <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" value="<? //$prodItem["email_id"]; 
                                                                            ?>" name="email" class="form-control" required placeholder="Email" <? //$class; 
                                                                                                                                                ?>>
                                            </div>
                                        </div> -->
                                                <?php } ?>
                                                <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea name="product_desc" rows="1" class="form-control" placeholder="Product Description" required <? //$class; 
                                                                                                                                                        ?>><? //$prodItem["product_description"]; 
                                                                                                                                                            ?></textarea>
                                            </div>
                                        </div> -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Deal Size (in ton )</label>
                                                        <input type="text" readonly value="<?= $prodItem["deal_size"]; ?>" name="deal_size" class="form-control" required placeholder="Deal Size" <?= $class; ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><?php if ($role == "master") { ?>Total Deal Amount <?php } else { ?>Deal Amount <?php } ?></label>
                                                        <input readonly type="text" value="<?php if ($role == "master") {
                                                                                                echo $prodItem["total_deal_amount"];
                                                                                            } else {
                                                                                                echo $prodItem["deal_amount"];
                                                                                            } ?>" name="deal_amount" class="form-control" required placeholder="Deal Amount" <?php if ($_SESSION['role'] != 1) { ?>readonly <?php } ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <textarea name="remarks" readonly rows="1" class="form-control" placeholder="Enter Remarks" <?= $class; ?> style="resize:none; height:37px;"><?= $prodItem["remarks"]; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h4>Products Details</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <select class="form-control" name="category" <?= $class; ?>>
                                                            <option value="">--Select Category--</option>
                                                            <?php
                                                            $cid = $prodItem["category"];
                                                            $query = mysqli_query($conn, "Select * from new_category");
                                                            while ($row = mysqli_fetch_array($query)) {
                                                            ?>
                                                                <option value="<?= $row['id'] ?>" <?php if ($cid == $row['id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                                    <?= $row['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php if ($prodItem["product_description"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Product</label>
                                                            <textarea name="product_desc" rows="1" class="form-control" placeholder="Product Description" <?= $class; ?>><?= $prodItem["product_description"]; ?></textarea>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Product</label>
                                                            <textarea name="product_desc" rows="1" class="form-control" placeholder="Product Description" <?= $class; ?>><?= $prodItem["product_description"]; ?></textarea>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                                <?php if ($prodItem["sub_product"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Sub Product</label>
                                                            <input type="text" name="sub_product" class="form-control"
                                                                placeholder="Enter Sub Product" value="<?= $prodItem["sub_product"]; ?>" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Sub Product</label>
                                                            <input type="text" name="sub_product" class="form-control"
                                                                placeholder="Enter Sub Product" value="<?= $prodItem["sub_product"]; ?>" <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <?php if ($prodItem["brightness"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Brightness</label>
                                                            <input type="text" value="<?= $prodItem["brightness"]; ?>" name="brightness" class="form-control" placeholder="Brightness" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Brightness</label>
                                                            <input type="text" value="<?= $prodItem["brightness"]; ?>" name="brightness" class="form-control" placeholder="Brightness" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($prodItem["gsm"] != "") { ?>
                                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Gsm:</label>
                                                                <input type="text" name="gsm" class="form-control" value="<?= $prodItem["gsm"]; ?>" placeholder="Gsm"
                                                                    <?= $class; ?>>
                                                            </div>
                                                        </div><?php } ?>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Gsm:</label>
                                                                <input type="text" name="gsm" class="form-control" value="<?= $prodItem["gsm"]; ?>" placeholder="Gsm"
                                                                    <?= $class; ?>>
                                                            </div>
                                                        </div><?php } ?>
                                                <?php } ?>

                                                <?php if ($prodItem["bf"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>BF</label>
                                                            <input type="text" name="bf" class="form-control"
                                                                placeholder="Enter BF" value="<?= $prodItem["bf"]; ?>" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>BF</label>
                                                            <input type="text" name="bf" class="form-control"
                                                                placeholder="Enter BF" value="<?= $prodItem["bf"]; ?>" <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } ?>
                                                <?php if ($prodItem["shade"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Shade</label>
                                                            <input type="text" value="<?= $prodItem["shade"]; ?>" name="shade" class="form-control" placeholder="Shade"
                                                                <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Shade</label>
                                                            <input type="text" value="<?= $prodItem["shade"]; ?>" name="shade" class="form-control" placeholder="Shade"
                                                                <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["hsn"] != "") { ?>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Hsn No.</label>
                                                            <input type="text" value="<?= $prodItem["hsn"]; ?>" name="hsn_no" class="form-control"
                                                                placeholder="Enter Hsn No." <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Hsn No.</label>
                                                            <input type="text" value="<?= $prodItem["hsn"]; ?>" name="hsn_no" class="form-control"
                                                                placeholder="Enter Hsn No." <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } ?>
                                                <?php if ($prodItem["grain"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Grain</label>
                                                            <input type="text" name="grain" value="<?= $prodItem["grain"]; ?>" class="form-control"
                                                                placeholder="Enter Grain" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Grain</label>
                                                            <input type="text" name="grain" value="<?= $prodItem["grain"]; ?>" class="form-control"
                                                                placeholder="Enter Grain" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["sheat"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Sheet</label>
                                                            <input type="text" name="sheet" value="<?= $prodItem["sheat"]; ?>" class="form-control"
                                                                placeholder="Enter Sheet" <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Sheet</label>
                                                            <input type="text" name="sheet" value="<?= $prodItem["sheat"]; ?>" class="form-control"
                                                                placeholder="Enter Sheet" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["w_l"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>W * L</label>
                                                            <input type="text" name="w_l" value="<?= $prodItem["w_l"]; ?>" class="form-control"
                                                                placeholder="Enter W L" <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>W * L</label>
                                                            <input type="text" name="w_l" value="<?= $prodItem["w_l"]; ?>" class="form-control"
                                                                placeholder="Enter W L" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["no_of_bundle"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>No of Bundle</label>
                                                            <input type="text" name="no_of_bundle" value="<?= $prodItem["no_of_bundle"]; ?>" class="form-control"
                                                                placeholder="Enter No of Bundle" <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>No of Bundle</label>
                                                            <input type="text" name="no_of_bundle" value="<?= $prodItem["no_of_bundle"]; ?>" class="form-control"
                                                                placeholder="Enter No of Bundle" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["no_of_rim"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>No of Rim</label>
                                                            <input type="text" name="no_of_rim" value="<?= $prodItem["no_of_rim"]; ?>" class="form-control"
                                                                placeholder="Enter No of Rim" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>No of Rim</label>
                                                            <input type="text" name="no_of_rim" value="<?= $prodItem["no_of_rim"]; ?>" class="form-control"
                                                                placeholder="Enter No of Rim" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["rim_weight"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Rim Weight</label>
                                                            <input type="text" name="rim_weight" value="<?= $prodItem["rim_weight"]; ?>" class="form-control"
                                                                placeholder="Enter Rim Weight" <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Rim Weight</label>
                                                            <input type="text" name="rim_weight" value="<?= $prodItem["rim_weight"]; ?>" class="form-control"
                                                                placeholder="Enter Rim Weight" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["deal_size"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Size in inch</label>
                                                            <input type="text" name="size" value="<?= $prodItem["deal_size"]; ?>" class="form-control" placeholder="Size in inch"
                                                                <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Size in inch</label>
                                                            <input type="text" name="size" value="<?= $prodItem["deal_size"]; ?>" class="form-control" placeholder="Size in inch"
                                                                <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } ?>
                                                <?php if ($prodItem["stock_in_kg"] != "") { ?>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Stock in Kg</label>
                                                            <input type="text" name="stock_in_kg" value="<?= $prodItem["stock_in_kg"]; ?>" class="form-control"
                                                                placeholder="Stock in Kg" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Stock in Kg</label>
                                                            <input type="text" name="stock_in_kg" value="<?= $prodItem["stock_in_kg"]; ?>" class="form-control"
                                                                placeholder="Stock in Kg" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["quantity_in_kg"] != "") { ?>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Quantity in Kg</label>
                                                            <input type="text" name="quantity_in_kg" value="<?= $prodItem["quantity_in_kg"]; ?>" class="form-control"
                                                                placeholder="Quantity in Kg" <?= $class; ?>>
                                                        </div>
                                                    </div>

                                                <?php  } else if ($_SESSION['role'] == 1) { ?>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Quantity in Kg</label>
                                                            <input type="text" name="quantity_in_kg" value="<?= $prodItem["quantity_in_kg"]; ?>" class="form-control"
                                                                placeholder="Quantity in Kg" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?php if ($prodItem["price_per_kg"] != "") { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Price in Kg:</label>
                                                            <input type="text" name="price_per_kg" value="<?= $prodItem["price_per_kg"]; ?>" class="form-control"
                                                                placeholder="Price per Kg" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } else if ($_SESSION['role'] == 1) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Price in Kg:</label>
                                                            <input type="text" name="price_per_kg" value="<?= $prodItem["price_per_kg"]; ?>" class="form-control"
                                                                placeholder="Price per Kg" <?= $class; ?>>
                                                        </div>
                                                    </div>
                                                <?php  } ?>




                                                <?php if ($role == 1) { ?>
                                                    <div class="col-md-2" style="padding-top:30px">
                                                        <div class="form-group">
                                                            <button type="submit" name="update_pd_deal" class="btn btn-primary btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>


                                    </div>
                            </div>

                        </form>
                    </div>

                    <?php if ($_SESSION['role'] == 1) { ?>
                        <div class="big-button">
                            <div role="button" class="WhyChooseUs__chooseBuyerBtn--V_l0B <?= $class1; ?>" id="defaultOpen" tabindex="0">
                                Buyer
                            </div>
                            <div role="button" class="WhyChooseUs__chooseSupplierBtn--uf8lm <?= $class; ?>" id="sellerbutton" tabindex="-1">
                                Seller
                            </div>
                        </div>
                    <?php } ?>


                    <div id="buyerDiv">
                        <div class="divheading">
                            <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px" id="toggleSamplingSection1">
                                Sampling<span class="toggle-icon">+</span>
                            </h4>

                        </div>
                        <div class="card <?php if ($role == 1) {
                                                if ($deal_status < 1) {
                                                    echo 'disabled';
                                                }
                                            }
                                            ?>">

                            <?php
                            if (isset($_GET['prod_id'])) {
                                //$deal_id = $prodItem["deal_id"];
                                $deal_id = $_GET['prod_id'];
                                $role = $_GET['role'];
                                $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                                $query = "select * from pd_sampling where deal_id='$deal_id' AND type=3";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                            ?>
                                <div id="samplingContent1" style="display: none;">

                                    <div class="card-body">
                                        <form action="code.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                            <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                            <input type="hidden" name="type" value="3">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Date Of Sample</label>
                                                        <div class="input-group date" id="dateofsamplehh" data-target-input="nearest">
                                                            <input type="date" name="dos" value="<?php echo isset($prodItem['dos']) ? $prodItem['dos'] : ''; ?>" class="form-control datetimepicker-input" data-target="#dateofsamplehh" placeholder="DD-MM-YYYY" <?= $class; ?> />
                                                            <!-- <div class="input-group-append" data-target="#dateofsamplehh" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Sample Verification</label>
                                                        <input type="text" name="sample_verification" value="<?php echo isset($prodItem['sample_verification']) ? $prodItem['sample_verification'] : ''; ?>" class="form-control" placeholder="Sample Verification" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Lab Report</label>
                                                        <div class="input-group date" id="labreport" data-target-input="nearest">
                                                            <input type="date" name="lab_report" value="<?php echo isset($prodItem['lab_report']) ? $prodItem['lab_report'] : ''; ?>" class="form-control datetimepicker-input" data-target="#labreport" placeholder="DD-MM-YY" <?= $class; ?> />
                                                            <!-- <div class="input-group-append" data-target="#labreport" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Remarks</label>
                                                        <input type="text" value="<?php echo isset($prodItem['remarks']) ? $prodItem['remarks'] : ''; ?>" name="remarks" class="form-control" placeholder="Remarks" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="gmm">
                                                        <label>Upload Document</label>
                                                        <input type="file" name="upload_doc" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 3) {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>>

                                                        <input type="hidden" name="old_doc" value="<?php echo isset($prodItem['upload_doc']) ? $prodItem['upload_doc'] : ''; ?>">

                                                        <?php if (!empty($prodItem['upload_doc'])) { ?>

                                                            <a href="download_pd_sampling.php?prod_id=<?php echo  $id; ?>">Download
                                                                Now</a> | <a href="<?= $prodItem['upload_doc']; ?>" target="_blank">View Document</a>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                <?php if ($role == 3) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>
                                                                Request</label>

                                                            <select name="status" class="form-control" <?php if ($prodItem['status'] == 1) { ?>disabled <?php } ?>>
                                                                <option value="">------Select-----</option>
                                                                <option value="0" <?php echo ($prodItem['status'] == 0) ? 'selected' : ''; ?>>Pending</option>
                                                                <option value="1" <?php echo ($prodItem['status'] == 1) ? 'selected' : ''; ?>>Accepted</option>
                                                                <option value="2" <?php echo ($prodItem['status'] == 2) ? 'selected' : ''; ?>>Rejected</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php } else if ($role == 1 || $role == 2) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>
                                                                Status</label>
                                                            <input type="text" value="<?php if ($prodItem['status'] == 1) { ?>Accepted <?php } else if ($prodItem['status'] == 2) { ?> Rejected<?php } else { ?>Pending <?php  } ?>" name="status" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <?php if ($role == 1 || $role == 2 || $role == 3) { ?>
                                                    <div class="col-md-2" style="padding-top:30px">
                                                        <div class="form-group">
                                                            <button type="submit" name="pd_sample_update" class="btn btn-primary btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>



                        <div class="divheading">
                            <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px" id="toggleSamplingSection2">
                                Verification <span class="toggle-icon">+</span> </h4>
                        </div>
                        <div class="card <?php if ($deal_status < 2) {
                                                echo 'disabled';
                                            } ?>">

                            <?php
                            if (isset($_GET['prod_id'])) {
                                $deal_id = $_GET['prod_id'];
                                $role = $_GET['role'];
                                $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                                $query = "select * from pd_validation where deal_id='$deal_id' AND type=3";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                            ?>
                                <div id="samplingContent2" style="display: none;">
                                    <div class="card-body">
                                        <form action="code.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                            <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                            <input type="hidden" name="type" value="3">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Date Of Validation</label>
                                                        <div class="input-group date" id="datemask3" data-target-input="nearest">
                                                            <input type="DATE" name="dov" value="<?php echo isset($prodItem['dov']) ? $prodItem['dov'] : ''; ?>" class="form-control datetimepicker-input" data-target="#datemask3" placeholder="DD-MM-YY" <?= $class; ?> />
                                                            <!-- <div class="input-group-append" data-target="#datemask3" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <label>Sample</label>

                                                        <input type="text" name="sample" value="<?php echo isset($prodItem['sample']) ? $prodItem['sample'] : ''; ?>" class="form-control" placeholder="Sample" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Stock Approved</label>
                                                        <input type="text" name="stock_approve" value="<?php echo isset($prodItem['stock_approve']) ? $prodItem['stock_approve'] : ''; ?>" class="form-control" placeholder="Stock Approved" <?= $class; ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group" id="gmm">
                                                        <label>Upload Document</label>
                                                        <input type="file" name="upload_docu" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 3) {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>>
                                                        <input type="hidden" name="old_docu" value="<?php echo isset($prodItem['upload_docu']) ? $prodItem['upload_docu'] : ''; ?>">
                                                        <?php if (!empty($prodItem['upload_docu'])) { ?>

                                                            <a href="download_pd_validation.php?prod_id=<?php echo  $id; ?>">Download
                                                                Now</a> | <a href="<?= $prodItem['upload_docu']; ?>" target="_blank">View Document</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4"></div>
                                                <?php if ($role == 1 || $role == 2) { ?>
                                                    <div class="col-md-2" style="padding-top:30px">
                                                        <div class="form-group">
                                                            <button type="submit" name="pd_validation_update" class="btn btn-primary btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="divheading">
                            <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px" id="toggleSamplingSection3">
                                Order Confimation <span class="toggle-icon">+</span>
                            </h4>
                        </div>
                        <div class="card <?php if ($deal_status < 3) {
                                                echo 'disabled';
                                            } ?>">

                            <?php
                            if (isset($_GET['prod_id'])) {
                                $deal_id = $_GET['prod_id'];
                                $role = $_GET['role'];
                                $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                                $query = "select * from pd_clearance where deal_id='$deal_id' AND type=3";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                            ?>
                                <div id="samplingContent3" style="display: none;">

                                    <div class="card-body">
                                        <form action="code.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                            <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                            <input type="hidden" name="type" value="3">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Clearance Date</label>
                                                        <div class="input-group date" id="dateofclearnce" data-target-input="nearest">
                                                            <input type="date" name="doc" value="<?php echo isset($prodItem['doc']) ? $prodItem['doc'] : ''; ?>" class="form-control datetimepicker-input" data-target="#dateofclearnce" placeholder="DD-MM-YY" <?= $class; ?> />
                                                            <!-- <div class="input-group-append" data-target="#dateofclearnce" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <label>Product Price</label>
                                                        <input type="text" name="product" value="<?php echo isset($prodItem['product']) ? $prodItem['product'] : ''; ?>" class="form-control" required placeholder="Product" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Remarks</label>
                                                        <input type="text" name="remarks" value="<?php echo isset($prodItem['remarks']) ? $prodItem['remarks'] : ''; ?>" class="form-control" placeholder="Remarks" required <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="fmm">
                                                        <label>Purchase Order (PO)</label>
                                                        <input type="file" name="bill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                            echo $class;
                                                                                                                                                        } ?>>
                                                        <input type="hidden" name="old_bill" value="<?php echo isset($prodItem['bill']) ? $prodItem['bill'] : ''; ?>">
                                                        <?php if (!empty($prodItem['bill'])) { ?>
                                                            <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=bill">Download
                                                                Now</a> | <a href="<?php echo $prodItem['bill']; ?>" target="_blank">View Document</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" id="fmm">
                                                        <label>Details</label>
                                                        <input type="file" name="ewaybill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                                echo $class;
                                                                                                                                                            } ?>>
                                                        <input type="hidden" name="old_ewaybill" value="<?php echo isset($prodItem['ewaybill']) ? $prodItem['ewaybill'] : ''; ?>">
                                                        <?php if (!empty($prodItem['ewaybill'])) { ?>
                                                            <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=ewaybill">Download
                                                                Now</a> | <a href="<?php echo $prodItem['ewaybill']; ?>" target="_blank">View Document</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group" id="fmm">
                                                        <label>Document 3</label>
                                                        <input type="file" name="stock_statement" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                                        echo $class;
                                                                                                                                                                    } ?>>
                                                        <input type="hidden" name="old_stock_statement" value="<?php echo isset($prodItem['stock_statement']) ? $prodItem['stock_statement'] : ''; ?>">
                                                        <?php if (!empty($prodItem['stock_statement'])) { ?>
                                                            <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=stock_statement">Download
                                                                Now</a> | <a href="<?php echo $prodItem['stock_statement']; ?>" target="_blank">View Document</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" id="fmm">
                                                        <label>Document 4</label>
                                                        <input type="file" name="bill_t" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                                echo $class;
                                                                                                                                                            } ?>>
                                                        <input type="hidden" name="old_bill_t" value="<?php echo isset($prodItem['bill_t']) ? $prodItem['bill_t'] : ''; ?>">
                                                        <?php if (!empty($prodItem['bill_t'])) { ?>
                                                            <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=bill_t">Download
                                                                Now</a> | <a href="<?php echo $prodItem['bill_t']; ?>" target="_blank">View Document</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                            <div class="form-group" id="gmm">
                                                <label>Upload Document</label>
                                                <input type="file" name="upload_docum" class="border" style="width:100%" placeholder="Upload Document" <?php //if($_GET['role']==3){  echo "disabled"; } 
                                                                                                                                                        ?>>
                                                <input type="hidden" name="old_docum" value="<?php //echo isset($prodItem['upload_docum']) ? $prodItem['upload_docum'] : ''; 
                                                                                                ?>">
                                                <?php //if (!empty($prodItem['upload_docum'])) { 
                                                ?>

                                                    <a href="download_pd_clerance.php?prod_id=<?php //echo  $id; 
                                                                                                ?>">Download
                                                        Now</a> | <a href="<? //$prodItem['upload_docum']; 
                                                                            ?>" target="_blank">View Document</a>
                                                <?php //} 
                                                ?>
                                            </div>
                                        </div> -->

                                                <?php if ($role == 1 || $role == 2) { ?>
                                                    <div class="col-md-2" style="padding-top:30px">
                                                        <div class="form-group">
                                                            <button type="submit" name="pd_clearance_update" class="btn btn-primary btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="divheading">
                            <h4 style="font-size:28px;color:#1C2434;margin:50px 0 11px 3px" id="toggleSamplingSection4">
                                Payment <span class="toggle-icon">+</span>
                            </h4>
                        </div>
                        <div class="card  <?php if ($_GET['role'] == 1) {
                                                if ($deal_status < 2) {
                                                    echo 'disabled';
                                                }
                                            } ?>">

                            <?php
                            if (isset($_GET['prod_id'])) {
                                $deal_id = $_GET['prod_id'];
                                $role_type = $_REQUEST['role'];
                                $return_url = "edit-pd-deal.php?role=$role_type&prod_id=$deal_id";
                            ?>
                                <div id="samplingContent4" style="display: none;">

                                    <div class="card-body">
                                        <form action="code.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                            <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                            <input type="hidden" name="type" value="3">


                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Transaction Date</label>
                                                        <div class="input-group date" id="transactiondate" data-target-input="nearest">
                                                            <input type="date" name="transaction_date" value="" class="form-control datetimepicker-input" data-target="#transactiondate" placeholder="DD-MM-YY" <?= $class; ?> />
                                                            <!-- <div class="input-group-append" data-target="#transactiondate" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <label>Transaction Id</label>

                                                        <input type="text" name="product" value="" class="form-control" required placeholder="Transaction Status" <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Detail</label>
                                                        <input type="text" name="details" value="" class="form-control" placeholder="Detail" required <?= $class; ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Account Number</label>
                                                        <input type="text" name="acc_no" class="form-control" placeholder="Account No." <?= $class; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Bank</label>
                                                        <input type="text" name="bank" class="form-control" placeholder="Bank" <?= $class; ?>>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Branch</label>
                                                        <input type="text" name="branch" class="form-control" placeholder="Branch" <?= $class; ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="text" name="Amount" class="form-control" placeholder="Amount" <?= $class; ?>>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group" id="gmm">
                                                        <label>Upload Document</label>
                                                        <input type="file" name="upload_docume" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_SESSION['role'] == 2) {
                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                } ?>>
                                                    </div>
                                                </div>

                                                <div class="col-md-4"></div>
                                                <div class="col-md-4"></div>
                                                <?php if ($role == 1 || $role == 3) { ?>
                                                    <div class="col-md-2" style="padding-top:30px">
                                                        <div class="form-group">
                                                            <button type="submit" name="pd_payment_update" class="btn btn-primary btn-block">Update</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </form>
                                        <hr><br>
                                        <h4>Payment Details</h4>
                                        <hr><br>
                                        <table class="table" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Transaction Date</th>
                                                    <th>Transaction Id</th>
                                                    <th>Account Number</th>
                                                    <th>Bank</th>

                                                    <th>Branch</th>
                                                    <th>Amount</th>
                                                    <th>Detail</th>
                                                    <th>Uploaded Document</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * from pd_payment Where deal_id='" . $deal_id . "' AND type=3 Order by id desc";
                                                $query_run = mysqli_query($conn, $query);
                                                if (mysqli_num_rows($query_run) > 0) {
                                                    $i = 1;
                                                    foreach ($query_run as $prodItem) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $i; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $prodItem['transaction_date']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $prodItem['product']; ?>
                                                            </td>


                                                            <td>
                                                                <?php echo $prodItem['acc_no']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $prodItem['bank']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $prodItem['branch']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $prodItem['ammount']; ?>
                                                            </td>


                                                            <td>
                                                                <?php echo $prodItem['details']; ?>
                                                            </td>
                                                            <!-- ===================== -->

                                                            <!-- ================ -->
                                                            <td>

                                                                <a href="download_pd_deal.php?prod_id=<?php echo  $id; ?>">Download
                                                                    Now</a> | <a href="<?= $prodItem['upload_docume']; ?>" target="_blank">View Document</a>
                                                            </td>
                                                            <td style="text-align:center;   ">
                                                                <div class=" dropdown">
                                                                    <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action
                                                                    </a>
                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                                        <li>
                                                                            <a href="pd_edit_payment_deatils.php?role=<?php $p_id = $prodItem['id'];
                                                                                                                        echo $_SESSION['role']; ?>&id=<?= $p_id; ?>" class="dropdown-item">
                                                                                <?php if ($role == 1) {
                                                                                    echo 'Edit';
                                                                                } else {
                                                                                    echo 'View';
                                                                                } ?>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                    </div>
                                    </td>

                                    </tr>


                                <?php
                                                        $i++;
                                                    }
                                                } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Record found</td>
                                </tr>
                            <?php
                                                }
                            ?>

                            </tbody>
                            </table>

                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="divheading">
                        <h4 style="font-size:28px;color:#1C2434;margin:50px 0 11px 3px" id="toggleSamplingSection5">
                            Transportation <span class="toggle-icon">+</span>
                        </h4>
                    </div>
                    <div class="card <?php if ($deal_status < 5) {
                                            echo 'disabled';
                                        } ?>">

                        <?php
                        if (isset($_GET['prod_id'])) {
                            $deal_id = $_GET['prod_id'];
                            $role = $_GET['role'];
                            $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                            $query = "select * from pd_transportation where deal_id='$deal_id' AND type=3";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                        ?>
                            <div id="samplingContent5" style="display: none;">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                        <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                        <input type="hidden" name="type" value="3">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Transportation Date</label>
                                                    <div class="input-group date" id="tdd" data-target-input="nearest">
                                                        <input type="date" name="transportation_date" value="<?php echo isset($prodItem['transportation_date']) ? $prodItem['transportation_date'] : ''; ?>" class="form-control datetimepicker-input" data-target="#tdd" placeholder="DD-MM-YY" <?= $class; ?> />
                                                        <!-- <div class="input-group-append" data-target="#tdd" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Transporter Name</label>

                                                    <input type="text" name="transporter_name" value="<?php echo $prodItem['transporter_name']; ?>" class="form-control " placeholder="Transporter Name" <?= $class; ?> />


                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Mode Of Transport</label>

                                                    <input type="text" name="mot" value="<?php echo isset($prodItem['mot']) ? $prodItem['mot'] : ''; ?>" class="form-control" required placeholder="Mode Of Transport" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        Vehicle No.</label>
                                                    <input type="text" name="vehicle_no" value="<?php echo isset($prodItem['vehicle_no']) ? $prodItem['vehicle_no'] : ''; ?>" class="form-control" placeholder="Vehicle No." required <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        Freight</label>
                                                    <input type="text" name="ammount_incured" value="<?php echo isset($prodItem['ammount_incured']) ? $prodItem['ammount_incured'] : ''; ?>" class="form-control" placeholder="Freight" required <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Bill or Lading/LR-RR No</label>

                                                    <input type="text" name="bill_or_lading" value="<?php echo $prodItem['bill_or_lading']; ?>" class="form-control" placeholder="Bill or Lading/LR-RR No" <?= $class; ?> />


                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Upload Bill</label>
                                                    <input type="file" name="bill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                        echo $class;
                                                                                                                                                    } ?>>
                                                    <input type="hidden" name="old_bill" value="<?php echo isset($prodItem['bill']) ? $prodItem['bill'] : ''; ?>">
                                                    <?php if (!empty($prodItem['bill'])) { ?>
                                                        <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=bill">Download
                                                            Now</a> | <a href="<?php echo $prodItem['bill']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Upload Eway Bill</label>
                                                    <input type="file" name="ewaybill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                            echo $class;
                                                                                                                                                        } ?>>
                                                    <input type="hidden" name="old_ewaybill" value="<?php echo isset($prodItem['ewaybill']) ? $prodItem['ewaybill'] : ''; ?>">
                                                    <?php if (!empty($prodItem['ewaybill'])) { ?>
                                                        <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=ewaybill">Download
                                                            Now</a> | <a href="<?php echo $prodItem['ewaybill']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Upload Stock Statement</label>
                                                    <input type="file" name="stock_statement" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                                    echo $class;
                                                                                                                                                                } ?>>
                                                    <input type="hidden" name="old_stock_statement" value="<?php echo isset($prodItem['stock_statement']) ? $prodItem['stock_statement'] : ''; ?>">
                                                    <?php if (!empty($prodItem['stock_statement'])) { ?>
                                                        <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=stock_statement">Download
                                                            Now</a> | <a href="<?php echo $prodItem['stock_statement']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Upload Bill T</label>
                                                    <input type="file" name="bill_t" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                            echo $class;
                                                                                                                                                        } ?>>
                                                    <input type="hidden" name="old_bill_t" value="<?php echo isset($prodItem['bill_t']) ? $prodItem['bill_t'] : ''; ?>">
                                                    <?php if (!empty($prodItem['bill_t'])) { ?>
                                                        <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=bill_t">Download
                                                            Now</a> | <a href="<?php echo $prodItem['bill_t']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">
                                        <div class="form-group" id="gmm">
                                            <label>Upload Document</label>
                                            <input type="file" name="upload_documen" class="border" style="width:100%" placeholder="Upload Document" <?php //if($_GET['role']==3){  echo "disabled"; } 
                                                                                                                                                        ?>>
                                            <input type="hidden" name="old_documen" value="<?php //echo isset($prodItem['upload_documen']) ? $prodItem['upload_documen'] : ''; 
                                                                                            ?>">
                                            <?php //if (!empty($prodItem['upload_documen'])) { 
                                            ?>

                                                <a href="download_pd_transportation.php?prod_id=<?php //echo  $id; 
                                                                                                ?>">Download
                                                    Now</a> | <a href="<? // $prodItem['upload_documen']; 
                                                                        ?>" target="_blank">View Document</a>
                                            <?php //} 
                                            ?>
                                        </div>
                                    </div> -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        Distance</label>
                                                    <input type="text" name="distance" value="<?php echo isset($prodItem['distance']) ? $prodItem['distance'] : ''; ?>" class="form-control" placeholder="Distance" required <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <?php if ($role == 1 || $role == 2) { ?>
                                                <div class="col-md-2" style="padding-top:30px">
                                                    <div class="form-group">
                                                        <button type="submit" name="pd_transportation_update" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                    <div class="divheading">
                        <h4 style="font-size:28px;color:#1C2434;margin:50px 0 11px 3px" id="toggleSamplingSection6">
                            Closed<span class="toggle-icon">+</span>
                        </h4>
                    </div>


                    <div class="card <?php if ($deal_status < 6) {
                                            echo 'disabled';
                                        } ?>">

                        <?php
                        if (isset($_GET['prod_id'])) {
                            $deal_id = $_GET['prod_id'];
                            $role = $_GET['role'];
                            $return_url = "target-pd-deals.php";
                            $query = "select * from pd_close where deal_id='$deal_id' AND type=3";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                            $result = mysqli_query($conn, "select id, deal_id from pd_deals where id='$deal_id'");
                            $data = mysqli_fetch_assoc($result);

                        ?>
                            <div id="samplingContent6" style="display: none;">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="master_deal_id" value="<?= $data['deal_id'] ?>">
                                        <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">

                                        <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                        <input type="hidden" name="type" value="3">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Closed Date</label>
                                                    <div class="input-group date" id="cdate" data-target-input="nearest">

                                                        <input type="date" name="close_date" value="<?php echo isset($prodItem['close_date']) ? $prodItem['close_date'] : ''; ?>" class="form-control datetimepicker-input" data-target="#cdate" placeholder="DD-MM-YY" <?= $class; ?> />
                                                        <!-- <div class="input-group-append" data-target="#cdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Product</label>
                                                    <input type="text" name="product" value="<?php echo isset($prodItem['product']) ? $prodItem['product'] : ''; ?>" class="form-control" required placeholder="Product" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <input type="text" name="remarks" value="<?php echo isset($prodItem['remarks']) ? $prodItem['remarks'] : ''; ?>" class="form-control" placeholder="Remarks" required <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Product recd. by</label>
                                                    <input type="text" name="product_recd" value="<?php echo isset($prodItem['product_recd']) ? $prodItem['product_recd'] : ''; ?>" class="form-control" placeholder="Product recd. by" required <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Deal Size (in kg)</label>
                                                    <input type="text" name="deal_size" value="<?php echo isset($prodItem['deal_size']) ? $prodItem['deal_size'] : ''; ?>" class="form-control" placeholder="Deal Size (in kg)" required <?= $class; ?>>
                                                </div>
                                            </div>
                                            <?php if ($_SESSION['role'] == 1) { ?>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Comission (₹)</label>
                                                        <input type="text" name="comission" value="<?php echo isset($prodItem['comission']) ? $prodItem['comission'] : ''; ?>" class="form-control" placeholder="Comission" required <?= $class; ?>>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) { ?>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Report</label>
                                                        <br>
                                                        <a href="pd_deal_process_report.php?prod_id=<?php echo $_GET['prod_id']; ?>">Download Report</a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($role == 1 || $role == 2) { ?>
                                                <div class="col-md-2">
                                                    <div class="form-group" style="padding-top:30px">
                                                        <button type="submit" name="pd_close_update" class="btn btn-primary btn-block float-right">Update</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div id="sellerDiv" style="display:none;">
                    <div class="divheading">
                        <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px" id="toggleSamplingSection7">
                            Sampling<span class="toggle-icon">+</span>
                        </h4>

                    </div>
                    <div class="card <?php if ($role == 1) {
                                            if ($deal_status < 1) {
                                                echo 'disabled';
                                            }
                                        }
                                        ?>">

                        <?php
                        if (isset($_GET['prod_id'])) {
                            //$deal_id = $prodItem["deal_id"];
                            $deal_id = $_GET['prod_id'];
                            $role = $_GET['role'];
                            $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                            $query = "select * from pd_sampling where deal_id='$deal_id' AND type=2";
                            // echo $query;
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                        ?>
                            <div id="samplingContent7" style="display: none;">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                        <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                        <input type="hidden" name="type" value="2">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Sample</label>
                                                    <div class="input-group date" id="dateofsamplehh" data-target-input="nearest">
                                                        <input type="DATE" name="dos" value="<?php echo isset($prodItem['dos']) ? $prodItem['dos'] : ''; ?>" class="form-control datetimepicker-input" data-target="#dateofsamplehh" placeholder="DD-MM-YYYY" <?= $class; ?> />
                                                        <!-- <div class="input-group-append" data-target="#dateofsamplehh" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sample Verification</label>
                                                    <input type="text" name="sample_verification" value="<?php echo isset($prodItem['sample_verification']) ? $prodItem['sample_verification'] : ''; ?>" class="form-control" placeholder="Sample Verification" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Lab Report</label>
                                                    <div class="input-group date" id="labreport" data-target-input="nearest">
                                                        <input type="DATE" name="lab_report" value="<?php echo isset($prodItem['lab_report']) ? $prodItem['lab_report'] : ''; ?>" class="form-control datetimepicker-input" data-target="#labreport" placeholder="DD-MM-YY" <?= $class; ?> />
                                                        <!-- <div class="input-group-append" data-target="#labreport" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        Remarks</label>
                                                    <input type="text" value="<?php echo isset($prodItem['remarks']) ? $prodItem['remarks'] : ''; ?>" name="remarks" class="form-control" placeholder="Remarks" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" id="gmm">
                                                    <label>Upload Document</label>
                                                    <input type="file" name="upload_doc" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 3) {
                                                                                                                                                                echo "disabled";
                                                                                                                                                            } ?>>

                                                    <input type="hidden" name="old_doc" value="<?php echo isset($prodItem['upload_doc']) ? $prodItem['upload_doc'] : ''; ?>">

                                                    <?php if (!empty($prodItem['upload_doc'])) { ?>

                                                        <a href="download_pd_sampling.php?prod_id=<?php echo  $id; ?>">Download
                                                            Now</a> | <a href="<?= $prodItem['upload_doc']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <?php if ($role == 3 || $role == 1) { ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Status</label>

                                                        <select name="status" class="form-control" <?php if ($_SESSION['role'] == 3) {
                                                                                                        if ($prodItem['status'] == 1) { ?>disabled <?php }
                                                                                                                                            } ?>>
                                                            <option value="">------Select-----</option>
                                                            <option value="0" <?php echo ($prodItem['status'] == 0) ? 'selected' : ''; ?>>Pending</option>
                                                            <option value="1" <?php echo ($prodItem['status'] == 1) ? 'selected' : ''; ?>>Accepted</option>
                                                            <option value="2" <?php echo ($prodItem['status'] == 2) ? 'selected' : ''; ?>>Rejected</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } else if ($role == 1 || $role == 2) { ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>
                                                            Status</label>

                                                        <input type="text" value="<?php if ($prodItem['status'] == 1) { ?>Accepted <?php } else if ($prodItem['status'] == 2) { ?> Rejected<?php } else { ?>Pending <?php  } ?>" name="status" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <?php if ($role == 1 || $role == 2 || $role == 3) { ?>
                                                <div class="col-md-2" style="padding-top:30px">
                                                    <div class="form-group">
                                                        <button type="submit" name="pd_sample_update" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <?php } ?>
                    </div>



                    <div class="divheading">
                        <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px" id="toggleSamplingSection8">
                            Verification <span class="toggle-icon">+</span> </h4>
                    </div>
                    <div class="card <?php if ($deal_status < 2) {
                                            echo 'disabled';
                                        } ?>">

                        <?php
                        if (isset($_GET['prod_id'])) {
                            $deal_id = $_GET['prod_id'];
                            $role = $_GET['role'];
                            $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                            $query = "select * from pd_validation where deal_id='$deal_id' AND type=2";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                        ?>
                            <div id="samplingContent8" style="display: none;">
                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                        <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                        <input type="hidden" name="type" value="2">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Validation</label>
                                                    <div class="input-group date" id="datemask3" data-target-input="nearest">
                                                        <input type="date" name="dov" value="<?php echo isset($prodItem['dov']) ? $prodItem['dov'] : ''; ?>" class="form-control datetimepicker-input" data-target="#datemask3" placeholder="DD-MM-YY" <?= $class; ?> />
                                                        <!-- <div class="input-group-append" data-target="#datemask3" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Sample</label>

                                                    <input type="text" name="sample" value="<?php echo isset($prodItem['sample']) ? $prodItem['sample'] : ''; ?>" class="form-control" placeholder="Sample" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        Stock Approved</label>
                                                    <input type="text" name="stock_approve" value="<?php echo isset($prodItem['stock_approve']) ? $prodItem['stock_approve'] : ''; ?>" class="form-control" placeholder="Stock Approved" <?= $class; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group" id="gmm">
                                                    <label>Upload Document</label>
                                                    <input type="file" name="upload_docu" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 3) {
                                                                                                                                                                echo "disabled";
                                                                                                                                                            } ?>>
                                                    <input type="hidden" name="old_docu" value="<?php echo isset($prodItem['upload_docu']) ? $prodItem['upload_docu'] : ''; ?>">
                                                    <?php if (!empty($prodItem['upload_docu'])) { ?>

                                                        <a href="download_pd_validation.php?prod_id=<?php echo  $id; ?>">Download
                                                            Now</a> | <a href="<?= $prodItem['upload_docu']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <?php if ($role == 1 || $role == 2) { ?>
                                                <div class="col-md-2" style="padding-top:30px">
                                                    <div class="form-group">
                                                        <button type="submit" name="pd_validation_update" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="divheading">
                        <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px" id="toggleSamplingSection9">
                            Order Confimation <span class="toggle-icon">+</span>
                        </h4>
                    </div>
                    <div class="card <?php if ($deal_status < 3) {
                                            echo 'disabled';
                                        } ?>">

                        <?php
                        if (isset($_GET['prod_id'])) {
                            $deal_id = $_GET['prod_id'];
                            $role = $_GET['role'];
                            $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                            $query = "select * from pd_clearance where deal_id='$deal_id' AND type=2";
                            $query_run = mysqli_query($conn, $query);
                            $prodItem = mysqli_fetch_array($query_run);
                        ?>
                            <div id="samplingContent9" style="display: none;">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                        <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                        <input type="hidden" name="type" value="2">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Clearance Date</label>
                                                    <div class="input-group date" id="dateofclearnce" data-target-input="nearest">
                                                        <input type="date" name="doc" value="<?php echo isset($prodItem['doc']) ? $prodItem['doc'] : ''; ?>" class="form-control datetimepicker-input" data-target="#dateofclearnce" placeholder="DD-MM-YY" <?= $class; ?> />
                                                        <!-- <div class="input-group-append" data-target="#dateofclearnce" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Product Price</label>
                                                    <input type="text" name="product" value="<?php echo isset($prodItem['product']) ? $prodItem['product'] : ''; ?>" class="form-control" required placeholder="Product" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        Remarks</label>
                                                    <input type="text" name="remarks" value="<?php echo isset($prodItem['remarks']) ? $prodItem['remarks'] : ''; ?>" class="form-control" placeholder="Remarks" required <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Purchase Order (PO)</label>
                                                    <input type="file" name="bill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                        echo $class;
                                                                                                                                                    } ?>>
                                                    <input type="hidden" name="old_bill" value="<?php echo isset($prodItem['bill']) ? $prodItem['bill'] : ''; ?>">
                                                    <?php if (!empty($prodItem['bill'])) { ?>
                                                        <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=bill">Download
                                                            Now</a> | <a href="<?php echo $prodItem['bill']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Details</label>
                                                    <input type="file" name="ewaybill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                            echo $class;
                                                                                                                                                        } ?>>
                                                    <input type="hidden" name="old_ewaybill" value="<?php echo isset($prodItem['ewaybill']) ? $prodItem['ewaybill'] : ''; ?>">
                                                    <?php if (!empty($prodItem['ewaybill'])) { ?>
                                                        <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=ewaybill">Download
                                                            Now</a> | <a href="<?php echo $prodItem['ewaybill']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Document 3</label>
                                                    <input type="file" name="stock_statement" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                                    echo $class;
                                                                                                                                                                } ?>>
                                                    <input type="hidden" name="old_stock_statement" value="<?php echo isset($prodItem['stock_statement']) ? $prodItem['stock_statement'] : ''; ?>">
                                                    <?php if (!empty($prodItem['stock_statement'])) { ?>
                                                        <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=stock_statement">Download
                                                            Now</a> | <a href="<?php echo $prodItem['stock_statement']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group" id="fmm">
                                                    <label>Document 4</label>
                                                    <input type="file" name="bill_t" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                            echo $class;
                                                                                                                                                        } ?>>
                                                    <input type="hidden" name="old_bill_t" value="<?php echo isset($prodItem['bill_t']) ? $prodItem['bill_t'] : ''; ?>">
                                                    <?php if (!empty($prodItem['bill_t'])) { ?>
                                                        <a href="download_pd_clerance.php?prod_id=<?php echo  $id; ?>&name=bill_t">Download
                                                            Now</a> | <a href="<?php echo $prodItem['bill_t']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4">
                                            <div class="form-group" id="gmm">
                                                <label>Upload Document</label>
                                                <input type="file" name="upload_docum" class="border" style="width:100%" placeholder="Upload Document" <?php //if($_GET['role']==3){  echo "disabled"; } 
                                                                                                                                                        ?>>
                                                <input type="hidden" name="old_docum" value="<?php //echo isset($prodItem['upload_docum']) ? $prodItem['upload_docum'] : ''; 
                                                                                                ?>">
                                                <?php //if (!empty($prodItem['upload_docum'])) { 
                                                ?>

                                                    <a href="download_pd_clerance.php?prod_id=<?php //echo  $id; 
                                                                                                ?>">Download
                                                        Now</a> | <a href="<? //$prodItem['upload_docum']; 
                                                                            ?>" target="_blank">View Document</a>
                                                <?php //} 
                                                ?>
                                            </div>
                                        </div> -->

                                            <?php if ($role == 1 || $role == 2) { ?>
                                                <div class="col-md-2" style="padding-top:30px">
                                                    <div class="form-group">
                                                        <button type="submit" name="pd_clearance_update" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="divheading">
                        <h4 style="font-size:28px;color:#1C2434;margin:50px 0 11px 3px" id="toggleSamplingSection10">
                            Payment <span class="toggle-icon">+</span>
                        </h4>
                    </div>
                    <div class="card  <?php if ($_GET['role'] == 1) {
                                            if ($deal_status < 2) {
                                                echo 'disabled';
                                            }
                                        } ?>">

                        <?php
                        if (isset($_GET['prod_id'])) {
                            $deal_id = $_GET['prod_id'];
                            $role_type = $_REQUEST['role'];
                            $return_url = "edit-pd-deal.php?role=$role_type&prod_id=$deal_id";
                        ?>
                            <div id="samplingContent10" style="display: none;">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                        <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                        <input type="hidden" name="type" value="2">


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Transaction Date</label>
                                                    <div class="input-group date" id="transactiondate" data-target-input="nearest">
                                                        <input type="date" name="transaction_date" value="" class="form-control datetimepicker-input" data-target="#transactiondate" placeholder="DD-MM-YY" <?= $class; ?> />
                                                        <!-- <div class="input-group-append" data-target="#transactiondate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Transaction Id</label>

                                                    <input type="text" name="product" value="" class="form-control" required placeholder="Transaction Status" <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>
                                                        Detail</label>
                                                    <input type="text" name="details" value="" class="form-control" placeholder="Detail" required <?= $class; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Account Number</label>
                                                    <input type="text" name="acc_no" class="form-control" placeholder="Account No." <?= $class; ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Bank</label>
                                                    <input type="text" name="bank" class="form-control" placeholder="Bank" <?= $class; ?>>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Branch</label>
                                                    <input type="text" name="branch" class="form-control" placeholder="Branch" <?= $class; ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input type="text" name="Amount" class="form-control" placeholder="Amount" <?= $class; ?>>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group" id="gmm">
                                                    <label>Upload Document</label>
                                                    <input type="file" name="upload_docume" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_SESSION['role'] == 2) {
                                                                                                                                                                echo 'disabled';
                                                                                                                                                            } ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <?php if ($role == 1 || $role == 3) { ?>
                                                <div class="col-md-2" style="padding-top:30px">
                                                    <div class="form-group">
                                                        <button type="submit" name="pd_payment_update" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                    <hr><br>
                                    <h4>Payment Details</h4>
                                    <hr><br>
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Transaction Date</th>
                                                <th>Transaction Id</th>
                                                <th>Account Number</th>
                                                <th>Bank</th>
                                                <th>Branch</th>
                                                <th>Amount</th>
                                                <th>Detail</th>
                                                <th>Uploaded Document</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * from pd_payment Where deal_id='" . $deal_id . "' AND type=2 Order by id desc";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                $i = 1;
                                                foreach ($query_run as $prodItem) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $prodItem['transaction_date']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $prodItem['product']; ?>
                                                        </td>


                                                        <td>
                                                            <?php echo $prodItem['acc_no']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $prodItem['bank']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $prodItem['branch']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $prodItem['ammount']; ?>
                                                        </td>


                                                        <td>
                                                            <?php echo $prodItem['details']; ?>
                                                        </td>
                                                        <!-- ===================== -->

                                                        <!-- ================ -->
                                                        <td>

                                                            <a href="download_pd_deal.php?prod_id=<?php echo  $id; ?>">Download
                                                                Now</a> | <a href="<?= $prodItem['upload_docume']; ?>" target="_blank">View Document</a>
                                                        </td>
                                                        <td style="text-align:center;   ">
                                                            <div class=" dropdown">
                                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action
                                                                </a>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                                    <li>
                                                                        <a href="pd_edit_payment_deatils.php?role=<?php $p_id = $prodItem['id'];
                                                                                                                    echo $_SESSION['role']; ?>&id=<?= $p_id; ?>" class="dropdown-item">
                                                                            <?php if ($role == 1) {
                                                                                echo 'Edit';
                                                                            } else {
                                                                                echo 'View';
                                                                            } ?>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                </div>
                                </td>

                                </tr>


                            <?php
                                                    $i++;
                                                }
                                            } else {
                            ?>
                            <tr>
                                <td colspan="5">No Record found</td>
                            </tr>
                        <?php
                                            }
                        ?>

                        </tbody>
                        </table>

                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="divheading">
                    <h4 style="font-size:28px;color:#1C2434;margin:50px 0 11px 3px" id="toggleSamplingSection11">
                        Transportation <span class="toggle-icon">+</span>
                    </h4>
                </div>
                <div class="card <?php if ($deal_status < 5) {
                                        echo 'disabled';
                                    } ?>">

                    <?php
                    if (isset($_GET['prod_id'])) {
                        $deal_id = $_GET['prod_id'];
                        $role = $_GET['role'];
                        $return_url = "edit-pd-deal.php?role=$role&prod_id=$deal_id";
                        $query = "select * from pd_transportation where deal_id='$deal_id' AND type=2";
                        $query_run = mysqli_query($conn, $query);
                        $prodItem = mysqli_fetch_array($query_run);
                    ?>
                        <div id="samplingContent11" style="display: none;">

                            <div class="card-body">
                                <form action="code.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">
                                    <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                    <input type="hidden" name="type" value="2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Transportation Date</label>
                                                <div class="input-group date" id="tdd" data-target-input="nearest">
                                                    <input type="date" name="transportation_date" value="<?php echo isset($prodItem['transportation_date']) ? $prodItem['transportation_date'] : ''; ?>" class="form-control datetimepicker-input" data-target="#tdd" placeholder="DD-MM-YY" <?= $class; ?> />
                                                    <!-- <div class="input-group-append" data-target="#tdd" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Transporter Name</label>

                                                <input type="text" name="transporter_name" value="<?php echo $prodItem['transporter_name']; ?>" class="form-control " placeholder="Transporter Name" <?= $class; ?> />


                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Mode Of Transport</label>

                                                <input type="text" name="mot" value="<?php echo isset($prodItem['mot']) ? $prodItem['mot'] : ''; ?>" class="form-control" required placeholder="Mode Of Transport" <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Vehicle No.</label>
                                                <input type="text" name="vehicle_no" value="<?php echo isset($prodItem['vehicle_no']) ? $prodItem['vehicle_no'] : ''; ?>" class="form-control" placeholder="Vehicle No." required <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Freight</label>
                                                <input type="text" name="ammount_incured" value="<?php echo isset($prodItem['ammount_incured']) ? $prodItem['ammount_incured'] : ''; ?>" class="form-control" placeholder="Freight" required <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bill or Lading/LR-RR No</label>

                                                <input type="text" name="bill_or_lading" value="<?php echo $prodItem['bill_or_lading']; ?>" class="form-control" placeholder="Bill or Lading/LR-RR No" <?= $class; ?> />


                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" id="fmm">
                                                <label>Upload Bill</label>
                                                <input type="file" name="bill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                    echo $class;
                                                                                                                                                } ?>>
                                                <input type="hidden" name="old_bill" value="<?php echo isset($prodItem['bill']) ? $prodItem['bill'] : ''; ?>">
                                                <?php if (!empty($prodItem['bill'])) { ?>
                                                    <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=bill">Download
                                                        Now</a> | <a href="<?php echo $prodItem['bill']; ?>" target="_blank">View Document</a>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" id="fmm">
                                                <label>Upload Eway Bill</label>
                                                <input type="file" name="ewaybill" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                        echo $class;
                                                                                                                                                    } ?>>
                                                <input type="hidden" name="old_ewaybill" value="<?php echo isset($prodItem['ewaybill']) ? $prodItem['ewaybill'] : ''; ?>">
                                                <?php if (!empty($prodItem['ewaybill'])) { ?>
                                                    <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=ewaybill">Download
                                                        Now</a> | <a href="<?php echo $prodItem['ewaybill']; ?>" target="_blank">View Document</a>
                                                <?php } ?>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group" id="fmm">
                                                <label>Upload Stock Statement</label>
                                                <input type="file" name="stock_statement" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                                echo $class;
                                                                                                                                                            } ?>>
                                                <input type="hidden" name="old_stock_statement" value="<?php echo isset($prodItem['stock_statement']) ? $prodItem['stock_statement'] : ''; ?>">
                                                <?php if (!empty($prodItem['stock_statement'])) { ?>
                                                    <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=stock_statement">Download
                                                        Now</a> | <a href="<?php echo $prodItem['stock_statement']; ?>" target="_blank">View Document</a>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" id="fmm">
                                                <label>Upload Bill T</label>
                                                <input type="file" name="bill_t" class="border" style="width:100%" placeholder="Upload Document" <?php if ($_GET['role'] == 1) {
                                                                                                                                                        echo $class;
                                                                                                                                                    } ?>>
                                                <input type="hidden" name="old_bill_t" value="<?php echo isset($prodItem['bill_t']) ? $prodItem['bill_t'] : ''; ?>">
                                                <?php if (!empty($prodItem['bill_t'])) { ?>
                                                    <a href="download_pd_transportation.php?prod_id=<?php echo  $id; ?>&name=bill_t">Download
                                                        Now</a> | <a href="<?php echo $prodItem['bill_t']; ?>" target="_blank">View Document</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                        <div class="form-group" id="gmm">
                                            <label>Upload Document</label>
                                            <input type="file" name="upload_documen" class="border" style="width:100%" placeholder="Upload Document" <?php //if($_GET['role']==3){  echo "disabled"; } 
                                                                                                                                                        ?>>
                                            <input type="hidden" name="old_documen" value="<?php //echo isset($prodItem['upload_documen']) ? $prodItem['upload_documen'] : ''; 
                                                                                            ?>">
                                            <?php //if (!empty($prodItem['upload_documen'])) { 
                                            ?>

                                                <a href="download_pd_transportation.php?prod_id=<?php //echo  $id; 
                                                                                                ?>">Download
                                                    Now</a> | <a href="<? // $prodItem['upload_documen']; 
                                                                        ?>" target="_blank">View Document</a>
                                            <?php //} 
                                            ?>
                                        </div>
                                    </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Distance</label>
                                                <input type="text" name="distance" value="<?php echo isset($prodItem['distance']) ? $prodItem['distance'] : ''; ?>" class="form-control" placeholder="Distance" required <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <?php if ($role == 1 || $role == 2) { ?>
                                            <div class="col-md-2" style="padding-top:30px">
                                                <div class="form-group">
                                                    <button type="submit" name="pd_transportation_update" class="btn btn-primary btn-block">Update</button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>


                <div class="divheading">
                    <h4 style="font-size:28px;color:#1C2434;margin:50px 0 11px 3px" id="toggleSamplingSection12">
                        Closed<span class="toggle-icon">+</span>
                    </h4>
                </div>


                <div class="card <?php if ($deal_status < 6) {
                                        echo 'disabled';
                                    } ?>">

                    <?php
                    if (isset($_GET['prod_id'])) {
                        $deal_id = $_GET['prod_id'];
                        $role = $_GET['role'];
                        $return_url = "target-pd-deals.php";
                        $query = "select * from pd_close where deal_id='$deal_id' AND type=2";
                        $query_run = mysqli_query($conn, $query);
                        $prodItem = mysqli_fetch_array($query_run);
                        $result = mysqli_query($conn, "select id, deal_id from pd_deals where id='$deal_id'");
                        $data = mysqli_fetch_assoc($result);

                    ?>
                        <div id="samplingContent12" style="display: none;">

                            <div class="card-body">
                                <form action="code.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="master_deal_id" value="<?= $data['deal_id'] ?>">
                                    <input type="hidden" name="deal_id" value="<?= $_REQUEST['prod_id']; ?>">

                                    <input type="hidden" name="return_url" value="<?= $return_url ?>">
                                    <input type="hidden" name="type" value="2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Closed Date</label>
                                                <div class="input-group date" id="cdate" data-target-input="nearest">

                                                    <input type="date" name="close_date" value="<?php echo isset($prodItem['close_date']) ? $prodItem['close_date'] : ''; ?>" class="form-control datetimepicker-input" data-target="#cdate" placeholder="DD-MM-YY" <?= $class; ?> />
                                                    <!-- <div class="input-group-append" data-target="#cdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Product</label>
                                                <input type="text" name="product" value="<?php echo isset($prodItem['product']) ? $prodItem['product'] : ''; ?>" class="form-control" required placeholder="Product" <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <input type="text" name="remarks" value="<?php echo isset($prodItem['remarks']) ? $prodItem['remarks'] : ''; ?>" class="form-control" placeholder="Remarks" required <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Product recd. by</label>
                                                <input type="text" name="product_recd" value="<?php echo isset($prodItem['product_recd']) ? $prodItem['product_recd'] : ''; ?>" class="form-control" placeholder="Product recd. by" required <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Deal Size (in kg)</label>
                                                <input type="text" name="deal_size" value="<?php echo isset($prodItem['deal_size']) ? $prodItem['deal_size'] : ''; ?>" class="form-control" placeholder="Deal Size (in kg)" required <?= $class; ?>>
                                            </div>
                                        </div>
                                        <?php if ($_SESSION['role'] == 1) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Comission (₹)</label>
                                                    <input type="text" name="comission" value="<?php echo isset($prodItem['comission']) ? $prodItem['comission'] : ''; ?>" class="form-control" placeholder="Comission" required <?= $class; ?>>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Report</label>
                                                    <br>
                                                    <a href="pd_deal_process_report.php?prod_id=<?php echo $_GET['prod_id']; ?>">Download Report</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($role == 1 || $role == 2) { ?>
                                            <div class="col-md-2">
                                                <div class="form-group" style="padding-top:30px">
                                                    <button type="submit" name="pd_close_update" class="btn btn-primary btn-block float-right">Update</button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>

</div>

</div>
</section>
</div>

<script>
    function togale(num) {

        document.getElementById('toggleSamplingSection' + num).addEventListener('click', function() {
            var content = document.getElementById('samplingContent' + num);
            var icon = this.querySelector('.toggle-icon');

            if (content.style.display === "none") {
                content.style.display = "block";
                icon.textContent = "-"; // Change to minus
            } else {
                content.style.display = "none";
                icon.textContent = "+"; // Change to plus
            }
        });
    }

    for (let i = 0; i < 13; i++) {
        if (i == 0) {
            togale('');

        } else {
            togale(i);
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buyerBtn = document.getElementById("defaultOpen");
        const supplierBtn = document.getElementById("sellerbutton");
        const buyerDiv = document.getElementById("buyerDiv");
        const sellerDiv = document.getElementById("sellerDiv");

        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
            buyerDiv.style.display = "block";
            sellerDiv.style.display = "none";
            buyerBtn.classList.add("WhyChooseUs__active--YOzBf");
            supplierBtn.classList.remove("WhyChooseUs__active--YOzBf");

        <?php } else if ($_SESSION['role'] == 2) { ?>
            sellerDiv.style.display = "block";
            buyerDiv.style.display = "none";
            supplierBtn.classList.add("WhyChooseUs__active--YOzBf");
            buyerBtn.classList.remove("WhyChooseUs__active--YOzBf");
        <?php } ?>



        // Initially show buyer section
        buyerDiv.style.display = "block";
        sellerDiv.style.display = "none";

        buyerBtn.addEventListener("click", function() {
            // Show buyer, hide seller
            buyerDiv.style.display = "block";
            sellerDiv.style.display = "none";
            buyerBtn.classList.add("WhyChooseUs__active--YOzBf");
            supplierBtn.classList.remove("WhyChooseUs__active--YOzBf");
        });

        supplierBtn.addEventListener("click", function() {
            // Show seller, hide buyer
            sellerDiv.style.display = "block";
            buyerDiv.style.display = "none";
            supplierBtn.classList.add("WhyChooseUs__active--YOzBf");
            buyerBtn.classList.remove("WhyChooseUs__active--YOzBf");
        });
    });
</script>
<script>
    function validateForm() {
        var phoneInput = document.getElementById("phone").value;
        var phonePattern = /^\d{10}$/; // Regular expression for 10-digit phone number

        if (!phonePattern.test(phoneInput)) {
            alert("Please enter a valid 10-digit phone number.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<?php
include("footer.php");
?>