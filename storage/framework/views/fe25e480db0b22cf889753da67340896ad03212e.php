<!DOCTYPE html>
<html lang="en">
<?php
    $logodesa = DB::table('profil_desa')
        ->join('users', 'users.id', '=', 'profil_desa.user_id')
        ->where('users.level', 'Desa')
        ->limit('1')
        ->first();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="<?php echo e(asset('foto')); ?>/<?php echo e($logodesa->logo); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | Web Surat Pengajuan</title>
    <link rel="shortcut icon" type="image/x-generic" href="<?php echo e(asset('foto')); ?>/<?php echo e($logodesa->logo); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/css/bootstrap.css')); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php echo $__env->yieldPushContent('importcss'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/iconly/bold.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/simple-datatables/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/simple-datatables/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/dripicons/webfont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/css/pages/dripicons.css')); ?>">
    <script src="<?php echo e(asset('javascript-css/canva.js')); ?>"></script>
    <link href="<?php echo e(asset('javascript-css/foto.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/toastify/toastify.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/sweetalert2/sweetalert2.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/css/app.css')); ?>">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css">

    <script src="<?php echo e(asset('canva.js')); ?>"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="https://keith-wood.name/css/jquery.signature.css">

    <style>
        .kbw-signature {
            width: 50%;
            height: 90px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
    </style>
</head>

<body>
    <div itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject">
        <meta content="<?php echo e(asset('foto')); ?>/<?php echo e($logodesa->logo); ?>" itemprop="url" />
    </div>
    <div id="app">
        <?php echo $__env->make('desa/layout/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <?php echo $__env->yieldContent('content'); ?>

        </div>
    </div>

    <script src="<?php echo e(asset('template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/dist/assets/js/bootstrap.bundle.min.js')); ?>"></script>
    
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        // let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <?php echo $__env->yieldPushContent('childjs'); ?>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
    
    
    <script src="<?php echo e(asset('template/dist/assets/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('template/dist/assets/vendors/toastify/toastify.js')); ?>"></script>
    
    <script src="<?php echo e(asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/dist/alert.min.js')); ?>"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#copy").hide();
            $("#add-more").click(function() {
                var html = $("#copy").html();
                $("#after-add-more").after(html);
            });

            // saat tombol remove dklik control group akan dihapus
            $("body").on("click", "#remove", function() {
                $(this).parents("#control-group").remove();
            });
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    </script>
</body>
<?php echo $__env->make('desa/layout/notif', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</html>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/layout/app.blade.php ENDPATH**/ ?>