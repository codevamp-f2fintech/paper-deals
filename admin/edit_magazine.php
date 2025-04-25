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
                                Edit Magazine
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Magazine Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Magazine Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Upload PDF</label>
                                            <input type="file" accept=".pdf" name="import_pdf" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-white">Save</label>
                                            <button type="submit" name="magazine_save"
                                                class="btn btn-primary btn-block float-right">Edit Magazine</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Billing History
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Magazine Name</th>
                                        <th>PDF</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * From magazine";
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
                                                    <?php echo $prod_item['name']; ?>
                                                </td>

                                                <td>
                                                    <a href="download_magazine.php?prod_id=<?php echo $prod_item['id']; ?>">Download
                                                        Magazine</a>
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
                                                <td style="text-align:center;">
                                                    <div class="hide">
                                                        <!--<a href="view-details.php?role=2&prod_id=<?php echo $prod_item['id']; ?>"
                                                    class="btn btn-success">View</a>-->
                                                        <a href="#" class="btn btn-success">
                                                            <?php if ($role == 1) {
                                                                echo 'Edit';
                                                            } else {
                                                                echo 'View';
                                                            } ?>
                                                        </a>
                                                    </div>
                                                    <a href="#" class="action_div"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
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
            </div>
        </div>
    </section>
</div>
<?php
include ("footer.php");
?>