<?php
require 'function/function.php';

$con = connect();

// jumlah kupon yang dimiliki
$jumlah_kupon = 0;

$id_pelanggan = $_POST["id_pelanggan"];
$id_kupon = $_POST["id_kupon"];

$stmt = $con->prepare("SELECT id_galon FROM `kupon` WHERE id_kupon = ?");
$stmt->bind_param("s", $id_kupon);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$stmt1 = $con->prepare("SELECT id_galon, id_pelanggan FROM `simpan_kupon` WHERE id_pelanggan = ? AND id_galon = ?");
$stmt1->bind_param("ss", $id_pelanggan, $data['id_galon']);
$stmt1->execute();
$result1 = $stmt1->get_result();


while ($data1 = $result1->fetch_assoc()) {
    $jumlah_kupon++;
}


// jumlah untuk mendapatkan kupon
$stmt2 = $con->prepare("SELECT id_galon, p_gratis FROM `kupon` WHERE id_kupon = ?");
$stmt2->bind_param("s", $id_kupon);
$stmt2->execute();
$result2 = $stmt2->get_result();
$data2 = $result2->fetch_assoc();

$stmt3 = $con->prepare("SELECT COUNT(*) AS 'transaksi' FROM transaksi WHERE transaksi.id_pelanggan = ? AND id_galon = ?");
$stmt3->bind_param("ss", $id_pelanggan, $data2['id_galon']);
$stmt3->execute();
$result3 = $stmt3->get_result();
$data3 = $result3->fetch_assoc();

$tes = $data3['transaksi'];


if ($data3['transaksi'] >= $data2['p_gratis']) {
    $sisa = 0;
    $i = $data3['transaksi'];
    $p_gratis = $data2['p_gratis'];
    while ($i % $p_gratis != 0) {
        $i++;
        $sisa++;
    }

    $res = [
        'tes' => $tes,
        'id' => $id_kupon,
        'kupon' => $jumlah_kupon,
        'jumlah' => $sisa,
        'status' => 'success'
    ];

    echo json_encode($res);
    exit();

} else {
    if ($data3['transaksi'] == 0) {
        $res = [
            'tes' => $tes,
            'id' => $id_kupon,
            'kupon' => $jumlah_kupon,
            'jumlah' => $data2['p_gratis'],
            'status' => 'success'
        ];
        echo json_encode($res);
        exit();
    } else {
        $jumlah_sisa = $data2['p_gratis'] - $data3['transaksi'];
        $res = [
            'tes' => $tes,
            'id' => $id_kupon,
            'kupon' => $jumlah_kupon,
            'jumlah' => $jumlah_sisa,
            'status' => 'success'
        ];
        echo json_encode($res);
        exit();

    }
}




?>