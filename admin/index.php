<?php
include_once ('header.php');
include ('../connection/config.php');
$ss = $_SESSION['id'];
$deal_status = IsDeal_Status($_GET['prod_id']);
// Query to count rows and sum deal_size in 'deals' table

if($_SESSION['role'] == 4){
    
    $sql_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM deals";
    
}else if($_SESSION['role'] == 1){
        
        $sql_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM deals";

}else if($_SESSION['role'] == 2 || $_SESSION['role'] == 3){

      $sql_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM deals where buyer_id = '$ss' OR seller_id = '$ss'";
}else{
      $sql_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM deals";

}

$result_deals = $conn->query($sql_deals);

if ($result_deals->num_rows > 0) {
    // Fetch the count and sum
    $row_deals = $result_deals->fetch_assoc();
    $deals_count = $row_deals['count'];
    $deals_sum = $row_deals['sum'];
} else {
    $deals_count = 0;
    $deals_sum = 0;
}

// Query to count rows and sum deal_size in 'pd_deals' table

if($_SESSION['role'] == 4){
    
    $sql_pd_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM pd_deals";
    
}else if($_SESSION['role'] == 1){
    
    $sql_pd_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM pd_deals";
    
}
else if($_SESSION['role'] == 2 || $_SESSION['role'] == 3){
     
     $sql_pd_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM pd_deals where seller_id = '$ss' OR buyer_id = '$ss'";
     
}else{
      $sql_pd_deals = "SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM pd_deals";

}

$result_pd_deals = $conn->query($sql_pd_deals);

if ($result_pd_deals->num_rows > 0) {
    // Fetch the count and sum
    $row_pd_deals = $result_pd_deals->fetch_assoc();
    $pd_deals_count = $row_pd_deals['count'];
    $pd_deals_sum = $row_pd_deals['sum'];
} else {
    $pd_deals_count = 0;
    $pd_deals_sum = 0;
}

// Query to count rows and sum subscription_sum in 'pd_deals' table

if($_SESSION['role'] == 1 || $_SESSION['role'] == 4){
    $sql_transaction = "SELECT COUNT(*) AS count, SUM(commission) AS sum FROM deals";
}else{
    $sql_transaction = "SELECT COUNT(*) AS count, SUM(commission) AS sum FROM deals where seller_id='$ss'";
}
$result_transaction = $conn->query($sql_transaction);
if ($result_transaction->num_rows > 0) {
    // Fetch the count and sum
    $row_transaction = $result_transaction->fetch_assoc();
    $direct_order_count = $row_transaction['count'];
    $direct_order_sum = $row_transaction['sum'];
} else {
    $direct_order_count = 0;
    $direct_order_sum = 0;
}
// Query to count rows and sum revenue in 'pd_deals' table

if($_SESSION['role'] == 1 || $_SESSION['role'] == 4 ){
    $deals = "SELECT COUNT(*) AS count, SUM(total_deal_amount) as sum FROM pd_deals_master WHERE deal_status=7";
    $pd_deals="SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM pd_deals WHERE deal_status=7";
}
else{
    $deals = "SELECT COUNT(*) AS count, SUM(total_deal_amount) as sum FROM pd_deals_master WHERE deal_status=7 AND buyer_id='$ss'";
    $pd_deals="SELECT COUNT(*) AS count, SUM(deal_amount) AS sum FROM pd_deals WHERE deal_status=7 AND buyer_id='$ss'";
}
$result_revenue = $conn->query($deals);
$pd_deals_revenue = $conn->query($pd_deals);

if ($result_revenue->num_rows > 0 || $pd_deals_revenue->num_rows > 0) {
    // Fetch the count and sum
    $row_revenue = $result_revenue->fetch_assoc();
    $pd_deals_revenue = $pd_deals_revenue->fetch_assoc();

    $pd_revenue_count = $row_revenue['count']+$pd_deals_revenue['count'];
    $pd_sum_revenue = $row_revenue['sum']-$pd_deals_revenue['sum'];
} else {
    $pd_revenue_count = 0;
    $pd_sum_revenue = 0;
}
// Store the counts and sums in the array
$cart1_data = [
    'pd_deals_count' => $pd_deals_count,
    'pd_deals_sum' => $pd_deals_sum,
    'deals_count' => $deals_count,
    'deals_sum' =>  $deals_sum,
    'direct_order_count' => $direct_order_count,
    'direct_order_sum' =>  $direct_order_sum,
    'pd_revenue_count' => $pd_revenue_count,
    'pd_sum_revenue' =>  $pd_sum_revenue
  
];

// Output the array
json_encode($cart1_data);
?>
<!-- Content Wrapper. Contains page content -->
<?php if ($_SESSION['role'] == 5 || $_SESSION['role'] == 6 || $_SESSION['role'] == 1 || $_SESSION['role'] == 2 || $_SESSION['role'] == 4 || $_SESSION['role'] == 3) { ?>
  <div class="content-wrapper" style="background-color:#fff;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <?php include ("message.php"); ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1><input class="d-none" type="text" id="login_id"
              value="<?php echo $_SESSION['id']; ?>">
            <input class="d-none" type="text" id="role" value="<?php echo $_SESSION['role']; ?>">
            <!-- <input  type="text" id="count"> -->

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2 || $_SESSION['role'] == 3 || $_SESSION['role'] == 4) { ?>
          <div class="row">
           <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Total Business</h3>
                       
                        <div class="card-tools">
                         
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        <h5>Total - <?=
                        $pd_sum_revenue + $direct_order_sum;
                        ?></h5>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        
            <!-- /.col (LEFT) -->

            <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="card card-info">
                <div class="card-header">
                  <div class="card-title flex" style="display: flex;
    justify-content: space-between;
    width: 100%;
    align-items: center;margin-bottom:4px !important;">
                    <span>
                    <?php
if ($ss == 1) {
    echo "Total Leads";
} else {
    echo "Total Deals";
}
?>
 
</span><span>
    <select id="timePeriod" class="form-control">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
</span>
                       
                  </div>

                  <div class="card-tools">
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart" style="display:none;">
                    <canvas id="lineChart"
                      style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <?php include("graph.php"); ?>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col (RIGHT) -->
           
          </div>
          <!-- /.row -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-6">
                       <a href="current-deals.php" style="text-decoration: none;">

              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>
                    <?php
                 if ($role == 2 || $role == 3) {
    // Query to get count from deals table for specific user (buyer or seller)
    $query1 = "SELECT COUNT(*) as count FROM deals WHERE buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "'";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
    $countDeals = $row1['count'];
    $query2 = "SELECT COUNT(*) as count FROM pd_deals where buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "'";
} else {
    // Query to get count from deals table
    $query1 = "SELECT COUNT(*) as count FROM deals";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
    $countDeals = $row1['count'];
    $query2 = "SELECT COUNT(*) as count From pd_deals";
}


// Query to get count from pd_deals_master table

$result2 = $conn->query($query2);

$row2 = $result2->fetch_assoc();

$countPdDealsMaster = $row2['count'];

// Calculate total count
$totalCount = $countDeals + $countPdDealsMaster;

// Output the total count
echo  $totalCount ;

                    ?>
                  </h3>

                  <p>
                     <?php
if ($ss == 1) {
    echo "Total Leads";
} else {
    echo "Total Deals";
} ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
              </a>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
       <a href="current-deals.php" style="text-decoration: none;">

              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>
                    <?php
                    if ($role == 2 || $role == 3) {
                      $sql = "SELECT COUNT(*) as count FROM deals WHERE buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "' AND deal_status < 7";
                       $result1 = $conn->query($sql);
    $row1 = $result1->fetch_assoc();
    $countDeals = $row1['count'];
    $query2 = "SELECT COUNT(*) as count FROM pd_deals where buyer_id='" . $_SESSION['id'] . "' AND deal_status < 7";
                    } else {
                      $query1 = "SELECT COUNT(*) as count From pd_deals_master where status = 1 and deal_status!=7 ORDER BY id";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
    $countDeals = $row1['count'];
    $query2 = "SELECT COUNT(*) as count From deals where deal_status < 7";
                    }

$result2 = $conn->query($query2);
$row2 = $result2->fetch_assoc();
$countPdDealsMaster = $row2['count'];

// Calculate total count
$totalCount = $countDeals + $countPdDealsMaster;

// Output the total count
echo  $totalCount ;
                    ?>
                  </h3>

                  <p>
                   <?php
if ($ss == 1) {
    echo "Leads in Process";
} else {
    echo "Deals in Process";
} ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
              </a>
            </div>
             

             <div class="col-lg-4 col-6">
                <a href="target-deals.php" style="text-decoration: none;">

                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>

                    
                      <?php
         if ($role == 2 || $role == 3) {
$query1 = "SELECT COUNT(*) as count FROM deals where buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "' AND deal_status=7";
$query2 = "SELECT COUNT(*) as count FROM pd_deals where buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "' AND deal_status=7";
       }  else {    
    // Query to get count from deals table
    $query1 = "SELECT COUNT(*) as count FROM deals where deal_status=7";


// Query to get count from pd_deals_master table
$query2 = "SELECT COUNT(*) as count FROM pd_deals where deal_status=7";


      }

    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
    $countDeals = $row1['count'];
      $result2 = $conn->query($query2);
$row2 = $result2->fetch_assoc();
$countPdDealsMaster = $row2['count'];
// Calculate total count
$totalCount = $countDeals + $countPdDealsMaster;

// Output the total count
echo $totalCount;
                      
                      ?>
                    </h3>

                    <p>
                     <?php
if ($ss == 1) {
    echo "Leads Closed";
} else {
    echo "Deals Closed";
} ?>
</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                </div>
              </div>
            <?php if ($role == 1 || $role == 4) { ?>
              <!-- ./col -->
             
              <div class="col-lg-4 col-6">
            <a href="seller.php" style="text-decoration: none;">

                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>
                      <?php
                      $query = "SELECT COUNT(*) as count FROM users where user_type=2";
                      $query_run = mysqli_query($conn, $query);
                      if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                        $count = $prodItem['count'];
                        echo $count;
                      }
                      ?>
                    </h3>
                    <p>Sellers</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
                </a>
              </div>
              


          
              <div class="col-lg-4 col-6">
                <!-- small box -->
                    <a href="buyer.php" style="text-decoration: none;">
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>
                      <?php
                      $query = "SELECT COUNT(*) as count FROM users where user_type=3";
                      $query_run = mysqli_query($conn, $query);
                      if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                        $count = $prodItem['count'];
                        echo $count;
                      }
                      ?>
                    </h3>
                    <p>Buyer</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
                   </a>
              </div>
              <!-- ./col -->
           

              <div class="col-lg-4 col-6">
                                      <a href="consultant.php" style="text-decoration: none;">

                <!-- small box -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>
                      <?php
                      $query = "SELECT COUNT(*) as count FROM users where user_type=5";
                      $query_run = mysqli_query($conn, $query);
                      if (mysqli_num_rows($query_run) > 0) {
                        $prodItem = mysqli_fetch_array($query_run);
                        $count = $prodItem['count'];
                        echo $count;
                      }
                      ?>
                    </h3>

                    <p>Consultant</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
                   </a>
              </div>
              <!-- ./col -->
            <?php } ?>
<?php if($role==1 || $role==4){  ?>
            <div class="card-body">
              <table class="table " id="dataTable">
                <thead>
                  <p style="font-size:32px">Recent Order</p> <a href="current-deals.php" class="btn btn-info float-right">View All</a>
                  <tr>
                                <th>ID</th>
                                <th>Deal ID</th>
                                <th>Buyer</th>
                                <th>Seller</th>
                                <!-- <th>Contact Person</th> -->
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Deal Size</th>


                                <th>Product Description</th>
                                <?php
                                if ($_SESSION['role'] == 1) { ?>
                                    <!-- <th>Commission</th> -->
                                <?php } ?>
                                
                                  <th> Remarks</th>
                                <th>Date</th>
                  </tr>
                </thead>
                <tbody>

 <?php
                            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 4) {
                                $query = "SELECT * FROM deals ORDER BY id DESC LIMIT 5";
                            } else {
                                $query = "SELECT * FROM deals WHERE status = 1 AND deal_status < 7 AND (buyer_id = '" . $_SESSION['id'] . "' OR seller_id = '" . $_SESSION['id'] . "') ORDER BY id DESC";
                            }
                        
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
                                            <?php echo '000' . $prod_item['deal_id']; ?>
                                        </td>
                                        <td>
                                            <?php $b_id = $prod_item['buyer_id']; 
                                             if($b_id!=0){
                                            $organization="SELECT * FROM `organization` WHERE user_id='$b_id'";
                                            
                                            $organizationquery = mysqli_query($conn, $organization);
                                            $organizationqueryrow = mysqli_fetch_assoc($organizationquery);
                                           echo $organizationqueryrow['organizations'];
                                             }else{
                                                echo $prod_item['buyer'];
                                             } ?>
                                        </td>
                                        <td>
                                            <?php $s_id = $prod_item['seller_id']; 
                                            $sql="SELECT * FROM `organization` WHERE user_id='$s_id'";
                                            
                                            $query = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($query);
                                           echo $row['organizations']; ?>
                                        </td>
                                        <!-- <td>
                                            <?php //echo $prod_item['contact_person']; ?>
                                        </td> -->
                                        <td>
                                            <?php $s_id = $prod_item['seller_id']; 
                                            $sql="SELECT * FROM `organization` WHERE user_id='$s_id'";
                                            
                                            $query = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($query);
                                           echo $row['phone']; ?>
                                        </td>
                                        <td>
                                            <?php $s_id = $prod_item['seller_id']; 
                                            $sql="SELECT * FROM `organization` WHERE user_id='$s_id'";
                                            
                                            $query = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($query);
                                           echo $row['email']; ?> 
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>



                                        <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>
                                        <?php
                                        if ($_SESSION['role'] == 1) { ?>
                                            <!-- <td>
                                                <?php //echo $prod_item['commission']; ?>
                                            </td> -->
                                        <?php } ?>
                                        <?php
                                        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                                            
                                        <?php } ?>
                                        
                                        <td>
                    <?php echo $prod_item['remarks']; ?>
                </td>
                <td>
                    <?php echo $prod_item['created_on']; ?>
                </td>
                                       
                                        </tr>

            <?php
                                    $i++;
                                }
                            } else {
            ?>
            <tr>
                <td colspan="24" class="dataTables_empty">No Record found</td>
            </tr>
        <?php
                            }
        ?>

                </tbody>
              </table>
            </div>
            <?php }  ?>
          </div>
          <!-- /.row -->
        <?php } ?>
        <div class="row">
        <?php
        if ($role == 5 || $role == 6) { ?>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php
                  if ($role == 5) {
                    $id=$_SESSION['id'];
                    $query = "SELECT COUNT(*) From messages where consultant_id='$id' GROUP BY outgoing_msg_id  ORDER BY msg_id DESC";
                  } else {
                    $query = "SELECT COUNT(*) as count FROM deals";
                  }

                  $query_run = mysqli_query($conn, $query);
                 echo mysqli_num_rows($query_run);
                 
                  ?>
                </h3>

                <p>Previous Chat</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
      
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                  if ($role == 2 || $role == 3) {
                    $sql = "SELECT COUNT(*) as count FROM deals where buyer_id='" . $_SESSION['id'] . "' OR seller_id='" . $_SESSION['id'] . "' AND deal_status=7";
                  } else {
                    $sql = "SELECT COUNT(*) as count FROM deals where deal_status=7";
                  }

                  $sql_run = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($sql_run) > 0) {
                    $prodItem = mysqli_fetch_array($sql_run);
                    $count = $prodItem['count'];
                  }
                 // echo $count;
                  // Output the result
                  ?>
                  <a href="userchat.php" class="btn btn-primary">Chat</a>
                </h3>
            

                <p>Upcoming Chat</p>
               
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
       
        <?php }  ?>
        
          <?php if ($role == 8 || $role == 7) { ?>
      
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>
                    <?php
                    $query = "SELECT COUNT(*) as count FROM users where user_type=2";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                      $prodItem = mysqli_fetch_array($query_run);
                      $count = $prodItem['count'];
                      echo $count;
                    }
                    ?>
                  </h3>
                  <p>Sellers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>
                    <?php
                    $query = "SELECT COUNT(*) as count FROM users where user_type=3";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                      $prodItem = mysqli_fetch_array($query_run);
                      $count = $prodItem['count'];
                      echo $count;
                    }
                    ?>
                  </h3>
                  <p>Buyer</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>
                    <?php
                    $query = "SELECT COUNT(*) as count FROM product";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                      $prodItem = mysqli_fetch_array($query_run);
                      $count = $prodItem['count'];
                      echo $count;
                    }
                    ?>
                  </h3>

                  <p>Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>
                    <?php
                    $query = "SELECT COUNT(*) as count FROM add_consultant";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                      $prodItem = mysqli_fetch_array($query_run);
                      $count = $prodItem['count'];
                      echo $count;
                    }
                    ?>
                  </h3>

                  <p>Consultant</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          <?php } ?>
<?php if($role==1 || $role==4){  ?>
          <div class="card-body">
            <table class="table " id="dataTable">
              <thead>
                <p style="font-size:32px">Recent Paper Deal</p>  <a href="process-pd-deals-list.php" class="btn btn-info float-right">View All</a>
                <tr>
                  <th>ID</th>
                                <th>Deal Id</th>
                                <th>PD Name</th>
                                <th>Buyer</th>
                                <th>Contact Person</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Deal Size</th>

                                <th>Product Description</th>
                                <th>Date</th>
                </tr>
              </thead>
              <tbody>

<?php

                            $query = "SELECT * FROM pd_deals_master WHERE status = 1 ORDER BY id DESC LIMIT 5";
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
                                            000<?php echo $prod_item['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['user_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo IsUser_Name($prod_item['buyer_id']); ?>
                                        </td>

                                        <td>
                                            <?php echo $prod_item['contact_person']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['mobile_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['email_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $prod_item['deal_size']; ?>
                                        </td>

                                        <td>
                                            <?php echo $prod_item['product_description']; ?>
                                        </td>


                                        <td>
                                            <?php echo $prod_item['created_on']; ?>
                                        </td>
                                       
                </tr>

            <?php
                                    $i++;
                                }
                            } else {
            ?>
            <tr>
                <td colspan="17">No Record or Data found</td>
            </tr>
        <?php
                            }
        ?>

              </tbody>
            </table>
          </div>
          <?php } ?>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
} else if ($_SESSION['role'] == 5) {

  if (isset($_POST['consultant_update'])) {
    $admin_id = mysqli_real_escape_string($conn, $_POST['consultant_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $whatsapp_no = mysqli_real_escape_string($conn, $_POST['whatsapp_no']);

    $query = "Update users set name='$name',email_address='$email_address',phone_no='$phone_no',whatsapp_no='$whatsapp_no' where id='$admin_id'";

    $query_run = mysqli_query($conn, $query);

    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $doc_img = mysqli_real_escape_string($conn, $_FILES['prof_pic']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_prof_pic']));


    if (!empty($_FILES['prof_pic']['name'])) {
      $img_name = $_FILES["prof_pic"]["name"];

      $tempname = $_FILES["prof_pic"]["tmp_name"];

      $folder = "uploads/consultant_profile/" . date('dmyHis') . '_' . $img_name;

      if (move_uploaded_file($tempname, $folder)) {

        $update_filename = $folder;
      } else {

        $update_filename = '';
      }
    } else {
      $update_filename = $_POST['old_prof_pic'];
    }

    $query2 = "UPDATE consultant_pic SET description='$description', prof_pic='$update_filename' WHERE user_id='$user_id'";
    $query_run2 = mysqli_query($conn, $query2);
  }
  ?>
    <div class=" content-wrapper">
      <section class="content mt-4">
        <div class="container">
          <div class="row">
            <?php
            if (isset($_SESSION['id'])) {
              $product_id = $_SESSION['id'];
              $role_id = $_GET['role'];

              $query = "SELECT users.*, consultant_pic.prof_pic, consultant_pic.description, consultant_pic.user_id
                    FROM users 
                    LEFT JOIN consultant_pic ON users.id = consultant_pic.user_id 
                    WHERE users.id = '$product_id'
                    ORDER BY users.id";


              $query_run = mysqli_query($conn, $query);
              if (mysqli_num_rows($query_run) > 0) {
                $prodItem = mysqli_fetch_array($query_run);
                ?>
                <div class="col-md-12">
                <?php include ("message.php"); ?>
                  <div class="card-header">
                    <h4 style='margin:40px 0;'>
                      Edit Consultant
                    </h4>
                  </div>

                  <div class="card">

                    <div class="card-body">
                      <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                        <input type="hidden" name="consultant_id" value="<?= $prodItem['id'] ?>"></input>
                        <input type="hidden" name="user_id" value="<?= $prodItem['id'] ?>"></input>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Consultant Name</label>
                              <input type="text" name="name" value="<?= $prodItem['name']; ?>" class="form-control" required
                                placeholder="Enter Admin Name">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Email ID</label>
                              <input type="email" name="email_address" value="<?= $prodItem['email_address']; ?>"
                                class="form-control" required rows="3" placeholder="Email ID" autocomplete="off">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Phone</label>
                              <input type="phone" name="phone_no" onKeyPress="if(this.value.length==10) return false;"
                                id="phone" value="<?= $prodItem['phone_no']; ?>" class="form-control" required
                                placeholder="Enter Phone">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>WhatsApp Number</label>
                              <input type="phone" name="whatsapp_no" onKeyPress="if(this.value.length==10) return false;"
                                id="whatsapp" value="<?= $prodItem['whatsapp_no']; ?>" class="form-control" required
                                placeholder="Enter WhatsApp Number">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Upload Image</label>
                              <input type="file" name="prof_pic" class="form-control">
                              <input type="hidden" name="old_prof_pic" value="<?= $prodItem['prof_pic']; ?>">
                            <?php if (!empty($prodItem['prof_pic'])) { ?>
                                <a href="download_consultant_add.php?prod_id=<?php echo $product_id; ?>">Download
                                  Now</a> | <a href="<?= $prodItem['prof_pic']; ?>" target="_blank">View
                                  Document</a>
                            <?php } ?>

                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Description</label>
                              <textarea type="text" name="description" class="form-control" required
                                placeholder="Enter Description"><?= $prodItem['description']; ?></textarea>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="text-white">Update</label>
                              <button type="submit" name="consultant_update" class="btn btn-primary btn-block">Update</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php
              } else {
                echo "No such products found.";
              }
            }
            ?>
          </div>
        </div>
      </section>
    </div>
<?php  if($_POST['consultant_id']){ ?>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Book Slot </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <?php echo $consultant_id;
        $consultant_id = mysqli_real_escape_string($conn, $_POST['consultant_id']);
        $query = "SELECT * FROM `consultant_slots` where id = $consultant_id";
        $query_run = mysqli_query($conn, $query); 
        $data=mysqli_fetch_assoc($query_run);
       
        
        ?>
      <div class="row mb-2">
  <div class="col">
  <?php
  
  $sql = "Select name from users where id = $data[consultant_id]";
        $query_run = mysqli_query($conn, $sql);
        $users=mysqli_fetch_assoc($query_run);                                      
                                                
      ?>
    <input type="text" class="form-control" placeholder="Consultant Name" id="name" value="<?php echo $users['name'];  ?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Price" id="ammount" value="<?php echo $data['consultant_price'];  ?>">
  </div>
</div>
<div class="row mb-2">
  <div class="col">
  <?php $sql = "Select * from slot where id=$data[slot_id]";
        $query_run = mysqli_query($conn, $sql);
        $slot=mysqli_fetch_assoc($query_run);                                      
                                                
      ?>
    <input type="text" class="form-control" placeholder="From Time" value="<?php echo $slot['from_time'];  ?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="To Time" value="<?php echo $slot['to_time'];  ?>">
  </div>
</div>
<div class="row mb-2">
  <div class="col">
    <input type="text" class="form-control" placeholder="From Date" value="<?php echo $data['created_on'];  ?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="To Date" value="<?php echo $data['to_date'];  ?>">
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="buynow">Pay Now</button>
        <button class="btn btn-info" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Cencel</button>

      </div>
    </div>
  </div>
</div>
<?php } ?>

    <script>
      function validateForm() {
        var phoneInput = document.getElementById("phone").value;
        var whatsappInput = document.getElementById("whatsapp").value;
        var phonePattern = /^\d{10}$/; // Regular expression for 10-digit phone number

        if (!phonePattern.test(phoneInput)) {
          alert("Please enter a valid 10-digit phone number.");
          return false; // Prevent form submission
        }

        if (!phonePattern.test(whatsappInput)) {
          alert("Please enter a valid 10-digit WhatsApp number.");
          return false; // Prevent form submission
        }

        return true; // Allow form submission
      }
    </script>

<?php }
?>

<?php include_once ('footer.php'); ?>

<?php
//First Chart Value
$query = mysqli_query($conn, "SELECT SUM(deal_size) as total_deal, SUM(commission) as total_commission FROM `deals`");
$data = mysqli_fetch_assoc($query);
$cart1_data = implode(", ", $data);

// Day Wise Data
$query = mysqli_query($conn, "SELECT COUNT(*) as total_deals, DAY(created_on) as day FROM deals GROUP BY DAY(created_on)");
$total_deals_day = array();
while ($data = mysqli_fetch_array($query)) {
    $total_deals_day[] = $data['total_deals'];
}

$Day_Wise_Data = implode(", ", $total_deals_day);

// Week Wise Data
$query = mysqli_query($conn, "SELECT COUNT(*) as total_deals, WEEK(created_on) as week FROM deals GROUP BY WEEK(created_on)");
$total_deals_week = array();
while ($data = mysqli_fetch_array($query)) {
    $total_deals_week[] = $data['total_deals'];
}

$Week_Wise_Data = implode(", ", $total_deals_week);

// Month Wise Data
$query = mysqli_query($conn, "SELECT COUNT(*) as total_deals, MONTH(created_on) as month FROM deals GROUP BY MONTH(created_on)");
$total_deals_month = array();
while ($data = mysqli_fetch_array($query)) {
    $total_deals_month[] = $data['total_deals'];
}

$Month_Wise_Data = implode(", ", $total_deals_month);

// Output the results
// echo "Day Wise Data: " . $Day_Wise_Data . "\n";
// echo "Week Wise Data: " . $Week_Wise_Data . "\n";
// echo "Month Wise Data: " . $Month_Wise_Data . "\n";


?>

<script>
  $(function () {

    $('#show_data').on('change', function () {
      //var optionSelected = $("option:selected", this);
      var valueSelected = this.value;
      if (valueSelected == '1') {
        x_data = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'];
        chart_data = [<?= $Day_Wise_Data; ?>];
      } else if (valueSelected == '2') {
        x_data = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        chart_data = [<?= $Week_Wise_Data; ?>];
      } else if (valueSelected == '2'){
        x_data = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        chart_data = [<?= $Month_Wise_Data; ?>];
      }
      //--------------
      //- AREA CHART -
      //--------------

      // Get context with jQuery - using jQuery's .get() method.
      //var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

      var areaChartData = {
        // /*labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        // labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],*/
        labels: x_data,

        datasets: [{
          label: 'Digital Goods',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: chart_data
        },]
        
      }

      var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
            }
          }],
          yAxes: [{
            gridLines: {
              display: false,
            }
          }]
        }
      }

      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      var lineChartOptions = $.extend(true, {}, areaChartOptions)
      var lineChartData = $.extend(true, {}, areaChartData)
      lineChartData.datasets[0].fill = false;
      lineChartOptions.datasetFill = false

      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      })
      //-Chart End
    });
    // Dropdown Graph End


    //- AREA CHART -
    //--------------
    var areaChartData = {
      labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
      datasets: [{
        label: 'Digital Goods',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [<?= $Day_Wise_Data; ?>]
      },]
    }

    var areaChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    }

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })
    //-Chart End

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
 
   var cart1_data = [<?= $pd_deals_sum; ?> , <?= $deals_sum; ?>,<?php if($_SESSION['role']==4){ echo $direct_order_sum; } ?> , <?php if($_SESSION['role']==4){ echo $pd_sum_revenue;  } ?>]; // Replace with your actual PHP data

            var donutChartCanvas = document.getElementById('donutChart').getContext('2d');
            var donutData = {
                labels: [
                    'Paper Deals',
                    'Direct Order',
                    <?php if($_SESSION['role']==4){?> ' Direct Order Revenue', <?php } ?>
                    
                    <?php if($_SESSION['role']==4){?> 'Paper Deals Revenue'<?php } ?>
            
                ],
                datasets: [{
                    data: cart1_data,
                    backgroundColor: ['#f56954','#f39c12','#0abef5','#1789DD'],
                }]
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            // Create pie or doughnut chart
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            });
  })

</script>


<?php  if($_SESSION['role'] !=1 || $_SESSION['role'] != 1 || $_SESSION['role'] != 1){ ?>
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Book Slot </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">

      <?php 
        $consultant_id = mysqli_real_escape_string($conn, $_POST['consultant_id']);
        $query = "SELECT * FROM `consultant_slots` where id = $consultant_id";
        $query_run = mysqli_query($conn, $query); 
        $data=mysqli_fetch_assoc($query_run);
       
        
        ?>
      <div class="row mb-2">
  <div class="col">
  <?php
 $receipt=$_POST['book_id'];
$amount=$data['consultant_price'];
$str =  strval($amount); 


$orderData = [
    'receipt'         => $str,
    'amount'          => $amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
  $sql = "Select name from users where id = $data[consultant_id]";
        $query_run = mysqli_query($conn, $sql);
        $users=mysqli_fetch_assoc($query_run);                                      
                                                
      ?>
    <input type="text" class="form-control" placeholder="Consultant Name" id="name" value="<?php echo $users['name'];  ?>">
      <input type="hidden" class="form-control" placeholder="Consultant Name" id="razorpayOrderId" value="<?php echo $razorpayOrderId;  ?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Price" id="ammount" value="<?php echo $data['consultant_price'];  ?>">
    <input type="hidden" class="form-control" placeholder="Id" id="consultant_id" value="<?php echo $data['id'];  ?>">
        <input type="hidden" class="form-control" placeholder="Id" id="book_id" value="<?php echo $_POST['book_id'];  ?>">


  </div>
</div>
<div class="row mb-2">
  <div class="col">
  <?php $sql = "Select * from slot where id=$data[slot_id]";
        $query_run = mysqli_query($conn, $sql);
        $slot=mysqli_fetch_assoc($query_run);                                      
                                                
      ?>
    <input type="text" class="form-control" placeholder="From Time" value="<?php echo $slot['from_time'];  ?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="To Time" value="<?php echo $slot['to_time'];  ?>">
  </div>
</div>
<div class="row mb-2">
  <div class="col">
    <input type="text" class="form-control" placeholder="From Date" value="<?php echo $data['created_on'];  ?>">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="To Date" value="<?php echo $data['to_date'];  ?>">
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="buynow">Pay Now</button>
        <button class="btn btn-info" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Cencel</button>

      </div>
    </div>
  </div>
</div>
<?php  } 


?>


  <script>
  
  $(document).ready(function(){
     if(<?php echo $_POST['consultant_id']  ?>){
setTimeout($("#exampleModalToggle").modal('show'), 1000);
}
});
 </script>
  
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

$("#buynow").click(function()
{

var amount=$("#ammount").val();	
var name=$("#name").val();	
var razorpayOrderId=$("#razorpayOrderId").val();
var consultant_id=$("#consultant_id").val();
var book_id=$("#book_id").val();	


alert(consultant_id);

var options = {
    "key": "rzp_test_6kMDCUQCCH4r0W", // Enter the Key ID generated from the Dashboard
    "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": name, //your business name
    "description": "Test Transaction",
    "image": "http://paperdeals.in/admin/uploads/profile/logo.jpg",
    "order_id": razorpayOrderId, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "call_back_payment.php?id="+consultant_id+"&book="+book_id,
    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
        "name": "Gaurav Kumar", //your customer's name
        "email": "gaurav.kumar@example.com",
        "contact": "9000090000" //Provide the customer's phone number for better conversion rates 
    },
   
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);

 rzp1.open();
 e.preventDefault();
});
</script>
<!--<script>-->
<!--        const ctx = document.getElementById('myChart').getContext('2d');-->
<!--        let myChart = new Chart(ctx, {-->
<!--            type: 'line',-->
<!--            data: {-->
<!--                labels: [],-->
<!--                datasets: [{-->
<!--                    label: 'Deals',-->
<!--                    data: [],-->
<!--                    borderColor: 'rgba(75, 192, 192, 1)',-->
<!--                    borderWidth: 1,-->
<!--                    fill: false-->
<!--                }, {-->
<!--                    label: 'PD Deals',-->
<!--                    data: [],-->
<!--                    borderColor: 'rgba(153, 102, 255, 1)',-->
<!--                    borderWidth: 1,-->
<!--                    fill: false-->
<!--                }]-->
<!--            },-->
<!--            options: {-->
<!--                responsive: true,-->
<!--                scales: {-->
<!--                    x: {-->
<!--                        beginAtZero: true-->
<!--                    },-->
<!--                    y: {-->
<!--                        beginAtZero: true-->
<!--                    }-->
<!--                }-->
<!--            }-->
<!--        });-->

<!--        function fetchData(period) {-->
<!--            $.ajax({-->
<!--                url: 'fetch_data.php',-->
<!--                method: 'GET',-->
<!--                data: { period: period },-->
<!--                success: function (response) {-->
<!--                    alert(response);-->
<!--                    const data = JSON.parse(response);-->
<!--                    myChart.data.labels = data.labels;-->
<!--                    myChart.data.datasets[0].data = data.dealsData;-->
<!--                    myChart.data.datasets[1].data = data.pdDealsData;-->
<!--                    myChart.update();-->
<!--                }-->
<!--            });-->
<!--        }-->

<!--        $('#timePeriod').on('change', function () {-->
<!--            const selectedPeriod = $(this).val();-->
<!--            fetchData(selectedPeriod);-->
<!--        });-->

        // Fetch initial data
<!--        fetchData('daily');-->
<!--    </script>-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>