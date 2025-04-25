<?php
include_once ('header.php');
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
                                Add Admin
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" onsubmit="return validateForm()">
                                <div class="row">
                                    <input type="hidden" value="1" name="active_status">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Admin Name</label>
                                            <input type="text" name="name" class="form-control" required
                                                placeholder="Enter Admin Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email ID</label>
                                            <input type="email" name="email_address" class="form-control" required
                                                rows="3" placeholder="Email ID" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" required
                                                placeholder="Enter Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="phone" name="phone_no"
                                                onKeyPress="if(this.value.length==10) return false;" id="phone"
                                                class="form-control" required placeholder="Enter Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>WhatsApp Number</label>
                                            <input type="phone" name="whatsapp_no"
                                                onKeyPress="if(this.value.length==10) return false;" id="whatsapp"
                                                class="form-control" required placeholder="Enter WhatsApp Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-white">Save</label>
                                            <button type="submit" name="admin_save"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                View Admin
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Admin Name</th>
                                        <th>Email ID</th>
                                        <th>Phone</th>
                                        <th>WhatsApp Number</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * From users where user_type='1' ORDER BY id ";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $i = 1;
                                        foreach ($query_run as $prod_item) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['email_address']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['phone_no']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['whatsapp_no']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_on']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($prod_item['active_status'] == 1) {
                                                        ?><a class="badge badge-success">Active</a>
                                                        <?php
                                                    } else {
                                                        ?><a class="badge badge-danger">Inactive</a>
                                                        <?php
                                                    } ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <div class="hide">
                                                        <a href="edit_admin.php?role=4&prod_id=<?php echo $prod_item['id']; ?>"
                                                            class="btn btn-success">Edit</a>
                                                        <hr>
                                                        <?php if ($role == 4) { ?>
                                                            <?php if ($prod_item['active_status'] == '1') { ?>
                                                                <form action="code.php" method="post">
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?= $prod_item['id']; ?>">
                                                                    <button type="submit" name="deactive_admin"
                                                                        class="btn btn-danger">Deactive</button>
                                                                </form>
                                                            <?php } else { ?>
                                                                <form action="code.php" method="post">
                                                                    <input type="hidden" name="user_id"
                                                                        value="<?= $prod_item['id']; ?>">
                                                                    <button type="submit" name="active_admin"
                                                                        class="btn btn-danger">Active</button>
                                                                </form>
                                                            <?php } ?>
                                                            <hr>
                                                            <a href="change_password.php?prod_id=<?php echo $prod_item['id']; ?>"
                                                                name="change_password" class="btn btn-primary">
                                                                Change Passsword</a>
                                                        </div>
                                                        <a href="#" class="action_div"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                                        } else {
                                                            ?>
                                                <tr>
                                                    <td colspan="13" class="dataTables_emaster_productty">No Record found</td>
                                                </tr>
                                                <?php
                                                        }
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
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
<?php include_once ('footer.php'); ?>