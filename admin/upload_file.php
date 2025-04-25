<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include ('../connection/config.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['upload_excel_file'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $count = "0";
        foreach ($data as $row) {
            if ($count > 0) {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                $product_called = mysqli_real_escape_string($conn, $_POST['product_id']);
                $seller_name = mysqli_real_escape_string($conn, $_POST['seller_id']);
                // $seller_name = mysqli_real_escape_string($conn, $_POST['seller_id']);
                $states = $row['0'];
                $mill = $row['1'];
                $shade = $row['2'];
                $gsm = $row['3'];

                $studentQuery = "INSERT INTO product_detail(product_id,seller_id,name, hsn_no, quantity, spot_price) 
                 VALUES ('$product_called','$seller_name','$states', '$mill', '$shade', '$gsm')";
                $result = mysqli_query($conn, $studentQuery);
                if ($result) {
                    $_SESSION['success'] = "Data has been Submitted Successfully!";
                    header("Location: cottton_bales_sp.php");
                } else {
                    $_SESSION['error'] = "Data Not saved Due to Some Error!";
                    header("Location: cottton_bales_sp.php");
                }
            } else {
                $count = "1";
            }
        }
    }
}
?>