<?php
if(isset($_GET['id'])) {$id=(integer)$_GET['id']; } else { exit('Please set url in you pos app'); }

require_once("vendor/autoload.php");
require_once("config.php");
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;
function toString($name = '', $price = '', $dollarSign = false,$sign='')
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($name, $leftCols);

  
        $right = str_pad($sign . $price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";

    }
     $authorization = "X-API-KEY: ".$config['rest_key'];
     $ch = curl_init();
	  $ch = curl_init();      
    // Set cURL options
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_URL, $config['app_url']."rest/invoicepdf?id=$id&key=".$config['rest_key']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.66 Safari/537.36");      
    // Decode returned JSON
    $output = curl_exec($ch);      
    // Close Channel
    curl_close($ch);      

$file_name = substr($config['rest_key'],0,6).$id;
        copy($config['app_url'].'userfiles/pos_temp/rest-'.$file_name.'.png', 'tmp'.DIRECTORY_SEPARATOR.'rest-'.$file_name.'.png');
        switch ($config['printer_connection']) {
                case 'file' :
                    $connector = new FilePrintConnector($config['print_file']);
                    break;
                case 'network' :
                    $address = $config['print_network'];
                    $connector = new NetworkPrintConnector($address[0], $address[1]);
                    break;
                case 'windows' :
                    $connector = new WindowsPrintConnector($config['print_windows']);
                    break;

                case 'test' :
                    $connector = new DummyPrintConnector();
                    break;

            }
 $printer = new Printer($connector);
$printer -> graphics(EscposImage::load(getcwd().''.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'rest-'.$file_name.'.png'));
$printer -> cut();
  if ($config['printer_connection'] == 'test') {
                $data = $connector->getData();

                header('Content-type: application/octet-stream');
                header('Content-Length: ' . strlen($data));

                $file = "advanced_pos_test_receipt_" . date('Y-m-d_H_i_s') . ".bin";
                file_put_contents($file, $data);
            }
//$printer -> close();
if($printer -> close()){

  $ch = curl_init();
	  $ch = curl_init();      
    // Set cURL options
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_URL, $config['app_url']."pos_invoices/invoiceclean?id=$id&key=".$config['rest_key']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.66 Safari/537.36");      
    // Decode returned JSON
    $output = curl_exec($ch);      
    // Close Channel
    curl_close($ch);      

}