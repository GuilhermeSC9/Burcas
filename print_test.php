<?php
require 'vendor\autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


$connector = new Mike42\Escpos\PrintConnectors\WindowsPrintConnector("smb://burcas/MP-4200 TH");
$printer = new Mike42\Escpos\Printer($connector);


$printer->text("Comanda\n");
$printer->text("Item 1: R$10.00\n");

$printer->cut();

$printer->close();
?>
