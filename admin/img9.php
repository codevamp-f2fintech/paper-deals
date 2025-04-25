<?php
session_start();
include ('../connection/config.php');
if (isset($_GET['prod_id'])) {
    $id = $_GET['prod_id'];

    if ($_SESSION['role'] == 1) {
        $res = mysqli_query($conn, "SELECT *
        FROM deals AS de
        LEFT JOIN clearance AS i ON i.deal_id = de.deal_id AND i.product = de.deal_id
        LEFT JOIN transportation AS u ON u.deal_id = de.deal_id 
        LEFT JOIN payment AS c ON c.deal_id = de.deal_id
        LEFT JOIN close AS d ON d.deal_id = de.deal_id
        WHERE de.deal_id = $id");
    } else if ($_SESSION['role'] == 2) {
        $res = mysqli_query($conn, "SELECT *
        FROM deals AS de
        LEFT JOIN clearance AS i ON i.deal_id = de.deal_id AND i.product = de.deal_id
        LEFT JOIN transportation AS u ON u.deal_id = de.deal_id 
        LEFT JOIN payment AS c ON c.deal_id = de.deal_id
        LEFT JOIN close AS d ON d.deal_id = de.deal_id
        WHERE de.deal_id = $id AND de.deal_id = '" . $_SESSION['id'] . "'");

    }


    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <!DOCTYPE html>
            <html>

            <head>
                <title>Deal Process Report</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }

                    h1 {
                        text-align: center;
                        background: brown;
                        color: #fff;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    .abc {
                        display: flex;
                        padding: 0 60px;
                    }

                    .abcd {
                        padding: 0 260px;
                    }

                    .pad {
                        justify-content: end;
                    }

                    .container img {
                         height: 20px;
    width: 124px;
  
    border-radius: 0px;
                    }

                    .bg_black {
                        display: flex;
                        background: #5D3529;
                        justify-content: space-between;
                    }

                    .element {
                        position: relative;
                        border: 1px solid black;
                        top: 0%;
                        left: 56.5%;
                        width: 205px;
                        padding: 5px 10px;
                    }
                </style>
            </head>
            <!-- <table style="border-top: solid 1px green;">
                <col class="table-bordered" style="width: 20mm;">
                <col class="table-bordered" style="width: 21mm;">
                 <col class="table-bordered" style="width: 21mm;">
                <tr>
                    <th style="border-top: solid 1px red">0 0</th>
                    <th style="border-top: solid 1px red">0 1</th>
                    <th style="border-top: solid 1px red">0 2</th>
                </tr>
                <tr>
                    <td>
                        <div style="border-top: solid 1px red">1 0</div>
                    </td>
                    <td>1 1</td>
                    <td>1 2</td>
                </tr>
            </table> -->

            <body>

                <table>
                    <tr class="container">
                        <td>
                            <img src="uploads/profile/logo.jpg" alt="img">
                        </td>
                        <td>
                            <?php $date = date('d-m-y', strtotime($row['created_on'])); ?>
                            <div class="element">
                                <p style="margin: 0;">Date from
                                    <?= $date; ?> to
                                    <?= $row['close_date']; ?>
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>

                <div class="bg_black">
                    <h1 class="bg_black" style="color:#fff;padding:2% 0;  background-color:#5D3529;">
                        <u>
                            Deal Process Report
                        </u>
                    </h1>
                </div>
                <br>
                <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TAT:
                    <?php
                    $date1 = new DateTime($date);
                    $date2 = new DateTime($row['close_date']);

                    $interval = $date1->diff($date2);
                    $days = $interval->days;

                    echo $days;
                    ?>
                    Days
                </p>
                <table>
                    <tr class="container">
                        <col class="pad" style="padding: 0 60px;">

                        Buyer

                        <?php
                        $sql = "Select * from users where id=$row[buyer_id]";
                        $query_run = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {
                                echo $item['name'];
                            }
                        } ?>

                        </col>
                        <col style="padding: 0 160px;">
                        Seller

                        <?php
                        $sql = "Select * from users where id=$row[seller_id]";
                        $query_run = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {
                                echo $item['name'];
                            }
                        } ?>

                        </col>
                    </tr>
                    <br>
                </table>

                <hr style="color:#c7d8ec">
                <p style="padding: 0 60px;">Product &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;&nbsp; &nbsp;
                    <?= $row['product'] ?>
                </p>
                <hr style="color:#c7d8ec">
                <p style="padding: 0 60px;">Deal Size &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;&nbsp; &nbsp;
                    <?= $row['deal_size'] ?>
                </p>
                <hr style="color:#c7d8ec">
                <br>
                <table>
                    <tr class="container">

                        <td class="abc"><span style="padding: 0 60px;">Deal Commencing</span><span class="abcd"
                                style="padding: 0 90px;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp;
                                &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp;
                                &nbsp;
                                DATE :
                                <?= $date; ?>
                                &nbsp; &nbsp;
                                &nbsp;

                                <br> &nbsp; &nbsp;
                                &nbsp;
                                &nbsp; &nbsp;
                                &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                &nbsp; &nbsp;
                                &nbsp;
                                &nbsp; &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;REMARKS &nbsp; &nbsp; THE ITEMS WERE GOOD QUALITY <br><br>
                            </span></td>

                        <br>

                        <br>
                        <td style="color:red;padding:0 0 0 -60px; position:relative;top:2%;">
                            2 days
                        </td>
                    </tr>
                </table>
                <br>
                <hr style="color:#c7d8ec">
                <table>
                    <tr class="container" style="align-items:space-between; padding:0 500px;">
                        <th>
                            &nbsp; &nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sample Value &nbsp;
                            &nbsp; &nbsp;
                            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp;
                            &nbsp;
                            &nbsp; &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;&nbsp;
                            &nbsp; &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp; &nbsp; &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp; &nbsp; &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp; &nbsp; &nbsp;
                            &nbsp;
                            &nbsp;
                            &nbsp;
                        </th>

                        <td>
                            14000/-
                        </td>
                        <br>
                        <td><span>Date</span></td>

                    </tr>

                </table>
                <br>
                <hr style="color:#c7d8ec">
                <p style="padding: 0 60px;">Clearance &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    <?= $row['product'] ?>
                </p>
                <hr style="color:#c7d8ec">
                <p style="padding: 0 60px;">Transaction &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    <?= $row['transaction_date'] ?>
                </p>
                <hr style="color:#c7d8ec">
                <p style="padding: 0 60px;">Transportation &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp;
                    <?= $row['mot'] ?>
                </p>
                <hr style="color:#c7d8ec">
                <p style="padding: 0 60px;">Closure</p>
                <hr style="color:#fbffff">
                <br><br><br>
                <div style="display: flex; justify-content: space-between; border:2px solid gray; padding : 0px 0 100px 0;">
                    &nbsp;<span> Report Generation Date</span>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                    <span>Authorized Signatory</span>
                    <p style="color:#fff;">Prince</p>
                </div>

            </body>

            </html>
            <?php
        }
    } else {
        echo 'No data found';
    }
}
?>