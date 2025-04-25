<?php
session_start();
include ('../connection/config.php');
if (isset($_GET['prod_id'])) {
    $id = $_GET['prod_id'];
    $role = $_GET['role'];
    if ($role == 1) {
        $res = mysqli_query($conn, "SELECT *
        FROM deals AS de
        LEFT JOIN clearance AS i ON i.deal_id = de.id AND i.product = de.id
        LEFT JOIN transportation AS u ON u.deal_id = de.id 
        LEFT JOIN payment AS c ON c.deal_id = de.id
        LEFT JOIN sampling AS e ON e.deal_id = de.id
        LEFT JOIN close AS d ON d.deal_id = de.id
        WHERE de.id = $id");
    } else if ($role == 2) {
        $res = mysqli_query($conn, "SELECT *
        FROM deals AS de
        LEFT JOIN clearance AS i ON i.deal_id = de.id AND i.product = de.id
        LEFT JOIN transportation AS u ON u.deal_id = de.id 
        LEFT JOIN payment AS c ON c.deal_id = de.id
        LEFT JOIN close AS d ON d.deal_id = de.id
        LEFT JOIN sampling AS e ON e.deal_id = de.id
        WHERE de.id = $id");

    }


    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <title>Deal Process Report</title>
                <style>
                    body {
                        margin: 0;
                        width: 100%;
                        font-family: Arial, sans-serif;
                    }

                    h1 {
                        text-align: center;
                        background: brown;
                        color: #fff;
                    }

                    table {
                        margin: 0;
                        width: 100%;
                        border-collapse: collapse;
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

                    .bg_black {
                        display: flex;
                        background: #5D3529;
                        justify-content: space-between;
                    }

                    .element {
                        position: relative;
                        border: 1px solid gray;
                        top: 0%;
                        left: 56.5%;
                        width: 205px;
                        padding: 5px 10px;
                    }

                    th {
                        padding-right: 20px;
                        font-size: 15px;
                    }

                    td {
                        font-size: 13px;
                    }

                    #ga {
                        border: 2px solid gray;
                    }
                </style>
            </head>

            <body>
                <table>
                    <tr class="container">
                        <td>
                            <img src="uploads/profile/logo.jpg" alt="img">
                        </td>
                        <td>
                            <?php $date = date('d/m/Y', strtotime($row['created_on'])); ?>
                            <div class="element" style="width: 210px;">
                                <p style="margin: 0;">Date from
                                    <?= $date; ?> to
                                    <?= date('d/m/Y', strtotime($row['close_date'])); ?>
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="bg_black" style="width: 100%;background-color:#5D3529;">
                    <h1 class="bg_black" style="font-size:35px;color:#fff;padding:2% 0; ">
                        <u>
                            DEAL PROCESS REPORT
                        </u>
                    </h1>
                </div>

                <br>
                <p style="font-weight: bold;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TAT:
                    N
                    DAYS
                </p>
                <table style="width:90%;margin-left:38px">
                    <col class="table-bordered" style="width: 50%;">
                    <col class="table-bordered" style="width: 50%;">
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUYER
                        </th>
                        <td>
                            <?php
                            $sql = "Select * from users where id=$row[buyer_id]";
                            $query_run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $item) {
                                    echo strtoupper($item['name']);
                                }
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#fff">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELLER</th>
                        <td>
                            <?php
                            $sql = "Select * from users where id=$row[seller_id]";
                            $query_run = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $item) {
                                    echo strtoupper($item['name']);
                                }
                            } ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRODUCT</th>
                        <td>

                            <?= strtoupper($row['product']); ?>
                            <br>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#fff">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WEIGHT</th>
                        <td>

                            <?= $row['weight']; ?>
                            <br>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#fff">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DEAL SIZE</th>
                        <td>
                            <?= $row['deal_size']; ?> /-
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#fff">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order Date</th>
                        <td>
                            DATE:
                            <?= $date; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="color:red;font-weight:bold;">
                                <?php
                                $date1 = new DateTime($row['created_on']);
                                $date2 = new DateTime($row['dos']);

                                $interval = $date1->diff($date2);
                                $days1 = $interval->days;

                                echo $days1; ?> DAYS
                            </span>

                        </td>
                    </tr>
                    <tr> <!-- New row -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <td colspan="2"> <!-- Spanning across all three columns -->
                            <p> REMARKS
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;THE ITEMS WERE GOOD QUALITY
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr style="color:#fff">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SAMPLE VALUE</th>
                        <td>
                            14,000 Rs
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr> <!-- New row -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <td colspan="2"> <!-- Spanning across all three columns -->
                            <p> DATE:
                                <?= date('d/m/Y', strtotime($row['dos'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="color:red;font-weight:bold;">
                                    <?php
                                    $date1 = new DateTime($row['dos']);
                                    $date2 = new DateTime($row['doc']);

                                    $interval = $date1->diff($date2);
                                    $days2 = $interval->days;

                                    echo $days2; ?> DAYS
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CLEARANCE</th>
                        <td>
                            STOCK REGISTER
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr> <!-- New row -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <td colspan="2"> <!-- Spanning across all three columns -->
                            <p> REMARKS
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRANSACTION</th>
                        <td>
                            DATE:
                            <?= date('d/m/Y', strtotime($row['transaction_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="color:red;font-weight:bold;">
                                <?php
                                $date1 = new DateTime($row['dos']);
                                $date2 = new DateTime($row['doc']);

                                $interval = $date1->diff($date2);
                                $days2 = $interval->days;

                                echo $days2; ?> DAYS
                            </span>

                        </td>
                    </tr>
                    <tr> <!-- New row -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <td colspan="2"> <!-- Spanning across all three columns -->
                            <p> DETAILS :</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRANSPORTATION</th>
                        <td>
                            DATE:
                            <?= date('d/m/Y', strtotime($row['transportation_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="color:red;font-weight:bold;">
                                <?php
                                $date1 = new DateTime($row['dos']);
                                $date2 = new DateTime($row['doc']);

                                $interval = $date1->diff($date2);
                                $days2 = $interval->days;

                                echo $days2; ?> DAYS
                            </span>

                        </td>
                    </tr>
                    <tr> <!-- New row -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <td colspan="2"> <!-- Spanning across all three columns -->
                            <p> ACCEPTANCE</p>
                        </td>
                    </tr>
                    <tr> <!-- New row -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <td colspan="2"> <!-- Spanning across all three columns -->
                            <p> DISTANCE</p>
                        </td>
                    </tr>
                    <tr> <!-- New row -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <td colspan="2"> <!-- Spanning across all three columns -->
                            <p> CONTINUED PROCESS</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <hr style="color:#fff">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CLOSURE</th>
                        <td>
                            DATE:
                            <?= date('d/m/Y', strtotime($row['close_date'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="color:red;font-weight:bold;">
                                <?php
                                $date1 = new DateTime($row['dos']);
                                $date2 = new DateTime($row['doc']);

                                $interval = $date1->diff($date2);
                                $days2 = $interval->days;

                                echo $days2; ?> DAYS
                            </span>

                        </td>
                    </tr>
                    <!-- <tr>
                        <td>
                            <hr style="color:#fff">
                        </td>
                    </tr> -->
                    <tr>
                        <td colspan="4">
                            <hr style="color:#c7d8ec">
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;&nbsp;</th>
                        <td>
                            <p> TOTAL TAT OF DELIVERY:
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <span style="color:red;font-weight:bold;">
                                    <?php
                                    $date1 = new DateTime($row['created_on']);
                                    $date2 = new DateTime($row['close_date']);

                                    $interval = $date1->diff($date2);
                                    $days2 = $interval->days;

                                    echo $days2; ?> DAYS
                                </span>
                            </p>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td colspan="2">
                            <hr style="color:#fff">
                        </td>
                    </tr> -->
                </table>

                <div
                    style="border: solid 1px gray; height: 100px; display: flex; justify-content: space-between;width:90%;margin-left:35px;position:relative;top:10px;">
                    <br><br><br> <br><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:20px;padding-bottom:100px">Report Generation Date</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;

                    <span style="font-size:20px;margin-bottom: 12px;">Authorised Signatory<br></span>
                    <br>
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