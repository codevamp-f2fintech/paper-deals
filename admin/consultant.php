<?php
include_once('header.php'); ?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">
                            Add Consultant
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" value="1" name="active_status">
                                    <input type="hidden" value="5" name="user_type">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Consultant Name</label>
                                            <input type="text" name="name" class="form-control" required placeholder="Enter Consultant Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email ID</label>
                                            <input type="email" name="email_address" class="form-control" required rows="3" placeholder="Email ID" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" required placeholder="Enter Password" autocomplete="off">
                                        </div>
                                    </div>
                                         <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" name="price" class="form-control" required placeholder="Enter Price" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="phone" name="phone_no" onKeyPress="if(this.value.length==10) return false;" id="phone" class="form-control" required placeholder="Enter Phone">
                                        </div>
                                    </div>
                                          <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Years of Experience</label>
                                            <input type="text" name="years_of_experience" class="form-control" required placeholder="Enter Years of Experience">
                                        </div>
                                    </div>
                                          <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mills Supported</label>
                                            <input type="text" name="mills_supported" class="form-control" required placeholder="Enter Phone">
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>WhatsApp Number</label>
                                            <input type="phone" name="whatsapp_no" onKeyPress="if(this.value.length==10) return false;" id="whatsapp" class="form-control" required placeholder="Enter WhatsApp Number">
                                        </div>
                                    </div>
                                    <style>
                                        #lmm>input {
                                            border-radius: 4px;
                                        }

                                        #lmm>input::file-selector-button {
                                            /* font-weight: bold; */
                                            height: 35px;
                                            color: #666666;

                                            border: thin solid grey;
                                            border-radius: 3px;
                                        }
                                    </style>
                                    <div class="col-md-4">
                                        <div class="form-group" id="lmm">
                                            <label>Upload Image</label>
                                            <input type="file" name="prof_pic" class="border" style="width:100%" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea type="text" style="height:37px;resize:none;overflow:none;" name="description" class="form-control" required placeholder="Enter Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="text-white">Save</label>
                                            <button type="submit" name="consultant_save_panel" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">
                            View Consultant
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table " id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Consultant Name</th>
                                        <th>Email ID</th>
                                        <th>Phone</th>
                                                                                <th>Price</th>

                                        <th>WhatsApp Number</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * From users where user_type='5' ORDER BY id DESC";
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
                                                    <?php echo $prod_item['consultant_price']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['whatsapp_no']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_on']; ?>
                                                </td>
                                                <td>
                                                    <?php if ($prod_item['active_status'] == 1) {
                                                    ?><a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active <i class="fa-solid fa-globe" style="color:#1C6C09"></i> </a>
                                                    <?php
                                                    } else {
                                                    ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Inactive <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                                    <?php
                                                    } ?>
                                                </td>

                                                <!-- ================= -->
                                                <td style="text-align:center;   ">
                                                    <div class=" dropdown">
                                                        <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                            <li>
                                                                <a href="edit_consultant.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">Edit</a>
                                                            </li>
                                                            <hr>
                                                            <?php if ($role == 1) { ?>
                                                                <?php if ($prod_item['active_status'] == '1') { ?>
                                                                    <li>
                                                                        <form action=" code.php" method="post">
                                                                            <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                            <button type="submit" name="deactive_consultant" class="dropdown-item">Deactive</button>
                                                                        </form>
                                                                    </li>
                                                                <?php } else { ?>
                                                                    <li>
                                                                        <form action="code.php" method="post">
                                                                            <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                            <button type="submit" name="active_consultant" class="dropdown-item">Active</button>
                                                                        </form>
                                                                    </li>
                                                                <?php } ?>
                                                                <hr>
                                                                <li> <a href=" change_password.php?role=5&prod_id=<?php echo $prod_item['id']; ?>" name="change_password" class="dropdown-item">
                                                                        Change Passsword</a>
                                                                </li>
                                                        </ul>
                                                    </div>
                        </div>
                        </td>
                        <!-- ========================== -->
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</script>
<?php include_once('footer.php'); ?>