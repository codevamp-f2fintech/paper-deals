<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 style="font-size:25px;color:#1C2434;margin:40px 0 20px 3px">
                            Add Magazine
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Magazine Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Magazine Name">
                                        </div>
                                    </div>
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
                                    <div class="col-md-4">
                                        <div class="form-group" id="lmm">

                                            <label>Upload PDF</label><br />
                                            <input type="file" accept=".pdf" name="import_pdf" class="border" style="width:100%" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="text-white">Save</label>
                                            <button type="submit" name="magazine_save" class="btn btn-primary btn-block float-right">Add Magazine</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 style="font-size:25px;color:#1C2434;margin:50px 0 20px 3px">
                            Magazine
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table " id="dataTable">
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
                                    $query = "SELECT * From magazine ORDER BY id DESC";
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
                                                    ?><a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active </a>
                                                    <?php
                                                    } else {
                                                    ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">inactive </a>
                                                    <?php
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <td style="  ">
                                                    <div class=" dropdown">
                                                        <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style=" border:none; ">
                                                            <li>
                                                                <a href="magazine_edit.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">
                                                                    <?php if ($role == 1) {
                                                                        echo 'Edit';
                                                                    } else {
                                                                        echo 'View';
                                                                    } ?>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                        </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<?php
include("footer.php");
?>