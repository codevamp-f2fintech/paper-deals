<?php
include_once ('header.php'); ?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <?php
                if (isset($_GET['prod_id'])) {
                    $product_id = $_GET['prod_id'];
                    $role_id = $_GET['role'];
                    $query = "select * from users where id='$product_id'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                        ?>
                        <div class="col-md-12">
                            <?php include ("message.php"); ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        Edit Admin
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="post" onsubmit="return validateForm()">
                                        <input type="hidden" name="admin_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Admin Name</label>
                                                    <input type="text" name="name" value="<?= $prodItem['name']; ?>"
                                                        class="form-control" required placeholder="Enter Admin Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email ID</label>
                                                    <input type="email" name="email_address"
                                                        value="<?= $prodItem['email_address']; ?>" class="form-control" required
                                                        rows="3" placeholder="Email ID" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="phone" name="phone_no"
                                                        onKeyPress="if(this.value.length==10) return false;" id="phone"
                                                        value="<?= $prodItem['phone_no']; ?>" class="form-control" required
                                                        placeholder="Enter Phone">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>WhatsApp Number</label>
                                                    <input type="phone" name="whatsapp_no"
                                                        onKeyPress="if(this.value.length==10) return false;" id="whatsapp"
                                                        value="<?= $prodItem['whatsapp_no']; ?>" class="form-control" required
                                                        placeholder="Enter WhatsApp Number">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="text-white">Update</label>
                                                    <button type="submit" name="admin_update"
                                                        class="btn btn-primary btn-block">Update</button>
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
<script>
    function validateForm() {
        var phoneInput = document.getElementById("phone").value;
        var whatsappInput = document.getElementById("whatsapp").value;
        var phonePattern = /^\d{10}$/; // Regular expression for 10-digit phone number

        if (!phonePattern.test(phoneInput)) {
            alert("Please enter a valid 10-digit phone number.");
            return false; // Prevent form submission
        }

        if (!phonePattern.test(whatsappInput)) {
            alert("Please enter a valid 10-digit WhatsApp number.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
<?php
include ("footer.php");
?>
</div>
</div>

</section>
</div>
<?php include_once ('footer.php'); ?>