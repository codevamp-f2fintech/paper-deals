<?php
include_once ('header.php');
include ('../connection/config.php');
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
                    <?php include ("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:28px;color:#1C2434;margin:40px 0 15px 3px">
                            Create Deal
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-primary">
                            <div class="card-header">
                                <?php
                                $query = mysqli_query($conn, "Select deal_id from deals order by id desc");
                                $row = mysqli_fetch_array($query);

                                $id = $row['deal_id'];
                                $deal_id = $id + 1;
                                ?>
                                <h3 class="card-title">Enquiry Id :
                                    <input type="text" name="enq_id" id="enq_id" value="">
                                </h3>

                                <h3 class="card-title" style="float:right">Creation Date :
                                    <?= date('Y-m-d'); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger w-50 d-none" id="msg" role="alert">
                                This Id not contain Record
                            </div>
                            <form action="code.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                                <input type="hidden" name="deal_id" value="<?= $deal_id; ?>">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Buyer</label>
                                              <input type="text" name="buyer" class="form-control" required
                                                placeholder="Buyer" id="buyer">
                                                <input type="hidden" name="buyerid" class="form-control" id="buyerid">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seller</label>
                                            <select class="form-control" name="seller" required="" id="seller">
                                                <option value="">--Select Seller--</option>
                                                <?php
                                                $query = mysqli_query($conn, "Select users.id,users.user_type,users.name,organization.id,organization.user_id,organization.organizations from users LEFT JOIN organization on organization.user_id=users.id where users.user_type = 2");
                                        
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                    <option value="<?= $row['user_id'] ?>">
                                                        <?= $row['organizations'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Size in inch</label>
                                            <input type="text" name="deal_size" class="form-control" required
                                                placeholder="Deal Size" id="deal_size">
                                        </div>
                                    </div>
                                     
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Buyer Contact Person </label>
                                            <input type="text" name="bcontact_person" class="form-control" required
                                                placeholder="Name" id="name">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seller Contact Person</label>
                                            <input type="text" name="scontact_person" class="form-control" required
                                                placeholder="Name" id="sname">
                                        </div>
                                    </div>
                                         <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brightness</label>
                                            <input type="text" name="brightness" class="form-control" required
                                                placeholder="Brightness" id="brightness">
                                                    <input type="hidden" name="category" class="form-control" required
                                                placeholder="category" id="category">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Buyer Mobile Number:</label>
                                            <input type="phone" name="bmobile_no"
                                                onKeyPress="if(this.value.length==10) return false;"
                                                class="form-control" id="bphone" required placeholder="Buyer Mobile Number">
                                        </div>
                                    </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seller Mobile Number</label>
                                            <input type="phone" name="sphone"
                                                onKeyPress="if(this.value.length==10) return false;"
                                                class="form-control" id="sphone" required placeholder="Seller Mobile Number">
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                             <div class="form-group">
                                            <label>Product</label>
                                            <textarea name="product_desc" rows="1" class="form-control"
                                                placeholder="Product Description" required id="product_desc"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Buyer Email</label>
                                            <input type="email" name="bemail" id="bemail" class="form-control"
                                                placeholder="Buyer Email" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seller Email</label>
                                            <input type="email" name="semail"
                                                class="form-control" id="semail" required placeholder="Seller Email">
                                        </div>
                                    </div>
                               
                                
                               
                                 <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Technical Data Sheet</label>
                                            <input type="file" name="tds" class="form-control">
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea name="remarks" rows="1" class="form-control"
                                                placeholder="Enter Remarks" id="remarks"></textarea>
                                        </div>
                                    </div>
                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Deal Amount</label>
                                            <input type="text" name="deal_amount" class="form-control" required
                                                placeholder="Deal Amount" id="deal_size">
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-top:30px">
                                        <div class="form-group">
                                            <button type="submit" name="create_deal"
                                                class="btn btn-primary btn-block">Submit</button>
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

    var input = document.getElementById("enq_id");

    input.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            var id = input.value;

            $.ajax({
                url: "deal_fetch.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function (result) {
               
                    // console.log(result);
                    if (result) {
                        console.log(result);
                        $('#bphone').val(result.phone);
                        $('#sphone').val(result.phone_no);
                        $('#buyer').val(result.company_name);
                        $('#remarks').val(result.remarks);
                        $('#deal_size').val(result.size);
                        $('#sname').val(result.sname);
                        $('#product_desc').val(result.product);
                        $('#name').val(result.name);
                        $('#buyerid').val(result.buyer_id);
                        $('#brightness').val(result.brightness);
                        $('#semail').val(result.email_address);
                        $('#bemail').val(result.email);category
                         $('#category').val(result.category_id);
                        document.getElementById("seller").value = result.user_id;


                    }




                }
            });

        }
    });

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
include ("footer.php");
?>