<?= $this->extend('Logistics/Logistics') ?>
<?= $this->section('content') ?>
<?php
$errors = [];
if (session()->has('errors')) {
    $errors = session()->get('errors');
} 
?>
<main class="app-main"><!--begin::App Content Header-->
    <div class="app-content-header"><!--begin::Container-->
        <div class="container-fluid"><!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit New User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">Back</a>
                        </li>
                    </ol>
                </div>
            </div><!--end::Row-->
        </div><!--end::Container-->
    </div><!--end::App Content Header--><!--begin::App Content-->
    <div class="app-content"><!--begin::Container-->
        <div class="container-fluid"><!--begin::Row-->
            <div class="row g-4">
                <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card card-dafault mb-4"><!--begin::Header-->
                            <div class="card-header">
                            </div>
                            <div class="card-body mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" required value="<?= $user->name ?>" placeholder="Full Name">
                                        <?php if (isset($errors['name'])) : ?>
                                            <div class="text-danger">
                                                <?= $errors['name'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                        <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" class="form-control" name="mobile" id="mobile" required value="<?= $user->mobile ?>" placeholder="9691****71">
                                        <?php if (isset($errors['mobile'])) : ?>
                                            <div class="text-danger">
                                                <?= $errors['mobile'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" required value="<?= $user->email ?>" placeholder="jhon@wick.co">
                                        <?php if (isset($errors['email'])) : ?>
                                            <div class="text-danger">
                                                <?= $errors['email'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="profile" class="form-label">Profile</label>
                                        <input type="file" class="form-control" name="profile" id="profile"> 
                                        <?php if (isset($errors['profile'])) : ?>
                                            <div class="text-danger">
                                                <?= $errors['profile'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="role" class="form-label">Select Role <span class="text-danger">*</span></label>
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="">Select User Role</option>
                                            <?php foreach ($roles as $role_key => $role_value) : ?>
                                                <option value="<?= $role_value->id ?>" <?= $user->role == $role_value->id ? 'selected' : '' ?>>
                                                    <?= $role_value->name ?>
                                                </option>
                                            <?php endforeach;  ?>
                                        </select>
                                        <?php if (isset($errors['confirm_password'])) : ?>
                                            <div class="text-danger">
                                                <?= $errors['confirm_password'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="password" class="form-label">Profile </label><br>
                                        <img width="120px" class="rounded-circle" src="<?= base_url($user->profile ?? 'dist/assets/img/default.jpg') ?>" alt="">
                                    </div>   
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--end::Container-->
    </div><!--end::App Content-->
</main>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- write js here -->
<?= $this->endSection() ?>