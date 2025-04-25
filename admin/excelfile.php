<?php
require 'PHPExcel/Classes/PHPExcel.php';

if(isset($_FILES['excel_doc']['name']) && !empty($_FILES['excel_doc']['name'])){
    $excel_doc = $_FILES['excel_doc']['tmp_name'];
    
    $excelReader = PHPExcel_IOFactory::createReaderForFile($excel_doc);
    $excelObj = $excelReader->load($excel_doc);
    $worksheet = $excelObj->getActiveSheet();
    
    $html = '<table border="1">';
    foreach ($worksheet->getRowIterator() as $row) {
        $html .= '<tr>';
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        foreach ($cellIterator as $cell) {
            $html .= '<td>' . $cell->getValue() . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</table>';
} else {
    $html = '<p>No file uploaded.</p>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Display Excel Data</title>
</head>
<body>
    <h2>Excel Data</h2>
    <?php echo $html; ?>
    <br>
    <a href="master_product.php">Back to Upload Page</a>
</body>
</html>
