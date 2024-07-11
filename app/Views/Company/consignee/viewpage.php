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
                    <h3 class="mb-0">Consignee</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/consignee">Consignee</a>
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
                                View Consignee Detail
                                </h5>
                            </div>
                            <a href="<?= base_url('company/consignee'); ?>" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                            <div class="row" style="padding-top:0px;">
                                    <h4>Consignee Info</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignee_code" class="form-label">Consignee Code <span class="text-danger">*</span></label><br>
                                      <span><?=($consign->consignee_code) ? $consign->consignee_code : '<span class="empty">Empty</span>' ?></span>
                                       
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignee_type" class="form-label">Consignee Type <span class="text-danger">*</span></label>
                                        <?php  $consignorType=''; foreach($business_types as $buss_val): ?>
                                           
                                           <?php ($buss_val->id==$consign->consignee_type) ? $consignorType=$buss_val->name :'' ?> 
                                       <?php endforeach ?>
                                       <br>
                               <span><?=($consignorType) ? $consignorType : '<span class="empty">Empty</span>'?></span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="name" class="form-label">Consignee Name <span class="text-danger">*</span></label>
                                     <br>   <span><?=(set_value('name', $consign->name)) ? set_value('name', $consign->name) : '<span class="empty">Empty</span>' ?></span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="mobile" class="form-label">Consignee Mobile <span class="text-danger">*</span></label>
                                       <br> <span><?= set_value('mobile', $consign->mobile); (set_value('name', $consign->name)) ? set_value('name', $consign->name) : '<span class="empty">Empty</span>' ?></span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="alternate_mobile" class="form-label">Alternate Mobile </label>
                                       <br> <span><?=(set_value('alternate_mobile', $consign->alternate_mobile)) ?  set_value('alternate_mobile', $consign->alternate_mobile) : '<span class="empty">Empty</span>'  ?></span>
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="email" class="form-label">Consignee Email <span class="text-danger">*</span></label>
                                        <br> <span><?=(set_value('email', $consign->email)) ? set_value('email', $consign->email) : '<span class="empty">Empty</span>'  ?></span>
                                    </div>
                                    
                                </div>
                                
                                <div class="row mt-2">
                                    <h4>Consignee Address</h4> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <?php $country1='';foreach($countries as $country): ?>
                                                    <?php ($country->id  == $consign->country) ? $country1=$country->name : '' ?> 
                                                <?php endforeach ?>
                                                <br>
                                        <span><?=($country1) ? $country1 : '<span class="empty">Empty</span>' ?></span>
                                       
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
                                        <span><?=($consign->address_1) ? $consign->address_1 : '<span class="empty">Empty</span>'  ?></span>

                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_2" class="form-label">Address Line 2</label>
                                        <br>
                                        <span><?=($consign->address_2) ? $consign->address_2 : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pin_code" class="form-label">Pin / Zip Code <span class="text-danger">*</span></label>
                                       <br>
                                        <span><?=($consign->pin_code) ? $consign->pin_code : '<span class="empty">Empty</span>' ?></span>
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
                                <!-- </div> -->
                                <div class="row" style="padding-top:0px;">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="msme_status" class="form-label">Registered under MSME</label>
                                        <div class="row" style="padding-top:0px;">
                                            <div class="col-6">
                                            <span><?= $consign->msme_status == 1 ? 'Yes' : 'No'; ?></span>
                                            </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>

                                <div class="row"> 
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pan_number" class="form-label">PAN Number</label><br>
                                        <span><?=($consign->pin_code) ? $consign->pin_code : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tan_number" class="form-label">TAN Number</label><br>
                                        <span><?=(set_value('tan_number', $consign->tan_number)) ? set_value('tan_number', $consign->tan_number) : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                                
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="ies_number" class="form-label">IES Code</label><br>
                                        <span><?=(set_value('ies_number', $consign->ies_number)) ? set_value('ies_number', $consign->ies_number) : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person" class="form-label">Contact Person</label><br>
                                        <span><?=(set_value('contact_person', $consign->contact_person)) ? set_value('contact_person', $consign->contact_person) : '<span class="empty">Empty</span>' ?></span>
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_mobile" class="form-label">Contact Person Mobile</label><br>
                                        <span><?=(set_value('contact_person_mobile', $consign->contact_person_mobile)) ? set_value('contact_person_mobile', $consign->contact_person_mobile) : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_website" class="form-label">Consignee Website</label><br>
                                        <span><?= (set_value('company_website', $consign->company_website)) ? set_value('company_website', $consign->company_website) : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                             
                                </div>
                                <div class="row"> 


                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="pf_no" class="form-label">PF Registraion No.</label><br>
                                        <span><?=(set_value('pf_no', $consign->pf_no)) ? set_value('pf_no', $consign->pf_no) : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="esi_no" class="form-label">ESI Registraion No.</label><br>
                                        <span><?=(set_value('esi_no', $consign->esi_no)) ? set_value('esi_no', $consign->esi_no) : '<span class="empty">Empty</span>' ?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="est_no" class="form-label">Establishment Registration No. </label>
                                        <br><span><?=(set_value('est_no', $consign->est_no)) ? set_value('est_no', $consign->est_no) : '<span class="empty">Empty</span>' ?></span>
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
                                        <label for="ac_number" class="form-label">Bank A/c</label><br>
                                        <span><?= (set_value('ac_number', $consign->ac_number)) ? set_value('ac_number', $consign->ac_number) : '<span class="empty">Empty</span>'?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="bank_name" class="form-label">Name of Bank</label><br>
                                        <span><?= (set_value('bank_name', $consign->bank_name)) ? set_value('bank_name', $consign->bank_name) : '<span class="empty">Empty</span>'?></span>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ifsc_code" class="form-label">IFSC Code</label><br>
                                        <span><?= (set_value('ifsc_code', $consign->ifsc_code)) ? set_value('ifsc_code', $consign->ifsc_code) : '<span class="empty">Empty</span>'?></span>
                                    </div>
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