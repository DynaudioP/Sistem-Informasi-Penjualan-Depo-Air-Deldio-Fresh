<?php  

require_once("function/function.php");

function deleteKupon($id_kupon){
    $connection = connect();

    $stmt = $connection->prepare("DELETE FROM `kupon` WHERE `kupon`.`id_kupon` = ?");
    $stmt->bind_param("s", $id_kupon);
    $stmt->execute();

    $response = array("message" => "Data kupon terhapus", "status" => "success");

    return $response;

}

function tambahKupon($id_galon, $kupon_pembelian){
    $connection = connect();

    if (!is_numeric($kupon_pembelian)){
        $response = array("message" => "Data galon gagal ditambahkan", "status" => "error");

        return $response;
    }

    $stmt = $connection->prepare("INSERT INTO kupon(id_galon, p_gratis) VALUES(?, ?)");
    $stmt->bind_param("ss", $id_galon, $kupon_pembelian);
    $stmt->execute();

    $response = array("message" => "Data galon ditambah", "status" => "success");

    return $response;
    
}


?>
