<?php
include_once('header.php');
include('../connection/config.php');
if ($role != '1') {
    $class = 'disabled';
} else {
    $class = '';
}
?>
<div class="content-wrapper">
    <section class="content mt-2">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <?php
                if (isset($_GET['prod_id'])) {
                    $product_id = $_GET['prod_id'];
                    
                    $role_id = $_GET['role'];
                    $query = "select * from payment where id='$product_id'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                ?>
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="card-header">
                                <h4>
                                    Edit Payment Details
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="deal_id" value="<?= $prodItem['deal_id']; ?>">
                                                <input type="hidden" name="id" value="<?= $prodItem['id']; ?>">


                         <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Transaction Date</label>
                                                <div class="input-group date" id="transactiondate" data-target-input="nearest">
                                                    <input type="text" name="transaction_date" value="<?= $prodItem['transaction_date']; ?>" class="form-control datetimepicker-input" data-target="#transactiondate" placeholder="DD-MM-YY" <?= $class; ?> />
                                                    <div class="input-group-append" data-target="#transactiondate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>Transaction Status</label>

                                                <input type="text" name="product" class="form-control" value="<?= $prodItem['product']; ?>" required placeholder="Transaction Status" <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Detail</label>
                                                <input type="text" name="details"  class="form-control" placeholder="Detail" value="<?= $prodItem['details']; ?>" required <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <input type="text" name="acc_no" class="form-control" placeholder="Account No." value="<?= $prodItem['acc_no']; ?>" <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <input type="text" name="bank" class="form-control" placeholder="Bank" value="<?= $prodItem['bank']; ?>" <?= $class; ?>>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Branch</label>
                                                <input type="text" name="branch" class="form-control" placeholder="Branch" value="<?= $prodItem['branch']; ?>" <?= $class; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" name="amount" class="form-control" placeholder="Amount" value="<?= $prodItem['ammount']; ?>" <?= $class; ?>>
                                            </div>
                                        </div>
                                     
                                            <style>
                                                #fmm>input {
                                                    border-radius: 4px;
                                                }

                                                #fmm>input::file-selector-button {
                                                    /* font-weight: bold; */
                                                    height: 35px;
                                                    color: #666666;
                                                    /* padding: 0.5em; */
                                                    border: thin solid grey;
                                                    border-radius: 3px;
                                                }
                                            </style>
                                            <div class="col-md-4">
                                                <div class="form-group" id="fmm">
                                                    <label>Upload Document</label>
                                                    <input type="file" name="upload_docume" class="border" style="width:100%" placeholder="Upload Document" <?= $class; ?>>
                                                    <input type="hidden" name="old_image" value="<?= $prodItem['upload_docume']; ?>"><br>
                                                    &nbsp;
                                                    <?php if (!empty($prodItem['upload_docume'])) { ?>
                                                        <a href="download_deal.php?prod_id=<?php echo  $product_id; ?>">Download
                                                            Now</a> | <a href="<?php echo $prodItem['upload_docume']; ?>" target="_blank">View Document</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php if ($role == 1) { ?>
                                                <div class="col-md-4" style="padding-top:30px">
                                                    <div class="form-group">
                                                        <button type="submit" name="payment_sepr_update" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    } else {
                        echo "No such products found.";
                    }
                }
                ?>
            </div>
        </div>
    </section>
</div>
<?php
include("footer.php");
?>