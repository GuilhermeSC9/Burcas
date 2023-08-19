<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '/Users/lucas/Desktop/Projeto_Gui/Burcas/vendor/autoload.php'; // Caminho para o arquivo autoload.php gerado pelo Composer

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

// Nome da impressora compartilhada no Windows
$printerName = "smb://192.168.1.174/burcas/MP4200";

try {
    // Conectar à impressora
    $connector = new WindowsPrintConnector($printerName);
    $printer = new Printer($connector);

    // Conteúdo do pedido a ser impresso
    $content = "Pedido:\n";
    $content .= "Item 1 - R$10.00\n";
    $content .= "Item 2 - R$15.00\n";
    // Adicione os itens do pedido conforme necessário

    // Imprimir conteúdo
    $printer->text($content);
    $printer->cut();
    $printer->close();

    echo "Pedido impresso com sucesso.";
} catch (Exception $e) {
    echo "Erro ao imprimir: " . $e->getMessage();
}
?>
