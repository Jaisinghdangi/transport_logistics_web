<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} ?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-primary">
                                    Update Broker
                                </h5>
                            </div>
                            <a href="<?= base_url('company/broker'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <h4>Broker Info</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="broker_code" class="form-label">Broker Code <span class="text-danger">*</span></label>
                                        <input type="text" name="broker_code" value="<?= $broker->broker_code ?>" id="broker_code" class="form-control form-control-sm" autocomplete="off" required="" readonly />
                                        <?php if(array_key_exists('broker_code', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['broker_code'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="broker_type" class="form-label">Company Type <span class="text-danger">*</span></label>
                                        <select name="broker_type" id="broker_type" class="form-control" required>
                                            <?php if(isset($business_types)): ?>
                                                <option value="">Company Type</option>
                                                <?php foreach($business_types as $buss_val): ?>
                                                    <option value="<?= $buss_val->id ?>" <?= set_value('broker_type', $broker->broker_type) == $buss_val->id ? 'selected' : '' ?> ><?= $buss_val->name ?></option>
                                                <?php endforeach ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php if(array_key_exists('broker_type', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['broker_type'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="name" class="form-label">Broker Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="<?= set_value('name', $broker->name); ?>" id="name" class="form-control form-control-sm" placeholder="Broker Name" autocomplete="off" required="" /> 
                                        <?php if(array_key_exists('name', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['name'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="nickname" class="form-label">Nick Name <span class="text-danger"></span></label>
                                        <input type="text" name="nickname" value="<?= set_value('nickname', $broker->nickname); ?>" id="nickname" class="form-control" placeholder="Nick Name..." autocomplete="off"/> 
                                       
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="email" class="form-label">Broker Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="<?= set_value('email', $broker->email); ?>" id="email" class="form-control form-control-sm" placeholder="Email" autocomplete="off" required="" />
                                        <?php if(array_key_exists('email', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['email'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" value="<?= set_value('mobile', $broker->mobile); ?>" id="mobile" class="form-control form-control-sm" placeholder="Mobile" autocomplete="off" required=""  minlength="10" maxlength="10"/>
                                        <?php if(array_key_exists('mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['mobile'];  ?></div>
                                        <?php endif; ?>
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="alternet_mobile" class="form-label">Alternet Mobile </label>
                                        <input type="text" name="alternet_mobile" value="<?= set_value('alternet_mobile', $broker->alternet_mobile); ?>" id="alternet_mobile" class="form-control form-control-sm" placeholder="Alternet Mobile" minlength="10" maxlength="10" autocomplete="off" />
                                        <?php if(array_key_exists('alternet_mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['alternet_mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>  
                                </div>

                                <div class="row mt-2">
                                    <h4>Broker Address</h4> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <select name="country" id="country" class="form-control select2" required>
                                            <option value="">Select Country</option> 
                                            <?php foreach($countries as $country): ?>
                                                <option value="<?= $country->id ?>" <?= $country->id  == $broker->country ? 'selected' : '' ?>><?= $country->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (array_key_exists('country', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['country'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                        <select name="state" data="<?= set_value('state',$broker->state) ?>" id="state" class="form-control" required>
                                            <option value="">Select State</option> 
                                        </select>
                                        <?php if (array_key_exists('state', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['state'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                        <select name="district" data="<?= set_value('district',$broker->district) ?>" id="district" class="form-control" required>
                                            <option value="">Select District</option> 
                                        </select>
                                        <?php if (array_key_exists('district', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['district'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_1" class="form-label">Address Line 1<span class="text-danger">*</span></label>
                                        <input type="text" name="address_1" value="<?= set_value('address_1', $broker->address_1); ?>" id="address_1" class="form-control form-control-sm" placeholder="Address 1" autocomplete="off" required="" />
                                        <?php if(array_key_exists('address_1', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['address_1'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="address_2" class="form-label">Address Line 2</label>
                                        <input type="text" name="address_2" value="<?= set_value('address_2', $broker->address_2); ?>" id="address_2" class="form-control form-control-sm" placeholder="Address 2" autocomplete="off"  />
                                        <?php if(array_key_exists('address_2', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['address_2'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pin_code" class="form-label">Pin / Zip Code <span class="text-danger">*</span></label>
                                        <input type="text" name="pin_code" value="<?= set_value('pin_code', $broker->pin_code); ?>" id="pin_code" class="form-control form-control-sm" placeholder="Pin Code" autocomplete="off" required="" minlength="6" maxlength="6" />
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
                                                <input type="radio" name="gst_status" value="1" <?= set_value('gst_status',$broker->gst_status) == 1 ? 'checked' : ''; ?> class="" autocomplete="off" onclick="switchGstValue()" required/> Yes
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="gst_status" value="0"  <?= set_value('gst_status',$broker->gst_status) == 0 ? 'checked' : ''; ?>  class="" autocomplete="off" onclick="switchGstValue()" required/> No
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 <?= $broker->gst_status == 0?'d-none':''; ?> " id="gst_view_id"> 
                                        <label for="gst_number" class="form-label">GST Number <span class="text-danger" >*</span></label>
                                        <input type="text" name="gst_number" value="<?= set_value('gst_number',$broker->gst_number); ?>" id="gst_number" class="form-control form-control-sm" placeholder="Gst Number" autocomplete="off" minlength="15" maxlength="15" />
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
                                                <input type="radio" name="msme_status" value="1" <?= set_value('msme_status',$broker->msme_status) == 1 ? 'checked' : ''; ?> class="" autocomplete="off" onclick="switchValue()" required/> Yes
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="msme_status" value="0" <?= set_value('msme_status',$broker->msme_status) == 0 ? 'checked' : ''; ?>  class="" autocomplete="off" onclick="switchValue()" required/> No
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 <?= $broker->msme_status == 0 ? 'd-none' : ''; ?>" id="msme_view_id">
                                        <label for="msme_number" class="form-label">MSME Number<span class="text-danger">*</span></label>
                                        <input type="text" name="msme_number" value="<?= set_value('msme_number',$broker->msme_number); ?>" id="msme_number" class="form-control form-control-sm" placeholder="MSME Number" autocomplete="off" />
                                        <?php if (array_key_exists('msme_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['msme_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="row"> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="pan_number" class="form-label">PAN Number</label>
                                        <input type="text" name="pan_number" value="<?= set_value('pan_number', $broker->pan_number); ?>" id="pan_number" class="form-control form-control-sm" placeholder="Pan Number" autocomplete="off" minlength="10" maxlength="10" />
                                        <p id="panValidationResult" style="color:red;"></p>
                                        <?php if(array_key_exists('pan_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['pan_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tan_number" class="form-label">TAN Number</label>
                                        <input type="text" name="tan_number" value="<?= set_value('tan_number', $broker->tan_number); ?>" id="tan_number" class="form-control form-control-sm" placeholder="Tan Number" autocomplete="off" />
                                        <?php if(array_key_exists('tan_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['tan_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none"> 
                                        <label for="iec_number" class="form-label">IEC Code</label>
                                        <input type="text" name="iec_number" value="<?= set_value('iec_number', $broker->iec_number); ?>" id="iec_number" class="form-control form-control-sm" placeholder="IES Number" autocomplete="off" />
                                        <?php if(array_key_exists('iec_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['iec_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text" name="contact_person" value="<?= set_value('contact_person', $broker->contact_person); ?>" id="contact_person" class="form-control form-control-sm" placeholder="Contact Person" autocomplete="off" />
                                        <?php if(array_key_exists('contact_person', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['contact_person'];  ?></div>
                                        <?php endif; ?> 
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_email" class="form-label">Contact Person Email</label>
                                        <input type="email" name="contact_person_email" value="<?= set_value('contact_person_email',$broker->contact_person_email); ?>" id="contact_person_email" class="form-control form-control-sm" placeholder="Contact Person Email" autocomplete="off" />
                                        <?php if(array_key_exists('contact_person_email', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['contact_person_email'];  ?></div>
                                        <?php endif; ?> 
                                    </div>  
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="contact_person_mobile" class="form-label">Contact Person Mobile</label>
                                        <input type="text" name="contact_person_mobile" value="<?= set_value('contact_person_mobile', $broker->contact_person_mobile); ?>" id="contact_person_mobile" class="form-control form-control-sm" placeholder="Contact Person Mobile" autocomplete="off" minlength="10" maxlength="10" />
                                        <?php if(array_key_exists('contact_person_mobile', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['contact_person_mobile'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="company_website" class="form-label">Broker Website</label>
                                        <input type="link" name="company_website" value="<?= set_value('company_website', $broker->company_website); ?>" id="company_website" class="form-control form-control-sm" placeholder="Broker Website" autocomplete="off" />
                                        <?php if(array_key_exists('company_website', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['company_website'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="tds_status" class="form-label">TDS Declaration Received </label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="radio" name="tds_status" value="1" <?= $broker->tds_status == 1 ? 'checked' : ''; ?> class="" autocomplete="off" required/> Yes
                                            </div>
                                            <div class="col-6">
                                                <input type="radio" name="tds_status" value="0" <?= $broker->tds_status == 0 ? 'checked' : ''; ?> class="" autocomplete="off" required/> No
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"> 
                                <h4>Bank Details</h4>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_type" class="form-label">Account Type</label>
                                        <select name="ac_type" id="ac_type" class="form-control">
                                            <option value="">Account Type</option>
                                            <option value="1" <?= set_value('ac_type',$broker->ac_type) == 1 ? 'selected' : '' ?>>Saving A/c</option>
                                            <option value="2" <?= set_value('ac_type',$broker->ac_type) == 2 ? 'selected' : '' ?>>Current A/c</option>
                                            <option value="3" <?= set_value('ac_type',$broker->ac_type) == 3 ? 'selected' : '' ?>>Credit A/c</option>
                                        </select>
                                        <?php if(array_key_exists('ac_type', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ac_type'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ac_number" class="form-label">Bank A/c</label>
                                        <input type="text" name="ac_number" value="<?= set_value('ac_number', $broker->ac_number); ?>" id="ac_number" class="form-control form-control-sm" placeholder="A/c Number" autocomplete="off" minlength="11" maxlength="16" />
                                        <?php if(array_key_exists('ac_number', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['ac_number'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="bank_name" class="form-label">Name of Bank</label>
                                        <input type="text" name="bank_name" value="<?= set_value('bank_name', $broker->bank_name); ?>" id="bank_name" class="form-control form-control-sm" placeholder="Bank Name" autocomplete="off" />
                                        <?php if(array_key_exists('bank_name', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['bank_name'];  ?></div>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <input type="text" name="ifsc_code" value="<?= set_value('ifsc_code', $broker->ifsc_code); ?>" id="ifsc_code" class="form-control form-control-sm" placeholder="Bank Name" autocomplete="off" minlength="11" maxlength="11" />
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

    $("#tan_number").keyup(function() {
        let input_value = $("#tan_number").val();
        $("#tan_number").val(input_value.toUpperCase());
    }) 

    $("#iec_number").keyup(function() {
        let input_value = $("#iec_number").val();
        $("#iec_number").val(input_value.toUpperCase());
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

    $("#msme_number").keyup(function() {
        let input_value = $("#msme_number").val();
        $("#msme_number").val(input_value.toUpperCase());
    }) 

    $("#contact_person").keyup(function() {
        let input_value = $("#contact_person").val();
        $("#contact_person").val(input_value.toUpperCase());
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

</script>
<?= $this->endSection(); ?>