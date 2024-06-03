<?php 
require 'function/function.php';

try {



$connection = connect();

$id = $_POST["id"];
$hash = $_POST["hash"];
$keys = "deldiofresh";

$stmt = $connection->prepare("SELECT * FROM `pelanggan` WHERE id_pelanggan = ? AND deleted = 0");
$stmt->bind_param("s", $id);
$stmt->execute();

if (!$stmt) {
    $res = [
        'status' => 'failed',
        'message' => 'error'
    ];
    echo json_encode($res);
    exit();
}

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    $res = [
        'status' => 'failed',
        'message' => 'error'
    ];
    echo json_encode($res);
    exit();
}

$keys_pelanggan = $data["kunci"];

$dataToHash = $id . $keys_pelanggan . $keys;

$verificationHash = hash("sha256", $dataToHash);

if ($hash === $verificationHash) {
    $res = [
        'status' => 'success',
        'message' => htmlspecialchars($data["nama_pelanggan"])
    ];
    echo json_encode($res);
    exit();
}else{
    $res = [
        'status' => 'failed',
        'message' => 'error'
    ];
    echo json_encode($res);
    exit();
}
}
catch (Exception $e) {
    $res = [
        'status' => 'failed',
        'message' => 'error'
    ];
    echo json_encode($res);
    exit();
}


?>