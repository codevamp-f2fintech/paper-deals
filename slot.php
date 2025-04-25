<?php session_start();
  ?>
<?php
// Function to check if a slot is available (dummy function for demonstration)
function isSlotAvailable($slot) {
    // Dummy function - Replace with your logic to check slot availability
    return true;
}

// Function to book a slot (dummy function for demonstration)
function bookSlot($slot) {
    // Dummy function - Replace with your logic to book a slot
    return true;
}

// Get current date and time
$currentDateTime = new DateTime();
$endDate = clone $currentDateTime;
$endDate->modify('+60 days');

// Set start and end time for slots
$startTime = new DateTime('09:00:00');
$endTime = new DateTime('17:00:00'); // Assuming slots end at 5:00 PM

// Interval for each slot (1 hour)
$interval = new DateInterval('PT1H');

// Generate and display booking form for the next 60 days
$currentDate = clone $currentDateTime;
while ($currentDate <= $endDate ) {
    $arrayDays = array (1,2);
    $day = $currentDate->format('N');
    
    if( in_array($day,$arrayDays)){
    $slotDate = $currentDate->format('Y-m-d');
    echo "<h3>Available slots for $slotDate:</h3>";

    // Initialize slot time to the start time
    $slotTime = clone $startTime;
    while ($slotTime < $endTime) {
        $formattedSlotDateTime = $currentDate->format('Y-m-d') . ' ' . $slotTime->format('H:i:s');

        if (isSlotAvailable($formattedSlotDateTime)) {
            $endTimeTemp= clone $slotTime;
            echo "<input type='radio' name='slot' value='$formattedSlotDateTime'>{$slotTime->format('h:i A')}" .' - '.$endTimeTemp-> add(new DateInterval('PT1H'))->format('h:i A')."  <br>";
        } else {
            echo "{$slotTime->format('h:i A')} - Not Available<br>";
        }
        // Increment slot time by interval
        $slotTime->add($interval);
    }
}
    echo "<br>";
    $currentDate->modify('+1 day');

}
?>