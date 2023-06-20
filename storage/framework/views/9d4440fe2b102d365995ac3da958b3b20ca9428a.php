<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta property="og:image" content="<?php echo e(asset('foto/bootstrap.png')); ?>">
    <title>Aplikasi Kemahasiswaan</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="shortcut icon" type="image/x-generic" href="<?php echo e(asset('foto/bootstrap.png')); ?>">
    <!-- Favicons -->
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo e(asset('green/assets/vendor/animate.css/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('green/assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('green/assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('green/assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('green/assets/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('green/assets/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Template Main CSS File -->
    <link href="<?php echo e(asset('green/assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('green/assets/css/styletwo.css')); ?>" rel="stylesheet">

</head>
<style type="text/css">
    #drop:hover {
        color: #f73859;
    }

    #preloader {
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 99999999999;
        background: #fff;
    }

    .loader {
        position: absolute;
        width: 10rem;
        height: 10rem;
        top: 50%;
        margin: 0 auto;
        left: 0;
        right: 0;
        transform: translateY(-50%);
    }
</style>

<body>
    <div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
        <meta content="<?php echo e(asset('foto/bootstrap.png')); ?>" itemprop="url" />
    </div>

    <div id="preloader">
        <div class="loader">
            <center>
                <img src="<?php echo e(asset('foto/bootstrap.png')); ?>" width="60">
            </center>
        </div>
    </div>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href=""><img src="<?php echo e(asset('foto/bootstrap.png')); ?>" width="auto"
                        height="auto"></a></h1>
            <p class="logo me-auto text-center" style="font-size: 14px !important;line-height:124%">Aplikasi
                Kemahasiswaan<br class="pt-1"> Online Request Document Surat</p>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="<?php echo e(asset('green/assets/img/logo.png')); ?>" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#services">Layanan Surat</a></li>
                    <li><a class="nav-link scrollto" href="#about">Prosedur Pengajuan</a></li>
                    <li><a class="nav-link scrollto" href="#featured-services">Waktu Pelayanan</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak Kami</a></li>
                    <?php if(Auth::user()): ?>
                        <li class="dropdown"><a href="#"><span><?php echo e(Auth::user()->name); ?></span> <i
                                    class="bi bi-chevron-down"></i></a>
                            <ul>
                                <?php if(Auth::user()->level == 'Desa'): ?>
                                    <li><a href="<?php echo e(route('profil_desa', Auth::user()->title_user)); ?>"
                                            id="drop">Profil</a></li>
                                <?php else: ?>
                                    <li><a href="<?php echo e(route('profil_pengaju')); ?>" id="drop">Profil</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo e(route('logout')); ?>" id="drop">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a class="getstarted scrollto" href="<?php echo e(route('login', $dt->title_user)); ?>">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">


            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">KORIDOR UNTAN</h2>
                            <p class="animate__animated animate__fadeInUp">Media Pengajuan Permohonan Surat Secara
                                Online</p>
                            <a href="#services"
                                class="btn-get-started animate__animated animate__fadeInUp scrollto">Ajukan Surat <i
                                    class="bx bx-file"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->

            </div>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services section-bg">
            <div class="container">

                <div class="row no-gutters">
                    <?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lyn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 text-center">
                            <div class="icon-box">
                                <div class="icon"><i class="bi bi-clock"></i></div>
                                <h4 class="title"><?php echo e($lyn->hari); ?></h4>
                                <p class="description">Jam Pelayanan <br> <?php echo e($lyn->waktu); ?> - <?php echo e($lyn->sampai); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </section><!-- End Featured Services Section -->

        <section id="services" class="services">
            <div class="container">

                <div class="section-title">
                    <h2>Layanan Surat</h2>
                    <p>Pelayanan Surat yang kami Sediakan</p>
                </div>

                <div class="row">
                    <?php $__currentLoopData = $surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $srt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6 mt-2" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box iconbox-orange"
                                style="border-left: 1px solid <?php echo e($srt->bg); ?>;border-bottom: 1px solid <?php echo e($srt->bg); ?>">
                                <div class="icon">
                                    <svg width="100" height="100" viewBox="0 0 600 600"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke="none" stroke-width="0" fill="#f5f5f5"
                                            d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572">
                                        </path>
                                    </svg>
                                    <i class="bx bx-envelope"></i>
                                </div>
                                <h4><a href=""><?php echo e($srt->singkatan); ?></a></h4>
                                <p><?php echo e($srt->nama_surat); ?>

                                    <br>
                                    <a href="" class="text text-black" data-bs-toggle="modal"
                                        data-bs-target="#detail<?php echo e($srt->id_surat); ?>"><u>Lihat Persyaratan</u></a>
                                    <br>
                                    <?php if(Auth::user()): ?>
                                        <a href="<?php echo e(route('request', $srt->nama_surat)); ?>"
                                            class="btn btn-sm text-white mt-2"
                                            style="background: <?php echo e($srt->bg); ?>">Buat Surat</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login', $dt->title_user)); ?>"
                                            class="btn btn-sm text-white mt-2"
                                            style="background: <?php echo e($srt->bg); ?>">Buat Surat</a>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <?php echo $__env->make('desa/home/persyaratan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>Prosedur</h2>
                    <p>Prosedur Registrasi dan Pengajuan/Permohonan Surat</p>
                </div>

                <div class="row">
                    <div class="col-xl-12 pt-4 content">
                        <p class="fst-italic">
                            Panduan Prosedur pengajuan surat :
                        </p>
                        <ul>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $prosedur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $array = explode(PHP_EOL, $prd->prosedur);
                                $total = count($array);
                                foreach ($array as $item) {
                                    echo " <li><i class='bi bi-check-circled'></i>";
                                    echo $no . '. ' . $item;
                                    '</i></li>';
                                    $no++;
                                }
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>LOKASI</h2>
                    
                </div>

                <div class="row">

                    <div class="col-xl-12 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Alamat:</h4>
                                <p>
                                    Jalan Prof Dr Hadari Nawawi, Bansir Laut, Kecamatan Pontianak Tenggara, Kota
                                    Pontianak, Kalimantan Barat
                                </p>
                            </div>
                            <div class="address">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>
                                    <?php echo e($dt->email); ?>

                                </p>
                            </div>
                            <div class="address">
                                <i class="bi bi-phone"></i>
                                <h4>Telepon:</h4>
                                <p>
                                    0821xxxxxxx
                                </p>
                            </div>

                            <iframe class="form-control" height="290" style="width: 100%;" frameborder="0"
                                scrolling="no" marginheight="0" marginwidth="0"
                                src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q=Kantor+Kelurahan+<?php echo e($dt->name_village); ?>+<?php echo e($dt->name_city); ?>+<?php echo e($dt->name_province); ?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                        </div>

                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <footer id="footer" class="footer">

        <div class="footer-top">
            <div class="container">
                <h3>FAKULTAS TEKNIK UNIVERSITAS TANJUNG PURA</h3>
                <div class="row gy-4">

                    <div class="col-lg-4 footer-links">
                        <h4>Pengajuan</h4>
                        
                    </div>

                    <div class="col-lg-4 footer-links">
                        <h4>Kontak Pelayanan</h4>
                        
                    </div>

                    <div class="col-lg-4 footer-contact text-center text-md-start">
                        <h4>Alamat Pelayanan</h4>
                        

                    </div>

                </div>
            </div>
        </div>

    </footer>

    <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

    <!-- Vendor JS Files -->
    <script src="<?php echo e(asset('green/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('green/assets/vendor/glightbox/js/glightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('green/assets/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('green/assets/vendor/php-email-form/validate.js')); ?>"></script>
    <script src="<?php echo e(asset('green/assets/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/dist/assets/js/extensions/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('green/jquery.min.js')); ?>"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo e(asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/dist/assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('green/assets/js/main.js')); ?>"></script>
    <script type="text/javascript">
        jQuery(window).on("load", function() {
            $('#preloader').fadeOut(500);
            $('#main-wrapper').addClass('show');

            $('body').attr('data-sidebar-style') === "mini" ? $(".hamburger").addClass('is-active') : $(
                ".hamburger").removeClass('is-active')
        });
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/home/home.blade.php ENDPATH**/ ?>