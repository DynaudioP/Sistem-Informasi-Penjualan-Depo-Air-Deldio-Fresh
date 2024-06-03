<?php
require_once 'include/nav_home.php';
require 'include/checker_pelanggan.php';

$connection = connect();

if (isset($_GET['id']) AND isset($_GET['hash'])){
    $id = htmlspecialchars($_GET['id']);
    $hash = htmlspecialchars($_GET["hash"]);
    $response = cekKupon($id, $hash);

    if ($response['status'] == "success") {
        echo
            '
            <div class="modal fade" id="kuponModal" tabindex="-1" aria-labelledby="kuponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="kuponModalLabel">Kupon anda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                    <input type="text" name="id_pelanggan" value="' . $response['message'] . '" id="id_pelanggan"
                                hidden>
                        <div class="mb-3">
                            <label for="promo-kupon-pelanggan" class="col-form-label">
                                Promo yang tersedia <span data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Berikut merupakan promo yang tersedia"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <select class="form-select" id="promoid" name="promo_pelanggan"
                                aria-label="Default select example">
                                <label for="promo-select-pelanggan" class="col-form-label">Harga</label>
                                <option>Pilih promo</option>
                                ';
        $stmt = $connection->prepare("SELECT id_kupon, produk_galon.id_galon, tipe_galon, p_gratis, kupon.date from kupon INNER JOIN produk_galon ON kupon.id_galon = produk_galon.id_galon");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($kupon_result = $result->fetch_assoc()) {
            echo '                                    
                                    <option value="' . $kupon_result["id_kupon"] . '"> Pembelian
                                        ' . $kupon_result["p_gratis"] . ' (' . $kupon_result["tipe_galon"] . ') Gratis 1
                                        Pengisian
                                    </option>
                                ';
        }
        ;
        echo '
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pembelian-pelanggan" class="col-form-label">
                                Pembelian yang dibutuhkan <span data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-title="Jumlah dibawah menunjukkan jumlah yang anda butuhkan untuk mendapatkan gratis pengisian pada promo yang tersedia"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <?php
                            
                            ?>
                            <input type="text" name="pembelian_pelanggan" value="" class="form-control"
                                id="pembelian-pelanggan" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="kupon-pelanggan" class="col-form-label">
                                Kupon yang dimiliki <span data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-title="Berikut merupakan jumlah kupon yang anda miliki/simpan yang dapat digunakan untuk mendapatkan gratis pengisian"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <input type="text" name="kupon_pelanggan" value="" class="form-control" id="kupon-pelanggan"
                                disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

            <script>
            new bootstrap.Modal(document.querySelector("#kuponModal")).show();
            </script>
            
           

            ';

    }
}


if (isset($_POST["submits"])) {
    $id = htmlspecialchars($_POST["idp"]);
    $hash = htmlspecialchars($_POST["hash"]);
    $response = cekKupon($id, $hash);

    if ($response['status'] == "success") {
        echo
            '
            <div class="modal fade" id="kuponModal" tabindex="-1" aria-labelledby="kuponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="kuponModalLabel">Kupon anda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                    <input type="text" name="id_pelanggan" value="' . $response['message'] . '" id="id_pelanggan"
                                hidden>
                        <div class="mb-3">
                            <label for="promo-kupon-pelanggan" class="col-form-label">
                                Promo yang tersedia <span data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Berikut merupakan promo yang tersedia"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <select class="form-select" id="promoid" name="promo_pelanggan"
                                aria-label="Default select example">
                                <label for="promo-select-pelanggan" class="col-form-label">Harga</label>
                                <option>Pilih promo</option>
                                ';
        $stmt = $connection->prepare("SELECT id_kupon, produk_galon.id_galon, tipe_galon, p_gratis, kupon.date from kupon INNER JOIN produk_galon ON kupon.id_galon = produk_galon.id_galon");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($kupon_result = $result->fetch_assoc()) {
            echo '                                    
                                    <option value="' . $kupon_result["id_kupon"] . '"> Pembelian
                                        ' . $kupon_result["p_gratis"] . ' (' . $kupon_result["tipe_galon"] . ') Gratis 1
                                        Pengisian
                                    </option>
                                ';
        }
        ;
        echo '
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pembelian-pelanggan" class="col-form-label">
                                Pembelian yang dibutuhkan <span data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-title="Jumlah dibawah menunjukkan jumlah yang anda butuhkan untuk mendapatkan gratis pengisian pada promo yang tersedia"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <?php
                            
                            ?>
                            <input type="text" name="pembelian_pelanggan" value="" class="form-control"
                                id="pembelian-pelanggan" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="kupon-pelanggan" class="col-form-label">
                                Kupon yang dimiliki <span data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-title="Berikut merupakan jumlah kupon yang anda miliki/simpan yang dapat digunakan untuk mendapatkan gratis pengisian"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <input type="text" name="kupon_pelanggan" value="" class="form-control" id="kupon-pelanggan"
                                disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

            <script>
            new bootstrap.Modal(document.querySelector("#kuponModal")).show();
            </script>
            
           

            ';

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/styles.css">
    <title>Depo Air</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<style>
    img {
        max-width: 100%;
        height: auto;

    }

    .table-kupon {
        margin: 1em 0em 0em 0em;
        display: flex;
        gap: 1.2em;
        flex-wrap: wrap
    }

    .coupon {
        width: 320px;
        height: 170px;
        border-radius: 10px;
        overflow: hidden;
        filter: drop-shadow(0 3px 2px rgba(0, 0, 0, 0.5));
        display: flex;
        align-items: stretch;
        color: #000;
    }

    .coupon::before,
    .coupon::after {
        content: '';
        position: absolute;
        top: 0;
        width: 50%;
        height: 100%;
        z-index: -1;
    }

    .coupon::before {
        left: 0;
        background-image: radial-gradient(circle at 0 50%, transparent 25px, #fff 26px);
    }

    .coupon::after {
        right: 0;
        background-image: radial-gradient(circle at 0 0, transparent 0px, #fff 0px);
    }

    .coupon>div {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .left {
        width: 80px;
        border-right: 2px dashed rgba(0, 0, 0, 0.15);
    }

    .left div {
        transform: rotate(-90deg);
        white-space: nowrap;
        color: rgb(16, 163, 221);
        font-weight: bold;
    }

    .center {
        flex-grow: 1;
        text-align: center;
    }

    .right {
        width: 120px;
        background-image: radial-gradient(circle at 100% 50%, transparent 25px, #fff 26px);
    }

    .right div {
        font-family: 'Libre Barcode 128 Text', cursive;
        font-size: 2.5rem;
        transform: rotate(-90deg);
    }


    .center h2 {
        font-weight: bold;
        background-color: rgb(16, 163, 221);
        color: #fff;
        padding: 1.5px 3px;
        border-radius: 5px;
        font-size: clamp(1rem, 2.2vw, 1.2rem);
        white-space: nowrap;
    }

    .center h3 {
        font-weight: bold;
        color: rgb(16, 163, 221);
        font-size: clamp(1rem, 2.2vw, 1.2rem);
    }

    .center small {
        font-size: 0.625rem;
        font-weight: 600;
        letter-spacing: 2px;
    }

    .kanan {
        align-self: start;
        padding: 1em;
    }

    .edit_icon {
        width: 20px;
        color: white;
    }

    .edit_icon {
        width: 20px;
    }

    .edit_icon {
        width: 20px;
        transition: transform 0.25s;
    }

    .edit_icon:hover {
        cursor: pointer;
        transform: scale(1.25);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }



    @media only screen and (max-width: 480px) {
        .left {
            display: none !important;
        }

        .kanan {
            padding: 0em;
            margin: 0.5em 0.5em 0em 0em;
        }

        .center div {
            transform: rotate(-90deg);
            height: 1em;
        }

    }

    /* End Lihat Kupon */
</style>


<body>
    <div class="wrap vh-100">
        <?php

        ?>
        <div class="content">
            <div style="height: 90vh;" class="d-flex flex-column justify-content-center align-items-center">
                <form autocomplete="off" class="box-bottom d-flex flex-column align-items-center" id="myForm"
                    method="POST" style="padding-left: 0.5em; padding-right: 0.5em;">
                    <div class="box-switch-tambah align-self-start">
                        <a href="beranda.php"><img src="images/back_icon.png" alt="QR Scan Tambah Transaksi"
                                style="width:25px;"></a>
                    </div>
                    <div style="padding: 0.4em; padding-left: 4em; padding-right: 4em;" class="box-bottom-top">
                        <h4>Cek Kupon Pelanggan</h4>
                    </div>
                    <div style="gap: 0.75em;" class="box-bottom-bottom d-flex flex-wrap-reverse justify-content-center">
                        <div class="box-bottom-bottom-left d-flex flex-column justify-content-center"
                            style="width: 70%;">
                            <input type="hidden" name="hash" id="hash">
                            <label for="idp">ID Pelanggan</label>
                            <input style="caret-color: transparent;" name="idp" id="idp"
                                class="form-control form-control-sm" aria-label="Default select example" value=""
                                onkeydown="event.preventDefault()" required>
                            <label for="namap">Nama Pelanggan</label>
                            <input style="caret-color: transparent;" type="text" autocomplete="off" name="namap"
                                id="namap" class="form-control form-control-sm" aria-label="Default select example"
                                value="" onkeydown="event.preventDefault()" required>

                            <div class="submits align-self-center">
                                <button class="btn btn-primary" type="submit" name="submits">Submit</button>
                            </div>
                        </div>
                        <div class="box-bottom-bottom-right align-self-center">
                            <video id="preview"
                                style="transform: rotateY(180deg); height: 140px; width: 150px;border-radius: 5px; object-fit: cover;"></video>

                            <script type="text/javascript">
                                let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: true });
                                scanner.addListener('scan', function (content) {

                                    let kup = content;
                                    // let sc = "&";
                                    // let sd = "%";
                                    // let idx_id = kup.search(sc);
                                    // let idx_ids = kup.search(sd);
                                    // idx_ids++;
                                    // let v_id = kup.substring(idx_ids, idx_id);
                                    // let v_hash = kup.substring(idx_id + 1);

                                    let position = kup.search("id=");
                                    let position1 = kup.search("&hash=");
                                    position = position + 3;
                                    let v_id = kup.substring(position, position1);
                                    let v_hash = kup.substring(position1 + 6);

                                    console.log(v_id)
                                    console.log(v_hash)
                                    console.log(kup)

                                    var jsVariable = "Hello, PHP!";

                                    let hh = "19 L"



                                    document.getElementById("hash").value = v_hash;

                                    $(document).ready(function () {
                                        $.ajax({
                                            url: 'checker.php',
                                            method: 'post',
                                            data: { id: v_id, hash: v_hash },
                                            success: function (result) {
                                                let res = JSON.parse(result);
                                                if (res.status == "success") {
                                                    $('#namap').val(res.message);
                                                    document.getElementById("idp").value = v_id;
                                                } else {

                                                }
                                            }

                                        })
                                    })

                                });
                                Instascan.Camera.getCameras().then(function (cameras) {
                                    //If a camera is detected
                                    if (cameras.length > 0) {
                                        //If the user has a rear/back camera
                                        if (cameras[1]) {
                                            //use that by default
                                            scanner.start(cameras[1]);
                                        } else {
                                            //else use front camera
                                            scanner.start(cameras[0]);
                                        }
                                    } else {
                                        //if no cameras are detected give error
                                        console.error('No cameras found.');
                                    }
                                }).catch(function (e) {
                                    console.error(e);
                                });   
                            </script>

                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- <span data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="This top tooltip is themed via CSS variables.">
        <a href='' class='btn btn-warning view-btn' data-bs-toggle='modal' data-bs-target='#kuponModal'
            data-bs-whatever='@mdo'>Ubah</a>
    </span> -->


    <!-- tes aja -->
    <!-- <div class="modal fade" id="kuponModal" tabindex="-1" aria-labelledby="kuponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="kuponModalLabel">Kupon anda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="promo-kupon-pelanggan" class="col-form-label">
                                Promo yang tersedia <span data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Berikut merupakan promo yang tersedia"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <select class="form-select" id="promoid" name="promo_pelanggan"
                                aria-label="Default select example">
                                <label for="promo-select-pelanggan" class="col-form-label">Harga</label>
                                <?php
                                $stmt = $connection->prepare("SELECT id_kupon, produk_galon.id_galon, tipe_galon, p_gratis, kupon.date from kupon INNER JOIN produk_galon ON kupon.id_galon = produk_galon.id_galon");
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($kupon_result = $result->fetch_assoc()) {


                                    ?>
                                    <option value="<?= $kupon_result['id_kupon'] ?>"> Pembelian
                                        <?= $kupon_result['p_gratis'] ?> (<?= $kupon_result['tipe_galon'] ?>) Gratis 1
                                        Pengisian
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-pembelian-pelanggan" class="col-form-label">
                                Pembelian yang dibutuhkan <span data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-title="Jumlah dibawah menunjukkan jumlah anda yang dibutuhkan untuk mendapatkan gratis pengisian pada promo yang tersedia"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <?php

                            ?>
                            <input type="text" name="pembelian_pelanggan" value="" class="form-control"
                                id="pembelian-pelanggan" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="kupon-pelanggan" class="col-form-label">
                                Kupon yang dimiliki <span data-bs-toggle="tooltip" data-bs-placement="right"
                                    data-bs-title="Berikut merupakan jumlah kupon yang anda miliki/simpan yang dapat digunakan untuk mendapatkan gratis pengisian"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="gray"
                                            d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                                    </svg></span>
                            </label>
                            <input type="text" name="kupon_pelanggan" value="" class="form-control" id="kupon-pelanggan"
                                readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!--  -->

    <section class="promo"
        style="background-image: linear-gradient(to right top, #86a8e7, #7ba6ec, #6da3f0, #5ea1f5, #499ff9, #3aa3fa, #26a6fb, #00aafb, #00b3f6, #00bbef, #29c2e7, #4ac8df);; color: #fff;">
        <div class="promo-title d-flex justify-content-center align-items-center" style="padding-top: 4em;">
            <h4 class="fw-bold">Promo yang tersedia</h4>
        </div>
        <div class="promo-content">
            <div class="container-fluid px-5 py-3">

                <div class="table-wrapper" style="border-radius: 8px ;padding: 1em 3em 1em 3em; min-height: 50vh;">


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

                            </div>



                        <?php } ?>
                    </div>


                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <footer class="d-flex align-items-center text-center"
        style="box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;">
        <div class="container ">

            <div class="row d-flex justify-content-between">
                <div class="col-12 col-md-3 mt-3">
                    <p>Copyright &copy; 2024 - Deldio Fresh</p>
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="red"
                                d="M19 9A7 7 0 1 0 5 9c0 1.387.409 2.677 1.105 3.765h-.008L12 22l5.903-9.235h-.007A6.971 6.971 0 0 0 19 9m-7 3a3 3 0 1 1 0-6a3 3 0 0 1 0 6" />
                        </svg>Jl. Juanda 8 No.3, Air Hitam, Kec. Samarinda Ulu, Kota Samarinda, Kalimantan Timur
                        75124</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function () {
            $('#promoid').change(function () {
                var id_kupon = $('#promoid').val();
                var id_pelanggan = $('#id_pelanggan').val();

                $.ajax({
                    url: 'promo.php',
                    method: 'post',
                    data: { id_pelanggan: id_pelanggan, id_kupon: id_kupon },
                    success: function (result) {

                        let res = JSON.parse(result);
                        if (res.status == "success") {
                            $('#pembelian-pelanggan').val(res.jumlah);
                            $('#kupon-pelanggan').val(res.kupon);
                        }
                        else {

                        }
                    }

                })
            });
        });
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="js/main.js"></script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>


</body>

</html>