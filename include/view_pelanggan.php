<?php

require_once ("function/function.php");
require ("generate.php");

function deletePelanggan($id_pelanggan)
{
    try {
        $connection = connect();

        $stmt = $connection->prepare("UPDATE `pelanggan` SET `deleted` = '1' WHERE `pelanggan`.`id_pelanggan` = ?");
        $stmt->bind_param("s", $id_pelanggan);
        $stmt->execute();
    
        $response = array("message" => "Data pelanggan terhapus", "status" => "success");
    
        return $response;
    }
    catch (Exception $e) {
        $response = array("message" => "Data pelanggan gagal terhapus", "status" => "error");
    
        return $response;
    }
    

}

function updatePelanggan($id_pelanggan, $nama_pelanggan, $no_telp)
{
    try {
        $connection = connect();

        $stmt = $connection->prepare("UPDATE `pelanggan` SET `nama_pelanggan` = ?, `no_telp` = ? WHERE `pelanggan`.`id_pelanggan` = ?");
        $stmt->bind_param("sss", $nama_pelanggan, $no_telp, $id_pelanggan);
        $stmt->execute();
    
        $response = array("message" => "Data pelanggan terubah", "status" => "success");
    
        return $response;
    
    }
    catch (Exception $e) {
        $response = array("message" => "Data pelanggan gagal terubah", "status" => "error");
    
        return $response;
    }
    

}

function tambahPelanggan($nama_pelanggan, $no_telp)
{
    try {


        $connection = connect();

        $stmt = $connection->prepare("INSERT INTO pelanggan(nama_pelanggan, no_telp) VALUES(?, ?)");
        $stmt->bind_param("ss", $nama_pelanggan, $no_telp);
        $stmt->execute();

        if (!$stmt) {
            $response = array("message" => "Data pelanggan gagal", "status" => "error");
            return $response;
        }

        $stmt2 = $connection->prepare("SELECT * FROM `pelanggan` WHERE nama_pelanggan = ? ORDER BY id_pelanggan ASC");
        $stmt2->bind_param("s", $nama_pelanggan);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $data = $result->fetch_assoc();

        $generate = generateQR($data["id_pelanggan"], $nama_pelanggan);


        $stmt3 = $connection->prepare("UPDATE `pelanggan` SET `qr_code` = ?, `kunci` = ? WHERE `pelanggan`.`id_pelanggan` = ?");
        $stmt3->bind_param("sss", $generate["message"], $generate["keys"], $data["id_pelanggan"]);
        $stmt3->execute();



        $response = array("message" => "Data pelanggan ditambah", "status" => "success");

        return $response;

    }
    catch (Exception $e) {
        $response = array("message" => "Data pelanggan gagal ditambah", "status" => "error");
        return $response;
    }
}

function kuponPelanggan($id_simpan)
{
    $connection = connect();

    $stmt = $connection->prepare("SELECT * FROM `simpan_kupon` WHERE id_simpan = ?");
    $stmt->bind_param("s", $id_simpan);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $nama = $data["id_pelanggan"];
    $harga = $data["id_galon"];

    $stmts = $connection->prepare("SELECT * FROM `pelanggan` WHERE id_pelanggan = ?");
    $stmts->bind_param("s", $nama);
    $stmts->execute();
    $stmt_get = $stmts->get_result();
    $stmt_result = $stmt_get->fetch_assoc();

    $count = $stmt_result["kupon"];
    $count = $count - 1;

    $stmt3 = $connection->prepare("UPDATE pelanggan SET kupon = $count WHERE id_pelanggan = ?");
    $stmt3->bind_param("s", $nama);
    $stmt3->execute();

    $stmt2 = $connection->prepare("INSERT INTO `transaksi` (`id_pelanggan`, `id_galon`, p_kupon) VALUES (?, ?, 1)");
    $stmt2->bind_param("ss", $nama, $harga);
    $stmt2->execute();

    $stmt1 = $connection->prepare("DELETE FROM simpan_kupon WHERE `simpan_kupon`.`id_simpan` = ?");
    $stmt1->bind_param("s", $id_simpan);
    $stmt1->execute();

    $response = array("message" => "Kupon berhasil digunakan", "status" => "success");

    return $response;

}

?>