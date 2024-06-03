<?php
require_once 'include/nav.php';
require 'include/crud_galon.php';
$connection = connect();

if (isset($_POST["delete"])) {
    $id_galon = htmlspecialchars($_POST["hapus_id_galon"]);
    $response = deleteGalon($id_galon);

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


}

if (isset($_POST["update"])) {
    $id_galon = htmlspecialchars($_POST["edit_id_galon"]);
    $tipe_galon = htmlspecialchars($_POST["edit_tipe_galon"]);
    $harga_galon = htmlspecialchars($_POST["edit_harga_galon"]);
    $response = updateGalon($id_galon, $tipe_galon, $harga_galon);

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

if (isset($_POST["create"])) {
    $tipe_galon = htmlspecialchars($_POST["tambah_tipe_galon"]);
    $harga_galon = htmlspecialchars($_POST["tambah_harga_galon"]);
    $response = tambahGalon($tipe_galon, $harga_galon);

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
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <link href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.css" rel="stylesheet">
    <title>Depo air</title>
    <script>

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


</head>

<body>
    <div class="container-fluid px-5 py-4">
        <h3>Daftar Galon</h3>
    </div>

    <div class="container-fluid px-5 py-3">

        <div class="table-wrapper"
            style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;border-radius: 8px ;padding: 1em 3em 1em 3em;">
            <a class='btn btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#tambahModal'
                data-bs-whatever='@mdo'>+ Tambah Galon</a>
            <table id="example" class="display responsive" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; ">
                <thead style="margin-top = 5px;">
                    <tr>
                        <th>No.</th>
                        <th>Tipe Galon</th>
                        <th>Harga Galon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $stmt = $connection->prepare("SELECT * FROM `produk_galon`");
                    $stmt->execute();
                    $q_view2_result = $stmt->get_result();

                    while ($q_view2_rows = mysqli_fetch_array($q_view2_result)) {
                        if ($q_view2_rows["deleted"] == 1) {

                        } else {
                            echo
                                "
                                    <tr>
                                        <td >" . $no++ . "</td>
                                        <td class='edit_nama'> " . $q_view2_rows["tipe_galon"] . "</td>    
                                        <td>" . $q_view2_rows["harga_galon"] . "</td> 
                                        <td>
                                            <a href='lihat_pelanggan.php' class='btn btn-warning view-btn' data-bs-toggle='modal' data-bs-target='#ubahModal" . $q_view2_rows["id_galon"] . "' data-bs-whatever='@mdo'>Ubah</a>
                                            <a href='lihat_pelanggan.php' class='btn btn-danger view-btn' data-bs-toggle='modal' data-bs-target='#deleteModal" . $q_view2_rows["id_galon"] . "' data-bs-whatever='@mdo'>Hapus</a>
                                        </td>
                                    </tr
                                     ";


                            ?>

                            <!-- Modal ubah test -->
                            <div class="modal fade" id="ubahModal<?= $q_view2_rows["id_galon"] ?>" tabindex="-1"
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
                                                    <label for="edit-id-galon" class="col-form-label">
                                                        ID Galon
                                                    </label>
                                                    <input type="text" name="edit_id_galon"
                                                        value="<?= $q_view2_rows["id_galon"] ?>" class="form-control"
                                                        id="edit-id-galon" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-tipe-galon" class="col-form-label">
                                                        Tipe Galon
                                                    </label>
                                                    <input type="text" name="edit_tipe_galon"
                                                        value="<?= $q_view2_rows["tipe_galon"] ?>" class="form-control"
                                                        id="edit-tipe-galon">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-harga-galon" class="col-form-label">
                                                        Harga Galon
                                                    </label>
                                                    <input type="text" name="edit_harga_galon"
                                                        value="<?= $q_view2_rows["harga_galon"] ?>" class="form-control"
                                                        id="edit-harga-galon">
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
                            <div class="modal fade" id="deleteModal<?= $q_view2_rows["id_galon"] ?>" tabindex="-1"
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
                                                <input type="hidden" name="hapus_id_galon"
                                                    value="<?= $q_view2_rows["id_galon"] ?>">
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

                    <!-- Modal Tambah test -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ubahModalLabel">Tambah Galon</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="tambah-tipe-galon" class="col-form-label">
                                                Tipe Galon
                                            </label>
                                            <input type="text" name="tambah_tipe_galon" class="form-control"
                                                id="tambah-tipe-galon">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tambah-harga-galon" class="col-form-label">
                                                Harga Galon
                                            </label>
                                            <input type="text" maxlength="6" name="tambah_harga_galon"
                                                class="form-control" id="tambah-harga-galon">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="Submit" name="create" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Akhir Modal Tambah test -->

                </tbody>
            </table>
        </div>
    </div>


    <script>
        new DataTable('#example', {
            responsive: true,
            lengthChange: false,
            searching: false,
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