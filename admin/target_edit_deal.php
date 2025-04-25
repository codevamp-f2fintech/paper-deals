<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="code.php" method="post">
                        <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="card">
                            <?php
                            if (isset($_GET['prod_id'])) {
                                $id = $_GET['prod_id'];
                                $query = "SELECT * from deals 
                                where id=$id";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <div class="card-header">
                                    <h4>
                                        Deal Details
                                    </h4>
                                </div>
                                <div class="card-primary">
                                    <!-- <div class="card-header">
                                        <?php
                                        $query = mysqli_query($conn, "Select id from deals order by id desc");
                                        $row = mysqli_fetch_array($query);

                                        $id = $row['id'];
                                        $deal_id = $id + 1;
                                        ?>
                                        <h3 class="card-title">Deal Id :
                                            <?= $deal_id; ?>
                                        </h3>
                                        <h3 class="card-title" style="float:right">Creation Date :
                                            <?= date('Y-m-d'); ?>
                                        </h3>
                                    </div> -->
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Buyer</label>
                                                <select class="form-control" name="buyer" required="">
                                                    <option value="">--Select Buyer--</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "Select * from users where user_type=3 and active_status=1");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <option value="<?= $row['id'] ?>" <?php if ($prodItem['buyer_id'] == $row['id']) {
                                                              echo "selected";
                                                          } ?>>
                                                            <?= $row['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Seller</label>
                                                <select class="form-control" name="seller" required="">
                                                    <option value="">--Select Seller--</option>
                                                    <?php
                                                    $query = mysqli_query($conn, "Select * from users where user_type=2 and active_status=1");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <option value="<?= $row['id'] ?>" <?php if ($prodItem['seller_id'] == $row['id']) {
                                                              echo "selected";
                                                          } ?>>
                                                            <?= $row['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" value="<?= $prodItem["contact_person"]; ?>"
                                                    name="contact_person" class="form-control" required
                                                    placeholder="Contact Person">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="text" value="<?= $prodItem["mobile_no"]; ?>" name="mobile_no"
                                                    class="form-control" required placeholder="Mobile No.">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" value="<?= $prodItem["email_id"]; ?>" name="email"
                                                    class="form-control" required placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea name="product_desc" rows="1" class="form-control"
                                                    placeholder="Product Description"
                                                    required><?= $prodItem["product_description"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Deal Size</label>
                                                <input type="text" value="<?= $prodItem["deal_size"]; ?>" name="deal_size"
                                                    class="form-control" required placeholder="Deal Size">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Commission</label>
                                                <input type="text" value="<?= $prodItem["commission"]; ?>" name="commission"
                                                    class="form-control" required placeholder="Commission">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Buyer Commission</label>
                                                <input type="text" value="<?= $prodItem["buyer_commission"]; ?>"
                                                    name="buyer_commission" class="form-control" required
                                                    placeholder="Buyer Commission">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Seller Commission</label>
                                                <input type="text" value="<?= $prodItem["seller_commission"]; ?>"
                                                    name="seller_commission" class="form-control" required
                                                    placeholder="Seller Commission">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <textarea name="remarks" rows="1" class="form-control"
                                                    placeholder="Enter Remarks"><?= $prodItem["remarks"]; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top:30px">
                                            <div class="form-group">
                                                <button type="submit" name="save_deal"
                                                    class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>


                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="card">
                            <?php
                            if (isset($_GET['prod_id'])) {
                                $id = $_GET['prod_id'];
                                $query = "SELECT * from sampling 
                                where id=$id";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <div class="card-header">
                                    <h4>
                                        Sampling
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date Of Sample</label>
                                                <div class="input-group date" id="dateofsamplehh"
                                                    data-target-input="nearest">
                                                    <input type="text" name="dos" value="<?= $prodItem['dos']; ?>"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#dateofsamplehh" placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#dateofsamplehh"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sample Verification</label>
                                                <input type="text" value="<?= $prodItem['sample_verification']; ?>"
                                                    name="sample_verification" class="form-control" required
                                                    placeholder="Sample Verification">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Lab Report</label>
                                                <div class="input-group date" id="labreport" data-target-input="nearest">
                                                    <input type="text" value="<?= $prodItem['lab_report']; ?>"
                                                        name="lab_report" class="form-control datetimepicker-input"
                                                        data-target="#labreport" placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#labreport"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Remarks</label>
                                                <input type="text" value="<?= $prodItem['remarks']; ?>" name="remarks"
                                                    class="form-control" placeholder="Remarks" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Document</label>
                                                <input type="file" name="upload_doc" class="form-control">
                                                <input type="hidden" name="old_doc"
                                                    value="<?php echo isset($prodItem['upload_doc']) ? $prodItem['upload_doc'] : ''; ?>">
                                                <?php if (!empty($prodItem['upload_doc'])) { ?>
                                                    <img src="<?= $prodItem['upload_doc'] ?>" width="120px" height="120px"
                                                        alt="">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top:30px">
                                            <div class="form-group">
                                                <button type="submit" name="sample_save"
                                                    class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="card">
                            <?php
                            if (isset($_GET['prod_id'])) {
                                $id = $_GET['prod_id'];
                                $query = "SELECT * from validation 
                                where id=$id";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <div class="card-header">
                                    <h4>
                                        Validation
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date Of Validation</label>
                                                <div class="input-group date" id="datemask3" data-target-input="nearest">
                                                    <input type="text" name="dov" value="<?= $prodItem['dov']; ?>"
                                                        class="form-control datetimepicker-input" data-target="#datemask3"
                                                        placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#datemask3"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Sample</label>

                                                <input type="text" name="sample" value="<?= $prodItem['sample']; ?>"
                                                    class="form-control" required placeholder="Sample">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Stock Approved</label>
                                                <input type="text" value="<?= $prodItem['stock_approve']; ?>"
                                                    name="stock_approve" class="form-control" placeholder="Stock Approved"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Upload Document</label>
                                                <input type="file" name="upload_docu" class="form-control">
                                                <input type="hidden" name="old_docu"
                                                    value="<?php echo isset($prodItem['upload_docu']) ? $prodItem['upload_docu'] : ''; ?>">
                                                <?php if (!empty($prodItem['upload_docu'])) { ?>
                                                    <img src="<?= $prodItem['upload_docu'] ?>" width="120px" height="120px"
                                                        alt="">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top:30px">
                                            <div class="form-group">
                                                <button type="submit" name="validation_save"
                                                    class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="card">
                            <?php
                            if (isset($_GET['prod_id'])) {
                                $id = $_GET['prod_id'];
                                $query = "SELECT * from clearance 
                                where id=$id";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <div class="card-header">
                                    <h4>
                                        Clearance
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Clearance Date</label>
                                                <div class="input-group date" id="dateofclearnce"
                                                    data-target-input="nearest">
                                                    <input type="text" value="<?= $prodItem['doc']; ?>" name="doc"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#dateofclearnce" placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#dateofclearnce"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Product</label>

                                                <input type="text" name="product" value="<?= $prodItem['product']; ?>"
                                                    class="form-control" required placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Remarks</label>
                                                <input type="text" name="remarks" value="<?= $prodItem['remarks']; ?>"
                                                    class="form-control" placeholder="Remarks" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Upload Document</label>
                                                    <input type="file" name="upload_docum" class="form-control">
                                                    <input type="hidden" name="old_docum"
                                                        value="<?php echo isset($prodItem['upload_docum']) ? $prodItem['upload_docum'] : ''; ?>">
                                                    <?php if (!empty($prodItem['upload_docum'])) { ?>
                                                        <img src="<?= $prodItem['upload_docum'] ?>" width="120px" height="120px"
                                                            alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="col-md-4" style="padding-top:30px">
                                                    <div class="form-group">
                                                        <button type="submit" name="clearance_save"
                                                            class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="card">
                            <?php
                            if (isset($_GET['prod_id'])) {
                                $id = $_GET['prod_id'];
                                $query = "SELECT * from payment 
                                where id=$id";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <div class="card-header">
                                    <h4>
                                        Payment
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Transaction Date</label>
                                                <div class="input-group date" id="transactiondate"
                                                    data-target-input="nearest">
                                                    <input type="text" value="<?= $prodItem['transaction_date']; ?>"
                                                        name="transaction_date" class="form-control datetimepicker-input"
                                                        data-target="#transactiondate" placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#transactiondate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Transaction Status</label>

                                                <input type="text" name="product" value="<?= $prodItem['product']; ?>"
                                                    class="form-control" required placeholder="Transaction Status">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Detail</label>
                                                <input type="text" name="details" value="<?= $prodItem['details']; ?>"
                                                    class="form-control" placeholder="Detail" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Upload Document</label>
                                                <input type="file" name="upload_docume" class="form-control">
                                                <input type="hidden" name="old_docume"
                                                    value="<?php echo isset($prodItem['upload_docume']) ? $prodItem['upload_docume'] : ''; ?>">
                                                <?php if (!empty($prodItem['upload_docume'])) { ?>
                                                    <img src="<?= $prodItem['upload_docume'] ?>" width="120px" height="120px"
                                                        alt="">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top:30px">
                                            <div class="form-group">
                                                <button type="submit" name="payment_save"
                                                    class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="card">
                            <?php
                            if (isset($_GET['prod_id'])) {
                                $id = $_GET['prod_id'];
                                $query = "SELECT * from transportation 
                                where id=$id";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <div class="card-header">
                                    <h4>
                                        Transportation
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Transportation Date</label>
                                                <div class="input-group date" id="tdd" data-target-input="nearest">
                                                    <input type="text" value="<?= $prodItem['transportation_date']; ?>"
                                                        name="transportation_date" class="form-control datetimepicker-input"
                                                        data-target="#tdd" placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#tdd"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <div class="input-group date" id="dat" data-target-input="nearest">
                                                    <input type="text" value="<?= $prodItem['date']; ?>" name="date"
                                                        class="form-control datetimepicker-input" data-target="#dat"
                                                        placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#dat"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Mean Of Transport</label>

                                                <input type="text" name="mot" value="<?= $prodItem['mot']; ?>"
                                                    class="form-control" required placeholder="Mean Of Transport">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Vehicle No.</label>
                                                <input type="text" name="vehicle_no" value="<?= $prodItem['vehicle_no']; ?>"
                                                    class="form-control" placeholder="Vehicle No." required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Ammount Incured</label>
                                                <input type="text" value="<?= $prodItem['ammount_incured']; ?>"
                                                    name="ammount_incured" class="form-control"
                                                    placeholder="Ammount Incured" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Expected Date of Delivery</label>
                                                <div class="input-group date" id="eddate" data-target-input="nearest">
                                                    <input type="text" value="<?= $prodItem['edd']; ?>" name="edd"
                                                        class="form-control datetimepicker-input" data-target="#eddate"
                                                        placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#eddate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Upload Document</label>
                                                <input type="file" name="upload_documen" class="form-control">
                                                <input type="hidden" name="old_documen"
                                                    value="<?php echo isset($prodItem['upload_documen']) ? $prodItem['upload_documen'] : ''; ?>">
                                                <?php if (!empty($prodItem['upload_documen'])) { ?>
                                                    <img src="<?= $prodItem['upload_documen'] ?>" width="120px" height="120px"
                                                        alt="">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top:30px">
                                            <div class="form-group">
                                                <button type="submit" name="transportation_save"
                                                    class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $_REQUEST['prod_id']; ?>">
                        <input type="hidden" name="role" value="<?= $_REQUEST['role']; ?>">
                        <div class="card">
                            <?php
                            if (isset($_GET['prod_id'])) {
                                $id = $_GET['prod_id'];
                                $query = "SELECT * from close 
                                where id=$id";
                                $query_run = mysqli_query($conn, $query);
                                $prodItem = mysqli_fetch_array($query_run);
                                ?>
                                <div class="card-header">
                                    <h4>
                                        Closed
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Closed Date</label>
                                                <div class="input-group date" id="cdate" data-target-input="nearest">
                                                    <input type="text" value="<?= $prodItem['close_date']; ?>"
                                                        name="close_date" class="form-control datetimepicker-input"
                                                        data-target="#cdate" placeholder="DD-MM-YY" />
                                                    <div class="input-group-append" data-target="#cdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Product</label>
                                                <input type="text" name="product" value="<?= $prodItem['product']; ?>"
                                                    class="form-control" required placeholder="Product">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <input type="text" name="remarks" value="<?= $prodItem['remarks']; ?>"
                                                    class="form-control" placeholder="Remarks" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product recd. by</label>
                                                <input type="text" name="product_recd"
                                                    value="<?= $prodItem['product_recd']; ?>" class="form-control"
                                                    placeholder="Product recd. by" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Deal Size</label>
                                                <input type="text" name="deal_size" value="<?= $prodItem['deal_size']; ?>"
                                                    class="form-control" placeholder="Deal Size" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Upload Document</label>
                                                <input type="file" name="upload_document" class="form-control">
                                                <input type="hidden" name="old_document"
                                                    value="<?php echo isset($prodItem['upload_document']) ? $prodItem['upload_document'] : ''; ?>">
                                                <?php if (!empty($prodItem['upload_document'])) { ?>
                                                    <img src="<?= $prodItem['upload_document'] ?>" width="120px" height="120px"
                                                        alt="">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top:30px">
                                            <div class="form-group">
                                                <button type="submit" name="close_save"
                                                    class="btn btn-primary btn-block float-right">Close</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include ("footer.php");
?>