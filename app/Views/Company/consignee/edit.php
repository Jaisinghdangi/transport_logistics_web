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
                    <h3 class="mb-0">Update Consignee</h3>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-primary">
                                    Update Consignee
                                </h5>
                            </div>
                            <a href="<?= base_url('company/consignee'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                            <div class="row">
                                    <h4>Consignee Info</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignee_code" class="form-label">Consignee Code <span class="text-danger">*</span></label>
                                        <input type="text" name="consignee_code" value="<?= $consign->consignee_code ?>" id="consignee_code" class="form-control form-control-sm" autocomplete="off" required="" readonly />
                                        <?php if(array_key_exists('consignee_code', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['consignee_code'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="consignee_type" class="form-label">Company Type <span class="text-danger">*</span></label>
                                        <select name="consignee_type" id="consignee_type" class="form-control" required>
                                            <?php if(isset($business_types)): ?>
                                                <option value="">Company Type</option>
                                                <?php foreach($business_types as $buss_val): ?>
                                                    <option value="<?= $buss_val->id ?>" <?= set_value('consignee_type',$consign->consignee_type)==$buss_val->id?'selected':''; ?>><?= $buss_val->name ?></option>
                                                <?php endforeach ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(array_key_exists('consignee_type', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['consignee_type'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="name" class="form-label">Consignee Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="<?= set_value('name', $consign->name);  ?>" id="name" class="form-control form-control-sm" placeholder="Consignee Name" autocomplete="off" required="" />
                                        <?php if(array_key_exists('name', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['name'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="nickname" class="form-label">Nick Name <span class="text-danger"></span></label>
                                        <input type="text" name="nickname" value="<?= set_value('nickname', $consign->nickname);  ?>" id="nickname" class="form-control" placeholder="Nick Name..." autocomplete="off"/> 
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="mobile" class="form-label">Consignee Mobile <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" value="<?= set_value('mobile', $consign->mobile); ?>" id="mobile" minlength="10" maxlength="10" class="form-control form-control-sm" placeholder="Consignee Mobile" minlength="10" autocomplete="off" required="" />
                                        <?php if(array_key_exists('mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="alternate_mobile" class="form-label">Alternate Mobile </label>
                                        <input type="text" name="alternate_mobile" value="<?= set_value('alternate_mobile', $consign->alternate_mobile); ?>" id="alternate_mobile" minlength="10" maxlength="10" class="form-control form-control-sm" placeholder="Alternate Mobile" minlength="10" autocomplete="off" />
                                        <?php if(array_key_exists('alternate_mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['alternate_mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="email" class="form-label">Consignee Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="<?= set_value('email', $consign->email); ?>" id="email" class="form-control form-control-sm" placeholder="Consignee Email" autocomplete="off" required="" />
                                        <?php if(array_key_exists('email', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['email'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    
                                </div>
                                
                                <div class="row mt-2">
                                    <h4>Consignee Address</h4> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <select name="country" id="country" class="form-control select2" required>
                                            <option value="">Select Country</option> 
                                            <?php foreach($countries as $country): ?>
                                                <option value="<?= $country->id ?>" <?= $country->id  == 101 ? 'selected' : '' ?>><?= $country->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (array_key_exists('country', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['country'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                        <select name="state" id="state" data="<?= set_value('state',$consign->state) ?>" class="form-control" required>
                                            <option value="">Select State</option> 
                                        </select>
                                        <?php if (array_key_exists('state', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['state'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                        <select name="district" id="district" data="<?= set_value('district',$consign->district) ?>" class="form-control" required>
                                            <option value="">Select District</option> 
                                        </select>
                                        <?php if (array_key_exists('district', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['district'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_1" class="form-label">Address Line 1<span class="text-danger">*</span></label>
                                        <input type="text" name="address_1" value="<?= set_value('address_1', $consign->address_1); ?>" id="address_1" class="form-control form-control-sm" placeholder="Address 1" autocomplete="off" required="" />
                                        <?php if(array_key_exists('address_1', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['address_1'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_2" class="form-label">Address Line 2</label>
                                        <input type="text" name="address_2" value="<?= set_value('address_2', $consign->address_2); ?>" id="address_2" class="form-control form-control-sm" placeholder="Address 2" autocomplete="off"  />
                                        <?php if(array_key_exists('address_2', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['address_2'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pin_code" class="form-label">Pin / Zip Code <span class="text-danger">*</span></label>
                                        <input type="text" name="pin_code" value="<?= set_value('pin_code', $consign->pin_code); ?>" id="pin_code" minlength="6" maxlength="6" class="form-control form-control-sm" placeholder="Pin Code" autocomplete="off" required="" minlength="6" />
                                        <?php if(array_key_exists('pin_code', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['pin_code'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                </div> 

                                <div class="row">
                                    <h4>Other Info</h4>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="gst_status" class="form-label">GST register</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="radio" name="gst_status" value="1" <?= set_value('',$consign->gst_status) == 1 ? 'checked' : ''; ?> class="" autocomplete="off" onclick="switchGstValue()" required/> Yes
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="gst_status" value="0"  <?= $consign->gst_status == 0 ? 'checked' : ''; ?>  class="" autocomplete="off" onclick="switchGstValue()" required/> No
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 <?= $consign->gst_status == 0?'d-none':''; ?> " id="gst_view_id"> 
                                        <label for="gst_number" class="form-label">GST Number <span class="text-danger" >*</span></label>
                                        <input type="text" name="gst_number" value="<?= set_value('gst_number',$consign->gst_number); ?>" id="gst_number" class="form-control form-control-sm" placeholder="Gst Number" autocomplete="off" minlength="15" maxlength="15" />
                                        <p id="validationResult" style="color:red;"></p>
                                        <?php if(array_key_exists('gst_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['gst_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                </div>
                                <div class="row" >
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="msme_status" class="form-label">Registered under MSME</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="radio" name="msme_status" value="1" <?= $consign->msme_status == 1 ? 'checked' : ''; ?> class="" autocomplete="off" onclick="switchValue()" required/> Yes
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="msme_status" value="0" <?= $consign->msme_status == 0 ? 'checked' : ''; ?>  class="" autocomplete="off" onclick="switchValue()" required/> No
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 <?= $consign->msme_status == 0 ? 'd-none' : ''; ?>" id="msme_view_id">
                                        <label for="msme_number" class="form-label">MSME Number<span class="text-danger">*</span></label>
                                        <input type="text" name="msme_number" value="<?= set_value('msme_number',$consign->msme_number); ?>" id="msme_number" class="form-control form-control-sm" placeholder="MSME Number" autocomplete="off" />
                                        <?php if (array_key_exists('msme_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['msme_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row"> 
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pan_number" class="form-label">PAN Number</label>
                                        <input type="text" name="pan_number" value="<?= set_value('pan_number', $consign->pan_number); ?>" id="pan_number" minlength="10" maxlength="10" class="form-control form-control-sm" placeholder="Pan Number" autocomplete="off" />
                                        <p id="panValidationResult" style="color:red;"></p>
                                        <?php if(array_key_exists('pan_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['pan_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tan_number" class="form-label">TAN Number</label>
                                        <input type="text" name="tan_number" value="<?= set_value('tan_number', $consign->tan_number); ?>" id="tan_number" class="form-control form-control-sm" placeholder="Tan Number" autocomplete="off" />
                                        <?php if(array_key_exists('tan_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['tan_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="ies_number" class="form-label">IES Code</label>
                                        <input type="text" name="ies_number" value="<?= set_value('ies_number', $consign->ies_number); ?>" id="ies_number" class="form-control form-control-sm" placeholder="IES Number" autocomplete="off" />
                                        <?php if(array_key_exists('ies_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ies_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text" name="contact_person" value="<?= set_value('contact_person', $consign->contact_person); ?>" id="contact_person" class="form-control form-control-sm" placeholder="Contact Person" autocomplete="off" />
                                        <?php if(array_key_exists('contact_person', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['contact_person'];  ?></div>
                                        <?php endif; ?> 
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_mobile" class="form-label">Contact Person Mobile</label>
                                        <input type="text" name="contact_person_mobile" value="<?= set_value('contact_person_mobile', $consign->contact_person_mobile); ?>" id="contact_person_mobile" minlength="10" maxlength="10"  class="form-control form-control-sm" placeholder="Contact Person Mobile" autocomplete="off" />
                                        <?php if(array_key_exists('contact_person_mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['contact_person_mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_website" class="form-label">Consignee Website</label>
                                        <input type="link" name="company_website" value="<?= set_value('company_website', $consign->company_website); ?>" id="company_website" class="form-control form-control-sm" placeholder="Consignee Website" autocomplete="off" />
                                        <?php if(array_key_exists('company_website', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_website'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="pf_no" class="form-label">PF Registraion No.</label>
                                        <input type="text" name="pf_no" value="<?= set_value('pf_no', $consign->pf_no); ?>" id="pf_no" class="form-control form-control-sm" placeholder="pf Registration no" autocomplete="off" />
                                        <?php if(array_key_exists('pf_no', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['pf_no'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="esi_no" class="form-label">ESI Registraion No.</label>
                                        <input type="text" name="esi_no" value="<?= set_value('esi_no', $consign->esi_no); ?>" id="esi_no" class="form-control form-control-sm" placeholder="ESI Registration No." autocomplete="off" />
                                        <?php if(array_key_exists('esi_no', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['esi_no'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="est_no" class="form-label">Establishment Registration No. </label>
                                        <input type="text" name="est_no" value="<?= set_value('est_no', $consign->est_no); ?>" id="est_no" class="form-control form-control-sm" placeholder="Establishment No" autocomplete="off" />
                                        <?php if(array_key_exists('est_no', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['est_no'];  ?></div>
                                        <?php endif; ?> 
                                    </div> 
                             
                                </div>
                                <div class="row"> 
                                <h4>Bank Details</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_type" class="form-label">Account Type</label>
                                        <select name="ac_type" id="ac_type" class="form-control">
                                            <option value="">Account Type</option>
                                            <option value="1" <?= $consign->ac_type == 1 ? 'selected' : '' ?> >Saving A/c</option>
                                            <option value="2"  <?= $consign->ac_type == 2 ? 'selected' : '' ?>>Current A/c</option>
                                            <option value="2"  <?= $consign->ac_type == 3 ? 'selected' : '' ?>>Credit A/c</option>
                                        </select>
                                        <?php if(array_key_exists('ac_type', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ac_type'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_number" class="form-label">Bank A/c</label>
                                        <input type="text" name="ac_number" value="<?= set_value('ac_number', $consign->ac_number); ?>" id="ac_number" minlength="11" maxlength="16" class="form-control form-control-sm" placeholder="A/c Number" autocomplete="off" />
                                        <?php if(array_key_exists('ac_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ac_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="bank_name" class="form-label">Name of Bank</label>
                                        <input type="text" name="bank_name" value="<?= set_value('bank_name', $consign->bank_name); ?>" id="bank_name" class="form-control form-control-sm" placeholder="Bank Name" autocomplete="off" />
                                        <?php if(array_key_exists('bank_name', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['bank_name'];  ?></div>
                                        <?php endif; ?> 
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <input type="text" name="ifsc_code" value="<?= set_value('ifsc_code', $consign->ifsc_code); ?>" id="ifsc_code" class="form-control form-control-sm" placeholder="IFSC Code" minlength="11" maxlength="11" autocomplete="off" />
                                        <?php if(array_key_exists('ifsc_code', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ifsc_code'];  ?></div>
                                        <?php endif; ?> 
                                    </div> 

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <button type="submit" id="submit_btn" class="btn btn-primary btn-sm" value="Submit" >Submit</button>
                                        <input type="reset" class="btn btn-dark btn-sm" />
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
    $('#country').change(function(){   
        // jQuery.noConflict() 
        $.ajax({
            url : '<?= base_url('get-states') ?>',
            method : 'post',
            data : { 'country_id' : $(this).val()},
            success : function(data){  
                $('#state').html(data)  
                if($('#state').attr('data')){
                    $('#state').val($('#state').attr('data')) 
                }
                $('#state').trigger('change')
            }
        })
    }) 

    $('#state').change(function(){   
        // jQuery.noConflict()
        $.ajax({
            url : '<?= base_url('get-districts') ?>',
            method : 'post',
            data : { 'state_id' : $(this).val()},
            success : function(data){  
                $('#district').html(data)  
                if($('#district').attr('data')){
                    $('#district').val($('#district').attr('data')) 
                }
            }
        })
    }) 

    $(document).ready(function(){ 
        $('#country').trigger('change');
    })

    
    
    $("#gst_number").keyup(function() {
        var gstNumber = $("#gst_number").val();
        $("#gst_number").val(gstNumber.toUpperCase()); 
        if(gstNumber!=""){
            $("#validationResult").text(""); 
        if (validateGST(gstNumber)) {
            var button = document.getElementById("submit_btn"); 
            button.disabled = false;
            $("#validationResult").text("");
        } else { 
            var button = document.getElementById("submit_btn"); 
            button.disabled = true;
            $("#validationResult").text("Please Enter Valid GSTIN Number");
        }
       }
    });
      
    function validateGST(inputvalues) {
        var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
        if (gstinformat.test(inputvalues)) {
            return true;
        } else {
            var button = document.getElementById("submit_btn"); 
            button.disabled = true; 
            $("#gst_number").focus(); 
        }
    }

    $("#pan_number").keyup(function(){
        let panNumber = $("#pan_number").val(); 
        $("#pan_number").val(panNumber.toUpperCase());
        console.log(panNumber,'panNumber');  
        var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/; 
        $("#panValidationResult").html(""); 
        if(panNumber!=""){ 
        if (panRegex.test(panNumber.toUpperCase())) { 
            $("#panValidationResult").html(""); 
            var button = document.getElementById("submit_btn"); 
            button.disabled = false;
        } else {
            $("#panValidationResult").html("Please enter valid pan number"); 
            $("#pan_number").focus();
            
            var button = document.getElementById("submit_btn"); 
            button.disabled = true; 
        }
      } 
    }); 

    $("#name").keyup(function() {
        let input_value = $("#name").val();
        $("#name").val(input_value.toUpperCase());
    })

    $("#address_1").keyup(function() {
        var inputText = document.getElementById('address_1').value;
        var capitalizedText = toTitleCase(inputText);
        $("#address_1").val(capitalizedText);
    })

    $("#address_2").keyup(function() {
        var inputText = document.getElementById('address_2').value;
        var capitalizedText =  toTitleCase(inputText);
        $("#address_2").val(capitalizedText);
    }) 

    $("#address").keyup(function() {
        var inputText = document.getElementById('address').value;
        var capitalizedText = inputText.charAt(0).toUpperCase() + inputText.slice(1).toLowerCase();
        $("#address").val(capitalizedText);
    })

    $("#tan_number").keyup(function() {
        let input_value = $("#tan_number").val();
        $("#tan_number").val(input_value.toUpperCase());
    })

    $("#msme_number").keyup(function() {
        let input_value = $("#msme_number").val();
        $("#msme_number").val(input_value.toUpperCase());
    })

    $("#iec_number").keyup(function() {
        let input_value = $("#iec_number").val();
        $("#iec_number").val(input_value.toUpperCase());
    })

    $("#contact_person").keyup(function() {
        let input_value = $("#contact_person").val();
        $("#contact_person").val(input_value.toUpperCase());
    })

    $("#ac_number").keyup(function() {
        let input_value = $("#ac_number").val();
        $("#ac_number").val(input_value.toUpperCase());
    })

    $("#bank_name").keyup(function() {
        let input_value = $("#bank_name").val();
        $("#bank_name").val(input_value.toUpperCase());
    }) 

    $("#ifsc_code").keyup(function() {
        let input_value = $("#ifsc_code").val();
        $("#ifsc_code").val(input_value.toUpperCase());
    })

    $("#ies_number").keyup(function() {
        let input_value = $("#ies_number").val();
        $("#ies_number").val(input_value.toUpperCase());
    })

    $("#pf_no").keyup(function() {
        let input_value = $("#pf_no").val();
        $("#pf_no").val(input_value.toUpperCase());
    })

    $("#esi_no").keyup(function() {
        let input_value = $("#esi_no").val();
        $("#esi_no").val(input_value.toUpperCase());
    })   
    $("#est_no").keyup(function() {
        let input_value = $("#est_no").val();
        $("#est_no").val(input_value.toUpperCase());
    }) 

    function switchValue() { 
        var checkboxValue = $('input[name=msme_status]:checked').val(); 
        if (parseInt(checkboxValue)==1) { 
            $("#msme_view_id").removeClass('d-none');
            $("#msme_view_id").show();
            $("#msme_number").prop('required', true);
        } else { 
            $("#msme_view_id").hide();
            $("#msme_number").prop('required', false);
        }
    }

    function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}

    function switchGstValue(){
        var checkboxValue = $('input[name=gst_status]:checked').val(); 
        if (parseInt(checkboxValue)==1) { 
            $("#gst_view_id").removeClass('d-none');
            $("#gst_view_id").show();
            $("#gst_number").prop('required', true);
        } else { 
            $("#gst_view_id").hide();
            $("#gst_number").prop('required', false);
        }
    }
</script>
<?= $this->endSection(); ?>