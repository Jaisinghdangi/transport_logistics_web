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
    label{
        font-weight: bold;
    }
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
            <div class="row" style="padding-top:0px;">
                <div class="col-sm-6">
                    <h3 class="mb-0">Consignor</h3>
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
            <div class="row"  style="padding-top:0px;">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-white">
                                    View Consignor Detail
                                </h5>
                            </div>
                            <a href="<?= base_url('company/consignor'); ?>" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                                <div class="row" style="padding-top:0px;">
                                    <h4>Consignee Info</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignor_code" class="form-label">Consignee Code<span class="text-danger">*</span></label><br>
                                        <span><?= ($consign->consignor_code) ? $consign->consignor_code : '<span class="empty">Empty</span>' ?></span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignor_type" class="form-label">Company Type<span class="text-danger">*</span></label>
                                        <?php  $consignorType=''; foreach($business_types as $buss_val): ?>
                                           
                                                    <?php ($consign->consignor_type == $buss_val->id) ? $consignorType=$buss_val->name :'' ?> 
                                                <?php endforeach ?>
                                                <br>
                                        <span><?=($consignorType) ? $consignorType : '<span class="empty">Empty</span>'?></span>
                                        
                            
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="name" class="form-label">Consignor Name<span class="text-danger">*</span></label>
                                        <br><span><?= ($consign->name) ? $consign->name : '<span class="empty">Empty</span>' ?></span>
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="email" class="form-label">Consignor Email<span class="text-danger">*</span></label>
                                     <br>   <span><?=($consign->email) ? $consign->email : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="mobile" class="form-label">Mobile<span class="text-danger">*</span></label>
                                        <br>   <span><?=($consign->mobile) ? $consign->mobile : '<span class="empty">Empty</span>'?></span>
                                      
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="alternet_mobile" class="form-label">Alternet Mobile</label>
                                        <br>   <span><?=($consign->alternet_mobile) ? $consign->alternet_mobile : '<span class="empty">Empty</span>'?></span>
                                        
                                    </div>  
                                </div>

                                <div class="row mt-2">
                                    <h4>Consignor Address</h4> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <?php $country1='';foreach($countries as $country): ?>
                                                    <?php ($country->id  == $consign->country) ? $country1=$country->name : '' ?> 
                                                <?php endforeach ?>
                                                <br>
                                        <span><?=($country1) ? $country1 : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                        
                                                <br>
                                        <span  id="state"></span>
                                        
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                        <br>
                                        <span  id="district"></span>
                                        
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_1" class="form-label">Address Line 1<span class="text-danger">*</span></label><br>
                                       <span><?=($consign->address_1) ? $consign->address_1 : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_2" class="form-label">Address Line 2</label><br>
                                        <span><?=($consign->address_2) ? $consign->address_2 : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>
                               
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pin_code" class="form-label">Pin / Zip Code <span class="text-danger">*</span></label><br>
                                        <span><?=($consign->pin_code) ? $consign->pin_code : '<span class="empty">Empty</span>'?></span>
                                      
                                    </div>
                                </div> 

                                <div class="row">
                                    <h4>Other Info</h4>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="gst_status" class="form-label">GST register</label>
                                        <div class="row" style="padding-top:0px;">
                                            <div class="col-6">
                                            <span><?= $consign->gst_status == 1 ? 'Yes' : 'No'; ?></span>
                                            </div>
                                            
                                        </div>
                                    </div>

                                  
                                </div>
                                <div class="row" style="padding-top:0px;">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="msme_status" class="form-label">Registered under MSME</label>
                                        <div class="row" style="padding-top:0px;">
                                            <div class="col-6">
                                            <span><?= $consign->msme_status == 1 ? 'Yes' : 'No'; ?> </span>
                                            </div>
                                            
                                        </div>
                                    </div>

                                
                                </div>

                                <div class="row"> 
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pan_number" class="form-label">PAN Number</label>
                                        <br>
                                        <span><?=($consign->pan_number) ? $consign->pan_number : '<span class="empty">Empty</span>'?></span>
                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tan_number" class="form-label">TAN Number</label>
                                        <br>
                                        <span><?=($consign->tan_number) ? $consign->tan_number : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>
                                 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="iec_number" class="form-label">IEC Code</label>
                                        <br>
                                        <span><?=($consign->iec_number) ? $consign->iec_number : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <br>
                                        <span><?=($consign->contact_person) ? $consign->contact_person : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_mobile" class="form-label">Contact Person Mobile</label>
                                        <br>
                                        <span><?=($consign->contact_person_mobile) ? $consign->contact_person_mobile : '<span class="empty">Empty</span>'?></span>
                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_website" class="form-label">Company Website</label>
                                        <br>
                                        <span><?=($consign->company_website) ? $consign->company_website : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>
                                     
                                </div>
                                <div class="row"> 
                                <h4>Bank Detail</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_type" class="form-label">Account Type</label>
                                        <br>
                                        <?php if($consign->ac_type == 1){
                                             echo 'Saving A/c';  
                                            }else if($consign->ac_type == 2){
                                                echo   'Current A/c';
                                             }else if($consign->ac_type == 3){
                                                echo 'Credit A/c';
                                             }else{
                                                echo '<span class="empty">Empty</span>';
                                             } ?>
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_number" class="form-label">Bank A/c</label>
                                        <br>
                                        <span><?=($consign->ac_number) ? $consign->ac_number : '<span class="empty">Empty</span>'?></span>
                                           
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="bank_name" class="form-label">Name of Bank</label>
                                        <br>                                        
                                         <span><?= ($consign->bank_name) ? $consign->bank_name : '<span class="empty">Empty</span>'?><span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <br>
                                        <span><?=($consign->ifsc_code) ? $consign->ifsc_code : '<span class="empty">Empty</span>'?><span>
                                       
                                     
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
    $(document).ready(function(){ 
        $('#country').trigger('change');
    })

</script>
<?= $this->endSection(); ?>