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
                            <a href="<?= base_url(); ?>company/series_setting"> Series Setting</a>
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
                               Update Series Setting                                 
  </h5>
                            </div>
                          
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                                <div class="row">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="series_type" class="form-label">Series Type <span class="text-danger">*</span></label>
                                        <select name="series_type" id="series_type" class="form-control" required >
                                            <?php if(isset($SeriesType)): ?>
                                                <option value="">Select Series Type</option>
                                                <?php foreach($SeriesType as $Series_val): ?>
                                                    <option value="<?= $Series_val->id ?>"  <?=($seriesSetting->series_type == $Series_val->id) ? 'selected' : '' ;?>><?= $Series_val->name ?></option>
                                                <?php endforeach ?>
                                            <?php endif; ?>
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="prefix" class="form-label">Prefix<span class="text-danger">*</span></label>
                                 <input type="text" name="prefix" id="prefix" placeholder="enter Prefix ..." value ="<?=$seriesSetting->prefix ;?>" class="form-control" required>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="start_point" class="form-label">Start Point<span class="text-danger">*</span></label>
                                 <input type="text" name="start_point" id="start_point" placeholder="enter Start Point ..." class="form-control" value ="<?=$seriesSetting->start_point ;?>" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="symbl" class="form-label">Symbol<span class="text-danger">*</span></label>
                                 <input type="text" name="symbl" id="symbl" value ="<?=$seriesSetting->symbl ;?>"  placeholder="enter Symbol ..." class="form-control" required>
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

    <script>
    $(document).on("change", "#series_types", function() {
        var series_types =  $(this).val();
        var terms = <?php //echo json_encode($terms); ?>'';
        for (var i = 0; i < terms.length; i++) {
         if(terms[i].voucher_id == series_types){
     alert('this Series Types alredy exist, choose another');
            $(this).val('');
         }
        }
    });
    
</script>
<?= $this->endSection(); ?>