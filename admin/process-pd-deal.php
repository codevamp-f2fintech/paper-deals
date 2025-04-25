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
?>
<div class="content-wrapper">
    <section class="content mt-2">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="card-header">
                        <h4>
                            Process PD Deal
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-primary">
                            <div class="card-header">
                                <?php
                                $query = mysqli_query($conn, "Select * from pd_deals_master where id='" . $_REQUEST['prod_id'] . "'");
                                $data = mysqli_fetch_array($query);
                                ?>
                                <h3 class="card-title">Deal Id :
                                    000<?= $data['id']; ?>
                                </h3>
                                <h3 class="card-title" style="float:right">Creation Date :
                                    <?= date('Y-m-d'); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" onsubmit="return validateForm()">
                                <input type="hidden" name="deal_id" class="form-control" value="<?= $data['id']; ?>">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                            <input type="hidden" name="buyer" value="<?= $data['buyer_id']; ?>" />

                                            <?php
                                            $u_id = $data['buyer_id'];

                                            $query2 = mysqli_query($conn, "SELECT users.*, organization.organizations, organization.contact_person,organization.phone
                                                FROM users 
                                                LEFT JOIN organization ON users.id = organization.user_id 
                                                WHERE users.active_status = 1 
                                                AND users.id = $u_id");

                                            $data2 = mysqli_fetch_assoc($query2);

                                            ?>

                                            <input type="text" readonly name="buyer_bkp" class="form-control" required placeholder="Buyer" value="<?php echo $data2['name']; ?>">
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

                                            <input type="text" readonly name="buyer_bkp" class="form-control" required placeholder="Mobile No." value="<?php echo $data2['phone_no']; ?>">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PD Executive</label>
                                            <input type="hidden" name="user_id" value="<?= $data['user_id']; ?>" />
                                            <?php
                                            $Id = $_SESSION['id'];
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Seller</label>
                                            <select style="width:510px;" class="form-control" name="seller" required="">
                                                <option value="">--Select Seller--</option>
                                                <?php
                                                // $query = mysqli_query($conn, "Select * from users where user_type=2 and active_status=1");
                                                $query = mysqli_query($conn, "SELECT users.*, organization.organizations, organization.contact_person
                                                FROM users 
                                                LEFT JOIN organization ON users.id = organization.user_id 
                                                WHERE users.user_type = 2 
                                                AND users.active_status = 1 
                                                ORDER BY users.id");
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?= $row['id'] ?>">
                                                        <?= $row['name'] ?> - <?php if ($_SESSION['role'] == 1) {
                                                                                    echo $row['phone_no'];
                                                                                } ?>
                                                        -<?php if ($_SESSION['role'] == 1) {
                                                                echo $row['organizations'];
                                                            } ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea name="product_desc" rows="1" class="form-control" placeholder="Product Description" required readonly><?= $data['product_description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Deal Size (in ton)</label>
                                            <input type="text" name="deal_size" class="form-control" required placeholder="Deal Size" value="<?= $data['deal_size'] ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Balanced Deal Size (in ton)</label>
                                            <input type="text" name="balanced_deal_size" class="form-control" required placeholder="Deal Size" value="<?= $data['balanced_deal_size'] ?>" readonly>
                                        </div>
                                    </div>
                                    <?php if ($data['balanced_deal_size'] > 0) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Allotted Deal Size (in ton)</label>
                                                <input type="number" name="Allotted_deal_size" class="form-control" required placeholder="Deal Size" max="<?= $data['balanced_deal_size']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Total Deal Amount</label>
                                                <input type="text" name="total_deal_amount" class="form-control" required placeholder="Deal Size" value="<?= $data['total_deal_amount'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Deal Amount</label>
                                                <input type="text" name="deal_amount" class="form-control" required placeholder="Deal Amount" value="<?= $data['deal_amount'] ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Buyer Commission(₹)</label>
                                            <input type="text" name="buyer_commission" class="form-control" required placeholder="Buyer Commission" value="<?= $_REQUEST['buyer_commission'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seller Commission(₹)</label>
                                            <input type="text" name="seller_commission" class="form-control" required placeholder="Seller Commission" value="<?= $_REQUEST['seller_commission'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="text" name="remarks" class="form-control" placeholder="Enter Remarks" value="<?= $_REQUEST['remarks'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="padding-top:30px">
                                        <div class="form-group">
                                            <?php if ($data['balanced_deal_size'] > 0) { ?>
                                                <button type="submit" name="process_pd_deal" class="btn btn-primary btn-block">Submit</button>
                                            <?php } ?>
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
<?php
include("footer.php");
?>