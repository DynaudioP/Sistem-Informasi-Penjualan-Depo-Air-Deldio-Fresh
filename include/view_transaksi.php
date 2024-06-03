<?php

require_once ("function/function.php");

function deleteTransaksi($id_transaksi)
{
    try {
        $connection = connect();

        $stmt = $connection->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
        $stmt->bind_param("s", $id_transaksi);
        $stmt->execute();

        $response = array("message" => "Data Transaksi terhapus", "status" => "success");

        return $response;
    } catch (Exception $e) {
        $response = array("message" => "Data Transaksi gagal dihapus", "status" => "error");

        return $response;
    }

}

function updateTransaksi($id_transaksi, $id_galon)
{
    try {
        $connection = connect();

        $stmt = $connection->prepare("UPDATE transaksi SET id_galon = ? WHERE id_transaksi = ?");
        $stmt->bind_param("ss", $id_galon, $id_transaksi);
        $stmt->execute();

        $response = array("message" => "Data Transaksi terubah", "status" => "success");

        return $response;
    } catch (Exception $e) {
        $response = array("message" => "Data Transaksi gagal terubah", "status" => "error");

        return $response;
    }


}


?>