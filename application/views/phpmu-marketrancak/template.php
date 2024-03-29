<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title; ?></title>
    <?php
    if ($this->session->id_konsumen==''){
        $cookie_pin_used = get_cookie('tajalapak_login');
        if($cookie_pin_used <> ''){
            $row = $this->db->query("SELECT * FROM rb_konsumen where md5(id_konsumen)='$cookie_pin_used'")->row_array();
            $this->session->set_userdata(array('id_konsumen'=>$row['id_konsumen'], 'level'=>'konsumen'));
        }
    }

    if ($this->uri->segment(1) == 'berita' and $this->uri->segment(2) == 'detail') {
        $rows = $this->model_utama->view_where('berita', array('judul_seo' => $this->uri->segment(3)))->row_array();
        $directory_img = "foto_berita";
        $foto_meta = $rows['gambar'];
        $meta_url = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
    } elseif ($this->uri->segment(1) == 'produk' and $this->uri->segment(2) == 'detail') {
        $rows = $this->model_utama->view_where('rb_produk', array('produk_seo' => $this->uri->segment(3)))->row_array();
        $directory_img = "foto_produk";
        $ex = explode(';', $rows['gambar']);
        $foto_meta = $ex[0];
        $meta_url = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
    }else{
        $rows = $this->model_utama->view_ordering_limit('logo', 'id_logo', 'DESC', 0, 1)->row_array();
        $directory_img = "logo";
        $foto_meta = $rows['gambar'];
        $meta_url = base_url();

        echo "<link rel='apple-touch-icon' sizes='57x57' href='".base_url()."asset/images/apple-icon-57x57.png'>
        <link rel='apple-touch-icon' sizes='60x60' href='".base_url()."asset/images/apple-icon-60x60.png'>
        <link rel='apple-touch-icon' sizes='72x72' href='".base_url()."asset/images/apple-icon-72x72.png'>
        <link rel='apple-touch-icon' sizes='76x76' href='".base_url()."asset/images/apple-icon-76x76.png'>
        <link rel='apple-touch-icon' sizes='114x114' href='".base_url()."asset/images/apple-icon-114x114.png'>
        <link rel='apple-touch-icon' sizes='120x120' href='".base_url()."asset/images/apple-icon-120x120.png'>
        <link rel='apple-touch-icon' sizes='144x144' href='".base_url()."asset/images/apple-icon-144x144.png'>
        <link rel='apple-touch-icon' sizes='152x152' href='".base_url()."asset/images/apple-icon-152x152.png'>
        <link rel='apple-touch-icon' sizes='180x180' href='".base_url()."asset/images/apple-icon-180x180.png'>
        <link rel='icon' type='image/png' sizes='192x192'  href='".base_url()."asset/images/android-icon-192x192.png'>
        <link rel='icon' type='image/png' sizes='32x32' href='".base_url()."asset/images/favicon-32x32.png'>
        <link rel='icon' type='image/png' sizes='96x96' href='".base_url()."asset/images/favicon-96x96.png'>
        <link rel='icon' type='image/png' sizes='16x16' href='".base_url()."asset/images/favicon-16x16.png'>
        <meta name='msapplication-TileColor' content='#ffffff'>
        <meta name='msapplication-TileImage' content='".base_url()."asset/images/ms-icon-144x144.png'>
        <meta name='theme-color' content='#ffffff'>";
    }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="google-site-verification" content="<?= config('google_site_verification'); ?>" />
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?= $description; ?>">
    <meta name="keywords" content="<?= $keywords; ?>">
    <meta name="author" content="phpmu.com">
    <meta name="robots" content="all,index,follow">
    <meta http-equiv="Content-Language" content="id-ID">
    <meta NAME="Distribution" CONTENT="Global">
    <meta NAME="Rating" CONTENT="General">
    <?php 
    // Schema.org markup for Google+ 
	echo '<meta itemprop="name" content="' . $title . '">
	<meta itemprop="description" content="' . $description . '">
    <meta itemprop="image" content="' . base_url() . 'asset/' . $directory_img . '/' . $foto_meta . '">';
    
	// Twitter Card data
    echo '
    <meta name="twitter:card" content="product">
	<meta name="twitter:site" content="'.config('twitter').'">
	<meta name="twitter:title" content="' . $title . '">
	<meta name="twitter:description" content="' . $description . '">
	<meta name="twitter:creator" content="'.config('twitter').'">
    <meta name="twitter:image" content="' . base_url() . 'asset/' . $directory_img . '/' . $foto_meta . '">';
    
	// Open Graph data
    echo '
    <meta property="fb:app_id" content="'.config('facebook_app_id').'">
    <meta property="og:title" content="' . $title . '" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="' .$meta_url. '" />
    <meta property="og:image" content="' . base_url() . 'asset/' . $directory_img . '/' . $foto_meta . '" />
    <meta property="og:description" content="' . $description . '"/>
    <meta property="og:site_name" content="' . $title . '" />';
    ?>
    
    <link rel="shortcut icon" href="<?php echo base_url(); ?>asset/images/<?php echo favicon(); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/css/<?php echo ($this->session->theme != '' ? $this->session->theme : background()); ?>.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/summernote/summernote-bs4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/uploadfile.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.css">
    <script src="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.js"></script>
    <script src="<?php echo base_url(); ?>asset/phpmu_scripts.js"></script>
    <!-- Facebook Pixel Code -->
    <script>
        
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?= config('facebook_pixel'); ?>');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=<?= config('facebook_pixel'); ?>&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <script>
        function copyToClipboard(element) {
	      var $temp = $("<input>");
	      $("body").append($temp);
	      $temp.val($(element).text()).select();
	      document.execCommand("copy");
	      $temp.remove();
        }
        
        $(document).ready( function() {
                $('.ajax-file-upload-filename').on('load', function() {
                originalString = 'aaa';
                hasil = originalString.replace(/<\/?[^>]+>/gi, '');
                $(".ajax-file-upload-filename").html(hasil);
            });
        });

        $(document).ready(function(){
    	    $('.myButton').on('click', function() {
                var $this = $(this);
                var loadingText = '<i class="fa fa-check"></i>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 2000);
            });
	    });

        $(document).ready(function(){
    	    $('.myButtonL').on('click', function() {
                var $this = $(this);
                var loadingText = '<i style="font-size:18px; color:green" class="fa fa-check"></i>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 2000);
            });
	    });

        $(document).ready(function() {
            $('.submitx').attr('disabled', true);
            $('.komentarx').on('keyup',function() {
                var textarea_value = $(".komentarx").val();
                if(textarea_value.trim() != '') {
                    $('.submitx').attr('disabled', false);
                } else {
                    $('.submitx').attr('disabled', true);
                }
            });
        });

        $(document).ready(function(){
    	    $('.spinnerButton').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 10000);
            });
        });
        
        $(document).ready(function(){
    	    $('.oksimpanx').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b style="color:red">Gagal Proses Pembayaran...</b>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 5000);
            });

            $('#oksimpan').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Tunggu Sebentar, Ya...</b>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 20000);
            });

            $('#oksimpan_digital').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Tunggu Sebentar, Ya...</b>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 20000);
            });
	    });

        function nospaces(t) {
            if (t.value.match(/\s/g)) {
                alert('Tidak Boleh Menggunakan Spasi,..');
                t.value = t.value.replace(/\s/g, '');
            }
        }

        $(".formatNumber").on('keyup', function() {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            n = +n || 0;
            $(this).val(n.toLocaleString());
        });
    </script>

    <script>
        $(document).ready(function() {
            // Select your input element.
            var number = document.getElementsByClassName('qty');
            // Listen for input event on numInput.
            number.onkeydown = function(e) {
                if(!((e.keyCode > 95 && e.keyCode < 106)
                || (e.keyCode > 47 && e.keyCode < 58) 
                || e.keyCode == 8)) {
                    return false;
                }
            }

            $('#operatorx').change(function() {
                var operator_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('main/produk?page=home'); ?>",
                    data: "operator_id=" + operator_id,
                    success: function(response) {
                        $('#produkx').html(response);
                    }
                })
            });

            $('#operator').change(function() {
                var operator_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('main/produk'); ?>",
                    data: "operator_id=" + operator_id,
                    beforeSend: function(){
                        // Show image container
                        $("#loader").show();
                        $(".ppob").hide();
                        $("#historytrx").hide();
                    },
                    success: function(response) {
                        $('#produk').html(response);
                    },
                    complete:function(data){
                        // Hide image container
                        $("#loader").hide();
                        $(".ppob").show();
                    }
                })
            })

            $(document).on('click', '#id_pelanggan', function(e) {
                var operator_id = 133;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('main/produk'); ?>",
                    data: "operator_id=" + operator_id,
                    beforeSend: function(){
                        // Show image container
                        $("#loader").show();
                        $(".ppob").hide();
                        $("#historytrx").hide();
                    },
                    success: function(response) {
                        $('#produk').html(response);
                    },
                    complete:function(data){
                        // Hide image container
                        $("#loader").hide();
                        $(".ppob").show();
                    }
                })
            })
        })
    </script>

    <style>
        #mapid { height: 380px; }

        .menu--dropdown > li, .menu--dropdown > li > a {
            width:300px;
            height:35px
        }

        .menu--dropdown > li.has-mega-menu .mega-menu{
            position: relative;
        }

        .menu--dropdown > li.has-mega-menu > .mega-menu{
            margin-top: -36px;
        }
        
        .menu--dropdown .mega-menu__list > li.has-mega-menu > .mega-menu {
            position: absolute;
            top: 0;
            left: 100%;
            width: auto;
            min-width: 260px;
            visibility: hidden;
            opacity: 0;
            border-left: none;
            margin-left: 1px;
        }

        .menu--dropdown .mega-menu__list > li:hover.has-mega-menu > .mega-menu {
            visibility: visible;
            opacity: 1;
            margin-left: 0px;
            margin-top: -1px;
        }
        .mega-menu__list_sub{
            margin-left: 15px !important;
        }
        .mega-menu__list_sub li{
            list-style: circle !important;
        }
        .container .ps-section__content {
            margin-bottom: 100px;
        }
        .ps-product--horizontal{
            border:0px;
            border-bottom: 1px solid #e9e9e9;
            border-left: 5px solid #e3e3e3;
            margin-top: 10px;
        }
        .textarea {
            padding: 10px 10px;
            resize: none;
            overflow: hidden;
            min-height: 60px;
            max-height: 300px;
            width: 100%;
        }
        .ps-product--cart{
            align-items: normal !important;
            margin-top: 3px;
        }
        .ajax-file-upload input{
            height:31px !important;
            cursor: pointer !important;
        }
        .ps-product__container .add-to-cart{
            padding: 3px 10px !important;
        }
        .menu > li > a:hover, .sub-menu > li > a:hover{
            text-decoration:none !important;
        }
        .btn{
            font-size:14px; 
            padding:0 30px
        }
        .group-order{
            background: #e3e3e3;
            color: red;
            border: 1px solid #8a8a8a;
            padding: 0px 10px;
            margin-top:5px;
        }
        .group-order i{
            font-weight: bold;
            background: red;
            color: #fff;
            font-size: 17px;
            padding: 3px 7px 6px 7px;
            margin: 3px 0px -10px -10px;
        }
        .form-control.error{
            font-style: normal;
        }
        .error{
            color: red;
            font-style: italic;
        }

        .margin-btn{
            padding: 10px 20px !important;
        }

        .dataTables_wrapper .row {
            width: 100%
        }

        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after {
            display: none
        }

        .dataTables_length select,
        .dataTables_filter input[type=search] {
            height: 30px
        }

        .dataTables_length {
            float: left
        }

        .dataTables_filter {
            float: right
        }

        #example1 th,
        #example11 th {
            font-weight: bold
        }

        .modal-content .btn-primary {
            height: 30px;
            font-size: 12px;
        }

        .modal-content input[type=text] {
            height: 30px;
        }

        .iconset .fa {
            font-size: 13px !important;
        }

        .is-invalid{
            color:red;
        }

        .blink_me {
            animation: blinker 1s linear infinite;
            color: red
        }

        .blink_me:hover {
            animation: blinker 0s linear infinite;
            color: red
        }

        @keyframes blinker {
            50% {
                opacity: 0
            }
        }

        .mb-10 {
            margin-bottom: 0px;
        }

        .pricing-table-product-box {
            -webkit-box-shadow: 0 4px 9px 0 rgba(67, 65, 79, .1);
            box-shadow: 0 4px 9px 0 rgba(67, 65, 79, .1);
            border: solid 2px #f5f5f5;
        }

        .harga {
            font-size: 3em;
            font-weight: 700;
            line-height: .8em;
            display: inline-block;
        }

        .currency {
            font-size: 1em;
            font-weight: 700;
            margin-top: .2em;
            display: inline-block;
        }

        .waktu {
            font-size: .7em;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            margin: .3em;
            display: inline-block;
        }

        .waktu_block {
            display: inline-block;
        }

        #Back-to-top {
            text-align: center;
            z-index: 99999;
            position: fixed;
            bottom: 70px;
            right: 30px;
            cursor: pointer;
            display: none;
            opacity: 0.7;
        }

        #Back-to-top:hover {
            opacity: 1;
        }

        .badge-secondary {
            color: #fff;
            background-color: #dd2400;
            padding: 5px 7px 4px 7px;
        }

        .notif .nav-tabs .nav-link {
            background: none;
            color: #000;
        }

        .notif .nav-tabs .nav-link:hover {
            text-decoration:none !important;
        }

        .notif .badge-secondary {
            color: #000;
            background-color: #e3e3e3;
            padding: 5px 7px 4px 7px;
        }

        .notif .nav-tabs .nav-item.show .nav-link,
        .notif .nav-tabs .nav-link.active {
            color: #ff7200 !important;
            background-color: #fff !important;
            border: none;
            border-bottom:2px solid #ff7200;
        }

        .penjualan .nav-tabs .nav-link {
            background: #fff;
            color: #000;
            border-bottom:1px solid #e3e3e3;
        }

        .penjualan .nav-tabs .nav-link:hover{
            text-decoration:none !important;
        }

        .penjualan .badge-secondary {
            color: #000;
            background-color: #e3e3e3;
            padding: 5px 7px 4px 7px;
        }

        .penjualan .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #ff7200 !important;
            background-color: #fff !important;
            border: none;
            border-bottom:2px solid #ff7200;
        }

        .container .ps-section__content {
            min-height: 650px;
        }

        input[type=number]::-webkit-inner-spin-button {
            opacity: 1
        }

        .form-control {
            /* border-bottom: 1px solid #cecece;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
            background-color: #f9f9f9; */
        }

        .multiselect-container {
            width: 100%;
            font-size: 13px;
        }

        button.multiselect {
            font-size: 14px;
        }

        .multiselect-container>li {
            border-bottom: 1px dotted #e3e3e3;
        }

        .form-sm .form-group {
            margin-bottom: 5px !important;
        }

        .form-sm i {
            margin-left: 10px;
        }

        .form-sm .ajax-file-upload {
            width: 100%;
        }

        .no-margin{
            margin-bottom: 0px !important;
        }

        .biodata .col-form-label{
            color:#5d5d5d;
            font-weight: bold;
            background: #f9f9f9;
        }

        .checkbox-scroll { 
            border:1px solid #ccc; 
            width:100%; 
            height: 170px; 
            padding-left:8px; 
            overflow-y: scroll; 
        }

        @media (max-width: 479px) {
            .penawaran{
                font-size:20px !important;
            }

            .ps-product-list .ps-section__header h3{
                padding-bottom:0px;
                font-size:16px
            }

            .ps-product-list .ps-section__links li a{
                font-size: 11px;
                text-decoration: underline;
            }

            .ps-block--download-app .ps-block__content{
                padding: 0 15px;
            }

            .widget_contact-us h3{
                font-size:20px;
            }
            .ps-breadcrumb{
                display:none;
            }

            .ps-page--product {
                padding-top: 10px;
                border-top: 1px solid #d5d5d5;
            }
        }

        input[type=checkbox]{
            height: 1em;
        }
        .selected-ongkir10{ background-color:#cecece; }
        .selected-ongkir11{ background-color:#cecece; }
        .selected-ongkir12{ background-color:#cecece; }

        .btn-custom{
            padding: 3px 10px;
            background: #f7f7f7;
            border: 1px solid #cecece;
            width: 90%;
            display: block;
        }

        .menu--mobile > li > a {
            padding: 6px 20px;
            border-left: 1px solid #afafaf;
            margin-left: 20px;
        }

        .menu--mobile > li.menu-item-has-children .sub-toggle{
            top: -5px;
        }

        .menu--mobile .sub-menu > li > a{
            border-bottom: 1px dotted #e3e3e3;
            padding: 3px 20px;
            margin-left: 30px;
        }

        .ps-product--detail .ps-product__price {
            padding:10px 20px;
            background: #eaeaea;
        }

        .show-map{
            display:none;
        }
    </style>
</head>

<body>
    <div class="modal fade bd-example-modal-lg" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style='border-bottom:0px solid #e9ecef'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 d-none d-sm-block" style='padding:0px 40px'>
                            <?php
                            $banner = $this->model_app->view_where_ordering('banner', array('posisi' => 'top'), 'id_banner', 'DESC');
                            foreach ($banner as $row) {
                                echo "<div class='ps-block__item' style='margin-bottom: 18px;'>
                            <div class='ps-block__left' style='display:block; float:left'><i style='font-size:35px; margin-right:20px' class='$row[icon]'></i></div>
                            <div class='ps-block__right'>
                                <h5 style='margin-bottom:0px'>$row[judul]</h5>
                                <p>$row[keterangan]</p>
                            </div>
                        </div>";
                            }
                            ?>
                            <hr style='padding:15px 0px 5px 0px'>
                            <div class="info--register-bottom" style='margin-bottom:20px'>
                                <center><span>Belum punya akun? </span> <a style='color:#000' href="<?php echo base_url(); ?>auth/login" class="btn-register" target="_parent">Daftar sekarang!</a></center>
                            </div>
                        </div>
                        <div class="col-md-6" style='padding:0px 40px'>
                            <h3>MASUK</h3>
                            <form action="<?php echo base_url(); ?>auth/login" method="POST">
                                <div class="ps-form__content">
                                    <div class="form-group" style='margin-bottom: 1.2rem;'>
                                        <label style='margin-bottom:5px' class="col-form-label">Username, Email atau No. Handphone</label>
                                        <input class="form-control" name='a' style='height:40px' type="text" autofocus autocomplete='off' required>
                                    </div>
                                    <div class="form-group" style='margin-bottom: 1rem;'>
                                        <label style='margin-bottom:5px' class="col-form-label">Password</label>
                                        <input class="form-control" name='b' style='height:40px' type="password" required>
                                    </div>
                                    <div class="form-group" style='margin-bottom: 1rem;'>
                                        <div class="ps-checkbox">
                                            <input class="form-control" type="checkbox" id="remember-me" name="remember">
                                            <label for="remember-me">Ingat saya</label>
                                            <a href='#' style='color:#000' class='float-right' data-dismiss="modal" aria-hidden="true" data-toggle='modal' data-target='.lupa-example-modal-lg'>Lupa Password?</a>
                                        </div>
                                    </div><br>
                                    <div class="form-group submit" style='margin-bottom:5px'>
                                        <button type='submit' name='login' class="ps-btn ps-btn--fullwidth gray-btn custom-btn">Masuk</button>
                                        <?php
                                        $ci = &get_instance();
                                        if (config('google_client_id')!=''){
                                            $ci->load->library('google');
                                            echo "<a href='" . $ci->google->loginURL() . "' class='ps-btn ps-btn--fullwidth red-btn custom-btn' style='margin: 4px 0px'>Google</a>";
                                        }
                                        if (config('facebook_app_id')!=''){
                                            $ci->load->library('facebook');
                                            echo "<a href='" . $ci->facebook->login_url() . "' class='ps-btn ps-btn--fullwidth blue-btn custom-btn'>Facebook</a>";
                                        }
                                        ?>
                                    </div><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade lupa-example-modal-lg" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style='border-bottom:0px solid #e9ecef'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" style='padding:0px 40px'>
                            <?php
                            $banner = $this->model_app->view_where_ordering('banner', array('posisi' => 'top'), 'id_banner', 'DESC');
                            foreach ($banner as $row) {
                                echo "<div class='ps-block__item' style='margin-bottom: 10px;'>
                            <div class='ps-block__left' style='display:block; float:left'><i style='font-size:35px; margin-right:20px' class='$row[icon]'></i></div>
                            <div class='ps-block__right'>
                                <h5 style='margin-bottom:0px'>$row[judul]</h5>
                                <p>$row[keterangan]</p>
                            </div>
                        </div>";
                            }
                            ?>
                            <hr style='padding:15px 0px 5px 0px'>
                            <div class="info--register-bottom" style='margin-bottom:20px'>
                                <center><span>Belum punya akun? </span> <a style='color:#000' href="<?php echo base_url(); ?>auth/login" class="btn-register" target="_parent">Daftar sekarang!</a></center>
                            </div>
                        </div>
                        <div class="col-md-6" style='padding:0px 40px'>
                            <h3>LUPA PASSWORD?</h3>
                            <form action="<?php echo base_url(); ?>auth/lupass" method="POST">
                                <div class="ps-form__content">
                                    <div class="form-group" style='margin-bottom: 1.8rem;'>
                                        <label style='margin-bottom:5px' class="col-form-label">Username, Email</label>
                                        <input class="form-control" name='a' style='height:40px' type="text" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label style='margin-bottom:5px' class="col-form-label">No. Handphone</label>
                                        <input class="form-control" name='b' style='height:40px' type="text" required>
                                    </div>
                                    <div class="form-group" style='margin-bottom: 1rem;'>
                                        <div class="ps-checkbox">
                                            <a href='#' class='text' data-dismiss="modal" aria-hidden="true">Batalkan?</a>
                                            <a href='#' style='color:#000' class='float-right' data-dismiss="modal" aria-hidden="true" data-toggle='modal' data-target='.bd-example-modal-lg'>Kembali Login?</a>
                                        </div>
                                    </div><br>
                                    <div class="form-group submit" style='margin-bottom:5px'>
                                        <button type='submit' name='submit3' class="ps-btn ps-btn--fullwidth">Kirimkan Permintaan</button>
                                    </div><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id='Back-to-top'>
        <img alt='Scroll to top' src='<?= base_url(); ?>asset/images/top.png' />
    </div>
    <?php
    if ($this->uri->segment(1) != 'auth') {
        $idn = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    ?>
        <header class="header header--1" data-sticky="true">
            <div class="header__topone">
                <div class="container">
                    <div class="header__left">
                        <p><?php echo $idn['info_atas']; ?></p>
                    </div>
                    <div class="header__right">
                        <ul class="header__top-links">
                            <div class="btn-group">
  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Terjemahan
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
     <li><a href="#googtrans(id|id)" class="lang-select" data-lang="id">Indonesia</a></li>
     <li><a href="#googtrans(id|en)" class="lang-select" data-lang="en">English</a></li>
     <li><a href="#googtrans(id|zh-CN)" class="lang-select" data-lang="zh-CN">China</a></li>
     <li><a href="#googtrans(id|hi)" class="lang-select" data-lang="hi">Hindi</a></li>
     <li><a href="#googtrans(id|ar)" class="lang-select" data-lang="ar">Arabic</a></li>
     <li><a href="#googtrans(id|ja)" class="lang-select" data-lang="ja">Japan</a></li>
     <li><a href="#googtrans(id|ne)" class="lang-select" data-lang="ne">Nepali</a></li>
  </div>
</div>
<script type="text/javascript">
function googleTranslateElementInit() {
   new google.translate.TranslateElement({pageLanguage: 'id'}, 'google_translate_element');
}
function triggerHtmlEvent(element, eventName) {
   var event;
   if (document.createEvent) {
     event = document.createEvent('HTMLEvents');
     event.initEvent(eventName, true, true);
     element.dispatchEvent(event);
   } else {
     event = document.createEventObject();
     event.eventType = eventName;
     element.fireEvent('on' + event.eventType, event);
   }
}
$(document).ready(function(){
   $(".lang-select").click(function(){
     var theLang = $(this).attr('data-lang');
     $(".goog-te-combo").val(theLang);
     window.location = $(this).attr('href');
     window.location.reload();
   });
});
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>

                            <li><i class="icon-telephone"></i> <a href="#"> Bantuan<strong> : <?php echo $idn['no_telp']; ?></strong></a></li>
                            <li><i class="icon-map-marker"></i> <a href="<?php echo base_url(); ?>konfirmasi/tracking">Telusuri Pesanan</a></li>
                            <?php
                            if (config('mode')=='marketplace'){
                                if ($this->session->level == 'konsumen') {
                                    if (reseller($this->session->id_konsumen) != '') {
                                        $komplain_toko = $this->db->query("SELECT * FROM rb_pusat_bantuan where id_terlapor='".$this->session->id_konsumen."' AND putusan='proses'"); 
                                ?>
                                        <li>
                                            <div class="ps-dropdown"><a href="#"><i class='icon-bag'></i> Menu Toko <span class="badge badge-secondary"><?php echo (total_penjualan('0', reseller($this->session->id_konsumen))+$komplain_toko->num_rows()); ?></span> </a>
                                                <ul class="ps-dropdown-menu">
                                                    <li><a href="<?php echo base_url(); ?>members/profil_toko"><i class='fa fa-gears'></i> Pengaturan</a></li>
                                                    <li><a href="<?php echo base_url(); ?>members/produk"><i class='fa fa-th'></i> Daftar Produk</a></li>
                                                    <li><a href="<?php echo base_url(); ?>members/alamat_cod"><i class='fa fa-map-marker'></i>&nbsp; Alamat Transaksi COD</a></li>
                                                    <li><a href="<?php echo base_url(); ?>members/pembelian"><i class='fa fa-reorder'></i> Orders Pusat (Reseller)</a></li>
                                                    <li><a href="<?php echo base_url(); ?>komplain?s=terlapor"><i class='fa fa-warning'></i> Komplain (Terlapor) <span class="badge badge-secondary" style='font-size:85%; background-color: #cecece; color:#000'><?php echo $komplain_toko->num_rows(); ?></span></a></li>
                                                    <li><a href="<?php echo base_url(); ?>members/penjualan"><i class='fa fa-list-alt'></i> Orders Masuk <span class="badge badge-secondary" style='font-size:85%; background-color: #cecece; color:#000'><?php echo total_penjualan('0', reseller($this->session->id_konsumen)); ?></span></a></li>
                                                    <li><a href="<?php echo base_url(); ?>members/upgrade"><i class="fa fa-star text-yellow"></i> <span class="blink_me">Upgrade Toko</span></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                <?php
                                    } else {
                                        echo "<li><a href='" . base_url() . "members/buat_toko'><i class='icon-bag'></i> Buat Toko</a></li>";
                                    }
                                }
                            }

                            $komplain_beli = $this->db->query("SELECT * FROM rb_pusat_bantuan where id_pelapor='".$this->session->id_konsumen."' AND putusan='proses'");
                            $jmlpesan_unread = $this->model_reseller->pesanbelumbaca()->num_rows(); 
                            ?>
                            <?php if ($this->session->level == 'konsumen') { ?>
                            <li><i class="icon-bubble"></i> <a href="<?php echo base_url(); ?>members/messages"> Inbox <span class="badge badge-secondary"><?= $jmlpesan_unread; ?></span></a></li>
                            <?php } ?>
                            <li>
                                <div class="ps-block--user-header">
                                    <div class="ps-block__left"><i class="icon-user"></i></div>
                                    <div class="ps-block__right">
                                        <?php
                                        if ($this->session->level == 'konsumen') {
                                            $sopir = $this->db->query("SELECT id_sopir FROM rb_sopir where id_konsumen='".$this->session->id_konsumen."'")->row_array();
                                            $cek_pesanan_sopir = $this->db->query("SELECT * FROM rb_penjualan a WHERE a.kurir='$sopir[id_sopir]' AND a.proses!='4' AND service='SOPIR'")->num_rows();
                                            $pesanan_sopir = '<span class="badge badge-secondary" style="font-size:85%; background-color: #cecece; color:#000">'.$cek_pesanan_sopir.'</span>';
                                            
                                            echo "<div class='ps-dropdown'>
                                                    <a style='padding-right:0px' href='#'>Akun <span class='badge badge-secondary'>".($komplain_beli->num_rows()+$cek_pesanan_sopir)."</span> <span class='fa fa-chevron-down'></span></a>
                                                    <ul class='ps-dropdown-menu'>";
                                                            $data = array('<i class="icon-user"></i> Profile','<i class="icon-couch"></i> Sosmed','<i class="icon-bag-dollar"></i> Data Bank','<i class="fa fa-money"></i> Keuangan','<i class="icon-heart"></i> Wishlist','<i class="icon-bag2"></i> Pembelian','<i class="icon-phone"></i> PPOB','<i class="icon-car"></i> Jadi Kurir '.$pesanan_sopir.'');
                                                            $link = array('profile','sosial_media','rekening_bank','withdraw','wishlist','orders_report','trx_pulsa','sopir');
                                                            for ($i=0; $i < count($data); $i++) { 
                                                                echo "<li><a href='".base_url()."members/".$link[$i]."'>".$data[$i]."</a></li>";
                                                            }
                                                        echo "<li><a href='" . base_url() . "komplain?s=pelapor'><i class='fa fa-warning'></i> Komplain <span class='badge badge-secondary' style='font-size:85%; background-color: #cecece; color:#000'>".$komplain_beli->num_rows()."</span></a></li>
                                                              <li><a href='" . base_url() . "auth/logout'><i class='icon-exit'></i> Logout</a></li>
                                                    </ul>
                                                  </div>";
                                                echo "";
                                        } else {
                                            echo "<a style='margin-right:0px' href='#' data-toggle='modal' data-target='.bd-example-modal-lg'>Login</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header__top">
                <div class="ps-container">
                    <div class="header__left">
                        <div class="menu--product-categories">
                            <div class="menu__toggle"><i class="icon-menu"></i><span> Kategori Produk</span></div>
                            <div class="menu__content">
                                <ul class="menu--dropdown">
                                    <?php
                                    $kategorii = $this->model_app->view_ordering('rb_kategori_produk', 'nama_kategori', 'ASC');
                                    foreach ($kategorii as $rows) {
                                        if ($rows['icon_kode'] != '') {
                                            $icon = "<i class='$rows[icon_kode]'></i>";
                                        } elseif ($rows['icon_image'] != '') {
                                            $icon = "<img style='width:18px; height:18px; margin-right:10px' src='" . base_url() . "asset/foto_produk/$rows[icon_image]'>";
                                        } else {
                                            $icon = "";
                                        }
                                        $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                                        if ($sub_kategori->num_rows() >= 1) {
                                            echo "<li class='current-menu-item menu-item-has-children has-mega-menu'><a href='" . base_url() . "produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori] <span class='caret caret-right'></span></a>
                                                <div class='mega-menu'>";
                                            if ($sub_kategori->num_rows() >= 10) {
                                                $total1 = ceil($sub_kategori->num_rows() / 2);
                                                $total2 = floor($sub_kategori->num_rows() / 2);
                                                $sub_kategori1 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT 0,$total1");
                                                $sub_kategori2 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT $total1,$total2");
                                                echo "<div class='mega-menu__column'>
                                                        <ul class='mega-menu__list'>";
                                                foreach ($sub_kategori1->result_array() as $row) {
                                                    if ($row['icon_kode'] != '') {
                                                        $icons = "<i class='$row[icon_kode]'></i>";
                                                    } elseif ($row['icon_image'] != '') {
                                                        $icons = "<img style='width:18px; height:18px' src='" . base_url() . "asset/foto_produk/$row[icon_image]'>";
                                                    } else {
                                                        $icons = "";
                                                    }
                                                    echo "<li class='current-menu-item'><a href='" . base_url() . "produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";
                                                }
                                                echo "</ul>
                                                    </div>";

                                                echo "<div class='mega-menu__column'>
                                                        <ul class='mega-menu__list'>";
                                                foreach ($sub_kategori2->result_array() as $row) {
                                                    if ($row['icon_kode'] != '') {
                                                        $icons = "<i class='$row[icon_kode]'></i>";
                                                    } elseif ($row['icon_image'] != '') {
                                                        $icons = "<img style='width:18px; height:18px' src='" . base_url() . "asset/foto_produk/$row[icon_image]'>";
                                                    } else {
                                                        $icons = "";
                                                    }
                                                    echo "<li class='current-menu-item'><a href='" . base_url() . "produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";
                                                }
                                                echo "</ul>
                                                    </div>";
                                            } else {
                                                echo "<div class='mega-menu__column'>
                                                        <ul class='mega-menu__list'>";
                                                foreach ($sub_kategori->result_array() as $row) {
                                                    if ($row['icon_kode'] != '') {
                                                        $icons = "<i class='$row[icon_kode]'></i>";
                                                    } elseif ($row['icon_image'] != '') {
                                                        $icons = "<img style='width:18px; height:18px' src='" . base_url() . "asset/foto_produk/$row[icon_image]'>";
                                                    } else {
                                                        $icons = "";
                                                    }
                                                    echo "<li class='current-menu-item'><a href='" . base_url() . "produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";
                                                }
                                                echo "</ul>
                                                    </div>";
                                            }
                                            echo "</div>
                                            </li>";
                                        } else {
                                            echo "<li class='current-menu-item'><a href='" . base_url() . "produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori]</a></li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $logo = $this->model_utama->view_ordering_limit('logo', 'id_logo', 'DESC', 0, 1);
                        foreach ($logo->result_array() as $row) {
                            echo "<a class='ps-logo' href='" . base_url() . "'><img src='" . base_url() . "asset/logo/$row[gambar]'/></a>";
                        }
                        ?>
                    </div>

                    <div class="header__center">
                        <form class="ps-form--quick-search" action="<?php echo base_url() ?>produk" method="GET">
                            <div class="form-group--icon"><i class="icon-chevron-down" style='z-index:3; padding-left:5px'></i>
                                <select class="form-control" name='f'>
                                    <option value="0" selected="selected">Semua</option>
                                    <?php
                                    $kategori = $this->model_app->view_ordering('rb_kategori_produk', 'nama_kategori', 'ASC');
                                    foreach ($kategori as $rows) {
                                        $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                                        if (cetak($_GET['f'])=="kategori|$rows[id_kategori_produk]"){
                                            echo "<option class='level-0' value='kategori|$rows[id_kategori_produk]' selected>$rows[nama_kategori]</option>";
                                        }else{
                                            echo "<option class='level-0' value='kategori|$rows[id_kategori_produk]'>$rows[nama_kategori]</option>";
                                        }
                                        if ($sub_kategori->num_rows() >= 1) {
                                            echo main_menuxx($rows['id_kategori_produk']);
                                            // foreach ($sub_kategori->result_array() as $row) {
                                            //     if (cetak($_GET['f'])=="subkategori|$row[id_kategori_produk_sub]"){
                                            //         echo "<option class='level-1' value='subkategori|$row[id_kategori_produk_sub]' selected> - $row[nama_kategori_sub]</option>";
                                            //     }else{
                                            //         echo "<option class='level-1' value='subkategori|$row[id_kategori_produk_sub]'> - $row[nama_kategori_sub]</option>";
                                            //     }
                                            // }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <input class="form-control" name='s' value='<?= cetak($_GET['s']); ?>' type="text" placeholder="Aku mau Belanja..." autocomplete='off' required>
                            <button type='submit'>Cari</button>
                        </form>
                        <p class='populer'><b>Trending :</b> 
                            <?php
                                $jumlah_tampil = 6;
                                $tag_populer = $this->db->query("SELECT group_concat(a.tag_seo separator ',') as tag_populer FROM(SELECT * FROM `tagpro` ORDER BY count DESC LIMIT 15) as a")->row_array();
                                $random_keys=array_rand(explode(',',$tag_populer['tag_populer']),$jumlah_tampil);
                                for ($i=0; $i < $jumlah_tampil; $i++) { 
                                    $tag_seo = explode(',',$tag_populer['tag_populer'])[$random_keys[$i]];
                                    echo "<a href='".base_url()."produk?f=0&s=$tag_seo'>#$tag_seo</a>";
                                }
                            ?>
                        </p>
                    </div>
                    <div class="header__right">
                        <div class="header__actions">
                            <!--<a class="header__extra" href="#"><i class="icon-chart-bars"></i><span><i>0</i></span></a>-->
                            <?php
                            $wishlist = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='" . $this->session->id_konsumen . "'")->num_rows();
                            echo "<a class='header__extra' href='" . base_url() . "members/wishlist'><i class='icon-heart'></i><span><i class='wishlistcount'>$wishlist</i></span></a>
                                <div class='ps-cart--mini'><a class='header__extra' href='#'><i class='icon-bag2'></i><span><i class='show_cart_count'></i></span></a>
                                <div class='ps-cart__content'>
                                    <div class='ps-cart__items'>
                                        <div class='show_cart'></div>
                                    </div>
                                    <div class='ps-cart__footer'>
                                        <div class='show_cart_button'></div>
                                    </div>
                                </div>
                            </div>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "main-menu.php"; ?>
        </header>
    <?php } ?>
    <?php
    if ($this->uri->segment('1') == 'produk' and $this->uri->segment('2') == 'detail') {
        include "mobile/produk_detail.php";
    } else {
        include "mobile/home.php";
    }

    echo $contents;
    include "footer.php";
    $this->model_utama->kunjungan();

    if ($this->uri->segment(1) == 'main' or $this->uri->segment(1) == '') {
        if (get_cookie('notshow') == '') {
            $pop = $this->db->query("SELECT * FROM iklanatas ORDER BY id_iklanatas DESC LIMIT 1")->row_array();
            if ($pop['username'] == 'Y') {
                if ($this->session->id_konsumen == '') {
    ?>
                    <div class="ps-popup" id="subscribe" data-time="500">
                        <div class="ps-popup__content bg--cover" data-background="<?php echo base_url(); ?>/asset/foto_iklanatas/<?php echo $pop['gambar']; ?>"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
                            <form class="ps-form--subscribe-popup" action="<?php echo base_url() ?>main/subscribe" method="POST">
                                <div class="ps-form__content">
                                    <h4><?php echo $pop['judul']; ?></h4>
                                    <p><?php echo $pop['url']; ?></p>
                                    <div class="form-group">
                                        <input class="form-control" type="email" name='email' placeholder="Email Address" autocomplete='off' required>
                                        <div class="ps-checkbox">
                                            <input class="form-control" type="checkbox" id="not-show" name="notshow">
                                            <label for="not-show">Jangan Tampilkan lagi Form ini.</label>
                                        </div><br>
                                        <button type='submit' name='submit' class="ps-btn">Subscribe</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
    <?php }
            }
        }
    } ?>

    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <!--<div id="loader-wrapper">
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>-->
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
        <div class="ps-search__content">
            <form class="ps-form--primary-search" action="do_action" method="post">
                <input class="form-control" type="text" placeholder="Search for...">
                <button><i class="aroma-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center style='padding:30px 30px'>
                    <h3>Hapus Barang ?</h3>
                    Barang ini akan dihapus dari keranjangmu.
                    <div><br>
                        <input type="hidden" name="product_code_delete" id="product_code_delete" class="form-control">
                        <button type="button" style='width:130px' class="ps-btn ps-btn--outline" data-dismiss="modal">Kembali</button>
                        <button type="button" style='width:130px' type="submit" id="btn_delete" class="ps-btn">Hapus Barang</button>
                    </div>
                </center>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal_Notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center style='padding:30px 30px'>
                    <h3>Peringatan!</h3>
                    <div id='error_notif'></div>
                    <div><br>
                        <button type="button" style='width:130px' class="ps-btn ps-btn--outline" data-dismiss="modal">Kembali</button>
                        <button type="button" style='width:130px' type="button" class="ps-btn" data-dismiss="modal">Coba Lagi!</button>
                    </div>
                </center>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="myModal-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <div style='padding:30px 30px'>
                <div class="content-body"></div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Notifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Produk Berhasil Disimpan!
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style='padding:10px'>
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myModalLabel">Informasi Detail</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div class="content-body"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/bootstrap4/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/masonry.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery.matchHeight-min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/slick/slick/slick.min.js"></script>

    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/slick-animation.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/select2/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <!-- custom scripts-->

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/jquery.uploadfile.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/js/main.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            show_cart();
            show_cart_detail();
            function show_cart(){
                $.ajax({
                    url   : '<?php echo site_url("produk/read_query"); ?>',
                    type  : 'GET',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var html_button = '';
                        var html_cart = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            var foto_all = data[i].gambar;
                            if (foto_all !== '') {
                                var strArray = foto_all.split(";");
                                var foto_produk = strArray[0];
                            }else{
                                var foto_produk = 'no-image.png';
                            }
                            $sub_total = ((data[i].harga_jual - data[i].diskon) * data[i].jumlah);
                            html += '<div class="ps-product--cart-mobile">'+
                                    '<div class="ps-product__thumbnail"><a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'"><img src="<?php echo base_url(); ?>asset/foto_produk/'+foto_produk+'" alt="'+data[i].nama_produk+'"></a></div>'+
                                    '<div class="ps-product__content">'+
                                    '<a href="javascript:void(0);" class="ps-product__remove item_delete" style="cursor:pointer" data-product_code="'+data[i].id_penjualan_detail+'"><i class="icon-cross"></i></a>'+
                                    '<a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'">'+data[i].nama_produk+'</a>'+
                                    '<p style="border-bottom:1px dotted #cecece"><b>Qty.</b> <small>'+data[i].jumlah+' x <b>'+toDuit(data[i].harga_jual - data[i].diskon)+'</b></small></p>'+
                                    '</div>'+
                                    '</div>';
                        }

                        if (data.length==0){
                            html += '<center style="padding:10px 15px">'+
                                    '<img style="width:90px" src="<?php echo base_url(); ?>asset/images/shopping-empty.png"><hr>'+
                                    '<h4>Wah keranjang belanjaanmu kosong!</h4>'+
                                    'Daripada dianggurin, mending isi dengan barang-barang impianmu. Yuk, cek sekarang!<br>'+
                                    '</center>';

                            html_button += '<figure><a style="padding:5px 20px; font-size:14px" class="ps-btn ps-btn--fullwidth" href="<?php echo base_url(); ?>produk">Mulai Belanja</a></figure>';
                        }else{
                            html_button += '<figure><a style="padding:5px 20px; font-size:14px" class="ps-btn ps-btn--fullwidth" href="<?php echo base_url(); ?>produk/keranjang">Lihat Sekarang</a></figure>';
                        }

                            html_cart += data.length;

                        $('.show_cart').html(html);
                        $('.show_cart_button').html(html_button);
                        $('.show_cart_count').html(html_cart);
                    }
                });
            } 

            $("#form1").validate({
                rules: {
                    variasi_1: "required",
                    variasi_2: "required",
                    variasi_3: "required",
                },
                messages: {
                    variasi_1: "Pilihan ini tidak boleh kosong!",
                    variasi_2: "Pilihan ini tidak boleh kosong!",
                    variasi_3: "Pilihan ini tidak boleh kosong!",
                }
            })

            $('.add-to-cart').on('click',function(){
                $("#form1").valid();
                if ($("#form1").valid()==true){
                    var id = $(this).attr("id");
                    var var1 = $('#var1').val();
                    var var2 = $('#var2').val();
                    var var3 = $('#var3').val();

                    var varx1 = $('#warnax').val();
                    var varx2 = $('#ukuranx').val();
                    var varx3 = $('#lainnyax').val();

                    var qty = $('#qty').val();
                    var group = $('#group').val();
                    var kgroup = $('#kgroup').val();
                    var $this = $(this);
                    var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Process...';
                    if ($(this).html() !== loadingText) {
                        $this.data('original-text', $(this).html());
                        $this.html(loadingText);
                    }
                    setTimeout(function() {
                    $this.html($this.data('original-text'));
                    }, 2000);

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('produk/cart') ?>",
                        dataType: "json",
                        data: {
                            id: id, qty:qty, var1:var1, var2:var2, var3:var3, varx1:varx1, varx2:varx2, varx3:varx3, group:group, kgroup:kgroup
                        },
                        success: function(data) {
                            var strArray = data.split("|");
                            if(strArray[0]=='true'){
                                show_cart();
                                $(".m1keranjangx").hide().load(" .m1keranjangx").fadeIn();
                                $('#Keranjang_Notif').modal('show');
                                $('#berhasil_notif').html('<img style="max-width:70px; border-radius:5px; float: left; margin-right: 10px;" src="<?php echo base_url(); ?>asset/foto_produk/'+strArray[2]+'" alt="'+strArray[1]+'"> <div>'+strArray[1]+'</div> <a class="btn btn-success btn-sm" style="margin:inherit" href="<?php echo base_url(); ?>produk/keranjang">Lihat Keranjang</a>');
                            }else{
                                $('#Modal_Notif').modal('show');
                                $('#error_notif').html(data);
                            }
                        },
                    });
                    return false;
                }
            });

            //get data for delete record
            $('.show_cart').on('click','.item_delete',function(){
                var product_code = $(this).data('product_code');
                $('#Modal_Delete').modal('show');
                $('[name="product_code_delete"]').val(product_code);
            });

            //delete record to database
            $('#btn_delete').on('click',function(){
                var id = $('#product_code_delete').val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo site_url('produk/cart_remove')?>",
                    dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                        $('[name="product_code_delete"]').val("");
                        $('#Modal_Delete').modal('hide');
                        show_cart();
                        show_cart_detail();
                    }
                });
                // $('.item_delete').on('click', function() {
                //     show_cart_detail();
                // });
                return false;
            });

            $('.add-to-cart-empty').on('click', function() {
                var $this = $(this);
                var loadingText = '<i class="fa fa-remove text-danger"></i> Habis Terjual...';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 2000);
            });

            function split_data(nama,variasi,nomor) {
				if (nama != null) {
					var strArray = nama.split("||");
                    var variasiArray = variasi.split("||");
                    if (strArray.length>0){
                        var data_file = '';
                        no = 1;
                        for(var i = 0; i < strArray.length; i++){
                            if (no%2 == 1){ bg = '#ececec'; }else{ bg = '#f4f4f4'; }
                            data_file += '<div style="background:'+bg+'"><div style="min-width:50px; display:inline-block"><b>'+strArray[i]+'</b></div> : '; 
                            var variasiArraysplit = variasiArray[i].split(";");
                            for(var ii = 0; ii < variasiArraysplit.length; ii++){
                                data_file += '<input type="checkbox" value="variasi'+no+''+ii+''+nomor+'|'+strArray[i]+':'+variasiArraysplit[ii]+'" name="variasi'+no+''+ii+''+nomor+'" style="height:1em"> '+variasiArraysplit[ii]+' &nbsp; '
                            }
                            data_file += '</div>'; 
                            no++;
                        }
                    }
					return data_file;
				}else{
					return '';
				}
			}
            
            function show_cart_detail(){
                $.ajax({
                    url   : '<?php echo site_url("produk/read_query"); ?>',
                    type  : 'GET',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var html_button = '';
                        var html_cart = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            var foto_all = data[i].gambar;
                            var catatan = data[i].keterangan_order;

                            if (foto_all !== null) {
                                var strArray = foto_all.split(";");
                                var foto_produk = strArray[0];
                            }else{
                                var foto_produk = 'no-image.png';
                            }

                            if (catatan !== null &&  catatan !== '') {
                                var catatanArray = catatan.split("||");
                                // var catatan_order = catatanArray[0];
                                if (catatanArray[1]==undefined){
                                    variasi = '<b>Variasi :</b> '+catatanArray[0];
                                    variasi1 = '';
                                }else{
                                    variasi = '<b>Variasi :</b> '+catatanArray[1];
                                    variasi1 = catatanArray[0];
                                }
                            }else{
                                // var catatan_order = '';
                                variasi = '';
                                variasi1 = '';
                            }

                            if (data[i].pre_order !== null && data[i].pre_order > 0){
                                var pre_order = '<span class="badge badge-secondary">Pre-order '+data[i].pre_order+' Hari</span>';
                            }else{
                                var pre_order = '';
                            }

                            $sub_total = ((data[i].harga_jual - data[i].diskon) * data[i].jumlah);
                            html += '<input type="hidden" name="id'+(i+1)+'" value="'+data[i].id_penjualan_detail+'"> '+
                                    '<input type="hidden" name="idp'+(i+1)+'" value="'+data[i].id_produk+'"> '+
                                    '<div class="ps-product--cart-mobile" style="padding: 10px 0">'+
                                    '<div class="ps-product__thumbnail"><a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'"><img src="<?php echo base_url(); ?>asset/foto_produk/'+foto_produk+'" alt="'+data[i].nama_produk+'"></a></div>'+
                                    '<div class="ps-product__content">'+
                                    '<a href="javascript:void(0);" class="ps-product__remove item_delete" style="cursor:pointer" data-product_code="'+data[i].id_penjualan_detail+'" ><i class="icon-cross"></i></a>'+
                                    '<p style="margin-bottom:0"> '+data[i].nama_reseller+' '+pre_order+' </p>'+
                                    '<a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'"><span style="font-size:17px; display:block; border-bottom:1px solid">'+data[i].nama_produk+'</span></a>'+
                                    '<p style="border-bottom:1px dotted #cecece; margin-bottom:0px"><b>Qty.</b> <small><input type="number" class="qty_update qty" min="1" id="'+data[i].id_produk+'" name="qty'+(i+1)+'" value="'+data[i].jumlah+'" style="display:inline-block; margin-bottom:3px; width:50px; text-align: center; " autocomplete="off"> x <b>'+toDuit(data[i].harga_jual - data[i].diskon)+'</b></small></p> '+variasi+
                                    // '<div style="padding:3px 0px">'+split_data(data[i].nama,data[i].variasi,(i+1))+' </div>'+
                                    '<input type="text" name="keterangan'+(i+1)+'" style="display:inline-block; margin-bottom:3px; width:100%; border:1px dotted #cecece" placeholder="Tulis Catatan untuk Penjual ('+data[i].nama_reseller+')..." value="'+variasi1+'" autocomplete="off">'+
                                    '</div>'+
                                    '</div>';
                        }

                        if (data.length<=0){
                            $(".keranjang-all").hide().load(" .keranjang-all").fadeIn();
                        }else{
                            $(".keranjang-page").hide().load(" .keranjang-page").fadeIn();
                        }
                        $('.show_cart_detail').html(html);
                    }
                });
            } 

            //get data for delete record
            $('.show_cart_detail').on('click','.item_delete',function(){
                var product_code = $(this).data('product_code');
                $('#Modal_Delete').modal('show');
                $('[name="product_code_delete"]').val(product_code);
            });

        });

        $(document).ready(function() {
            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 400) {
                        $('#Back-to-top').fadeIn();
                    } else {
                        $('#Back-to-top').fadeOut();
                    }
                });
                $('#Back-to-top').click(function() {
                    $('body,html')
                        .animate({
                            scrollTop: 0
                        }, 300)
                        .animate({
                            scrollTop: 40
                        }, 200)
                        .animate({
                            scrollTop: 0
                        }, 130)
                        .animate({
                            scrollTop: 15
                        }, 100)
                        .animate({
                            scrollTop: 0
                        }, 70);
                });
            });

            $('#editor1').summernote({
                height: "300px",
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete: function(target) {
                        deleteImage(target[0].src);
                    }
                }
            });

            function uploadImage(image) {
                var data = new FormData();
                data.append("image", image);
                $.ajax({
                    url: "<?php echo site_url('members/upload_image') ?>",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: "POST",
                    success: function(url) {
                        $('#editor1').summernote("insertImage", url);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            function deleteImage(src) {
                $.ajax({
                    data: {
                        src: src
                    },
                    type: "POST",
                    url: "<?php echo site_url('members/delete_image') ?>",
                    cache: false,
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    </script>
    <script>
        function removecart(id, data2) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('produk/cart_remove') ?>",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".remove-" + id).hide().load(" .remove-" + id).fadeIn();
                    $(".keranjang").hide().load(" .keranjang").fadeIn();
                    $(".keranjangx").hide().load(" .keranjangx").fadeIn();

                    $(".m1keranjangx").hide().load(" .m1keranjangx").fadeIn();
                }
            });
            return false;
        }
    </script>
    <script src="<?php echo base_url(); ?>asset/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            // Summernote
            $('#editor1').summernote()
        })

        $(".formatNumber").on('keyup', function() {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            n = +n || 0;
            $(this).val(n.toLocaleString());
        });
        $(document).ready(function() {
            $('#state').change(function() {
                var state_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('auth/city'); ?>",
                    data: "stat_id=" + state_id,
                    success: function(response) {
                        $('#city').html(response);
                    }
                })
            })
        })

        $(document).ready(function() {
            $('#state_reseller').change(function() {
                var state_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('auth/city'); ?>",
                    data: "stat_id=" + state_id,
                    success: function(response) {
                        $('#city_reseller').html(response);
                    }
                })
            })
        })

        function toDuit(number) {
            var number = number.toString(),
                duit = number.split('.')[0],
                duit = duit.split('').reverse().join('')
                .replace(/(\d{3}(?!$))/g, '$1,')
                .split('').reverse().join('');
            return 'Rp ' + duit;
        }

        function toRupiah(number) {
            var number = number.toString(),
                duit = number.split('.')[0],
                duit = duit.split('').reverse().join('')
                .replace(/(\d{3}(?!$))/g, '$1,')
                .split('').reverse().join('');
            return duit;
        }


        $(function() {
            $("#example1").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $("#example11").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $("#example12").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $("#example13").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $("#example14").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });

            $('#example3').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 10,
                "order": [
                    [4, "desc"]
                ]
            });
        });

        function save(id, data2) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('produk/save') ?>",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".produk-" + id).hide().load(" .produk-" + id).fadeIn();
                    $("#exampleModalCenter").modal('show');
                    $(".wishlistcount").hide().load(" .wishlistcount").fadeIn();
                }
            });
            return false;
        }

        $(function() {
            $(document).on('click', '.quick_view', function(e) {
                e.preventDefault();
                $("#myModalDetail").modal('show');
                $.post("<?php echo site_url() ?>produk/quick_view", {
                        id: $(this).attr('data-id')
                    },
                    function(html) {
                        $(".content-body").html(html);
                    }
                );
            });
        });
    </script>


    <script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#multiple_select').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: false,
                maxHeight: 300,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '99%',
                numberDisplayed: 6
            });

            $('#multiple_select2').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: false,
                maxHeight: 200,
                enableCaseInsensitiveFiltering: true
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            //* select Provinsi */
            var base_url    = "<?php echo base_url();?>";
            $("#list_provinsi").change(function(){
                var id_province = this.value;
                kota(id_province);
                $("#div_kota").show();
            });

            /* select Kota */
            kota = function(id_province){
                $.ajax({
                type: 'post',
                url: base_url + 'produk/rajaongkir_get_kota',
                data: {id_province:id_province},
                dataType  : 'html',
                success: function (data) {
                    $("#list_kotakab").html(data);
                },
                beforeSend: function () {
                    
                },
                complete: function () {
                
                }
            });
            }

            $("#list_kotakab").change(function(){
                var id_kota = this.value;
                kecamatan(id_kota);
                $("#div_kecamatan").show();
            });

            kecamatan = function(id_kota){
                $.ajax({
                type: 'post',
                url: base_url + 'produk/rajaongkir_get_kecamatan',
                data: {id_kota:id_kota},
                dataType  : 'html',
                success: function (data) {
                    $("#list_kecamatan").html(data);
                }
            });
            }
        });
    </script>

<script>
        $(document).ready(function(){
            //* select Provinsi */
            var base_urlx    = "<?php echo base_url();?>";
            $(".list_provinsi").change(function(){
                var id_provincex = this.value;
                kotax(id_provincex);
                $("#div_kota").show();
            });

            /* select Kota */
            kotax = function(id_provincex){
                $.ajax({
                type: 'post',
                url: base_urlx + 'produk/rajaongkir_get_kota',
                data: {id_province:id_provincex},
                dataType  : 'html',
                success: function (data) {
                    $(".list_kotakab").html(data);
                },
                beforeSend: function () {
                    
                },
                complete: function () {
                
                }
            });
            }

            $(".list_kotakab").change(function(){
                var id_kotax = this.value;
                kecamatanx(id_kotax);
                $("#div_kecamatan").show();
            });

            kecamatanx = function(id_kotax){
                $.ajax({
                type: 'post',
                url: base_urlx + 'produk/rajaongkir_get_kecamatan',
                data: {id_kota:id_kotax},
                dataType  : 'html',
                success: function (data) {
                    $(".list_kecamatan").html(data);
                }
            });
            }
        });
    </script>

</body>
</html>