<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <?php
        if (@$title) {
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
        <!-- END VENDOR CSS-->
        <!-- BEGIN STACK CSS-->
        <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/<?= LTR ?>/app.css">
        <!-- END STACK CSS-->
        <!-- BEGIN Page Level CSS-->
        <link rel="stylesheet" type="text/css"
              href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/menu/menu-types/horizontal-menu.css">
        <link rel="stylesheet" type="text/css"
              href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/fonts/simple-line-icons/style.css">
        <link rel="stylesheet" type="text/css"
              href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/<?= LTR ?>/pages/chat-application.css">
        <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>assets/css/style.css<?= APPVER ?>">
        <?php if (LTR == 'rtl') echo '<link rel="stylesheet" type="text/css" href="' . assets_url() . 'assets/css/style-rtl.css' . APPVER . '">'; ?>
        <link rel="stylesheet" href="<?php echo assets_url('assets/custom/datepicker.min.css') . APPVER ?>">
        <!-- END Custom CSS-->
        <script src="<?= assets_url() ?>app-assets/vendors/js/vendors.min.js"></script>
        <script type="text/javascript" src="<?= assets_url() ?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
        <script type="text/javascript"
        src="<?= assets_url() ?>app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
        <script src="<?= assets_url() ?>app-assets/vendors/js/charts/raphael-min.js"></script>
        <script src="<?= assets_url() ?>app-assets/vendors/js/charts/morris.min.js"></script>

        <script type="text/javascript">var baseurl = '<?php echo base_url() ?>';
            var crsf_token = '<?= $this->security->get_csrf_token_name() ?>';
            var crsf_hash = '<?= $this->security->get_csrf_hash(); ?>';
        </script>
        <script src="<?php echo assets_url('assets/myjs/mousetrap.min.js') . APPVER; ?>"></script>
        <script src="<?php echo assets_url('assets/myjs/datepicker.min.js') . APPVER; ?>"></script>
        <script src="<?php echo assets_url(); ?>assets/portjs/accounting.min.js" type="text/javascript"></script>
        <script src="<?php echo assets_url(); ?>assets/portjs/printThis.js" type="text/javascript"></script>
        <?php accounting() ?>
    </head>
    <body class="horizontal-layout horizontal-menu content-left-sidebar <?php if ($s_mode) echo 'chat-application'; ?>  menu-expanded"
          data-open="hover"
          data-menu="horizontal-menu"
          data-col="2-columns">
        <span id="hdata" data-df="<?php echo $this->config->item('dformat2'); ?>"  data-curr="<?php echo currency($this->aauth->get_user()->loc); ?>"></span>
        <nav class="navbar navbar-expand-lg  navbar-static-top navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url() ?>dashboard/">
                    <img class="brand-logo" alt="logo"  src="<?php echo base_url(); ?>userfiles/theme/logo-header.png">
                </a>
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">

                            <li class="nav-item nav-link">
                                <a href="<?= base_url() ?>dashboard" class="btn btn-warning rounded-0"  title="Access POS">
                                    <i class="icon-speedometer"></i><?php echo $this->lang->line('Dashboard') ?>
                                </a>
                            </li>
                            <li class="nav-item  nav-link">
                                <a class="btn btn-info rounded-0" title="View Register" data-toggle="modal" data-target="#register">
                                    <i class="icon-drawer"></i><?php echo $this->lang->line('Register') ?> 
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block nav-link ">
                                <a data-toggle="modal" data-target="#close_register" class="btn btn-danger rounded-0" title="Close Register"> 
                                    <i class="icon-close"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="dropdown dropdown-notification nav-item">
                                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                    <i  class="ficon ft-bell"></i>
                                    <span class="badge badge-pill  badge-danger badge-default badge-up" id="taskcount">0</span></a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right float-end">
                                    <li class="dropdown-menu-header">
                                        <h6 class="dropdown-header m-0">
                                            <span class="grey darken-2"><img src="<?php echo base_url("assets/images/task.png"); ?>"> <?php echo $this->lang->line('Pending Tasks') ?></span>
                                            <span class="notification-tag badge badge-default badge-danger float-right m-0"><?= $this->lang->line('New') ?></span>
                                        </h6>
                                    </li>
                                    <li class="scrollable-container media-list" id="tasklist"></li>
                                    <li class="dropdown-menu-footer">
                                        <a class="dropdown-item text-muted text-center" href="<?php echo base_url('manager/todo') ?>"><?php echo $this->lang->line('Manage tasks') ?></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-notification nav-item">
                                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                    <i class="ficon ft-mail"></i>
                                    <span class="badge badge-pill badge-default badge-info badge-default badge-up"><?php echo $this->aauth->count_unread_pms() ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                    <li class="dropdown-menu-header">
                                        <h6 class="dropdown-header m-0">
                                            <span class="grey darken-2"><img src="<?php echo base_url("assets/images/msg.png"); ?>"><?php echo $this->lang->line('Messages') ?></span>
                                            <span class="notification-tag badge badge-default badge-warning float-right m-0"><?php echo $this->aauth->count_unread_pms() ?><?php echo $this->lang->line('new') ?></span>
                                        </h6>
                                    </li>
                                    <li class="scrollable-container media-list">
                                        <?php
                                        $list_pm = $this->aauth->list_pms(6, 0, $this->aauth->get_user()->id, false);

                                        foreach ($list_pm as $row) {
                                            echo '<a href="' . base_url('messages/view?id=' . $row->pid) . '">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm  rounded-circle"><img src="' . base_url('userfiles/employee/' . $row->picture) . '" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">' . $row->name . '</h6>
                          <p class="notification-text font-small-3 text-muted">' . $row->{'title'} . '</p><small>
                            <time class="media-meta text-muted" datetime="' . $row->{'date_sent'} . '">' . $row->{'date_sent'} . '</time></small>
                        </div>
                      </div></a>';
                                        }
                                        ?>    
                                    </li>
                                    <li class="dropdown-menu-footer">
                                        <a class="dropdown-item text-muted text-center" href="<?php echo base_url('messages') ?>"><?php echo $this->lang->line('Read all messages') ?></a>
                                    </li>
                                </ul>
                            </li>
                            <?php if ($this->aauth->auto_attend()) { ?>
                                <li class="dropdown dropdown-d nav-item">
                                    <?php
                                    if ($this->aauth->clock()) {

                                        echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon spinner icon-clock"></i><span class="badge badge-pill badge-default badge-success badge-default badge-up">' . $this->lang->line('On') . '</span></a>';
                                    } else {
                                        echo ' <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon icon-clock"></i><span class="badge badge-pill badge-default badge-warning badge-default badge-up">' . $this->lang->line('Off') . '</span></a>';
                                    }
                                    ?>

                                    <ul class="dropdown-menu dropdown-menu-right border-primary border-lighten-3 text-center">
                                        <img src="<?php echo base_url("assets/images/clock.png"); ?>">
                                        <?php
                                        echo '<span class="p-1 text-dark"><strong>' . $this->lang->line('Attendance') . ':</strong></span>';
                                        if (!$this->aauth->clock()) {
                                            echo '<a href="' . base_url() . '/dashboard/clock_in" class="btn btn-outline-success  btn-outline-white btn-md ml-1 mr-1" ><span class="icon-toggle-on" aria-hidden="true"></span> ' . $this->lang->line('ClockIn') . ' <i
                                    class="ficon icon-clock spinner"></i></a>';
                                        } else {
                                            echo '<a href="' . base_url() . '/dashboard/clock_out" class="btn btn-outline-danger  btn-outline-white btn-md ml-1 mr-1" ><span class="icon-toggle-off" aria-hidden="true"></span> ' . $this->lang->line('ClockOut') . ' </a>';
                                        }
                                        ?>

                                        <br><br>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span  class="avatar avatar-online">
                                        <img  src="<?php echo base_url('userfiles/employee/thumbnail/' . $this->aauth->get_user()->picture) ?>" alt="avatar">
                                    </span>
                                    <span class="user-name"><?php echo $this->lang->line('Account') ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item align-items-center" href="<?php echo base_url(); ?>user/profile">
                                        <img src="<?php echo base_url("assets/images/profile.png"); ?>"> <span><?php echo $this->lang->line('Profile') ?></span>
                                    </a>
                                    <a href="<?php echo base_url(); ?>user/attendance" class="dropdown-item">
                                        <img src="<?php echo base_url("assets/images/attend.png"); ?>"> <span><?php echo $this->lang->line('Attendance') ?></span></a>
                                    <a href="<?php echo base_url(); ?>user/holidays" class="dropdown-item">
                                        <img src="<?php echo base_url("assets/images/holiday.png"); ?>"> <span><?php echo $this->lang->line('Holidays') ?></span></a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>">
                                        <img src="<?php echo base_url("assets/images/logout.png"); ?>"> <span><?php echo $this->lang->line('Logout') ?></span>
                                    </a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>


        
        <div id="c_body"></div>
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <!-- Horizontal navigation-->
        <div id="notify" class="alert mt-2" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>
        <div id="thermal_a" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <div class="message"></div>
        </div>



