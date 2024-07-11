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
                    <h3 class="mb-0">Add New User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('admin/roles') ?>" class="btn btn-secondary">Back</a>
                        </li>
                    </ol>
                </div>
            </div><!--end::Row-->
        </div><!--end::Container-->
    </div><!--end::App Content Header--><!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <form action="<?= base_url('admin/store-roles') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card card-dafault mb-4">
                            <div class="card-header">
                            </div>
                            <div class="card-body mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" required value="<?= set_value('name') ?>" placeholder="Role Name">
                                        <?php if (isset($errors['name'])) : ?>
                                            <div class="form-text">
                                                <?= $errors['name'] ?>
                                            </div>
                                        <?php endif; ?>
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