<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="card-header">
                <h4>
                    Business History
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Deal ID</th>
                                <th>Seller ID</th>
                                <th>Buyer ID</th>
                                <th>Buyer Company</th>
                                <th>Seller Company</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * From pd_deals where deal_status=7 ORDER BY id DESC";
                            } else {
                                $query = "SELECT * From pd_deals where status=1 AND deal_status < 7 AND (buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "') ORDER BY id DESC";
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
                                            <?= $prod_item['seller_id']; ?>
                                        </td>
                                        <td>
                                            <?= $prod_item['buyer_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['buyer_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['seller_id']); ?>
                                        </td>
                                        <td>
                                            <?php if ($prod_item['status'] == 1) {
                                            ?><a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active <i class="fa-solid fa-globe" style="color:#1C6C09"></i> </a>
                                            <?php
                                            } else {
                                            ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Inactive <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                            <?php
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_on']; ?>
                                        </td>
                                        <!-- ======================= -->
                                        <td style="text-align:center;   ">
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                    <li>
                                                        <a href="edit-pd-deal.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">
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
                <!-- ================= -->
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>