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
                            <a href="<?= base_url(); ?>company/terms-condition">Code Prefix Master</a>
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
                              Add Code Prefix                                  
                                   
                                  
                                </h5>
                            </div>
                          
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                                <div class="row">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="series_type" class="form-label">Select Series Type <span class="text-danger">*</span></label>
                                        <select name="series_type" id="series_type" class="form-control" required >
                                                <option value="">Select Series Type</option>
                                                <option value="Consignee"  >Consignee</option>
                                                <option value="Consignor"  >Consignor</option>
                                                <option value="Broker"  >Broker</option> 
                                            </select>
                                        
                                    </div>
                                    <!-- <br> <br> -->
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-42"> 
                                        <label for="first_prefix" class="form-label">First Prefix<span class="text-danger">*</span></label>
                                  <input type="text" name="first_prefix" id="first_prefix" placeholder="enter Alphabetic  character..."  class="form-control" required>                                   
                                 </div>
                                 <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="second_prefix" class="form-label">Second Prefix<span class="text-danger">*</span></label>
                                  <input type="number" name="second_prefix" id="second_prefix" placeholder="enter number..."  class="form-control" required>                                   
                                 </div>
                                    <input type="hidden" name="comp_id" value="<?= session()->get('CompId');?>" id="comp_id"  />
                                    <input type="hidden" name="user_id" value="<?= session()->get('user_data')['id'] ; ?>" id="user_id"   />
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

// $(document).ready(function() {
    $('#first_prefix').on('input', function() {
        var inputValue = $(this).val();
        $(this).val(inputValue.toUpperCase());
    });
// });

    $(document).on("change", "#series_type", function() {
        var series_types =  $(this).val();
        var terms = <?php echo json_encode($code_prepix); ?>;
        for (var i = 0; i < terms.length; i++) {
         if(terms[i].series_type == series_types){
     alert('this Series Types alredy exist, choose another');
            $(this).val('');
         }
        }
    });
   
</script>
<?= $this->endSection(); ?>