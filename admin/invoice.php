<?php
session_start();
include_once('header.php'); 
$id=$_GET['id'];
$type=$_GET['type'];
if($type!=""){
    $sql="SELECT * FROM `subscription` 
            JOIN transaction on transaction.id=subscription.transaction_id 
            JOIN organization on organization.user_id=subscription.user_id 
            JOIN document on document.user_id=organization.user_id 
            WHERE subscription.user_id='$id' 
            AND transaction.transaction_status=1 
            AND subscription.type='$type'";
}else{
    $sql="SELECT * FROM `consultant_slots` 
            JOIN organization on organization.user_id=consultant_slots.book_id 
            JOIN document on document.user_id=organization.user_id 
            WHERE consultant_slots.status=1 
            AND consultant_slots.book_id='$id'";
}
$query=mysqli_query($conn,$sql);
$userDetails=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .container {
            min-height: 100vh;
                margin-left: 17%;
        }
        #receipt {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container flex items-center justify-center">
        <div id="receipt" class="bg-white p-6 rounded-lg shadow-md">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
                <img src="https://paperdeals.in/admin/uploads/profile/logo.jpg" alt="Company Logo" class="h-12 mb-4 md:mb-0" style="border-radius:0px;">
                <!-- Order Details -->
                <div class="text-center md:text-left mb-6">
                    <?php if ($type!=""){ ?>
                    <p class="text-lg">Order Id: <?php echo $userDetails['transaction_id']; ?></p>
                    <?php } else { ?>
                    <p class="text-lg">Order Id: <?php echo $userDetails['orderId']; ?></p>
                    <?php } ?>
                </div>
            </div>
            <hr class="mb-6">
            <h2 class="text-2xl font-bold mb-2 text-center">ORDER RECEIPT</h2>
            <div class="flex flex-col md:flex-row justify-between">
                <!-- Customer Details -->
                <div class="mb-6">
                    <h3 class="text-l font-bold mb-2">Customer Details</h3>
                    <?php if($type!=""){ ?>
                    <p>Customer: <?php $consultant_id=$userDetails['user_id'];  echo mysqli_fetch_assoc(mysqli_query($conn,"select id,name from users where id='$consultant_id'"))['name'] ?></p>
                    <?php } else { ?>
                    <p>Customer: <?php $consultant_id=$userDetails['book_id'];  echo mysqli_fetch_assoc(mysqli_query($conn,"select id,name from users where id='$consultant_id'"))['name'] ?></p>
                    <?php } ?>
                    <p>Address: <?php echo $userDetails['address']; ?></p>
                    <p>GST NO: <?php echo $userDetails['gst_number']; ?></p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-semibold">Kay Paper Deals Pvt Ltd.</p>
                    <p>B-9, F/F, Housing society,</p>
                    <p>N.D.S.E - 1 New Delhi - 110049</p>
                    <p>GST NO: 07AAJCK9436A1ZJ </p>
                </div>
            </div>
            <!-- Product Table -->
            <div class="mb-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">S.No.</th>
                            <?php if ($type==""){ ?>
                            <th class="border px-4 py-2">Consultant Name</th>
                            <?php } ?>
                            <th class="border px-4 py-2">Type</th>
                            <th class="border px-4 py-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">1</td>
                            <?php if ($type==""){ ?>
                            <td class="border px-4 py-2"><?php $consultant_id=$userDetails['consultant_id'];  echo mysqli_fetch_assoc(mysqli_query($conn,"select id,name from users where id='$consultant_id'"))['name'] ?></td>
                            <?php } ?>
                            <?php if($type!=""){ ?>
                            <td class="border px-4 py-2"><?php echo $userDetails['type']." Package"; ?></td>
                            <td class="border px-4 py-2"><?php echo $userDetails['amount']; ?></td>
                            <?php } else { ?>
                            <td class="border px-4 py-2">Consultant Chat Slot</td>
                            <td class="border px-4 py-2"><?php echo $userDetails['consultant_price']; ?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Totals -->
            <div class="text-right mb-6">
                <?php if($type!=""){ ?>
                <p>Total: <span class="font-semibold"><?php echo $userDetails['amount']; ?></span></p>
                <p>GST@18%: <span class="font-semibold"><?php $gst = ((18 * $userDetails['amount']) / 100); echo $gst; ?></span></p>
                <p>Grand Total: <span class="font-semibold"><?php echo ($gst + $userDetails['amount']); ?></span></p>
                <?php } else { ?>
                <p>Total: <span class="font-semibold"><?php echo $userDetails['consultant_price']; ?></span></p>
                <p>GST@18%: <span class="font-semibold"><?php $gst = ((18 * $userDetails['consultant_price']) / 100); echo $gst; ?></span></p>
                <p>Grand Total: <span class="font-semibold"><?php echo ($gst + $userDetails['consultant_price']); ?></span></p>
                <?php } ?>
            </div>
            <!-- Download Button -->
            <div class="text-center">
                <button id="downloadButton" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Download as PDF</button>
            </div>
        </div>
    </div>
<?php include("footer.php"); ?>
    <!-- Include the html2canvas and jsPDF libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script>
        document.getElementById('downloadButton').addEventListener('click', function () {
            var downloadButton = document.getElementById('downloadButton');
            downloadButton.style.display = 'none';
            
            html2canvas(document.getElementById('receipt'), {
                scale: 3, // Further increase the scale factor for better resolution
                onrendered: function (canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    var pdf = new jsPDF('p', 'pt', 'a4');
                    var pageWidth = pdf.internal.pageSize.width;
                    var pageHeight = pdf.internal.pageSize.height;
                    var widthRatio = pageWidth / canvas.width;
                    var heightRatio = pageHeight / canvas.height;
                    var ratio = Math.min(widthRatio, heightRatio);
                    var canvasWidth = canvas.width * ratio;
                    var canvasHeight = canvas.height * ratio;

                    pdf.addImage(imgData, 'PNG', 0, 0, canvasWidth, canvasHeight);
                    pdf.save('receipt.pdf');
                    downloadButton.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
