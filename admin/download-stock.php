<?php
$file="pd.xlsx";

// Check if the file path is retrieved
if ($file) {
    // Set headers to force download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // Read the file and output it to the browser
    readfile($file);
    exit;
} else {
    // File not found, handle the error accordingly
    echo 'File not found!';
}
?>