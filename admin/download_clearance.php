<?php
include ('../connection/config.php');
$file_id = isset($_GET['prod_id']) ? $_GET['prod_id'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
if($name=="bill"){
$sql = "SELECT bill FROM clearance WHERE deal_id = ?";
} else if($name=="ewaybill"){
$sql = "SELECT ewaybill FROM clearance WHERE deal_id = ?";
} else if($name=="stock_statement"){
    $sql = "SELECT stock_statement FROM clearance WHERE deal_id = ?";
} else if($name=="bill_t"){
    $sql = "SELECT bill_t FROM clearance WHERE deal_id = ?";
}
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $file_id);
$stmt->execute();
$stmt->bind_result($file_path);
$stmt->fetch();
$stmt->close();

// Check if the file path is retrieved
if ($file_path) {
    // Set headers to force download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    // Read the file and output it to the browser
    readfile($file_path);
    exit;
} else {
    // File not found, handle the error accordingly
    echo 'File not found!';
}
?>