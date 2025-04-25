<?php
include_once ('header.php');
include ('../connection/config.php');

?>
<div class="content-wrapper">
    <section class="content mt-4">
        <div style="width:95%" class="mx-auto">
            <div class="row">
                <div class="col-md-12">
                    <?php include ("message.php"); ?>
                    <div class="mt-4">
                        <h4 style="font-size:25px;color:#1C2434;margin:40px 0 20px 3px">
                            Consultant Slot
                        </h4>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <form action="code.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="consultant_id" value="<?= $_SESSION["id"] ?>">
                                        <div class="form-group">
                                            <label>From Time</label>
                                            <select name="slot_id" class="form-control">
                                                <?php
                                                // Assume the consultant's ID is stored in a variable called $consultantId
                                                $consultantId = $_SESSION["id"]; // Replace this with the actual consultant ID
                                                
                                                // Fetch all available slots
                                                $allSlotsQuery = mysqli_query($conn, "SELECT id, from_time FROM slot");
                                                $allSlots = [];
                                                while ($row = mysqli_fetch_assoc($allSlotsQuery)) {
                                                    $allSlots[] = $row;
                                                }

                                                // Fetch selected slots for the consultant
                                                $selectedSlotsQuery = mysqli_query($conn, "SELECT slot_id FROM consultant_slots WHERE consultant_id = $consultantId");
                                                $selectedSlots = [];
                                                while ($row = mysqli_fetch_assoc($selectedSlotsQuery)) {
                                                    $selectedSlots[] = $row['slot_id'];
                                                }

                                                // Render the dropdown options and mark selected options as disabled
                                                foreach ($allSlots as $slot) {
                                                    $slotId = $slot['id'];
                                                    $fromTime = $slot['from_time'];

                                                    // Check if the current slot is selected by the consultant
                                                    $isDisabled = in_array($slotId, $selectedSlots) ? 'disabled style="color:#fff;background:red"' : '';

                                                    // Render the option with or without the disabled attribute
                                                    echo "<option value='{$slotId}' {$isDisabled}>{$fromTime}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>To Time</label>
                                            <select name="slot_id" class="form-control">
                                                <?php
                                                // Assume the consultant's ID is stored in a variable called $consultantId
                                                $consultantId = $_SESSION["id"]; // Replace this with the actual consultant ID
                                                
                                                // Fetch all available slots
                                                $allSlotsQuery = mysqli_query($conn, "SELECT id, to_time FROM slot");
                                                $allSlots = [];
                                                while ($row = mysqli_fetch_assoc($allSlotsQuery)) {
                                                    $allSlots[] = $row;
                                                }

                                                // Fetch selected slots for the consultant
                                                $selectedSlotsQuery = mysqli_query($conn, "SELECT slot_id FROM consultant_slots WHERE consultant_id = $consultantId");
                                                $selectedSlots = [];
                                                while ($row = mysqli_fetch_assoc($selectedSlotsQuery)) {
                                                    $selectedSlots[] = $row['slot_id'];
                                                }

                                                // Render the dropdown options and mark selected options as disabled
                                                foreach ($allSlots as $slot) {
                                                    $slotId = $slot['id'];
                                                    $fromTime = $slot['to_time'];

                                                    // Check if the current slot is selected by the consultant
                                                    $isDisabled = in_array($slotId, $selectedSlots) ? 'disabled style="color:#fff;background:red"' : '';

                                                    // Render the option with or without the disabled attribute
                                                    echo "<option value='{$slotId}' {$isDisabled}>{$fromTime}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    $userid=$_SESSION['id'];
                                    $price = mysqli_query($conn, "SELECT consultant_price,id,user_type FROM `users` where user_type=5 and id='$userid'"); 
                                    $priceconsulatnt=mysqli_fetch_assoc($price);
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Consultant Price</label>
                                            <input type="text" name="consultant_price" id="ntitle" cols="30" rows="10"
                                                class="form-control" placeholder="Enter Consultant Price" value="<?php echo $priceconsulatnt['consultant_price']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <div class="input-group date" id="datemask2" data-target-input="nearest">
                                                <input type="text" name="created_on"
                                                    class="form-control datetimepicker-input" data-target="#datemask2"
                                                    placeholder="DD-MM-YY" />
                                                <div class="input-group-append" data-target="#datemask2"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label>To Date</label>-->
                                    <!--        <div class="input-group date" id="datemask3" data-target-input="nearest">-->
                                    <!--            <input type="text" name="to_date"-->
                                    <!--                class="form-control datetimepicker-input" data-target="#datemask2"-->
                                    <!--                placeholder="DD-MM-YY" />-->
                                    <!--            <div class="input-group-append" data-target="#datemask3"-->
                                    <!--                data-toggle="datetimepicker">-->
                                    <!--                <div class="input-group-text"><i class="fa fa-calendar"></i></div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!-- <div class="col-md-4"></div>
                                    <div class="col-md-4"></div> -->
                                    <div class="col-md-2 float-right">
                                        <div class="form-group">
                                            <label class="text-white">Save</label>
                                            <button type="submit" name="consultant_booking_slot_save"
                                                class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mt-4">
                        <h4 style="font-size:25px;color:#1C2434;margin:50px 0 20px 3px">
                            Slot List
                        </h4>

                    </div>
                    <div class="card">

                        <div class="card-body">
                            <table class="table " id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                        <th>Consultant Price</th>
                                        <th>Date</th>
                                        <!--<th>To Date</th>-->
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 1) {
                                        $query = "select * from  consultant_slots ORDER BY id DESC";
                                    } else {
                                        $query = "select * from  consultant_slots where consultant_id=$_SESSION[id] ORDER BY id DESC";
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
                                                    <?php $sql = "Select * from slot where id=$prod_item[slot_id]";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            echo $item['from_time'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $sql = "Select * from slot where id=$prod_item[slot_id]";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $item) {
                                                            echo $item['to_time'];
                                                        }
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['consultant_price']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $prod_item['created_on']; ?>
                                                </td>
                                                <!--<td>-->
                                                    <?php //echo $prod_item['to_date']; ?>
                                                <!--</td>-->
                                              
                                                <td>
                                                    <a href="edit_consultant_slot.php?prod_id=<?php echo $prod_item['id']; ?>"
                                                        style="width:100px ; text-align:center;border:1px solid #1C6C09;padding:4px; height:20px;font-size:13px; color:#1C6C09;background-color:#D9FBD0; border-radius:6px;">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="post">
                                                        <input type="hidden" name="consultant_slot_delete_id"
                                                            value="<?= $prod_item['id']; ?>">
                                                        <button type="submit" name="consultant_slot_delete_btn"
                                                            style="width:50px ;border:1px solid #B81800;padding:4px; height:28px;font-size:13px; color:#B81800;background-color:#FFE0DB; border-radius:6px;">Delete</button>
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
include ("footer.php");
?>