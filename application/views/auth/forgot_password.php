<?php $this->load->view('auth/template/head'); ?>

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
                        <h4 class="mt-0"><?php echo lang('forgot_password_heading'); ?></h4>
                        <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>

                        <!-- form -->
                        <?php echo form_open("auth/forgot_password"); ?>

                        <div class="form-group mb-3">
                              <label for="identity"><?php echo (($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></label>
                              <!-- <input class="form-control" type="email" name="<?= $identity ?>" id="identity" required="" placeholder="Enter your email"> -->
                              <?php $data = array(
                                    'type'  => 'email',
                                    'name'  => 'identity',
                                    'id'    => 'email',
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter your email'
                              );
                              echo form_input($data); ?>
                        </div>

                        <div class="form-group mb-0 text-center">
                              <button class="btn btn-primary waves-effect waves-light btn-block" type="submit"> Reset Password </button>
                        </div>

                        <?php echo form_close(); ?>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                              <p class="text-muted">Back to <a href="<?= base_url('') ?>" class="text-muted ml-1"><b>Log in</b></a></p>
                        </footer>

                  </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
      </div>
      <!-- end auth-fluid-form-box-->

      <?php $this->load->view('auth/template/footer'); ?>