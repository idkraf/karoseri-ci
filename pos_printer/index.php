<?php

if(isset($_GET['id'])) {$id=(integer)$_GET['id']; } else { exit('Please set url in you pos app'); }
mb_internal_encoding("UTF-8");
require_once("vendor/autoload.php");
require_once("config.php");
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
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
    curl_setopt($ch, CURLOPT_URL, $config['app_url']."rest/invoice?id=$id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.66 Safari/537.36");      
    // Decode returned JSON
    $output = json_decode(curl_exec($ch), true);      
    // Close Channel
    curl_close($ch);      
    // Return output
  //  print_r($output['items']);

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

			 $items = array();
            $sub_t = 0;
            foreach ($output['items'] as $row) {
				
                $items[] = toString(@$row['product'], @$row['subtotal']);
                $sub_t += $row['price'] * $row['qty'];
            }
            $subtotal = toString('Subtotal', $sub_t);
            $tax = toString('Tax', $output['invoice']['tax']);
            $total = toString('Total', $output['invoice']['total'], true, $output['currency']);
            //Date is kept the same for testing
            // $date = date('l jS \of F Y h:i:s A');
            $date = $output['invoice']['invoicedate'] ;

            // Start the printer
            //$logo = EscposImage::load(FCPATH . "userfiles/company/logo.png", false);
            $printer = new Printer($connector);

            // Print top logo
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            //$printer->graphics($logo);

            //Name of shop
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($output['company']['cname'] . "\n");
            $printer->selectPrintMode();
            $printer->text($output['company']['address'] . "\n");
            $printer->feed();

            //Title of receipt
            $printer->setEmphasis(true);
            $printer->text( ' Invoice ' . $output['invoice']['tid'] . "\n");
            $printer->setEmphasis(false);

            //Items
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->setEmphasis(true);
            $printer->text(toString('', $output['currency']));
            $printer->setEmphasis(false);
            foreach ($items as $item) {
                $printer->text($item);
            }
			 $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->setEmphasis(true);
            $printer->text($subtotal);
            $printer->setEmphasis(false);
            $printer->feed();

            // Tax and total
            $printer->text($tax);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($total);
            $printer->selectPrintMode();

            // Footer
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text('Thank you' . "\n");
            $printer->text("\n");
            $printer->feed(2);
            $printer->text($date . "\n");

            // Cut the receipt and open the cash drawer
            $printer->cut();
            //   $printer->pulse();
            if ($config['printer_connection'] == 'test') {
                $data = $connector->getData();

                header('Content-type: application/octet-stream');
                header('Content-Length: ' . strlen($data));

                $file = "pos_test_receipt_" . date('Y-m-d_H_i_s') . ".bin";
                file_put_contents($file, $data);
            }


            $printer->close();




