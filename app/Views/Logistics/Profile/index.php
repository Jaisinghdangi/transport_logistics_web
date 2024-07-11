<?= (session()->get('check_employee') == 'true' || session()->has('CompId')) ? $this->extend('Company/layout') :$this->extend('Logistics/Logistics') ; ?>


<?//= $this->extend('Logistics/Logistics') ?>
<?= $this->section('content') ?>
<?php
$errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} 
?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message') ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Profile</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end"> 
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"> 
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url(session()->has('user_data') ? session()->get('user_data')['profile'] ?? 'dist/assets/img/default.jpg  ' : '') ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= session()->has('user_data') ? session()->get('user_data')['name'] ?? '' : '' ?></h3>
                            <p class="text-muted text-center"><?= get_role(session()->get('user_data')['role']) ?>
                            </p> 

                            <span>Since :- <?= session()->has('user_data') ? session()->get('user_data')['date'] ?? '' : '' ?></span>

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div> 
                    </div>
                </div> 
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-bs-toggle="pill" href="#profile">My Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="change_password-tab" data-bs-toggle="pill" href="#change_password">Change Password</a>
                                </li> 
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="profile">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" required value="<?= session()->get('user_data')['name'] ?? '' ?>" placeholder="Your Name">
                                                <?php if (array_key_exists('name', $errors)) : ?>
                                                    <div class="text-danger"><?= $errors['name']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email" required value="<?= session()->get('user_data')['email'] ?? '' ?>" placeholder="Your Email">
                                                <?php if (array_key_exists('email', $errors)) : ?>
                                                    <div class="text-danger"><?= $errors['email']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="mobile" class="form-label">Mobile<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" required value="<?= session()->get('user_data')['mobile'] ?? '' ?>" placeholder="Your Mobile" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11">
                                                <?php if (array_key_exists('mobile', $errors)) : ?>
                                                    <div class="text-danger"><?= $errors['mobile']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="profile" class="form-label">Profile</label>
                                                <input type="file" class="form-control" name="profile" id="profile">
                                                <?php if (array_key_exists('profile', $errors)) : ?>
                                                    <div class="text-danger"><?= $errors['profile']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-success">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="change_password">
                                    <form action="<?= base_url('admin/change-password') ?>" method="post">
                                        <div class="mb-3">
                                            <label for="current_Password" class="form-label">Current Password<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="current_Password" name="current_Password" required placeholder="Current Password">
                                            <?php if (array_key_exists('current_Password', $errors)) : ?>
                                                <div class="text-danger"><?= $errors['current_Password']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_Password" class="form-label">New Password<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="new_Password" name="new_Password" required placeholder="New Password">
                                            <?php if (array_key_exists('new_Password', $errors)) : ?>
                                                <div class="text-danger"><?= $errors['new_Password']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirm_Password" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="confirm_Password" name="confirm_Password" required placeholder="Confirm Password">
                                            <?php if (array_key_exists('confirm_Password', $errors)) : ?>
                                                <div class="text-danger"><?= $errors['confirm_Password']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- write js here -->
<script>
    $('#datatable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
</script>
<?= $this->endSection() ?>