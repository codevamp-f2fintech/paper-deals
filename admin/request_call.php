<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class=" content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="mt-4">
                <h4 style="font-weight:600;font-size:25px;color:#1C2434;margin:40px 0 15px 3px">
                    Request Call
                </h4>

            </div>
            <div class="card">

                <div class="card-body">

                    <table class="table " id="dataTable">

                        <thead>
                            <tr style="text-align:center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * from reqcall ORDER BY id DESC";
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                                    // echo $row['name'];
                            ?>
                                    <tr style="text-align:center">
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['phone']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_at']; ?>
                                        </td>
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
                                        <td>
                                            <a href="view-request-call.php?prod_id=<?php echo $prod_item['id']; ?>" style=" #width:95px;  padding:2% 4%;border-radius:6px;height:10px;">View</a>
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
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>