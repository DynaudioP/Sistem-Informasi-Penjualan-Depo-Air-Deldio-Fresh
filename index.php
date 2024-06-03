<?php
require_once 'include/nav_home.php';
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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<style>
    img {
        max-width: 100%;
        height: auto;
    }
</style>

<body>
    <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-down" data-aos-delay="50">
                    <div class="cons">
                        <h1 class="text-uppercase fw-bold display-5 hero1" style="letter-spacing: 2px;">
                            Selamat
                            Datang
                            di Deldio Fresh</h1>
                        <h1 class="text-uppercase fw-bold display-5 hero1" style="letter-spacing: 2px;">
                            Selamat
                            Datang
                            di Deldio Fresh</h1>
                    </div>

                    <h5 class="text-white mt-3 mb-4 hero1">Nikmati Kesegaran Air Berkualitas dan Sejernih Hati</h5>
                    <div>
                        <a href="#about" class="btn btn-light hero1 mt-1">Tentang Kami</a>
                        <a href="cek_kupon" class="btn btn-primary hero1 px-4 mt-1">Cek Kupon</a>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Tentang Kami</h1>
                        <div class="line"></div>
                        <p>Deldio Fresh adalah mitra Anda dalam menjaga hidrasi dan kesehatan yang optimal dengan
                            menyediakan air minum berkualitas tinggi secara praktis dan terjangkau.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 mb-5" data-aos="fade-down" data-aos-delay="50">
                    <img src="images/about.png" alt="" class="rounded-2 framed">
                </div>
                <div data-aos="fade-down" data-aos-delay="150" class="col-lg-5">
                    <h1>Pengisian air minum isi ulang</h1>
                    <p class="mt-3 mb-4">Deldio Fresh telah berdiri dari tahun 2005 dan terus menyediakan pengisian air
                        minum ulang yang berkualitas dengan harga yang terjangkau</p>
                    <div class="d-flex pt-4 mb-3">
                        <div class="iconbox me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="3.5em" height="3.5em" viewBox="0 0 32 32">
                                <path fill="#0a47ff"
                                    d="M13 30H9a2.003 2.003 0 0 1-2-2v-8h2v8h4v-8h2v8a2.003 2.003 0 0 1-2 2m12-10h-1.75L21 29.031L18.792 20H17l2.5 10h3zM15 2h2v5h-2zm6.688 6.9l3.506-3.506l1.414 1.414l-3.506 3.506zM25 15h5v2h-5zM2 15h5v2H2zm3.395-8.192l1.414-1.414L10.315 8.9L8.9 10.314zM22 17h-2v-1a4 4 0 0 0-8 0v1h-2v-1a6 6 0 0 1 12 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h5>Filter dan Sterilisasi Sinar UV + Ozon</h5>
                            <p>Menyediakan air minum yang disaring dan disterilkan menggunakan teknologi Sinar UV dan
                                Ozon untuk menghilangkan virus dan bakteri</p>
                        </div>
                    </div>
                    <div class="d-flex pt-4 mb-3">
                        <div>
                            <h5>Kualitas dan Harga Terjangkau</h5>
                            <p>Menawarkan harga yang terjangkau dengan kualitas yang baik</p>
                        </div>
                        <div class="iconbox me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 24 24">
                                <path fill="#0a47ff"
                                    d="M7 14.494v-1H4.5v-1h5v-3H5.27q-.328 0-.549-.221T4.5 8.725V5.264q0-.327.221-.548t.548-.222H7v-1h1v1h2.5v1h-5v3h4.23q.328 0 .549.222q.221.22.221.548v3.461q0 .327-.221.548t-.548.221H8v1zm6.95 5.808l-3.558-3.558l.708-.707l2.85 2.85l5.689-5.689l.707.708z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="lokasi" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Lokasi</h1>
                        <div class="line"></div>
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="red"
                                    d="M19 9A7 7 0 1 0 5 9c0 1.387.409 2.677 1.105 3.765h-.008L12 22l5.903-9.235h-.007A6.971 6.971 0 0 0 19 9m-7 3a3 3 0 1 1 0-6a3 3 0 0 1 0 6" />
                            </svg>Jl. Juanda 8 No.3, Air Hitam, Kec. Samarinda Ulu, <br>Kota Samarinda, Kalimantan Timur
                            75124</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-12" data-aos="fade-down" data-aos-delay="50">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15958.725210956594!2d117.1366054!3d-0.4748435!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f2fb856dfc9%3A0xdae12193dc6e45b9!2sDELDIO!5e0!3m2!1sen!2sid!4v1713734110074!5m2!1sen!2sid"
                        width="100%" height="450" style="border-radius: 10px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>
    </section>



    <section class="section-padding" id="counter">

        <div class="container">

            <!-- <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Tentang Kami</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do
                            crazy skills</p>
                    </div>
                </div>
            </div> -->
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6" data-aos="fade-down" data-aos-delay="50">
                    <img src="images/tes.png" alt="" class="rounded-2">
                </div>
                <div data-aos="fade-down" data-aos-delay="150" class="col-lg-5">
                    <h1 class="fw-bold">Kupon khusus Pelanggan Deldio Fresh</h1>
                    <p class="mt-3 mb-4">Cek Kupon yang telah anda dapatkan saat melakukan pengisian di Deldio Fresh
                        untuk mendapatkan manfaat berikut:</p>
                    <div class="d-flex pt-4 mb-3">
                        <div class="iconbox me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 14 14">
                                <path fill="#FFD000" fill-rule="evenodd"
                                    d="M0 11c0 .828.67 1.5 1.498 1.5h11.004C13.33 12.5 14 11.828 14 11V8.966a.5.5 0 0 0-.369-.483a1.537 1.537 0 0 1 0-2.966a.5.5 0 0 0 .369-.483V3c0-.828-.67-1.5-1.498-1.5H1.498C.67 1.5 0 2.172 0 3v2.03a.5.5 0 0 0 .373.483a1.537 1.537 0 0 1 0 2.974A.5.5 0 0 0 0 8.97zm4.962-1.058l5-5a.625.625 0 0 0-.883-.884l-5 5a.625.625 0 1 0 .883.884M4.021 5a1 1 0 1 1 2 0a1 1 0 0 1-2 0m4 4a1 1 0 1 1 2 0a1 1 0 0 1-2 0"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h5>Gratis Pengisian Air!</h5>
                            <p>Dapatkan pengisian air minum isi ulang secara gratis dengan melakukan pengisian secara
                                berkala</p>
                        </div>
                    </div>

                    <!-- <p class="mt-3 mb-4">Cek Kupon yang telah anda dapatkan saat melakukan pengisian di Deldio Fresh
                        untuk mendapatkan manfaat gratis pengisian</p> -->
                    <a href="cek_kupon.php" class="button-66">Cek Kupon Anda</a>
                </div>
            </div>
        </div>
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="white" />
                </g>
            </svg>
        </div>
        <div class="wth" style="background-color: #fff;">

        </div>
    </section>


    <section id="gallery" class="section-gallery">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Galeri</h1>
                        <div class="line"></div>

                    </div>
                </div>
            </div>
            <div class="row" data-aos="fade-down" data-aos-delay="50">
                <div class="img-gal col-12 col-md-4 gy-3">
                    <img src="images/hero.jpg" alt="" class="rounded-2">
                </div>
                <div class="img-gal col-12 col-md-4 gy-3"><img src="images/galeri2.jpg" alt="" class="rounded-2"></div>
                <div class="img-gal col-12 col-md-4 gy-3"><img src="images/galeri3.jpg" alt="" class="rounded-2"></div>
                <div class="img-gal col-12 col-md-4 gy-3">
                    <img src="images/galeri4.jpg" alt="" class="rounded-2">
                </div>
                <div class="img-gal col-12 col-md-4 gy-3"><img src="images/galeri5.jpg" alt="" class="rounded-2"></div>
                <div class="img-gal col-12 col-md-4 gy-3"><img src="images/galeri6.jpg" alt="" class="rounded-2"></div>
               
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

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="js/main.js"></script>
</body>

</html>