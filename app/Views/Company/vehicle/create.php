<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>
<?php $errors = [];
if (session()->has('errors')) {
    $errors = session()->get('errors');
} ?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-primary">
                                    Add Vehicle
                                </h5>
                            </div>
                            <a href="<?= base_url('company/vehicles'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                               
                                <h3>
                                    Vehicle Details
                                </h3>
                                <div class="row">
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="vehicle_number" class="form-label">Vehicle No. <span class="text-danger">*</span></label>
                                        <input type="text" name="vehicle_number" value="<?= set_value('vehicle_number'); ?>" id="vehicle_number" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" required="" />
                                        <?php //if (array_key_exists('vehicle_number', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['vehicle_number'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="model_number" class="form-label">Model No. <span class="text-danger">*</span></label>
                                        <input type="text" name="model_number" value="<?= set_value('model_number'); ?>" id="model_number" class="form-control form-control-sm" placeholder="Model number" autocomplete="off" required="" />
                                        <?php //if (array_key_exists('model_number', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['model_number'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="make" class="form-label">Maker Name </label>
                                        <input type="text" name="make" value="<?= set_value('make'); ?>" id="make" class="form-control form-control-sm" placeholder="Maker Name..." autocomplete="off" />
                                        <?php //if (array_key_exists('make', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['make'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                                        <input type="text" name="color" value="<?= set_value('color'); ?>" id="color" class="form-control form-control-sm" placeholder="Color" autocomplete="off" required="" />
                                        <?php //if (array_key_exists('color', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['color'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="registered_date" class="form-label">Registered Date <span class="text-danger">*</span></label>
                                        <input type="date" name="registered_date" value="<?= set_value('registered_date'); ?>" id="registered_date" class="form-control form-control-sm" placeholder="Registered Date" autocomplete="off" required="" />
                                        <?php //if (array_key_exists('registered_date', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['registered_date'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="chassis_number" class="form-label">Chassis No. <span class="text-danger">*</span></label>
                                        <input type="text" name="chassis_number" value="<?= set_value('chassis_number'); ?>" id="chassis_number" class="form-control form-control-sm" placeholder="Chassis No." autocomplete="off" required="" />
                                        <?php //if (array_key_exists('chassis_number', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['chassis_number'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="engine_number" class="form-label">Engine Number </label>
                                        <input type="text" name="engine_number" value="<?= set_value('engine_number'); ?>" id="engine_number" class="form-control form-control-sm" placeholder="Engine Number" autocomplete="off" />
                                        <?php //if (array_key_exists('engine_number', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['engine_number'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="tax_token" class="form-label">Tax Valid UpTo </label>
                                        <input type="date" name="tax_token" value="<?= set_value('tax_token'); ?>" id="tax_token" class="form-control form-control-sm" placeholder="Tax Token No" autocomplete="off" />
                                        <?php //if (array_key_exists('tax_token', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['tax_token'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="road_permmit" class="form-label">Vehicle  Class</label>
                                        <input type="text" name="vehicle_class" value="" id="vehicle_class" class="form-control form-control-sm" placeholder="Vehicle  Class..." autocomplete="off" />
                                        <?php //if (array_key_exists('road_permmit', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['road_permmit'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="road_permmit" class="form-label">Vehicle  Description</label>
                                        <input type="text" name="vehicle_description" value="" id="vehicle_description" class="form-control form-control-sm" placeholder="Vehicle  Description..." autocomplete="off" />
                                        <?php //if (array_key_exists('road_permmit', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['road_permmit'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="fuel_type" class="form-label">Fuel Type<span class="text-danger">*</span></label>
                                        <select name="fuel_type" id="fuel_type" class="form-control select2" required>
                                            <option value="">Select Fuel Type</option>
                                                <option value="Diesel">Diesel</option>
                                                <option value="Petrol">Petrol</option>
                                                <option value="CNG">CNG</option>


                                        </select>
                                        <?php //if (isset($errors['broker'])) : ?>
                                            <div class="text-danger">
                                                <?//= $errors['broker'] ?>
                                            </div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="emission_norm" class="form-label">Emission Norms</label>
                                        <input type="text" name="emission_norm" value="" id="emission_norm" class="form-control form-control-sm" placeholder="Emission Norms..." autocomplete="off" />
                                        <?php //if (array_key_exists('road_permmit', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['road_permmit'];  ?></div>
                                        <?php //endif; ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2 d-none">
                                        <label for="seat_capacity" class="form-label">Seat Capacity</label>
                                        <input type="Number" name="seat_capacity" value="" id="seat_capacity" class="form-control form-control-sm" placeholder="Seat Capacity..." autocomplete="off" />
                                        <?php //if (array_key_exists('road_permmit', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['road_permmit'];  ?></div>
                                        <?php //endif; ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2 d-none"> 
                                        <label for="standing_capacity" class="form-label">Standing Capacity</label>
                                        <input type="Number" name="standing_capacity" value="" id="standing_capacity" class="form-control form-control-sm" placeholder="Standing Capacity..." autocomplete="off" />
                                        <?php //if (array_key_exists('road_permmit', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['road_permmit'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <h3>
                                        Insurance Details
                                    </h3>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="financed_by" class="form-label">Financier</label>
                                        <input type="text" name="financed_by" value="<?= set_value('financed_by'); ?>" id="financed_by" class="form-control form-control-sm" placeholder="Financed By" autocomplete="off" />
                                        <?php //if (array_key_exists('financed_by', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['financed_by'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_by" class="form-label">Insurance Company </label>
                                        <input type="text" name="insurance_by" value="<?= set_value('insurance_by'); ?>" id="insurance_by" class="form-control form-control-sm" placeholder="Insurance Company" autocomplete="off" />
                                        <?php //if (array_key_exists('insurance_by', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['insurance_by'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="fitness_validity" class="form-label">Fitness Valid UpTo <span class="text-danger">*</span></label>
                                        <input type="date" name="fitness_validity" value="<?= set_value('fitness_validity'); ?>" id="fitness_validity" class="form-control form-control-sm" placeholder="Fitness Validity" autocomplete="off" required="" />
                                        <?php //if (array_key_exists('fitness_validity', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['fitness_validity'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_date" class="form-label">Insurance Valid UpTo <span class="text-danger">*</span></label>
                                        <input type="date" name="insurance_date" value="<?= set_value('insurance_date'); ?>" id="insurance_date" class="form-control form-control-sm" placeholder="Insurance Valid UpTo" autocomplete="off" required="" />
                                        <?php //if (array_key_exists('insurance_date', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['insurance_date'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                   
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_policy_no" class="form-label">Insurance Policy No. </label>
                                        <input type="Number" name="insurance_policy_no" value="<?= set_value('insurance_by'); ?>" id="insurance_policy_no" class="form-control form-control-sm" placeholder="Insurance policy No." autocomplete="off" />
                                        <?php //if (array_key_exists('insurance_by', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['insurance_by'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                   
                                   
                                   
                                </div>
                                <div class="row mt-2">
                                    <h3>
            Other Details
                                    </h3>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="puccno" class="form-label">PUCC No. <span class="text-danger">*</span></label>
                                        <input type="Number" name="puccno" value="<?= set_value('driver_name');; ?>" id="puccno" class="form-control form-control-sm" placeholder="PUCC No." autocomplete="off" required="" />
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="pucc_validity" class="form-label">PUCC Valid UpTo <span class="text-danger">*</span></label>
                                        <input type="date" name="pucc_validity" value="<?= set_value('driver_name');; ?>" id="pucc_validity" class="form-control form-control-sm" placeholder="PUCC Valid UpTo " autocomplete="off" required="" />
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="national_permit_no" class="form-label">National Permit No.<span class="text-danger">*</span></label>
                                        <input type="text" name="national_permit_no" value="<?= set_value('driver_name');; ?>" id="national_permit_no" class="form-control form-control-sm" placeholder="National Permit No." autocomplete="off" required="" />
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="national_permit_validity" class="form-label">National Permit Valid UpTo<span class="text-danger">*</span></label>
                                        <input type="Date" name="national_permit_validity" value="<?= set_value('driver_name');; ?>" id="national_permit_validity" class="form-control form-control-sm" placeholder="National Permit No." autocomplete="off" required="" />
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="permit_validity" class="form-label">Permit Valid UpTo<span class="text-danger">*</span></label>
                                        <input type="Date" name="permit_validity" value="<?= set_value('driver_name');; ?>" id="permit_validity" class="form-control form-control-sm" placeholder="Permit Valid UpTo" autocomplete="off" required="" />
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                
                               
                                    
                                    
                                </div>


                                <div class="row mt-2">
                                    <h3>Driver Details</h3>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="driver_name" class="form-label">Driver Name<span class="text-danger">*</span></label>
                                        <input type="text" name="driver_name" value="" id="driver_name" class="form-control form-control-sm" placeholder="Driver Name" required/>
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="driver_mobile" class="form-label">Driver Mobile <span class="text-danger">*</span></label>
                                        <input type="number" name="driver_mobile" value="" id="driver_mobile" class="form-control form-control-sm" placeholder="Driver Mobile" required />
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="driving_licence_no" class="form-label">Driver Licence No.</label>
                                        <input type="text" name="driving_licence_no" value="" id="driving_licence_no" class="form-control form-control-sm" placeholder="Driver Licence No." />
                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div> 
                                </div>
                                 <div class="row">
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="driver_address" class="form-label">Driver Address</label>
                                        
                                        <textarea name="driver_address" class="form-control" id="driver_address" placeholder="Driver Address"></textarea>

                                        <?php //if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['driver_name'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="broker" class="form-label">Owner Name <span class="text-danger">*</span></label>
                                        <input type="text" name="owner_name" value="" id="owner_name" class="form-control form-control-sm" placeholder="Enter Owner Name..." autocomplete="off" required="" />

                                        <?php //if (isset($errors['broker'])) : ?>
                                            <div class="text-danger">
                                                <?//= $errors['broker'] ?>
                                            </div>
                                        <?php // endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="vehicle_number" class="form-label">Son/Daughter/Wife of<span class="text-danger">*</span></label>
                                        <input type="text" name="owner_relative" value="" id="owner_relative" class="form-control form-control-sm" placeholder="Enter Name..." autocomplete="off" required="" />
                                        <?php //if (array_key_exists('vehicle_number', $errors)) : ?>
                                            <div class="text-danger"> <?//= $errors['vehicle_number'];  ?></div>
                                        <?php //endif; ?>
                                    </div>
                                    </div>


                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit" />
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
    // $('#state').change(function() {
    //     $.ajax({
    //         url: '<?//= base_url('get-districts') ?>',
    //         method: 'post',
    //         data : { 'state_id' : $(this).val()},
    //         success : function(data){  
    //             $('#district').html(data)  
    //         }
    //     })
    // })

    // $('#country').change(function(){    
    //     $.ajax({
    //         url : '<?/////////= base_url('get-states') ?>',
    //         method : 'post',
    //         data : { 'country_id' : $(this).val()},
    //         success : function(data){  
    //             $('#state').html(data)  
    //             if($('#state').attr('data')){
    //                 $('#state').val($('#state').attr('data')) 
    //             }
    //         }
    //     })
    // }) 
    
    // $('#driver_country').change(function(){    
    //     $.ajax({
    //         url : '<?//= base_url('get-states') ?>',
    //         method : 'post',
    //         data : { 'country_id' : $(this).val()},
    //         success : function(data){  
    //             $('#driver_state').html(data)  
    //             if($('#driver_state').attr('data')){
    //                 $('#driver_state').val($('#driver_state').attr('data')) 
    //             }
    //         }
    //     })
    // }) 

    // $('#driver_state').change(function(){    
    //     $.ajax({
    //         url : '<?///= base_url('get-districts') ?>',
    //         method : 'post',
    //         data : { 'state_id' : $(this).val()},
    //         success : function(data){  
    //             $('#driver_district').html(data)  
    //         }
    //     })
    // }) 

    // $(document).ready(function(){ 
    //     $('#country').trigger('change');
    // })
</script>
<?= $this->endSection(); ?>