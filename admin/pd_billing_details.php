<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from pd_deals where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
    ?>
            <section class="content mt-2">
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
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class="card-header">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    Deal Information
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="id" value="<?= $prodItem['id'] ?>"></input>
                                        <input type="hidden" name="table_name" value="enquiry"></input>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Deal Id</label>
                                                    <input type="text" value="<?php echo $prodItem['deal_id']; ?>" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Seller Name</label>
                                                    <input type="text" value="<?php echo IsUser_Name($prodItem['seller_id']); ?>" name="name" class="form-control" required placeholder="Seller Name" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Buyer Name</label>
                                                    <input type="text" value="<?php echo IsUser_Name($prodItem['buyer_id']); ?>" name="phone" class="form-control" required placeholder="Buyer Name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Buyer ID</label>
                                                    <input type="text" value="<?php echo $prodItem['buyer_id']; ?>" name="quality" class="form-control" required placeholder="Buyer ID" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Seller ID</label>
                                                    <input type="text" value="<?php echo $prodItem['seller_id']; ?>" name="rd" class="form-control" required placeholder="Seller ID" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Deal Date</label>
                                                    <input type="text" value="<?= $prodItem['created_on']; ?>" name="price" class="form-control" required placeholder="Deal Date" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Deal Size</label>
                                                    <input type="text" value="<?= $prodItem['deal_size']; ?>" name="area" class="form-control" required placeholder="Deal Size" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Commisson</label>
                                                    <input type="text" value="<?= $prodItem['commission']; ?>" name="preference" class="form-control" required placeholder="Commisson(%)" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Total Commisson From Seller</label>
                                                    <input type="text" value="<?= $prodItem['seller_commission']; ?>" name="preference" class="form-control" required placeholder="Total Commisson From Seller" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Total Commisson From Buyer</label>
                                                    <input type="text" value="<?= $prodItem['buyer_commission']; ?>" name="preference" class="form-control" required placeholder="Total Commisson From Buyer" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Product Desc</label>
                                                    <input type="text" value="<?= $prodItem['remarks']; ?>" name="preference" class="form-control" required placeholder="Product Desc" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-header">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    Create Billing
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" value=<?= $product_id ?> name="deal_id">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Billing For</label>
                                                    <input type="text" name="billing_for" class="form-control" placeholder="Billing For" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Billing Name</label>
                                                    <input type="text" name="billing_name" class="form-control" placeholder="Billing Name" required>
                                                </div>
                                            </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <input type="text" name="acc_no" class="form-control" placeholder="Account No." <?= $class; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <input type="text" name="bank" class="form-control" placeholder="Bank" <?= $class; ?>>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Branch</label>
                                                <input type="text" name="branch" class="form-control" placeholder="Branch" <?= $class; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" name="amount" class="form-control" placeholder="Amount" <?= $class; ?>>
                                            </div>
                                        </div>
                                            <div class="col-md-3">
                                                <div class="form-group" id="gmm">
                                                    <label>Invoice</label>

                                                    <input type="file" name="invoice" accept=".pdf" class="border" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group" style="margin-top: 7px;">
                                                    <label></label>
                                                    <button type="submit" name="pd_billing_save" class="btn btn-primary btn-block">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-header">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    Payment History
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <table class="table table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Billing Name</th>
                                                <th>Billing For</th>
                                                <th>Amount</th>
                                                <th>Account Number</th>
                                                <th>Bank</th>
                                                <th>Branch</th>
                                                <th>Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_GET['prod_id'])) {
                                                $product_id = $_GET['prod_id'];
                                                $query = "SELECT * From pd_billing where deal_id='$product_id'";

                                                //echo $query; die();
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
                                                                <?php echo $prod_item['created_at']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $prod_item['billing_name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $prod_item['billing_for']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $prod_item['amount']; ?>
                                                            </td>
                                                             <td>
                                                                <?php echo $prod_item['acc_no']; ?>
                                                            </td>
                                                             <td>
                                                                <?php echo $prod_item['bank']; ?>
                                                            </td>
                                                             <td>
                                                                <?php echo $prod_item['branch']; ?>
                                                            </td>
                                                            <td>
                                                                <a href="pd_downloads.php?prod_id=<?php echo $prod_item['id']; ?>">Download
                                                                    Invoice</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $i++;
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="13" class="dataTables_empty">No Record found</td>
                                                    </tr>
                                            <?php
                                                }
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
    <?php
        } else {
            echo "No such products found.";
        }
    }
    ?>
</div>
<?php
include("footer.php");
?>