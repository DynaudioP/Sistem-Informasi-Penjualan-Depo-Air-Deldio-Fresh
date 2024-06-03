<?php  

require_once("function/function.php");

function deleteGalon($id_galon){
    try {
        $connection = connect();

        $stmt = $connection->prepare("UPDATE `produk_galon` SET `deleted` = '1' WHERE `produk_galon`.`id_galon` = ?");
        $stmt->bind_param("s", $id_galon);
        $stmt->execute();
    
        $response = array("message" => "Data galon terhapus", "status" => "success");
    
        return $response;
    }
    catch (Exception $e){
        $response = array("message" => "Data galon gagal terhapus", "status" => "error");

        return $response;
    }
   

}

function updateGalon($id_galon, $tipe_galon, $harga_galon){
    try {

    if (!is_numeric($harga_galon)){
        $response = array("message" => "Data galon gagal ditambahkan", "status" => "error");

        return $response;
    }

    $connection = connect();

    $stmt = $connection->prepare("UPDATE `produk_galon` SET `tipe_galon` = ?, `harga_galon` = ? WHERE `produk_galon`.`id_galon` = ?");
    $stmt->bind_param("sss", $tipe_galon, $harga_galon, $id_galon, );
    $stmt->execute();

    if (!$stmt){
        $response = array("message" => "Data galon gagal terubah", "status" => "error");

        return $response;
    }
    if ($stmt->affected_rows != 1) {
        $response = array("message" => "Data galon gagal terubah", "status" => "error");

        return $response;
    }

    $response = array("message" => "Data galon terubah", "status" => "success");

    return $response;

    }
    catch (Exception $e){
        $response = array("message" => "Data galon gagal terubah", "status" => "error");

        return $response;
    }


}

function tambahGalon($tipe_galon, $harga_galon){

    if (!is_numeric($harga_galon)){
        $response = array("message" => "Data galon gagal ditambahkan", "status" => "error");

        return $response;
    }

    $connection = connect();

    $stmt = $connection->prepare("INSERT INTO produk_galon(tipe_galon, harga_galon) VALUES(?, ?)");
    $stmt->bind_param("ss", $tipe_galon, $harga_galon);
    $stmt->execute();

    $response = array("message" => "Data galon ditambah", "status" => "success");

    return $response;
    
}


?>
