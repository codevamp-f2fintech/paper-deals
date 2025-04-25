<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <?php
    if (isset($_GET['prod_id'])) {
        $product_id = $_GET['prod_id'];
        $query = "select * from reqcall where id='$product_id'";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
    ?>
            <section class="content mt-4">
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class=" mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:20px 0 11px 3px">
                                    View Request call
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="id" value="<?= $prodItem['id'] ?>"></input>
                                        <input type="hidden" name="table_name" value="reqcall"></input>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" value="<?= $prodItem['name']; ?>" name="name" class="form-control" required placeholder="Name" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mobile No.</label>
                                                    <input type="text" value="<?= $prodItem['phone']; ?>" name="mobile" class="form-control" required placeholder="Mobile No." disabled>
                                                </div>
                                            </div>
                                            <style>
                                                .form-control {
                                                    width: 100%;
                                                    padding: 0.375rem 0.75rem;
                                                    font-size: 1rem;
                                                    font-weight: 400;
                                                    line-height: 1.5;
                                                    color: #495057;
                                                    background-color: #fff;
                                                    background-clip: padding-box;
                                                    border: 1px solid #ced4da;
                                                    appearance: none;
                                                    -webkit-appearance: none;
                                                    -moz-appearance: none;
                                                    border-radius: 0.25rem;
                                                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                                }

                                                .form-control:focus {
                                                    color: #495057;
                                                    background-color: #fff;
                                                    border-color: #80bdff;
                                                    outline: 0;
                                                    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
                                                }

                                                .form-control option {
                                                    padding: 0.375rem 0.75rem;
                                                    font-size: 1rem;
                                                    font-weight: 400;
                                                    line-height: 1.5;
                                                    color: #495057;
                                                    background-color: #fff;
                                                    border: none;
                                                    border-radius: 0;
                                                    transition: background-color 0.1s ease-in-out;
                                                }

                                                .form-control option:hover {
                                                    background-color: #f0f0f0;
                                                }

                                                .form-control option:checked {
                                                    background-color: #f5f5f5;
                                                }

                                                .form-control option:first-child {
                                                    padding-top: 0.5rem;
                                                }

                                                .form-control option:last-child {
                                                    padding-bottom: 0.5rem;
                                                }
                                            </style>
                                            <?php if ($role == 1) { ?><div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Status</label>
                                                        <select name='status' class="form-control">
                                                            <option value="0" <?php if ($prodItem['status'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>Pending</option>

                                                            <option value=" 1" <?php if ($prodItem['status'] == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>Completed</option>

                                                            <option value="2" <?php if ($prodItem['status'] == 2) {
                                                                                    echo 'selected';
                                                                                } ?>>Rejected</option>
                                                        </select>
                                                    </div>
                                                </div><?php } ?>

                                            <?php if ($role == 1) { ?> <div class="col-md-2">
                                                    <div class="form-group" style="margin-top: 7px;">
                                                        <label></label>
                                                        <button type="submit" name="update_status" class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div><?php } ?>
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