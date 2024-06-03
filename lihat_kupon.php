<?php
require_once 'include/nav.php';
require 'include/crud_kupon.php';
$connection = connect();

if (isset($_POST["delete"])) {
    $id_kupon = htmlspecialchars($_POST["hapus_id_kupon"]);
    $response = deleteKupon($id_kupon);

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
    $id_galon = htmlspecialchars($_POST["tipe_galon"]);
    $kupon_pembelian = htmlspecialchars($_POST["kupon_pembelian"]);
    $response = tambahKupon($id_galon, $kupon_pembelian);

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
        <h3>Daftar Kupon</h3>
    </div>

    <div class="container-fluid px-5 py-3">

        <div class="table-wrapper"
            style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;border-radius: 8px ;padding: 1em 3em 1em 3em; min-height: 50vh;">
            <a class='btn btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#tambahModal'
                data-bs-whatever='@mdo'>+ Tambah Kupon</a>

            <div class="table-kupon">
                <?php
                $stmt = $connection->prepare("SELECT id_kupon, produk_galon.id_galon, tipe_galon, p_gratis, kupon.date from kupon INNER JOIN produk_galon ON kupon.id_galon = produk_galon.id_galon");
                $stmt->execute();
                $q_view2_result = $stmt->get_result();

                while ($q_view2_rows = mysqli_fetch_array($q_view2_result)) {

                    ?>
                    <div class="coupon">
                        <div class="left">
                            <div>Kupon Gratis</div>
                        </div>
                        <div class="center">
                            <div>
                                <h2>Pembelian
                                    <?= $q_view2_rows["p_gratis"] ?> (
                                    <?= $q_view2_rows["tipe_galon"] ?>)
                                </h2>
                                <h3>Gratis 1 Pengisian</h3>
                            </div>
                        </div>
                        <div class="kanan">
                            <div>
                                <a data-bs-toggle='modal' data-bs-target='#deleteModal<?=$q_view2_rows["id_kupon"]?>' data-bs-whatever='@mdo'><img
                                        src="images/edit_icon.svg" alt="edit" class="edit_icon"></a>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Modal Delete test -->
                    <div class="modal fade" id='deleteModal<?=$q_view2_rows["id_kupon"]?>' tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Transaksi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="hapus_id_kupon" value="<?= $q_view2_rows["id_kupon"] ?>">
                                        <h5 class="text-center text-danger">Anda Yakin ingin menghapus Data Kupon <?= $q_view2_rows["id_kupon"] ?>
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

                <?php } ?>
            </div>

            <!-- Modal Tambah test -->
            <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ubahModalLabel">Tambah Kupon</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kupon-tipe-galon" class="col-form-label">
                                        Tipe Galon
                                    </label>
                                    <select class="form-select" name="tipe_galon">
                                        <?php
                                        $option_harga = $connection->prepare("SELECT p.* FROM produk_galon p LEFT JOIN kupon k ON p.id_galon = k.id_galon WHERE k.id_kupon IS NULL AND p.deleted = 0");
                                        $option_harga->execute();
                                        $option_harga_result = $option_harga->get_result();

                                        while ($option_harga_row = mysqli_fetch_array($option_harga_result)) {
                                            ?>
                                            <option value="<?php echo $option_harga_row[0] ?>">
                                                <?php echo htmlspecialchars($option_harga_row[1]) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="kupon-pembelian" class="col-form-label">
                                        Setiap Pembelian
                                    </label>
                                    <input type="text" maxlength="3" name="kupon_pembelian" class="form-control"
                                        id="tambah-harga-galon">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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



</body>

</html>