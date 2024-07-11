<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
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
.card-title{
    margin-bottom:0px;
}
.card-header {
    /* background-color: #007bff; */
    background-color: #b0744b;
    color: #fff;
    border-radius: 10px 10px 0 0;
    /* padding: 15px; */
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
                    <h3 class="mb-0">Broker</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/broker">Broker</a>
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
                                    View Broker Detail
                                </h5>
                            </div>
                            <a href="<?= base_url('company/broker'); ?>" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row" style="padding-top:0px;">
                                    <h4>Broker Info</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="broker_code" class="form-label">Broker Code <span class="text-danger">*</span></label><br>
                                       <span><?=($broker->broker_code) ? $broker->broker_code : '<span class="empty">Empty</span>' ?></span>
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="broker_type" class="form-label">Company Type <span class="text-danger">*</span></label>
                                        <?php  $consignorType=''; foreach($business_types as $buss_val): ?>
                                           
                                           <?php (set_value('broker_type', $broker->broker_type) == $buss_val->id) ? $consignorType=$buss_val->name :'' ?> 
                                       <?php endforeach ?>
                                       <br>
                               <span><?=($consignorType) ? $consignorType : '<span class="empty">Empty</span>' ?></span>
                                        
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="name" class="form-label">Broker Name <span class="text-danger">*</span></label>
                                      <br>  <span><?=(set_value('name', $broker->name)) ? set_value('name', $broker->name) : '<span class="empty">Empty</span>'?></span>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="email" class="form-label">Broker Email <span class="text-danger">*</span></label>
                                        <br>  <span><?=(set_value('email', $broker->email)) ? set_value('email', $broker->email) : '<span class="empty">Empty</span>'?></span>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                        <br>  <span><?=(set_value('mobile', $broker->mobile)) ? set_value('mobile', $broker->mobile) : '<span class="empty">Empty</span>'?></span>
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="alternet_mobile" class="form-label">Alternet Mobile </label>
                                        <br>  <span><?=(set_value('alternet_mobile', $broker->alternet_mobile)) ? set_value('alternet_mobile', $broker->alternet_mobile) : '<span class="empty">Empty</span>'?></span>
                                    </div>  
                                </div>

                                <div class="row mt-2">
                                    <h4>Broker Address</h4> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <?php $country1='';foreach($countries as $country): ?>
                                                    <?php ($country->id  == $broker->country) ? $country1=$country->name : '' ?> 
                                                <?php endforeach ?>
                                                <br>
                                        <span><?= ($country1) ? $country1 : '<span class="empty">Empty</span>'?></span>
                                       
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
                                        <label for="address_1" class="form-label">Address Line 1<span class="text-danger">*</span></label>
                                        <br>
                                        <span><?=(set_value('address_1', $broker->address_1)) ? set_value('address_1', $broker->address_1) : '<span class="empty">Empty</span>'?></span>
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_2" class="form-label">Address Line 2</label>
                                        <br><span><?=(set_value('address_2', $broker->address_2)) ? set_value('address_2', $broker->address_2) : '<span class="empty">Empty</span>'?></span>

                                     
                                    </div>
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pin_code" class="form-label">Pin / Zip Code <span class="text-danger">*</span></label>
                                       <br> <span><?=(set_value('pin_code', $broker->pin_code)) ?  set_value('pin_code', $broker->pin_code) : '<span class="empty">Empty</span>'?></span>

                                      
                                    </div>
                                </div> 


                                <div class="row">
                                    <h4>Other Info</h4>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="gst_status" class="form-label">GST register</label>
                                        <div class="row" style="padding-top:0px;">
                                        <span><?= $broker->gst_status == 1 ? 'Yes' : 'No'; ?> </span>
                                            </div>
                                            
                                        </div>
                                    </div>

                                  
                                <!-- </div> -->
                                <div class="row" style="padding-top:0px;">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="msme_status" class="form-label">Registered under MSME</label>
                                        <div class="row" style="padding-top:0px;">
                                            <div class="col-6">
                                            <span><?= $broker->msme_status == 1 ? 'Yes' : 'No'; ?></span>
                                            </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>


                                <div class="row"> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pan_number" class="form-label">PAN Number</label>
                                      <br>  <span><?= (set_value('pan_number', $broker->pan_number)) ? set_value('pan_number', $broker->pan_number) : '<span class="empty">Empty</span>'?> </span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tan_number" class="form-label">TAN Number</label>
                                       <br> <span><?=(set_value('tan_number', $broker->tan_number)) ?  set_value('tan_number', $broker->tan_number) : '<span class="empty">Empty</span>'?> </span>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="iec_number" class="form-label">IEC Code</label>
                                      <br>  <span><?= (set_value('iec_number', $broker->iec_number)) ? set_value('iec_number', $broker->iec_number) : '<span class="empty">Empty</span>'?> </span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <br><span><?=(set_value('contact_person', $broker->contact_person)) ? set_value('contact_person', $broker->contact_person) : '<span class="empty">Empty</span>'?> </span>
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_email" class="form-label">Contact Person Email</label>
                                        <br><span><?=(set_value('contact_person_email',$broker->contact_person_email)) ? set_value('contact_person_email',$broker->contact_person_email) : '<span class="empty">Empty</span>'?> </span>
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_mobile" class="form-label">Contact Person Mobile</label>
                                        <br><span><?=(set_value('contact_person_mobile', $broker->contact_person_mobile)) ? set_value('contact_person_mobile', $broker->contact_person_mobile) : '<span class="empty">Empty</span>'?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_website" class="form-label">Broker Website</label>
                                        <br><span><?=(set_value('company_website', $broker->company_website)) ? set_value('company_website', $broker->company_website) : '<span class="empty">Empty</span>'?></span>
                                    </div>
                                </div>
                                
                                <div class="row" style="padding-top:0px;"> 
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tds_status" class="form-label">TDS Declaration Received </label>
                                        <div class="row" style="padding-top:0px;">
                                            <div class="col-6">
                                            <span><?= $broker->tds_status == 1 ? 'Yes' : 'No'; ?> </span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <h4>Bank Detail</h4>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_type" class="form-label">Account Type</label>
                                        <br>
                                        <?php if($broker->ac_type == 1){
                                             echo 'Saving A/c';  
                                            }else if($broker->ac_type == 2){
                                                echo   'Current A/c';
                                             }else if($broker->ac_type == 3){
                                                echo 'Credit A/c';
                                             }else{
                                                echo '<span class="empty">Empty</span>';
                                             } ?>
                                       
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_number" class="form-label">Bank A/c</label>
                                        <br><span><?= (set_value('ac_number', $broker->ac_number)) ? set_value('ac_number', $broker->ac_number) : '<span class="empty">Empty</span>'?> </span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="bank_name" class="form-label">Name of Bank</label>
                                        <br><span><?= (set_value('bank_name', $broker->bank_name)) ? set_value('bank_name', $broker->bank_name) : '<span class="empty">Empty</span>'?></span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <br><span><?=(set_value('ifsc_code', $broker->ifsc_code)) ? set_value('ifsc_code', $broker->ifsc_code) : '<span class="empty">Empty</span>'?></span>
                                    </div>
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
  
</script>
<?= $this->endSection(); ?>