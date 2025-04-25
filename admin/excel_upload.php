<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include ('../connection/config.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Initialize count variable
        $count = 0;

        foreach ($data as $row) {
            // Skip the header row
            if ($count == 0) {
                $count++;
                continue;
            }

            // Check if required fields are not empty
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6]) && !empty($row[7]) && !empty($row[8]) && !empty($row[9])) {
                // Use the proper index-based access to get data from the row
                $city = mysqli_real_escape_string($conn, $row[0]);
                $mill = mysqli_real_escape_string($conn, $row[1]);
                $shade = mysqli_real_escape_string($conn, $row[2]);
                $gsm = mysqli_real_escape_string($conn, $row[3]);
                $hsn_no = mysqli_real_escape_string($conn, $row[4]);
                $size = mysqli_real_escape_string($conn, $row[5]);
                $weight = mysqli_real_escape_string($conn, $row[6]);
                $stock_in_kg = mysqli_real_escape_string($conn, $row[7]);
                $price_per_kg = mysqli_real_escape_string($conn, $row[8]);
                $quantity_in_kg = mysqli_real_escape_string($conn, $row[9]);

                // $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
                // $seller_id = mysqli_real_escape_string($conn, $_POST['seller_id']);

                $insertQuery = "INSERT INTO spot_price (city, mill, shade, gsm,hsn_no, sizes, weights, stock_in_kg, price_per_kg, quantity_in_kg)
                                VALUES ('$city', '$mill', '$shade', '$gsm','$hsn_no', '$size', '$weight', '$stock_in_kg', '$price_per_kg', '$quantity_in_kg')";

                if (mysqli_query($conn, $insertQuery)) {
                    $_SESSION['success'] = "Data has been submitted successfully!";
                } else {
                    $_SESSION['error'] = "Data not saved due to some error!";
                }
            }

            // Increment count for next row
            $count++;
        }

        // Redirect to the appropriate page
        header("Location: UpdateSpotPrice.php");
    } else {
        $_SESSION['error'] = "Invalid file type!";
        header("Location: UpdateSpotPrice.php");
    }
}
?>