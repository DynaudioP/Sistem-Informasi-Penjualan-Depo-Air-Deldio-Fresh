<?php
require_once 'include/nav.php';
$connection = connect();

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

    <style>
        .d-flex {
            gap: 0px;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-5 py-4">
        <h3>Halo,
            <?php echo $_SESSION["user"] ?>
        </h3>
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

    <div class="container-fluid px-5">
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-12 col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <canvas id="myCharts"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid px-5">
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-12 col-md-8">
                <div class="card mt-3 py-1">
                    <div class="card-body">

                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Perbandingan Transaksi Galon</h4>
                        <canvas id="myChart4"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["<?= date('Y-m-d', strtotime('-6 day')) ?>", "<?= date('Y-m-d', strtotime('-5 day')) ?>", "<?= date('Y-m-d', strtotime('-4 day')) ?>", "<?= date('Y-m-d', strtotime('-3 day')) ?>", "<?= date('Y-m-d', strtotime('-2 day')) ?>", "<?= date('Y-m-d', strtotime('-1 day')) ?>", "<?= date('Y-m-d') ?>"],
                datasets: [{
                    label: 'Pendapatan Penjualan Harian(7 Hari)',
                    data: [
                        <?php
                        $date = date('Y-m-d', strtotime('-6 Day'));
                        $q_cont1 = $connection->prepare("SELECT id_transaksi, transaksi.date, SUM(harga_galon) as penjualan_today from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date = '{$date}';");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-5 Day'));
                        $q_cont1 = $connection->prepare("SELECT id_transaksi, transaksi.date, SUM(harga_galon) as penjualan_today from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date = '{$date}';");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-4 Day'));
                        $q_cont1 = $connection->prepare("SELECT id_transaksi, transaksi.date, SUM(harga_galon) as penjualan_today from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date = '{$date}';");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-3 Day'));
                        $q_cont1 = $connection->prepare("SELECT id_transaksi, transaksi.date, SUM(harga_galon) as penjualan_today from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date = '{$date}';");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-2 Day'));
                        $q_cont1 = $connection->prepare("SELECT id_transaksi, transaksi.date, SUM(harga_galon) as penjualan_today from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date = '{$date}';");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-1 Day'));
                        $q_cont1 = $connection->prepare("SELECT id_transaksi, transaksi.date, SUM(harga_galon) as penjualan_today from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date = '{$date}';");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d');
                        $q_cont1 = $connection->prepare("SELECT id_transaksi, transaksi.date, SUM(harga_galon) as penjualan_today from transaksi INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan INNER JOIN produk_galon on transaksi.id_galon = produk_galon.id_galon WHERE transaksi.date = '{$date}';");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctxs = document.getElementById('myCharts');

        new Chart(ctxs, {
            type: 'bar',
            data: {
                labels: ["<?= date('F', strtotime('-6 month')) ?>", "<?= date('F', strtotime('-5 month')) ?>", "<?= date('F', strtotime('-4 month')) ?>", "<?= date('F', strtotime('-3 month')) ?>", "<?= date('F', strtotime('-2 month')) ?>", "<?= date('F', strtotime('-1 month')) ?>", "<?= date('F') ?>"],
                datasets: [{
                    label: 'Transaksi penjualan bulan ini',
                    data: [<?php
                    $date = date('m', strtotime('-5 month'));
                    $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE MONTH(transaksi.date) = '{$date}'");
                    $q_cont1->execute();
                    $q_cont1_result = $q_cont1->get_result();

                    while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                        echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                    }
                    ;
                    ?>,
                        <?php
                        $date = date('m', strtotime('-5 month'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE MONTH(transaksi.date) = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('m', strtotime('-4 month'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE MONTH(transaksi.date) = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('m', strtotime('-3 month'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE MONTH(transaksi.date) = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('m', strtotime('-2 month'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE MONTH(transaksi.date) = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('m', strtotime('-1 month'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE MONTH(transaksi.date) = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('m');
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE MONTH(transaksi.date) = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx3 = document.getElementById('myChart3');

        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ["<?= date('Y-m-d', strtotime('-6 day')) ?>", "<?= date('Y-m-d', strtotime('-5 day')) ?>", "<?= date('Y-m-d', strtotime('-4 day')) ?>", "<?= date('Y-m-d', strtotime('-3 day')) ?>", "<?= date('Y-m-d', strtotime('-2 day')) ?>", "<?= date('Y-m-d', strtotime('-1 day')) ?>", "<?= date('Y-m-d') ?>"],
                datasets: [{
                    label: 'Transaksi Penjualan (Jumlah)',
                    data: [
                        <?php
                        $date = date('Y-m-d', strtotime('-6 Day'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE transaksi.date = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-5 Day'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE transaksi.date = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-4 Day'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE transaksi.date = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-3 Day'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE transaksi.date = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-2 Day'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE transaksi.date = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d', strtotime('-1 Day'));
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE transaksi.date = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $date = date('Y-m-d');
                        $q_cont1 = $connection->prepare("SELECT COUNT(*) AS 'penjualan_today' FROM transaksi WHERE transaksi.date = '{$date}'");
                        $q_cont1->execute();
                        $q_cont1_result = $q_cont1->get_result();

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_cont1_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["penjualan_today"]) . '
                        ';
                        }
                        ;
                        ?>],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx4 = document.getElementById('myChart4');

        new Chart(ctx4, {
            type: 'doughnut',
            data: {
                <?php
                $q_galon = $connection->prepare("SELECT * FROM `produk_galon` LIMIT 3");
                $q_galon->execute();
                $q_galon_result = $q_galon->get_result();

                $nama_galon = array();
                $id_galon = array();
                $harga_galon = array();

                while ($q_galon_fetch = $q_galon_result->fetch_assoc()) {
                    array_push($nama_galon , $q_galon_fetch['tipe_galon']);
                    array_push($id_galon, $q_galon_fetch['id_galon']);
                    array_push($harga_galon, $q_galon_fetch['harga_galon']);
                }

                
                
                
                ?>
                labels: ["<?=$nama_galon[0]?> (Rp.<?=$harga_galon[0]?>)", "<?=$nama_galon[1]?> (Rp.<?=$harga_galon[1]?>)","<?=$nama_galon[2]?> (Rp.<?=$harga_galon[2]?>)"],
                datasets: [{
                    label: '',
                    data: [
                        <?php
                        $q_perbandingan = $connection->prepare("SELECT COUNT( CASE WHEN transaksi.id_galon = $id_galon[0] THEN 1 END ) AS galon1,
                        COUNT( CASE WHEN transaksi.id_galon = $id_galon[1] THEN 1 END ) AS galon2,
                        COUNT( CASE WHEN transaksi.id_galon = $id_galon[2] THEN 1 END ) AS galon3
                        FROM transaksi");
                        $q_perbandingan->execute();
                        $q_perbandingan_result = $q_perbandingan->get_result();
        

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_perbandingan_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["galon1"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $q_perbandingan = $connection->prepare("SELECT COUNT( CASE WHEN transaksi.id_galon = $id_galon[0] THEN 1 END ) AS galon1,
                        COUNT( CASE WHEN transaksi.id_galon = $id_galon[1] THEN 1 END ) AS galon2,
                        COUNT( CASE WHEN transaksi.id_galon = $id_galon[2] THEN 1 END ) AS galon3
                        FROM transaksi");
                        $q_perbandingan->execute();
                        $q_perbandingan_result = $q_perbandingan->get_result();
        

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_perbandingan_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["galon2"]) . '
                        ';
                        }
                        ;
                        ?>,
                        <?php
                        $q_perbandingan = $connection->prepare("SELECT COUNT( CASE WHEN transaksi.id_galon = $id_galon[0] THEN 1 END ) AS galon1,
                        COUNT( CASE WHEN transaksi.id_galon = $id_galon[1] THEN 1 END ) AS galon2,
                        COUNT( CASE WHEN transaksi.id_galon = $id_galon[2] THEN 1 END ) AS galon3
                        FROM transaksi");
                        $q_perbandingan->execute();
                        $q_perbandingan_result = $q_perbandingan->get_result();
        

                        while ($q_view_cont1_rows = mysqli_fetch_array($q_perbandingan_result)) {
                            echo '
                            ' . htmlspecialchars($q_view_cont1_rows["galon3"]) . '
                        ';
                        }
                        ;
                        ?>],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>