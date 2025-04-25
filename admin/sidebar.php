<?php
$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$role = $_SESSION['role'];

//echo $curPageName; 
?>

<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#027ff0">


  <!-- Brand Logo -->
  <a href="./index.php" class="brand-link">
    <img src="https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/uploads/logo+(2).jpg " alt="AdminLTE Logo" style="border-radius:0px; height:40px;">
    
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="icon/icons8-user-96.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="" class="d-block">
          <?= $_SESSION["name"]; ?>
        </a>
      </div>
    </div>

 

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
     
          <li class="nav-item">
            <a href="./index.php" class="nav-link <?php if ($curPageName == "index.php" || $curPageName == "") {
              echo 'active';
            } ?>">
              <i class="nav-icon fas fa-tachometer-alt" style="color: red"></i>
              <p>Dashboard</p>
            </a>
          </li>
     
        <?php if ($role == 1 || $role == 2 || $role == 3) { ?>
          <li class="nav-item">
            <a href="" class="nav-link" <?php if ($curPageName == "support_show.php") {
              echo 'menu-open';
            } ?>>
              <i class="nav-icon fas fa-chart-pie" style="color: yellow"></i>
              <p>
                Enquiry
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <?php if($role == 2 || $role == 3){ ?>
              <ul class="nav nav-treeview">
              
              
              <li class="nav-item">
                <a href="enquiry_show.php" class="nav-link <?php if ($curPageName == "enquiry_show.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <!-- <span class="badge badge-info right">
                    <?= Show_NumRecord('enquiry', '0'); ?>
                  </span> -->
                  <p>Enquiry</p>
                </a>
              </li>
              
              
            </ul>
              <?php } else {?>

            <ul class="nav nav-treeview">
                       
 <?php if ($role == 1) { ?>
              <li class="nav-item">
                <a href="./support_show.php" class="nav-link <?php if ($curPageName == "support_show.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <span class="badge badge-info right">
                    <?= Show_NumRecord('support', '0'); ?>
                  </span>
                  <p>Support</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./request_call.php" class="nav-link <?php if ($curPageName == "request_call.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <span class="badge badge-info right">
                    <?= Show_NumRecord('reqcall', '0'); ?>
                  </span>
                  <p>Request Call</p>
                </a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a href="./enquiry_show.php" class="nav-link <?php if ($curPageName == "enquiry_show.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <!--<span class="badge badge-info right">-->
             <!--Show_NumRecord('enquiry', '0');-->
                  </span>
                  <p>Profile Enquiry</p>
                </a>
              </li>
               <?php if ($role == 1) { ?>

              <li class="nav-item">
                <a href="contact-us.php" class="nav-link <?php if ($curPageName == "contact-us.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <span class="badge badge-info right">
                    <?= Show_NumRecord('contact_us', '0'); ?>
                  </span>
                  <p>Contact Us</p>
                </a>
              </li>
              <?php } ?>
              <?php if ($role == 1 || $role == 4) { ?>
                <li class="nav-item">
                  <a href="./spot_price_enqu.php" class="nav-link <?php if ($curPageName == "spot_price_enqu.php") {
                    echo 'active';
                  } ?>">
                    <i class="fa fa-book nav-icon"></i>
                    <span class="badge badge-info right">
                      <?= Show_NumRecord('spot_price_enquiry', '0'); ?>
                    </span>
                    <p>Spot Price Enquiry</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
            <?php } ?>

          </li>
        <?php } ?>
             <?php if ($role == 1 || $role == 4) { ?>
          <li class="nav-item">
         
             <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>Seller
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
           
             <ul class="nav nav-treeview">
             <?php if ($role == 1 || $role == 2 || $role == 4) { ?>
                <li class="nav-item">
                <a href="./seller.php" class="nav-link">
              <i class="fa fa-book nav-icon"></i>
              <span class="badge badge-info right">
                <?php
                $query = "SELECT COUNT(*) as count FROM users WHERE active_status = 0 and user_type = 2";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                  $prodItem = mysqli_fetch_array($query_run);
                  $count = $prodItem['count'];
                  echo $count;
                }
                ?>
              </span>
              <p>Seller</p>
               </a>
                  </li>
                  <?php if ($role == 1 || $role == 2) { ?>
                <li class="nav-item">
                  <a href="./product-add.php?user_type=seller" class="nav-link <?php if ($curPageName == "product-add.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Products</p>
                  </a>
                </li>
                                       <?php } ?>

              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
       <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>Buyer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>


            <ul class="nav nav-treeview">
             <?php if ($role == 1 || $role == 2 || $role == 4) { ?>
                <li class="nav-item">
                  <a href="./buyer.php" class="nav-link <?php if ($curPageName == "buyer.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <span class="badge badge-info right">
                <?php
                $query = "SELECT COUNT(*) as count FROM users WHERE active_status = 0 and user_type = 3";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                  $prodItem = mysqli_fetch_array($query_run);
                  $count = $prodItem['count'];
                  echo $count;
                }
                ?>
              </span>
              <p>Buyer</p>
              
            </a>
                </li>
                  <?php if ($role == 1 || $role == 2) { ?>
                 <li class="nav-item">
                  <a href="./product-add.php?user_type=buyer" class="nav-link <?php if ($curPageName == "product-add.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Products</p>
                  </a>
                </li>
                  <?php } ?>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
   
       
        <?php if ($role == 1 || $role == 2 || $role == 3 || $role == 4) { ?>
          <li class="nav-item <?php if (($curPageName == "create-deal.php") || ($curPageName == "current-deals.php") || ($curPageName == "target-deals.php")) {
            echo 'menu-open';
          } ?>">
            <a href="" class="nav-link <?php if (($curPageName == "create-deal.php") || ($curPageName == "current-deals.php") || ($curPageName == "target-deals.php")) {
              echo 'active';
            } ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>Direct/Single Order
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($role == 1) { ?>
                <li class="nav-item">
                  <a href="create-deal.php" class="nav-link <?php if ($curPageName == "create-deal.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Direct Order</p>
                  </a>
                </li>
              <?php } ?>
              <li class="nav-item">
                <a href="current-deals.php" class="nav-link <?php if ($curPageName == "current-deals.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Current Direct Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="target-deals.php" class="nav-link <?php if ($curPageName == "target-deals.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Close Direct Order</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($role == 1 || $role == 2 || $role == 3 || $role == 4) { ?>
          <li class="nav-item <?php if (($curPageName == "create-pd-deal.php") || ($curPageName == "process-pd-deal.php") || ($curPageName == "process-pd-deals-list.php") || ($curPageName == "current-pd-deals.php") || ($curPageName == "target-pd-deals.php")) {
            echo 'menu-open';
          } ?>">
            <a href="" class="nav-link <?php if (($curPageName == "create-pd-deal.php") || ($curPageName == "process-pd-deal.php") || ($curPageName == "process-pd-deals-list.php") || ($curPageName == "current-pd-deals.php") || ($curPageName == "target-pd-deals.php")) {
              echo 'active';
            } ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>PD/Bulk Deals
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($role == 1) { ?>
                <li class="nav-item">
                  <a href="create-pd-deal.php" class="nav-link <?php if ($curPageName == "create-pd-deal.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Paper Deals</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="process-pd-deals-list.php" class="nav-link <?php if ($curPageName == "process-pd-deal.php" || $curPageName == "process-pd-deals-list.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Process Paper Deals</p>
                  </a>
                </li>
              <?php } ?>
              <li class="nav-item">
                <a href="current-pd-deals.php" class="nav-link <?php if ($curPageName == "current-pd-deals.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Current Paper Deals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="target-pd-deals.php" class="nav-link <?php if ($curPageName == "target-pd-deals.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Close Paper Deals</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($role == 1) { ?>
          <li class="nav-item">
            <a href="" class="nav-link" <?php if ($curPageName == "") {
              echo 'menu-open';
            } ?>>
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
               Direct Order Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="img.php" class="nav-link <?php if ($curPageName == "img.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direct Order Business Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="img2.php" class="nav-link <?php if ($curPageName == "img2.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direct Order Status Report</p>
                </a>
              </li>
              <li class="nav-item"> 
                <a href="img3.php" class="nav-link <?php if ($curPageName == "img3.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direct Order Closure Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="deal_process_report_main.php" class="nav-link <?php if ($curPageName == "deal_process_report_main.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direct Order Process Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link" <?php if ($curPageName == "") {
              echo 'menu-open';
            } ?>>
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Paper Deals Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="img5.php" class="nav-link <?php if ($curPageName == "img5.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paper Deals Business Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="img6.php" class="nav-link <?php if ($curPageName == "img6.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paper Deals Status Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="img7.php" class="nav-link <?php if ($curPageName == "img7.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paper Deals Closure Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pd_deal_process_report_main.php" class="nav-link <?php if ($curPageName == "pd_deal_process_report_main.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paper Deals Process Report</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
      
                <?php if ($role == 2 || $role == 3 || $role == 5) { ?>
          <li class="nav-item">
            <a href="./view-details.php?role=<?= $role ?>&prod_id=<?= $_SESSION['id'] ?>" class="nav-link <?php if ($curPageName == "company_details.php") {
                  echo 'active';
                } ?>">
              <i class="fa fa-building nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>
             
          <?php  } ?>
          <?php if ($role == 5) { ?>
          <li class="nav-item <?php if ($curPageName == "" || $curPageName == "") {
            echo 'menu-open';
          } ?>">
            <a href="" class="nav-link <?php if ($curPageName == "" || $curPageName == "") {
              echo 'active';
            } ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>Create Slot
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($role == 5) { ?>
            
                <li class="nav-item">
                  <a href="consultant_slot.php" class="nav-link <?php if ($curPageName == "consultant_slot.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Consultant Slot</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
        <?php if ($role == 5) { ?>
          <li class="nav-item">
            <a href="./booked_users.php" class="nav-link <?php if ($curPageName == "booked_users.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Booked Users</p>
            </a>
          </li>
        <?php } ?>
            <?php if ($role == 1)  { ?>
          <li class="nav-item <?php if ($curPageName == "create-deal.php" || $curPageName == "current-deals.php") {
            echo 'menu-open';
          } ?>">
            <a href="" class="nav-link <?php if ($curPageName == "create-deal.php" || $curPageName == "current-deals.php") {
              echo 'active';
            } ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>Live Stock
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
           
             
                <li class="nav-item">
                  <a href="UpdateSpotPrice.php" class="nav-link <?php if ($curPageName == "UpdateSpotPrice.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Edit Live Stock</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="view_mic_price.php" class="nav-link <?php if ($curPageName == "view_mic_price.php") {
                    echo 'active';
                  } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Live Stock</p>
                  </a>
                </li>
            
            </ul>
          </li>
        <?php } ?>
        
      <?php if ($role == 1) { ?>
          <li class="nav-item">
            <a href="./live_price.php" class="nav-link <?php if ($curPageName == "live_price.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Live Price</p>
            </a>
          </li>
        <?php } ?>
        
          <?php if ($role == 2 || $role == 1) { ?>
          <li class="nav-item">
            <a href="./view_stock.php" class="nav-link <?php if ($curPageName == "view_stock.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Stocks</p>
            </a>
          </li>
        <?php } ?>
   
         
        <?php if ($role == 1 || $role == 4) { ?>
        
          <li class="nav-item <?php if ($curPageName == "" || $curPageName == "") {
            echo 'menu-open';
          } ?>">
            <a href="" class="nav-link <?php if ($curPageName == "" || $curPageName == "") {
              echo 'active';
            } ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>Billing History
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="billing_history.php" class="nav-link <?php if ($curPageName == "billing_history.php") {
                  echo 'active';
                } ?>">

                  <i class="far fa-circle nav-icon"></i>
                  <p>Direct Deal Billing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pd_billing_history.php" class="nav-link <?php if ($curPageName == "pd_billing_history.php") {
                  echo 'active';
                } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PD Deal Billing</p>
                </a>
              </li>
            </ul>
          </li>
               <?php if ($role == 1) { ?>
          <li class="nav-item">
            <a href="./consultant.php" class="nav-link <?php if ($curPageName == "consultant.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Consultant</p>
            </a>
          </li>
        <?php } ?>

        <!--
          <li class="nav-item <?php //if ($curPageName == "" || $curPageName == "") {
           // echo 'menu-open';
          //} ?>">
            <a href="" class="nav-link <?php //if ($curPageName == "" || $curPageName == "") {
              //echo 'active';
           // } ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>Business History
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="business_history.php" class="nav-link <?php //if ($curPageName == "business_history.php") {
                  //echo 'active';
                //} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direct Deal History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pd_business_history.php" class="nav-link <?php //if ($curPageName == "pd_business_history.php") {
                  //echo 'active';
                //} ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PD Deal History</p>
                </a>
              </li>
            </ul>
          </li>
        -->
        <?php } ?>
        <?php if ($role == 1 || $role == 3 || $role == 2 || $role == 4) { ?>
          <li class="nav-item">
          <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p style="    color: #9ce781;
    font-weight: 800;">Subscriptions</p>
              <i class="fas fa-angle-left right"></i>
            </a>
            
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                  <a href="./subscription.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>              <p>Subscriptions</p>
            </a>
              </li>
         <?php if($role==4) { ?>
              <li class="nav-item">
                  <a href="plan.php" class="nav-link">
<i class="far fa-circle nav-icon"></i>              <p>Subscription Plan</p>
            </a>
              </li>
                    <?php } ?>

            </ul>
          </li>
        <?php } ?>
      <?php if ($role == 1) { ?>
         <li class="nav-item">
            <a href="" class="nav-link" <?php if ($curPageName == "support_show.php") {
              echo 'menu-open';
            } ?>>
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                General Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <?php if($role == 1){ ?>
              <ul class="nav nav-treeview">
              
              
             <li class="nav-item">
            <a href="./testimonial.php" class="nav-link <?php if ($curPageName == "testimonial.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Testimonial</p>
            </a>
          </li>
              
        <?php if ($role == 1) { ?>
          <li class="nav-item">
            <a href="categories.php" class="nav-link <?php if ($curPageName == "categories.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
           
              <p>Categories</p>
            </a>
          </li>
        <?php } ?>
               <li class="nav-item">
            <a href="./site_logo.php" class="nav-link <?php if ($curPageName == "site_logo.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Main Logo</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./bottom_logo.php" class="nav-link <?php if ($curPageName == "bottom_logo.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Association Partners</p>
            </a>
          </li>
            <li class="nav-item">
            <a href="./upload_video.php" class="nav-link <?php if ($curPageName == "upload_video.php") {
              echo 'active';
            } ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Videos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./image.php" class="nav-link <?php if ($curPageName == "image.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Image</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./news.php" class="nav-link <?php if ($curPageName == "news.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>News</p>
            </a>
          </li>
           <?php //if ($role == 1) { ?>
                <!--<li class="nav-item">-->
                <!--  <a href="magazine.php" class="nav-link <?php //if ($curPageName == "magazine.php") {-->
                  //echo 'active';
               // } ?>">
                <!--    <i class="far fa-circle nav-icon"></i>-->
                <!--    <p>Magazine</p>-->
                <!--  </a>-->
                <!--</li>-->
              <?php //} ?>
            </ul>
              <?php } else {?>

            <ul class="nav nav-treeview">
              <?php if ($role == 1 || $role == 4) { ?>
                <li class="nav-item">
                  <a href="./spot_price_enqu.php" class="nav-link <?php if ($curPageName == "spot_price_enqu.php") {
                    echo 'active';
                  } ?>">
                    <i class="fa fa-book nav-icon"></i>
                    <span class="badge badge-info right">
                      <?= Show_NumRecord('spot_price_enquiry', '0'); ?>
                    </span>
                    <p>Spot Price Enquiry</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
            <?php } ?>

          </li>
       <?php } ?>
        <?php if ($role == 1) { ?>
         
        <?php } ?>
        <?php if ($role == 5 || $role == 3 || $role == 2 || $role == 6) { ?>
          <li class="nav-item">

            <a href="userchat.php" class="nav-link <?php if ($curPageName == "../chatapp/login.php") {
                                                        echo 'active';
                                                      } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Chat</p>
            </a>
          </li>
        <?php } ?>
    
        <?php if ($role == 1 || $role == 5) { ?>
          <li class="nav-item">
            <a href="./chat_user.php" class="nav-link <?php if ($curPageName == "chat_user.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Chat History</p>
            </a>
          </li>
        <?php } ?>
     
        <?php if ($role == 2) { ?>
          <li class="nav-item">
            <a href="./product-add.php" class="nav-link <?php if ($curPageName == "product-add.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-book nav-icon"></i>
              <p>Product</p>
            </a>
          </li>
        <?php } ?>
        <?php if ($role == 1) { ?>
         
        <?php } ?>
    
        
       
    
        <!-- <?php if ($role == 1) { ?>
          <li
          class="nav-item <?php if ($curPageName == "" || $curPageName == "") {
            echo 'menu-open';
          } ?>">
          <a href="#"
            class="nav-link <?php if ($curPageName == "" || $curPageName == "") {
              echo 'active';
            } ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>Cotton Bales Spot Price
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if ($role == 1) { ?>
              <li class="nav-item">
                <a href="cottton_bales_sp.php"
                  class="nav-link <?php if ($curPageName == "cottton_bales_sp.php") {
                    echo 'active';
                  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add MIC Price</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="view_mic_price.php"
                class="nav-link <?php if ($curPageName == "view_mic_price.php") {
                  echo 'active';
                } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View MIC Price</p>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if ($role == 1) { ?>
          <li
          class="nav-item <?php if ($curPageName == "create-deal.php" || $curPageName == "current-deals.php") {
            echo 'menu-open';
          } ?>">
          <a href="#"
            class="nav-link <?php if ($curPageName == "create-deal.php" || $curPageName == "current-deals.php") {
              echo 'active';
            } ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>Yarn Spot Price
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if ($role == 1) { ?>
              <li class="nav-item">
                <a href="add_spot_price.php"
                  class="nav-link <?php if ($curPageName == "add_spot_price.php") {
                    echo 'active';
                  } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Spot Price</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="view_spot_price.php"
                class="nav-link <?php if ($curPageName == "view_spot_price.php") {
                  echo 'active';
                } ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>View Spot Price</p>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?> -->
      
      
          <?php if ($role == 2 || $role == 3 || $role == 4) { ?>
            <li class="nav-item">
            <a href="changepassword.php" class="nav-link <?php if ($curPageName == "change_password.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-star nav-icon"></i>
              <p>Change Password</p>
            </a>
          </li>
        <?php } ?>
        <?php if ($role == 4 || $role == 1) { ?>
          <li class="nav-item">
            <a href="./users.php" class="nav-link <?php if ($curPageName == "users.php") {
              echo 'active';
            } ?>">
              <i class="fa fa-users nav-icon"></i>
              <p><?php if ($role == 4) { ?>Add Admin <?php } else { ?>Users <?php  } ?></p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>