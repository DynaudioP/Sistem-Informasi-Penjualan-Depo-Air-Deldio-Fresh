<?php

require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

function generateQR($id_pelanggan, $text)
{
    // $text = nama pelanggan
    // 

    $sensitiveData = "$id_pelanggan";
    $generateRandom = bin2hex(random_bytes(16));
    $keys = 'deldiofresh';

    $dataToHash = $sensitiveData . $generateRandom . $keys;
    $hash = hash('sha256', $dataToHash);

    $qr_code = QrCode::create("deldiofresh.my.id/cek_kupon?id=$id_pelanggan&hash=$hash");
    $logo = Logo::create("images/logo.png")
        ->setResizeToWidth(150);

    $writer = new PngWriter;

    $result = $writer->write($qr_code);

    

    // Save the image to a file
    $result->saveToFile("assets_pelanggan/%$id_pelanggan&$hash.png");

    $response = array("message" => "%$id_pelanggan&$hash.png", "keys" => "$generateRandom","status" => "success");

    return $response;
}

