<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Profile Information
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Company Name</label>

                                            <input type="text" name="company_name" class="form-control" required
                                                placeholder="Company Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Deal In</label>

                                            <input type="text" name="deal_in" class="form-control" required
                                                placeholder="Deal In">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Business Area / Industry</label>

                                            <input type="text" name="business_area" class="form-control" required
                                                placeholder="Business Area / Industry">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Sub Products</label>

                                            <input type="text" name="sub_products" class="form-control" required
                                                placeholder="Sub Products">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Price Range</label>

                                            <input type="text" name="price_range" class="form-control" required
                                                placeholder="Price Range">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Delivery</label>

                                            <input type="text" name="delivery" class="form-control" required
                                                placeholder="Delivery">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Type of seller</label>
                                            <input type="text" name="type_of_seller" class="form-control" required
                                                placeholder="Type of seller">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Profile Picture (Size width: 396px , height: 269px)</label>
                                            <input type="file" name="profile_picture" class="form-control">
                                        </div>

                                    </div>
                                    <br>
                                    <div class="col-md-4 float-right">
                                        <div class="form-group">

                                            <button type="submit" name="profile_information_save"
                                                class="btn btn-primary btn-block">Save</button>
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
</div>
<?php
include ("footer.php");
?>