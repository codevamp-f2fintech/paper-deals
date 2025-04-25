<?php
include_once('header.php');
include('../connection/config.php');
$id=$_GET['deal_id'];
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="card-header">
                <h4>
                    Billing History
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Deal ID</th>
                                <th>Buyer</th>
                                <th>Seller</th>
                               <th>Total Amount</th>
                               <th>Pending Amount</th>
                                  <th>Quantity in Kg</th>
                                <th>Price in Kg</th>
                                <th>Date</th>
                                 <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * From pd_deals where deal_status=7 AND deal_id='$id' ORDER BY id DESC";
                            } else {
                                $query = "SELECT * FROM pd_deals WHERE status = 1 AND deal_status < 7 AND deal_id='$id' AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') ORDER BY id DESC";
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
                                            <?php echo $prod_item['deal_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo "PD"; ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['seller_id']); ?>
                                        </td>
                                          <td>
                                            <?php echo $prod_item['deal_amount']; ?>
                                        </td>
                                           <td>
                                                                                        <?php
                                            $dealid=$prod_item['id'];
                                             
                                         
                                            echo (($prod_item['deal_amount'])-(mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) as amount FROM `pd_billing` where deal_id='$dealid'"))['amount'])); ?>
                                        </td>
                                         <td>
                                            <?php echo $prod_item['quantity_in_kg']; ?>
                                        </td>
                                         <td>
                                            <?php echo $prod_item['price_per_kg']; ?>
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
                                        <td>
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                    <li>
                                                        <a href="pd_billing_details.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">
                                                            <?php if ($role == 1) {
                                                                echo 'Edit';
                                                            } else {
                                                                echo 'View';
                                                            } ?>
                                                        </a>
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