<?php $this->load->view('auth/template/head', FALSE); ?>
<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-left">
                    <div class="auth-logo">
                        <a href="index.html" class="logo logo-light text-center">
                            <span class="logo-lg">
                                <img src="<?= base_url() ?>assets/images/logo-light.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                </div>

                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your email address and password to access account.</p>
                <?= $this->session->flashdata('message');
                ?>
                <!-- form -->
                <?php echo form_open("auth/login"); ?>
                <div class="form-group">
                    <label for="emailaddress">Email address</label>
                    <input class="form-control" type="email" id="emailaddress" name="identity" value="<?= set_value('identity') ?>" required="" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <a href="forgot_password" class="text-muted float-right"><small>Forgot your password?</small></a>
                    <label for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                    <label>Remember me</label>
                </div>
                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit">Log In </button>
                </div>
                <?php echo form_close(); ?>
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Don't have an account? <a href="<?= base_url('auth/register') ?>" class="text-muted ml-1"><b>Sign Up</b></a></p>
                </footer>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <?php $this->load->view('auth/template/footer', FALSE); ?>