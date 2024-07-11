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
                    <h3 class="mb-0">Country</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>countries">Countries</a>
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
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-success">
                                    All Countries
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/countries" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating">
                                            <input type="text" name="shortname" value="<?= set_value('shortname'); ?>" id="shortname" class="form-control form-control-sm" placeholder="shortname Name" autocomplete="off" required=""/>
                                            <label for="shortname" class="form-label">Short Name <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('shortname', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['shortname'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating">
                                            <input type="text" name="name" value="<?= set_value('name'); ?>" id="name" class="form-control form-control-sm" placeholder="Country Name" autocomplete="off" required=""/>
                                            <label for="name" class="form-label">Country Name <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('name', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['name'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating">
                                            <input type="text" name="phonecode" value="<?= set_value('phonecode'); ?>" id="phonecode" class="form-control form-control-sm" placeholder="Phone Code" autocomplete="off" required=""/>
                                            <label for="phonecode" class="form-label"> Phone Code <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('phonecode', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['phonecode'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <input type="submit" class="btn btn-success btn-sm" value="Submit" />
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