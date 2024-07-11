<?= $this->extend('Logistics/Logistics'); ?>
<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} ?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Payment Mode</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>admin/payment-mode">Payment Mode</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-info">
                                    Update Payment Mode
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/payment-mode" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div> 
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating">
                                            <input type="text" name="method" value="<?= $mode->method ?>" id="method" class="form-control form-control-sm" placeholder="method" autocomplete="off" required="" />
                                            <label for="method" class="form-label">Method <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('method', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['method'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit" />
                                        <a href="<?= base_url('admin/payment-mode') ?>" class="btn btn-danger btn-sm">
                                                Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?> 

<?= $this->endSection(); ?>