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
                            Upload Video
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Video</label>

                                            <input type="text" name="video" class="form-control" placeholder="Enter Video URL">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label>Video Title</label>
                                            <input type="text" name="video_title" class="form-control" required placeholder="Video Title">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2 ">
                                        <div class="form-group mt-4">
                                            <button type="submit" name="upload_video" class="btn btn-primary btn-block">Save</button>
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
                           Videos
                        </h4>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Video</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from  videos ORDER BY id DESC";
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
                                                    <?php echo $prod_item['video_title']; ?>
                                                </td>
                                                <td>

                                                  <iframe id="video21" width="50%" src="<?= $prod_item["video"]; ?>" height="75px" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" title="World Cotton Day" data-ready="true"></iframe>
                                                   
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <td>
                                                    <a href="video-edit.php?prod_id=<?php echo $prod_item['id']; ?>" style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="video_delete_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="video_delete_btn" style="width:70px ; height:30px;border:1px solid #B81800;padding:4px; font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Delete</button>
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
<?php
include("footer.php");
?>