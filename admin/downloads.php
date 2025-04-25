<?php
// Check if the file parameter is set
if (isset($_GET['file'])) {
    // Get the filename
    $file = basename($_GET['file']);
    // Path to the file directory
    $filepath = 'uploads/sample_file/' . $file;

    // Check if the file exists
    if (file_exists($filepath)) {
        // Set appropriate headers for file download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        // Read the file and output it to the browser
        readfile($filepath);
        exit;
    } else {
        // File not found
        echo 'File not found.';
    }
} else {
    // File parameter is not set
    echo 'Invalid request.';
}
?>