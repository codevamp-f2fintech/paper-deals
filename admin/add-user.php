<?php
include_once ('header.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_number = $_POST["phone"];
    $whatsapp_number = $_POST["whatsapp"];
    // Remove all characters except digits
    $phone_number = preg_replace('/[^0-9]/', '', $phone_number);
    $whatsapp_number = preg_replace('/[^0-9]/', '', $whatsapp_number);
    // Check if the phone number is exactly 10 digits
    if (strlen($phone_number) === 10) {
        echo "Phone number is valid: " . $phone_number;
    } else {
        echo "Please enter a valid 10-digit phone number.";
    }
    if (strlen($whatsapp_number) === 10) {
        echo "WhatsApp number is valid: " . $whatsapp_number;
    } else {
        echo "Please enter a valid 10-digit WhatsApp number.";
    }
}
?>

<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <?= IsUser_Role($_REQUEST['role']) ?> - ADD
                    </h4>
                </div>
                <div class="card-body">
                    <form class="user_add_form" action="code.php" method="POST" onsubmit="return validateForm()">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required
                                        placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <span class="email_error text-danger ml-2"></span>
                                    <input type="email" name="email_address" class="form-control email_id" required
                                        rows="3" placeholder="Enter Email">
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
                                    <input type="phone" name="phone_no"
                                        onKeyPress="if(this.value.length==10) return false;" id="phone"
                                        class="form-control" required placeholder="Enter Mobile">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Join Date</label>
                                    <div class="input-group date" id="datemask2" data-target-input="nearest">
                                        <input type="text" name="join_date" class="form-control datetimepicker-input"
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
                                    <input type="phone" name="whatsapp"
                                        onKeyPress="if(this.value.length==10) return false;" id="whatsapp"
                                        class="form-control" placeholder="WhatsApp No.">
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control">
                                    <option>--Select Status--</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div> -->
                            <hr>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" name="add_user"
                                        class="btn btn-primary btn-block float-left">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function () {
        $('.email_id').keyup(function (e) {
            var email = $('.email_id').val();
            // console.log(email);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: {
                    'check_Emailbtn': 1,
                    'email_address': email_id,
                },
                success: function (response) {
                    // console.log(response);  
                    $('.email_error').text(response);
                }
            });
        });
    });
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