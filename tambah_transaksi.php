<?php

include 'include/nav.php';
require 'insert_transaksi.php';
$connection = connect();



if (isset($_POST["submits"])) {
    $nama = htmlspecialchars($_POST["namap"]);
    $harga = htmlspecialchars($_POST["tipeg"]);
    $response = transaksiPelanggan($nama, $harga);
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengisian Gratis</h1>
                </div>
                <div class="modal-body">
                    Apakah anda ingin menggunakan kupon pengisian gratis?
                </div>
                <form action="insert_transaksi.php" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="nama"
                        value="'.$nama.'">
                        <input type="hidden" name="harga"
                        value="'.$harga.'">
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


    // BACKUP LAMA
//     $q_pelanggan = "SELECT * FROM `pelanggan`";
//     $qp_result = mysqli_query($connection , $q_pelanggan);
//     $nama_pelanggan = $_POST["namap"];
//     $galon = $_POST["tipeg"];
//     if ($nama_pelanggan == "Nama" || $galon == "Harga"){
//         echo
//             "
//             <script>
//             Swal.fire(
//                 'Error',
//                 'Data salah',
//                 'error'
//               )
//             </script>
//             ";
//     }
//     else{
//         $add_transaksi = "INSERT INTO transaksi(id_pelanggan, id_galon) VALUES('$nama_pelanggan','$galon')";
//         if ($galon == 1 and $nama_pelanggan != 3) {
//             $add_jml = "UPDATE pelanggan set jml_beli = jml_beli + 1 WHERE id_pelanggan = '$nama_pelanggan'";
//             mysqli_query($connection, $add_jml);
//             $k_result = mysqli_fetch_assoc($qp_result);
//             if ($k_result['jml_beli'] % 6 == 0 ){
//                 $add_transaksi_kupon = "INSERT INTO transaksi(id_pelanggan, id_galon, p_kupon) VALUES('$nama_pelanggan','$galon', 1)";
//                 mysqli_query($connection, $add_transaksi_kupon);
//                 $add_kupon = "UPDATE pelanggan set kupon = kupon + 1 WHERE id_pelanggan = '$nama_pelanggan'";
//                 mysqli_query($connection, $add_kupon);
//                 echo
//                 "
//                 <script>
//                     Swal.fire(
//                         'Selamat',
//                         'Gratis Pembelian 1',
//                         'info'
//                     )
//                 </script>
//                 ";

    //             }else{
//                 mysqli_query($connection, $add_transaksi);
//                 echo
//                 "
//                 <script>
//                 Swal.fire(
//                     'Berhasil!',
//                     'Data telah masuk',
//                     'success'
//                 )
//             </script>
//                 ";


    //             }

    //         }elseif ($galon != 1){
//             $add_transaksi_guest = "INSERT INTO transaksi(id_pelanggan, id_galon) VALUES(3,'$galon')";
//             $add_jml_guest = "UPDATE pelanggan set jml_beli = jml_beli + 1 WHERE id_pelanggan = 3";
//             mysqli_query($connection, $add_jml_guest);
//             mysqli_query($connection, $add_transaksi_guest);
//             echo
//             "
//             <script>
//             Swal.fire(
//                 'Berhasil!',
//                 'Data telah masuk3 ',
//                 'success'
//             )
//             </script>

    //             ";


    //         }elseif ($nama_pelanggan == 3){
//             $add_transaksi_guest = "INSERT INTO transaksi(id_pelanggan, id_galon) VALUES(3,'$galon')";
//             $add_jml_guest = "UPDATE pelanggan set jml_beli = jml_beli + 1 WHERE id_pelanggan = 3";
//             mysqli_query($connection, $add_jml_guest);
//             mysqli_query($connection, $add_transaksi_guest);
//             echo
//             "
//             <script>
//                 Swal.fire(
//                 'Berhasil!',
//                 'Data telah masuk5e',
//                 'success'
//             )
//             </script>
//             ";


    //         }else {
//             mysqli_query($connection, $add_transaksi);
//             echo
//             "
//             <script>
//             Swal.fire(
//                 'Berhasil!',
//                 'Data telah masuk4',
//                 'success'
//             )
//             </script>
//             ";

    //         }



    // }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depo Air</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
</head>

<body>
    <div class="wrap vh-100">
        <?php

        ?>

        <div class="content">
            <div style="height: 80vh;" class="d-flex flex-column justify-content-center align-items-center">
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
                    <div class="box-switch-tambah align-self-end">
                        <a href="tambah_transaksi_qr"><img src="images/qrcodescan_button.png"
                                alt="QR Scan Tambah Transaksi" style="width:40px;"></a>
                    </div>
                    <div style="padding: 0.4em; padding-left: 4em; padding-right: 4em;" class="box-bottom-top">
                        <h4>Penambahan Transaksi</h4>
                    </div>
                    <div style="gap: 0.75em;" class="box-bottom-bottom d-flex flex-wrap-reverse justify-content-center">
                        <div class="box-bottom-bottom-left d-flex flex-column justify-content-center">
                            <label for="namap">Nama Pelanggan</label>
                            <select name="namap" id="select_box" class="form-select form-select-sm" id="select_box" style="padding: 0rem 14rem 0rem 0rem !important;">
                                <option>Nama</option>
                                <?php
                                $query1 = "SELECT * FROM `pelanggan`";
                                $qresult1 = mysqli_query($connection, $query1);

                                while ($row1 = mysqli_fetch_array($qresult1)) {
                                    if ($row1[7] == "1" OR $row1[1] == "Guest"){

                                    }
                                    else{
                                    ?>
                                    <option id="vn" value=<?php echo $row1[0] ?>> <?php echo $row1[1];
                                    
                                }} ?></option>
                            </select>
                            <label for="tipeg">Harga (Tipe Galon)</label>
                            <select style="" name="tipeg" id="tipeg" class="form-select form-select-sm"
                                aria-label="Default select example">
                                <option>Harga</option>
                                <?php
                                $query2 = "SELECT * FROM `produk_galon`";
                                $qresult2 = mysqli_query($connection, $query2);

                                while ($row2 = mysqli_fetch_array($qresult2)) {
                                    if ($row2[3] == 1){

                                    }
                                    else{
                                    ?>
                                    <option id="vh" value=<?php echo $row2[0] ?>> <?php echo $row2[1];
                                }} ?></option>
                            </select>
                            <div class="submits align-self-center">
                                <button class="btn btn-primary" type="submit" name="submits">Submit</button>
                            </div>
                        </div>
                        <div class="box-bottom-bottom-right align-self-center">
                            <img src="images/member_transaksi_tambah.png" alt="Member Penambahan Transaksi"
                                style="width:120px;">
                            <!-- <script type="text/javascript">
                                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                                scanner.addListener('scan', function (content) {
                                    console.log(content);
                                    document.getElementById('text').value=content;
                                    let kup = content;
                                    let sc = "%";
                                    let idx_id = kup.search(sc);
                                    let v_id =  kup.substring(0, idx_id);
                                    let v_nama = kup.substring(idx_id + 1); 

                                    var jsVariable= "Hello, PHP!";

                                    console.log(v_id);
                                    console.log(v_nama);

                                    let hh = "19 L"
                                    
                                    document.getElementById("vn").value=v_nama;
                                    document.getElementById("vh").value=hh;

                                   
                                   
                                   

                                    // $.ajax({
                                    //     type: "POST",
                                    //     data: { jsVariable: v_nama },
                                    //     success: function (response) {
                                    //         $("#result").html(response);
                                           

                                            
                                    //     }
                                    // });
 



                                });
                                Instascan.Camera.getCameras().then(function (cameras){
                                    if (cameras.length > 0) {
                                    scanner.start(cameras[0]);
                                    } else {
                                    console.error('No cameras found.');
                                    }
                                }).catch(function (e) {
                                    console.error(e);
                                });
                            </script> -->

                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
    <div id="result"></div>

    <script>

    var select_box_element = document.querySelector('#select_box');

    dselect(select_box_element, {
        search: true
    });

</script>

</body>



<?php

?>

</html>