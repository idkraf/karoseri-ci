<body class="horizontal-layout horizontal-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
      data-open="hover" data-menu="horizontal-menu" data-col="1-column">
    <div class="app-content container">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="card border border-1 shadow rounded bg-light" style="margin-top:11rem">
                    <div class="card-header border-0 bg-light">
                        <div class="card-title text-center">
                            <img class=" mt-1"
                                 src="<?php echo base_url('userfiles/company/') . $this->config->item('logo'); ?>"
                                 alt="logo" style="max-height: 10rem;  max-width: 10rem;">
                        </div>
                        <h6 class="text-muted text-center">
                            <span>Welcome Again</span></h6>
                    </div>
                    <div class="card-body bg-light p-4">
                        <?php
                        $attributes = array('id' => 'login_form');
                        echo form_open('user/checklogin', $attributes);
                        ?>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" class="form-control  rounded-0" id="user-name" name="username"
                                   placeholder="<?php echo $this->lang->line('Your Email') ?>" required>
                            <div class="form-control-position">
                                <i class="ft-user"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control rounded-0" id="user-password" name="password"
                                   placeholder="<?php echo $this->lang->line('Your Password') ?>" required>
                            <div class="form-control-position">
                                <i class="fa fa-key"></i>
                            </div>
                        </fieldset>
                        <?php
                        if ($response) {
                            echo '<div id="notify" class="alert alert-danger">
                            <a href="#" class="btn btn-danger btn-sm" data-dismiss="alert">&times;</a> <div class="message">' . $response . '</div>
                        </div>';
                        }
                        ?>
                        <div class="form-group">
                            <fieldset>
                                <input type="checkbox" id="remember-me" class="chk-remember"
                                       name="remember_me">
                                <label for="remember-me">  <?php echo $this->lang->line('remember_me') ?></label>
                            </fieldset>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-0" style="width:100%"><i
                                class="ft-unlock"></i> <?php echo $this->lang->line('login') ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= assets_url(); ?>app-assets/vendors/js/vendors.min.js"></script>
    <script type="text/javascript" src="<?= assets_url(); ?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script type="text/javascript" src="<?= assets_url(); ?>app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="<?= assets_url(); ?>app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="<?= assets_url(); ?>app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="<?= assets_url(); ?>app-assets/js/core/app-menu.js"></script>
    <script src="<?= assets_url(); ?>app-assets/js/core/app.js"></script>
    <script type="text/javascript" src="<?= assets_url(); ?>app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
    <script src="<?= assets_url(); ?>app-assets/js/scripts/forms/form-login-register.js"></script>
