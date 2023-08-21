<?php
$printerName = "MP4200";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $conn = cups_open();
    if (!$conn) {
        throw new Exception("Erro ao conectar à impressora.");
    }

    $content = "Pedido:\n";
    $content .= "Item 1 - R$10.00\n";
    $content .= "Item 2 - R$15.00\n";
    // Adicione os itens do pedido conforme necessário

    $options = array("media" => "A4");
    cupsPrintFile($conn, $printerName, 'nome_arquivo.txt', $content, $options);

    cups_close($conn);

    echo "Pedido impresso com sucesso.";
} catch (Exception $e) {
    echo "Erro ao imprimir: " . $e->getMessage();
}
?>
