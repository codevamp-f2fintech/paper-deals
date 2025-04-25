<?php
session_start();
include ('../connection/config.php');
include ('header.php');

if ($_SESSION['role'] == 1) {
    $res = mysqli_query($conn, "SELECT * From pd_deals where deal_status=7 AND status=1");
} else if ($_SESSION['role'] == 2) {
    $res = mysqli_query($conn, "SELECT * From pd_deals where deal_status=7 AND deal_id = '" . $_SESSION['id'] . "'");
} ?>


?>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>



<?php
if (mysqli_num_rows($res) > 0) {
  
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Deal Process Report</title>
            <style>
            
            #htmlContent, #menu{
                width:40%;
                margin:auto;
              
            }
            
        
            
            
          
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }


                .pad {
                    justify-content: end;
                }

                .container img {
                     height: 20px;
    width: 124px;
  
    border-radius: 0px;
                }

                .element {
                    position: relative;
    border: 3px solid gray;
    top: 0%;
    font-size: 14px;
    left: 46.5%;
 width: 320px;
    padding: 5px 10px;
                }

                th {
                    padding-right: 20px;
                    font-size: 15px;
                    /* border: 2px solid black; */
                    /* text-align: center; */
                }

                td {
                    font-size: 17px;
                  font-weight:400;
                }

                #ga {
                    border: 2px solid gray;

                }
                
                #two{
                    width: 98%;
                  margin: auto;
                }
                
                #bottom{
                    
    border: solid 1px gray;
    height: 84px;
    display: flex;
    justify-content: space-evenly;
    width: 90%;
    margin-left: 35px;
    margin-top: 14%;
    padding: 12px;
                }
                
#menu li {
  list-style-type: none;

  text-align: center;
}



#menu a {
  text-decoration: none;
  color: blue;
  display: block;
  border: 3px blue outset; 
  background-color: #CCCCFF; 
}

input{
    padding: 8px;
    border-radius: 20px
}


.btn-accent {
  color: #fff;
  background-color: #ff8007;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}





          </style>
        </head>

        <body>
             <div id= "menu" class="mt-4">
    <ul style="display:flex; background:blue; justify-content: space-evenly;">
    
<input class="pa__middle-input text" type="date" name="date" id="from_date" onchange="this.className=(this.value!=''?'has-value':'')" required>
   <input class="pa__middle-input text" type="date" name="date" onchange="this.className=(this.value!=''?'has-value':'')" id="to_date" required>
     <button class="btn btn-accent" id="filter">Filter</button>
   </li>
      <li> <input
        id="btn-Preview-Image"
        data-bs-toggle="modal" data-bs-target="#exampleModal"
        type="button"
        class="btn btn-warning"
        value="Preview"
      /></li>
     
    </ul>
   </div>
             <div id="htmlContent" style="background:white; padding-bottom:100px;">
            <table>
                <tr class="container">
                    <td>
                        <img src="uploads/profile/logo.jpg" alt="img">
                    </td>
                    <td style="width: 600px;">
                        <?php $data = mysqli_fetch_assoc($res);
                      
                     ?>
                        <div class="element">
                            <p style="margin: 0;">Date from
                                <?=  $data['created_on'];  ?> to
                                <?= $data['updated_on']; ?>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="bg_black ">
                <h1 style="color:#fff;padding:1% 0;  background-color:#5D3529; text-align: center;">
                    <u>
                        BUSINESS REPORT
                    </u>
                </h1>
            </div>
            <br>
            <p style="font-weight: bold;padding: 0px 26px;float: right;font-size: 18px;">Business
                Report Date: <?php echo date("d-m-Y");  ?>
            </p>
        
            <br>
            <table id="new_data" class="table">

                <tr>
                    <th>Date</th>
                    <th>Buyer</th>

                    <th>Seller</th>
                    <th>Amount</th>
                    <th>Weight</th>
                    <th>Commission</th>
                </tr>
         
             
              
             
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr style="background:#fff;">

                        <td>
                            <?= $date = date('d/m/Y', strtotime($row['created_on'])); ?>
                        </td>
                        <td>
                            M/s <?php
                            $sql = "SELECT * FROM users WHERE id = " . $row['buyer_id'];
                            $query_run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $item) {
                                    echo $item['name'];
                                }
                            }
                            ?>

                        </td>

                        <td>
                            M/s <?php
                            $sql = "SELECT * FROM users WHERE id = " . $row['seller_id'];
                            $query_run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $item) {
                                    echo $item['name'];
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php $dealSize = $row['deal_size']; // Assume this is your numeric value
                                        $formattedDealSize = number_format($dealSize);

                                        // Output the formatted deal size without decimal places
                                        echo $formattedDealSize;
                                        ?> /-
                        </td>
                        <td>
                            <?= $row['weight']; ?>805
                        </td>
                        <td>
                            <?= $row['commission']; ?>
                        </td>
                    </tr>

                <?php } ?>
            </table>
            <br>
           
           
            &nbsp; &nbsp; &nbsp;
            <span>Total Deal Size :
                <?php
                $sql = "SELECT SUM(deal_size) as total_deal_size FROM deals;";
                $query_run = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query_run);
                $sum = $row['total_deal_size'];
                echo "$sum";
                ?>


            </span> <span>Commission :
                <?php
                $sql = "SELECT SUM(commission) as total_commission FROM deals;";
                $query_run = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query_run);
                $sum = $row['total_commission'];
                echo "$sum";
                ?>

            </span>
         
         
            <br>
         
            <div id="bottom">
                <br><br><br> <br><br><br>
               <span style="font-size:20px;padding-bottom:100px">Report Generation Date</span>
               

                <span style="font-size:20px;margin-bottom: 12px;">Authorised Signatory<br></span>
                <br>
            </div>
              </div> 
              
        </body>

        </html>
        <?php

} else {
    echo 'No data found';
}

?>



<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a
          id="download"
          class="btn btn-primary"
          href="#"
          style="text-decoration: none"
          >Download</a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="center" id="previewImage"></div>
      </div>
    
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script>
document.getElementById("download")
        .addEventListener("click", () => {
            const previewImage = this.document.getElementById("previewImage");
            console.log(previewImage);
            console.log(window);
            var opt = {
                margin: 0.1,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 2 },
              jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' 
        
              }
            };
            html2pdf().from(previewImage).set(opt).save();
        })
$(document).ready(function () {
    
    
    $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
             
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  console.log(data);
                              $('#new_data').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
    
    
    
    
    
        var element = $("#htmlContent"); // global variable
        var getCanvas; // global variable

        $("#btn-Preview-Image").on("click", function () {
          html2canvas(element, {
            onrendered: function (canvas) {
              $("#previewImage").html(canvas);
              getCanvas = canvas;
            // alert("test");
            },
          });
        });

        $("#btn-Convert-Html2Image").on("click", function () {
          var imgageData = getCanvas.toDataURL("image/jpeg");
          // Now browser starts downloading it instead of just showing it
          var newData = imgageData.replace(
            /^data:image\/jpeg/,
            "data:application/octet-stream"
          );
          $("#btn-Convert-Html2Image")
            .attr("download", "your_pic_name.png")
            .attr("href", newData);
        });
      });
</script>
<script>
    var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

//margins.left, // x coord   margins.top, { // y coord
$('#cmd').click(function () {
    doc.fromHTML($('#htmlContent').html(), 15, 15, {
        'width': 700,
        'elementHandlers': specialElementHandlers
    });
    doc.save('report.pdf');
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<?php  include ('footer.php'); ?>



