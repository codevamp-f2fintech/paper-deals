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


    #lmm>input {
        border-radius: 4px;
    }

    #lmm>input::file-selector-button {
        /* font-weight: bold; */
        height: 35px;
        color: #666666;
        /* padding: 0.5em; */
        border: thin solid grey;
        border-radius: 3px;
    }
</style>


<div class="content-wrapper">

    <section class="content mt-4">
        <div class="mx-auto" style="width:95%">

            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 style="font-weight:500;font-size:26px;color:#1C2434;margin:40px 0 11px 3px">
                            Add Product
                        </h4>
                    </div>
              
                    <div class="card">


                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category <span>*</span> :</label>
                                                <select class="form-control" name="category_id" required>
                                                    <option value="">--Select Category--</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "Select * from new_category");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <option value="<?= $row['name'] ?>">
                                                            <?= $row['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
                                
                                     
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product <span>*</span> :</label>
                                            <input type="text" name="product_name" class="form-control"
                                                placeholder="Enter Product" <?= $class; ?> required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sub Product</label>
                                            <input type="text" name="sub_product" class="form-control"
                                                placeholder="Enter Sub Product" <?= $class; ?>>
                                        </div>
                                    </div>
                                   <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gsm <span>*</span> :</label>
                                                <input type="text" name="gsm" class="form-control" placeholder="Gsm"
                                                    <?= $class; ?> required>
                                            </div>
                                        </div><?php } ?>
                                          <div class="col-md-4">
                                        <div class="form-group">
                                            <label>BF</label>
                                            <input type="text" name="bf" class="form-control"
                                                placeholder="Enter BF" <?= $class; ?>>
                                        </div>
                                    </div>
                                     <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Brightness</label>
                                                <input type="text" name="weight" class="form-control" placeholder="Brightness"
                                                    <?= $class; ?>>
                                            </div>
                                        </div><?php } ?>
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Shade</label>
                                                <input type="text" name="shade" class="form-control" placeholder="Shade"
                                                    <?= $class; ?>>
                                            </div>
                                        </div><?php } ?>
                                   
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Hsn No.</label>
                                                <input type="text" name="hsn_no" class="form-control"
                                                    placeholder="Enter Hsn No." <?= $class; ?>>
                                            </div>
                                        </div><?php } ?>
                                         <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Grain</label>
                                            <input type="text" name="grain" class="form-control"
                                                placeholder="Enter Grain" <?= $class; ?>>
                                        </div>
                                    </div>
                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sheet</label>
                                            <input type="text" name="sheet" class="form-control"
                                                placeholder="Enter Sheet" <?= $class; ?>>
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>W * L</label>
                                            <input type="text" name="w_l" class="form-control"
                                                placeholder="Enter W L" <?= $class; ?>>
                                        </div>
                                    </div>
                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No of Bundle</label>
                                            <input type="text" name="no_of_bundle" class="form-control"
                                                placeholder="Enter No of Bundle" <?= $class; ?>>
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No of Rim</label>
                                            <input type="text" name="no_of_rim" class="form-control"
                                                placeholder="Enter No of Rim" <?= $class; ?>>
                                        </div>
                                    </div>

                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Rim Weight</label>
                                            <input type="text" name="rim_weight" class="form-control"
                                                placeholder="Enter Rim Weight" <?= $class; ?>>
                                        </div>
                                    </div>
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Size in inch</label>
                                                <input type="text" name="size" class="form-control" placeholder="Size"
                                                    <?= $class; ?>>
                                            </div>
                                        </div><?php } ?>
                                   
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Stock in Kg</label>
                                                <input type="text" name="stock_in_kg" class="form-control"
                                                    placeholder="Stock in Kg" <?= $class; ?>>
                                            </div>
                                        </div><?php } ?>

                                           <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Quantity in Kg</label>
                                                <input type="text" name="quantity_in_kg" class="form-control"
                                                    placeholder="Quantity in Kg" <?= $class; ?>>
                                            </div>
                                        </div><?php } ?>
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price in Kg <span>*</span> :</label>
                                                <input type="text" name="price_per_kg" class="form-control"
                                                    placeholder="Price per Kg" <?= $class; ?> required>
                                            </div>
                                        </div><?php } ?>
                                 
                                
                                     <?php if ($_SESSION['role'] == 1) { ?>
                                     
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php if($_GET['user_type']=="seller"){ ?>Seller <?php  }else { ?>Buyer <?php  } ?></label>
                                                <select class="form-control" name="seller_id">
                                                    <option value="">--Select <?php if($_GET['user_type']=="seller"){ ?>Seller <?php  }else { ?>Buyer <?php  } ?>--</option>
                                                    <?php
                                                    
                                                    if($_GET['user_type']=="seller"){
                                                    $query = mysqli_query($conn, "Select * from users where user_type='2'");
                                                    }
                                                    else if($_GET['user_type']=="buyer"){
                                                       $query = mysqli_query($conn, "Select * from users where user_type='3'"); 
                                                    }
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <option value="<?= $row['id'] ?>">
                                                            <?= $row['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                
                                                        <?php if($_GET['user_type']=="seller"){ ?>
                                                <input type="hidden" name="user_type" value="2">
                                            <?php }else { ?>
                                            <input type="hidden" name="user_type" value="3">

                                        <?php } ?>
                                            </div>
                                        </div>
                                        
                                        
                                    <?php } 
                                    
                                     else if ($_SESSION['role'] == 2) { ?>
                                    
                                    <input type="hidden" name="seller_id" value="<?php echo $_SESSION['id'] ?>">
                                      <input type="hidden" name="user_type" value="2">
                                     
                                     <?php } ?>
                                         <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group" id="lmm">
                                                <label>Document</label>
                                                <input type="file" name="image" class="border" style="width:100%"
                                                    placeholder="Other" <?= $class; ?>>
                                            </div>
                                        </div><?php } ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Other</label>
                                            <textarea type="text" name="other" class="form-control"
                                                placeholder="Other" style="height: 37px;"></textarea>
                                        


                                        </div>
                                    </div>
                               
                                    <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 4) { ?>
                                        <div class="col-md-2 float-right">
                                            <div class="form-group mt-4">
                                                <button type="submit" name="product_save"
                                                    class="btn btn-primary btn-block float-right">Add</button>
                                            </div>
                                        </div><?php } else { ?>
                                        <div class="col-md-2">
                                            <div class="form-group mt-2">
                                                <br>

                                                <button type="submit" name="product_save_buyer"
                                                    class="btn btn-primary btn-block float-right">Add</button>
                                            </div><?php } ?>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

                <?php include ("message.php"); ?>
                <div class="alert alert-success alert-dismissible" id="success" style="display:none;"><i
                        class="icon fas fa-check"></i></div>
                <div class="alert alert-danger alert-dismissible" id="error" style="display:none;"><i
                        class="icon fas fa-check"></i></div>
                <div class="mt-4">
                    <h4 style="font-weight:500;font-size:26px;color:#1C2434;margin:100px 0 18px 3px">
                        Products
                        <!--<a href="product-add.php" class="btn btn-primary float-right">Add Products</a>-->
                    </h4>

                </div>
                <div class="card">

                    <div class="card-body">


                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><?php if($_GET['user_type']=="seller"){ ?>Seller <?php  }else { ?>Buyer <?php  } ?> Name</th>
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
                                    <th>Created At </th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($_SESSION['role'] == 1) {
                                    if($_GET['user_type']=="seller"){
                                    $query = "SELECT * FROM product_new where status=1 and user_type='2'";
                                    } else {
                                       
                                       $query = "SELECT * FROM product_new where status=1 and user_type='3'";
  
                                    }
                                } else if ($_SESSION['role'] == 2) {
                                    
                                    $query = "SELECT * FROM product_new WHERE status=1 and seller_id='" . $_SESSION["id"] . "' ORDER BY id DESC";
                                } else {
                                    $query = "SELECT * FROM product_new WHERE status=0 and seller_id='" . $_SESSION["id"] . "' ORDER BY id DESC";
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
                                                    <?php echo $prod_item['price_per_kg']; ?>         <?php } ?>
                                            </td>

                                            <?php if ($_SESSION['role'] != 3) { ?>
                                                <td>
                                                    <?php echo $prod_item['sub_product']; ?>         <?php } ?>
                                            </td>
                                            <?php if ($_SESSION['role'] != 3) { ?>
                                                <td>
                                                    <?php
                                                  
                                                    echo $prod_item['category_id'];
                                                    ?>
                                                </td>
                                                <?php if ($_SESSION['role'] != 3) { ?>
                                                    <td>
                                                        <?php echo $prod_item['shade']; ?>             <?php } ?>
                                                </td>

                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <td>
                                                    <a href="product-add-edit.php?prod_id=<?php echo $prod_item['id']; ?>"
                                                        style="width:150px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="delete_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="delete_btn"
                                                            style="width:60px ;border:1px solid #B81800;padding:4px; height:30px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Delete</button>
                                                    </form>
                                                </td>
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




</section>
</div>



                        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

    $("#save").on("click", function () {
        var val = [];
        $('#check:checked').each(function (i) {
            val[i] = $(this).val();

        });
        console.log(val);
        if (val == "") {

            $("#error").css("display", "block");
            $('#error').html("<i class='icon fas fa-check'></i>Please Select Checkbox").fadeTo();
            setTimeout(() => {
                $("#error").css("display", "none");
            }, 2000);


        } else {
            $.ajax({
                url: "insert-spot-price.php", //the page containing php script
                type: "post", //request type,

                data: {
                    id: val
                },
                success: function (result) {
                    console.log(result);
                    if (result == 1) {
                        $("#success").css("display", "block");
                        $('#success').html("<i class='icon fas fa-check'></i>Inserted Successfully").fadeTo();
                        setTimeout(() => {
                            $("#success").css("display", "none");
                        }, 2000);

                    }

                }
            });
        }

    });
</script>
<?php
include ("footer.php");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>