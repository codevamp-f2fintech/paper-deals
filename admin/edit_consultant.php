<?php
include_once('header.php'); ?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
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
            <div class="row">
                <?php
                if (isset($_GET['prod_id'])) {
                    $product_id = $_GET['prod_id'];
                    $role_id = $_GET['role'];

                    $query = "SELECT users.*, consultant_pic.prof_pic, consultant_pic.description,consultant_pic.years_of_experience,consultant_pic.mills_supported, consultant_pic.user_id
                    FROM users 
                    LEFT JOIN consultant_pic ON users.id = consultant_pic.user_id 
                    WHERE users.id = '$product_id'
                    ORDER BY users.id";
                    
// $query = "SELECT users.*, consultant_pic.*
// FROM users
// JOIN consultant_pic ON users.id = consultant_pic.user_id
// WHERE users.id ='$product_id'";
// echo $query;exit



                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                ?>
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="mt-4">
                                <h4 style="font-size:25px;color:#1C2434;margin:40px 0 20px 3px">
                                    Edit Consultant
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                                        <input type="hidden" name="consultant_id" value="<?= $prodItem['id'] ?>"></input>
                                        <input type="hidden" name="user_id" value="<?= $prodItem['id'] ?>"></input>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Consultant Name</label>
                                                    <input type="text" name="name" value="<?= $prodItem['name']; ?>" class="form-control" required placeholder="Enter Admin Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email ID</label>
                                                    <input type="email" name="email_address" value="<?= $prodItem['email_address']; ?>" class="form-control" required rows="3" placeholder="Email ID" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="phone" name="phone_no" onKeyPress="if(this.value.length==10) return false;" id="phone" value="<?= $prodItem['phone_no']; ?>" class="form-control" required placeholder="Enter Phone">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="phone" name="price" value="<?= $prodItem['consultant_price']; ?>" class="form-control" required placeholder="Enter Price">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>WhatsApp Number</label>
                                                    <input type="phone" name="whatsapp_no" onKeyPress="if(this.value.length==10) return false;" id="whatsapp" value="<?= $prodItem['whatsapp_no']; ?>" class="form-control" required placeholder="Enter WhatsApp Number">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Years of Experience</label>
                                            <input type="text" name="years_of_experience" class="form-control" required placeholder="Enter Years of Experience" value="<?= $prodItem['years_of_experience']; ?>">
                                        </div>
                                    </div>
                                          <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mills Supported</label>
                                            <input type="text" name="mills_supported" class="form-control" required placeholder="Enter Mills Supported" value="<?= $prodItem['mills_supported']; ?>">
                                        </div>
                                    </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="gmm">
                                                    <label>Upload Image</label>
                                                    <input type="file" name="prof_pic" class="border" style="width:100%">
                                                    <input type="hidden" name="old_prof_pic" value="<?= $prodItem['prof_pic']; ?>">
                                                    <?php if (!empty($prodItem['prof_pic'])) { ?>
                                                        <a href="download_consultant_add.php?prod_id=<?php echo $product_id; ?>">Download
                                                            Now</a> | <a href="<?= $prodItem['prof_pic']; ?>" target="_blank">View
                                                            Document</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea type="text" name="description" class="form-control" required placeholder="Enter Description"><?= $prodItem['description']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="text-white">Update</label>
                                                    <button type="submit" name="consultant_update" class="btn btn-primary btn-block">Update</button>
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
include("footer.php");
?>
</div>
</div>

</section>
</div>
<?php include_once('footer.php'); ?>