<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                ADD Spot Price
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select name="select_category" class="form-control">
                                                <option>--select_category--</option>
                                                <option>Yarn</option>
                                                <option>Cotton</option>
                                                <option>Seller</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Count</label>

                                            <input type="text" name="count" class="form-control" required
                                                placeholder="Count">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CSP</label>

                                            <input type="text" name="csp" class="form-control" required
                                                placeholder="CSP">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gujarat</label>
                                            <input type="text" name="gujarat" class="form-control" required
                                                placeholder="Gujarat">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Madhya Pradesh</label>
                                            <input type="text" name="mp" class="form-control" required
                                                placeholder="Madhya Pradesh">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>South Zone</label>
                                            <input type="text" name="north_zone" class="form-control" required
                                                placeholder="South Zone">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>North Zone</label>
                                            <input type="text" name="south_zone" class="form-control" required
                                                placeholder="North Zone">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" name="add_spot_price"
                                                class="btn btn-primary btn-block float-right">Add Spot Price</button>
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