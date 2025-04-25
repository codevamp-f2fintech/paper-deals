<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from support where id='$product_id'";
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
                                <h4 style="font-size:28px;color:#1C2434;margin:20px 0 11px 3px">
                                    View Support
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="id" value="<?= $prodItem['id'] ?>"></input>
                                        <input type="hidden" name="table_name" value="support"></input>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Subject</label>
                                                    <input type="text" value="<?= $prodItem['subject']; ?>" name="writer" class="form-control" required placeholder="Subject" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Full Name</label>

                                                    <input type="text" value="<?= $prodItem['name']; ?>" name="name" class="form-control" required placeholder="Full Name" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Registred Mobile Number</label>
                                                    <input type="text" value="<?= $prodItem['phone']; ?>" name="phone" class="form-control" required placeholder="Registred Mobile Number" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>Email Id</label>
                                                    <input type="text" value="<?= $prodItem['email']; ?>" name="phone" class="form-control" required placeholder="Email Id" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Message</label>
                                                    <textarea name="para" id="tpara" cols="30" rows="7" class="form-control" placeholder="Enter Paragraph" disabled><?= $prodItem["message"]; ?></textarea>
                                                </div>
                                            </div>
                                            <style>
                                                .select-container {
                                                    margin-bottom: 20px;
                                                }

                                                label {
                                                    display: block;
                                                    margin-bottom: 5px;
                                                    color: #333;
                                                }

                                                .custom-select {
                                                    width: 100%;
                                                    height: 38px;
                                                    border: 1px solid #ccc;
                                                    border-radius: 5px;
                                                    padding: 4px;
                                                    font-size: 16px;
                                                    background-color: #fff;
                                                    appearance: none;
                                                    -webkit-appearance: none;
                                                    -moz-appearance: none;
                                                    outline: none;
                                                }

                                                .custom-select option {
                                                    padding: 10px;
                                                }

                                                .custom-select option[value="0"]:hover {
                                                    background-color: #ffc107;

                                                }

                                                .custom-select option[value="1"]:hover {
                                                    background-color: #28a745;

                                                }

                                                .custom-select option[value="2"]:hover {
                                                    background-color: #dc3545;

                                                }
                                            </style>

                                            <?php if ($role == 1) { ?> <div class="col-md-4">
                                                    <div class="select-container">
                                                        <label for="status">Select Status</label>
                                                        <select name='status' id="status" class="custom-select">
                                                            <option value="0" <?php if ($prodItem['status'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>Pending</option>
                                                            <option value="1" <?php if ($prodItem['status'] == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>Completed</option>
                                                            <option value="2" <?php if ($prodItem['status'] == 2) {
                                                                                    echo 'selected';
                                                                                } ?>>Rejected</option>
                                                        </select>
                                                    </div>

                                                </div> <?php } ?>

                                            <?php if ($role == 1) { ?><div class="col-md-2 mt-4">
                                                    <div class="form-group" style="margin-top: 7px;">
                                                        <label></label>
                                                        <button type="submit" name="update_status" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div> <?php } ?>
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
<?php
include("footer.php");
?>