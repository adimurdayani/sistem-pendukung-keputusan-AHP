<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-left">
                    <div class="auth-logo">
                        <a href="index.html" class="logo logo-dark text-center">
                            <span class="logo-lg">
                                <img src="<?= base_url() ?>assets/images/logo-dark.png" alt="" height="22">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light text-center">
                            <span class="logo-lg">
                                <img src="<?= base_url() ?>assets/images/logo-light.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                </div>

                <!-- title-->
                <h4 class="mt-0">Sign Up</h4>
                <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute</p>
                <?= $this->session->flashdata('sukses'); ?>
                <!-- form -->
                <form action="<?= base_url('auth/register') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input class="form-control" type="text" name="first_name" id="firstname" value="<?= set_value('first_name') ?>" placeholder="Enter your first name">
                                <?= form_error('first_name', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input class="form-control" type="text" name="last_name" id="last_name" value="<?= set_value('last_name') ?>" placeholder="Enter your last name">
                                <?= form_error('last_name', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailaddress">Email address</label>
                        <input class="form-control" type="email" name="email" id="emailaddress" value="<?= set_value('email') ?>" placeholder="Enter your email">
                        <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="number" name="phone" id="phone" value="<?= set_value('phone') ?>" placeholder="Enter your phone">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="terxt" name="username" value="<?= set_value('username') ?>" id="username" placeholder="Enter your email">
                        <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                            <div class="input-group-append" data-password="false">
                                <div class="input-group-text">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm"> Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Enter your password confirm">
                            <?= form_error('password_confirm', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary waves-effect waves-light btn-block" type="submit"> Sign Up </button>
                    </div>
                </form>
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Already have account? <a href="<?= base_url() ?>" class="text-muted ml-1"><b>Log In</b></a></p>
                </footer>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->