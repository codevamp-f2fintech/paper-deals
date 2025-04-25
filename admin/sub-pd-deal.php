<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div>
                <h4 style="font-weight:500;font-size:28px;color:#1C2434;margin:2% 0 1% 0.6%;">
                    Close Sub Deals
                </h4>
            </div>
            <div class="card">

                <div class="card-body">
                    <table class="table  table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>Deal ID</th>
                               <th>PD Executive</th>
                                <th>Mobile No</th>
                          
                                    <th>Buyer</th>
                                    <th>Buyer No</th>
                              
                              
                                    <th>Seller</th>
                                    <th>Seller No</th>
                         
                            
                               <th>Product</th>
                                 <th>Category</th>

                                <th>Deal Size</th>
                                    <th>Amount</th>
                                <th>Contact Person</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                            
                               <th>Commission</th>
                               <!-- <th>Buyer Commission</th>
                               <th>Seller Commission</th> -->
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $deal_id=$_GET['deal_id'];
                                $query = "SELECT * From pd_deals where deal_status=7 and deal_id='$deal_id'";
                            } else {
                                 $deal_id=$_GET['deal_id'];
                                $id=$_SESSION['id'];
                                $query = "SELECT * FROM pd_deals WHERE status=1 AND deal_status=7 AND  seller_id='$id' AND  deal_id='$deal_id' ORDER BY id DESC";
                            }
                            // echo $query; die();
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
                                              
                                              
                                            <?php echo '00'.$prod_item['deal_id'] ?>
                                               
                                        </td>
                                    
                                         <td>
                                            <?php echo IsUser_Name($prod_item['user_id']); ?>
                                        </td>
                                        <td>
                                            <?php $Id = $prod_item['user_id'];
                                            $query = mysqli_query($conn, "Select * from users where user_type=1 and active_status=1 AND id=$Id");
                                            $data1 = mysqli_fetch_assoc($query);
                                            echo $data1['phone_no'];
                                            ?>
                                        </td>
                                      
                                            <td>
                                                <?php echo IsUser_Name($prod_item['buyer_id']); ?>
                                            </td>
                                            <td>
                                                <?php echo IsUser_phone($prod_item['buyer_id']); ?>
                                            </td>
                                       
                                    
                                            <td>
                                                <?php echo IsUser_Name($prod_item['seller_id']); ?>
                                            </td>
                                            <td>
                                                <?php echo IsUser_phone($prod_item['seller_id']); ?>
                                            </td>
                                    
                                    
                                   
                                           <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>
                               
                                         <td>
                                            <?php 
                                            
                                           if($prod_item['category']!=0){
                                            $catid=$prod_item['category'];
                                        }
                                            else{ 
                                                $catid="";
                                             }

                                             $sqlrun = mysqli_query($conn, "Select * from new_category where id='$catid'");
                                               echo mysqli_fetch_assoc($sqlrun)['name'];   

                                          
                                          ?>
                                        </td>
                                 
                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>
                                          <td>
                                            <?php echo $prod_item['deal_amount']; ?>
                                        </td>
                                        <td>
                                            <?php
                                             $user_id=$prod_item['seller_id'];
                                            $seller=mysqli_query($conn,"Select contact_person,email,phone from organization where user_id='$user_id'");
                                            $user=mysqli_fetch_assoc($seller);
                                            
                                            echo $user['contact_person']; ?>
                                        </td>
                                      
                                        <td>
                                        <?php echo $user['phone']; ?>
                                        </td>


                                        <td>
                                            <?php echo $user['email']; ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $prod_item['commission']; ?>
                                        </td>
                                        <!-- <td>
                                            <?php //echo $prod_item['buyer_commission']; ?>
                                        </td>
                                        <td>
                                            <?php //echo $prod_item['seller_commission']; ?>
                                        </td> -->
                                        <td>
                                            <?php echo $prod_item['created_on']; ?>
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
                                        <!-- ================ -->
                                        <td style="text-align:center;  ">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="border:none;">
                                                    <?php if ($role == 1) { ?>
                                                        <?php if ($prod_item['status'] == '1') { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="return_url" value="target-pd-deals.php">
                                                                <input type="hidden" name="deal_id" value="<?= $prod_item['id']; ?>">
                                                                <li>
                                                                    <button type="submit" name="deactive_pd_deal" class="dropdown-item">Deactivate</button>
                                                                </li>
                                                            </form>
                                                        <?php } else { ?>
                                                            <form action="code.php" method="post">
                                                                <input type="hidden" name="return_url" value="target-pd-deals.php">
                                                                <input type="hidden" name="deal_id" value="<?= $prod_item['id']; ?>">
                                                                <li>
                                                                    <button type="submit" name="active_pd_deal" class="dropdown-item">Activate</button>
                                                                </li>
                                                            </form>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <li>
                                                        <a href="edit-pd-deal.php?role=<?= $_SESSION['role']; ?>&prod_id=<?php echo $prod_item['id']; ?>" class="dropdown-item">
                                                            <?php if ($role == 1) {
                                                                echo 'Edit';
                                                            } else {
                                                                echo 'View';
                                                            } ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <!-- ============= -->


                                        <!-- ================ -->
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous">
</script>
<?php
include("footer.php");
?>