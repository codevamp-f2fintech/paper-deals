<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:95%">
            <div class="alert alert-success alert-dismissible" id="success" style="display:none;"><i class="icon fas fa-check"></i></div>
            <div class="alert alert-danger alert-dismissible" id="error" style="display:none; width: 300px;
    position: fixed;
    right: 22px;
    top: 26px;
    z-index:100;"><i class="icon fas fa-check"></i></div>
            <style>
                #gmm>input {
                    border-radius: 4px;
                }

                #gmm>input::file-selector-button {
                    /* font-weight: bold; */
                    height: 35px;
                    color: #666666;
                    /* padding: 0.5em; */
                    border: thin solid grey;
                    border-radius: 3px;
                }
            </style>
            <div class="row">
                <div class="col-md-12">
                
                 
                    <?php include("message.php"); ?>
                    <div class="card-header " style="margin-bottm:4%;">
                        <h4>
                           Live Stock
                        </h4>

                    </div>

                    <div class="card">

                        <div class="card-body">
<div class="form-group mb-3" style="width:400px;">
    <?php
        // Fetching organization data from the database
        $organizationsql = "SELECT organizations,user_id FROM `organization`";
        $organizationquery_run = mysqli_query($conn, $organizationsql);

        // Check if there are results
        if (mysqli_num_rows($organizationquery_run) > 0) {
            ?>
            <label for="filterSelect">Filter by Company Name</label>
            <select id="filterSelect" class="form-control">
                <option value="">Select Company</option>
                <?php
                // Loop through each row and create an option
                while ($organizationdata = mysqli_fetch_array($organizationquery_run)) {
                    ?>
                    <option value="<?php echo $organizationdata['user_id']; ?>">
                        <?php echo $organizationdata['organizations']; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <?php
        } else {
            echo "No organizations found.";
        }
    ?>
</div>


                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <!--   <th>Seller Name</th>
                                        <th>Product Name</th>
                                        <?php if ($_SESSION['role'] != 3) { ?>
                                            <th>Price</th><?php } ?>
                                        <?php if ($_SESSION['role'] != 3) { ?>
                                            <th>Sub Product</th><?php } ?>
                                        <?php if ($_SESSION['role'] != 3) { ?>
                                    <th>Shade</th><?php } ?> -->

                                        <th>Product Name</th>
                                        <th>Seller</th>
                                        <th>Shade</th>
                                        <th>Gsm</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Stock in Kg</th>
                                        <th>Price Per Kg</th>
                                        <th>Quantity in Kg</th>
                                        <th>Check Box</th>
                                        <th>Created At </th>
                                        <!-- <th>Edit</th> -->
                                        <!-- <th>Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 1) {
                                        $query = "SELECT product_new.*,product_new.id as p_id,product_new.seller_id as s_id, spot_price.*,users.name FROM `product_new` LEFT JOIN spot_price ON spot_price.product_id=product_new.id LEFT JOIN users on users.id=product_new.seller_id ORDER BY spot_price.id DESC";
                                    } else if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) {
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
                                            // echo "<pre>";
                                            // print_r($prod_item);
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $j; ?>
                                                </td>
                                                 <td>
                                                    <?php echo $prod_item['product_name']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $s_id=$prod_item['s_id'];
                                                    // echo $s_id;
                                                    // exit;
                                                    $sql = "SELECT * FROM `organization` where user_id='$s_id'";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    $data=mysqli_fetch_assoc($query_run);
                                                       
                                              
                                                    ?>
                                                    <?php echo $data['organizations']; ?>
                                                </td>
                                               
                                                <?php if ($_SESSION['role'] != 3) { ?>
                                                    <td>
                                                        <?php echo $prod_item['shade']; ?> <?php } ?>
                                                    </td>

                                                    <?php if ($_SESSION['role'] != 3) { ?>
                                                        <td>
                                                            <?php echo $prod_item['gsm']; ?> <?php } ?>
                                                        </td>
                                                        <?php if ($_SESSION['role'] != 3) { ?>
                                                            <td>
                                                                <?php echo $prod_item['size']; ?> <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $prod_item['weight']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $prod_item['stock_in_kg']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $prod_item['price_per_kg']; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $prod_item['quantity_in_kg']; ?>
                                                            </td>
                                                            <td>
                                                                <div class="form-check center-form">
                                                                    <form id="checkboxForm">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="<?php echo $prod_item['p_id']; ?>" id="check" <?php if ($prod_item['created_at']) { ?> checked <?php  } ?>>
                                                                            <label class="form-check-label text-white" for="check">

                                                                            </label>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php echo $prod_item['created_at']; ?>
                                                            </td>
                                                            <!-- <td>
                                                    <a href="product-add-edit.php?prod_id=<?php //echo $prod_item['id']; 
                                                                                            ?>"
                                                        class="btn btn-success">Edit</a>
                                                </td> -->
                                                            <!-- <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="delete_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="delete_btn"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td> -->
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
                            <button class="btn btn-primary mt-2" id="proceed">Proceed</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

 <script>

    $(document).ready(function() {

        // Filter data when category is selected
        $('#filterSelect').on('change', function() {
            var selectedCategory = $(this).val();

            // Use AJAX to send the selected category to the server
            $.ajax({
                url: 'filter_products.php', // The PHP file to handle the filtering
                type: 'POST',
                data: { category: selectedCategory },
                success: function(response) {
                 
                    // Replace the table body with the filtered data
                    $('#dataTable tbody').html(response);
                }
            });
        });
    });
</script>



<script>
    $("#proceed").on("click", function() {
        var val = [];
        $('#check:checked').each(function(i) {
            val[i] = $(this).val();

        });
        console.log(val);
        if (val == "") {

            $("#error").css("display", "block");
            $('#error').html("<i class='icon fas fa-check'></i>Please Select Checkbox").animate({
                right: '12px',
                opacity: 1
            }, 500);
            setTimeout(() => {
                $("#error").css("display", "none");
            }, 2000);


        } else {

            window.location.href = "spot_price_update.php?id=" + val;

        }

    });
</script>
<?php
include("footer.php");
?>