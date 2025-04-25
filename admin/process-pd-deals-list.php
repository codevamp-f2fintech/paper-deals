<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div>
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:2% 0 1% 0.6%;">
                    Process PD Deals
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table table-responsive" id="process">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Deal Id</th>
                                <th>PD Executive</th>
                                <th>Buyer</th>
                                <th>Contact Person</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th style="width:150px;">Deal Size (in ton)</th>
                                <th>Product Description</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * From pd_deals_master where status = 1 and deal_status!=7  OR balanced_deal_size!=0  ORDER BY id DESC";
                            // echo $query;
                            // die();
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
                                            000<?php echo $prod_item['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['user_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['buyer_id']); ?>
                                        </td>

                                        <td>
                                            <?php
                                            $Id = $prod_item['buyer_id'];
                                            $query = mysqli_query($conn, "Select * from users where active_status=1 AND id=$Id");
                                            $data = mysqli_fetch_assoc($query);
                                            echo $data['name']; ?>
                                        </td>
                                        <td style="width:150px;">
                                            <?php

                                            echo $data['phone_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['email_address']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>

                                        <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>


                                        <td>
                                            <?php echo $prod_item['created_on']; ?>
                                        </td>
                                        <td>
                                            <?php if ($prod_item['status'] == 1) {
                                            ?><a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active </a>
                                            <?php
                                            } else {
                                            ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">inactive </a>
                                            <?php
                                            } ?>
                                        </td>




                                        <td style="text-align:center;   ">
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                    <li>
                                                        <a href="process-pd-deal.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item"> Create Deal</button>
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
                <td colspan="17">No Record or Data found</td>
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
<?php
include("footer.php");
?>