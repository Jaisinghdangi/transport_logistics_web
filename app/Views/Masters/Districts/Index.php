<?= $this->extend('Logistics/Logistics'); ?>
<?= $this->section('content'); ?> 
<?php $request = \Config\Services::request(); ?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Districts </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('admin/district'); ?>">Districts</a>
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
                                    Distrcit Report
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/add-district" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                        </div>
                        <form>
                            <div class="row mt-2">
                                <?php
                                    echo render_view('Components/countries', ['data' => $countries, 'required'=>true, 'label'=>'Country', 'name'=>'country_id', 'value'=>$request->getGet('country_id') ?? 101, 'classes'=> 'select2']);  
                                   
                                    echo render_view('Components/countries', ['required'=>false,'data'=>'',  'label'=>'State', 'name'=>'state_id', 'value' => 4039, 'attrs'=>['data'=>set_value('state_id')] ,'classes'=> '' ]); 
                                ?>  
                                 <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">  
                                    <button type="submit" class="btn mt-4 btn-sm btn-success">Submit</button>
                                </div> 
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>District</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($districts) && count($districts) > 0) { 
                                            foreach ($districts as $district_key => $district_value) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $district_key+1; ?></td> 
                                                <td><?= $district_value->country_name; ?></td>
                                                <td><?= $district_value->state_name; ?></td>
                                                <td><?= $district_value->name; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-<?= $district_value->status == 1 ? 'success' : 'danger' ?>" href="<?= base_url('admin/status-district/'.$district_value->id) ?>" onclick="return confirm('Are You Confirm To <?= $district_value->status == 1 ? 'Inactive' : 'Active' ?> User')" title="Current Status <?= $district_value->status == 1 ? 'Active' : "Inactive" ?>">
                                                        <?php if($district_value->status): ?>
                                                            <i class="bi bi-patch-check"></i> Active
                                                            <?php else: ?>
                                                                <i class="bi bi-ban"></i> Inactive
                                                        <?php endif; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url(); ?>admin/edit-district/<?= $district_value->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>admin/delete-district/<?= $district_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td> 
                                            </tr> 
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?> 

<!-- write js here -->
<script type="text/javascript">
    $('.table').DataTable({
        "pageLength" : 20,
        "lengthMenu" : [[20, 50, 100, 500, -1], [20, 50, 100, 500, "All"]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
</script>

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