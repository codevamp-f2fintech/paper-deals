<?php
include_once('header.php');
include('../connection/config.php');
$role = $_SESSION['role'];
$id = $_SESSION['id'];
?>
<div class="content-wrapper">

    <?php if ($role == 1 || $role == 3) { ?>

        <section class="content mt-4">
            <div class="col-md-12">
                <?php include("message.php"); ?>
                <div class="mt-4">
                    <h4 style="font-size:28px;color:#1C2434;margin:40px 0 15px 3px">
                        Enquiry Show <?php //print_r($_SESSION);  
                                        ?>
                    </h4>

                </div>
                <div class="card">


                    <div class="card-body" style="overflow-x:auto;">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Seller Id</th>
                                    <th>Buyer</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Gsm</th>
                                    <th>Shade</th>
                                    <th>Quantity in Kg</th>
                                    <th>Remarks</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($role == 1) {
                                    $query = "SELECT * from enquiry ORDER BY `enquiry`.`id` DESC";
                                } else if ($role == 3) {

                                    $query = "SELECT * from enquiry where buyer_id='$id' ORDER BY `enquiry`.`id` ASC";
                                } else if ($role == 2) {
                                    $query = "SELECT * from enquiry where user_id='$id' ORDER BY `enquiry`.`id` ASC";
                                }

                                $query_run = mysqli_query($conn, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $prod_item) {
                                        // echo "<pre>";
                                        // print_r($prod_item);
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $prod_item['id']; ?>
                                            </td>

                                            </td>



                                            <td>
                                                <?php echo 'KPDS_' . $prod_item['user_id']; ?>
                                            </td>

                                            <td>
                                                <?php echo $prod_item['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['phone']; ?>
                                            </td>

                                            <td>
                                                <?php echo $prod_item['city']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $sql = "Select * from new_category where id=$prod_item[category_id]";
                                                $query_run = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query_run) > 0) {
                                                    foreach ($query_run as $item) {
                                                        echo $item['name'];
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['product']; ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['gsm']; ?>
                                            </td>


                                            <td>
                                                <?php echo $prod_item['shade']; ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['quantity_in_kg']; ?>
                                            </td>

                                            <td>
                                                <?php echo $prod_item['remarks']; ?>
                                            </td>
                                            <td>
                                                <?php //echo date("d-m-Y", strtotime($prod_item['created_at'])); 

                                                echo $prod_item['created_at'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($prod_item['status'] == 0) {
                                                ?><a
                                                        style="width:100px ;border:1px solid #BC3803;padding:4px; height:20px;font-size:13px; color:#BC3803;background-color:#FFEFCA; border-radius:6px;"
                                                        fffefca>Pending <i class="fa-regular fa-clock" style="color:#BC3803"></i></a>
                                                <?php
                                                } elseif ($prod_item['status'] == 1) {
                                                ?><a
                                                        style="width:100px ;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Completed
                                                        <i class="fa-solid fa-check " style="color:#1C6C09"></i></a>
                                                <?php
                                                } else {
                                                ?><a
                                                        style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Rejected
                                                        <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="view-enquiry.php?prod_id=<?php echo $prod_item['id']; ?>"
                                                    style=" #width:95px;  padding:2% 4%;border-radius:6px;height:10px;">View</a>
                                            </td>
                                        </tr>

                                    <?php

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
    <?php } ?>
    <style>
        .card-body {
            overflow-x: auto;
        }

        .table th,
        .table td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    </style>
    <?php if ($role == 2) { ?>

        <section class="content mt-4">
            <div class="col-md-12">
                <?php include("message.php"); ?>
                <div class="mt-4">
                    <h4 style="font-size:28px;color:#1C2434;margin:40px 0 15px 3px">
                        Enquiry Show <?php //print_r($_SESSION);  
                                        ?>
                    </h4>

                </div>
                <div class="card">


                    <div class="card-body " style="overflow-x:auto;">
                        <table class="table " id="example1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <!-- <th>Name</th> -->
                                    <th>Buyer ID</th>
                                    <th>Product</th>
                                    <th>City</th>
                                    <th>Shade</th>
                                    <th>Gsm</th>
                                    <th>Remarks</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $_SESSION['id'];
                                $query = "SELECT enquery_message.status as msgstaus,enquery_message.id as msgid,enquery_message.seller_id,enquery_message.created_at,enquery_message.enq_id,enquiry.id,enquiry.product,enquiry.phone,enquiry.city as enq_city,enquiry.shade,enquiry.gsm,enquiry.size, enquiry.company_name,enquiry.buyer_id,enquiry.remarks,enquiry.name,organization.organizations,organization.city,organization.user_id from enquery_message LEFT JOIN enquiry on enquiry.id=enquery_message.enq_id LEFT JOIN organization on organization.user_id=enquery_message.seller_id where enquery_message.seller_id=$id";
                                // echo $query;
                                // exit;

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

                                            <!-- <td>
                                                <?php //echo $prod_item['name']; 
                                                ?>
                                            </td> -->
                                            <td>
                                                <?php if ($prod_item['buyer_id'] != 0) {
                                                    echo "KPDB_" . $prod_item['buyer_id'];
                                                }  ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['product']; ?>
                                            </td>


                                            <td>
                                                <?php echo $prod_item['enq_city']; ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['shade']; ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['gsm']; ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['remarks']; ?>
                                            </td>
                                            <td>
                                                <?php echo $prod_item['created_at']; ?>
                                            </td>
                                            <td>
                                                <?php if ($prod_item['msgstaus'] == 0) {
                                                ?><a
                                                        style="width:100px ;border:1px solid #BC3803;padding:4px; height:20px;font-size:13px; color:#BC3803;background-color:#FFEFCA; border-radius:6px;"
                                                        fffefca>Pending <i class="fa-regular fa-clock" style="color:#BC3803"></i></a>
                                                <?php
                                                } elseif ($prod_item['msgstaus'] == 1) {
                                                ?><a
                                                        style="width:100px ;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Completed
                                                        <i class="fa-solid fa-check " style="color:#1C6C09"></i></a>
                                                <?php
                                                } else {
                                                ?><a
                                                        style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Rejected
                                                        <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="view-enquiry.php?id=<?php echo $prod_item['msgid']; ?>"
                                                    style=" #width:95px;  padding:2% 4%;border-radius:6px;height:10px;">View</a>
                                            </td>
                                        </tr>

                                    <?php
                                        $i++;
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

    <?php } ?>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>