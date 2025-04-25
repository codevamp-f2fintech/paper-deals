<?php
require __DIR__ . '/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
ob_start();
include ('img7.php');
$htm_code = ob_get_clean();

$html2pdf->writeHTML($htm_code);
$html2pdf->output();
?>