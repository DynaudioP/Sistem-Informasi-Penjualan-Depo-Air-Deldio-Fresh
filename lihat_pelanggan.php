<?php
require_once 'include/nav.php';
require 'include/view_pelanggan.php';
$connection = connect();

if (isset($_POST["delete"])) {
    $id_pelanggan = htmlspecialchars($_POST["hapus_id_pelanggan"]);
    $response = deletePelanggan($id_pelanggan);

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

if (isset($_POST["update"])) {
    $id_pelanggan = htmlspecialchars($_POST["id_pelanggan"]);
    $nama_pelanggan = htmlspecialchars($_POST["nama_pelanggan"]);
    $no_telp = htmlspecialchars($_POST["no_telp"]);
    $response = updatePelanggan($id_pelanggan, $nama_pelanggan, $no_telp);

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

if (isset($_POST["kupon"])) {
    $id_simpan = htmlspecialchars($_POST["simpan"]);
    $response = kuponPelanggan($id_simpan);

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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <title>Depo air</title>
    <script>

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


</head>

<body>
    <div class="container-fluid px-5 py-4">
        <h3>Daftar Pelanggan</h3>
    </div>
    <div class="container-fluid px-5">
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <div class="container border rounded-2 d-flex">
                    <div class="p-2"><svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5M4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25zM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5S5.5 6.57 5.5 8.5S7.07 12 9 12m0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7m7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44M15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35c.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35" />
                        </svg></div>
                    <div class="p-2 flex-grow-1">
                        <?php
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'total_pelanggan' FROM pelanggan WHERE deleted = 0");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                                <h4 class="text-end" style="margin-bottom: 3rem; font-weight: bold;">' . htmlspecialchars($q_view_cont1_rows["total_pelanggan"]) . '</h4>
                            ';
                        }
                        ;
                        ?>
                        <p class="text-end" style="margin-bottom: 0rem;">Total Pelanggan</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="container border rounded-2 d-flex">
                    <div class="p-2"><svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
                            viewBox="0 0 256 256">
                            <g fill="currentColor">
                                <path
                                    d="M160 128a32 32 0 1 1-32-32a32 32 0 0 1 32 32m40-64a48.85 48.85 0 0 0 40 40V64Zm0 128h40v-40a48.85 48.85 0 0 0-40 40M16 152v40h40a48.85 48.85 0 0 0-40-40m0-48a48.85 48.85 0 0 0 40-40H16Z"
                                    opacity=".2" />
                                <path
                                    d="M128 88a40 40 0 1 0 40 40a40 40 0 0 0-40-40m0 64a24 24 0 1 1 24-24a24 24 0 0 1-24 24m112-96H16a8 8 0 0 0-8 8v128a8 8 0 0 0 8 8h224a8 8 0 0 0 8-8V64a8 8 0 0 0-8-8M24 72h21.37A40.81 40.81 0 0 1 24 93.37Zm0 112v-21.37A40.81 40.81 0 0 1 45.37 184Zm208 0h-21.37A40.81 40.81 0 0 1 232 162.63Zm0-38.35A56.78 56.78 0 0 0 193.65 184H62.35A56.78 56.78 0 0 0 24 145.65v-35.3A56.78 56.78 0 0 0 62.35 72h131.3A56.78 56.78 0 0 0 232 110.35Zm0-52.28A40.81 40.81 0 0 1 210.63 72H232Z" />
                            </g>
                        </svg></div>
                    <div class="p-2 flex-grow-1">
                        <?php

                        $q_cont2 = $connection->prepare("SELECT * FROM `pelanggan` WHERE deleted = 0 ORDER BY `pelanggan`.`id_pelanggan` DESC LIMIT 1; ;");
                        $q_cont2->execute();
                        $q_cont2_result = $q_cont2->get_result();

                        while ($q_view_cont2_rows = mysqli_fetch_array($q_cont2_result)) {
                            echo '
                                <h4 class="text-end" style="margin-bottom: 3rem; font-weight: bold;">' . htmlspecialchars($q_view_cont2_rows["nama_pelanggan"]) . '</h4>
                            ';
                        }
                        ;
                        ?>

                        <p class="text-end" style="margin-bottom: 0rem;">Pelanggan Terbaru</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="container border rounded-2 d-flex">
                    <div class="p-2"><svg xmlns="http://www.w3.org/2000/svg" width="1.8em" height="1.8em"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 12.5a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7M10.5 16a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0" />
                            <path fill="currentColor"
                                d="M17.526 5.116L14.347.659L2.658 9.997L2.01 9.99V10H1.5v12h21V10h-.962l-1.914-5.599zM19.425 10H9.397l7.469-2.546l1.522-.487zM15.55 5.79L7.84 8.418l6.106-4.878zM3.5 18.169v-4.34A3.008 3.008 0 0 0 5.33 12h13.34a3.009 3.009 0 0 0 1.83 1.83v4.34A3.009 3.009 0 0 0 18.67 20H5.332A3.01 3.01 0 0 0 3.5 18.169" />
                        </svg></div>
                    <div class="p-2 flex-grow-1">
                        <?php

                        $q_cont3 = $connection->prepare("SELECT * FROM `pelanggan` ORDER BY `pelanggan`.`jml_beli` DESC LIMIT 1");
                        $q_cont3->execute();
                        $q_cont3_result = $q_cont3->get_result();

                        while ($q_view_cont3_rows = mysqli_fetch_array($q_cont3_result)) {
                            echo '
                                <h4 class="text-end" style="margin-bottom: 3rem; font-weight: bold; text-transformation:uppercase;">' . htmlspecialchars($q_view_cont3_rows["nama_pelanggan"]) . '</h4>
                            ';
                        }
                        ;
                        ?>
                        <p class="text-end" style="margin-bottom: 0rem;">Pelanggan dengan Pembelian terbanyak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-5 py-3" style="padding: 1em 4em 1em 4em;">

        <div class="table-wrapper"
            style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;border-radius: 8px ;padding: 1em 3em 1em 3em;">
            <table id="example" class="display responsive" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; ">
                <thead style="margin-top = 5px;">
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah Transaksi</th>
                        <th>No. Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $stmt = $connection->prepare("SELECT * FROM `pelanggan`");
                    $stmt->execute();
                    $q_view2_result = $stmt->get_result();




                    while ($q_view2_rows = mysqli_fetch_array($q_view2_result)) {
                        if ($q_view2_rows["deleted"] == 1) {

                        }
                        if ($q_view2_rows["deleted"] == 0 and $q_view2_rows["kupon"] >= 1) {
                            echo
                                "
                                    <tr>
                                        <td >" . $no++ . "</td>
                                        <td class='edit_nama'> " . $q_view2_rows["nama_pelanggan"] . "</td>    
                                        <td>" . $q_view2_rows["jml_beli"] . "</td>
                                        <td class='edit_harga'>" . $q_view2_rows["no_telp"] . "</td>      
                                        <td>
                                            <a href='' class='btn btn-warning view-btn' data-bs-toggle='modal' data-bs-target='#ubahModal" . $q_view2_rows["id_pelanggan"] . "' data-bs-whatever='@mdo'>Ubah</a>
                                            <a href='' class='btn btn-danger view-btn' data-bs-toggle='modal' data-bs-target='#deleteModal" . $q_view2_rows["id_pelanggan"] . "' data-bs-whatever='@mdo'>Hapus</a>
                                            <form action='print_kupon.php'  style='display: inline;' method='POST'>
                                                <input type='hidden' name='cetak_id_pelanggan' value='" . $q_view2_rows["id_pelanggan"] . "'>
                                                <button type='Submit' name='print' class='btn btn-primary'>Cetak</button>
                                            </form>
                                            <a href='' class='btn btn-success view-btn' data-bs-toggle='modal' data-bs-target='#kuponModal" . $q_view2_rows["id_pelanggan"] . "' data-bs-whatever='@mdo'>Tukar Kupon</a>
                                        </td>
                                    </tr
                                     ";
                            ?>
                            <!-- Modal Kupon test -->
                            <?php
                            $stmt1 = $connection->prepare("SELECT * FROM `simpan_kupon` WHERE id_pelanggan = ?");
                            $stmt1->bind_param("s", $q_view2_rows["id_pelanggan"]);
                            $stmt1->execute();
                            $q_view3_result = $stmt1->get_result();

                            $i = 0;
                            while ($jumlah = mysqli_fetch_array($q_view3_result)) {
                                $i++;

                            }

                            ?>
                            <div class="modal fade" id="kuponModal<?= $q_view2_rows["id_pelanggan"] ?>" tabindex="-1"
                                aria-labelledby="ubahModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="ubahModalLabel">Tukar Kupon</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <input type="hidden" name="id_pelanggan"
                                                value="<?= $q_view2_rows["id_pelanggan"] ?>" id="edit-id-pelanggan">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit-nama-pelanggan" class="col-form-label">
                                                        Nama Pelanggan
                                                    </label>
                                                    <input type="text" name="nama_pelanggan"
                                                        value="<?= $q_view2_rows["nama_pelanggan"] ?>" class="form-control"
                                                        id="edit-nama-pelanggan" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-id-pelanggan" class="col-form-label">
                                                        Jumlah Kupon Gratis yang dimiliki
                                                    </label>
                                                    <input type="text" name="jumlah_kupon" value="<?= $i ?>"
                                                        class="form-control" id="edit-id-pelanggan" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kupon-tipe-galon" class="col-form-label">
                                                        Tipe Galon yang memiliki Kupon Gratis
                                                    </label>
                                                    <select class="form-select" name="simpan">
                                                        <?php
                                                        $option_harga = $connection->prepare("SELECT id_simpan, simpan_kupon.id_galon, simpan_kupon.id_pelanggan, tipe_galon FROM `simpan_kupon` INNER JOIN produk_galon ON simpan_kupon.id_galon = produk_galon.id_galon INNER JOIN pelanggan ON simpan_kupon.id_pelanggan = pelanggan.id_pelanggan WHERE simpan_kupon.id_pelanggan = ?;");
                                                        $option_harga->bind_param("s", $q_view2_rows["id_pelanggan"]);
                                                        $option_harga->execute();
                                                        $option_harga_result = $option_harga->get_result();

                                                        $val;

                                                        while ($option_harga_row = mysqli_fetch_array($option_harga_result)) {

                                                            if ($option_harga_row["id_galon"] == $val) {

                                                            } else {
                                                                $val = $option_harga_row["id_galon"];

                                                                ?>

                                                                <option value="<?php echo $option_harga_row["id_simpan"] ?>">
                                                                    <?php echo htmlspecialchars($option_harga_row["tipe_galon"]) ?>
                                                                </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" name="kupon" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Akhir Modal Kupon test -->

                            <!-- Modal ubah test -->
                            <div class="modal fade" id="ubahModal<?= $q_view2_rows["id_pelanggan"] ?>" tabindex="-1"
                                aria-labelledby="ubahModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="ubahModalLabel">Ubah Pelanggan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit-id-pelanggan" class="col-form-label">
                                                        ID Pelanggan
                                                    </label>
                                                    <input type="text" name="id_pelanggan"
                                                        value="<?= $q_view2_rows["id_pelanggan"] ?>" class="form-control"
                                                        id="edit-id-pelanggan" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama-pelanggan" class="col-form-label">
                                                        Nama Pelanggan
                                                    </label>
                                                    <input type="text" name="nama_pelanggan"
                                                        value="<?= $q_view2_rows["nama_pelanggan"] ?>" class="form-control"
                                                        id="edit-nama-pelanggan">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama-pelanggan" class="col-form-label">
                                                        No.Telepon
                                                    </label>
                                                    <input type="text" name="no_telp" value="<?= $q_view2_rows["no_telp"] ?>"
                                                        class="form-control" id="edit-nama-pelanggan">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" name="update" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Akhir Modal ubah test -->

                            <!-- Modal Delete test -->
                            <div class="modal fade" id="deleteModal<?= $q_view2_rows["id_pelanggan"] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Transaksi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="hapus_id_pelanggan"
                                                    value="<?= $q_view2_rows["id_pelanggan"] ?>">
                                                <h5 class="text-center text-danger">Anda Yakin ingin menghapus Data Transaksi
                                                    ini?</h5><br>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" name="delete" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Akhir Modal Delete test -->



                            <?php
                        }
                        if ($q_view2_rows["id_pelanggan"] != 3 and $q_view2_rows["deleted"] == 0 and $q_view2_rows["kupon"] < 1) {
                            echo
                                "
                                    <tr>
                                        <td >" . $no++ . "</td>
                                        <td class='edit_nama'> " . $q_view2_rows["nama_pelanggan"] . "</td>    
                                        <td>" . $q_view2_rows["jml_beli"] . "</td>
                                        <td class='edit_harga'>" . $q_view2_rows["no_telp"] . "</td>      
                                        <td>
                                            <a href='lihat_pelanggan.php' class='btn btn-warning view-btn' data-bs-toggle='modal' data-bs-target='#ubahModal" . $q_view2_rows["id_pelanggan"] . "' data-bs-whatever='@mdo'>Ubah</a>
                                            <a href='lihat_pelanggan.php' class='btn btn-danger view-btn' data-bs-toggle='modal' data-bs-target='#deleteModal" . $q_view2_rows["id_pelanggan"] . "' data-bs-whatever='@mdo'>Hapus</a>
                                            <form action='print_kupon.php'  style='display: inline;' method='POST'>
                                                <input type='hidden' name='cetak_id_pelanggan' value='" . $q_view2_rows["id_pelanggan"] . "'>
                                                <button type='Submit' name='print' class='btn btn-primary'>Cetak</button>
                                            </form>
                                        </td>
                                    </tr
                                     ";


                            ?>


                            <!-- Modal ubah test -->
                            <div class="modal fade" id="ubahModal<?= $q_view2_rows["id_pelanggan"] ?>" tabindex="-1"
                                aria-labelledby="ubahModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="ubahModalLabel">Ubah Pelanggan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit-id-pelanggan" class="col-form-label">
                                                        ID Pelanggan
                                                    </label>
                                                    <input type="text" name="id_pelanggan"
                                                        value="<?= $q_view2_rows["id_pelanggan"] ?>" class="form-control"
                                                        id="edit-id-pelanggan" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama-pelanggan" class="col-form-label">
                                                        Nama Pelanggan
                                                    </label>
                                                    <input type="text" name="nama_pelanggan"
                                                        value="<?= $q_view2_rows["nama_pelanggan"] ?>" class="form-control"
                                                        id="edit-nama-pelanggan">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-nama-pelanggan" class="col-form-label">
                                                        No.Telepon
                                                    </label>
                                                    <input type="text" name="no_telp" value="<?= $q_view2_rows["no_telp"] ?>"
                                                        class="form-control" id="edit-nama-pelanggan">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" name="update" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Akhir Modal ubah test -->

                            <!-- Modal Delete test -->
                            <div class="modal fade" id="deleteModal<?= $q_view2_rows["id_pelanggan"] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Transaksi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="hapus_id_pelanggan"
                                                    value="<?= $q_view2_rows["id_pelanggan"] ?>">
                                                <h5 class="text-center text-danger">Anda Yakin ingin menghapus Data Transaksi
                                                    ini?</h5><br>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" name="delete" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Akhir Modal Delete test -->

                        <?php }
                    } ?>

                </tbody>
            </table>
        </div>
    </div>


    <script>
        new DataTable('#example', {
            responsive: true,
            language: {
                emptyTable: 'Tidak ada data di tabel',
                "infoEmpty": "Menunjukkan 0 dari 0 data",
                "info": "Menunjukkan _START_ ke _END_ dari _TOTAL_ data",
                "search":         "Cari:",
                lengthMenu:
                    'Tampilkan <select> ' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">All</option>' +
                    '</select>record'

            }

        });

        // $(document).ready(function () {
        //     $('.view-btn').click(function (e) {
        //         e.preventDefault();

        //         var nama = $(this).closest('tr').find('.edit_nama').text();
        //         var harga = $(this).closest('tr').find('.edit_harga').text();
        //         console.log(nama)
        //         console.log(harga)

        //         document.getElementById('edit-nama-pelanggan').value = harga;
        //         var ganti = document.querySelector('#edit-harga-pelanggan');

        //         ganti.value = 'dio';




        //     });
        // });


    </script>



</body>

</html>