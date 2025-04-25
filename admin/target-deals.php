<?php
include_once('header.php');
include('../connection/config.php');
//echo $_SESSION['id']; die();
?>
<div class="content-wrapper">
    <section class="content ">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="">
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:2% 0 1% 0.6%;">
                    Close Deals
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table  table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Deal ID</th>
                                <?php if ($_SESSION['role'] !== 2) { ?>
                                    <th>Buyer</th>
                                <?php } ?>
                                <th>Seller</th>
                                <th>Contact Person</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Deal Size</th>
                                <th>Deal Amount</th>
                                <th>Product Description</th>
                                <?php if ($role == 1) { ?>
                                    <th>Commission</th>
                                <?php } ?>
                                
                               
                                <th>Remarks</th>
                                <th>Date</th>
                                 <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * From deals where deal_status=7 ORDER BY id DESC";
                            } else {
                                $query = "SELECT * From deals where status=1 AND deal_status=7 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "') ORDER BY id DESC";
                            }
                            //echo $query; die();
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
                                            <?php echo '000' . $prod_item['deal_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['buyer_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['seller_id']); ?>
                                        </td>
                                        <td> <?php echo $prod_item['contact_person']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['mobile_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['email_id']; ?>
                                        </td>

                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>

                                            <td>
                                            <?php echo $prod_item['deal_amount']; ?>
                                        </td>

                                        <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>
                                        <?php if ($role == 1) { ?>
                                            <td>
                                                <?php echo $prod_item['commission']; ?>
                                            </td>
                                        <?php } ?>
                                        
                                           <td style="  border-bottom:1px solid #d3d3d3;">
                    <?php echo $prod_item['remarks']; ?>
                </td>
                <td style="  border-bottom:1px solid #d3d3d3;">
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
                                        <!-- ==================================================================== -->
                                        <style>
                                            #dropdownMenuButton1 {

                                                background-color: #F9FAFB;
                                                text-align: center;

                                                background-size: 200% auto;
                                                color: #007BFF;
                                                box-shadow: 0 0 20px #eee;
                                                border-radius: 4px;

                                                transition: all 0.3s;
                                            }

                                            #dropdownMenuButton1:hover {
                                                background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
                                                color: #767676;
                                                text-decoration: none;
                                            }
                                        </style>
                                        <td style="text-align:center;    ">
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                    <li>
                                                        <!-- <a class=" dropdown-item"
                                                    href="view-details.php?role=<?= $_SESSION['role']; ?>&user_type=2&prod_id=<?= $prod_item['id']; ?>">
                                                    Edit
                                                </a> -->
                                                    </li>

                                                    <?php if ($role == 1 || $role == 2 || $role == 3) { ?>
                                                       
                                                        <li>
                                                            <a href="current-edit-deal.php?role=<?= $_SESSION['role']; ?>&prod_id=<?= $prod_item['id']; ?>" name="change_password" class="dropdown-item"><?php if ($role == 1) {
                                                                                                                                                                                                                echo 'Edit';
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo 'View';
                                                                                                                                                                                                            } ?></a>
                                                        </li>
                                                    <?php } ?>
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
                <td colspan="13" class="dataTables_empty">No Record found</td>
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