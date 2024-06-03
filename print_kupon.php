<?php
require_once("function/function.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("function/function.php");
    $connection = connect();

    $id_pelanggan = htmlspecialchars($_POST["cetak_id_pelanggan"]);

    $stmt = $connection->prepare("SELECT * FROM `pelanggan` WHERE id_pelanggan = ?");
    $stmt->bind_param("s", $id_pelanggan);
    $stmt->execute();
    $stmt_get = $stmt->get_result();
    $stmt_result = $stmt_get->fetch_assoc();

    $imgname = urlencode($stmt_result["qr_code"]);





}else{
    echo '
    <script>
        alert("hai")
    </script>
    ';
    header("location:lihat_pelanggan.php");
    exit();
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <link rel="stylesheet" href="style/styles.css">
    <title>Document</title>
    <script>
        window.print();
    </script>

    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;

            }

            @page {
                size: A4;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>

    <div class="wrap-print">
        <div class="wrap-kupon">
            <img src="assets_pelanggan/<?= $imgname ?>" alt="" style="width: 60px; margin: 51px 50px 50px 38.5px;">
        </div>
    </div>


</body>




</html>