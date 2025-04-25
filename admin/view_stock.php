<?php
include_once('header.php');
include('../connection/config.php');
$user_id = $_SESSION['id'];
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="card-header">
                        <h4>
                            View Stock
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-responsive" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Seller</th>
                                        <th>Product</th>
                                        <th>BF</th>
                                        <th>GSM</th>
                                        <th style="padding: 9px;">W x L</th>
                                        <th>Size in inch</th>
                                        <th>Shade</th>
                                        <th>Grain</th>
                                        <th>Sheets</th>
                                        <th>Rim Weight</th>
                                        <th>No of Rim</th>
                                        <th>brightness</th>
                                        <th>Stock in Kg</th>
                                        <th>No. of Bundle</th>
                                        <th>Price in Kg</th>
                                        <th>Quantity in Kg</th>
                                        <th>Other</th>
                                        <th>Created At</th>

                                        <?php if ($_SESSION['role'] != 2) { ?>
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        <?php } ?>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                        $query = "SELECT * From product_new ORDER BY id DESC";
                                    } else {
                                        $query = "SELECT * FROM product_new WHERE seller_id='$user_id' ORDER BY id DESC";
                                    }

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
                                                    <?php echo $prod_item['category_id'];
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    $id = $prod_item['seller_id'];
                                                    $sql = "SELECT organizations,id,user_id FROM `organization` where user_id='$id'";
                                                    $run = mysqli_query($conn, $sql);
                                                    $users = mysqli_fetch_assoc($run);
                                                    echo $users['organizations'];

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['product_name'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['bf'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['gsm'];
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php echo $prod_item['w_l'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?=
                                                    $prod_item['size'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?=
                                                    $prod_item['shade'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['grain'];
                                                    ?>
                                                </td>


                                                <td>
                                                    <?php echo $prod_item['sheet'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['rim_weight'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['no_of_rim'];
                                                    ?>
                                                </td>



                                                <td>
                                                    <?php echo $prod_item['weight'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['stock_in_kg'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['no_of_bundle'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['price_per_kg'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['quantity_in_kg'];
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php echo $prod_item['other'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $timestamp = $prod_item['created_at'];
                                                    $date = date('Y-m-d', strtotime($timestamp));
                                                    echo $date;
                                                    ?>
                                                </td>
                                                <?php if ($role == 1) { ?>

                                                    <!-- <td>
                                                    <a class="btn btn-success d-flex btn-sm justify-content-center align-items-center msg">Send</a>
                                                </td> -->


                                                    <td style="text-align:center;border-bottom:1px solid #f9f9f9;">
                                                        <div class=" dropdown">
                                                            <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                                <li>
                                                                    <a class="dropdown-item" href="edit_stock.php?role=1&prod_id=<?php echo $prod_item['id']; ?>">
                                                                        Edit Stock
                                                                    </a>
                                                                </li>


                                                                <!-- <li>
                                                                    <input type="button" name="edit" value="Update Stock" id="<?php echo $prod_item['id']; ?>" class="btn edit_data" />
                                                                </li> -->

                                                            </ul>
                                                        </div>


                        </div>
                        </td>
                    <?php } ?>

                    <?php if ($role == 8) { ?>

                        <td>
                            <?php if ($prod_item['status'] == 0) {
                            ?><a style="width:100px ;border:1px solid #BC3803;padding:4px; height:20px;font-size:13px; color:#BC3803;background-color:#FFEFCA; border-radius:6px;" fffefca>Pending <i class="fa-regular fa-clock" style="color:#BC3803"></i></a>
                            <?php
                                                } elseif ($prod_item['status'] == 1) {
                            ?><a style="width:100px ;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Completed <i class="fa-solid fa-check " style="color:#1C6C09"></i></a>
                            <?php
                                                } else {
                            ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Rejected <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                            <?php
                                                }
                            ?>
                        </td>


                        <td style="text-align:center;border-bottom:1px solid #f9f9f9;">
                            <div class=" dropdown">
                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">



                                    <li>
                                        <input type="button" name="edit" value="Approved Stock" id="<?php echo $prod_item['id']; ?>" class="btn edit_data" />
                                    </li>

                                </ul>
                            </div>


                    </div>




                    </td>
                <?php } ?>
                </tr>
            <?php
                                            $i++;
                                        }
                                    } else {
            ?>
            <tr>
                <td colspan="13" class="dataTables_emaster_productty">No Record or Data found
                </td>
            </tr>
        <?php
                                    }


        ?>
        </tbody>
        </table>
                </div>
            </div>
        </div>
</div>

<?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) { ?>
    <div class="col-md-12">
        <div class="mt-4">
            <h4 style="font-weight:500;font-size:26px;color:#1C2434;margin:40px 0 11px 3px">
                Add Stock

            </h4>
        </div>
        <a href="download-stock.php" class="btn btn-info" style="position: absolute;
    top: 10px;
    right: 23px;" id="download">Download Format</a>
        <div class="card">


            <div class="card-body">

                <form action="code.php" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label>Upload File</label>
                                <input type="file" name="excel" class="border" style="width:100%"
                                    placeholder="File Upload" <?= $class; ?> required>


                            </div>
                        </div>

                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">

                                <input type="Submit" name="upload" class="btn btn-primary" style="width:100%">


                            </div>
                        </div>



                    </div>
                </form>


            </div>

        </div>
    </div>

<?php } ?>

<div class="mt-4">
    <h4 style="font-weight:500;font-size:26px;color:#1C2434;margin:100px 0 18px 3px">
        History

    </h4>

</div>
<div class="card">

    <div class="card-body">


        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Seller Name</th>
                    <th>Product Name</th>
                    <?php if ($_SESSION['role'] != 3) { ?>
                        <th>Price</th><?php } ?>
                    <?php if ($_SESSION['role'] != 3) { ?>
                        <th>Sub Product</th><?php } ?>
                    <?php if ($_SESSION['role'] != 3) { ?>
                        <th>Category</th><?php } ?>
                    <?php if ($_SESSION['role'] != 3) { ?>
                        <th>Shade</th><?php } ?>
                    <!-- <th>Check Box</th> -->

                    <th>approval</th>

                    <th>Created At </th>
                    <?php if ($_SESSION['role'] == 2) { ?>
                        <th>Action</th>

                    <?php } ?>
                    <!-- <th>Edit</th>
                                    <th>Delete</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SESSION['role'] == 1) {
                    $query = "SELECT * FROM product_new where status=1 AND request=1 ORDER BY seller_id DESC";
                } else if ($_SESSION['role'] == 2) {
                    $query = "SELECT * FROM product_new WHERE status=1 and request=1 and seller_id='" . $_SESSION["id"] . "' ORDER BY id DESC";
                } else {
                    $query = "SELECT * FROM product_new WHERE status=0 and request=1 and seller_id='" . $_SESSION["id"] . "' ORDER BY id DESC";
                }
                //   echo $query;
                //   exit;
                $query_run = mysqli_query($conn, $query);
                //    print_r($query_run);
                //    exit;

                if (mysqli_num_rows($query_run) > 0) {
                    $j = 1;
                    // echo "test";
                    // exit;
                    foreach ($query_run as $prod_item) {

                ?>
                        <tr>
                            <td>
                                <?php echo $j; ?>
                            </td>
                            <td>
                                <?php $sql = "Select * from users where id=$prod_item[seller_id]";
                                $query_run = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $item) {
                                        echo $item['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $prod_item['product_name']; ?>
                            </td>
                            <?php if ($_SESSION['role'] != 3) { ?>
                                <td>
                                    <?php echo $prod_item['price_per_kg']; ?> <?php } ?>
                                </td>

                                <?php if ($_SESSION['role'] != 3) { ?>
                                    <td>
                                        <?php echo $prod_item['sub_product']; ?> <?php } ?>
                                    </td>
                                    <?php if ($_SESSION['role'] != 3) { ?>
                                        <td>
                                            <?php

                                            echo $prod_item['category_id'];
                                            ?>
                                        </td>
                                        <?php if ($_SESSION['role'] != 3) { ?>
                                            <td>
                                                <?php echo $prod_item['shade']; ?> <?php } ?>
                                            </td>
                                            <td>

                                                <?php if ($prod_item['approved'] == 1) { ?>
                                                    <span class="badge badge-success">Approved</span>
                                                <?php } else if ($prod_item['approved'] == 2) { ?>
                                                    <span class="badge badge-danger">Rejected</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                <?php }  ?>


                                            </td>
                                            <td>
                                                <?php $timestamp = $prod_item['created_at'];
                                                $date = date('Y-m-d', strtotime($timestamp));
                                                echo $date; ?>
                                            </td>
                                            <!-- <td>
                                                    <a href="product-add-edit.php?prod_id=<?php echo $prod_item['id']; ?>"
                                                        style="width:150px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Edit</a>
                                                </td> -->
                                            <!-- <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="delete_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="delete_btn"
                                                            style="width:60px ;border:1px solid #B81800;padding:4px; height:30px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Delete</button>
                                                    </form>
                                                </td> -->
                                            <?php if ($_SESSION['role'] == 3 || $_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                                <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) { ?>
                                                    <td style="text-align:center;border-bottom:1px solid #f9f9f9;">
                                                        <div class=" dropdown">
                                                            <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">



                                                                <li>
                                                                    <input type="button" name="edit" value="Approved Stock" id="<?php echo $prod_item['id']; ?>" class="btn edit_data" />
                                                                </li>

                                                            </ul>
                                                        </div>
    </div>
    </td>
<?php }
                                            } ?>
</tr>
<?php
                                        $j++;
                                    }
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
<!-- <button class="btn btn-primary mt-2" id="save">Proceed </button> -->

</div>
</div>

</div>
</div>


</div>

</div>


</section>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approved Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if ($role == 2 || $role == 3) { ?>
                    <form method="post" id="update_form">
                        <input type="hidden" name="p_id" id="p_id">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>Approval Status</label>

                                    <select class="form-control" name="status">
                                        <option disabled>----Select-----</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                    <input type="hidden" name="status_update" id="status_update" value="yes" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">


                                    <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />

                                </div>
                            </div>
                        </div>
                    </form>

                <?php }   ?>
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-top: 4px solid green;">

            <div class="modal-body">
                <div class="text-center p-3">
                    <i class="fa fa-check p-3" style="font-size:44px; text-align:center;color:green; border:2px solid green; border-radius:100%;"></i>
                </div>


                <h4 class="text-center py-4">Message Send Successfully</h4>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).on('click', '.edit_data', function() {
        var p_id = $(this).attr("id");
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
                p_id: p_id
            },
            dataType: "json",
            success: function(data) {
                $('#price').val(data.price_per_kg);
                $('#quantity').val(data.quantity_in_kg);
                $('#p_id').val(data.id);

                $('#exampleModal').modal('show');
            }
        });
    });

    $('#insert_form').on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            url: "insert.php",
            method: "POST",
            data: $('#insert_form').serialize(),
            success: function(data) {
                // alert(data);
                // console.log(data);
                $('#insert_form')[0].reset();
                $('#exampleModal').modal('hide');
                location.reload();
            }
        });

    });

    $('#update_form').on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            url: "insert.php",
            method: "POST",
            data: $('#update_form').serialize(),
            success: function(data) {
                // alert(data);
                // console.log(data);
                $('#update_form')[0].reset();
                $('#exampleModal').modal('hide');
                location.reload();
            }
        });

    });

    $(".close").click(function() {

        $("#exampleModal").modal('hide');


    });

    $(".msg").click(function() {

        $("#exampleModalCenter").modal('show');
        setTimeout(() => {
            $("#exampleModalCenter").modal('hide');
        }, 3000);

    });
</script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
</div>
<?php
include("footer.php");
?>