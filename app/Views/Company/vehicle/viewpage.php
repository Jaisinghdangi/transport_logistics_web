<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>
<?php $errors = [];
if (session()->has('errors')) {
    $errors = session()->get('errors');
} ?>
<style>
label {font-weight: bold;}
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container-fluid {
    /* margin-top: 20px; */
}

/* Card Styles */
.card {
    /* border-radius: 10px; */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-header {
    /* background-color: #007bff; */
    background-color: #b0744b;
    color: #fff;
    border-radius: 10px 10px 0 0;
    /* padding: 15px; */
}
.card-title{
    margin-bottom:0px;
}
.card-body {
    background-color: #fff;
    padding: 20px;
}

/* Form Styles */
.form-label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Text Colors */
.text-primary {
    color: #007bff;
}

.text-danger {
    color: #dc3545;
    display: none;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .card-header {
        border-radius: 10px;
    }
}
h4{  
    background-color: #1a285d;
    color: white;
    font-weight: 600;
}

.card.card-outline {
    border-top: 3px solid #b0744b;
}
.row{padding-top: 15px;}
.empty{    
    color: red;
}
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row"  style="padding-top:0px;">
                <div class="col-sm-6">
                    <h3 class="mb-0">Vehicle</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item">Broker</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/broker">Vehicle</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row"  style="padding-top:0px;">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-white">
                                    View Vehicle Details
                                </h5>
                            </div>
                            <a href="<?= base_url('company/vehicles'); ?>" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                            
                                <div class="row" style="padding-top:0px;">
                                <h4>
                                    Owner Detail
                                </h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="broker" class="form-label">Owner Name <span class="text-danger">*</span></label>
                                       <br> <span><?=($vehicle->owner_name) ?  $vehicle->owner_name : '<span class="empty">Empty</span>'?><span>

                                    
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="vehicle_number" class="form-label">Son/Daughter/Wife of<span class="text-danger">*</span></label>
                                       <br> <span><?=($vehicle->owner_relative) ?  $vehicle->owner_relative : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    </div>
                             
                                <div class="row">
                                <h4>
                                    Vehicle Details
                                </h4>
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="vehicle_number" class="form-label">Vehicle No. <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->vehicle_number) ?  $vehicle->vehicle_number : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="model_number" class="form-label">Model No. <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->model_number) ?  $vehicle->model_number : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="make" class="form-label">Maker Name </label>
                                        <br> <span><?=($vehicle->make) ?  $vehicle->make : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                                        <br> <span><?= ($vehicle->color) ?  $vehicle->color : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="registered_date" class="form-label">Registered Date <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->registered_date) ?  $vehicle->registered_date : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="chassis_number" class="form-label">Chassis No. <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->chassis_number) ?  $vehicle->chassis_number : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="engine_number" class="form-label">Engine Number </label>
                                        <br> <span><?=($vehicle->engine_number) ?  $vehicle->engine_number : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="tax_token" class="form-label">Tax Valid UpTo  </label>
                                        <br> <span><?=($vehicle->tax_token) ?  $vehicle->tax_token : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="road_permmit" class="form-label">Vehicle  Class</label>
                                        <br> <span><?=($vehicle->vehicle_class) ?  $vehicle->vehicle_class : '<span class="empty">Empty</span>'?><span>
                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="road_permmit" class="form-label">Vehicle  Description</label>
                                        <br> <span><?=($vehicle->vehicle_description) ?  $vehicle->vehicle_description : '<span class="empty">Empty</span>' ?><span>
                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="fuel_type" class="form-label">Fuel Type<span class="text-danger">*</span></label>
                                      <br>   
                                      <?php if($vehicle->fuel_type == 'Diesel'){
                                             echo 'Diesel';  
                                            }else if($vehicle->fuel_type == 'Petrol'){
                                                echo   'Petrol';
                                             }else if($vehicle->fuel_type == 'CNG'){
                                                echo 'CNG';
                                             }else{
                                                echo '<span class="empty">Empty</span>';
                                             } ?>
                                     
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="emission_norm" class="form-label">Emission Norms</label>
                                        <br> <span><?=($vehicle->emission_norm) ?  $vehicle->emission_norm : '<span class="empty">Empty</span>'?><span>
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="seat_capacity" class="form-label">Seat Capacity</label>
                                        <br> <span><?=($vehicle->seat_capacity) ?  $vehicle->seat_capacity : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="standing_capacity" class="form-label">Standing Capacity</label>
                                        <br> <span><?= ($vehicle->standing_capacity) ?  $vehicle->standing_capacity : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                   
                              
                                </div>
                               
                                <div class="row mt-2">
                                <h4>
                                    Insurance Details
                                </h4>
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="financed_by" class="form-label">Financier</label>
                                        <br> <span><?=($vehicle->financed_by) ?  $vehicle->financed_by : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_by" class="form-label">Insurance Company  </label>
                                        <br> <span><?= ($vehicle->insurance_by) ?  $vehicle->insurance_by : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="fitness_validity" class="form-label">Fitness Valid UpTo  <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->fitness_validity) ?  $vehicle->fitness_validity : '<span class="empty">Empty</span>'?><span>
                                    </div>
                                   
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_date" class="form-label">Insurance Valid UpTo <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->insurance_date) ?  $vehicle->insurance_date : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_policy_no" class="form-label">Insurance Policy No. </label>
                                        <br> <span><?= ($vehicle->insurance_policy_no) ?  $vehicle->insurance_policy_no : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                   
                                </div> 
                                <div class="row mt-2">
                                    <h4>
                                    Other  Details
                                    </h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="puccno" class="form-label">PUCC No. <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->puccno) ?  $vehicle->puccno : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="pucc_validity" class="form-label">PUCC Valid UpTo <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->pucc_validity) ?  $vehicle->pucc_validity : '<span class="empty">Empty</span>'?><span>
                                       
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="national_permit_no" class="form-label">National Permit No.<span class="text-danger">*</span></label>
                                        <br> <span><?= ($vehicle->national_permit_no) ?  $vehicle->national_permit_no : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="national_permit_validity" class="form-label">National Permit Valid UpTo<span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->national_permit_validity) ?  $vehicle->national_permit_validity : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                
                                    
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="permit_validity" class="form-label">Permit Valid UpTo<span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->permit_validity) ?  $vehicle->permit_validity : '<span class="empty">Empty</span>'?><span>
                                        
                                    </div>
                                  
                                </div>
                                <div class="row mt-2">
                                    <h4>
                                    Driver Details
                                    </h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="puccno" class="form-label">Driver Name </label>
                                        <br> <span><?=($vehicle->driver_name) ?  $vehicle->driver_name : '<span class="empty">Empty</span>'?><span>
                                
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="pucc_validity" class="form-label">Driver Mobile <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->driver_mobile) ?  $vehicle->driver_mobile : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="pucc_validity" class="form-label">Driver Licence No. <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->driving_licence_no) ?  $vehicle->driving_licence_no : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="pucc_validity" class="form-label">Driver Address <span class="text-danger">*</span></label>
                                        <br> <span><?=($vehicle->driver_address) ?  $vehicle->driver_address : '<span class="empty">Empty</span>'?><span>
                                       
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
  
 
</script>
<?= $this->endSection(); ?>