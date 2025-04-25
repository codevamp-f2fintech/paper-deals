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
                    <div>
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:2% 0 1% 0.6%;">
                            Create PD Deal
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-primary">
                            <div class="card-header">
                                <?php
                                $query = mysqli_query($conn, "Select id from pd_deals_master order by id desc");
                                $row = mysqli_fetch_array($query);

                                $id = $row['id'];
                                $deal_id = $id + 1;
                                ?>
                                <h3 class="card-title">Enquiry Id :
                                    000<?= $deal_id; ?>
                                </h3>
                                <h3 class="card-title" style="float:right">Creation Date :
                                    <?= date('Y-m-d'); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" onsubmit="return validateForm()">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PD Executive</label>

                                            <?php
                                            $Id = $_SESSION['id'];
                                            $query = mysqli_query($conn, "Select * from users where user_type=1 and active_status=1 AND id=$Id");
                                            $data = mysqli_fetch_assoc($query);
                                            ?>


                                            <input type="text" readonly name="user_id_bkp" onKeyPress="if(this.value.length==10) return false;" class="form-control" required placeholder="Mobile Number" value="<?php echo $data['name']; ?>">
                                            <input type="hidden" readonly name="user_id" value="<?php echo $Id; ?>">


                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" name="contact_person" class="form-control" required placeholder="Contact Person" value="<? //$_REQUEST['contact_person'] 
                                                                                                                                                        ?>">
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile Number:</label>
                                            <input type="phone" readonly name="mobile_no" onKeyPress="if(this.value.length==10) return false;" class="form-control" id="phone" required placeholder="Mobile Number" value="<?php echo $data['phone_no']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                            <select class="form-control" name="buyer" required="">
                                                <option value="">--Select Buyer--</option>
                                                <?php
                                                // $query = mysqli_query($conn, "Select * from users where user_type=3 and active_status=1");
                                                $query = mysqli_query($conn, "SELECT users.*, organization.organizations, organization.contact_person
                                                FROM users 
                                                LEFT JOIN organization ON users.id = organization.user_id 
                                                WHERE users.user_type = 3 
                                                AND users.active_status = 1 
                                                ORDER BY users.id");
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?= $row['id'] ?>">
                                                        <?= $row['name'] ?>- <?php if ($_SESSION['role'] == 1) {
                                                                                    echo $row['phone_no'];
                                                                                } ?>
                                                        <?php if ($_SESSION['role'] == 1) {
                                                        ?>-<?php echo $row['organizations'];
                                                        } ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required placeholder="Email" value="<? //$_REQUEST['email'] 
                                                                                                                                        ?>">
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Description</label>
                                            <input type="text" name="product_desc" class="form-control" placeholder="Product Description" required value="<?= $_REQUEST['product_desc'] ?>">
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <label>Deal Size(in ton)</label>
                                            <input type="text" name="deal_size" class="form-control" required placeholder="Deal Size" value="<?= $_REQUEST['deal_size'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Deal Amount</label>
                                            <input type="text" name="deal_amount" class="form-control" required placeholder="Deal Amount" value="<?= $_REQUEST['deal_amount'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="padding-top:30px">
                                        <div class="form-group">
                                            <button type="submit" name="create_pd_deal" class="btn btn-primary btn-block">Submit</button>
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