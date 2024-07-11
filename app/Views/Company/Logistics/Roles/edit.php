<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>
<?php
$errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} 
?>
<main class="app-main"><!--begin::App Content Header-->
    <div class="app-content-header"><!--begin::Container-->
        <div class="container-fluid"><!--begin::Row--> 
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Role</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('company/roles') ?>" class="btn btn-secondary">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div> 
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <form method="post">
                        <?= csrf_field(); ?>
                        <div class="card card-dafault mb-4">
                            <div class="card-header">
                            </div>
                            <div class="card-body mb-3">
                                <div class="row">
                                        <div class="col-md-3">
                                            <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required value="<?= $role->name ?>" placeholder="Role Name">
                                            <?php if (isset($errors['name'])) : ?>
                                                <div class="form-text">
                                                    <?= $errors['name'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php 
                                            $permissions = $role->permissions;
                                            $role_permissions = [];
                                            if($permissions !== null){
                                                $role_permissions = explode(',', $permissions);
                                            } 
                                        ?>
                                        <div class="col-md-6">
                                            <label for="permissions" class="form-label">Permissions</label><br>
                                            <input class="m-2" type="checkbox" name="permissions[]" id="roles" value="add" <?= in_array('add', $role_permissions) ? 'checked' : '' ?>>Add |
                                            <input class="m-2" type="checkbox" name="permissions[]" id="roles" value="edit" <?= in_array('edit', $role_permissions) ? 'checked' : '' ?>>Edit |
                                            <input class="m-2" type="checkbox" name="permissions[]" id="roles" value="delete" <?= in_array('delete', $role_permissions) ? 'checked' : '' ?>>Delete |
                                            <input class="m-2" type="checkbox" name="permissions[]" id="roles" value="view" <?= in_array('view', $role_permissions) ? 'checked' : '' ?>>View |
                                            <input class="m-2" type="checkbox" name="permissions[]" id="roles" value="print" <?= in_array('print', $role_permissions) ? 'checked' : '' ?>>Print
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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