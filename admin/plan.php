<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="c">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:1% 0 1% 0.6%;">
                            Add  Subscription Plan
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="POST">
                                <div class="row">
                                   

                                    
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Name</label>

                                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Price</label>

                                           <input type="text" name="price" placeholder="Enter Price" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 float-right">
                                        <div class="form-group mt-2">
                                            <label></label>
                                            <button type="submit" name="save_Plan" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="c">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                            Subscription Plan
                           
                        </h4>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from  subscription_plan";
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
                                                    <?php echo $prod_item['price']; ?>
                                                </td>
                                                 
                                                <td>
                                                    <a href="plan_edit.php?prod_id=<?php echo $prod_item['id']; ?>" style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_plan_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="delete_plan_btn" style="width:70px ; height:30px;border:1px solid #B81800;padding:4px; font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Delete</button>
                                                    </form>
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
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>