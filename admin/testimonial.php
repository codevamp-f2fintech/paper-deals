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
                    <div class="card-header">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:1% 0 1% 0.6%;">
                            ADD Testimonial
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post" enctype='multipart/form-data'>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Writer</label>

                                            <input type="text" name="writer" class="form-control" required placeholder="Writer">
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Company</label>

                                            <input type="text" name="company" class="form-control" required placeholder="Company">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Image</label>

                                            <input type="file" name="profile" class="form-control" required placeholder="Image">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>Post</label>

                                            <input type="text" name="post" class="form-control" required placeholder="Post">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <label>Paragraph</label>

                                            <textarea name="para" cols="30" rows="7" class="form-control" placeholder="Enter Paragraph"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class="form-group mt-2">
                                            <label></label>
                                            <button type=" submit" name="testimonial_save" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php include("message.php"); ?>
                    <div class="card-header">
                        <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:5% 0 1% 0.6%;">
                            Testimonial
                            <!--<a href="product-add.php" class="btn btn-primary float-right">Add Testimonial</a>-->
                        </h4>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table " id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Paragraph</th>
                                        <th>Writer</th>
                                          <th>Company</th>
                                        <th>Post</th>
                                                                                <th>Profile</th>

                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from  testimonials ORDER BY id DESC";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $i = 1;
                                        foreach ($query_run as $prod_item) {
                                            // echo $row['name'];
                                    ?>
                                            <tr>

                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <!-- <td>
                                                    <?php echo $prod_item['para']; ?>
                                                </td> -->
                                                <td>

                                                    <div>
                                                        <?php
                                                        // Get the message content
                                                        $message = htmlspecialchars($prod_item['para'], ENT_QUOTES, 'UTF-8');
                                                        // Split the message into words
                                                        $words = explode(' ', $message);
                                                        // Display only the first four words
                                                        $initialMessage = implode(' ', array_slice($words, 0, 4));
                                                        ?>
                                                        <!-- Display the initial text and Read More link -->
                                                        <span class="initialMessage"><?php echo $initialMessage; ?></span>
                                                        <span class="moreText" style="display: none;">
                                                            <?php echo $message; ?>
                                                        </span>
                                                        <a href="javascript:void(0);" class="readMoreLink" onclick="showMoreText(event);">Read..</a>
                                                    </div>


                                                    <script>
                                                        // Function to show the full text
                                                        function showMoreText(event) {
                                                            // Get the element that triggered the event
                                                            const linkElement = event.target;

                                                            // Find the parent div (container) of the Read More link
                                                            const container = linkElement.closest('div');

                                                            // Hide the initial message and Read More link within the parent container
                                                            container.querySelector('.initialMessage').style.display = 'none';
                                                            container.querySelector('.readMoreLink').style.display = 'none';

                                                            // Show the full text within the parent container
                                                            container.querySelector('.moreText').style.display = 'inline';
                                                        }
                                                    </script>



                                                    <!-- </td> -->
                                                </td>

                                                <td>
                                                    <?php echo $prod_item['writer']; ?>
                                                </td>
                                                   <td>
                                                    <?php echo $prod_item['company']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['post']; ?>
                                                </td>
                                                 <td>
                                                    <img src="<?php echo $prod_item['profile']; ?>" style="width:60px; height:60px;border-radius:30px;">
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_at']; ?>
                                                </td>
                                                <td>
                                                    <a href="testimonial-edit.php?prod_id=<?php echo $prod_item['id']; ?>" style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="testmo_delete_id" value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="testimonial_delete_btn" style="width:70px ; height:30px;border:1px solid #B81800;padding:4px; font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Delete</button>
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