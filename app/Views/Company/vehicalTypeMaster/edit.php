<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<style>
    /* Hide the default checkbox */
    .switch input {
        display: none;
    }

    /* Style the switch */
    .switch label {
        display: inline-block;
        width: 60px;
        height: 34px;
        background-color: #ccc;
        border-radius: 17px;
        position: relative;
    }

    /* Style the switch handle */
    .switch label::after {
        content: '';
        position: absolute;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: white;
        top: 4px;
        left: 4px;
        transition: left 0.3s;
    }

    /* Move the handle when the checkbox is checked */
    .switch input:checked+label::after {
        left: 30px;
    }

    /* Change background color when the switch is on */
    .switch input:checked+label {
        background-color: #2196F3;
    }

    .validationResult {
        color: red;
    }
    .ck-editor__editable[role="textbox"] {
                /* Editing area */
                min-height: 200px;
            }
</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                        <a href="<?= base_url('company/vehical-type-master'); ?>">Vehical Type Master</a>
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
                              Update  Vehical Type Master                                 
                                   
                                  
                                </h5>
                            </div>
                          
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="width" class="form-label">Width<span class="text-danger">*</span></label>
                            <input type="number"  class="form-control" name="width" value="<?= $VehicalType->width;?>" required>

                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="height" class="form-label">Height <span class="text-danger">*</span></label>
                                <input type="number"  class="form-control" name="height"  value="<?= $VehicalType->height;?>" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="length" class="form-label">Length<span class="text-danger">*</span></label>
                                        <input type="number"  class="form-control" name="length" value="<?= $VehicalType->length;?>"  required>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="vehical_type" class="form-label">Vehical Type<span class="text-danger">*</span></label>
                                        <input type="text"  class="form-control" name="vehical_type" value="<?= $VehicalType->vehical_type;?>" required>
                                    </div>
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="capacity" class="form-label">Capacity<span class="text-danger">*</span></label>
                                        <input type="number"  class="form-control" name="capacity" value="<?= $VehicalType->capacity;?>" required>

                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="groundclearance" class="form-label">Ground Clearance<span class="text-danger">*</span></label>
                                        <input type="text"  class="form-control" name="groundclearance" value="<?= $VehicalType->groundclearance;?>" required>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <button type="submit" id="submit_btn" class="btn btn-primary btn-sm" value="Submit" >Submit</button>
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