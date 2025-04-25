<?php
include_once('header.php');
include('../connection/config.php');
?>
<div class="content-wrapper">
    
    <?php
  
    if (isset($_GET['prod_id']) || isset($_GET['id'])) {
        $product_id = $_GET['prod_id'];
        $id = $_GET['id'];
        
        
        if($product_id){
            $query = "select * from enquiry where id='$product_id'";
        }
        if($id){
        $query = "SELECT enquery_message.status as msgstaus,enquery_message.id as msgid,enquery_message.seller_id,enquery_message.created_at,enquery_message.enq_id,enquiry.*,organization.organizations,organization.user_id from enquery_message LEFT JOIN enquiry on enquiry.id=enquery_message.enq_id LEFT JOIN organization on organization.user_id=enquery_message.seller_id where enquery_message.id='$id'";
    }
  
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $prodItem = mysqli_fetch_array($query_run);
            // print_r($prodItem);
    ?>
            <section class="content mt-4">
                <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class=" mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:2    0px 0 11px 3px">
                                    View Enquiry
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="id" value="<?= $prodItem['id'] ?>" id="e_id"></input>
                                        <input type="hidden" name="table_name" value="enquiry"></input>
                                        <?php  if($role==2){
                                            $msgid=$prodItem['msgid'];
                                            $msgstatus=$prodItem['msgstaus'];
                                           
                                            ?>
                                        <input type="hidden" name="table_name" value="enquery_message"></input>
                                        <input type="hidden" name="msgid" value="<?php echo $msgid; ?>"></input>
                                        <input type="hidden" name="msgstaus" value="<?php echo $msgstatus; ?>"></input>

                                        <?php  } ?>

                                        <div class="row">
                                    <?php if ($_SESSION['role'] != 2) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person</label>
                                                    <input type="text" value="<?= $prodItem['name']; ?>" name="name" class="form-control" required placeholder="Contact Name" disabled>

                                                </div>
                                            </div>
                                           
<?php } ?>
                                             <?php if ($_SESSION['role'] != 2 ) { ?>
                                                <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Phone No</label>

                                                    <input type="text"  value="<?= $prodItem['phone']; ?>" name="phone" class="form-control" required placeholder="Contact No" disabled>
                                                </div>
                                            </div>

                                                 <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Email</label>

                                                    <input type="text"  value="<?= $prodItem['email']; ?>" name="email" class="form-control" required placeholder="Email" disabled>
                                                </div>
                                            </div>
                                                <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Company Name</label>

                                                    <input type="text"  value="<?= $prodItem['company_name']; ?>" name="email" class="form-control" required placeholder="Company Name" disabled>
                                                </div>
                                            </div>
                                            <?php } ?>
                                              <?php if($prodItem['buyer_id']!=0)  {?>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Buyer id</label>
                                                    <input type="text" value="<?= "KPDB_".$prodItem['buyer_id']; ?>" name="mill" class="form-control" required placeholder="Companay Name" disabled>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>City</label>
                                                    <input type="text" value="<?= $prodItem['city']; ?>" name="city" class="form-control" required placeholder="Quality" disabled>
                                                </div>
                                            </div>
                                            
                                                <?php if($_SESSION['role']==1)  {?>
                                              <div class="col-md-12">
                                                <div class="form-group">

                                                    <label>Seller Id</label>

                                                    <input type="text" style="width:32.5%;" value="<?= "KPDS_".$prodItem['user_id']; ?>" name="product" id="product" class="form-control" required placeholder="Seller Id" disabled>
                                                </div>
                                            </div>
                                            <?php } ?>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="shade">Category</label>
                                                        <select name="category_id" class="form-control" disabled>
                                                            <option value="">--Select Category--</option>
                                                            <?php
                                                            $query = mysqli_query($conn, "Select * From new_category");
                                                            while ($data = mysqli_fetch_array($query)) { ?>
                                                                <option value="<?= $data['id'] ?>" <?php if (isset($prodItem["category_id"]) && $prodItem["category_id"] == $data['id']) {
                                                                      echo 'Selected';
                                                                  } ?>>
                                                                    <?= $data['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php  if($prodItem['product']!=""){ ?>
                                             <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Product</label>

                                                    <input type="text" value="<?= $prodItem['product']; ?>" name="product" id="product" class="form-control" required placeholder="Product" disabled>
                                                </div>
                                            </div>
                                          <?php } ?>
                                           <?php  if($prodItem['shade']!=""){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Shade</label>
                                                    <input type="text" value="<?= $prodItem['shade']; ?>" name="shade" class="form-control" required placeholder="Rate/Price" disabled>
                                                </div>
                                            </div>
                                            <?php } ?>
                                           <?php  if($prodItem['gsm']!=""){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Gsm</label>
                                                    <input type="text" value="<?= $prodItem['gsm']; ?>" name="gsm" class="form-control" required placeholder="Area/City" disabled>
                                                </div>
                                            </div>
                                             <?php } ?>
                                           <?php  if($prodItem['size']!=""){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Size in inch</label>
                                                    <input type="text" value="<?php echo $prodItem['size']; ?>" name="preference" class="form-control" required placeholder="Buyer/Seller Preference" disabled>
                                                </div>
                                            </div>
                                                <?php } ?>
                                           <?php  if($prodItem['bf']!=""){ ?>
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>BF</label>
                                                    <input type="text" value="<?php echo $prodItem['bf']; ?>" class="form-control" placeholder="BF" disabled>
                                                </div>
                                            </div>
                                             <?php } ?>
                                           <?php  if($prodItem['rim']!=""){ ?>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Rim</label>
                                                    <input type="text" value="<?php echo $prodItem['rim']; ?>" class="form-control" placeholder="Rim" disabled>
                                                </div>
                                            </div>
                                              <?php } ?>
                                           <?php  if($prodItem['sheat']!=""){ ?>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sheet</label>
                                                    <input type="text" value="<?php echo $prodItem['sheat']; ?>" class="form-control" placeholder="Sheet" disabled>
                                                </div>
                                            </div>
                                              <?php } ?>
                                           <?php  if($prodItem['brightness']!=""){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Brightness</label>
                                                    <input type="text" value="<?php echo $prodItem['brightness']; ?>" class="form-control" placeholder="Brightness" disabled>
                                                </div>
                                            </div>
                                            <?php } ?>
                                       
                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Stock in Kg</label>
                                                    <input type="text" value="<?php //echo $prodItem['stock_in_kg']; ?>" class="form-control" placeholder="Business Name" disabled>
                                                </div>
                                            </div> -->

                                            <!-- <div class="col-md-4">
                                                <div class="form-group">

                                                    <label>Price per Kg</label>
                                                    <input type="text" value="<?= $prodItem['price_per_kg']; ?>" name="price_per_kg" class="form-control" required placeholder="Quantity" disabled>
                                                </div>
                                            </div> -->
                                      
                                           <?php  if($prodItem['quantity_in_kg']!=""){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Quantity in Kg</label>
                                                    <input type="text" value="<?= $prodItem['quantity_in_kg']; ?>" name="quantity_in_kg" class="form-control" required placeholder="Transportation Required" disabled>
                                                </div>
                                            </div>
                                                  <?php } ?>
                                                     <?php  if($prodItem['remarks']!=""){ ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <textarea name="para" id="tpara" rows="2" class="form-control" placeholder="Anything Else" disabled style="resize:none; height:38px;"><?= $prodItem["remarks"]; ?></textarea>
                                                </div>
                                            </div>
  <?php } ?>
                                                   
                                            <?php if ($role == 1) { ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Status</label>
                                                        <select name='status' class="form-control">
                                                            <option value="0" <?php if ($prodItem['status'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                Pending</option>
                                                            <option value="1" <?php if ($prodItem['status'] == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                Accepted</option>
                                                            <option value="2" <?php if ($prodItem['status'] == 2) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                Rejected</option>
                                                        </select>
                                                    </div>
                                                </div><?php } else if($role == 2){ ?>

  <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select Status</label>
                                                        <select name='status' class="form-control">
                                                            <option value="0" <?php if ($prodItem['msgstaus'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                Pending</option>
                                                            <option value="1" <?php if ($prodItem['msgstaus'] == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                Accepted</option>
                                                            <option value="2" <?php if ($prodItem['msgstaus'] == 2) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                                                Rejected</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                    <?php  } ?>
                                           
                                            <?php if ($role == 1  || $role == 2) { ?>
                                                <div class="col-md-2">
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
                                            <?php if($_SESSION['role']==1){ ?>
            <section class="content mt-4">
            <div class="mx-auto" style="width:98%">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include("message.php"); ?>
                            <div class=" mt-4">
                                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 11px 3px">
                                    List Seller Enquiry
                                </h4>
                            </div>
                            <div class="card">

                                <div class="card-body">
                                <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        
                                        <th>ID</th>
                                        <!-- <th>Product Name</th> -->
                                        <th>Company Name</th>
                                    <th>City</th>
                                        <!--   <th>Gsm</th>
                                        <th>Size</th>
                                        <th>Weight</th>
                                        <th>Stock in Kg</th>
                                        <th>Price Per Kg</th>
                                        <th>Quantity in Kg</th> -->
                                        <th>Check Box</th>
                                        <!-- <th>Created At </th> -->
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 1) {
                                        $cat=$prodItem["category_id"];
                                    
                                        $query = mysqli_query($conn, "Select * From new_category where id='$cat'");
                                        $category=mysqli_fetch_assoc($query);
                                        $cat_id=$category['name'];
                                     
                                        $query = "SELECT product_new.*,users.name,users.id,organization.id,organization.city,organization.user_id,organization.organizations FROM `product_new` LEFT JOIN users on users.id=product_new.seller_id LEFT JOIN organization on organization.user_id=users.id WHERE product_new.category_id='$cat_id' GROUP BY product_new.seller_id";
                                    //echo $query; 
                                    } else if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1) {
                                        $query = "SELECT * FROM `users` JOIN `organization` ON users.id = organization.user_id WHERE status=1 and seller_id='" . $_SESSION["id"] . "' && ORDER BY id DESC";
                                    } else {
                                        $query = "SELECT * FROM product_new WHERE status=0 and seller_id='" . $_SESSION["id"] . "' ORDER BY id DESC";
                                    }
                                //  echo $query;
                                //  exit;
                                    $query_run = mysqli_query($conn, $query);
                                
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $j = 1;
                                       
                                        foreach ($query_run as $prod_item) {
                                            
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $j; ?>
                                                </td>
                                              
                                                <td>
                                                    <?php echo $prod_item['organizations']; ?>
                                                </td>
                                                 <td>
                                                    <?php echo $prod_item['city']; ?>
                                                </td>
                                                <td>
                                                    <div class="form-check center-form">
                                                        <form id="checkboxForm">
                                                            <div class="form-check">
                                                                <input class="form-check-input check" type="checkbox" value="<?php echo $prod_item['user_id']; ?>"
                                                                 <?php  if($prod_item['created_at']){ ?> <?php  } ?>>
                                                              
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                               
                                             
                                            </tr>
                                        <?php
                                            $j++;
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
                            <button class="btn btn-primary mt-2" id="proceed">Proceed</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

       

    <?php } ?>
    <?php if($_SESSION['role']==1){ ?>
            <section class="content mt-4">
        <div class="col-md-12">
            <?php include("message.php"); ?>
            <div class="mt-4">
                <h4 style="font-size:28px;color:#1C2434;margin:40px 0 15px 3px">
                    Enquiry Show <?php //print_r($_SESSION);  ?>
                </h4>

            </div>
            <div class="card">

                <div class="card-body" style="overflow-x: scroll;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Contact Person</th>
                                <th>Buyer</th>
                                <th>Buyer Phone</th>
                                <th>Seller Id</th>
                                <th>Seller Phone</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>City</th>
                                <th>Shade</th>
                                <th>Gsm</th>
                                <th>Remarks</th>
                                 <th>Created At</th>
                                <th>Status</th>

                               
                                
                        </thead>
                        <tbody>
                            <?php
                         
                                $query = "SELECT enquery_message.status as msgstaus,enquery_message.id,enquery_message.product,enquery_message.seller_id,enquery_message.created_at,enquery_message.enq_id,enquiry.id,enquiry.phone,enquiry.city,enquiry.shade,enquiry.gsm,enquiry.size,enquiry.category_id,enquiry.product as enq_producrt, enquiry.company_name,enquiry.buyer_id,enquiry.remarks,enquiry.name,organization.organizations,enquiry.city,organization.user_id from enquery_message LEFT JOIN enquiry on enquiry.id=enquery_message.enq_id LEFT JOIN organization on organization.user_id=enquery_message.seller_id WHERE enquery_message.enq_id=$product_id";
                               
                         
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $i = 1;
                                foreach ($query_run as $prod_item) {
                                    // echo "<pre>";
                                    // print_r($prod_item);
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>

                                        <td>
                                            <?php echo $prod_item['name']; ?>
                                        </td>
                                        <td>
                                          
                                            <?php 
    $s_id = $prod_item['buyer_id']; 
    $sql = "SELECT organizations, user_id FROM organization WHERE user_id = $s_id";

    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        // Fetch the data as an associative array
        $phone_seller = mysqli_fetch_assoc($query_run);
        echo $phone_seller['organizations'];
       
    } 
?>
                                        </td>
                                       
                                        <td>
                                            <?php echo $prod_item['phone']; ?>
                                        </td>
                                        <td>
                                            <?php echo "KPDS_".$prod_item['user_id']; ?>
                                        </td>
                                        <td>
                                            <?php 
    $s_id = $prod_item['user_id']; 
    $sql = "SELECT phone, user_id FROM organization WHERE user_id = $s_id";

    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        // Fetch the data as an associative array
        $phone_seller = mysqli_fetch_assoc($query_run);
        echo $phone_seller['phone'];
       
    } 
?>

                                        </td>
                                       
                                         <td>
                                             <?php
                                             $category_id=$prod_item['category_id'];
                                                $sql = "Select * from new_category where id=$category_id";
                                                $query_run = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query_run) > 0) {
                                                    foreach ($query_run as $item) {
                                                        echo $item['name'];
                                                    }
                                                }
                                                ?>
                                        </td>
                                         <td>
                                            <?php echo $prod_item['enq_producrt']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['city']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['shade']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['gsm']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['remarks']; ?>
                                        </td>
                                     
                                      
                                        <td>
                                            <?php echo $prod_item['created_at']; ?>
                                        </td>
                                          <td>
                                            <?php if ($prod_item['msgstaus'] == 0) {
                                            ?><a style="width:100px ;border:1px solid #BC3803;padding:4px; height:20px;font-size:13px; color:#BC3803;background-color:#FFEFCA; border-radius:6px;" fffefca>Pending </a>
                                            <?php
                                            } elseif ($prod_item['msgstaus'] == 1) {
                                            ?><a style="width:100px ;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Completed </a>
                                            <?php
                                            } else {
                                            ?><a style="width:100px ;border:1px solid #B81800;padding:4px; height:20px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Rejected</a>
                                            <?php
                                            }
                                            ?>
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
                            } }
                            ?>

                        </tbody>
                    </table>
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-top: 4px solid green;">
      
      <div class="modal-body">
        <div class="text-center p-3">
            <i class="fa fa-check p-3" style="font-size:44px; text-align-center;color:green; border:2px solid green; border-radius:100%;"></i>
        </div>
               
        
     <h4 class="text-center py-4">Enquiry Message Send Successfully</h4>

      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="ErrorModalCenter" tabindex="-1" role="dialog" aria-labelledby="ErrorModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-top: 4px solid red;">
      
      <div class="modal-body">
        <div class="text-center">
            <i class="fa fa-times p-3" style="font-size:35px; text-align-center;color:red; border:2px solid red; border-radius:100%;"></i>
        </div>
               
        
     <h4 class="text-center py-4">Please Select Checkbox..</h4>
     
      </div>
      
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="push.min.js"></script>
<script src="serviceWorker.min.js"></script>


<script>


// function notifications() {
//     Push.create("You have a Notifications", {
//     body: "Enquery Notification please check it'?",
//     icon: 'data:image/png;base64,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',
//     timeout: 4000,
//     onClick: function () {
//         window.focus();
//         this.close();
//     }
// });
    
// }

$("#proceed").on("click", function() {
        var val = [];
        var prod = $('#product').val();
        var e_id = $('#e_id').val();
        $('.check:checked').each(function(i) {
            val[i] = $(this).val();

        });


        if (val == "") {

        $("#ErrorModalCenter").modal('show').fadeOut();
        setTimeout(() => {
               $("#ErrorModalCenter").modal('hide');  
            }, 3000);


} else {

$.ajax({
    url: "message_enq.php", //the page containing php script
    type: "post", //request type,

    data: { id: val,product:prod,e_id:e_id},
    success: function (result) {
//    console.log(result);
//    alert(result);
       if(result){
        // window.location.href = "enquiry_show.php";
        //pushNotify();
        $("#exampleModalCenter").modal('show').fadeOut();
        setTimeout(() => {
               $("#exampleModalCenter").modal('hide');  
               window.location.href = "enquiry_show.php";
            }, 3000);




        }


    }
});
}
    


      
        
    });
</script>

<?php
include("footer.php");
?>
