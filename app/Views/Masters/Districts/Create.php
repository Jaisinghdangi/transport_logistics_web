<?= $this->extend('Logistics/Logistics'); ?>
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
                    <h3 class="mb-0">Districts</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>admin/district">Districts</a>
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
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-success">
                                    Create Districts
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/district" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                        echo render_view('Components/countries', ['data' => $countries, 'required'=>true, 'label'=>'Country', 'name'=>'country_id', 'error'=>array_key_exists('country_id', $errors) ? $errors['country_id'] : '', 'value'=>101, 'classes'=> 'select2']);  
                                    ?>  
                                    <?php 
                                        echo render_view('Components/countries', ['required'=>true,'data'=>'',  'label'=>'State', 'name'=>'state_id', 'error'=>array_key_exists('state_id', $errors) ? $errors['state_id'] : '', 'value'=>set_value('state_id'), 'attrs'=>['data'=>set_value('state_id')]  ]); 
                                    ?>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="name">City Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="<?= set_value('name'); ?>" id="name" class="form-control form-control-sm" placeholder="City Name" autocomplete="off" required=""/>
                                        <?php if(array_key_exists('name', $errors)): ?>  
                                            <div class="text-danger"> <?= $errors['name'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <input type="submit" class="btn btn-success btn-sm" value="Submit" />
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
    $('#country_id').change(function(){   
        jQuery.noConflict()
        $.ajax({
            url : '<?= base_url('get-states') ?>',
            method : 'post',
            data : { 'country_id' : $(this).val()},
            success : function(data){  
                $('#state_id').html(data) 
                if($('#state_id').attr('data')){
                    $('#state_id').val($('#state_id').attr('data')) 
                }
            }
        })
    }) 

    $(document).ready(function(){
        $('#country_id').trigger('change');
    })
</script>
<?= $this->endSection(); ?>