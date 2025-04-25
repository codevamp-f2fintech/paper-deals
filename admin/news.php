<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="mx-auto" style="width:98%">
            <div class="row">
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="c">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:1% 0 1% 0.6%;">
                            Add News
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                   

                                    
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Title</label>

                                            <input type="text" name="title" id="ntitle" cols="30" rows="10" class="form-control" placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Image</label>

                                            <input type="file" name="news_image" id="news_image"class="form-control">
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label>News Description</label>

                                            <textarea type="text" name="desc" cols="10" rows="5" class="form-control" required placeholder="News Description"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 float-right">
                                        <div class="form-group mt-2">
                                            <label></label>
                                            <button type="submit" name="news_save" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="c">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                            News
                            <a href="product-add.php" class="btn btn-primary float-right">Add News</a>
                        </h4>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Data</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from  news ORDER BY id DESC";
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
                                                    <?php echo $prod_item['title']; ?>
                                                </td>
                                                <td>

                                                    <div class="modal fade" id="exampleModalToggle<?php echo $unique_identifier; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <button type="button" class="btn-close" style="background:transparent;color:red; border:none; padding-bottom: 5px; font-size:16px; ;" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-xmark"></i> close data</button>
                                                                    <hr>
                                                                    <p class="mt-4"> <?php echo $prod_item['data']; ?></p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button style="border:none; background-color:transparent; color:#007BFF" data-bs-target="#exampleModalToggle<?php echo $unique_identifier; ?>" data-bs-toggle="modal">Read</button>
                                                </td>
                                                    <td>
                                                    <img src="<?php echo $prod_item['image']; ?>" width="200" height="100" style="border-radius:0px;">
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['date']; ?>
                                                </td>
                                                 
                                                <td>
                                                    <a href="news-edit.php?prod_id=<?php echo $prod_item['id']; ?>" style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="news_delete_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="news_delete_btn" style="width:70px ; height:30px;border:1px solid #B81800;padding:4px; font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
include("footer.php");
?>