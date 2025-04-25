<?php session_start();
  ?>
<?php
include_once ('header.php');
include ('../connection/config.php');


// Assuming you have already established a database connection

if (isset($_POST['isChecked']) && isset($_POST['productId'])) {
    // Sanitize the input
    $isChecked = ($_POST['isChecked'] == 'true') ? 1 : 0;
    $productId = $_POST['productId'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("UPDATE product SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $isChecked, $productId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }


}

// Close connection
// $conn->close();
?>

<style>
    .center-form {
        display: flex;
        justify-content: center;
        align-items: center;
        bottom: 10%;
        /* Adjust as needed */
    }
</style>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Add Product
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">

                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Name</label>

                                            <input type="text" name="product_name" class="form-control" required
                                                placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Unit</label>
                                            <select name="product_unit" class="form-control">
                                                <option>--Select--</option>
                                                <?php $query = mysqli_query($conn, "select * from productunit");

                                                foreach ($query as $row) { ?>
                                                    <option value="<?= $row["id"]; ?>">
                                                        <?= $row["name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Unit Size</label>
                                            <input type="text" name="unit_size" class="form-control" required rows="3"
                                                placeholder="Unit Size">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <!-- <input type="text" name="price" class="form-control" required
                                                placeholder="Enter Price"
                                                onKeyPress="if(this.value.length==20) return false;"> -->
                                            <input type="text" name="price" class="form-control" required
                                                id="numeric_input"
                                                oninput="javascript: if (this.value.length > 200) this.value = this.value.slice(0, 200).replace(/[^0-9]/g, ''); else this.value = this.value.replace(/[^0-9]/g, '');"
                                                placeholder="Enter Price">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Tax Type</label>
                                            <select name="select_tax_type" class="form-control">
                                                <option>--Select--</option>
                                                <?php $query = mysqli_query($conn, "select * from taxtype");

                                                foreach ($query as $row) { ?>
                                                    <option value="<?= $row["id"]; ?>">
                                                        <?= $row["name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tax(%)</label>
                                            <input type="text" name="tax" class="form-control" required
                                                placeholder="Enter Tax">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>HSN Number</label>
                                            <input type="text" name="hsn_number" class="form-control" required
                                                placeholder="HSN Number">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea type="text" name="description" class="form-control" required
                                                placeholder="Enter Description"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Picture</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Organization ID</label>
                                            <select name="organization_id" class="form-control">
                                                <option>--Select--</option>
                                                <?php if ($_SESSION['role'] == 1) {
                                                    $query = mysqli_query($conn, "select * from organization");
                                                } elseif ($_SESSION['role'] == 2) {
                                                    $query = mysqli_query($conn, "SELECT * FROM organization WHERE user_id='" . $_SESSION['id'] . "'");

                                                }

                                                foreach ($query as $row) { ?>
                                                    <option value="<?= $row["id"]; ?>">
                                                        <?= $row["organizations"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seller ID</label>
                                            <select name="seller_id" class="form-control">
                                                <option>--Select--</option>
                                                <?php if ($_SESSION['role'] == 1) {
                                                    $query = mysqli_query($conn, "select * from users where user_type=2");
                                                } elseif ($_SESSION['role'] == 2) {
                                                    $query = mysqli_query($conn, "SELECT * FROM users WHERE user_type=2 AND id='" . $_SESSION['id'] . "'");

                                                }

                                                foreach ($query as $row) { ?>
                                                    <option value="<?= $row["id"]; ?>">
                                                        <?= $row["name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="padding-top:20px">
                                            <button type="submit" name="product_save"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Products
                                <a href="product-add.php" class="btn btn-primary float-right">Add</a>
                            </h4>

                        </div>
                        <div class="card-body">
       
                            <table class="table table-bordered" id="dataTable">
                        
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Product Unit</th>
                                        <th>Product Size</th>
                                        <th>Check Box</th>
                                        <th>Created At </th>
                                        <!-- <th>Edit</th> -->
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 1) {
                                        $query = "SELECT * FROM product ORDER BY seller_id DESC";
                                    } else if ($_SESSION['role'] == 2) {
                                        $query = "SELECT * FROM product WHERE seller_id='" . $_SESSION["id"] . "' ORDER BY id DESC";
                                    }
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $j = 1;
                                        foreach ($query_run as $prod_item) {
                                            // echo $row['name'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $j; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['product_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['price']; ?>
                                                </td>

                                                <td>
                                                    <?php $sql = "Select * from productunit where id=$prod_item[product_unit]";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            echo $item['name'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['unit_size']; ?>
                                                </td>
                                                <td>
                                                    <div class="form-check center-form">
                                                        <form id="checkboxForm">
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="check" type="checkbox" value="<?php echo $prod_item['id']; ?>"
                                                                    id="checkbox1">
                                                                <label class="form-check-label text-white" for="checkbox1">
                                                                    x
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <!-- <td>
                                                    <a href="product-add-edit.php?prod_id=<?php //echo $prod_item['id']; ?>"
                                                        class="btn btn-success">Edit</a>
                                                </td> -->
                                                <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="delete_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="delete_btn"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <?php
                                            $j++;
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
                            <button class="btn btn-primary mt-2" id="save">Proceed </button>
  
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
 $( "#save" ).on( "click", function() {
    var val = [];
        $('#check:checked').each(function(i){
          val[i] = $(this).val();
       
        });
        console.log(val);
        $.ajax({
            url:"insert-spot-price.php",    //the page containing php script
            type: "post",    //request type,
           
            data: {id: val},
            success:function(result){
                location.reload();
            }
        });

});
   
</script>

<?php
include ("footer.php");
?>