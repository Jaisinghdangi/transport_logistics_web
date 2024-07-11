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
                                    Owner Details
                                </h3>
                                <div class="row">
                                    
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="owner_name" class="form-label">Owner Name <span class="text-danger">*</span></label>
                                        <input type="text" name="owner_name" value="<?= set_value('owner_name');; ?>" id="owner_name" class="form-control form-control-sm" placeholder="Enter Owner Name" autocomplete="off" required="" />
                                        <?php if (array_key_exists('owner_name', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['owner_name'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="owner_parent_name" class="form-label">Son / Daughter / Wife Of<span class="text-danger">*</span></label>
                                        <input type="text" name="owner_parent_name" value="<?= set_value('owner_parent_name');; ?>" id="owner_parent_name" class="form-control form-control-sm" placeholder="Enter Son / Daughter / Wife Of" autocomplete="off" required="" />
                                        <?php if (array_key_exists('owner_parent_name', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['owner_parent_name'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                               
                                </div>

                                <h3>
                                    Vehicle Details
                                </h3>
                                <div class="row">

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="chassis_number" class="form-label">Chassis No. <span class="text-danger">*</span></label>
                                        <input type="text" name="chassis_number" value="<?= set_value('chassis_number'); ?>" id="chassis_number" class="form-control form-control-sm" placeholder="Chassis No." autocomplete="off" required="" />
                                        <?php if (array_key_exists('chassis_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['chassis_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="engine_number" class="form-label">Engine Number </label>
                                        <input type="text" name="engine_number" value="<?= set_value('engine_number'); ?>" id="engine_number" class="form-control form-control-sm" placeholder="Engine Number" autocomplete="off" />
                                        <?php if (array_key_exists('engine_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['engine_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="make" class="form-label">Maker Name </label>
                                        <input type="text" name="make" value="<?= set_value('make'); ?>" id="make" class="form-control form-control-sm" placeholder="Enter Maker Name" autocomplete="off" />
                                        <?php if (array_key_exists('make', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['make'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="model_number" class="form-label">Model No. <span class="text-danger">*</span></label>
                                        <input type="text" name="model_number" value="<?= set_value('model_number'); ?>" id="model_number" class="form-control form-control-sm" placeholder="Model number" autocomplete="off" required="" />
                                        <?php if (array_key_exists('model_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['model_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="registered_date" class="form-label">Registered Date <span class="text-danger">*</span></label>
                                        <input type="date" name="registered_date" value="<?= set_value('registered_date'); ?>" id="registered_date" class="form-control form-control-sm" placeholder="Registered Date" autocomplete="off" required="" />
                                        <?php if (array_key_exists('registered_date', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['registered_date'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="tax_valid_upto" class="form-label">Tax Valid UpTo <span class="text-danger">*</span></label>
                                        <input type="date" name="tax_valid_upto" value="<?= set_value('tax_valid_upto'); ?>" id="tax_valid_upto" class="form-control form-control-sm" placeholder="Tax Valid up to" autocomplete="off" required="" />
                                        <?php if (array_key_exists('tax_valid_upto', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['tax_valid_upto'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="vehical_class" class="form-label">Vehical Class<span class="text-danger">*</span></label>
                                        <input type="text" name="vehical_class" value="<?= set_value('vehical_class'); ?>" id="vehical_class" class="form-control form-control-sm" placeholder="Enter Vehical Class" autocomplete="off" required="" />
                                        <?php if (array_key_exists('vehical_class', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['vehical_class'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="vehical_description" class="form-label">Vehical Description<span class="text-danger">*</span></label>
                                        <input type="text" name="vehical_description" value="<?= set_value('vehical_description'); ?>" id="vehical_description" class="form-control form-control-sm" placeholder="Enter Vehical Description" autocomplete="off" required="" />
                                        <?php if (array_key_exists('vehical_description', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['vehical_description'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="fuel_type" class="form-label">Fuel Type<span class="text-danger">*</span></label>
                                       
                                        <select id="fuel_type" name="fuel_type" class="form-control" >
                                          <option>Select Fuel</option>
                                          <option value="DIESEL">DIESEL</option>
                                          <option value="PETROL">PETROL</option>
                                          <option value="GAS">GAS</option>
                                        </select>
                                        <?php if (array_key_exists('fuel_type', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['fuel_type'];  ?></div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="vehicle_number" class="form-label">Vehicle No. <span class="text-danger">*</span></label>
                                        <input type="text" name="vehicle_number" value="<?= set_value('vehicle_number'); ?>" id="vehicle_number" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" required="" />
                                        <?php if (array_key_exists('vehicle_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['vehicle_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                 
                                
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                                        <input type="text" name="color" value="<?= set_value('color'); ?>" id="color" class="form-control form-control-sm" placeholder="Color" autocomplete="off" required="" />
                                        <?php if (array_key_exists('color', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['color'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="tax_token" class="form-label">Tax Token No. </label>
                                        <input type="text" name="tax_token" value="<?= set_value('tax_token'); ?>" id="tax_token" class="form-control form-control-sm" placeholder="Tax Token No" autocomplete="off" />
                                        <?php if (array_key_exists('tax_token', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['tax_token'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="road_permmit" class="form-label">Road Permmit No. </label>
                                        <input type="text" name="road_permmit" value="<?= set_value('road_permmit'); ?>" id="road_permmit" class="form-control form-control-sm" placeholder="Road Permmit No" autocomplete="off" />
                                        <?php if (array_key_exists('road_permmit', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['road_permmit'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <h3>
                                        Insurance Details
                                    </h3>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="fitness_validity" class="form-label">Fitness Validity. <span class="text-danger">*</span></label>
                                        <input type="date" name="fitness_validity" value="<?= set_value('fitness_validity'); ?>" id="fitness_validity" class="form-control form-control-sm" placeholder="Fitness Validity" autocomplete="off" required="" />
                                        <?php if (array_key_exists('fitness_validity', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['fitness_validity'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php   
                                        echo render_view('Components/countries', ['data' => $countries, 'required'=>true, 'label'=>'Country', 'name'=>'country', 'error'=>array_key_exists('country', $errors) ? $errors['country'] : '', 'value'=>101, 'classes'=> 'select2']);  
                                    ?>
                                    <?php 
                                        echo render_view('Components/countries', ['required'=>true,'data'=>'',  'label'=>'State', 'name'=>'state', 'error'=>array_key_exists('state', $errors) ? $errors['state'] : '', 'value'=>'', 'attrs'=>['data'=>set_value('state')]  ]); 
                                    ?> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="district" class="form-label">Select District <span class="text-danger">*</span></label>
                                        <div class="form-floating">  
                                            <select name="district" id="district" class="form-control select2" required> 
                                                <option value="">Select District</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_date" class="form-label">Insurance Date <span class="text-danger">*</span></label>
                                        <input type="date" name="insurance_date" value="<?= set_value('insurance_date'); ?>" id="insurance_date" class="form-control form-control-sm" placeholder="Insurance Date" autocomplete="off" required="" />
                                        <?php if (array_key_exists('insurance_date', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['insurance_date'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="insurance_by" class="form-label">Insurance By </label>
                                        <input type="text" name="insurance_by" value="<?= set_value('insurance_by'); ?>" id="insurance_by" class="form-control form-control-sm" placeholder="Insurance By" autocomplete="off" />
                                        <?php if (array_key_exists('insurance_by', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['insurance_by'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="certificate" class="form-label">Certificate </label>
                                        <input type="text" name="certificate" value="<?= set_value('certificate'); ?>" id="certificate" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" />
                                        <?php if (array_key_exists('certificate', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['certificate'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="division_number" class="form-label">Division No. </label>
                                        <input type="text" name="division_number" value="<?= set_value('division_number'); ?>" id="division_number" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" />
                                        <?php if (array_key_exists('division_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['division_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="financed_by" class="form-label">Financed By </label>
                                        <input type="text" name="financed_by" value="<?= set_value('financed_by'); ?>" id="financed_by" class="form-control form-control-sm" placeholder="Financed By" autocomplete="off" />
                                        <?php if (array_key_exists('financed_by', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['financed_by'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="financed_address" class="form-label">Financed Address </label>
                                        <input type="text" name="financed_address" value="<?= set_value('financed_address'); ?>" id="financed_address" class="form-control form-control-sm" placeholder="Financed Address" autocomplete="off" />
                                        <?php if (array_key_exists('financed_address', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['financed_address'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <h3>
                                        Driver Details
                                    </h3>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="driver_name" class="form-label">Driver Name. <span class="text-danger">*</span></label>
                                        <input type="text" name="driver_name" value="<?= set_value('driver_name');; ?>" id="driver_name" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" required="" />
                                        <?php if (array_key_exists('driver_name', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['driver_name'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php   
                                        echo render_view('Components/countries', ['data' => $countries, 'required'=>true, 'label'=>'Country', 'name'=>'driver_country', 'error'=>array_key_exists('driver_country', $errors) ? $errors['driver_country'] : '', 'value'=>101, 'classes'=> 'select2']);  
                                    ?>  
                                    <?php 
                                        echo render_view('Components/countries', ['required'=>true,'data'=>'',  'label'=>'State', 'name'=>'driver_state', 'error'=>array_key_exists('driver_state', $errors) ? $errors['driver_state'] : '', 'value'=>'', 'attrs'=>['data'=>set_value('driver_state')]  ]); 
                                    ?> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="driver_district" class="form-label">Select District <span class="text-danger">*</span></label> 
                                        <select name="driver_district" id="driver_district" class="form-control select2" required> 
                                            <option value="">Select District</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="driver_address" class="form-label">Driver Address </label>
                                        <input type="text" name="driver_address" value="<?= set_value('driver_address');; ?>" id="driver_address" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" />
                                        <?php if (array_key_exists('driver_address', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['driver_address'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="driving_licence_no" class="form-label">Licence No. <span class="text-danger">*</span></label>
                                        <input type="text" name="driving_licence_no" value="<?= set_value('driving_licence_no');; ?>" id="driving_licence_no" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" required="" />
                                        <?php if (array_key_exists('driving_licence_no', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['driving_licence_no'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="licence_validity" class="form-label">Licence Validity. <span class="text-danger">*</span></label>
                                        <input type="date" name="licence_validity" value="<?= set_value('licence_validity');; ?>" id="licence_validity" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" required="" />
                                        <?php if (array_key_exists('licence_validity', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['licence_validity'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="driver_mobile" class="form-label">Driver Mobile <span class="text-danger">*</span></label>
                                        <input type="text" name="driver_mobile" value="<?= set_value('driver_mobile');; ?>" id="driver_mobile" class="form-control form-control-sm" placeholder="Vehicle number" autocomplete="off" required="" />
                                        <?php if (array_key_exists('driver_mobile', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['driver_mobile'];  ?></div>
                                        <?php endif; ?>
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
    $('#state').change(function() {
        $.ajax({
            url: '<?= base_url('get-districts') ?>',
            method: 'post',
            data : { 'state_id' : $(this).val()},
            success : function(data){  
                $('#district').html(data)  
            }
        })
    })

    $('#country').change(function(){    
        $.ajax({
            url : '<?= base_url('get-states') ?>',
            method : 'post',
            data : { 'country_id' : $(this).val()},
            success : function(data){  
                $('#state').html(data)  
                if($('#state').attr('data')){
                    $('#state').val($('#state').attr('data')) 
                }
            }
        })
    }) 
    
    $('#driver_country').change(function(){    
        $.ajax({
            url : '<?= base_url('get-states') ?>',
            method : 'post',
            data : { 'country_id' : $(this).val()},
            success : function(data){  
                $('#driver_state').html(data)  
                if($('#driver_state').attr('data')){
                    $('#driver_state').val($('#driver_state').attr('data')) 
                }
            }
        })
    }) 

    $('#driver_state').change(function(){    
        $.ajax({
            url : '<?= base_url('get-districts') ?>',
            method : 'post',
            data : { 'state_id' : $(this).val()},
            success : function(data){  
                $('#driver_district').html(data)  
            }
        })
    }) 

    $(document).ready(function(){ 
        $('#country').trigger('change');
    })
</script>
<?= $this->endSection(); ?>