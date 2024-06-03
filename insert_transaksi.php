<?php

require_once ("function/function.php");

if (isset($_POST["tes"])) {
    $con = connect();

    $nama = $_POST["nama"];
    $harga = $_POST["harga"];

    $stmt2 = $con->prepare("SELECT * FROM `transaksi` ORDER BY id_transaksi DESC LIMIT 1;");
    $stmt2->execute();
    $stmt_get2 = $stmt2->get_result();
    $stmt_result2 = $stmt_get2->fetch_assoc();

    $stmt3 = $con->prepare("SELECT * FROM `simpan_kupon` ORDER BY id_simpan DESC LIMIT 1;");
    $stmt3->execute();
    $stmt_get3 = $stmt3->get_result();
    $stmt_result3 = $stmt_get3->fetch_assoc();

    $simpan = $stmt_result3["id_simpan"];

    $stmt = $con->prepare("SELECT * FROM `pelanggan` WHERE id_pelanggan = ?");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $stmt_get = $stmt->get_result();
    $stmt_result = $stmt_get->fetch_assoc();

    $count = $stmt_result["kupon"];
    $count = $count - 1;

    $stmt1 = $con->prepare("UPDATE pelanggan SET kupon = $count WHERE id_pelanggan = ?");
    $stmt1->bind_param("s", $nama);
    $stmt1->execute();

    $stmt5 = $con->prepare("DELETE FROM simpan_kupon WHERE `simpan_kupon`.`id_simpan` = ?");
    $stmt5->bind_param("s", $simpan);
    $stmt5->execute();

    $free_k = $con->prepare("UPDATE `transaksi` SET `p_kupon` = '1' WHERE `transaksi`.`id_transaksi` = ?");
    $free_k->bind_param("s", $stmt_result2["id_transaksi"]);
    $free_k->execute();

    header("Location: tambah_transaksi.php");
    exit();


}

function transaksiPelangganTest($nama, $harga)
{
    $con = connect();

    // nama adalah id

    try {

        $transaksi_stmt = $con->prepare("INSERT INTO transaksi(id_pelanggan, id_galon) value(?,?)");
        $transaksi_stmt->bind_param("ss", $nama, $harga);

        $pelanggan_stmt = $con->prepare('SELECT * FROM `pelanggan` WHERE id_pelanggan = ?');
        $pelanggan_stmt->bind_param("s", $nama);
        $pelanggan_stmt->execute();
        $pelanggan_get = $pelanggan_stmt->get_result();
        $pelanggan_result = $pelanggan_get->fetch_assoc();

        $galon_stmt = $con->prepare('SELECT * FROM `produk_galon` WHERE id_galon = ?');
        $galon_stmt->bind_param("s", $harga);
        $galon_stmt->execute();
        $galon_get = $galon_stmt->get_result();
        $galon_result = $galon_get->fetch_assoc();

        $kupon_stmt = $con->prepare('SELECT * FROM `kupon` WHERE id_galon = ?');
        $kupon_stmt->bind_param("s", $harga);
        $kupon_stmt->execute();
        $kupon_get = $kupon_stmt->get_result();
        $kupon_result = $kupon_get->fetch_assoc();

        // cek jika inputan tidak tersentuh(select option masih berada di default value)
        if ($nama == "Nama" || $harga == "Harga") {
            $response = array("message" => "Data transaksi gagal ditambah", "status" => "error");

            return $response;
        }

        if ($kupon_result) {
            $jumlah1_stmt = $con->prepare("SELECT COUNT(*) AS total_transaksi FROM `transaksi` WHERE id_galon = ? AND id_pelanggan = ? AND transaksi.date BETWEEN ? AND CURRENT_DATE();");
            $jumlah1_stmt->bind_param("sss", $harga, $nama, $kupon_result["date"]);
            $jumlah1_stmt->execute();
            $jumlah1_get = $jumlah1_stmt->get_result();
            $jumlah1_result = $jumlah1_get->fetch_assoc();

            // query untuk penambahan dalam perhitungan kupon(increment pada promo kupon)
            $tambah_stmt = $con->prepare("SELECT COUNT(*) AS total_transaksi FROM `transaksi` WHERE id_galon = ? AND id_pelanggan = ? AND p_kupon = 1 AND transaksi.date BETWEEN ? AND CURRENT_DATE();");
            $tambah_stmt->bind_param("sss", $harga, $nama, $kupon_result["date"]);
            $tambah_stmt->execute();
            $tambah_get = $tambah_stmt->get_result();
            $tambah_result = $tambah_get->fetch_assoc();

            $jumlah_transaksi = $jumlah1_result["total_transaksi"];
            $tambah_kupon = $tambah_result["total_transaksi"] + $kupon_result["p_gratis"];

          
            while ($jumlah_transaksi > $tambah_kupon) {
                $jumlah_transaksi = $jumlah_transaksi - $kupon_result["p_gratis"];
            }
            

            if ($jumlah_transaksi % $tambah_kupon == 0 and $jumlah1_result["total_transaksi"] != 0) {

                
                // tambahkan kupon 
                $stmt2 = $con->prepare("INSERT INTO `simpan_kupon` (`id_pelanggan`, `id_galon`) VALUES (?, ?)");
                $stmt2->bind_param("ss", $nama, $harga);
                $stmt2->execute();

                // tambah transaksi
                $transaksi_stmt->execute();

                // tambah count(perhitungan kupon yang dimiliki pelanggan)
                $count = $pelanggan_result["kupon"];
                $count = $count + 1;

                $count_stmt = $con->prepare("UPDATE pelanggan SET kupon = $count WHERE pelanggan.id_pelanggan = ?");
                $count_stmt->bind_param("s", $nama);
                $count_stmt->execute();

                // akan masuk ke modal (apakah ingin menggunakan kupon tersebut?)
                $response = array("message" => "Gratis Kupon apakah ingin digunakan? " . $count . "", "status" => "free");

                return $response;

            }
        }

        $transaksi_stmt->execute();
        if ($transaksi_stmt->affected_rows != 1) {
            $response = array("message" => "Data transaksi gagal ditambah", "status" => "error");

            return $response;

        }
        $response = array("message" => "Data transaksi berhasil ditambah " . $jumlah_transaksi . "". $jumlah1_result["total_transaksi"] ."", "status" => "success");

        return $response;



    } catch (Exception $e) {
        $response = array("message" => "Data transaksi gagal ditambah", "status" => "error");

        return $response;
    }
}


function transaksiPelanggan($nama, $harga)
{
    try {


        $con = connect();

        $qp_r = $con->prepare("SELECT * FROM `pelanggan` WHERE id_pelanggan = ?");
        $qp_r->bind_param("s", $nama);
        $qp_r->execute();
        $qp_get = $qp_r->get_result();
        $qp_result = $qp_get->fetch_assoc();

        $qp_r1 = $con->prepare("SELECT * FROM `produk_galon` WHERE id_galon = ?");
        $qp_r1->bind_param("s", $harga);
        $qp_r1->execute();
        $qp_get1 = $qp_r1->get_result();
        $qp_result1 = $qp_get1->fetch_assoc();




        if ($nama == "Nama" || $harga == "Harga") {
            $response = array("message" => "Data transaksi gagal ditambah", "status" => "error");

            return $response;
        }


        $stmt = $con->prepare("INSERT INTO transaksi(id_pelanggan, id_galon) value(?,?)");
        $stmt->bind_param("ss", $nama, $harga);

        $kupon_q = $con->prepare("SELECT * FROM `kupon` WHERE id_galon = ?");
        $kupon_q->bind_param("s", $harga);
        $kupon_q->execute();
        $kupon_qget = $kupon_q->get_result();
        $kupon_result = $kupon_qget->fetch_assoc();

        if (!$qp_result1 || !$qp_result) {
            $response = array("message" => "Data transaksi gagal ditambah", "status" => "error");

            return $response;
        }

        $add_jml = $con->prepare("UPDATE pelanggan set jml_beli = jml_beli + 1 WHERE id_pelanggan = ?");
        $add_jml->bind_param("s", $nama);
        $add_jml->execute();

        $qp_r2 = $con->prepare("SELECT * FROM `kupon` WHERE id_galon = ?");
        $qp_r2->bind_param("s", $harga);
        $qp_r2->execute();
        $qp_get2 = $qp_r2->get_result();
        $qp_result2 = $qp_get2->fetch_assoc();

        if ($qp_result2) {
            $qp_r3 = $con->prepare("SELECT COUNT(*) AS total_transaksi FROM `transaksi` WHERE id_galon = ? AND id_pelanggan = ? AND transaksi.date BETWEEN ? AND CURRENT_DATE();");
            $qp_r3->bind_param("sss", $harga, $nama, $qp_result2["date"]);
            $qp_r3->execute();
            $qp_get3 = $qp_r3->get_result();
            $qp_result3 = $qp_get3->fetch_assoc();

            if ($qp_result3["total_transaksi"] % $qp_result2["p_gratis"] == 0 and $qp_result3["total_transaksi"] != 0) {

                $count = $qp_result["kupon"];

                // if ($count == 0) {
                //     $stmt1 = $con->prepare("UPDATE pelanggan SET kupon = $count WHERE id_pelanggan = ?");
                //     $stmt1->bind_param("s", $nama);
                //     $stmt1->execute();

                //     $response = array("message" => "Data transaksi berhasil ditambah", "status" => "free");

                //     return $response;

                // }


                $count = $count + 1;

                $stmt1 = $con->prepare("UPDATE pelanggan SET kupon = $count WHERE pelanggan.id_pelanggan = ?");
                $stmt1->bind_param("s", $nama);
                $stmt1->execute();

                $stmt2 = $con->prepare("INSERT INTO `simpan_kupon` (`id_pelanggan`, `id_galon`) VALUES (?, ?)");
                $stmt2->bind_param("ss", $nama, $harga);
                $stmt2->execute();

                $stmt->execute();

                // $free_k = $con->prepare("INSERT INTO transaksi(id_pelanggan, id_galon, p_kupon) VALUE(?,?,1)");
                // $free_k->bind_param("ss", $nama, $harga);
                // $free_k->execute();

                $response = array("message" => "Gratis Kupon apakah ingin digunakan? " . $count . "", "status" => "free");

                return $response;
            } else {

                $stmt->execute();
                $response = array("message" => "Data transaksi berhasil ditambah", "status" => "success");

                return $response;


            }

            // $free_k = $con->prepare("INSERT INTO transaksi(id_pelanggan, id_galon, p_kupon) VALUE(?,?,1)");
            // $free_k->bind_param("ss", $nama, $harga);
            // $free_k->execute();

            // $response = array("message" => "Data transaksi berhasil ditambah", "status" => "free");
        } else {
            $stmt->execute();
            if ($stmt->affected_rows != 1) {
                $response = array("message" => "Data transaksi gagal ditambah", "status" => "error");

                return $response;

            }
            $response = array("message" => "Data transaksi berhasil ditambah", "status" => "success");

            return $response;
        }
    } catch (Exception $e) {
        $response = array("message" => "Data transaksi gagal ditambah", "status" => "error");

        return $response;

    }


}

function tukarKupon($nama, $harga)
{
    $con = connect();

    $stmt = $con->prepare("SELECT * FROM `pelanggan` WHERE id_pelanggan = ?");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $stmt_get = $stmt->get_result();
    $stmt_result = $stmt_get->fetch_assoc();

    $count = $stmt_result["kupon"];
    $count = $count - 1;

    $stmt1 = $con->prepare("UPDATE pelanggan SET kupon = $count WHERE id_pelanggan = ?");
    $stmt1->bind_param("s", $nama);
    $stmt1->execute();

    $free_k = $con->prepare("INSERT INTO transaksi(id_pelanggan, id_galon, p_kupon) VALUE(?,?,1)");
    $free_k->bind_param("ss", $nama, $harga);
    $free_k->execute();


}


function transaksiQR($id, $hash, $harga)
{
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
        $response = (transaksiPelanggan($id, $harga));
        return $response;

    } else {
        $response = array("message" => "Data pelanggan invalid", "status" => "error");

        return $response;
    }

}

function transaksiGuest($harga)
{
    $con = connect();

    try {
        if ($harga == "Harga") {
            $response = array("message" => "Input Salah", "status" => "error");

            return $response;
        }

        $stmt = $con->prepare("INSERT INTO transaksi(id_pelanggan, id_galon) value(3,?)");
        $stmt->bind_param("s", $harga);
        $stmt->execute();



        $add_jml = $con->prepare("UPDATE pelanggan set jml_beli = jml_beli + 1 WHERE id_pelanggan = 3");
        $add_jml->execute();


        if ($stmt->affected_rows != 1) {
            return "Unexpected Error";
        }
        $response = array("message" => "Data transaksi berhasil ditambah", "status" => "success");

        return $response;
    } catch (Exception $e) {
        $response = array("message" => "Input Salah", "status" => "error");

        return $response;
    }

}