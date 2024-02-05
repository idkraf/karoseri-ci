<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="<?= LTR ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <?php if (@$title) {
        echo "<title>$title</title >";
    } else {
        echo "<title>Smart POS</title >";
    }
    ?>
    <link rel="apple-touch-icon" href="<?= assets_url() ?>app-assets/images/ico/favicon-32.png">
        <link rel="shortcut icon" type="image/x-icon" href="<?= assets_url() ?>app-assets/images/ico/icons8-shop-local-color-16.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/<?= LTR ?>/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/fonts/meteocons/style.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/<?= LTR ?>/app.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/colors/palette-gradient.css">
    <link rel="stylesheet" href="<?php echo assets_url('assets/custom/datepicker.min.css') . APPVER ?>">
    <link rel="stylesheet" href="<?php echo assets_url('assets/custom/summernote-bs4.css') . APPVER; ?>">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>assets/css/style.css<?= APPVER ?>">
    <?php if(LTR=='rtl') echo '<link rel="stylesheet" type="text/css" href="'.assets_url().'assets/css/style-rtl.css'.APPVER.'">'; ?>
    <!-- END Custom CSS-->
    <script src="<?= assets_url() ?>app-assets/vendors/js/vendors.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script type="text/javascript"
            src="<?= assets_url() ?>app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="<?php echo assets_url(); ?>assets/portjs/raphael.min.js" type="text/javascript"></script>
    <script src="<?php echo assets_url(); ?>assets/portjs/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/myjs/datepicker.min.js') . APPVER; ?>"></script>
    <script src="<?php echo assets_url('assets/myjs/summernote-bs4.min.js') . APPVER; ?>"></script>
    <script src="<?php echo assets_url('assets/myjs/select2.min.js') . APPVER; ?>"></script>
    <script type="text/javascript">var baseurl = '<?php echo base_url() ?>';
        var crsf_token = '<?=$this->security->get_csrf_token_name()?>';
        var crsf_hash = '<?=$this->security->get_csrf_hash(); ?>';
    </script>
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/menu/menu-types/horizontal-menu.css">
</head>
<body class="horizontal-layout horizontal-menu 2-columns menu-expanded" data-open="click" data-menu="horizontal-menu"
      data-col="2-columns">

    <!-- Horizontal navigation bar-->
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border"
         role="navigation" data-menu="menu-wrapper">
         
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content text-center" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>">
                        <div class="card border-0" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<?php echo base_url("assets/images/back.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Kembali</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>produksi">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<?php echo base_url("assets/images/dashboard.png"); ?>">
                            </div>

                        </div>
                        <p class="fw-bold">Produksi</p>
                    </a>
                </li>
                <li class="nav-item hidden">
                    <a class="nav-link" href="<?= base_url(); ?>">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<?php echo base_url("assets/images/plus-40.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Tambah</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>template">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<?php echo base_url("assets/images/reports.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Template</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>vehicle">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<?php echo base_url("assets/images/reports.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Vehicle</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url(); ?>job">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<?php echo base_url("assets/images/reports.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Job</p>
                    </a>
                </li>
                <!--li class="nav-item float-end">
                    <a class="nav-link" href="<//?= base_url(); ?>employee">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<//?php echo base_url("assets/images/hrm.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Staff</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<//?= base_url(); ?>">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<//?php echo base_url("assets/images/hrm.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Customer</p>
                    </a>
                </li>
                <li class="nav-item float-right">
                    <a class="nav-link" href="<//?= base_url(); ?>products">
                        <div class="card border border-1" style="width:76px;">
                            <div class="card-body p-2">
                                <img src="<//?php echo base_url("assets/images/reports.png"); ?>" width="50" height="50">
                            </div>

                        </div>
                        <p class="fw-bold">Sparepart</p>
                    </a>
                </li-->
            </ul>
        </div>
    </div>
    <!-- Horizontal navigation-->
    <div id="c_body"></div>
    <div class="app-content content">