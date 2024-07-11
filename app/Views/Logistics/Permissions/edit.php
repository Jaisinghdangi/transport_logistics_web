<?= $this->extend('Logistics/Logistics') ?>
<?= $this->section('content') ?>
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
                    <h3 class="mb-0">Edit Permissions</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('admin/permissions') ?>" class="btn btn-secondary">Back</a>
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
                        <div class="card card-dafault mb-4"><!--begin::Header-->
                            <div class="card-header">
                            </div>
                            <div class="card-body mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Parent Module <span class="text-danger">*</span></label>
                                        <select name="parent" id="parent" class="form-control" required>
                                            <option value="">Select Parent</option>
                                            <option value="0" <?= $permission->parent_id  == '0' ? 'selected' : '' ?>>No Parent Module</option>
                                            <?php foreach ($permissions as $permission_key => $permission_value): ?>
                                                <option value="<?= $permission_value->id ?>" <?= $permission->parent_id  == $permission_value->id ? 'selected' : '' ?>>
                                                    <?= $permission_value->name ?>
                                                </option> 
                                            <?php endforeach;  ?>
                                        </select>  
                                        <?php if(array_key_exists('parent', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['parent'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" required value="<?= $permission->name ?>">
                                        <?php if(isset($validation) && $validation->hasError('name')): ?> 
                                            <div class="form-text">
                                                <?= $validation->getError('name') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="url" class="form-label">Url<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="url" id="url" required value="<?= $permission->url ?>">
                                        <?php if(isset($validation) && $validation->hasError('url')): ?> 
                                            <div class="form-text">
                                                <?= $validation->getError('url') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="icon" id="icon" required value="<?= $permission->icon ?>">
                                        <?php if(isset($validation) && $validation->hasError('icon')): ?> 
                                            <div class="form-text">
                                                <?= $validation->getError('icon') ?>
                                            </div>
                                        <?php endif; ?>
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