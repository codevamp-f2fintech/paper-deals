<?php
include_once ('header.php');
include ('../connection/config.php');

?>
<div class="content-wrapper">
    <div class="" style="margin:3% 1%">
        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:2% 0 1% 0.6%;">
            Categories
            <a href=" add-category.php" class="btn btn-primary float-right">Add Category </a>
        </h4>
    </div>
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include ("message.php"); ?>
            <div class="card">

                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr style="text-align:center;">
                                <th style=" border:none;border-bottom:1px solid #dbdbdb;">ID</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Category Name</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;align-items:center;">Category
                                    Image</th>
                                <th style="border:none;border-bottom:1px solid #dbdbdb;">Status</th>
                                <th style="border:none ; border-right:1px solid #dbdbdb;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "select * from new_category";

                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                                    ?>
                                    <tr>
                                        <td style="border:none;border-bottom:1px solid #dbdbdb; text-align:center  ">
                                            <?php echo $i; ?>
                                        </td>
                                        <td style="border:none;border-bottom:1px solid #dbdbdb;text-align:center  ">
                                            <?php echo $prod_item['name']; ?>
                                        </td>
                                        <td style="border:none;border-bottom:1px solid #dbdbdb;text-align:center  ">
                                            <?php if (!empty($prod_item['image'])) { ?>
                                                <a href="<?= $prod_item['image']; ?>" target="_blank">View
                                                    Image</a>
                                            <?php } ?>
                                        </td>
                                        <td style="border:none;border-bottom:1px solid #dbdbdb;text-align:center  ">
                                            <?php if ($prod_item['status'] == 1) {
                                                echo '<a style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Active  <i class="fa-solid fa-globe" style="color:#1C6C09"></i> </a>';
                                            } elseif ($prod_item['status'] == 0) {
                                                echo '<a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Inactive <i class="bi bi-x-octagon-fill" style="#B81800"></i></a>
                                            <?php';
                                            } ?>
                                        </td>
                                        <style>
                                            #dropdownMenuButton1 {

                                                background-color: #F9FAFB;
                                                text-align: center;

                                                background-size: 200% auto;
                                                color: #007BFF;
                                                box-shadow: 0 0 20px #eee;
                                                border-radius: 4px;

                                                transition: all 0.3s;
                                            }

                                            #dropdownMenuButton1:hover {
                                                background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
                                                color: #767676;
                                                text-decoration: none;
                                            }
                                        </style>
                                        <td style="text-align:center;border-bottom:1px solid #f9f9f9;  ">
                                            <div class=" dropdown">
                                                <a class=" dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                                                    style=" border:none; ">
                                                    <li>
                                                        <a class=" dropdown-item"
                                                            href="edit-categories.php?role=<?= $_SESSION['role']; ?>&user_type=2&prod_id=<?= $prod_item['id']; ?>">
                                                            Edit
                                                        </a>
                                                    </li>

                                                    <?php if ($role == 1) { ?>
                                                        <?php if ($prod_item['status'] == '1') { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                <li>
                                                                    <button type="submit" name="deactive_user_category"
                                                                        class="dropdown-item">Deactive</button>
                                                                </li>
                                                            </form>
                                                        <?php } else { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="user_id" value="<?= $prod_item['id']; ?>">
                                                                <li>
                                                                    <button type="submit" name="active_user_category"
                                                                        class="dropdown-item">Active</button>
                                                                </li>
                                                            </form>
                                                        <?php } ?>
                                                    <?php } ?>
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
                        <td colspan="7">No Record found</td>
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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js"
    integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
    </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include ("footer.php");
?>