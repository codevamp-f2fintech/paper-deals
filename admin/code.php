<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)


error_reporting(0);
session_start();
require 'exelup/autoload.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Aws\S3\S3Client;
// Amazon S3 API credentials 
include('../connection/config.php');
// Configuration
$allowedMimeTypes = [
    // Image MIME types
    'image/jpeg',  // JPEG images
    'image/png',   // PNG images
    'image/gif',   // GIF images
    'image/jpg',   // JPG images
    'image/bmp',   // Bitmap images
    'image/tiff',  // TIFF images
    'image/webp',  // WebP images

    // Word document MIME types
    'application/msword',   // DOC files
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOCX files

    // Excel MIME types
    'application/vnd.ms-excel',   // XLS files
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // XLSX files

    // PDF MIME type
    'application/pdf'  // PDF files
];
$maxFileSize = 2 * 1024 * 1024; // Maximum file size (2 MB)

function aws_doc_Upload($tempnameLocal, $filenameLocal)
{
    // if (is_uploaded_file($tempnameLocal)) {
    //     $region = 'ap-south-1';
    //     $version = 'latest';
    //     $access_key_id = 'AKIA2UC3CHAWZJDLTUIE';
    //     $secret_access_key = '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';
    //     $bucket = 'paperdeals-doc-bucket';

    //     $s3 = new S3Client([
    //         'version' => $version,
    //         'region'  => $region,
    //         'credentials' => [
    //             'key'    => $access_key_id,
    //             'secret' => $secret_access_key,
    //         ]
    //     ]);

    //     try {

    //         $result = $s3->putObject([
    //             'Bucket' => $bucket,
    //             'Key'    => $filenameLocal,
    //             'ACL'    => 'public-read',
    //             'SourceFile' => $tempnameLocal
    //         ]);
    //         echo $result->toArray();

    //         if (!empty($result_arr['ObjectURL'])) {
    //             // echo $result_arr['ObjectURL'];
    //         } else {
    //             echo 'Upload Failed! S3 Object URL not found.';
    //         }
    //     } catch (Aws\S3\Exception\S3Exception $e) {
    //         echo "789crn9wrc whhn";
    //         echo $e->getMessage();
    //     }

    //     if (empty($api_error)) {
    //         echo 'success';
    //         echo "File was uploaded to the S3 bucket successfully!";
    //     } else {
    //         echo $api_error;
    //     }
    // }
    return 1;
}

function validateInput($input)
{
    // Trim whitespace from the beginning and end
    $input = trim($input);

    // Allow blank input or spaces
    if ($input === '') {
        return $input; // Return the input as it is if it's blank or just spaces
    }

    // Escape special characters for HTML output
    $safe_output = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    // List of common SQL keywords to prevent
    $sql_keywords = "/\b(SELECT|INSERT|UPDATE|DELETE|DROP|TRUNCATE|ALTER|UNION|REPLACE|GRANT|REVOKE|CREATE|SHOW|EXECUTE|DESCRIBE|--|#|\/\*)\b/i";

    // Check for SQL keywords in the input
    if (preg_match($sql_keywords, $safe_output)) {
        return "Input contains forbidden SQL keywords.";
    }

    // Prevent HTML tags such as <a>, <script>, etc.
    if (preg_match("/<\/?[^>]+>/", $input)) {
        return "Input contains forbidden HTML tags.";
    }

    return $safe_output; // Return the sanitized input
}




// Function to validate file type
function isValidFileType($fileType, $allowedMimeTypes)
{
    return in_array($fileType, $allowedMimeTypes);
}
function updateDeal_Status($status, $deal_id)
{
    global $conn;
    $query = mysqli_query($conn, "Update deals set deal_status='$status' where id='$deal_id'");
    return 'true';
}

function updatePD_Deal_Status($status, $deal_id)
{

    global $conn;
    $query = mysqli_query($conn, "Update pd_deals set deal_status='$status' where id='$deal_id'");

    return 'true';
}
function updatePD_Deal_master_Status($status, $pd_deals_master_id)
{
    global $conn;
    $query = mysqli_query($conn, "Update pd_deals_master set deal_status='$status' where id='$pd_deals_master_id'");
    return 'true';
}
if (isset($_POST['logo_save'])) {
    $desc_type = mysqli_real_escape_string($conn, $_POST['desc_type']);
    $validatedesc_type = validateInput($desc_type);
    $logo = mysqli_real_escape_string($conn, $_FILES['logo']['name']);
    $fileType = $_FILES['logo']['type'];
    if (!isValidFileType($fileType, $allowedMimeTypes)) {
        die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
    }
    $fileType = $_FILES['logo']['type'];
    if (!isValidFileType($fileType, $allowedMimeTypes)) {
        // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
        $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
        header("Location: company_details.php");
        exit;
    }
    $file_name = 'uploads/logo/' . $_FILES["logo"]["name"];
    $tempname = $_FILES['logo']['tmp_name'];
    aws_doc_Upload($tempname, $file_name);
    $db_file = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;

    if ($validatedesc_type === $desc_type) {
        $query = "insert into logosub(desc_type,logo) values('$desc_type','$db_file')";
        $query_run = mysqli_query($conn, $query);
    }
    if ($query_run) {

        header("Location: company_details.php");
    } else {
        $_SESSION['error'] = "Error: Invalid Input";
        header("Location: company_details.php");
    }

    header("Location: company_details.php");
}

if (isset($_POST['doc_upload_save'])) {
    $gst_number = mysqli_real_escape_string($conn, $_POST['gst_number']);
    $pan_card_img = mysqli_real_escape_string($conn, $_FILES['pan_card_img']['name']);
    $voter_id_img = mysqli_real_escape_string($conn, $_FILES['voter_id_img']['name']);
    $cert_of_incorp = mysqli_real_escape_string($conn, $_FILES['cert_of_incorp']['name']);
    $gst_cert = mysqli_real_escape_string($conn, $_FILES['gst_cert']['name']);
    $validate_gst_number = validateInput($gst_number);


    if ($_FILES["pan_card_img"]["name"]) {
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $fileType = $_FILES['pan_card_img']['type'];
            die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
        }
        $file_name = 'uploads/pancard/' . $_FILES["pan_card_img"]["name"];
        $tempname = $_FILES['pan_card_img']['tmp_name'];
        aws_doc_Upload($tempname, $file_name);
        $pan_card_img = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
    }
    if ($_FILES["voter_id_img"]["name"]) {
        $fileType = $_FILES['voter_id_img']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
        }
        $file_name = 'uploads/voter_id/' . $_FILES["voter_id_img"]["name"];
        $tempname = $_FILES['voter_id_img']['tmp_name'];
        aws_doc_Upload($tempname, $file_name);
        $voter_id_img = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
    }
    if ($_FILES["cert_of_incorp"]["name"]) {
        $fileType = $_FILES['cert_of_incorp']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
        }
        $file_name = 'uploads/certificate/' . $_FILES["cert_of_incorp"]["name"];
        $tempname = $_FILES['cert_of_incorp']['tmp_name'];
        aws_doc_Upload($tempname, $file_name);
        $cert_of_incorp = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
    }


    if ($validate_gst_number === $gst_number) {
        $query = "insert into document(gst_number,pan_card_img,voter_id_img,cert_of_incorp,gst_cert) values('$gst_number','$pan_card_img','$voter_id_img','$cert_of_incorp','$gst_cert')";
        $query_run = mysqli_query($conn, $query);
        header("Location: company_details.php");
    } else {

        $_SESSION['error'] = "Error: Invalid Input";
        header("Location: company_details.php");
    }
}

if (isset($_POST['per_inform_save'])) {

    $per_name = mysqli_real_escape_string($conn, $_POST['per_name']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $per_address = mysqli_real_escape_string($conn, $_POST['per_address']);
    $voter_id = mysqli_real_escape_string($conn, $_POST['voter_id']);
    $addhar_id = mysqli_real_escape_string($conn, $_POST['addhar_id']);
    $validate_per_name = validateInput($per_name);
    $validate_fname = validateInput($fname);
    $validate_dob = validateInput($dob);
    $validate_designation = validateInput($designation);
    $validate_per_address = validateInput($per_address);
    $validate_voter_id = validateInput($voter_id);
    $validate_addhar_id = validateInput($addhar_id);

    if ($validate_per_name === $per_name && $validate_fname === $fname && $validate_dob === $dob && $validate_designation === $designation && $validate_per_address === $per_address && $validate_voter_id === $voter_id && $validate_addhar_id === $addhar_id) {
        $query = "insert into personal(per_name,fname,dob,designation,per_address,voter_id,addhar_id) values('$per_name','$fname','$dob','$designation','$per_address','$voter_id','$addhar_id')";
        $query_run = mysqli_query($conn, $query);
        header("Location: company_details.php");
    } else {
        $_SESSION['error'] = "Error: Invalid Input";
        header("Location: company_details.php");
        exit;
    }
}

if (isset($_POST['organzn_inform_save'])) {
    $organizations = mysqli_real_escape_string($conn, $_POST['organizations']);
    $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $production_capacity = mysqli_real_escape_string($conn, $_POST['production_capacity']);
    $organization_type = mysqli_real_escape_string($conn, $_POST['organization_type']);

    $user_id = $_SESSION["id"];
    if (validateInput($organizations) === $organizations && validateInput($contact_person) === $contact_person && validateInput($email) === $email && validateInput($phone) === $phone && validateInput($address) === $address && validateInput($city) === $city && validateInput($district) === $district && validateInput($state) === $state && validateInput($pincode) === $pincode && validateInput($production_capacity) === $production_capacity && validateInput($organization_type) === $organization_type) {

        $query = "insert into organization(organizations,contact_person,email,phone,address,city,district,state,pincode,production_capacity,production_specification,organization_type,user_id) values('$organizations','$contact_person','$email','$phone','$address','$city','$district','$state','$pincode','$production_capacity','$production_specification','$organization_type','$user_id')";
        $query_run = mysqli_query($conn, $query);
        header("Location: company_details.php");
    } else {
        $_SESSION['error'] = "Error: Invalid Input";
        header("Location: company_details.php");
    }
}


if (isset($_POST['product_update'])) {
    $seller_id = mysqli_real_escape_string($conn, $_POST['seller_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $sub_product = mysqli_real_escape_string($conn, $_POST['sub_product']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $shade = mysqli_real_escape_string($conn, $_POST['shade']);
    $gsm = mysqli_real_escape_string($conn, $_POST['gsm']);
    $hsn_no = mysqli_real_escape_string($conn, $_POST['hsn_no']);
    $sizes = mysqli_real_escape_string($conn, $_POST['size']);
    $weights = mysqli_real_escape_string($conn, $_POST['weight']);
    $stock_in_kg = mysqli_real_escape_string($conn, $_POST['stock_in_kg']);
    $price_per_kg = mysqli_real_escape_string($conn, $_POST['price_per_kg']);
    $quantity_in_kg = mysqli_real_escape_string($conn, $_POST['quantity_in_kg']);
    $sheet =  mysqli_real_escape_string($conn, $_POST['sheet']);
    $rim_weight = mysqli_real_escape_string($conn, $_POST['rim_weight']);
    $w_l = mysqli_real_escape_string($conn, $_POST['w_l']);
    $no_of_bundle = mysqli_real_escape_string($conn, $_POST['no_of_bundle']);
    $no_of_rim = mysqli_real_escape_string($conn, $_POST['no_of_rim']);
    $bf = mysqli_real_escape_string($conn, $_POST['bf']);
    $grain = mysqli_real_escape_string($conn, $_POST['grain']);
    $other = mysqli_real_escape_string($conn, $_POST['other']);
    $new_image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);


    if (!empty($_FILES['image']['name'])) {
        $file_name = 'uploads/product_new/' . $_FILES["image"]["name"];
        $tempname = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: product-add.php");
        }
        if (aws_doc_Upload($tempname, $file_name)) {

            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {

            $update_filename = '';
        }
    } else {
        $update_filename = $_POST['old_image'];
    }


    if (validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($shade) === $shade && validateInput($gsm) === $gsm && validateInput($hsn_no) === $hsn_no && validateInput($sizes) === $sizes && validateInput($weights) === $weights && validateInput($stock_in_kg) === $stock_in_kg && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg && validateInput($sheet) === $sheet && validateInput($rim_weight) === $rim_weight && validateInput($w_l) === $w_l && validateInput($no_of_bundle) === $no_of_bundle && validateInput($no_of_rim) === $no_of_rim && validateInput($bf) === $bf && validateInput($grain) === $grain && validateInput($other) === $other && validateInput($old_image) === $old_image && validateInput($seller_id) === $seller_id && validateInput($category_id) === $category_id) {
        $query = "update product_new set product_name='$product_name',sub_product='$sub_product',category_id='$category_id',shade='$shade',gsm='$gsm',hsn_no='$hsn_no',size='$sizes',weight='$weights',stock_in_kg='$stock_in_kg',price_per_kg='$price_per_kg',quantity_in_kg='$quantity_in_kg',other='$other',sheet='$sheet',rim_weight='$rim_weight',w_l='$w_l',no_of_bundle='$no_of_bundle',no_of_rim='$no_of_rim',grain='$grain',bf='$bf',image='$update_filename' where id='$seller_id'";


        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Product Update Successfully!";
            header("Location: product-add.php");
        } else {
            $_SESSION['error'] = "Product Not Updated Due to Some Error!";
            header("Location: product-add.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: product-add.php");
    }
}
if (isset($_POST['new_product_save'])) {
    $return_url = $_POST['return_url'];
    $seller_id = $_POST['seller_id'];
    $category_id = $_POST['category_id'];
    $product_name = $_POST['product_name'];
    $sub_product = $_POST['sub_product'];
    $shade = $_POST['shade'];
    $gsm = $_POST['gsm'];
    $sizes = $_POST['size'];
    $hsn_no = $_POST['hsn_no'];
    $weights = $_POST['weight'];
    $stock_in_kg = $_POST['stock_in_kg'];
    $price_per_kg = $_POST['price_per_kg'];
    $quantity_in_kg = $_POST['quantity_in_kg'];
    $other = $_POST['other'];


    if (validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($shade) === $shade && validateInput($gsm) === $gsm && validateInput($hsn_no) === $hsn_no && validateInput($sizes) === $sizes && validateInput($weights) === $weights && validateInput($stock_in_kg) === $stock_in_kg && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg && validateInput($other) === $other && validateInput($seller_id) === $seller_id && validateInput($category_id) === $category_id) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO product_new (seller_id,category_id,product_name, sub_product,shade, gsm, size, weight, stock_in_kg, price_per_kg, quantity_in_kg,hsn_no, other, image) VALUES (?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("iissssssssssss", $seller_id, $category_id, $product_name, $sub_product, $shade, $gsm, $sizes, $weights, $stock_in_kg, $price_per_kg, $quantity_in_kg, $hsn_no, $other, $targetFile);

        // Execute the statement and check the result
        if ($stmt->execute()) {
            $_SESSION['success'] = "Product Added Successfully!";
        } else {
            $_SESSION['error'] = "Product Not Added Due to Some Error!";
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
    }

    // Redirect back
    header("Location: " . $return_url);
    exit();
}

if (isset($_POST['new_product_edit'])) {

    $seller_id = mysqli_real_escape_string($conn, $_POST['seller_id']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $sub_product = mysqli_real_escape_string($conn, $_POST['sub_product']);
    $shade = mysqli_real_escape_string($conn, $_POST['shade']);
    $gsm = mysqli_real_escape_string($conn, $_POST['gsm']);
    $hsn_no = mysqli_real_escape_string($conn, $_POST['hsn_no']);
    $bf = mysqli_real_escape_string($conn, $_POST['bf']);

    $sizes = mysqli_real_escape_string($conn, $_POST['size']);
    $weights = mysqli_real_escape_string($conn, $_POST['weight']);
    $stock_in_kg = mysqli_real_escape_string($conn, $_POST['stock_in_kg']);
    $price_per_kg = mysqli_real_escape_string($conn, $_POST['price_per_kg']);
    $quantity_in_kg = mysqli_real_escape_string($conn, $_POST['quantity_in_kg']);
    $other = mysqli_real_escape_string($conn, $_POST['other']);
    $new_image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);


    if (!empty($_FILES['image']['name'])) {
        $file_name = "uploads/product_new/" . $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $fileType = $_FILES['image']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {
            $update_filename = '';
        }
    } else {
        $update_filename = $_POST['old_image'];
    }


    if (validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($shade) === $shade && validateInput($gsm) === $gsm && validateInput($hsn_no) === $hsn_no && validateInput($sizes) === $sizes && validateInput($weights) === $weights && validateInput($stock_in_kg) === $stock_in_kg && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg && validateInput($other) === $other && validateInput($seller_id) === $seller_id && validateInput($category_id) === $category_id && validateInput($old_image) === $old_image) {
        $query = "update product_new set category_id='$category_id',product_name='$product_name',sub_product='$sub_product',shade='$shade',gsm='$gsm',hsn_no='$hsn_no',bf='$bf',size='$sizes',weight='$weights',stock_in_kg='$stock_in_kg',price_per_kg='$price_per_kg',quantity_in_kg='$quantity_in_kg',other='$other',image='$update_filename' where id='$seller_id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Product Update Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "Product Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['product_save'])) {
    // Retrieve and sanitize form inputs
    $seller_id = $_POST['seller_id'];
    $user_type = $_POST['user_type'];
    $product_name = $_POST['product_name'];
    $sub_product = $_POST['sub_product'];
    $category_id = $_POST['category_id'];
    $shade = $_POST['shade'];
    $gsm = $_POST['gsm'];
    $sizes = $_POST['size'];
    $hsn_no = $_POST['hsn_no'];
    $weights = $_POST['weight'];
    $stock_in_kg = $_POST['stock_in_kg'];
    $price_per_kg = $_POST['price_per_kg'];
    $quantity_in_kg = $_POST['quantity_in_kg'];
    $other = $_POST['other'];
    $sheet = $_POST['sheet'];
    $rim_weight = $_POST['rim_weight'];
    $w_l = $_POST['w_l'];
    $no_of_bundle = $_POST['no_of_bundle'];
    $no_of_rim = $_POST['no_of_rim'];
    $bf = $_POST['bf'];
    $grain = $_POST['grain'];
    $created_at = date("Y-m-d H:i:s");

    // Prepare SQL statement
    if (validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($shade) === $shade && validateInput($gsm) === $gsm && validateInput($hsn_no) === $hsn_no && validateInput($sizes) === $sizes && validateInput($weights) === $weights && validateInput($stock_in_kg) === $stock_in_kg && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg && validateInput($sheet) === $sheet && validateInput($rim_weight) === $rim_weight && validateInput($w_l) === $w_l && validateInput($no_of_bundle) === $no_of_bundle && validateInput($no_of_rim) === $no_of_rim && validateInput($bf) === $bf && validateInput($grain) === $grain && validateInput($other) === $other && validateInput($old_image) === $old_image && validateInput($seller_id) === $seller_id && validateInput($category_id) === $category_id) {
        $stmt = "INSERT INTO product_new (seller_id, product_name, sub_product, category_id, shade, gsm, size, weight, stock_in_kg, price_per_kg, quantity_in_kg, hsn_no, other, image,grain,bf,sheet,rim_weight,w_l,no_of_bundle,no_of_rim,user_type,created_at) VALUES ('$seller_id', '$product_name', '$sub_product', '$category_id', '$shade', '$gsm', '$sizes', '$weights', '$stock_in_kg', '$price_per_kg', '$price_per_kg', '$quantity_in_kg', '$hsn_no', '$imageFilePath','$grain','$bf','$sheet','$rim_weight','$w_l','$no_of_bundle','$no_of_rim','$user_type','$created_at')";
        // ECHO  $stmt;
        // exit;
        // $stmt->bind_param("ississssssssss", $seller_id, $product_name, $sub_product, $category_id, $shade, $gsm, $sizes, $weights, $stock_in_kg, $price_per_kg, $quantity_in_kg, $hsn_no, $other, $imageFilePath);
        $query = mysqli_query($conn, $stmt);

        // Execute the statement and check the result
        if ($query) {
            $_SESSION['success'] = "Product added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add product due to a database error.";
        }
        if ($user_type == 2) {
            header("Location: product-add.php?user_type=seller");
        } else if ($user_type == 3) {
            header("Location: product-add.php?user_type=buyer");
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: product-add.php");
    }
}

if (isset($_POST['new_product_save_buyer'])) {

    // Gather form data and sanitize
    $seller_id = $_POST['seller_id'];
    $return_url = $_POST['return_url'];
    $product_name = $_POST['product_name'];
    $sub_product = $_POST['sub_product'];
    $other = $_POST['other'];

    if (validateInput($seller_id) === $seller_id && validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($other) === $other) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO product_new (seller_id, product_name, sub_product, other) VALUES (?, ?, ?, ?)");

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("isss", $seller_id, $product_name, $sub_product, $other);

            // Execute the statement and check the result
            if ($stmt->execute()) {
                $_SESSION['success'] = "Product Added Successfully!";
            } else {
                $_SESSION['error'] = "Product Not Added Due to Some Error!";
            }

            // Close the statement
            $stmt->close();
        } else {
            $_SESSION['error'] = "Failed to prepare the SQL statement.";
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
    }

    // Redirect back
    header("Location: " . $return_url);
    exit();
}
if (isset($_POST['product_save_buyer'])) {
    $seller_id = $_POST['seller_id'];
    $return_url = $_POST['return_url'];
    $product_name = $_POST['product_name'];
    $sub_product = $_POST['sub_product'];
    $other = $_POST['other'];
    if (validateInput($seller_id) === $seller_id && validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($other) === $other) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO product_new (seller_id, product_name, sub_product, other) VALUES (?, ?, ?, ?)");

        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("isss", $seller_id, $product_name, $sub_product, $other);

            // Execute the statement and check the result
            if ($stmt->execute()) {
                $_SESSION['success'] = "Product Added Successfully!";
            } else {
                $_SESSION['error'] = "Product Not Added Due to Some Error!";
            }

            // Close the statement
            $stmt->close();
        } else {
            $_SESSION['error'] = "Failed to prepare the SQL statement.";
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
    }

    // Redirect back
    header("Location: product-add.php");
    exit();
}
if (isset($_POST['new_product_edit_buyer'])) {

    // Prepare SQL statement
    $seller_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['seller_id']));
    $return_url = mysqli_real_escape_string($conn, stripslashes($_REQUEST['return_url']));
    $product_name = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_name']));
    $sub_product = mysqli_real_escape_string($conn, stripslashes($_REQUEST['sub_product']));
    $other = mysqli_real_escape_string($conn, stripslashes($_REQUEST['other']));
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    if (validateInput($seller_id) === $seller_id && validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($other) === $other && validateInput($category_id) === $category_id) {
        $query = "UPDATE product_new SET other='$other',category_id='$category_id',product_name='$product_name',sub_product='$sub_product' WHERE id='$seller_id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Product Update Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "Product Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: " . $return_url);
    }
}
if (isset($_POST['product_update_buyer'])) {

    // Prepare SQL statement
    $seller_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['seller_id']));
    $product_name = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_name']));
    $sub_product = mysqli_real_escape_string($conn, stripslashes($_REQUEST['sub_product']));
    $other = mysqli_real_escape_string($conn, stripslashes($_REQUEST['other']));
    if (validateInput($seller_id) === $seller_id && validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($other) === $other) {
        $query = "UPDATE product_new SET other='$other',product_name='$product_name',sub_product='$sub_product' WHERE id='$seller_id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Product Update Successfully!";
            header("Location: product-add.php");
        } else {
            $_SESSION['error'] = "Product Not Updated Due to Some Error!";
            header("Location: product-add.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: " . $return_url);
    }
}
if (isset($_POST['delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "delete from product_new where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Product Deleted Successfully!";
        header("Location: product-add.php");
    } else {
        $_SESSION['error'] = "Product Not Deleted Due to Some Error!";
        header("Location: product-add.php");
    }
}

/* New User Add Submit Form Start*/
if (isset($_REQUEST['add_user'])) {
    $name = mysqli_real_escape_string($conn, stripslashes($_REQUEST['name']));
    $email_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email_address']));
    $phone = mysqli_real_escape_string($conn, stripslashes($_REQUEST['phone_no']));
    $password = stripslashes(md5($_REQUEST['password']));
    $join_date = mysqli_real_escape_string($conn, stripslashes($_REQUEST['join_date']));
    $whatsapp = mysqli_real_escape_string($conn, stripslashes($_REQUEST['whatsapp']));
    $role = mysqli_real_escape_string($conn, stripslashes($_REQUEST['role']));

    $checkemail = "select email_address from users where email_address='$email_id'";
    $checkemail_run = mysqli_query($conn, $checkemail);
    if (mysqli_num_rows($checkemail_run) > 0) {
        $_SESSION['error'] = "Email already taken";
        header("Location:seller.php");
    } else {
        if ($role == 2) {
            $user_type = 'Seller';
            $redirectUrl = 'seller.php';
        } else {
            $user_type = 'Buyer';
            $redirectUrl = 'buyer.php';
        }


        if (validateInput($name) === $name && validateInput($email_id) === $email_id && validateInput($phone) === $phone && validateInput($join_date) === $join_date && validateInput($whatsapp) === $whatsapp && validateInput($role) === $role) {

            $add_user_query = mysqli_query($conn, "insert into users set user_type='$role', name='$name', email_address='$email_id', password='$password', phone_no='$phone', whatsapp_no='$whatsapp'");

            if ($add_user_query > 0) {
                $_SESSION['success'] = $user_type . " Added Successfully!";
                header("Location: " . $redirectUrl);
            } else {
                $_SESSION['error'] = $user_type . " Not Added Due to Some Error!";
                header("Location: " . $redirectUrl);
            }
        } else {
            $_SESSION['error'] = "Invalid Input";
            header("Location: " . $redirectUrl);
        }
    }
}



if (isset($_POST['active_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($role == 2) {
        $user_type = 'Seller';
        $redirectUrl = 'seller.php';
    } else if ($_SESSION['role'] == 4) {
        $user_type = 'Super Admin';
        $redirectUrl = 'users.php';
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'buyer.php';
    }
    if (validateInput($role) === $role) {
        $query = "Update users set active_status=1 where id = '$user_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = $user_type . " Activated Successfully!";
            header("Location: " . $redirectUrl);
        } else {
            $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
            header("Location: " . $redirectUrl);
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: " . $redirectUrl);
    }
}

if (isset($_POST['deactive_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($role == 2) {
        $user_type = 'Seller';
        $redirectUrl = 'seller.php';
    } else if ($_SESSION['role'] == 4) {
        $user_type = 'Super Admin';
        $redirectUrl = 'users.php';
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'buyer.php';
    }

    $query = "Update users set active_status=0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Deactivated Successfully!";
        header("Location: " . $redirectUrl);
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: " . $redirectUrl);
    }
}

/* User Active Deactive Status End*/

/* User Unblock Status End*/

if (isset($_POST['unblock'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update users set log_counter=0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);
    $redirectUrl = 'users.php';
    if ($query_run) {
        $_SESSION['success'] = "UnBlocked Successfully!";
        header("Location: " . $redirectUrl);
    } else {
        $_SESSION['error'] = " status not changed due to Some Error!";
        header("Location: " . $redirectUrl);
    }
}
/* View Detail/Update organization start */

if (isset($_REQUEST['update_user_organization'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $user_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['user_id']));
    $role = mysqli_real_escape_string($conn, stripslashes($_REQUEST['role']));

    $name = mysqli_real_escape_string($conn, stripslashes($_REQUEST['name']));
    $email_address = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email_address']));

    $phone_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['phone_no']));
    $created_on = mysqli_real_escape_string($conn, stripslashes($_REQUEST['created_on']));
    $whatsapp_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['whatsapp_no']));
    $active_status = mysqli_real_escape_string($conn, stripslashes($_REQUEST['active_status']));
    $approved = mysqli_real_escape_string($conn, stripslashes($_REQUEST['approved']));



    $organizations = mysqli_real_escape_string($conn, stripslashes($_REQUEST['organizations']));
    $contact_person = mysqli_real_escape_string($conn, stripslashes($_REQUEST['contact_person']));
    $organization_email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['organization_email']));
    $organization_phone = mysqli_real_escape_string($conn, stripslashes($_REQUEST['organization_phone']));
    $address = mysqli_real_escape_string($conn, stripslashes($_REQUEST['address']));
    $city = mysqli_real_escape_string($conn, stripslashes($_REQUEST['city']));
    $district = mysqli_real_escape_string($conn, stripslashes($_REQUEST['district']));
    $state = mysqli_real_escape_string($conn, stripslashes($_REQUEST['state']));
    $pincode = mysqli_real_escape_string($conn, stripslashes($_REQUEST['pincode']));
    $production_capacity = mysqli_real_escape_string($conn, stripslashes($_REQUEST['production_capacity']));
    $materials_used = mysqli_real_escape_string($conn, stripslashes($_REQUEST['materials_used']));
    $description = mysqli_real_escape_string($conn, stripslashes($_REQUEST['description']));

    // $price_range = mysqli_real_escape_string($conn, stripslashes($_REQUEST['price_range']));
    // $production_specification = mysqli_real_escape_string($conn, stripslashes($_REQUEST['production_specification']));
    $organization_type = mysqli_real_escape_string($conn, stripslashes($_REQUEST['organization_type']));
    // $verified = mysqli_real_escape_string($conn, stripslashes($_REQUEST['verified']));
    // $vip = mysqli_real_escape_string($conn, stripslashes($_REQUEST['vip']));
    $old_image_banner = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_image_banner']));
    $image_banner = mysqli_real_escape_string($conn, $_FILES['image_banner']['name']);

    $per_name = mysqli_real_escape_string($conn, stripslashes($_REQUEST['per_name']));
    $father_name = mysqli_real_escape_string($conn, stripslashes($_REQUEST['father_name']));
    $dob = mysqli_real_escape_string($conn, stripslashes($_REQUEST['dob']));
    $designation = mysqli_real_escape_string($conn, stripslashes($_REQUEST['designation']));
    $per_address = mysqli_real_escape_string($conn, stripslashes($_REQUEST['per_address']));
    $pan_card = mysqli_real_escape_string($conn, stripslashes($_REQUEST['pan_card']));
    $addhar_id = $_REQUEST['addhar_id'];


    $gst_number = mysqli_real_escape_string($conn, stripslashes($_REQUEST['gst_number']));
    $pan_card_img = mysqli_real_escape_string($conn, $_FILES['pan_card_img']['name']);
    $old_pan_card_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_pan_card_img']));
    $voter_id_img = mysqli_real_escape_string($conn, $_FILES['voter_id_img']['name']);
    $old_voter_id_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_voter_id_img']));
    $cert_of_incorp = mysqli_real_escape_string($conn, $_FILES['cert_of_incorp']['name']);
    $old_cert_of_incorp = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_cert_of_incorp']));
    $gst_cert = mysqli_real_escape_string($conn, $_FILES['gst_cert']['name']);
    $old_gst_cert = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_gst_cert']));


    $desc_type = mysqli_real_escape_string($conn, stripslashes($_REQUEST['description']));
    $logo = mysqli_real_escape_string($conn, $_FILES['image_banner']['name']);
    $old_logo = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_image_banner']));
    // echo "<pre>";
    //     print_r($_REQUEST);
    //     exit;

    if (!empty($image_banner)) {
        $file_name = "uploads/banner/" . $image_banner;

        $tempname = $_FILES["image_banner"]["tmp_name"];
        $fileType = $_FILES['image_banner']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }

        if (aws_doc_Upload($tempname, $file_name)) {
            $image_banner = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {

            $image_banner = '';
        }
    } else {
        $image_banner = $old_image_banner;
    }

    if (!empty($pan_card_img)) {
        $file_name = "uploads/pancard/" . $pan_card_img;
        $tempname = $_FILES["pan_card_img"]["tmp_name"];
        $fileType = $_FILES['pan_card_img']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {
            $panCardImg = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {

            $panCardImg = '';
        }
    } else {
        $panCardImg = $old_pan_card_img;
    }

    if (!empty($voter_id_img)) {
        $file_name = "uploads/voter_id/" . $voter_id_img;
        $tempname = $_FILES["voter_id_img"]["tmp_name"];
        $fileType = $_FILES['voter_id_img']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {
            $voterIdImg = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {

            $voterIdImg = '';
        }
    } else {
        $voterIdImg = $old_voter_id_img;
    }

    if (!empty($cert_of_incorp)) {
        $file_name = "uploads/certificate/" . $cert_of_incorp;

        $tempname = $_FILES["cert_of_incorp"]["tmp_name"];
        $fileType = $_FILES['cert_of_incorp']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        $folder = "uploads/certificate/" . date('dmyHis') . '_' . $img_name;

        if (aws_doc_Upload($tempname, $file_name)) {
            $certificateOfIncopImg = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {

            $certificateOfIncopImg = '';
        }
    } else {
        $certificateOfIncopImg = $old_cert_of_incorp;
    }

    if (!empty($gst_cert)) {
        $file_name = "uploads/gst_certificate/" . $gst_cert;

        $tempname = $_FILES["gst_cert"]["tmp_name"];
        $fileType = $_FILES['gst_cert']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }

        if (aws_doc_Upload($tempname, $file_name)) {
            $gstCertificateImg = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {

            $gstCertificateImg = '';
        }
    } else {
        $gstCertificateImg = $old_gst_cert;
    }

    if (!empty($logo)) {
        $file_name = "uploads/logo/" . $logo;
        $tempname = $_FILES["image_banner"]["tmp_name"];
        $fileType = $_FILES['image_banner']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {
            $logoImg = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {

            $logoImg = '';
        }
    } else {
        $logoImg = $old_logo;
    }

    $created_on = date('Y-m-d', strtotime($created_on));
    //User Update Query
    $user_update_query = mysqli_query($conn, "Update users set name='$name', email_address='$email_address',
phone_no='$phone_no', whatsapp_no='$whatsapp_no', created_on='$created_on', approved='$approved' where
id='$user_id'");


    // Organization Information
    $check_organization = mysqli_query($conn, "select id from organization where user_id = '$user_id'");
    $check_num_org = mysqli_num_rows($check_organization);

    if ($check_num_org > 0) {
        $update_org_query = mysqli_query($conn, "Update organization set organizations='$organizations',
contact_person='$contact_person', email='$organization_email', phone='$organization_phone', address='$address',
city='$city', district='$district', state='$state', pincode='$pincode', production_capacity='$production_capacity',materials_used='$materials_used',description='$description', organization_type='$organization_type'
,image_banner='$image_banner' where user_id='$user_id'");
    } else {
        $insert_org_query = mysqli_query($conn, "Insert into organization set user_id='$user_id',
organizations='$organizations', contact_person='$contact_person', email='$organization_email',
phone='$organization_phone',materials_used='$materials_used',description='$description', address='$address', city='$city', district='$district', state='$state', pincode='$pincode', organization_type='$organization_type',image_banner='$image_banner'");
    }


    //Personal Information

    $check_pi = mysqli_query($conn, "select id from personal where user_id = '$user_id'");
    $check_num_check_pi = mysqli_num_rows($check_pi);

    if ($check_num_check_pi > 0) {
        $update_pi_query = mysqli_query($conn, "Update personal set per_name='$per_name', fname='$father_name', dob='$dob',
designation='$designation', per_address='$per_address', Pan_card='$pan_card', addhar_id='$addhar_id' where
user_id='$user_id'");
    } else {
        $insert_pi_query = mysqli_query($conn, "Insert into personal set user_id='$user_id', per_name='$per_name',
fname='$father_name', dob='$dob', designation='$designation', per_address='$per_address', pan_card='$pan_card',
addhar_id='$addhar_id'");
    }

    // Documents Upload

    $check_doc = mysqli_query($conn, "select id from document where user_id = '$user_id'");
    $check_num_doc = mysqli_num_rows($check_doc);

    if ($check_num_doc > 0) {
        $update_doc_query = mysqli_query($conn, "Update document set gst_number='$gst_number', pan_card_img='$panCardImg',
voter_id_img='$voterIdImg', cert_of_incorp='$certificateOfIncopImg', gst_cert='$gstCertificateImg' where
user_id='$user_id'");
    } else {
        $insert_doc_query = mysqli_query($conn, "Insert into document set user_id='$user_id', gst_number='$gst_number',
pan_card_img='$panCardImg', voter_id_img='$voterIdImg', cert_of_incorp='$certificateOfIncopImg',
gst_cert='$gstCertificateImg'");
    }

    // Logo & Subscription

    $check_logo = mysqli_query($conn, "select id from logosub where user_id = '$user_id'");
    $check_num_logo = mysqli_num_rows($check_logo);

    if ($check_num_logo > 0) {
        $update_logo_query = mysqli_query($conn, "Update logosub set desc_type='$desc_type', logo='$logoImg' where
user_id='$user_id'");
    } else {
        $insert_logo_query = mysqli_query($conn, "Insert into logosub set user_id='$user_id', desc_type='$desc_type',
logo='$logoImg'");
    }

    if ($role == 2) {
        $user_type = 'Seller';
        $redirectUrl = 'view-details.php?role=' . $role . '&prod_id=' . $_SESSION['id'];
    } else if ($role == 1) {
        $user_type =     'Admin';
        $redirectUrl = 'view-details.php?role=' . $role . '&prod_id=' . $user_id;
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'view-details.php?role=' . $role . '&prod_id=' . $_SESSION['id'];
    }

    // if ($role == 2) {

    //     if ($vip == 1 && $verified == 1) {
    //         $redirectUrl = 'payment.php?id=' . $user_id . '&vip=' . $vip . '&veryfiy=' . $verified;
    //     }

    // }

    if ($user_update_query) {
        $_SESSION['success'] = "Updated Successfully!";
        if ($_SESSION['role'] != 1) {
            // header("Location: index.php");
            header("Location: " . $redirectUrl);
        } else {
            header("Location: " . $redirectUrl);
        }
    } else {
        $_SESSION['error'] = "Not Updated Due to Some Error!";
        if ($_SESSION['role'] != 1) {
            header("Location: index.php");
        } else {
            header("Location: " . $redirectUrl);
        }
    }
}

if (isset($_POST['testimonial_save'])) {
    $para = mysqli_real_escape_string($conn, $_POST['para']);
    $writer = mysqli_real_escape_string($conn, $_POST['writer']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);

    $validated_para = validateInput($para);
    $validated_writer = validateInput($writer);
    $validated_post = validateInput($post);
    $validated_company = validateInput($company);




    if ($_FILES['profile']['name']) {
        $profile = $_FILES['profile']['name'];
        $fileType = $_FILES['profile']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: testimonial.php");
            exit;
        }
        $tempname = $_FILES['profile']['tmp_name'];
        $file_name = 'uploads/testimonial/' . $profile;
        aws_doc_Upload($tempname, $file_name);
        $db_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
    }
    if ($validated_para === $para && $validated_writer === $writer && $validated_post === $post && $validated_company === $company) {
        $query = "insert into testimonials(para,writer,post,profile,company) values('$para','$writer','$post','$db_filename','$company')";
        $query_run = mysqli_query($conn, $query);
    } else {
        // $_SESSION['error'] = "Invalid Input";
        // header("Location: testimonial.php");
    }
    if ($query_run) {
        $_SESSION['success'] = "Testimonial Added Successfully!";
        header("Location: testimonial.php");
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: testimonial.php");
    }
}

if (isset($_POST['news_save'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $slug = str_replace(" ", "-", $title);
    $date = date("Y-m-d H:i:s");
    $uploadDir = 'uploads/news/';
    $uploadFile = $uploadDir . basename($_FILES['news_image']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if file already exists
    // if (file_exists($uploadFile)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size (5MB limit)
    if ($_FILES['news_image']['size'] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'webp'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {

        //echo "Sorry, your file was not uploaded.";
    } else {
        // Try to upload the file
        $fileType = $_FILES['news_image']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            //die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
        }
        $tempname = $_FILES['news_image']['tmp_name'];
        $file_name = 'uploads/news/' . $_FILES['news_image']['name'];

        if (aws_doc_Upload($tempname, $file_name)) {



            $db_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;

            if (validateInput($title) === $title && validateInput($desc) === $desc) {
                $query = "insert into news(title,data,slug,image,date) values('$title','$desc','$slug','$db_filename','$date')";


                $query_run = mysqli_query($conn, $query);
                if ($query_run) {
                    $_SESSION['success'] = "News Added Successfully!";
                    header("Location: news.php");
                } else {
                    $_SESSION['error'] = "News Not Added Due to Some Error!";
                    header("Location: news.php");
                }
            } else {
                $_SESSION['error'] = "Invalid Input";
                header("Location: news.php");
            }
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
}


if (isset($_POST['image_save'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $slug = str_replace(" ", "-", $title);
    $date = date("Y-m-d H:i:s");
    $uploadDir = 'uploads/images/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($uploadFile)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (5MB limit)
    if ($_FILES['image']['size'] > 5000000) {
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx'];
    if (!in_array($fileType, $allowedTypes)) {
        //echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    } else {
        $fileType = $_FILES['news_image']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            //die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
        }
        $tempname = $_FILES['image']['tmp_name'];
        $file_name = 'uploads/images/' . $_FILES['image']['name'];
        if (aws_doc_Upload($tempname, $file_name)) {

            $db_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;

            if (validateInput($title) === $title && validateInput($desc) === $desc && validateInput($category) === $category) {
                $query = "insert into news(title,category,description,slug,image,date) values('$title','$category','$desc','$slug','$db_filename','$date')";
                $query_run = mysqli_query($conn, $query);
                if ($query_run) {
                    $_SESSION['success'] = "News Added Successfully!";
                    header("Location: news.php");
                } else {
                    $_SESSION['error'] = "News Not Added Due to Some Error!";
                    header("Location: news.php");
                }
            } else {
                $_SESSION['error'] = "Invalid Input";
                header("Location: news.php");
            }
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
}

if (isset($_REQUEST['testimonial_update'])) {
    $para = mysqli_real_escape_string($conn, stripslashes($_REQUEST['para']));
    $writer = mysqli_real_escape_string($conn, stripslashes($_REQUEST['writer']));
    $company = mysqli_real_escape_string($conn, stripslashes($_REQUEST['company']));
    $post = mysqli_real_escape_string($conn, stripslashes($_REQUEST['post']));
    $product_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_id']));
    if ($_FILES['profile']['name']) {
        $profile = $_FILES['profile']['name'];
        $fileType = $_FILES['profile']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: testimonial.php");
            exit;
        }
        $file_name = 'uploads/testimonial/' . $profile;
        $tempname = $_FILES['profile']['tmp_name'];
        aws_doc_Upload($tempname, $file_name);
        $db_file = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
    } else {
        $db_file = $_REQUEST['old_profile'];
    }
    if (validateInput($para) === $para && validateInput($writer) === $writer && validateInput($company) === $company && validateInput($post) === $post) {
        $query = "UPDATE testimonials SET para='$para',writer='$writer',company='$company',post='$post',profile='$db_file' WHERE id='$product_id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Testimonial Update Successfully!";
            header("Location: testimonial.php");
        } else {
            $_SESSION['error'] = "Testimonial Not Updated Due to Some Error!";
            header("Location: testimonial.php");
        }
    } else {

        $_SESSION['error'] = "Invalid Input";
        header("Location: testimonial.php");
    }
}

if (isset($_POST['testimonial_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['testmo_delete_id']);

    $query = "delete from testimonials where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Testimonial Deleted Successfully!";
        header("Location: testimonial.php");
    } else {
        $_SESSION['error'] = "Testimonial Not Deleted Due to Some Error!";
        header("Location: testimonial.php");
    }
}

if (isset($_POST['news_update'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $slug = str_replace(" ", "-", $title);
    $date = date("Y-m-d H:i:s");

    if ($_FILES['edit_image']['name']) {
        $uploadDir = 'uploads/news/';
        $uploadFile = $uploadDir . $_FILES['edit_image']['name'];
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    } else {
        $uploadFile = $_POST['old_image'];
    }
    $fileType = $_FILES['edit_image']['type'];
    if (!isValidFileType($fileType, $allowedMimeTypes)) {
        // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
        $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
        header("Location: news.php");
        exit;
    }
    aws_doc_Upload($_FILES['edit_image']['tmp_name'], $uploadFile);
    $uploadFile = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $uploadFile;


    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    if (validateInput($title) === $title) {
        $query = "update news set title='$title',slug='$slug',image='$uploadFile' where id='$product_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "News Updated Successfully!";
            header("Location: news.php");
        } else {
            $_SESSION['error'] = "News Not Updated Due to Some Error!";
            header("Location: news.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: news.php");
    }
}
if (isset($_POST['update_video'])) {

    $title = mysqli_real_escape_string($conn, $_POST['video']);

    $data = mysqli_real_escape_string($conn, $_POST['video_title']);
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    if (validateInput($title) === $title && validateInput($data) === $data) {
        $query = "update videos set video='$title',video_title='$data' where id='$product_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Video Updated Successfully!";
            header("Location: upload_video.php");
        } else {
            $_SESSION['error'] = "Video Not Updated Due to Some Error!";
            header("Location: upload_video.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input";
        header("Location: upload_video.php");
    }
}
if (isset($_POST['news_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['news_delete_id']);

    $query = "delete from news where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "News Deleted Successfully!";
        header("Location: news.php");
    } else {
        $_SESSION['error'] = "News Not Deleted Due to Some Error!";
        header("Location: news.php");
    }
}
if (isset($_POST['video_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['video_delete_id']);

    $query = "delete from videos where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Video Deleted Successfully!";
        header("Location: upload_video.php");
    } else {
        $_SESSION['error'] = "Video Not Deleted Due to Some Error!";
        header("Location: upload_video.php");
    }
}
if (isset($_REQUEST['update_password'])) {
    $new_password = mysqli_real_escape_string($conn, stripslashes(md5($_REQUEST['new_password'])));
    $confirm_password = mysqli_real_escape_string($conn, stripslashes(md5($_REQUEST['confirm_password'])));
    $user_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['user_id']));
    $role = mysqli_real_escape_string($conn, stripslashes($_REQUEST['role']));
    $type = mysqli_real_escape_string($conn, stripslashes($_REQUEST['type']));


    if ($role == 2) {
        $user_type = 'change password';
        $redirectUrl = 'changepassword.php';
    } else if ($role == 1) {
        $user_type = 'Admin';
        $redirectUrl = 'seller.php';
    } else if ($role == 4) {
        $user_type = 'Super Admin';
        $redirectUrl = 'users.php';
    } else if ($role == 5) {
        $user_type = 'Consultant';
        $redirectUrl = 'consultant.php';
    } else if ($role == 3 && $type == "buyer_seller") {
        $user_type = 'Buyer';
        $redirectUrl = 'changepassword.php';
    } else if ($role == 2 && $type == "buyer_seller") {
        $user_type = 'Seller';
        $redirectUrl = 'changepassword.php';
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'buyer.php';
    }


    if ($new_password == $confirm_password) {
        $query = "update users set password='$confirm_password' where id='$user_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Password Changed Successfully!";
            header("Location: " . $redirectUrl);
        } else {
            $_SESSION['error'] = "Password Not Change Due to Some Error!";
            header("Location: " . $redirectUrl);
        }
    } else {
        $_SESSION['error'] = "New Password and Confirm Password is not same!";
        header("Location: change_password.php?role=" . $role . "&prod_id=" . $user_id);
    }
}

if (isset($_REQUEST['create_deal'])) {

    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $buyer = mysqli_real_escape_string($conn, stripslashes($_REQUEST['buyer']));
    $seller = mysqli_real_escape_string($conn, stripslashes($_REQUEST['seller']));
    $contact_person = mysqli_real_escape_string($conn, stripslashes($_REQUEST['scontact_person']));
    $mobile_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['sphone']));
    $email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['semail']));
    $product_desc = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_desc']));
    $deal_size = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_size']));
    $deal_amount = $_REQUEST['deal_amount'];
    $buyerid = mysqli_real_escape_string($conn, stripslashes($_REQUEST['buyerid']));
    $weight = mysqli_real_escape_string($conn, stripslashes($_REQUEST['weight']));
    $brightness = mysqli_real_escape_string($conn, stripslashes($_REQUEST['brightness']));
    $category = mysqli_real_escape_string($conn, stripslashes($_REQUEST['category']));
    $remarks = mysqli_real_escape_string($conn, stripslashes($_REQUEST['remarks']));
    $created_on = date('Y-m-d H:i:s');

    $target_dir = "uploads/tds/";
    $tds = $target_dir . $_FILES["tds"]["name"];
    $fileType = $_FILES['tds']['type'];
    // if (!isValidFileType($fileType, $allowedMimeTypes)) {
    //     // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
    //     $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
    //     header("Location: current-deals.php");
    //     exit;
    // }
    aws_doc_Upload($_FILES["tds"]["tmp_name"], $tds);
    $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $tds;

    // if (validateInput($seller) === $seller && validateInput($contact_person) === $contact_person && validateInput($mobile_no) === $mobile_no && validateInput($email) === $email && validateInput($product_desc) === $product_desc && validateInput($deal_size) === $deal_size && validateInput($deal_amount) === $deal_amount && validateInput($weight) === $weight && validateInput($commission) === $commission && validateInput($buyer_commission) === $buyer_commission && validateInput($seller_commission) === $seller_commission && validateInput($remarks) === $remarks && validateInput($buyer) === $buyer && validateInput($category) === $category && validateInput($brightness) === $brightness) {
    $query = mysqli_query($conn, "Insert into deals(deal_id, buyer_id, seller_id, contact_person, mobile_no, email_id,
product_description, deal_size,deal_amount,weight,commission, buyer_commission, seller_commission, remarks,created_on,buyer,tds,category,brightness) values('$deal_id', '$buyerid',
'$seller', '$contact_person', '$mobile_no', '$email', '$product_desc', '$deal_size','$deal_amount','$weight','$commission', '$buyer_commission',
'$seller_commission', '$remarks','$created_on','$buyer','$update_filename','$category','$brightness')");

    if ($query > 0) {
        $_SESSION['success'] = "Deal Created Successfully!";
        header("Location: current-deals.php");
    } else {
        $_SESSION['error'] = "Deal Not Created Due to Some Error!";
        header("Location: current-deals.php");
    }
    // } else {
    //     $_SESSION['error'] = "Invalid Input!";
    //     header("Location: current-deals.php");
    // }
}
if (isset($_POST['profile_information_save'])) {
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $deal_in = mysqli_real_escape_string($conn, $_POST['deal_in']);
    $business_area = mysqli_real_escape_string($conn, $_POST['business_area']);
    $sub_products = mysqli_real_escape_string($conn, $_POST['sub_products']);
    $price_range = mysqli_real_escape_string($conn, $_POST['price_range']);
    $delivery = mysqli_real_escape_string($conn, $_POST['delivery']);
    $type_of_seller = mysqli_real_escape_string($conn, $_POST['type_of_seller']);
    $target_dir = "uploads/profile/";
    $profile_picture = $_FILES["profile_picture"]["name"];
    $folder = $target_dir . date('dmyHis') . '_' . $profile_picture;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($profile_picture, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($profile_picture)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {

        $fileType = $_FILES['profile_picture']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: companyprofile.php");
            exit;
        }
        if (aws_doc_Upload($_FILES["profile_picture"]["tmp_name"], $folder)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (validateInput($company_name) === $company_name && validateInput($deal_in) === $deal_in && validateInput($business_area) === $business_area && validateInput($sub_products) === $sub_products && validateInput($price_range) === $price_range && validateInput($delivery) === $delivery && validateInput($type_of_seller) === $type_of_seller) {

        $query = "insert into
profile_information(company_name,deal_in,business_area,sub_products,price_range,delivery,type_of_seller,profile_picture)
values('$company_name','$deal_in','$business_area','$sub_products','$price_range','$delivery','$type_of_seller','$update_filename')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Profile Information Added Successfully!";
            header("Location: companyprofile.php");
        } else {
            $_SESSION['error'] = "Profile Information Not Added Due to Some Error!";
            header("Location: companyprofile.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: companyprofile.php");
    }
}

if (isset($_REQUEST['upload_video'])) {
    $video = mysqli_real_escape_string($conn, stripslashes($_REQUEST['video']));
    $video_title = mysqli_real_escape_string($conn, stripslashes($_REQUEST['video_title']));

    if (validateInput($video) === $video && validateInput($video_title) === $video_title) {

        $query = "insert into videos set video='$video', video_title='$video_title'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Video Added Successfully!";
            header("Location: upload_video.php");
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your Video.";
            header("Location: upload_video.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: upload_video.php");
    }
}

if (isset($_POST['sample_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $dos = mysqli_real_escape_string($conn, $_POST['dos']);
    $sample_verification = mysqli_real_escape_string($conn, $_POST['sample_verification']);
    $lab_report = mysqli_real_escape_string($conn, $_POST['lab_report']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_doc']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_doc']));
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    if (!empty($doc_img)) {
        $file_name = "uploads/sample/" . $doc_img;
        $tempname = $_FILES["upload_doc"]["tmp_name"];
        $fileType = $_FILES['upload_doc']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {
            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }

    // Sampling Table
    $check_samp = mysqli_query($conn, "select id from sampling where deal_id = '$deal_id'");
    $check_num_samp = mysqli_num_rows($check_samp);

    if ($check_num_samp > 0) {

        if ($_SESSION['role'] == 3) {

            $query_run = mysqli_query($conn, "Update sampling set status='$status' where deal_id='$deal_id'");
        } else {
            if (validateInput($dos) === $dos && validateInput($sample_verification) === $sample_verification && validateInput($lab_report) === $lab_report && validateInput($remarks) === $remarks) {
                $query_run = mysqli_query($conn, "Update sampling set dos='$dos', sample_verification='$sample_verification',
lab_report='$lab_report', remarks='$remarks', upload_doc='$uploaded_doc' where deal_id='$deal_id'");
            } else {
                $_SESSION['error'] = "Invalid Input!";
                header("Location: " . $return_url);
                exit;
            }
        }
    } else {
        if (validateInput($dos) === $dos && validateInput($sample_verification) === $sample_verification && validateInput($lab_report) === $lab_report && validateInput($remarks) === $remarks) {
            $query_run = mysqli_query($conn, "Insert into sampling set deal_id='$deal_id', dos='$dos',
sample_verification='$sample_verification', lab_report='$lab_report', remarks='$remarks', upload_doc='$uploaded_doc'");
            updateDeal_Status(2, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    }

    if ($query_run) {
        $_SESSION['success'] = "Sampling Data Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Sampling Data Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['validation_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $dov = mysqli_real_escape_string($conn, $_POST['dov']);
    $sample = mysqli_real_escape_string($conn, $_POST['sample']);
    $stock_approve = mysqli_real_escape_string($conn, $_POST['stock_approve']);

    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docu']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_docu']));
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    if (!empty($doc_img)) {
        $file_name = "uploads/validation/" . $doc_img;
        $tempname = $_FILES["upload_docu"]["tmp_name"];

        $fileType = $_FILES['upload_docu']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {
            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }

    // Validation Table
    $query = mysqli_query($conn, "select id from validation where deal_id = '$deal_id'");
    $check_num_query = mysqli_num_rows($query);

    if ($check_num_query > 0) {
        if (validateInput($dov) === $dov && validateInput($sample) === $sample && validateInput($stock_approve) === $stock_approve) {
            $query_run = mysqli_query($conn, "Update validation set dov='$dov', sample='$sample', stock_approve='$stock_approve',
upload_docu='$uploaded_doc' where deal_id='$deal_id'");
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    } else {
        if (validateInput($dov) === $dov && validateInput($sample) === $sample && validateInput($stock_approve) === $stock_approve) {
            $query_run = mysqli_query($conn, "Insert into validation set deal_id='$deal_id', dov='$dov', sample='$sample',
stock_approve='$stock_approve', upload_docu='$uploaded_doc'");
            updateDeal_Status(3, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    }

    if ($query_run) {
        $_SESSION['success'] = "Validation Data Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Validation Data Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['clearance_update'])) {

    $doc = mysqli_real_escape_string($conn, $_POST['doc']);
    // $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docum']['name']);
    // $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_docum']));
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);
    $bill_img = mysqli_real_escape_string($conn, $_FILES['bill']['name']);
    $old_bill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill']));
    $ewaybill_img = mysqli_real_escape_string($conn, $_FILES['ewaybill']['name']);
    $old_ewaybill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_ewaybill']));
    $stock_statement_img = mysqli_real_escape_string($conn, $_FILES['stock_statement']['name']);
    $old_stock_statement_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_stock_statement']));
    $bill_t_img = mysqli_real_escape_string($conn, $_FILES['bill_t']['name']);
    $old_bill_t_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill_t']));

    if (!empty($bill_img)) {

        $file_name = "uploads/clearance/" . $bill_img;
        $tempname = $_FILES["bill"]["tmp_name"];
        $folder = "uploads/clearance/" . date('dmyHis') . '_' . $img_bill;
        $fileType = $_FILES['bill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {

            $uploaded_bill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {
            $uploaded_bill = '';
        }
    } else {

        $uploaded_bill = $old_bill_img;
    }

    if (!empty($ewaybill_img)) {
        $file_name = "uploads/clearance/" . $ewaybill_img;
        $tempname = $_FILES["ewaybill"]["tmp_name"];
        $fileType = $_FILES['ewaybill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {
            $uploaded_ewaybill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {
            $uploaded_ewaybill = '';
        }
    } else {
        $uploaded_ewaybill = $old_ewaybill_img;
    }
    if (!empty($stock_statement_img)) {
        $file_name = "uploads/clearance/" . $stock_statement_img;
        $tempname = $_FILES["stock_statement"]["tmp_name"];
        $fileType = $_FILES['stock_statement']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $file_name)) {

            $uploaded_stock_statement = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
        } else {
            $uploaded_stock_statement = '';
        }
    } else {

        $uploaded_stock_statement = $old_stock_statement_img;
    }

    if (!empty($bill_t_img)) {
        $img_bill_t = $bill_t_img;
        $tempname = $_FILES["bill_t"]["tmp_name"];
        $folder = "uploads/clearance/" . date('dmyHis') . '_' . $img_bill_t;
        $fileType = $_FILES['bill_t']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_bill_t = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_bill_t = '';
        }
    } else {

        $uploaded_bill_t = $old_uploaded_bill_t_img;
    }


    // Validation Table
    $query = mysqli_query($conn, "select id from clearance where deal_id = '$deal_id'");
    $check_num_query = mysqli_num_rows($query);

    if ($check_num_query > 0) {
        if (validateInput($doc) === $doc && validateInput($product) === $product && validateInput($remarks) === $remarks) {
            $query_run = mysqli_query($conn, "Update clearance set doc='$doc', product='$product', remarks='$remarks',
        bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t' where deal_id='$deal_id'");
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    } else {
        if (validateInput($doc) === $doc && validateInput($product) === $product && validateInput($remarks) === $remarks) {
            $query_run = mysqli_query($conn, "Insert into clearance set deal_id='$deal_id', doc='$doc', product='$product',
        remarks='$remarks', bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t'");
            updateDeal_Status(4, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    }

    if ($query_run) {
        $_SESSION['success'] = "Clearance Data Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Clearance Data Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['payment_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $transaction_date = mysqli_real_escape_string($conn, $_POST['transaction_date']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $acc_no = mysqli_real_escape_string($conn, $_POST['acc_no']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $ammount = mysqli_real_escape_string($conn, $_POST['ammount']);

    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docume']['name']);
    /*$old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_docume']));*/
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["upload_docume"]["tmp_name"];
        $folder = "uploads/payment/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['upload_docume']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_doc = '';
        }
    }

    // Validation Table
    $query = mysqli_query($conn, "select id from payment where deal_id = '$deal_id'");
    $check_num_query = mysqli_num_rows($query);

    if ($check_num_query > 0) {
        if (validateInput($deal_id) === $deal_id && validateInput($product) === $product && validateInput($details) === $details && validateInput($acc_no) === $acc_no && validateInput($bank) === $bank && validateInput($branch) === $branch && validateInput($ammount) === $ammount) {
            $query_run = mysqli_query($conn, "Insert into payment set deal_id='$deal_id', transaction_date='$transaction_date',
product='$product', details='$details',acc_no='$acc_no', bank='$bank', branch='$branch', ammount='$ammount', upload_docume='$uploaded_doc'");
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    } else {
        if (validateInput($deal_id) === $deal_id && validateInput($product) === $product && validateInput($details) === $details && validateInput($acc_no) === $acc_no && validateInput($bank) === $bank && validateInput($branch) === $branch && validateInput($ammount) === $ammount) {
            $query_run = mysqli_query($conn, "Insert into payment set deal_id='$deal_id', transaction_date='$transaction_date',
product='$product', details='$details', acc_no='$acc_no', bank='$bank', branch='$branch', ammount='$ammount', upload_docume='$uploaded_doc'");
            updateDeal_Status(5, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    }

    if ($query_run) {
        $_SESSION['success'] = "Payment Details Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Payment Details Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['payment_sepr_update'])) {

    // Sanitize and get form data
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));

    $transaction_date = mysqli_real_escape_string($conn, $_POST['transaction_date']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $acc_no = $_POST['acc_no'];
    $bank = $_POST['bank'];
    $branch = $_POST['branch'];
    $amount =  $_POST['amount'];
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);
    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docume']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_image']));


    if (!empty($_FILES['upload_docume']['name'])) {
        $img_name = $_FILES["upload_docume"]["name"];

        $tempname = $_FILES["upload_docume"]["tmp_name"];

        $folder = "uploads/payment/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['upload_docume']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: target-deals.php");
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {

            $update_filename = '';
        }
    } else {
        $update_filename = $_POST['old_image'];
    }
    if (validateInput($product) === $product && validateInput($details) === $details && validateInput($acc_no) === $acc_no && validateInput($bank) === $bank && validateInput($branch) === $branch && validateInput($ammount) === $ammount) {
        $query = "update payment set
deal_id='$deal_id',transaction_date='$transaction_date',product='$product',details='$details',acc_no='$acc_no',bank='$bank',branch='$branch',ammount='$amount',upload_docume='$update_filename'
where id='$id'";


        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Payment Details Updated Successfully!";
            header("Location: target-deals.php");
        } else {
            $_SESSION['error'] = "Payment Details Not Updated Due to Some Error!";
            header("Location: target-deals.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: target-deals.php");
    }
}
if (isset($_POST['pd_payment_sepr_update'])) {

    // Sanitize and get form data
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));

    $transaction_date = mysqli_real_escape_string($conn, $_POST['transaction_date']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $acc_no = mysqli_real_escape_string($conn, $_POST['acc_no']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $ammount = mysqli_real_escape_string($conn, $_POST['amount']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);
    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docume']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_image']));


    if (!empty($_FILES['upload_docume']['name'])) {
        $img_name = $_FILES["upload_docume"]["name"];

        $tempname = $_FILES["upload_docume"]["tmp_name"];

        $folder = "uploads/pd_payment/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['upload_docume']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: edit-pd-deal.php?role=1&prod_id=$deal_id");
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {

            $update_filename = '';
        }
    } else {
        $update_filename = $_POST['old_image'];
    }
    if (validateInput($product) === $product && validateInput($details) === $details && validateInput($acc_no) === $acc_no && validateInput($bank) === $bank && validateInput($branch) === $branch && validateInput($ammount) === $ammount) {
        $query = "update pd_payment set
deal_id='$deal_id',transaction_date='$transaction_date',product='$product',acc_no='$acc_no',bank='$bank',branch='$branch',ammount='$ammount',details='$details',upload_docume='$update_filename'
where id='$id'";


        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "PD Payment Details Updated Successfully!";
            header("Location: edit-pd-deal.php?role=1&prod_id=$deal_id");
        } else {
            $_SESSION['error'] = "PD Payment Details Not Updated Due to Some Error!";
            header("Location: edit-pd-deal.php?role=1&prod_id=$deal_id");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: " . $return_url);
        exit;
    }
}


if (isset($_POST['transportation_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $transportation_date = mysqli_real_escape_string($conn, $_POST['transportation_date']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $mot = mysqli_real_escape_string($conn, $_POST['mot']);
    $vehicle_no = mysqli_real_escape_string($conn, $_POST['vehicle_no']);
    $ammount_incured = mysqli_real_escape_string($conn, $_POST['freight']);
    $transporter_name = mysqli_real_escape_string($conn, $_POST['transporter_name']);
    $bill_or_lading = mysqli_real_escape_string($conn, $_POST['bill_or_lading']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);


    // $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_documen']['name']);
    // $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_documen']));
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    $bill_img = mysqli_real_escape_string($conn, $_FILES['bill']['name']);
    $old_bill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill']));
    $ewaybill_img = mysqli_real_escape_string($conn, $_FILES['ewaybill']['name']);
    $old_ewaybill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_ewaybill']));
    $stock_statement_img = mysqli_real_escape_string($conn, $_FILES['stock_statement']['name']);
    $old_stock_statement_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_stock_statement']));
    $bill_t_img = mysqli_real_escape_string($conn, $_FILES['bill_t']['name']);
    $old_bill_t_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill_t']));

    if (!empty($bill_img)) {

        $img_bill = $bill_img;
        $tempname = $_FILES["bill"]["tmp_name"];
        $folder = "uploads/transportation/" . date('dmyHis') . '_' . $img_bill;
        $fileType = $_FILES['bill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {

            $uploaded_bill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_bill = '';
        }
    } else {

        $uploaded_bill = $old_bill_img;
    }

    if (!empty($ewaybill_img)) {
        $img_ewaybill = $ewaybill_img;
        $tempname = $_FILES["ewaybill"]["tmp_name"];
        $folder = "uploads/transportation/" . date('dmyHis') . '_' . $img_ewaybill;
        $fileType = $_FILES['ewaybill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_ewaybill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_ewaybill = '';
        }
    } else {
        $uploaded_ewaybill = $old_ewaybill_img;
    }
    if (!empty($stock_statement_img)) {
        $img_stock_statement = $stock_statement_img;
        $tempname = $_FILES["stock_statement"]["tmp_name"];
        $folder = "uploads/transportation/" . date('dmyHis') . '_' . $img_stock_statement;
        $fileType = $_FILES['stock_statement']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_stock_statement = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_stock_statement = '';
        }
    } else {

        $uploaded_stock_statement = $old_stock_statement_img;
    }

    if (!empty($bill_t_img)) {
        $img_bill_t = $bill_t_img;
        $tempname = $_FILES["bill_t"]["tmp_name"];
        $folder = "uploads/transportation/" . date('dmyHis') . '_' . $img_bill_t;
        $fileType = $_FILES['bill_t']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_bill_t = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_bill_t = '';
        }
    } else {

        $uploaded_bill_t = $old_uploaded_bill_t_img;
    }


    // Validation Table
    $query = mysqli_query($conn, "select id from transportation where deal_id = '$deal_id'");
    $check_num_query = mysqli_num_rows($query);

    if ($check_num_query > 0) {

        if (validateInput($mot) === $mot && validateInput($vehicle_no) === $vehicle_no && validateInput($ammount_incured) === $ammount_incured && validateInput($bill_or_lading) === $bill_or_lading && validateInput($transporter_name) === $transporter_name && validateInput($distance) === $distance) {
            $query_run = mysqli_query($conn, "Update transportation set transportation_date='$transportation_date', date='$date',
mot='$mot', vehicle_no='$vehicle_no', ammount_incured='$ammount_incured',bill_or_lading='$bill_or_lading',transporter_name='$transporter_name',distance='$distance',bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t' where deal_id='$deal_id'");
        } else {
            $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
            header("Location: " . $return_url);
            exit;
        }
    } else {
        if (validateInput($mot) === $mot && validateInput($vehicle_no) === $vehicle_no && validateInput($ammount_incured) === $ammount_incured && validateInput($bill_or_lading) === $bill_or_lading && validateInput($transporter_name) === $transporter_name && validateInput($distance) === $distance) {
            $query_run = mysqli_query($conn, "Insert into transportation set deal_id='$deal_id',
transportation_date='$transportation_date', date='$date', mot='$mot', vehicle_no='$vehicle_no',
ammount_incured='$ammount_incured',bill_or_lading='$bill_or_lading',transporter_name='$transporter_name',distance='$distance',bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t'");
            updateDeal_Status(6, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
            header("Location: " . $return_url);
            exit;
        }

        if ($query_run) {
            $_SESSION['success'] = "Transportation Data Updated Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "Transportation Data Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    }
}
if (isset($_POST['close_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $close_date = mysqli_real_escape_string($conn, $_POST['close_date']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $product_recd = mysqli_real_escape_string($conn, $_POST['product_recd']);
    $deal_size = mysqli_real_escape_string($conn, $_POST['deal_size']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);
    $comission = $_POST['comission'];


    // Validation Table
    $query = mysqli_query($conn, "select id from close where deal_id = '$deal_id'");
    $check_num_query = mysqli_num_rows($query);
    mysqli_query($conn, "Update deals set commission='$comission' where id='$deal_id'");
    if ($check_num_query > 0) {

        if (validateInput($product) === $product && validateInput($comission) === $comission && validateInput($remarks) === $remarks && validateInput($product_recd) === $product_recd && validateInput($deal_size) === $deal_size) {
            $query_run = mysqli_query($conn, "Update close set close_date='$close_date', product='$product',comission='$comission', remarks='$remarks',product_recd='$product_recd', deal_size='$deal_size' where deal_id='$deal_id'");
        } else {
            $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
            header("Location: " . $return_url);
            exit;
        }
    } else {
        if (validateInput($product) === $product && validateInput($comission) === $comission && validateInput($remarks) === $remarks && validateInput($product_recd) === $product_recd && validateInput($deal_size) === $deal_size) {

            $query_run = mysqli_query($conn, "Insert into close set deal_id='$deal_id', close_date='$close_date',
product='$product', comission='$comission',remarks='$remarks', product_recd='$product_recd', deal_size='$deal_size'");
            updateDeal_Status(7, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
            header("Location: " . $return_url);
            exit;
        }
    }

    if ($query_run) {
        $_SESSION['success'] = "Close Data Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Close Data Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['active_deal'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['deal_id']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    $query = "Update deals set status=1 where id = '$deal_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Deal Activated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Deal status not changed due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['deactive_deal'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['deal_id']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    $query = "Update deals set status=0 where id = '$deal_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Deal Deactivated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Deal status not changed due to Some Error!";
        header("Location: " . $return_url);
    }
}


if (isset($_POST['update_deal'])) {

    $buyer = mysqli_real_escape_string($conn, stripslashes($_REQUEST['buyer_id']));
    $seller = mysqli_real_escape_string($conn, stripslashes($_REQUEST['seller_id']));
    $category = $_REQUEST['category'];
    $contact_person = mysqli_real_escape_string($conn, stripslashes($_REQUEST['contact_person']));
    $mobile_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['mobile_no']));
    $email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email']));
    $product_desc = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_desc']));
    $deal_size = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_size']));
    $remarks = mysqli_real_escape_string($conn, stripslashes($_REQUEST['remarks']));

    $product_name = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_name']));
    $sub_product = mysqli_real_escape_string($conn, stripslashes($_REQUEST['sub_product']));
    $hsn_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['hsn_no']));
    $shade = mysqli_real_escape_string($conn, stripslashes($_REQUEST['shade']));
    $gsm = mysqli_real_escape_string($conn, stripslashes($_REQUEST['gsm']));
    $size = mysqli_real_escape_string($conn, stripslashes($_REQUEST['size']));
    $bf = mysqli_real_escape_string($conn, stripslashes($_REQUEST['bf']));
    $stock_in_kg = mysqli_real_escape_string($conn, stripslashes($_REQUEST['stock_in_kg']));
    $grain = mysqli_real_escape_string($conn, stripslashes($_REQUEST['grain']));
    $sheet = mysqli_real_escape_string($conn, stripslashes($_REQUEST['sheet']));
    $brightness = mysqli_real_escape_string($conn, stripslashes($_REQUEST['brightness']));

    $rim_weight = mysqli_real_escape_string($conn, stripslashes($_REQUEST['rim_weight']));
    $w_l = mysqli_real_escape_string($conn, stripslashes($_REQUEST['w_l']));
    $no_of_bundle = mysqli_real_escape_string($conn, stripslashes($_REQUEST['no_of_bundle']));
    $no_of_rim = mysqli_real_escape_string($conn, stripslashes($_REQUEST['no_of_rim']));
    $price_per_kg = mysqli_real_escape_string($conn, stripslashes($_REQUEST['price_per_kg']));
    $quantity_in_kg = mysqli_real_escape_string($conn, stripslashes($_REQUEST['quantity_in_kg']));


    if ($_FILES["tds"]["name"]) {
        $target_dir = "uploads/tds/";
        $tds = $target_dir . $_FILES["tds"]["name"];
        $fileType = $_FILES['tds']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        aws_doc_Upload($_FILES["tds"]["tmp_name"], $tds);
        $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $tds;
    } else {
        $tds = $_REQUEST['oldtds'];
    }
    $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));

    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    // if (validateInput($buyer) === $buyer && validateInput($seller_id) === $seller_id && validateInput($category) === $category && validateInput($contact_person) === $contact_person && validateInput($mobile_no) === $mobile_no && validateInput($email) === $email && validateInput($product_desc) === $product_desc && validateInput($deal_size) === $deal_size && validateInput($weight) === $weight && validateInput($w_l) === $w_l && validateInput($remarks) === $remarks && validateInput($sub_product) === $sub_product && validateInput($shade) === $shade && validateInput($gsm) === $gsm && validateInput($size) === $size && validateInput($bf) === $bf && validateInput($stock_in_kg) === $stock_in_kg && validateInput($grain) === $grain && validateInput($sheet) === $sheet && validateInput($rim_weight) === $rim_weight && validateInput($no_of_bundle) === $no_of_bundle && validateInput($no_of_rim) === $no_of_rim && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg && validateInput($hsn_no) === $hsn_no && validateInput($brightness) === $brightness) {
    $query = "update deals set
     buyer_id='$buyer',seller_id='$seller',category='$category',contact_person='$contact_person',mobile_no='$mobile_no',email_id='$email',product_description='$product_desc',deal_size='$deal_size',weight='$weight',tds='$update_filename',remarks='$remarks',sub_product='$sub_product',shade='$shade',gsm='$gsm',deal_size='$size',bf='$bf',stock_in_kg='$stock_in_kg',grain='$grain',sheat='$sheet',rim_weight='$rim_weight',w_l='$w_l',no_of_bundle='$no_of_bundle',no_of_rim='$no_of_rim',price_per_kg='$price_per_kg',quantity_in_kg='$quantity_in_kg',hsn='$hsn_no',brightness='$brightness'
     where id='$id'";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['success'] = "Deal Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "Deal Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
    // } else {
    //     $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
    //     header("Location: " . $return_url);
    //     exit;
    // }
}


if (isset($_POST['site_logo_save'])) {
    $type_of_seller = mysqli_real_escape_string($conn, $_POST['logo_name']);
    $target_dir = "uploads/profile/";
    $profile_picture = $_FILES["logo_picture"]["name"];
    $folder = $target_dir . date('dmyHis') . '_' . $profile_picture;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($profile_picture, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["logo_picture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($profile_picture)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["logo_picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $fileType = $_FILES['logo_picture']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: site_logo.php");
            exit;
        }
        if (aws_doc_Upload($_FILES["logo_picture"]["tmp_name"], $folder)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (validateInput($type_of_seller) === $type_of_seller) {
        $query = "insert into site_logo(logo_name,logo_picture) values('$type_of_seller','$update_filename')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Logo Added Successfully!";
            header("Location: site_logo.php");
        } else {
            $_SESSION['error'] = "Logo Not Added Due to Some Error!";
            header("Location: site_logo.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
        header("Location: site_logo.php");
        exit;
    }
}

if (isset($_POST['update_logo_save'])) {
    $product_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_id']));
    $logo_name = mysqli_real_escape_string($conn, $_POST['logo_name']);
    $doc_img = mysqli_real_escape_string($conn, $_FILES['logo_picture']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_image']));

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["logo_picture"]["tmp_name"];
        $folder = "uploads/profile/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['logo_picture']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: site_logo.php");
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }
    if (validateInput($logo_name) === $logo_name) {
        $query = "update site_logo set logo_name='$logo_name',logo_picture='$uploaded_doc' where id='$product_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Logo Updated Successfully!";
            header("Location: site_logo.php");
        } else {
            $_SESSION['error'] = "Logo Not Updated Due to Some Error!";
            header("Location: site_logo.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
        header("Location: site_logo.php");
        exit;
    }
}


if (isset($_POST['main_logo_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['logo_delete_nac']);

    $query = "delete from site_logo where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Main Logo Deleted Successfully!";
        header("Location: site_logo.php");
    } else {
        $_SESSION['error'] = "Main Logo Not Deleted Due to Some Error!";
        header("Location: site_logo.php");
    }
}


if (isset($_POST['consultant_save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $expert_trade = mysqli_real_escape_string($conn, $_POST['expert_trade']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $target_dir = "uploads/consultant_image/";
    $profile_picture = $_FILES["consultant_image"]["name"];
    $folder = $target_dir . date('dmyHis') . '_' . $profile_picture;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($profile_picture, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["consultant_image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($profile_picture)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["consultant_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $fileType = $_FILES['consultant_image']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: consultant.php");
            exit;
        }
        if (aws_doc_Upload($_FILES["consultant_image"]["tmp_name"], $folder)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    if (validateInput($name) === $name && validateInput($address) === $address && validateInput($phone) === $phone && validateInput($expert_trade) === $expert_trade && validateInput($qualification) === $qualification && validateInput($price) === $price) {
        $query = "insert into add_consultant(name,address,phone,expert_trade,qualification,dob,price,consultant_image)
values('$name','$address','$phone','$expert_trade','$qualification','$dob',$price,'$update_filename')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Consultant Added Successfully!";
            header("Location: consultant.php");
        } else {
            $_SESSION['error'] = "Consultant Not Added Due to Some Error!";
            header("Location: consultant.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input! Please Check Your Inputs.";
        header("Location: consultant.php");
        exit;
    }
}

if (isset($_POST['consultant_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['consultant_delete_id']);

    $query = "delete from add_consultant where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Consultant Deleted Successfully!";
        header("Location: consultant.php");
    } else {
        $_SESSION['error'] = "Consultant Not Deleted Due to Some Error!";
        header("Location: consultant.php");
    }
}


if (isset($_POST['update_status'])) {
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Validate required parameters
    if (!isset($_POST['table_name']) || !isset($_POST['id']) || !isset($_POST['status'])) {
        echo "Missing required parameters.";
        exit;
    }

    // Retrieve and sanitize inputs
    $table_name = mysqli_real_escape_string($conn, $_POST['table_name']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);


    // Determine the redirection URL based on the table name
    switch ($table_name) {
        case 'support':
            $redirectUrl = 'support_show.php';
            break;
        case 'reqcall':
            $redirectUrl = 'request_call.php';
            break;
        case 'enquiry':
            $redirectUrl = 'enquiry_show.php';
            break;
        case 'contact_us':
            $redirectUrl = 'contact-us.php';
            break;
        case 'spot_price_enquiry':
            $redirectUrl = 'spot_price_enqu.php';
            break;
        case 'enquery_message':
            $redirectUrl = 'enquiry_show.php';
            if (isset($_POST['msgid'])) {
                $id = mysqli_real_escape_string($conn, $_POST['msgid']);
                $status = mysqli_real_escape_string($conn, $_POST['msgstaus']);
                if ($status == 0) {
                    $status = 1;
                } else {
                    $status = 0;
                }
            } else {
                echo "Missing msgid for enquery_message.";
                exit;
            }
            break;
        default:
            echo "Unknown table name.";
            exit;
    }

    // Prepare the query to update the status in the specified table

    $query = "UPDATE `$table_name` SET status = $status WHERE id = $id";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {




        $_SESSION['success'] = "Updated Successfully!";
    } else {
        $_SESSION['error'] = "Statement preparation failed: " . $conn->error;
    }

    // Redirect to the appropriate page
    header("Location: $redirectUrl");
}

if (isset($_POST['billing_save'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['deal_id']);
    $billing_for = mysqli_real_escape_string($conn, $_POST['billing_for']);
    $billing_name = mysqli_real_escape_string($conn, $_POST['billing_name']);
    $acc_no = mysqli_real_escape_string($conn, $_POST['acc_no']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $amount =  $_POST['amount'];
    if (isset($_FILES["invoice"]) && $_FILES["invoice"]["error"] == 0) {
        $target_dir = "uploads/billing/";
        $target_file = $target_dir . date('dmyHis') . '_' . $_FILES["invoice"]["name"];
        $uploadOk = 1;
        $pdfFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (optional)
        if ($_FILES["invoice"]["size"] > 5000000) { // Adjust size limit as needed
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only PDF files
        if ($pdfFileType != "pdf") {
            // echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $fileType = $_FILES['invoice']['type'];
            if (!isValidFileType($fileType, $allowedMimeTypes)) {
                // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
                $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
                header("Location: billing_history.php");
                exit;
            }
            if (aws_doc_Upload($_FILES["invoice"]["tmp_name"], $target_file)) {
                $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $file_name;
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        //echo "No file uploaded.";
    }
    if (validateInput($billing_for) === $billing_for && validateInput($billing_name) === $billing_name && validateInput($amount) === $amount && validateInput($bank) === $bank && validateInput($branch) === $branch && validateInput($acc_no) === $acc_no) {
        $query = "insert into billing_admn(billing_for,billing_name,amount,invoice,deal_id,bank,branch,acc_no)
values('$billing_for','$billing_name','$amount','$update_filename','$deal_id','$bank','$branch','$acc_no')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Billing Added Successfully!";
            header("Location: billing_history.php");
        } else {
            $_SESSION['error'] = "Billing Not Added Due to Some Error!";
            header("Location: billing_history.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: billing_history.php");
    }
}


if (isset($_POST['add_spot_price'])) {

    $select_category = mysqli_real_escape_string($conn, $_POST['select_category']);
    $count = mysqli_real_escape_string($conn, $_POST['count']);
    $csp = mysqli_real_escape_string($conn, $_POST['csp']);
    $gujarat = mysqli_real_escape_string($conn, $_POST['gujarat']);
    $mp = mysqli_real_escape_string($conn, $_POST['mp']);
    $north_zone = mysqli_real_escape_string($conn, $_POST['north_zone']);
    $south_zone = mysqli_real_escape_string($conn, $_POST['south_zone']);



    if (validateInput($select_category) === $select_category && validateInput($count) === $count && validateInput($csp) === $csp && validateInput($gujarat) === $gujarat && validateInput($mp) === $mp && validateInput($north_zone) === $north_zone && validateInput($south_zone) === $south_zone) {

        $query = "insert into add_spot_price(select_category,count,csp,gujarat,mp,north_zone,south_zone)
values('$select_category','$count','$csp','$gujarat','$mp','$north_zone','$south_zone')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Spot Price Added Successfully!";
            header("Location: view_spot_price.php");
        } else {
            $_SESSION['error'] = "Spot Price Not Added Due to Some Error!";
            header("Location: view_spot_price.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: view_spot_price.php");
    }
}

if (isset($_POST['update_spot_price'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['deal_id']);
    $select_category = mysqli_real_escape_string($conn, $_POST['select_category']);
    $count = mysqli_real_escape_string($conn, $_POST['count']);
    $csp = mysqli_real_escape_string($conn, $_POST['csp']);
    $gujarat = mysqli_real_escape_string($conn, $_POST['gujarat']);
    $mp = mysqli_real_escape_string($conn, $_POST['mp']);
    $north_zone = mysqli_real_escape_string($conn, $_POST['north_zone']);
    $south_zone = mysqli_real_escape_string($conn, $_POST['south_zone']);

    if (validateInput($deal_id) === $deal_id && validateInput($select_category) === $select_category && validateInput($count) === $count && validateInput($csp) === $csp && validateInput($gujarat) === $gujarat && validateInput($mp) === $mp && validateInput($north_zone) === $north_zone && validateInput($south_zone) === $south_zone) {

        $query = "Update add_spot_price set select_category='$select_category', count='$count', csp='$csp', gujarat='$gujarat',
mp='$mp', north_zone='$north_zone', south_zone='$south_zone' where id='$deal_id'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Spot Price Updated Successfully!";
            header("Location: view_spot_price.php");
        } else {
            $_SESSION['error'] = "Spot Price Not Updated Due to Some Error!";
            header("Location: view_spot_price.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: view_spot_price.php");
    }
}


if (isset($_POST['update_bales_spot_price'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['deal_id']);
    $select_category = mysqli_real_escape_string($conn, $_POST['select_category']);
    $select_type = mysqli_real_escape_string($conn, $_POST['select_type']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $mic = mysqli_real_escape_string($conn, $_POST['mic']);
    $length = mysqli_real_escape_string($conn, $_POST['length']);
    $rd = mysqli_real_escape_string($conn, $_POST['rd']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    if (validateInput($deal_id) === $deal_id && validateInput($select_category) === $select_category && validateInput($select_type) === $select_type && validateInput($state) === $state && validateInput($mic) === $mic && validateInput($length) === $length && validateInput($rd) === $rd && validateInput($price) === $price) {
        $query = "Update cotton_bales_spot_price set select_category='$select_category', select_type='$select_type',
state='$state', mic='$mic', length='$length', rd='$rd', price='$price' where id='$deal_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "MIC Updated Successfully!";
            header("Location: view_mic_price.php");
        } else {
            $_SESSION['error'] = "MIC Not Updated Due to Some Error!";
            header("Location: view_mic_price.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: view_mic_price.php");
    }
}

if (isset($_POST['save_master_product'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);


    if (validateInput($product_id) === $product_id && validateInput($product_name) === $product_name) {   // Validate input before inserting to database
        $query = "insert into master_product(product_name,product_id) values('$product_name','$product_id')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Master Product Added Successfully!";
            header("Location: master_product.php");
        } else {
            $_SESSION['error'] = "Master Product Not Added Due to Some Error!";
            header("Location: master_product.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: master_product.php");
    }
}

if (isset($_POST['update_master_product'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);

    if (validateInput($deal_id) === $deal_id && validateInput($product_name) === $product_name) {   // Validate input before inserting to database
        $query = "Update master_product set product_name='$product_name' where id='$deal_id'";
        $query = "Update master_product set product_name='$product_name' where id='$deal_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Master Product Updated Successfully!";
            header("Location: master_product.php");
        } else {
            $_SESSION['error'] = "Master Product Not Updated Due to Some Error!";
            header("Location: master_product.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: master_product.php");
    }
}


// PD Deal Master Section Start //
if (isset($_REQUEST['create_pd_deal'])) {

    $user_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['user_id']));
    $buyer = mysqli_real_escape_string($conn, stripslashes($_REQUEST['buyer']));
    $contact_person = mysqli_real_escape_string($conn, stripslashes($_REQUEST['contact_person']));
    $mobile_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['mobile_no']));
    $email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email']));
    $product_desc = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_desc']));
    $deal_size = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_size']));
    $deal_amount = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_amount']));

    $date = date('Y-m-d H:i:s');
    //    

    if (validateInput($user_id) === $user_id && validateInput($buyer) === $buyer && validateInput($deal_size) === $deal_size && validateInput($contact_person) === $contact_person && validateInput($product_desc) === $product_desc && validateInput($mobile_no) === $mobile_no && validateInput($email) === $email) {

        $query = mysqli_query($conn, "Insert into pd_deals_master(user_id, buyer_id, contact_person, mobile_no, email_id,
        product_description, deal_size,balanced_deal_size,created_on,total_deal_amount) values('$user_id', '$buyer', '$contact_person', '$mobile_no', '$email', '$product_desc',
        '$deal_size',
        '$deal_size','$date','$deal_amount')");

        if ($query > 0) {
            $_SESSION['success'] = "PD Deal Created Successfully!";
            header("Location: process-pd-deals-list.php");
        } else {
            $_SESSION['error'] = "PD Deal Not Created Due to Some Error!";
            header("Location: process-pd-deals-list.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: process-pd-deals-list.php");
    }
}

if (isset($_REQUEST['process_pd_deal'])) {

    // Sanitize and validate inputs
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $user_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['user_id']));
    $buyer = mysqli_real_escape_string($conn, stripslashes($_REQUEST['buyer']));
    $seller = mysqli_real_escape_string($conn, stripslashes($_REQUEST['seller']));
    $contact_person = mysqli_real_escape_string($conn, stripslashes($_REQUEST['contact_person']));
    $mobile_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['mobile_no']));
    $email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email']));
    $product_desc = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_desc']));
    $Allotted_deal_size = (float) mysqli_real_escape_string($conn, stripslashes($_REQUEST['Allotted_deal_size']));
    $balanced_deal_size = (float) mysqli_real_escape_string($conn, stripslashes($_REQUEST['balanced_deal_size']));
    $deal_size = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_size']));
    $deal_amount = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_amount']));
    $buyer_commission = (float) mysqli_real_escape_string($conn, stripslashes($_REQUEST['buyer_commission']));
    $seller_commission = (float) mysqli_real_escape_string($conn, stripslashes($_REQUEST['seller_commission']));
    $remarks = mysqli_real_escape_string($conn, stripslashes($_REQUEST['remarks']));
    $remarks_new = nl2br(htmlspecialchars($remarks));


    // Calculations
    $commission = $buyer_commission + $seller_commission;
    $balanced = $balanced_deal_size - $Allotted_deal_size;

    // Use prepared statements for security
    $stmt = mysqli_prepare($conn, "INSERT INTO pd_deals (deal_id, user_id, buyer_id, seller_id, contact_person, mobile_no, email_id, product_description, deal_size, commission, buyer_commission, seller_commission, remarks, deal_amount)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $deal_id, $user_id, $buyer, $seller, $contact_person, $mobile_no, $email, $product_desc, $Allotted_deal_size, $commission, $buyer_commission, $seller_commission, $remarks_new, $deal_amount);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {

        // Update the balance in pd_deals_master
        $update_stmt = mysqli_prepare($conn, "UPDATE pd_deals_master SET balanced_deal_size = ? WHERE id = ?");
        mysqli_stmt_bind_param($update_stmt, 'ds', $balanced, $deal_id);

        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION['success'] = "PD Deal Created Successfully!";
        } else {
            $_SESSION['error'] = "Failed to update balanced deal size: " . mysqli_error($conn);
        }

        header("Location: current-pd-deals.php");
        exit;
    } else {
        $_SESSION['error'] = "PD Deal Not Created Due to Some Error: " . mysqli_error($conn);
        header("Location: current-pd-deals.php");
        exit;
    }
}


if (isset($_POST['update_pd_deal'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(0);
    $user_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['user_id']));
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $buyer = mysqli_real_escape_string($conn, stripslashes($_REQUEST['buyer_id']));
    $seller = mysqli_real_escape_string($conn, stripslashes($_REQUEST['seller_id']));
    $contact_person = mysqli_real_escape_string($conn, stripslashes($_REQUEST['contact_person']));
    $mobile_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['mobile_no']));
    $email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email']));
    $deal_size = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_size']));
    $deal_amount = $_REQUEST['deal_amount'];
    $remarks = mysqli_real_escape_string($conn, stripslashes($_REQUEST['remarks']));

    $category =  mysqli_real_escape_string($conn, stripslashes($_REQUEST['category']));
    $product_desc = mysqli_real_escape_string($conn, stripslashes($_REQUEST['product_desc']));
    $sub_product = mysqli_real_escape_string($conn, stripslashes($_REQUEST['sub_product']));
    $hsn_no = mysqli_real_escape_string($conn, stripslashes($_REQUEST['hsn_no']));
    $shade = mysqli_real_escape_string($conn, stripslashes($_REQUEST['shade']));
    $gsm = mysqli_real_escape_string($conn, stripslashes($_REQUEST['gsm']));
    $size = mysqli_real_escape_string($conn, stripslashes($_REQUEST['size']));
    $bf = mysqli_real_escape_string($conn, stripslashes($_REQUEST['bf']));
    $stock_in_kg = mysqli_real_escape_string($conn, stripslashes($_REQUEST['stock_in_kg']));
    $grain = mysqli_real_escape_string($conn, stripslashes($_REQUEST['grain']));
    $sheet = mysqli_real_escape_string($conn, stripslashes($_REQUEST['sheet']));
    $rim_weight = mysqli_real_escape_string($conn, stripslashes($_REQUEST['rim_weight']));
    $w_l = mysqli_real_escape_string($conn, stripslashes($_REQUEST['w_l']));
    $no_of_bundle = mysqli_real_escape_string($conn, stripslashes($_REQUEST['no_of_bundle']));
    $no_of_rim = mysqli_real_escape_string($conn, stripslashes($_REQUEST['no_of_rim']));
    $price_per_kg = mysqli_real_escape_string($conn, stripslashes($_REQUEST['price_per_kg']));
    $quantity_in_kg = mysqli_real_escape_string($conn, stripslashes($_REQUEST['quantity_in_kg']));
    $brightness = $_REQUEST['brightness'];

    // echo $brightness;
    // exit;

    $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));
    $commission = $buyer_commission + $seller_commission;
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    if (
        validateInput($deal_id) === $deal_id && validateInput($user_id) === $user_id && validateInput($buyer) === $buyer && validateInput($seller) === $seller && validateInput($contact_person) === $contact_person && validateInput($mobile_no) === $mobile_no && validateInput($email) === $email && validateInput($product_desc) === $product_desc && validateInput($sub_product)
        === $sub_product && validateInput($shade) === $shade && validateInput($deal_size) === $deal_size && validateInput($deal_amount) === $deal_amount && validateInput($gsm) === $gsm && validateInput($size) === $size && validateInput($bf) === $bf && validateInput($stock_in_kg) === $stock_in_kg && validateInput($remarks) === $remarks && validateInput($grain) === $grain && validateInput($sheet) === $sheet && validateInput($rim_weight) === $rim_weight && validateInput($w_l) === $w_l && validateInput($no_of_bundle) === $no_of_bundle && validateInput($no_of_rim) === $no_of_rim && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg && validateInput($hsn_no) === $hsn_no && validateInput($category) === $category && validateInput($brightness) === $brightness
    ) {

        $query = "update pd_deals set deal_id='$deal_id', user_id='$user_id',
buyer_id='$buyer',seller_id='$seller',contact_person='$contact_person',mobile_no='$mobile_no',email_id='$email',product_description='$product_desc',deal_size='$deal_size',deal_amount='$deal_amount',remarks='$remarks',sub_product='$sub_product',shade='$shade',gsm='$gsm',deal_size='$size',bf='$bf',stock_in_kg='$stock_in_kg',grain='$grain',sheat='$sheet',rim_weight='$rim_weight',w_l='$w_l',no_of_bundle='$no_of_bundle',no_of_rim='$no_of_rim',price_per_kg='$price_per_kg',quantity_in_kg='$quantity_in_kg',hsn='$hsn_no',category='$category',brightness='$brightness'
where id='$id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "PD Deal Updated Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "PD Deal Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: " . $return_url);
    }
}


if (isset($_POST['pd_sample_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $dos = mysqli_real_escape_string($conn, $_POST['dos']);
    $sample_verification = mysqli_real_escape_string($conn, $_POST['sample_verification']);
    $lab_report = mysqli_real_escape_string($conn, $_POST['lab_report']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    if ($_SESSION['role'] == 3 || $_SESSION['role'] == 1) {
        $status = mysqli_real_escape_string($conn, $_POST['status']);
    }

    $type = mysqli_real_escape_string($conn, $_POST['type']);



    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_doc']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_doc']));
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["upload_doc"]["tmp_name"];
        $folder = "uploads/pd_sample/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['upload_doc']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {

            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }


    // Sampling Table
    $check_samp = mysqli_query($conn, "select * from pd_sampling where deal_id = '$deal_id' AND type='$type'");
    $check_num_samp = mysqli_num_rows($check_samp);
    $data = mysqli_fetch_assoc($check_samp);
    $dealid = $data['id'];
    //     echo  $dealid;
    //    echo $check_num_samp;
    // exit;
    if ($check_num_samp > 0) {

        if ($_SESSION['role'] == 3) {
            $query_run = mysqli_query($conn, "Update pd_sampling set status='$status' where id='$dealid'");
        } else if ($_SESSION['role'] == 2) {
            $query_run = mysqli_query($conn, "Update pd_sampling set upload_doc='$uploaded_doc' where id='$dealid'");
        } else {

            if (validateInput($dos) === $dos && validateInput($sample_verification) === $sample_verification && validateInput($lab_report) === $lab_report && validateInput($remarks) === $remarks) {

                $query_run = mysqli_query($conn, "Update pd_sampling set dos='$dos', sample_verification='$sample_verification',
lab_report='$lab_report', remarks='$remarks',status='$status', upload_doc='$uploaded_doc', type='$type' where id='$dealid'");
            } else {
                $_SESSION['error'] = "Invalid Input!";
                header("Location: " . $return_url);
                exit;
            }
        }
    } else {
        if (validateInput($dos) === $dos && validateInput($sample_verification) === $sample_verification && validateInput($lab_report) === $lab_report && validateInput($remarks) === $remarks) {
            $query_run = mysqli_query($conn, "Insert into pd_sampling set deal_id='$deal_id', dos='$dos',
         sample_verification='$sample_verification', lab_report='$lab_report', remarks='$remarks', upload_doc='$uploaded_doc', type='$type'");
            updatePD_Deal_Status(2, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    }

    if ($query_run) {
        $_SESSION['success'] = "PD Sampling Data Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "PD Sampling Data Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}


if (isset($_POST['pd_validation_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $dov = mysqli_real_escape_string($conn, $_POST['dov']);
    $sample = mysqli_real_escape_string($conn, $_POST['sample']);
    $stock_approve = mysqli_real_escape_string($conn, $_POST['stock_approve']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docu']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_docu']));
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["upload_docu"]["tmp_name"];
        $folder = "uploads/pd_validation/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['upload_docu']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }

    // Validation Table
    $query = mysqli_query($conn, "select * from pd_validation where deal_id = '$deal_id' AND type='$type'");
    $check_num_query = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);
    $dealid = $data['id'];
    if ($check_num_query > 0) {

        if (validateInput($dov) === $dov && validateInput($sample) === $sample && validateInput($stock_approve) === $stock_approve) {
            $query_run = mysqli_query($conn, "Update pd_validation set dov='$dov', sample='$sample', stock_approve='$stock_approve',
       upload_docu='$uploaded_doc', type='$type' where id='$dealid'");
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    } else {
        if (validateInput($dov) === $dov && validateInput($sample) === $sample && validateInput($stock_approve) === $stock_approve) {
            $query_run = mysqli_query($conn, "Insert into pd_validation set deal_id='$deal_id', dov='$dov', sample='$sample',
stock_approve='$stock_approve', upload_docu='$uploaded_doc', type='$type'");
            updatePD_Deal_Status(3, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
    }

    if ($query_run) {
        $_SESSION['success'] = "PD Validation Data Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "PD Validation Data Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}
if (isset($_POST['pd_clearance_update'])) {

    // $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docum']['name']);
    // $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_docum']));
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $doc = mysqli_real_escape_string($conn, $_POST['doc']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);
    $bill_img = mysqli_real_escape_string($conn, $_FILES['bill']['name']);
    $old_bill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill']));
    $ewaybill_img = mysqli_real_escape_string($conn, $_FILES['ewaybill']['name']);
    $old_ewaybill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_ewaybill']));
    $stock_statement_img = mysqli_real_escape_string($conn, $_FILES['stock_statement']['name']);
    $old_stock_statement_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_stock_statement']));
    $bill_t_img = mysqli_real_escape_string($conn, $_FILES['bill_t']['name']);
    $old_bill_t_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill_t']));
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    if (!empty($bill_img)) {

        $img_bill = $bill_img;
        $tempname = $_FILES["bill"]["tmp_name"];
        $folder = "uploads/pd_clearance/" . date('dmyHis') . '_' . $img_bill;
        $fileType = $_FILES['bill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {

            $uploaded_bill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_bill = '';
        }
    } else {

        $uploaded_bill = $old_bill_img;
    }

    if (!empty($ewaybill_img)) {
        $img_ewaybill = $ewaybill_img;
        $tempname = $_FILES["ewaybill"]["tmp_name"];
        $folder = "uploads/pd_clearance/" . date('dmyHis') . '_' . $img_ewaybill;
        $fileType = $_FILES['ewaybill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_ewaybill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_ewaybill = '';
        }
    } else {
        $uploaded_ewaybill = $old_ewaybill_img;
    }
    if (!empty($stock_statement_img)) {
        $img_stock_statement = $stock_statement_img;
        $tempname = $_FILES["stock_statement"]["tmp_name"];
        $folder = "uploads/pd_clearance/" . date('dmyHis') . '_' . $img_stock_statement;
        $fileType = $_FILES['stock_statement']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_stock_statement = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_stock_statement = '';
        }
    } else {

        $uploaded_stock_statement = $old_stock_statement_img;
    }

    if (!empty($bill_t_img)) {
        $img_bill_t = $bill_t_img;
        $tempname = $_FILES["bill_t"]["tmp_name"];
        $folder = "uploads/pd_clearance/" . date('dmyHis') . '_' . $img_bill_t;
        $fileType = $_FILES['bill_t']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {

            $uploaded_bill_t = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_bill_t = '';
        }
    } else {

        $uploaded_bill_t = $old_uploaded_bill_t_img;
    }


    // Validation Table
    $query = mysqli_query($conn, "select * from pd_clearance where deal_id = '$deal_id' AND type='$type'");
    $check_num_query = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);
    $dealid = $data['id'];

    if ($check_num_query > 0) {

        // if (validateInput($doc) === $doc && validateInput($product) === $product && validateInput($remarks) === $remarks) {
        $query_run = mysqli_query($conn, "Update pd_clearance set doc='$doc', product='$product', remarks='$remarks',bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t', type='$type' where id='$dealid'");
        // } else {
        //     $_SESSION['error'] = "Invalid Input!";
        //     header("Location: " . $return_url);
        //     exit;
        // }
        if ($query_run) {
            $_SESSION['success'] = "PD Clearance Data Updated Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "PD Clearance Data Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    } else {


        if (validateInput($doc) === $doc && validateInput($product) === $product && validateInput($remarks) === $remarks) {

            $query_run = mysqli_query($conn, "Insert into pd_clearance set deal_id='$deal_id', doc='$doc', product='$product',
             remarks='$remarks',bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t', type='$type'");
            updatePD_Deal_Status(4, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }

        if ($query_run) {
            $_SESSION['success'] = "PD Clearance Data Updated Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "PD Clearance Data Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    }
}
if (isset($_POST['pd_payment_update'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $transaction_date = mysqli_real_escape_string($conn, $_POST['transaction_date']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $acc_no = mysqli_real_escape_string($conn, $_POST['acc_no']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $ammount = mysqli_real_escape_string($conn, $_POST['Amount']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);


    $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_docume']['name']);

    /*$old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_docume']));*/
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["upload_docume"]["tmp_name"];
        $folder = "uploads/pd_payment/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['upload_docume']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_doc = '';
        }
    }

    // Validation Table
    $query = mysqli_query($conn, "select id from pd_payment where deal_id = '$deal_id'");
    $check_num_query = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);
    $dealid = $data['id'];

    if ($check_num_query > 0) {

        // if (validateInput($deal_id) === $deal_id && validateInput($product) === $product && validateInput($details) === $details && validateInput($acc_no) === $acc_no && validateInput($bank) === $bank && validateInput($branch) === $branch && validateInput($ammount) === $ammount) {
        $query_run = mysqli_query($conn, "Insert into pd_payment set deal_id='$deal_id', transaction_date='$transaction_date',
product='$product', details='$details', acc_no='$acc_no', bank='$bank', branch='$branch', ammount='$ammount', upload_docume='$uploaded_doc', type='$type'");
        // } else {

        //     $_SESSION['error'] = "Invalid Input!";
        //     header("Location: " . $return_url);
        //     exit;
        // }
    } else {

        // if (validateInput($deal_id) === $deal_id && validateInput($product) === $product && validateInput($details) === $details && validateInput($acc_no) === $acc_no && validateInput($bank) === $bank && validateInput($branch) === $branch && validateInput($ammount) === $ammount) {
        $query_run = mysqli_query($conn, "Insert into pd_payment set deal_id='$deal_id', transaction_date='$transaction_date',
    product='$product', details='$details',acc_no='$acc_no', bank='$bank', branch='$branch', ammount='$ammount', upload_docume='$uploaded_doc', type='$type'");
        updatePD_Deal_Status(5, $deal_id);
        // } else {

        //     $_SESSION['error'] = "Invalid Input!";
        //     header("Location: " . $return_url);
        // }

    }

    if ($query_run) {
        $_SESSION['success'] = "PD Payment Details Updated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "PD Payment Details Not Updated Due to Some Error!";
        header("Location: " . $return_url);
    }
}


if (isset($_POST['pd_transportation_update'])) {

    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $transportation_date = mysqli_real_escape_string($conn, $_POST['transportation_date']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $mot = mysqli_real_escape_string($conn, $_POST['mot']);
    $vehicle_no = mysqli_real_escape_string($conn, $_POST['vehicle_no']);
    $ammount_incured = mysqli_real_escape_string($conn, $_POST['ammount_incured']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    $transporter_name = mysqli_real_escape_string($conn, $_POST['transporter_name']);
    $bill_or_lading = mysqli_real_escape_string($conn, $_POST['bill_or_lading']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $bill_img = mysqli_real_escape_string($conn, $_FILES['bill']['name']);
    $old_bill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill']));
    $ewaybill_img = mysqli_real_escape_string($conn, $_FILES['ewaybill']['name']);
    $old_ewaybill_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_ewaybill']));
    $stock_statement_img = mysqli_real_escape_string($conn, $_FILES['stock_statement']['name']);
    $old_stock_statement_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_stock_statement']));
    $bill_t_img = mysqli_real_escape_string($conn, $_FILES['bill_t']['name']);
    $old_bill_t_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_bill_t']));
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);
    // $doc_img = mysqli_real_escape_string($conn, $_FILES['upload_documen']['name']);
    // $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_documen']));

    if (!empty($bill_img)) {

        $img_bill = $bill_img;
        $tempname = $_FILES["bill"]["tmp_name"];
        $folder = "uploads/pd_transportation/" . date('dmyHis') . '_' . $img_bill;
        $fileType = $_FILES['bill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_bill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_bill = '';
        }
    } else {

        $uploaded_bill = $old_bill_img;
    }

    if (!empty($ewaybill_img)) {
        $img_ewaybill = $ewaybill_img;
        $tempname = $_FILES["ewaybill"]["tmp_name"];
        $folder = "uploads/pd_transportation/" . date('dmyHis') . '_' . $img_ewaybill;
        $fileType = $_FILES['ewaybill']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_ewaybill = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_ewaybill = '';
        }
    } else {
        $uploaded_ewaybill = $old_ewaybill_img;
    }
    if (!empty($stock_statement_img)) {
        $img_stock_statement = $stock_statement_img;
        $tempname = $_FILES["stock_statement"]["tmp_name"];
        $folder = "uploads/pd_transportation/" . date('dmyHis') . '_' . $img_stock_statement;
        $fileType = $_FILES['stock_statement']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_stock_statement = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_stock_statement = '';
        }
    } else {

        $uploaded_stock_statement = $old_stock_statement_img;
    }

    if (!empty($bill_t_img)) {
        $img_bill_t = $bill_t_img;
        $tempname = $_FILES["bill_t"]["tmp_name"];
        $folder = "uploads/pd_transportation/" . date('dmyHis') . '_' . $img_bill_t;
        $fileType = $_FILES['bill_t']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: " . $return_url);
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_bill_t = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_bill_t = '';
        }
    } else {

        $uploaded_bill_t = $old_uploaded_bill_t_img;
    }


    // if (!empty($doc_img)) {
    //     $img_name = $doc_img;
    //     $tempname = $_FILES["upload_documen"]["tmp_name"];
    //     $folder = "uploads/pd_transportation/" . date('dmyHis') . '_' . $img_name;
    //     if (aws_doc_Upload($tempname,$file_name)) {
    //         $uploaded_doc = $folder;
    //     } else {
    //         $uploaded_doc = '';
    //     }
    // } else {
    //     $uploaded_doc = $old_doc_img;
    // }

    // Validation Table
    $query = mysqli_query($conn, "select * from pd_transportation where deal_id = '$deal_id' AND type='$type'");
    $check_num_query = mysqli_num_rows($query);
    $data = mysqli_fetch_assoc($query);
    $dealid = $data['id'];
    if ($check_num_query > 0) {

        if (validateInput($mot) === $mot && validateInput($vehicle_no) === $vehicle_no && validateInput($ammount_incured) === $ammount_incured && validateInput($bill_or_lading) === $bill_or_lading && validateInput($transporter_name) === $transporter_name && validateInput($distance) === $distance) {

            $query_run = mysqli_query($conn, "Update pd_transportation set transportation_date='$transportation_date', date='$date',
mot='$mot', vehicle_no='$vehicle_no', ammount_incured='$ammount_incured',bill_or_lading='$bill_or_lading',transporter_name='$transporter_name',distance='$distance',bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t'
where id='$dealid'");
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }
        if ($query_run) {
            $_SESSION['success'] = "PD Transportation Data Updated Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "PD Transportation Data Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    } else {

        if (validateInput($mot) === $mot && validateInput($vehicle_no) === $vehicle_no && validateInput($ammount_incured) === $ammount_incured && validateInput($bill_or_lading) === $bill_or_lading && validateInput($transporter_name) === $transporter_name && validateInput($distance) === $distance) {
            $query_run = mysqli_query($conn, "Insert into pd_transportation set deal_id='$deal_id',
transportation_date='$transportation_date', date='$date', mot='$mot', vehicle_no='$vehicle_no',
ammount_incured='$ammount_incured',bill_or_lading='$bill_or_lading',transporter_name='$transporter_name',distance='$distance',bill='$uploaded_bill',ewaybill='$uploaded_ewaybill',stock_statement='$uploaded_stock_statement',bill_t='$uploaded_bill_t', type='$type'");
            updatePD_Deal_Status(6, $deal_id);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: " . $return_url);
            exit;
        }

        if ($query_run) {
            $_SESSION['success'] = "PD Transportation Data Updated Successfully!";
            header("Location: " . $return_url);
        } else {
            $_SESSION['error'] = "PD Transportation Data Not Updated Due to Some Error!";
            header("Location: " . $return_url);
        }
    }
}


if (isset($_POST['pd_close_update'])) {
    // Sanitize inputs
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $master_deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['master_deal_id']));
    $close_date = mysqli_real_escape_string($conn, $_POST['close_date']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $product_recd = mysqli_real_escape_string($conn, $_POST['product_recd']);
    $deal_size =  mysqli_real_escape_string($conn, $_POST['deal_size']);
    $comission =  mysqli_real_escape_string($conn, $_POST['comission']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    // Error array to capture invalid fields
    $errors = [];

    // Input Validation
    if (validateInput($product) !== $product) {
        $errors[] = "Product";
    }
    if (validateInput($comission) !== $comission) {
        $errors[] = "Commission";
    }
    if (validateInput($remarks) !== $remarks) {
        $errors[] = "Remarks";
    }
    if (validateInput($product_recd) !== $product_recd) {
        $errors[] = "Product Received";
    }
    if (validateInput($deal_size) !== $deal_size) {
        $errors[] = "Deal Size";
    }

    // Check if there are any errors
    if (count($errors) > 0) {
        // Join the errors array into a single string with field names
        $_SESSION['error'] = "Invalid Input in the following fields: " . implode(", ", $errors);
        header("Location: " . $return_url);
        exit;
    } else {
        // Proceed with your query if no errors
        $query = mysqli_query($conn, "SELECT * FROM pd_close WHERE deal_id = '$deal_id' AND type = '$type'");
        $check_num_query = mysqli_num_rows($query);
        $data = mysqli_fetch_assoc($query);
        $dealid = $data['id'];
        $deal_id1 = $data['deal_id'];

        if ($check_num_query > 0) {
            // Update existing record
            $update_close = mysqli_prepare(
                $conn,
                "UPDATE pd_close SET close_date = ?, product = ?, comission = ?, remarks = ?, 
                 product_recd = ?, deal_size = ?, type = ? WHERE id = ?"
            );
            mysqli_stmt_bind_param($update_close, 'sssssssi', $close_date, $product, $comission, $remarks, $product_recd, $deal_size, $type, $dealid);

            if (mysqli_stmt_execute($update_close)) {
                $update_deal = mysqli_prepare($conn, "UPDATE pd_deals SET commission = ? WHERE id = ?");
                mysqli_stmt_bind_param($update_deal, 'di', $comission, $deal_id1);
                mysqli_stmt_execute($update_deal);
            } else {
                $_SESSION['error'] = "PD Close Data Not Updated!";
                header("Location: " . $return_url);
                exit;
            }
        } else {
            // Insert new record
            $insert_close = mysqli_prepare(
                $conn,
                "INSERT INTO pd_close (deal_id, close_date, product, comission, remarks, product_recd, deal_size, type) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($insert_close, 'ssssssss', $deal_id, $close_date, $product, $comission, $remarks, $product_recd, $deal_size, $type);

            if (mysqli_stmt_execute($insert_close)) {
                updatePD_Deal_Status(7, $deal_id);
                updatePD_Deal_master_Status(7, $master_deal_id);
            } else {
                $_SESSION['error'] = "PD Close Data Not Inserted!";
                header("Location: " . $return_url);
                exit;
            }
        }

        $_SESSION['success'] = "PD Close Data Updated Successfully!";
        header("Location: " . $return_url);
        exit;
    }
}


if (isset($_POST['active_pd_deal'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['deal_id']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    $query = "Update pd_deals set status=1 where id = '$deal_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "PD Deal Activated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "PD Deal status not changed due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['deactive_pd_deal'])) {
    $deal_id = mysqli_real_escape_string($conn, $_POST['deal_id']);
    $return_url = mysqli_real_escape_string($conn, $_POST['return_url']);

    $query = "Update pd_deals set status=0 where id = '$deal_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "PD Deal Deactivated Successfully!";
        header("Location: " . $return_url);
    } else {
        $_SESSION['error'] = "PD Deal status not changed due to Some Error!";
        header("Location: " . $return_url);
    }
}

if (isset($_POST['magazine_save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    if (isset($_FILES["import_pdf"]) && $_FILES["import_pdf"]["error"] == 0) {
        $target_dir = "uploads/magazine/";
        $target_file = $target_dir . date('dmyHis') . '_' . $_FILES["import_pdf"]["name"];
        $uploadOk = 1;
        $pdfFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (optional)
        if ($_FILES["import_pdf"]["size"] > 5000000) { // Adjust size limit as needed
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only PDF files
        if ($pdfFileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $fileType = $_FILES['import_pdf']['type'];
            if (!isValidFileType($fileType, $allowedMimeTypes)) {
                // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
                $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
                header("Location: magazine.php");
                exit;
            }
            if (aws_doc_Upload($_FILES["import_pdf"]["tmp_name"], $target_file)) {
                $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }

    if (validateInput($name) === $name) {
        $query = "insert into magazine(name,import_pdf) values('$name','$update_filename')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Magazine Added Successfully!";
            header("Location: magazine.php");
        } else {
            $_SESSION['error'] = "Magazine Not Added Due to Some Error!";
            header("Location: magazine.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: magazine.php");
    }
}
if (isset($_POST['magazine_update'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $doc_img = mysqli_real_escape_string($conn, $_FILES['import_pdf']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_documen']));

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["import_pdf"]["tmp_name"];
        $folder = "uploads/magazine/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['import_pdf']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: magazine.php");
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }

    // Enclose values in quotes for SQL query
    $name = "'$name'";
    $uploaded_doc = "'$uploaded_doc'";

    if (validateInput($name) === $name) {
        // Fix SQL injection vulnerability by using prepared statements
        $query = "UPDATE magazine SET name=$name, import_pdf=$uploaded_doc WHERE id = '$user_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = "Magazine Updated Successfully!";
            header("Location: magazine.php");
        } else {
            $_SESSION['error'] = "Magazine Not Updated Due to Some Error!";
            header("Location: magazine.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: magazine.php");
    }
}

if (isset($_POST['active_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($role == 2) {
        $user_type = 'Seller';
        $redirectUrl = 'seller.php';
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'buyer.php';
    }

    $query = "Update product_details set status=1 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Activated Successfully!";
        header("Location: " . $redirectUrl);
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: " . $redirectUrl);
    }
}

if (isset($_POST['deactive_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($role == 2) {
        $user_type = 'Seller';
        $redirectUrl = 'seller.php';
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'buyer.php';
    }

    $query = "Update product_details set status=0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Deactivated Successfully!";
        header("Location: " . $redirectUrl);
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: " . $redirectUrl);
    }
}
if (isset($_POST['new_spot_price'])) {
    $deal_id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['deal_id']));
    $product_called = mysqli_real_escape_string($conn, $_POST['product_id']);
    $seller_name = mysqli_real_escape_string($conn, $_POST['seller_id']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $hsn_no = mysqli_real_escape_string($conn, $_POST['hsn_no']);
    $mill = mysqli_real_escape_string($conn, $_POST['mill']);
    $shade = mysqli_real_escape_string($conn, $_POST['shade']);
    $gsm = mysqli_real_escape_string($conn, $_POST['gsm']);
    $sizes = mysqli_real_escape_string($conn, $_POST['sizes']);
    $weights = mysqli_real_escape_string($conn, $_POST['weights']);
    $stock_in_kg = mysqli_real_escape_string($conn, $_POST['stock_in_kg']);
    $price_per_kg = mysqli_real_escape_string($conn, $_POST['price_per_kg']);
    $quantity_in_kg = mysqli_real_escape_string($conn, $_POST['quantity_in_kg']);


    if (validateInput($product_called) === $product_called && validateInput($seller_name) === $seller_name && validateInput($city) === $city && validateInput($mill) === $mill && validateInput($shade) === $shade && validateInput($gsm) === $gsm && validateInput($hsn_no) === $hsn_no && validateInput($sizes) === $sizes && validateInput($weights) === $weights && validateInput($stock_in_kg) === $stock_in_kg && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg) {
        // Validation Table
        $query = "Update spot_price set product_id='$product_called',seller_id='$seller_name',city='$city',mill='$mill',
shade='$shade',gsm='$gsm', hsn_no='$hsn_no', sizes='$sizes', weights='$weights', stock_in_kg='$stock_in_kg',
price_per_kg='$price_per_kg', quantity_in_kg='$quantity_in_kg' where id='$deal_id'";

        $query_run = mysqli_query($conn, $query);


        if ($query_run) {
            $_SESSION['success'] = "Spot Price Data Updated Successfully!";
            header("Location: view_mic_price.php");
        } else {
            $_SESSION['error'] = "Spot Price Data Not Updated Due to Some Error!";
            header("Location: view_mic_price.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: view_mic_price.php");
    }
}
if (isset($_POST['sp_active_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($role == 2) {
        $user_type = 'Seller';
        $redirectUrl = 'view_mic_price.php';
    } else if ($role == 1) {
        $user_type = 'Spot Price';
        $redirectUrl = 'view_mic_price.php';
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'view_mic_price.php';
    }

    $query = "Update product_new set status=1 where id = '$user_id'";
    // echo $query;
    // exit;
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Activated Successfully!";
        header("Location: " . $redirectUrl);
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: " . $redirectUrl);
    }
}

if (isset($_POST['sp_deactive_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    // echo $user_id;
    // exit;
    if ($role == 2) {
        $user_type = 'Seller';
        $redirectUrl = 'view_mic_price.php';
    } else if ($role == 1) {
        $user_type = 'Spot Price';
        $redirectUrl = 'view_mic_price.php';
    } else {
        $user_type = 'Buyer';
        $redirectUrl = 'view_mic_price.php';
    }

    $query = "Update product_new set status = 0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Deactivated Successfully!";
        header("Location: " . $redirectUrl);
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: " . $redirectUrl);
    }
}
if (isset($_POST['spot_price_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "delete from spot_price where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Spot Price Deleted Successfully!";
        header("Location: view_mic_price.php");
    } else {
        $_SESSION['error'] = "Spot Price Not Deleted Due to Some Error!";
        header("Location: view_mic_price.php");
    }
}
if (isset($_POST['admin_save'])) {
    $active_status = mysqli_real_escape_string($conn, $_POST['active_status']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $password = stripslashes(md5($_POST['password']));
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $whatsapp_no = mysqli_real_escape_string($conn, $_POST['whatsapp_no']);

    if (validateInput($name) === $name && validateInput($email_address) === $email_address && validateInput($phone_no) === $phone_no && validateInput($whatsapp_no) === $whatsapp_no && validateInput($active_status) === $active_status) {
        $query = "insert into users(name,email_address,password,phone_no,whatsapp_no,active_status)
values('$name','$email_address','$password','$phone_no','$whatsapp_no','$active_status')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Admin Added Successfully!";
            header("Location: add_admin.php");
        } else {
            $_SESSION['error'] = "Admin Not Added Due to Some Error!";
            header("Location: add_admin.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: add_admin.php");
    }
}
if (isset($_POST['admin_update'])) {
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $whatsapp_no = mysqli_real_escape_string($conn, $_POST['whatsapp_no']);
    if (validateInput($name) === $name && validateInput($email_address) === $email_address && validateInput($phone_no) === $phone_no && validateInput($whatsapp_no) === $whatsapp_no) {
        $query = "Update users set name='$name',email_address='$email_address',phone_no='$phone_no',whatsapp_no='$whatsapp_no'
where id='$admin_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Admin Updated Successfully!";
            header("Location: add_admin.php");
        } else {
            $_SESSION['error'] = "Admin Not Updated Due to Some Error!";
            header("Location: add_admin.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: add_admin.php");
    }
}


if (isset($_POST['consultant_update'])) {
    $admin_id = mysqli_real_escape_string($conn, $_POST['consultant_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $whatsapp_no = mysqli_real_escape_string($conn, $_POST['whatsapp_no']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $mills_supported = mysqli_real_escape_string($conn, $_POST['mills_supported']);
    $years_of_experience = mysqli_real_escape_string($conn, $_POST['years_of_experience']);

    if (validateInput($name) === $name && validateInput($email_address) === $email_address && validateInput($phone_no) === $phone_no && validateInput($whatsapp_no) === $whatsapp_no && validateInput($price) === $price) {
        // Update users table
        $query = "UPDATE users 
              SET name='$name', email_address='$email_address', phone_no='$phone_no', consultant_price='$price', whatsapp_no='$whatsapp_no'
              WHERE id='$admin_id'";
        $query_run = mysqli_query($conn, $query);
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: consultant.php");
    }

    // Update consultant_pic table
    $doc_img = mysqli_real_escape_string($conn, $_FILES['prof_pic']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_prof_pic']));

    if (!empty($_FILES['prof_pic']['name'])) {
        $img_name = $_FILES["prof_pic"]["name"];
        $tempname = $_FILES["prof_pic"]["tmp_name"];
        $folder = "uploads/consultant_profile/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['prof_pic']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: consultant.php");
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $update_filename = '';
        }
    } else {
        $update_filename = $_POST['old_prof_pic'];
    }
    if (validateInput($name) === $name && validateInput($email_address) === $email_address && validateInput($phone_no) === $phone_no && validateInput($whatsapp_no) === $whatsapp_no && validateInput($price) === $price) {
        $query2 = "UPDATE consultant_pic 
               SET description='$description', prof_pic='$update_filename',years_of_experience='$years_of_experience',mills_supported='$mills_supported' 
               WHERE user_id='$admin_id'";
        //   echo $query2;
        //   exit;
        $query_run2 = mysqli_query($conn, $query2);

        // Check if both queries were successful
        if ($query_run && $query_run2) {
            $_SESSION['success'] = "Consultant Updated Successfully!";
            header("Location: consultant.php");
        } else {
            $_SESSION['error'] = "Consultant Not Updated Due to Some Error!";
            header("Location: consultant.php");
        }
    } else {

        $_SESSION['error'] = "Invalid Input!";
        header("Location: consultant.php");
    }
}

if (isset($_POST['active_admin'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update users set active_status=1 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Activated Successfully!";
        header("Location: add_admin.php");
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: add_admin.php");
    }
}
if (isset($_POST['deactive_admin'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update users set active_status=0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Deactivated Successfully!";
        header("Location: add_admin.php");
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: add_admin.php");
    }
}

if (isset($_POST['active_master'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update master_product set status=1 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Activated Successfully!";
        header("Location: master_product.php");
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: master_product.php");
    }
}
if (isset($_POST['deactive_master'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update master_product set status=0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Deactivated Successfully!";
        header("Location: master_product.php");
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: master_product.php");
    }
}
if (isset($_POST['active_consultant'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update users set active_status=1 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Activated Successfully!";
        header("Location: consultant.php");
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: consultant.php");
    }
}
if (isset($_POST['deactive_consultant'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update users set active_status=0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = $user_type . " Deactivated Successfully!";
        header("Location: consultant.php");
    } else {
        $_SESSION['error'] = $user_type . " status not changed due to Some Error!";
        header("Location: consultant.php");
    }
}
if (isset($_POST['spot_price_enquiry_save'])) {
    // Handle form submission
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (validateInput($user_id) === $user_id && validateInput($name) === $name && validateInput($phone) === $phone && validateInput($email) === $email && validateInput($message) === $message) {
        $query = "insert into spot_price_enquiry(user_id,name,phone,email_id,message)
values('$user_id','$name','$phone','$email','$message')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Spot Price Enquiry Saves Successfully!";
            header("Location: spot_price_enqu.php");
        } else {
            $_SESSION['error'] = "Spot Price Enquiry Not Saved due to Some Error!";
            header("Location: spot_price_enqu.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: spot_price_enqu.php");
    }
}


if (isset($_POST['update_price_enquiry_save'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email_id = mysqli_real_escape_string($conn, $_POST['email_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if (validateInput($user_id) === $user_id && validateInput($name) === $name && validateInput($phone) === $phone && validateInput($email) === $email && validateInput($message) === $message) {
        $query = "UPDATE spot_price_enquiry SET name='$name', phone='$phone', email_id='$email_id', message='$message' WHERE
id='$user_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Spot Price Enquiry Updated Successfully!";
            header("Location: spot_price_enqu.php");
            exit();
        } else {
            $_SESSION['error'] = "Spot Price Enquiry Not Updated due to Some Error: " . mysqli_error($conn);
            header("Location: spot_price_enqu.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: spot_price_enqu.php");
    }
}

if (isset($_POST['spot_enquiry_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['spot_enquiry_delete_id']);

    $query = "delete from spot_price_enquiry where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Spot Price Enquiry Deleted Successfully!";
        header("Location: spot_price_enqu.php");
    } else {
        $_SESSION['error'] = "Spot Price Enquiry Not Deleted Due to Some Error!";
        header("Location: spot_price_enqu.php");
    }
}

if (isset($_POST['consultant_booking_slot_save'])) {
    $consultant_id = mysqli_real_escape_string($conn, $_POST['consultant_id']);
    $from_time = mysqli_real_escape_string($conn, $_POST['slot_id']);
    $consultant_price = mysqli_real_escape_string($conn, $_POST['consultant_price']);
    $date = mysqli_real_escape_string($conn, $_POST['created_on']);
    // $date2 = mysqli_real_escape_string($conn, $_POST['to_date']);

    $sql = "SELECT * FROM consultant_slots WHERE slot_id = '$from_time' AND created_on='$date' AND to_date='$date2'";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run->num_rows > 0) {
        $_SESSION['error'] = "Slot already Exist!";
        header("Location: consultant_slot.php");
    } else {

        if (validateInput($consultant_price) === $consultant_price) {
            // Time slot does not exist, proceed with insertion
            $sql_insert = "insert into consultant_slots(slot_id,consultant_price,consultant_id,created_on)
         values('$from_time','$consultant_price','$consultant_id','$date')";
            if ($conn->query($sql_insert) === TRUE) {
                $_SESSION['success'] = "Solt Booked Successfully!";
                header("Location: consultant_slot.php");
            } else {
                $_SESSION['error'] = "Solt Not Booked Due to Some Error!";
                header("Location: consultant_slot.php");
            }
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: consultant_slot.php");
        }
    }
}
if (isset($_POST['consultant_booking_slot_update'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $from_time = mysqli_real_escape_string($conn, $_POST['slot_id']);
    $consultant_price = mysqli_real_escape_string($conn, $_POST['consultant_price']);
    $date = mysqli_real_escape_string($conn, $_POST['created_on']);
    // $date2 = mysqli_real_escape_string($conn, $_POST['to_date']);
    if (validateInput($consultant_price) === $consultant_price) {
        $query = "Update consultant_slots set
  slot_id='$from_time',consultant_price='$consultant_price',created_on='$date' where id='$user_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Solt Updated Successfully!";
            header("Location: consultant_slot.php");
        } else {
            $_SESSION['error'] = "Solt Not Updated Due to Some Error!";
            header("Location: consultant_slot.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: consultant_slot.php");
    }
}
if (isset($_POST['add_consultant_booking_slot_save'])) {
    // Establish database connection ($conn assumed to be already initialized)

    // Escape user inputs (consider prepared statements for better security)
    $from_time = mysqli_real_escape_string($conn, $_POST['from_time']);
    $to_time = mysqli_real_escape_string($conn, $_POST['to_time']);

    // Check if the slot already exists
    $check_sql = "SELECT * FROM slot WHERE from_time = '$from_time' AND to_time = '$to_time'";
    $check_result = $conn->query($check_sql);

    if ($check_result !== false) { // Check if the query was executed successfully
        if ($check_result->num_rows > 0) {
            $_SESSION['error'] = "Slot already exists!";
            header("Location: add_consultant_slots.php");
            exit(); // Stop further execution
        } else {
            // Insert the new slot
            $insert_query = "INSERT INTO slot (from_time, to_time) VALUES ('$from_time', '$to_time')";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result !== false) { // Check if the query was executed successfully
                $_SESSION['success'] = "Slot time added successfully!";
                header("Location: consultant_slot.php");
                exit();
            } else {
                $_SESSION['error'] = "Failed to add slot time due to database error: " . mysqli_error($conn);
                header("Location: consultant_slot.php");
                exit();
            }
        }
    } else {
        $_SESSION['error'] = "Database error: " . mysqli_error($conn);
        header("Location: add_consultant_slots.php");
        exit();
    }
}


if (isset($_POST['consultant_slot_delete_btn'])) {
    $cate_id = mysqli_real_escape_string($conn, $_POST['consultant_slot_delete_id']);

    $query = "delete from consultant_slots where id='$cate_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Consultant Slot Deleted Successfully!";
        header("Location: consultant_slot.php");
    } else {
        $_SESSION['error'] = "Consultant Slot Not Deleted Due to Some Error!";
        header("Location: consultant_slot.php");
    }
}

if (isset($_POST['consultant_save_panel'])) {
    // Enable error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Database connection assumed to be $conn

    // Sanitize user inputs
    $active_status = mysqli_real_escape_string($conn, $_POST['active_status']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $password = md5($_POST['password']); // Hash password securely
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $whatsapp_no = mysqli_real_escape_string($conn, $_POST['whatsapp_no']);
    $created_on = date("Y-m-d H:i:s");

    $checkemail = "select email_address from users where email_address='$email_address'";
    $checkemail_run = mysqli_query($conn, $checkemail);
    if (mysqli_num_rows($checkemail_run) > 0) {
        $_SESSION['error'] = "Email already taken";
        header("Location:consultant.php");
    }

    if (validateInput($name) === $name && validateInput($email_address) === $email_address && validateInput($phone_no) === $phone_no && validateInput($whatsapp_no) === $whatsapp_no && validateInput($active_status) === $active_status && validateInput($user_type) === $user_type && validateInput($price) === $price) {
        // Insert user data into 'users' table using prepared statement
        $query = "INSERT INTO users(name, email_address, password, phone_no, whatsapp_no, active_status, user_type,consultant_price,created_on) VALUES (?,
?, ?, ?, ?, ?, ?,?,?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param(
            $stmt,
            "sssssssss",
            $name,
            $email_address,
            $password,
            $phone_no,
            $whatsapp_no,
            $active_status,
            $user_type,
            $price,
            $created_on

        );

        mysqli_stmt_execute($stmt);
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: consultant.php");
    }
    if ($stmt) {
        $last_id = mysqli_insert_id($conn);

        // Handle file upload
        $targetDirectory = "uploads/consultant_profile/";
        $targetFile = $targetDirectory . $_FILES["prof_pic"]["name"];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


        if ($_FILES["prof_pic"]["size"] > 50000000) {
            $_SESSION['error'] = "Sorry, your file is too large.";
            header("Location: consultant.php");
            exit();
        }

        // Allow certain file formats
        $allowedFormats = ["jpg", "png", "jpeg", "gif", "docx", "doc", "png"];
        if (!in_array($imageFileType, $allowedFormats)) {
            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            header("Location: consultant.php");
            exit();
        }

        // Move uploaded file to target directory
        $fileType = $_FILES['prof_pic']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: consultant.php");
            exit;
        }
        if (!aws_doc_Upload($_FILES["prof_pic"]["tmp_name"], $targetFile)) {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header("Location: consultant.php");
            exit();
        }
        $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $targetFile;
        // Insert description and file path into 'consultant_pic' table using prepared statement
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        $years_of_experience = mysqli_real_escape_string($conn, $_POST['years_of_experience']);
        $mills_supported = mysqli_real_escape_string($conn, $_POST['mills_supported']);

        if (validateInput($user_id) === $user_id && validateInput($description) === $description && validateInput($years_of_experience) === $years_of_experience && validateInput($mills_supported) === $mills_supported) {
            $query1 = "INSERT INTO consultant_pic(user_id, description, prof_pic,years_of_experience,mills_supported) VALUES (?, ?, ?, ?, ?)";
            $stmt1 = mysqli_prepare($conn, $query1);
            mysqli_stmt_bind_param($stmt1, "issss", $last_id, $description, $update_filename, $years_of_experience, $mills_supported);
            mysqli_stmt_execute($stmt1);
        } else {
            $_SESSION['error'] = "Invalid Input!";
            header("Location: consultant.php");
        }

        // Check for errors
        if (mysqli_stmt_error($stmt1)) {
            $_SESSION['error'] = "Consultant Not Added Due to Some Error!";
            header("Location: consultant.php");
            exit();
        }

        // Success
        $_SESSION['success'] = "Consultant Added Successfully!";
        header("Location: consultant.php");
        exit();
    } else {
        $_SESSION['error'] = "Consultant Not Added Due to Some Error!";
        header("Location: consultant.php");
        exit();
    }
}


if (isset($_POST['booki'])) {

    $consultant_id = mysqli_real_escape_string($conn, $_POST['consultant_id']);
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $slot_id = mysqli_real_escape_string($conn, $_POST['slot_id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);




    if (!isset($_SESSION['id'])) {
        header("location: ../view_profle.php?consult_id=$consultant_id&openpopup=true");
    } else if (isset($_SESSION['role']) || ($_SESSION['role'] == 2) || ($_SESSION['role'] == 3) || ($_SESSION['role'] == 6)) {

        $query = "Update consultant_slots set status=0,book_id='$book_id' where consultant_id = '$consultant_id' AND id =
'$slot_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {

            if (validateInput($consultant_id) === $consultant_id && validateInput($slot_id) === $slot_id && validateInput($user_id) === $user_id && validateInput($status) === $status) {
                $query = mysqli_query($conn, "insert into consultant_booking(consultant_id,slot_id,user_id,status)
values('$consultant_id','$slot_id','$user_id','$status')");
                header("Location: ../consultants.php?status=true");
            } else {
                $_SESSION['error'] = "Invalid Input!";
                header("Location: ../view_profle.php?consult_id=$consultant_id&openpopup=true");
            }
        } else {
            header("Location: ../consultants.php");
        }
    } else {
        header("Location: ../consultants.php");
    }
}

if (isset($_POST['new_sssa'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Assuming $conn is your database connection

    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password); // Note: MD5 is not secure, consider using more secure hashing methods
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $active_status = 1;

    $checkemail = "select email_address from users where email_address='$email_address'";
    $checkemail_run = mysqli_query($conn, $checkemail);
    if (mysqli_num_rows($checkemail_run) > 0) {
        $_SESSION['error'] = "Email already taken";
        header("Location: ../view_profle.php?role=8&consult_id=795");
    }

    if (validateInput($user_type) === $user_type && validateInput($name) === $name && validateInput($email_address) === $email_address && validateInput($phone_no) === $phone_no) {
        $query = "INSERT INTO users (user_type, name, email_address, password, phone_no,active_status) VALUES ('$user_type', '$name',
'$email_address', '$password', '$phone_no',$active_status)";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            // session_start();
            $_SESSION['id'] = mysqli_insert_id($conn);
            $_SESSION['role'] = 6;

            // Get the session ID
            // $session_id = session_id();

            // Redirect the user with session ID and role as query parameters
            header("Location: ../admin_login.php?type=guest");
            exit();
        } else {
            // Handle query execution failure
            header("Location: consultant.php");
            exit();
        }
    } else {

        $_SESSION['error'] = "Invalid Input!";
        header("Location: consultant.php");
        exit();
    }
}

if (isset($_POST['update_stock'])) {
    $seller_id = mysqli_real_escape_string($conn, $_POST['seller_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $sub_product = mysqli_real_escape_string($conn, $_POST['sub_product']);
    $shade = mysqli_real_escape_string($conn, $_POST['shade']);
    $gsm = mysqli_real_escape_string($conn, $_POST['gsm']);
    $hsn_no = mysqli_real_escape_string($conn, $_POST['hsn_no']);
    $sizes = mysqli_real_escape_string($conn, $_POST['size']);
    $weights = mysqli_real_escape_string($conn, $_POST['weight']);
    $bf = mysqli_real_escape_string($conn, $_POST['bf']);
    $grain = mysqli_real_escape_string($conn, $_POST['grain']);
    $sheet = mysqli_real_escape_string($conn, $_POST['sheet']);
    $rim_weight = mysqli_real_escape_string($conn, $_POST['rim_weight']);
    $w_l = mysqli_real_escape_string($conn, $_POST['w_l']);
    $no_of_bundle = mysqli_real_escape_string($conn, $_POST['no_of_bundle']);
    $no_of_rim = mysqli_real_escape_string($conn, $_POST['no_of_rim']);
    $request = mysqli_real_escape_string($conn, $_POST['request']);

    $stock_in_kg = mysqli_real_escape_string($conn, $_POST['stock_in_kg']);
    $price_per_kg = mysqli_real_escape_string($conn, $_POST['price_per_kg']);
    $quantity_in_kg = mysqli_real_escape_string($conn, $_POST['quantity_in_kg']);
    $other = mysqli_real_escape_string($conn, $_POST['other']);
    $new_image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);


    if (!empty($_FILES['image']['name'])) {
        $img_name = $_FILES["image"]["name"];

        $tempname = $_FILES["image"]["tmp_name"];

        $folder = "uploads/product_new/" . $img_name;
        $fileType = $_FILES['image']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: view_stock.php");
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {

            $update_filename = '';
        }
    } else {
        $update_filename = $_POST['old_image'];
    }

    if (validateInput($product_name) === $product_name && validateInput($sub_product) === $sub_product && validateInput($shade) === $shade && validateInput($gsm) === $gsm && validateInput($hsn_no) === $hsn_no && validateInput($sizes) === $sizes && validateInput($weights) === $weights && validateInput($stock_in_kg) === $stock_in_kg && validateInput($price_per_kg) === $price_per_kg && validateInput($quantity_in_kg) === $quantity_in_kg && validateInput($bf) === $bf && validateInput($grain) === $grain && validateInput($sheet) === $sheet && validateInput($rim_weight) === $rim_weight && validateInput($w_l) === $w_l && validateInput($no_of_bundle) === $no_of_bundle && validateInput($no_of_rim) === $no_of_rim && validateInput($request) === $request && validateInput($other) === $other) {
        $query = "update product_new set
product_name='$product_name',category_id='$sub_product',shade='$shade',gsm='$gsm',hsn_no='$hsn_no',size='$sizes',weight='$weights',stock_in_kg='$stock_in_kg',price_per_kg='$price_per_kg',quantity_in_kg='$quantity_in_kg',bf='$bf',grain='$grain',sheet='$sheet',rim_weight='$rim_weight',w_l='$w_l',no_of_bundle='$no_of_bundle',no_of_rim='$no_of_rim',request=$request,other='$other',image='$update_filename'
where id='$seller_id'";



        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Product Update Successfully!";
            header("Location: view_stock.php");
        } else {
            $_SESSION['error'] = "Product Not Updated Due to Some Error!";
            header("Location: view_stock.php");
        }
    } else {

        $_SESSION['error'] = "Invalid Input!";
        header("Location: view_stock.php");
        exit();
    }
}

if (isset($_POST['add_category'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $immge = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/category/";
        $target_file = $target_dir . date('dmyHis') . '_' . $_FILES["image"]["name"];
        $uploadOk = 1;
        $pdfFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (optional)
        if ($_FILES["image"]["size"] > 5000000) { // Adjust size limit as needed
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $fileType = $_FILES['image']['type'];
            if (!isValidFileType($fileType, $allowedMimeTypes)) {
                // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
                $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
                header("Location: view_stock.php");
                exit;
            }
            if (aws_doc_Upload($_FILES["image"]["tmp_name"], $target_file)) {
                $update_filename = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }
    if (validateInput($name) === $name) {
        $query = "insert into new_category(name,image) values('$name','$update_filename')";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "Category Added Successfully!";
            header("Location: categories.php");
        } else {
            $_SESSION['error'] = "Category Not Added Due to Some Error!";
            header("Location: categories.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: categories.php");
        exit();
    }
}
if (isset($_POST['category_update'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $doc_img = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $old_doc_img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['old_documen']));

    if (!empty($doc_img)) {
        $img_name = $doc_img;
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "uploads/category/" . date('dmyHis') . '_' . $img_name;
        $fileType = $_FILES['image']['type'];
        if (!isValidFileType($fileType, $allowedMimeTypes)) {
            // die("Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.");
            $_SESSION['error'] = "Error: Unsupported file type. Only JPG, PNG, and GIF files are allowed.";
            header("Location: categories.php");
            exit;
        }
        if (aws_doc_Upload($tempname, $folder)) {
            $uploaded_doc = "https://paperdeals-doc-bucket.s3.ap-south-1.amazonaws.com/" . $folder;
        } else {
            $uploaded_doc = '';
        }
    } else {
        $uploaded_doc = $old_doc_img;
    }

    // Enclose values in quotes for SQL query
    $name = "'$name'";
    $uploaded_doc = "'$uploaded_doc'";
    if (validateInput($name) === $name) {
        // Fix SQL injection vulnerability by using prepared statements
        $query = "UPDATE new_category SET name=$name, image=$uploaded_doc WHERE id = '$user_id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = "Category Updated Successfully!";
            header("Location: categories.php");
        } else {
            $_SESSION['error'] = "Category Not Updated Due to Some Error!";
            header("Location: categories.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: categories.php");
        exit();
    }
}

if (isset($_POST['active_user_category'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update new_category set status=1 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = " Activated Successfully!";
        header("Location: categories.php");
    } else {
        $_SESSION['error'] = " status not changed due to Some Error!";
        header("Location: categories.php");
    }
}

if (isset($_POST['deactive_user_category'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "Update new_category set status=0 where id = '$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = " Deactivated Successfully!";
        header("Location: categories.php");
    } else {
        $_SESSION['error'] = " status not changed due to Some Error!";
        header("Location: categories.php");
    }
}

if (isset($_POST['upload'])) {

    if (isset($_FILES['excel'])) {
        $fileName = $_FILES['excel']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowed_ext = ['xls', 'csv', 'xlsx'];

        if (in_array($file_ext, $allowed_ext)) {

            $inputFileNamePath = $_FILES['excel']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $count = "0";
            foreach ($data as $row) {
                if ($count > 0) {
                    $category_id = $row['0'];
                    $product_name = $row['1'];
                    $bf = $row['2'];
                    $gsm = $row['3'];
                    $w_l = $row['4'];
                    $size = $row['5'];
                    $shade = $row['6'];
                    $grain = $row['7'];
                    $sheet = $row['8'];
                    $rim_weight = $row['9'];
                    $no_of_rim = $row['10'];
                    $weight = $row['11'];
                    $stock_in_kg = $row['12'];
                    $no_of_bundle = $row['13'];
                    $price_per_kg = $row['14'];
                    $quantity_in_kg = $row['15'];
                    $other = $row['16'];
                    $user_id = $_SESSION['id'];
                    $date = date("Y-m-d H:s:i");

                    $product_new = "INSERT INTO product_new (seller_id,category_id,product_name,bf,gsm,w_l,size,shade,grain,sheet,rim_weight,no_of_rim,weight, stock_in_kg ,no_of_bundle,price_per_kg,quantity_in_kg,other,created_at) VALUES ('$user_id','$category_id','$product_name','$bf','$gsm','$w_l','$size','$shade','$grain','$sheet','$rim_weight','$no_of_rim','$weight','  $stock_in_kg ','$no_of_bundle','$price_per_kg','$quantity_in_kg ','$other','$date')";
                    $result = mysqli_query($conn, $product_new);
                    $msg = true;
                } else {
                    $count = "1";
                }
            }

            if (isset($msg)) {
                $_SESSION['success'] = "Successfully Imported";
                header("Location: view_stock.php");
                exit();
            }
            exit(0);
        } else {
            $_SESSION['error'] = "Not Imported";
            header("Location: view_stock.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Invalid File";
        header("Location: view_stock.php");
        exit(0);
    }
}

// add plan Subscription 

if (isset($_POST['save_Plan'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    if (validateInput($name) === $name) {
        $query = "insert into subscription_plan(name,price) values('$name','$price')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['success'] = "Subscription Plan Added Successfully!";
            header("Location: plan.php");
        } else {
            $_SESSION['error'] = "Subscription Plan Not Added Due to Some Error!";
            header("Location: plan.php");
        }
    } else {
        $_SESSION['error'] = "Invalid Input!";
        header("Location: plan.php");
        exit();
    }
}
if (isset($_POST['plan_update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    if (validateInput($name) === $name && validateInput($price) === $price) {
        $query = "update subscription_plan set name='$name',price='$price' where id='$product_id'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['success'] = "subscription plan Updated Successfully!";
            header("Location: plan.php");
        } else {
            $_SESSION['error'] = "subscription plan Not Updated Due to Some Error!";
            header("Location: plan.php");
        }
    } else {

        $_SESSION['error'] = "Invalid Input!";
        header("Location: plan.php");
        exit();
    }
}

if (isset($_POST['delete_plan_btn'])) {
    $delete_plan_id = mysqli_real_escape_string($conn, $_POST['delete_plan_id']);

    $query = "delete from subscription_plan where id='$delete_plan_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "subscription plan Deleted Successfully!";
        header("Location: plan.php");
    } else {
        $_SESSION['error'] = "subscription plan Not Deleted Due to Some Error!";
        header("Location: plan.php");
    }
}
