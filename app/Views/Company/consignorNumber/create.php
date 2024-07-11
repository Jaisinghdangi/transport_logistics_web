<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} ?>

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
                            <a href="<?= base_url(); ?>company/consignor">Consignor</a>
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
                                    Create Company Consignor Number
                                   
                                   
                                  
                                </h5>
                            </div>
                            <!-- <a href="<?//= base_url('company/consignor'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a> -->
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignor_code" class="form-label">Start Number<span class="text-danger">*</span></label>
                                        <input type="number" name="start_number" value="" id="start_number" class="form-control form-control-sm"  required />
                                        <span class="errormsg1" style="font-size: 11px;color: red;"></span>

                                    </div>
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignor_code" class="form-label">End Number<span class="text-danger">*</span></label>
                                        <input type="number" name="end_number" value="" id="end_number" class="form-control form-control-sm"  required />
                                        <span class="errormsg" style="font-size: 11px;color: red;"></span>

                                    </div>
                                    <input type="hidden" name="comp_id" value="<?= session()->get('CompId');?>" id="comp_id" class="form-control form-control-sm"  />
                                    <input type="hidden" name="user_id" value="<?= session()->get('user_data')['id'];?>" id="user_id" class="form-control form-control-sm"  />
                                   
                                   
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
   var lastEndValue = "<?= ($ConsignNumberValue) ? $ConsignNumberValue->end_number : ''; ?>";

   $(document).on("change", "#end_number", function() {
    let end_value = parseInt($(this).val()); // Parse the input value as integer
    let start_value = parseInt($('#start_number').val()); // Parse the input value as integer
    // Check for duplicates and validate against the range
        if (end_value > start_value) {
            $(".errormsg").text('');
        }else{
            $(".errormsg").text('End Number Must we greater then Start number');
           $(this).val(''); // Parse the input value as integer
           }
});
$(document).on("change", "#start_number", function() {
    let end_value = parseInt($('#end_number').val()); // Parse the input value as integer
    let start_value = parseInt($(this).val()); // Parse the input value as integer
    // Check for duplicates and validate against the range
    if(lastEndValue=='' || lastEndValue=='0'){
    }else{
        if (start_value > lastEndValue ) {
            $(".errormsg1").text('');
            if( end_value == '' || end_value =='0'){

          
            if(start_value < end_value){
            $(".errormsg1").text('');

         }else{
            $(".errormsg1").text('Start Number Must we Less then End Number');
        $(this).val(''); 
         }   }else{}
        }else{
            $(".errormsg1").text('Start Number Must we greater then Last Company Consignor End Number Number '+lastEndValue);
           $(this).val(''); // Parse the input value as integer
        }
    }    
});
</script>
<?= $this->endSection(); ?>