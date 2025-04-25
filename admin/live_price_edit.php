<?php
include_once('header.php');
include('../connection/config.php');
if (isset($_POST['plan_update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $query = "update live_price set name='$name',price='$price',location='$location' where id='$product_id'";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = "Live Price Updated Successfully!";
       ?>
       <script>
       window.location.href = "live_price.php";
       </script>
<?php
    } else {
        $_SESSION['error'] = "Live Price Not Updated Due to Some Error!";
        header("Location: live_price.php");
    }
}
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from live_price where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
    ?>
            <section class="content mt-4">
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="card-header">
                                <h4>
                                    Edit Subscription Plan
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form  method="post" >
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="<?= $prodItem['id'] ?>"></input>
                                            
                                            
                                            
                                              <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Name</label>

                                            <select name="name" class="form-control" <?= $class; ?>>
                                                            <option value="">--Select Category--</option>
                                                            <?php
                                                            $query = mysqli_query($conn, "Select * From new_category");
                                                            while ($data = mysqli_fetch_array($query)) { ?>
                                                                <option value="<?= $data['name'] ?>" <?php if ($prodItem["name"] == $data['name']) {
                                                                      echo 'Selected';
                                                                  } ?>>
                                                                    <?= $data['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Price</label>

                                           <input type="text" name="price" placeholder="Enter Price" class="form-control" value="<?php echo $prodItem['price']; ?>">
                                        </div>
                                    </div>
                                           <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Location</label>

                                           <input type="text" name="location" placeholder="Enter Location" class="form-control" value="<?php echo $prodItem['location']; ?>">
                                        </div>
                                    </div>

                                            <div class="col-md-2 float-right">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button type="submit" name="plan_update" class="btn btn-primary btn-block">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php
        } else {
            echo "No such products found.";
        }
    }
    ?>
</div>
</div>
<?php
include("footer.php");
?>