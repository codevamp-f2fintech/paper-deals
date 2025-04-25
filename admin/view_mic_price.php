<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="mt-4">
                <h4 style="font-size:25px;color:#1C2434;margin:40px 0 20px 3px">
                    <?php if ($role == 4) {
                        echo "Live Stock";
                    } else { ?> View Live Stock<?php } ?>
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table " id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Seller</th>
                                <th>Shade</th>
                                <th>Gsm</th>
                                <th>Size</th>
                                <th>Weight</th>
                                <th>Stock in Kg</th>
                                <th>Price Per Kg</th>
                                <th>Quantity in Kg</th>
                                <th>Updated_at</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                // $query = "SELECT * From spot_price where status='1' ORDER BY id DESC";
                                $query = "SELECT * FROM `spot_price` LEFT JOIN product_new on product_new.id=spot_price.product_id left JOIN users on users.id=product_new.seller_id";
                            } else if ($_SESSION['role'] == 2) {
                                $query = "SELECT spot_price.*,product_new.*,users.name FROM `spot_price` JOIN product_new on product_new.id=spot_price.product_id JOIN users on users.id=spot_price.seller_id
                                and id='" . $_SESSION["id"] . "' ORDER BY id DESC";
                            }
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                                    // echo "<pre>";
                                    // print_r($prod_item);
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php
                                            // $sql = "Select * from product where id=$prod_item[product_id]";
                                            // $query_run = mysqli_query($conn, $sql);
                                            // if (mysqli_num_rows($query_run) > 0) {
                                            //     foreach ($query_run as $item) {
                                            //         echo $item['product_name'];
                                            //     }
                                            // }
                                            ?>

                                            <?php echo $prod_item['product_name']; ?>

                                        </td>
                                        <td>
                                            <?php
                                          $s_id=$prod_item['id'];
                                                   
                                                    $sql = "SELECT * FROM `organization` where user_id='$s_id'";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    $data=mysqli_fetch_assoc($query_run);
                                                       
                                              
                                                    ?>
                                                    <?php echo $data['organizations']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['shade']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['gsm']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['weight']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['stock_in_kg']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['spot_price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['stock_in_kg']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_at']; ?>
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
                                        <td style="text-align:center;   ">
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                    <?php if ($role == 1 || $role == 2) { ?>
                                                        <li><a href="edit_mic_price.php?role=1&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">Edit</a> </li><?php } else { ?>
                                                        <li> <a href="see_mic_price.php?role=1&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">View</a></li>
                                                    <?php } ?>
                                                    <?php if ($role == 1 || $role == 2 || $role == 3) { ?>
                                                        <hr><?php } ?>
                                                    <?php if ($role == 1 || $role == 4 || $role == 2) { ?>
                                                        <?php if ($prod_item['status'] == 1) { ?>
                                                            <?php if ($role == 1 || $role == 2) { ?>
                                                                <li>
                                                                    <form action="code.php" method="post">
                                                                        <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                        <button type="submit" name="sp_deactive_user" class="dropdown-item">Deactive</button>
                                                                    </form>
                                                                </li><?php } ?>
                                                        <?php } else { ?>
                                                            <?php if ($role == 1 || $role == 2) { ?>
                                                                <li>
                                                                    <form action="code.php" method="post">
                                                                        <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                        <button type="submit" name="sp_active_user" class="dropdown-item">Active</button>
                                                                    </form>
                                                                </li> <?php } ?>
                                                        <?php } ?>
                                                        <?php if ($role == 1 || $role == 2) { ?>
                                                            <hr><?php } ?>
                                                        <?php if ($role == 1 || $role == 2) { ?>
                                                            <li>
                                                                <form action="code.php" method="post">
                                                                    <input type="hidden" name="delete_id" value="<?= $prod_item['id']; ?>">
                                                                    <button type="submit" name="spot_price_delete_btn" class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li> <?php } ?>
                                                </ul>
                                            </div>
                </div>
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