<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    <head>
        <title>New Password | Sunpro Logistics Private Limited</title>
        <!--begin::Primary Meta Tags-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="title" content="Sunpro Logistics Private Limited | Login" />
        <meta name="author" content="Sunpro Logistics Private Limited" />
        <meta name="description" content="Sunpro Logistics Private Limited | Login" />
        <meta name="keywords" content="Sunpro Logistics Private Limited | Login" />
        <!--end::Primary Meta Tags-->
        <link type="image/png" rel="shortcut icon" href="<?= base_url(); ?>Assets/Images/Favicon.png" />
        <!--begin::Fonts-->
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>Assets/Css/index.css" />
        <!--end::Fonts-->
        <!--begin::Third Party Plugin(Overlay Scrollbars)-->
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>Assets/Css/overlayscrollbars.min.css" />
        <!--end::Third Party Plugin(Overlay Scrollbars)-->
        <!--begin::Third Party Plugin(Bootstrap Icons)-->
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>Assets/Css/bootstrap-icons.min.css" />
        <!--end::Third Party Plugin(Bootstrap Icons)-->
        <!--begin::Required Plugin(Admin LTE)-->
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>Assets/Css/adminlte.css" />
        <!--end::Required Plugin(Admin LTE)-->
    </head> 
    <?php
        $errors = [];
        if(session()->has('errors')){
            $errors = session()->get('errors');
        } 
    ?>
    <body class="login-page bg-body-secondary">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <a href="<?= base_url(); ?>index" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                        <h1 class="mb-0">
                            <b>Sunpro</b> Logistics
                        </h1>
                    </a>
                </div>
                <div class="card-body login-card-body"> 
                    <p class="login-box-msg">Create New Password</p> 
                    <div class="row">
                        <div class="col-12">
                            <?php if(session()->has('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->get('success') ?>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->has('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->get('error') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <form method="POST">
                        <div class="input-group mb-1">
                            <div class="form-floating">
                                <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6" id="otp" class="form-control form-control-sm" placeholder="******" name="otp" required />
                                <label for="email">OTP</label> 
                                <?php if(array_key_exists('otp', $errors)): ?>  
                                    <div class="text-danger"> <?= $errors['otp'];  ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="input-group-text">
                                <span class="bi bi-key"></span>
                            </div>
                        </div>
                        <div class="input-group mb-1"> 
                            <div class="form-floating">
                                <input type="password" id="new_password" class="form-control form-control-sm" placeholder="" name="new_password" required />
                                <label for="new_password">New Password</label>
                                <?php if(array_key_exists('new_password', $errors)): ?>  
                                    <div class="text-danger"> <?= $errors['new_password'];  ?></div>
                                <?php endif; ?>
                            </div> 
                            <div class="input-group-text">
                                <span class="bi bi-lock"></span>
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="form-floating">
                                <input type="password" id="confirm_password" class="form-control form-control-sm" placeholder="" name="confirm_password" required />
                                <label for="email">Confirm Password</label>
                                <?php if(array_key_exists('confirm_password', $errors)): ?>  
                                    <div class="text-danger"> <?= $errors['confirm_password'];  ?></div>
                                <?php endif; ?>
                            </div> 
                            <div class="input-group-text">
                                <span class="bi bi-lock"></span>
                            </div>
                        </div>
                        
                        <div class="row justify-content-center">  
                            <div class="col-12">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="mb-1">
                        <a href="<?= base_url(); ?>">Back To Login</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        <!--begin::Third Party Plugin(Overlay Scrollbars)-->
        <script type="text/javascript" src="<?= base_url(); ?>Assets/Js/overlayscrollbars.browser.es6.min.js"></script>
        <!--end::Third Party Plugin(Overlay Scrollbars)-->
        <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
        <script type="text/javascript" src="<?= base_url(); ?>Assets/Js/popper.min.js"></script>
        <!--end::Required Plugin(popper js for Bootstrap 5)-->
        <!--begin::Required Plugin(Bootstrap 5)-->
        <script type="text/javascript" src="<?= base_url(); ?>Assets/Js/bootstrap.min.js"></script>
        <!--end::Required Plugin(Bootstrap 5)-->
        <!--begin::Required Plugin(AdminLTE)-->
        <script type="text/javascript" src="<?= base_url(); ?>Assets/Js/adminlte.js"></script> 
    </body>
    <!--end::Body-->
</html>