<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <?php if (session()->has('import_errors')) : ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach (session('import_errors') as $error) : ?>
                <li><?= esc($error) ;?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Broker </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/broker'); ?>">Broker</a>
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
                                    Broker Report
                                </h5>
                            </div>
                            <a href="<?= base_url('company/add-broker'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                            <div class="row">
                            <div class="col-sm-4 d-flex justify-content-center">
                                <a href="<?= base_url('company/broker-downloadExcel'); ?>"  class="btn btn-success  btn-sm float-end"><i class="bi bi-filetype-xls" style="font-size:20px;"></i> <i class="bi bi-arrow-down-square-fill" style="font-size:20px;"></i></a>
                                </div>
                            <div class="col-sm-7">
                               
      <form action="<?= base_url('company/brokerimport-excel'); ?>" method="post" enctype="multipart/form-data">
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>State</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($brokers) && count($brokers) > 0) { 
                                            foreach ($brokers as $consign_key => $consign_value) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $consign_key+1; ?></td> 
                                                <td><?= $consign_value->name; ?>  <?php if($consign_value->nickname){ ?> ( <?php echo $consign_value->nickname; ?> ) <?php  } ?>  <br>
                                                <small><?= $consign_value->mobile; ?></small>
                                                </td>
                                                <td><?= $consign_value->email; ?></td>
                                                <td>
                                                     <?= get_title('states', ['id'=>$consign_value->state], 'name') ?>
                                                </td>
                                                <td>
                                                    <?php if ($consign_value->status) { ?>
                                                    <a href="<?= base_url(); ?>company/status-broker/<?= $consign_value->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-patch-check"></i> Active
                                                    </a>
                                                    <?php } else { ?>
                                                    <a href="<?= base_url(); ?>company/status-broker/<?= $consign_value->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-ban"></i> Inactive
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                <a href="<?= base_url(); ?>company/view-broker/<?= $consign_value->id; ?>" class="btn btn-primary btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>company/edit-broker/<?= $consign_value->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>company/delete-broker/<?= $consign_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger">
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