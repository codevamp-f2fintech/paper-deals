<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="card-header">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:0% 0 0.5% 0.6%;">
                    Buyer
                    <a href="add-user.php?role=3" class="btn btn-primary float-right">Add Buyer</a>
                </h4>

            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr style="border:none !important  ;text-align:center  ">
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">ID</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Company Id</th>

                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Company Name</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Buyer Name</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Buyer Email</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Buyer Phone</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Status</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Listing Status</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb; ;border-right:1px solid #dbdbdb">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $query = "SELECT users.*, organization.organizations, organization.contact_person
                            // FROM users 
                            // LEFT JOIN organization  ON users.id = organization.user_id where users.user_type=3 ORDER BY users.active_status ASC";
                            $query = "SELECT users.*, organization.organizations, organization.contact_person
                            FROM users 
                            LEFT JOIN organization  ON users.id = organization.user_id where users.user_type=3 ORDER BY users.id ASC";
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $j = 1;
                                foreach ($query_run as $prod_item) {

                                    // echo $row['name'];
                            ?>
                                    <tr>
                                        <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php echo $j; ?>
                                        </td>
                                          <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php echo 'KPDB_'.$prod_item['id']; ?>
                                        </td>
                                        <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php echo $prod_item['organizations']; ?>
                                        </td>

                                        <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php echo $prod_item['name']; ?>
                                        </td>
                                        <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php echo $prod_item['email_address']; ?>
                                        </td>
                                        <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php echo $prod_item['phone_no']; ?>
                                        </td>
                                        <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php if ($prod_item['active_status'] == 1) {
                                            ?><a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active <i class="fa-solid fa-globe" style="color:#1C6C09"></i> </a>
                                            <?php
                                            } elseif ($prod_item['active_status'] == 0) {
                                            ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Inactive <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                            <?php

                                            } 
                                           // else {
                                            ?>
                                            <!-- <a style="width:100px ;border:1px solid #BC3803;padding:4px; height:20px;font-size:13px; color:#BC3803;background-color:#FFEFCA; border-radius:6px;">Pending <i class="fa-regular fa-clock" style="color:#BC3803"></i></a> -->
                                            <?php
                                            //}
                                            ?>
                                        </td>
                                          <td style="border:none; border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php if ($prod_item['approved'] == 1) {
                                            ?><a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active <i class="fa-solid fa-globe" style="color:#1C6C09"></i> </a>
                                            <?php
                                            } elseif ($prod_item['approved'] == 0) {
                                            ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Pending <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                            <?php

                                            } 
                                          
                                            ?>
                                        </td>
                                        <style>
                                            #dropdownMenuButton1 {

                                                /* background-color: #F9FAFB; */
                                                text-align: center;

                                                background-size: 200% auto;
                                                color: #007BFF;
                                                /* box-shadow: 0 0 20px #eee; */
                                                border-radius: 4px;

                                                transition: all 0.3s;
                                            }

                                            #dropdownMenuButton1:hover {
                                                background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
                                                color: #767676;
                                                text-decoration: none;
                                            }
                                        </style>
                                        <td style="text-align:center;border-bottom:1px solid #f9f9f9;  ">
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                    <li>
                                                        <a class=" dropdown-item" href="view-details.php?role=<?php echo $_SESSION['role'];  ?>&user_type=3&prod_id=<?= $prod_item['id']; ?>">
                                                            Edit
                                                        </a>
                                                    </li>

                                                    <?php if ($role == 1) { ?>
                                                        <?php if ($prod_item['active_status'] == '1') { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                <input type="hidden" name="role" value="<?= $prod_item['user_type']; ?>">
                                                                <li>
                                                                    <button type="submit" name="deactive_user" class="dropdown-item">Deactive</button>
                                                                </li>
                                                            </form>
                                                        <?php } else { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                <input type="hidden" name="role" value="<?= $prod_item['user_type']; ?>">
                                                                <li>
                                                                    <button type="submit" name="active_user" class="dropdown-item">Active</button>
                                                                </li>
                                                            </form>
                                                        <?php } ?>
                                                        <li>
                                                            <a href="change_password.php?role=<?= $_SESSION['role']; ?>&prod_id=<?= $prod_item['id']; ?>" name="change_password" class="dropdown-item">Change Password</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>


                </div>




                </td>
                </tr>

            <?php
                                    $j++;
                                }
                            } else {
            ?>
            <tr>
                <td class="colspan-8">No Record found</td>
            </tr>
        <?php
                            }
        ?>

        </tbody>
        </table>
            </div>
        </div>
</div>
</section>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</script>
<?php
include("footer.php");
?>