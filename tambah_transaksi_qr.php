<?php
require_once 'include/nav.php';
require 'insert_transaksi.php';

$connection = connect();
if (isset($_POST["submits"])) {
    $id = htmlspecialchars($_POST["idp"]);
    $hash = htmlspecialchars($_POST["hash"]);
    $harga = htmlspecialchars($_POST["tipeg"]);

    $response = transaksiQR($id, $hash, $harga);
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
    if ($response['status'] == "free") {
        echo
            '
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengisian Gratis Gratis</h1>
                </div>
                <div class="modal-body">
                    Apakah anda ingin menggunakan kupon pengisian gratis?
                </div>
                <form action="insert_transaksi.php" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="nama"
                        value="' . $id . '">
                        <input type="hidden" name="harga"
                        value="' . $harga . '">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="tes" class="btn btn-primary">Understood</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

            <script>
            new bootstrap.Modal(document.querySelector("#staticBackdrop")).show();
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
    <title>Depo Air</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="wrap vh-100">
        <?php

        ?>
        <div class="content">
            <div style="height: 90vh;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="box-top d-flex justify-content-start">
                    <a href="" class="transaksi_switch_btn" style="text-decoration:none">
                        <div class="box-top-left" style="background-color: #ffff; color: #62A7D8;">
                            <p>Member Transaksi</p>
                        </div>
                    </a>
                    <a href="tambah_transaksi_guest" class="transaksi_switch_btn" style="text-decoration:none">
                        <div class="box-top-right">
                            <p>Guest Transaksi</p>
                        </div>
                    </a>
                </div>
                <form class="box-bottom d-flex flex-column align-items-center" id="myForm" method="POST"
                    style="padding-left: 0.5em; padding-right: 0.5em;">
                    <div class="box-switch-tambah align-self-start">
                        <a href="tambah_transaksi"><img src="images/back_icon.png" alt="QR Scan Tambah Transaksi"
                                style="width:25px;"></a>
                    </div>
                    <div style="padding: 0.4em; padding-left: 4em; padding-right: 4em;" class="box-bottom-top">
                        <h4>Penambahan Transaksi</h4>
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
                            <label for="tipeg">Harga (Tipe Galon)</label>
                            <select style="" name="tipeg" id="tipeg" class="form-select form-select-sm"
                                aria-label="Default select example">
                                <?php
                                $stmt = $connection->prepare("SELECT * FROM `produk_galon`");
                                $stmt->execute();
                                $q_view2_result = $stmt->get_result();

                                while ($q_view2_rows = mysqli_fetch_array($q_view2_result)) {
                                    if ($q_view2_rows[3] == 1) {

                                    } else {
                                        ?>
                                        <option id="vh" value=<?php echo $q_view2_rows[0] ?>> <?php echo $q_view2_rows[1];
                                    }
                                } ?></option>
                            </select>
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
                                            url: 'display_pelanggan.php',
                                            method: 'post',
                                            data: { id: v_id, hash: v_hash },
                                            success: function (result) {
                                                let res = JSON.parse(result);
                                                if (res.status == "success") {
                                                    $('#namap').val(res.message);
                                                    document.getElementById("idp").value = v_id;
                                                }else{
                                                   
                                                }
                                            }
                                        })
                                    })

                                    // $.ajax({
                                    //     type: "POST",
                                    //     data: { jsVariable: v_nama },
                                    //     success: function (response) {
                                    //         $("#result").html(response);



                                    //     }
                                    // });




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
    <div id="result"></div>
</body>

<?php

?>

</html>