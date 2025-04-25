<?php
include_once('header.php');
include('../connection/config.php');
?>
<style>
    .col-md-12 {
        padding: 0px;
    }

    .form-group {
        margin: 0px;
    }


    .table td {
        padding: 0px;
    }
</style>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="alert alert-success alert-dismissible" id="success" style="display:none; width: 300px;
    position: fixed;
    right: 22px;
    top: 76px;
    z-index:100;"><i class="icon fas fa-check"></i></div>

            <div class="row">

                <div class="col-md-12">

                    <?php include("message.php"); ?>
                    <div class="card-header">
                        <h4 class="d-inline">
                            Update Spot Price
                        </h4>
                        <button class="btn btn-success my-2 d-inline float-right" onclick="history.go(-1)">Back</button>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table ">

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
                                </tr>

                                <?php $id = $_GET['id'];

                                $ids = explode(",", $id);

                                ?>

                                <?php foreach ($ids as $key => $value) {
                                    $query = "SELECT * FROM product_new join users on product_new.seller_id = users.id where product_new.id= $value";
                                    $query_run = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($query_run)) {

                                ?>
                                        <?php include("message.php"); ?>
                                        <div class="row">
                                            <tr>
                                                <td>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php echo $row['id'];  ?>
                                                            <input class="form-check-input" type="checkbox" checked value="<?php echo $value; ?>" id="check" style="display:none;">


                                                        </div>
                                                    </div>

                                                </td>


                                                <td>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" readonly value="<?php echo $row['product_name'];  ?>" class="form-control" />

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12">
                                                        <div class="form-group">

                                                            <input type="text" readonly value="<?php echo $row['name'];  ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="col-md-12">
                                                        <div class="form-group">

                                                            <input type="text" readonly value="<?php echo $row['shade'];  ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                        </div>
                                        </td>

                                        <td>

                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <input type="text" readonly value="<?php echo $row['gsm'];  ?>" class="form-control" />
                                                </div>
                                            </div>
                        </div>
                        </td>


                        <td>

                            <div class="col-md-12">
                                <div class="form-group">

                                    <input type="text" readonly value="<?php echo $row['size'];  ?>" class="form-control" />
                                </div>
                            </div>
                    </div>
                    </td>



                    <td>

                        <div class="col-md-12">
                            <div class="form-group">

                                <input type="text" readonly value="<?php echo $row['weight'];  ?>" class="form-control" />
                            </div>
                        </div>
                </div>
                </td>



                <td>

                    <div class="col-md-12">
                        <div class="form-group">

                            <input type="text" readonly value="<?php echo $row['stock_in_kg'];  ?>" class="form-control" />
                        </div>
                    </div>
            </div>
            </td>



            <td>

                <div class="col-md-12">
                    <div class="form-group">

                        <input type="text" value="<?php echo $row['price_per_kg'];  ?>" class="form-control price" />
                    </div>
                </div>
        </div>
        </td>


        <td>

            <div class="col-md-12">
                <div class="form-group">

                    <input type="text" readonly value="<?php echo $row['quantity_in_kg']; ?>" class="form-control"/>
                </div>
            </div>
</div>
</td>
</div>
</tr>
<?php }
                                } ?>

</table>
<div class="col-md-2">
    <button class="btn btn-primary mt-2 w-100" id="save">Save</button>
</div>
</div>


</div>

</div>


</div>



</div>
</div>
</div>
</section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $("#save").on("click", function() {
        var val = [];
        price = [];


        $('#check:checked').each(function(i) {
            val[i] = $(this).val();

        });

        $('.price').each(function(j) {
            price[j] = $(this).val();

        });

        // console.log(price);

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
                    id: val,
                    price: price
                },
                success: function(result) {
                    console.log(result);
                    if (result) {

                        $("#success").css("display", "block");
                        $('#success').html("<i class='icon fas fa-check'></i>Inserted Successfully").animate({
                            right: '12px',
                            opacity: 1
                        }, 500);;
                        setTimeout(() => {
                            $("#success").css("display", "none");
                            window.location.href = "view_mic_price.php";
                        }, 2000);



                    }


                }
            });
        }

    });
</script>
<?php
include("footer.php");
?>