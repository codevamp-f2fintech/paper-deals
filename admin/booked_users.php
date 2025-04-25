<?php
include_once ('header.php');
include ('../connection/config.php');
?>
<div class="content-wrapper" style="background-color:#fff;">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include ("message.php"); ?>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Booked Users
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Type</th>
                                <th>Booked Slot</th>
                                <th>Users</th>
                                <th>Consultant Price</th>
                                <th>Status</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM consultant_slots WHERE status=1 AND consultant_id = '" . $_SESSION['id'] . "'";
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
                                            <?php $sql = "Select * from users where id=$prod_item[book_id]";
                                            $query_run = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                                    $item['user_type'];
                                                }
                                                if ($item['user_type'] == 1) {
                                                    $class = 'badge bg-danger';
                                                } else if ($item['user_type'] == 2) {
                                                    $class = 'badge bg-success';
                                                } else if ($item['user_type'] == 4) {
                                                    $class = 'badge bg-info';
                                                } else if ($item['user_type'] == 5) {
                                                    $class = 'badge bg-dark';
                                                } else if ($item['user_type'] == 6) {
                                                    $class = 'badge bg-danger';
                                                } else {
                                                    $class = 'badge bg-warning';
                                                }
                                            }
                                            ?>
                                            <span class="<?= $class; ?>"><?= IsUser_Role($item['user_type']); ?><span>
                                        </td>
                                        <td>
                                            <?php $sql = "Select * from slot where id=$prod_item[slot_id]";
                                            $query_run = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                                    echo $item['from_time'];
                                                }
                                            }
                                            ?> - <?php $sql = "Select * from slot where id=$prod_item[slot_id]";
                                             $query_run = mysqli_query($conn, $sql);
                                             if (mysqli_num_rows($query_run) > 0) {
                                                 foreach ($query_run as $item) {
                                                     echo $item['to_time'];
                                                 }
                                             }
                                             ?>
                                        </td>
                                        <td>
                                            <?php $sql = "Select * from users where id=$prod_item[book_id]";
                                            $query_run = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                                    echo $item['name'];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= $prod_item['consultant_price']; ?>
                                        </td>
                                        <td>
                                            <?php if ($prod_item['status'] == 1) {
                                                ?><a class="badge badge-success">Active</a>
                                                <?php
                                            } else {
                                                ?><a class="badge badge-danger">Inactive</a>
                                                <?php
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['created_at']; ?>
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
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include ("footer.php");
?>