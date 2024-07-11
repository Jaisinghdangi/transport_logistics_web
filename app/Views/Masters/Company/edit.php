<?= $this->extend('Logistics/Logistics'); ?>

<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
}  ?>


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
                    <h3 class="mb-0">Company</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>admin/companies">Companies</a>
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
                                    Update Company
                                </h5>
                            </div>
                            <a href="<?= base_url('admin/companies'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <h4>Company Info</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_code" class="form-label">Company Code <span class="text-danger">*</span></label>
                                        <input type="text" name="company_code" value="<?= $company->comp_code; ?>" id="company_code" class="form-control form-control-sm" autocomplete="off" required="" readonly />
                                        <?php if(array_key_exists('company_code', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_code'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_type" class="form-label">Company Type <span class="text-danger">*</span></label>
                                        <select name="company_type" id="company_type" class="form-control" required>
                                            <?php if(isset($business_types)): ?>
                                                <option value="">Company Type</option>
                                                <?php foreach($business_types as $buss_val): ?>
                                                    <option value="<?= $buss_val->id ?>" <?= $company->comp_type == $buss_val->id ? 'selected' : '' ?>><?= $buss_val->name ?></option>
                                                <?php endforeach ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(array_key_exists('company_type', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_type'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                        <input type="text" name="company_name" value="<?= $company->company_name; ?>" id="company_name" class="form-control form-control-sm" placeholder="Company Name" autocomplete="off" required="" />
                                        <?php if(array_key_exists('company_name', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_name'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="company_mobile" class="form-label">Company Mobile <span class="text-danger">*</span></label>
                                        <input type="text" name="company_mobile" value="<?= $company->company_mobile; ?>" id="company_mobile" class="form-control form-control-sm" placeholder="Company Mobile" minlength="10" maxlength="10" autocomplete="off" required="" />
                                        <?php if(array_key_exists('company_mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="alternet_mobile" class="form-label">Alternet Mobile <span class="text-danger">*</span> </label>
                                        <input type="text" name="alternet_mobile" value="<?=  $company->alternet_mobile; ?>" id="alternet_mobile" class="form-control form-control-sm" placeholder="Alternet Mobile" minlength="10" maxlength="10" autocomplete="off" required=""  />
                                        <?php if(array_key_exists('alternet_mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['alternet_mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_email" class="form-label">Company Email <span class="text-danger">*</span></label>
                                        <input type="email" name="company_email" value="<?= $company->company_email; ?>" id="company_email" class="form-control form-control-sm" placeholder="Company Email" autocomplete="off" required=""  required="" />
                                        <?php if(array_key_exists('company_email', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_email'];  ?></div>
                                        <?php endif; ?> 
                                    </div>

                                 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="pt_number" class="form-label">PT Registration number</label>
                                        <input type="text" name="pt_number" value="<?= set_value('pt_number')?set_value('pt_number'):$company->pt_number; ?>" id="pt_number" class="form-control form-control-sm" placeholder="PT Number" autocomplete="off"  />
                                        <?php if (array_key_exists('pt_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['pt_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>

                                <div class="row mt-2">
                                    <h4>Company Address</h4> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <select name="country" id="country" class="form-control select2" required>
                                            <option value="">Select Country</option> 
                                            <?php foreach($countries as $country): ?>
                                                <option value="<?= $country->id ?>" <?= $company->country  == $country->id ? 'selected' : '' ?>><?= $country->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (array_key_exists('country', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['country'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                        <select name="state" id="state" data="<?= $company->state; ?>" class="form-control" required>
                                            <option value="">Select State</option> 
                                        </select>
                                        <?php if (array_key_exists('state', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['state'];  ?></div>
                                        <?php endif; ?>
                                    </div> 

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                        <select data="<?= $company->district; ?>" name="district" id="district" class="form-control" required>
                                            <option value="">Select District</option> 
                                        </select>
                                        <?php if (array_key_exists('district', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['district'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_1" class="form-label">Address Line 1<span class="text-danger">*</span></label>
                                        <input type="text" name="address_1" value="<?= $company->address_1 ?>" id="address_1" class="form-control form-control-sm" placeholder="Address 1" autocomplete="off" required="" />
                                        <?php if(array_key_exists('address_1', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['address_1'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_2" class="form-label">Address Line 2</label>
                                        <input type="text" name="address_2" value="<?= $company->address_2 ?>" id="address_2" class="form-control form-control-sm" placeholder="Address 2" autocomplete="off"  />
                                        <?php if(array_key_exists('address_2', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['address_2'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_3" class="form-label">Address Line 3</label>
                                        <input type="text" name="address_3" value="<?= $company->address_3; ?>" id="address" class="form-control form-control-sm" placeholder="Address 3" autocomplete="off"/>
                                        <?php if(array_key_exists('address_3', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['address_3'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pin_code" class="form-label">Pin / Zip Code <span class="text-danger">*</span></label>
                                        <input type="text" name="pin_code" value="<?= $company->pin_code ?>" id="pin_code" class="form-control form-control-sm" placeholder="Pin Code" autocomplete="off" minlength="6" maxlength="6" required="" />
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
                                                <input type="radio" name="gst_status" value="1" <?= $company->gst_status == 1 ? 'checked' : ''; ?> class="" autocomplete="off" onclick="switchGstValue()" required/> Yes
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="gst_status" value="0"  <?= $company->gst_status == 0 ? 'checked' : ''; ?>  class="" autocomplete="off" onclick="switchGstValue()" required/> No
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 <?= $company->gst_status == 0?'d-none':''; ?> " id="gst_view_id"> 
                                        <label for="gst_number" class="form-label">GST Number <span class="text-danger" >*</span></label>
                                        <input type="text" name="gst_number" value="<?= set_value('gst_number',$company->gst_number); ?>" id="gst_number" class="form-control form-control-sm" placeholder="Gst Number" autocomplete="off" minlength="15" maxlength="15" />
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
                                                <input type="radio" name="msme_status" value="1" <?= $company->msme_status == 1 ? 'checked' : ''; ?> class="" autocomplete="off" onclick="switchValue()" required/> Yes
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="msme_status" value="0" <?= $company->msme_status == 0 ? 'checked' : ''; ?>  class="" autocomplete="off" onclick="switchValue()" required/> No
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 <?= $company->msme_status == 0 ? 'd-none' : ''; ?>" id="msme_view_id">
                                        <label for="msme_number" class="form-label">MSME Number<span class="text-danger">*</span></label>
                                        <input type="text" name="msme_number" value="<?= set_value('msme_number',$company->msme_number); ?>" id="msme_number" class="form-control form-control-sm" placeholder="MSME Number" autocomplete="off" />
                                        <?php if (array_key_exists('msme_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['msme_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div> 

                                <div class="row">  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pan_number" class="form-label">PAN Number <span class="text-danger">*</span></label>
                                        <input type="text" name="pan_number" onkeyup="panInputCaps()" onkeydown="panInputCaps()" value="<?= $company->pan_number ?>" id="pan_number" minlength="10" maxlength="10" class="form-control form-control-sm" placeholder="Pan Number" autocomplete="off" required="" />
                                        <p id="panValidationResult" style="color:red;"></p>
                                        <?php if(array_key_exists('pan_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['pan_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tan_number" class="form-label">TAN Number</label>
                                        <input type="text" name="tan_number" value="<?= $company->tan_number ?>" id="tan_number" class="form-control form-control-sm" placeholder="Tan Number" autocomplete="off" />
                                        <?php if(array_key_exists('tan_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['tan_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="iec_number" class="form-label">IEC Code</label>
                                        <input type="text" name="iec_number" value="<?= $company->iec_number ?>" id="iec_number" class="form-control form-control-sm" placeholder="IEC Number" autocomplete="off" />
                                        <?php if(array_key_exists('iec_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['iec_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text" name="contact_person" value="<?= $company->contact_person ?>" id="contact_person" class="form-control form-control-sm" placeholder="Contact Person" autocomplete="off" />
                                        <?php if(array_key_exists('contact_person', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['contact_person'];  ?></div>
                                        <?php endif; ?> 
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="contact_person_email" class="form-label">Contact Person Email</label>
                                        <input type="text" name="contact_person_email" value="<?= set_value('contact_person_email')?set_value('contact_person_email'):$company->contact_person_email; ?>" id="contact_person_email" class="form-control form-control-sm" placeholder="Contact Person Email" autocomplete="off" />
                                        <?php if (array_key_exists('contact_person_email', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['contact_person_email'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_mobile" class="form-label">Contact Person Mobile</label>
                                        <input type="text" name="contact_person_mobile" value="<?= set_value('contact_person_mobile',$company->contact_person_mobile) ?>" id="contact_person_mobile" class="form-control form-control-sm" placeholder="Contact Person Mobile" autocomplete="off" minlength="10" maxlength="10" />
                                        <?php if(array_key_exists('contact_person_mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['contact_person_mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_website" class="form-label">Company Website</label>
                                        <input type="link" name="company_website" value="<?= set_value('company_website',$company->company_website) ?>" id="company_website" class="form-control form-control-sm" placeholder="Company Website" autocomplete="off" />
                                        <?php if(array_key_exists('company_website', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_website'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="cin_number" class="form-label">CIN Number</label>
                                        <input type="link" name="cin_number" value="<?= set_value('cin_number',$company->cin_number)  ?>" id="cin_number" class="form-control form-control-sm" placeholder="CIN number" autocomplete="off" />
                                        <?php if(array_key_exists('cin_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['cin_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="iso_number" class="form-label">ISO Number</label>
                                        <input type="link" name="iso_number" value="<?= set_value('iso_number',$company->iso_number) ?>" id="iso_number" class="form-control form-control-sm" placeholder="ISO number" autocomplete="off" />
                                        <?php if(array_key_exists('iso_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['iso_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div> 
                                </div>
                                <div class="row"> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_type" class="form-label">Account Type</label>
                                        <select name="ac_type" id="ac_type" class="form-control">
                                            <option value="">Account Type</option>
                                            <option value="1" <?= $company->ac_type == 1 ? 'selected' : '' ?>>Saving A/c</option>
                                            <option value="2" <?= $company->ac_type == 2 ? 'selected' : '' ?>>Current A/c</option>
                                            <option value="3" <?= $company->ac_type == 3 ? 'selected' : '' ?>>Credit A/c</option>
                                        </select>
                                        <?php if(array_key_exists('ac_type', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ac_type'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_number" class="form-label">Bank A/c</label>
                                        <input type="text" name="ac_number" value="<?= set_value('ac_number',$company->ac_number) ?>" id="ac_number" class="form-control form-control-sm" placeholder="A/c Number" autocomplete="off" minlength="11" maxlength="16" />
                                        <?php if(array_key_exists('ac_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ac_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="bank_name" class="form-label">Name of Bank</label>
                                        <input type="text" name="bank_name" value="<?= set_value('bank_name',$company->bank_name) ?>" id="bank_name" class="form-control form-control-sm" placeholder="Bank Name" autocomplete="off" />
                                        <?php if(array_key_exists('bank_name', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['bank_name'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <input type="text" name="ifsc_code" value="<?= $company->ifsc_code ?>" id="ifsc_code" minlength="11" maxlength="11" class="form-control form-control-sm" placeholder="IFSC code" autocomplete="off" />
                                        <?php if(array_key_exists('ifsc_code', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ifsc_code'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pf_no" class="form-label">PF Registraion No.</label>
                                        <input type="text" name="pf_no" value="<?= $company->pf_no ?>" id="pf_no" class="form-control form-control-sm" placeholder="pf Registration no" autocomplete="off" />
                                        <?php if(array_key_exists('pf_no', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['pf_no'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="esi_no" class="form-label">ESI Registraion No.</label>
                                        <input type="text" name="esi_no" value="<?= $company->esi_no ?>" id="esi_no" class="form-control form-control-sm" placeholder="ESI Registration No." autocomplete="off" />
                                        <?php if(array_key_exists('esi_no', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['esi_no'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="est_no" class="form-label">Establishment Registration No. </label>
                                        <input type="text" name="est_no" value="<?= $company->est_no ?>" id="est_no" class="form-control form-control-sm" placeholder="Establishment No" autocomplete="off" />
                                        <?php if(array_key_exists('est_no', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['est_no'];  ?></div>
                                        <?php endif; ?> 
                                    </div> 
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <button type="submit" id="submit_btn" class="btn btn-primary btn-sm" >Update</button>
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
    
    
    $('#country').change(function(){   
        jQuery.noConflict() 
        $.ajax({
            url : '<?= base_url('get-states') ?>',
            method : 'post',
            data : { 'country_id' : $(this).val()},
            success : function(data){  
                $('#state').html(data)  
                if($('#state').attr('data')){
                    $('#state').val($('#state').attr('data'))  
                    $('#state').trigger('change'); 
                }
            }
        })
    }) 
    $(document).ready(function(){ 
        $('#country').trigger('change');  
        
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

    function validatePanCard() {
        let panNumber = $("#pan_number").val(); 
        var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/; 
        if(panNumber!=null){
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
    }

    function panInputCaps() {
        let panNumber = $("#pan_number").val();
        $("#pan_number").val(panNumber.toUpperCase());
        var inputText = document.getElementById('pan_number').value;
        var char_length = inputText.length; 
        if(panNumber!=null){
        if (parseInt(char_length) == 10) { 
            $("#panValidationResult").html("");
            var button = document.getElementById("submit_btn"); 
            button.disabled = false;
            validatePanCard(); 
        } else {  
            var button = document.getElementById("submit_btn"); 
            button.disabled = true; 
            $("#pan_number").focus(); 
            $("#panValidationResult").html("Please enter valid pan number");
        }
       }
    }


    $("#company_name").keyup(function() {
        let company_val = $("#company_name").val();
        $("#company_name").val(company_val.toUpperCase());
    })

    $("#tan_number").keyup(function() {
        let company_val = $("#tan_number").val();
        $("#tan_number").val(company_val.toUpperCase());
    })

    $("#iec_number").keyup(function() {
        let company_val = $("#iec_number").val();
        $("#iec_number").val(company_val.toUpperCase());
    })

    $("#contact_person").keyup(function() {
        let company_val = $("#contact_person").val();
        $("#contact_person").val(company_val.toUpperCase());
    })

    $("#cin_number").keyup(function() {
        let company_val = $("#cin_number").val();
        $("#cin_number").val(company_val.toUpperCase());
    })

    $("#iso_number").keyup(function() {
        let company_val = $("#iso_number").val();
        $("#iso_number").val(company_val.toUpperCase());
    })

    $("#msme_number").keyup(function() {
        let company_val = $("#msme_number").val();
        $("#msme_number").val(company_val.toUpperCase());
    })

    $("#bank_name").keyup(function() {
        let company_val = $("#bank_name").val();
        $("#bank_name").val(company_val.toUpperCase());
    })

    $("#ifsc_code").keyup(function() {
        let company_val = $("#ifsc_code").val();
        $("#ifsc_code").val(company_val.toUpperCase());
    })
 
    $("#pf_no").keyup(function() {
        let company_val = $("#pf_no").val();
        $("#pf_no").val(company_val.toUpperCase());
    })

    $("#esi_no").keyup(function() {
        let company_val = $("#esi_no").val();
        $("#esi_no").val(company_val.toUpperCase());
    })

    $("#est_no").keyup(function() {
        let company_val = $("#est_no").val();
        $("#est_no").val(company_val.toUpperCase());
    }) 

    $("#pf_number").keyup(function() {
        let company_val = $("#pf_number").val();
        $("#pf_number").val(company_val.toUpperCase());
    })

    $("#esi_number").keyup(function() {
        let company_val = $("#esi_number").val();
        $("#esi_number").val(company_val.toUpperCase());
    })

    $("#pt_number").keyup(function() {
        let company_val = $("#pt_number").val();
        $("#pt_number").val(company_val.toUpperCase());
    })

    $("#company_email").keyup(function() {
        let company_val = $("#company_email").val();
        $("#company_email").val(company_val.toLowerCase());
    })

    $("#address_1").keyup(function() {
        var inputText = document.getElementById('address_1').value;
        var capitalizedText = inputText.charAt(0).toUpperCase() + inputText.slice(1).toLowerCase();
        $("#address_1").val(capitalizedText);
    })

    $("#address_2").keyup(function() {
        var inputText = document.getElementById('address_2').value;
        var capitalizedText = inputText.charAt(0).toUpperCase() + inputText.slice(1).toLowerCase();
        $("#address_2").val(capitalizedText);
    }) 

    $("#address").keyup(function() {
        var inputText = document.getElementById('address').value;
        var capitalizedText = inputText.charAt(0).toUpperCase() + inputText.slice(1).toLowerCase();
        $("#address").val(capitalizedText);
    })
   
</script>
<?= $this->endSection(); ?>