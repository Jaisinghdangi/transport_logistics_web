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
                    <h3 class="mb-0">States</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>states">States</a>
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
                                    Create States
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/states" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                        echo view('Components/countries', ['data' => $countries, 'required'=>true, 'label'=>'Country', 'name'=>'country_id', 'error'=>array_key_exists('country_id', $errors) ? $errors['country_id'] : '', 'value'=>$state->country_id]); 

                                        echo view('Components/input', ['required'=>true, 'label'=>'State Name', 'name'=>'name', 'placeholder'=>'State Name','error'=>array_key_exists('name', $errors) ? $errors['name'] : '', 'value'=>$state->name]);
                                    ?> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="state_code" class="form-label">State Code <span class="text-danger">*</span></label>  
                                        <input type="tel" name="state_code" value="<?= $state->state_code; ?>" id="state_code" class="form-control form-control-sm" placeholder="State Code" required minlength="1" maxlength="2"/>
                                        <?php if(array_key_exists('state_code', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['state_code'];  ?></div>
                                        <?php endif; ?>
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