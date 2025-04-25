<?php
include_once('header.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">
                            Add Main Logo
                        </h4>
                    </div>
                    <div class="card">
                        <style>
                            #lmm>input {
                                border-radius: 4px;
                            }

                            #lmm>input::file-selector-button {
                                /* font-weight: bold; */
                                height: 35px;
                                color: #666666;
                                /* padding: 0.5em; */
                                border: thin solid grey;
                                border-radius: 3px;
                            }
                        </style>
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="lmm">
                                            <label>Main Logo</label><br />
                                            <input type="file" name="logo_picture" class="border" style="width:100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Logo Name</label>

                                            <input name="logo_name" cols="30" rows="7" class="form-control" placeholder="Logo Name">
                                        </div>
                                    </div>
                                    <div class="col-md-2 float-right">
                                        <div class="form-group mt-2">
                                            <label></label>
                                            <button type="submit" name="site_logo_save" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:20px;color:#1C2434;margin:40px 0 20px 3px">
                            Logo
                            <a href="product-add.php" class="btn btn-primary float-right">Add Logo</a>
                        </h4>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table " id="dataTable">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th>ID</th>
                                        <th>Main Logo</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from  site_logo ORDER BY id DESC";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $i = 1;
                                        foreach ($query_run as $prod_item) {
                                            // echo $row['name'];
                                    ?>
                                            <tr style="text-align:center;">

                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['logo_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <!-- <td style="text-align:center;">
                                                    <div class="hide">
                                                        <a href="edit_logo.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">Edit</a>
                                                        <hr>
                                                        <form action="code.php" method="post">
                                                            <input type="hidden" name="logo_delete_nac" value="<?= $prod_item['id']; ?>">
                                                            <button type="submit" name="main_logo_delete_btn" class="dropdown-item">Delete</button>
                                                        </form>
                                                        <?php if ($role == 1) { ?>
                                                    </div>
                                                    <a href="#" class="action_div"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td> -->
                                                <!-- ================= -->
                                                <td style="text-align:center;   ">
                                                    <div class=" dropdown">
                                                        <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                            <li>
                                                                <a href="edit_logo.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">Edit</a>
                                                            </li>
                                                            <hr>
                                                            <li>
                                                                <form action="code.php" method="post">
                                                                    <input type="hidden" name="logo_delete_nac" value="<?= $prod_item['id']; ?>">
                                                                    <button type="submit" name="main_logo_delete_btn" class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                        </div>
                        </td>
                        <!-- ==================== -->
                        </tr>
                <?php
                                                            $i++;
                                                        }
                                                    }
                                                } else {
                ?>
                <tr>
                    <td class="colspan-8">No Record found</td>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<?php
include("footer.php");
?>