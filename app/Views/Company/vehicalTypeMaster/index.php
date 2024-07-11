<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Vehical Type Master</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/vehical-type-master'); ?>">Vehical Type Master</a>
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
                                <h5 class="header-title text-primary">Vehical Type Master</h5>
                            </div>
                            <a href="<?= base_url('company/add-vehical-type'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                            <div class="row">
                            <div class="col-sm-4 d-flex justify-content-center">
                                <a href="<?= base_url('company/vehiclesTypeMaster-downloadExcel'); ?>"  class="btn btn-success btn-sm float-end"><i class="bi bi-filetype-xls" style="font-size:20px;"></i> <i class="bi bi-arrow-down-square-fill" style="font-size:20px;"></i></a>
                                </div>
                            <div class="col-sm-7">
                               
      <form action="<?= base_url('company/vehiclesTypeMaster-import-excel'); ?>" method="post" enctype="multipart/form-data">
      <div class="input-group">  
      <input type="file" name="excel_file" accept=".xlsx, .xls"  class="form-control" placement="import excel file format eg. xlxs,xls..." required>
        <button type="submit" class="btn btn-success btn-sm">Submit Import</button>
        </div>

    </form>
    </div>
    </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Width</th> 
                                            <th>Height</th> 
                                            <th>Length</th> 
                                            <th>Vehical Type</th> 
                                            <th>Capacity</th> 
                                            <th>Ground Clearance</th> 
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php  if (isset($VehicalType) && count($VehicalType) > 0) { 
                                            // $countValue= count($terms);
                                            foreach ($VehicalType as $terms => $term) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $terms+1; ?></td> 
                                                <td><?= $term->width; ?></td>
                                                <td><?= $term->height; ?></td>
                                                <td><?= $term->length; ?></td>
                                                <td><?= $term->vehical_type; ?></td>
                                                <td><?= $term->capacity; ?></td>
                                                <td><?= $term->groundclearance; ?></td>
                                                <td>
                                                    <a href="<?= base_url(); ?>company/edit-vehical-type/<?= $term->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>company/delete-vehical-type/<?= $term->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger mt-2">
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
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false
    });
</script>
<?= $this->endSection(); ?>