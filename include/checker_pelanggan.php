<?php

require_once ("function/function.php");

function cekKupon($id, $hash)
{
    try {
        $con = connect();
        $keys = "deldiofresh";

        $stmt = $con->prepare("SELECT * FROM `pelanggan` WHERE id_pelanggan = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            $response = array("message" => "Data pelanggan invalid", "status" => "error");

            return $response;
        }
        $keys_pelanggan = $data["kunci"];

        $dataToHash = $id . $keys_pelanggan . $keys;

        $verificationHash = hash("sha256", $dataToHash);

        if ($hash === $verificationHash) {
            $jumlah_kupon = $data["kupon"];
            $response = array("message" => $id, "status" => "success");
            return $response;

        } else {
            $response = array("message" => "Data pelanggan invalid", "status" => "error");

            return $response;
        }
    }
    catch (Exception $e){
        $response = array("message" => "Data pelanggan invalid", "status" => "error");

            return $response;
    }
}

?>