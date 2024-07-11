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
                    <h3 class="mb-0">Financial year</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>admin/FinancialYears">Financial year</a>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-primary">
                                    Update Financial Year
                                </h5>
                            </div>
                            <a href="<?= base_url('admin/FinancialYears'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row"> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating">
                                            <input type="date" name="start_date" value="<?= set_value('start_date'); ?>" id="start_date" class="form-control form-control-sm" placeholder="start_date" autocomplete="off" required="" />
                                            <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('start_date', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['start_date'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating">
                                            <input type="date" name="end_date" value="<?= set_value('end_date'); ?>" id="end_date" class="form-control form-control-sm" placeholder="end_date" autocomplete="off" required="" />
                                            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('end_date', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['end_date'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating">
                                            <input type="text" name="year" value="<?= set_value('year'); ?>" id="year" class="form-control form-control-sm" minlength="6" maxlength="7" placeholder="year" autocomplete="off" required="" />
                                            <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('year', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['year'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit" />
                                        <input type="reset" class="btn btn-danger btn-sm" />
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