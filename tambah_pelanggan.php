<?php
require_once 'include/nav.php';
require 'include/view_pelanggan.php';
$connection = connect();

if (isset($_POST["submit"])) {
    $nama_pelanggan = htmlspecialchars($_POST["inamap"]);
    $no_telp = htmlspecialchars($_POST["inotelp"]);

    $response = tambahPelanggan($nama_pelanggan, $no_telp);

    if ($response['status'] == "success") {
        echo
            "
            <script>
                Swal.fire(
                'Berhasil!',
                '" . htmlspecialchars($response["message"]) . "',
                'success'
            )
            </script>

            ";
    }
    if ($response['status'] == "error") {
        echo
            "
            <script>
                Swal.fire(
                'Error',
                '" . htmlspecialchars($response["message"]) . "',
                'error'
            )
            </script>

            ";

    }
}
;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depo Air</title>

</head>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body>
    <div class="wrap vh-100">
        <div class="content">
            <div style="height: 80vh;" class="d-flex flex-column justify-content-center align-items-center">
                <form class="box-bottom d-flex flex-column align-items-center" method="POST">
                    <div style="padding: 0.7em 0.9em 0.7em 0.9em;" class="box-bottom-top">
                        <h4>Tambah Pelanggan</h4>
                    </div>
                    <div style="gap: 0.75em;" class="box-bottom-bottom d-flex flex-wrap-reverse">
                        <div class="box-bottom-bottom-left d-flex flex-column ">
                            <div class="box-bottom-bottom-right align-self-center my-2">
                                <img src="images/tambah_pelanggan.svg" alt="Member Penambahan Transaksi"
                                    style="width:110px;">
                            </div>
                            <label for="inamap">Nama Pelanggan<span style="color: red;"> *</span></label>
                            <input type="text" name="inamap" class="form-control form-control-sm" required>
                            <label for="inotelp">No. Telepon<span style="color: red;"> *</span></label>
                            <input type="text" name="inotelp" class="form-control form-control-sm" required>
                            <div style="margin-top: 1em;" class="submit align-self-center">
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</body>

</html>