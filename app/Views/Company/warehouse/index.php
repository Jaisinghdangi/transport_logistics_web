<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Warehouse </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li> 
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/warehouse'); ?>">Warehouse</a>
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
                                    Warehouse Report
                                </h5>
                            </div>
                            <a href="<?= base_url('company/add-warehouse'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Email</th>
                                            <th>Mobile</th> 
                                            <th>Remark</th> 
                                            <th>Status</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($warehouse) && count($warehouse) > 0) { 
                                            foreach ($warehouse as $warehouse_key => $warehouse_value) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $warehouse_key+1; ?></td> 
                                                <td><?= $warehouse_value->name; ?>  </td>
                                                <td><?= $warehouse_value->location; ?>  </td>
                                                <td><?= $warehouse_value->email; ?></td>
                                                <td><?= $warehouse_value->mobile; ?></td> 
                                                <td><?= $warehouse_value->remark; ?></td> 
                                                <td>
                                                    <?php if ($warehouse_value->status) { ?>
                                                    <a href="<?= base_url(); ?>company/status-warehouse/<?= $warehouse_value->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-patch-check"></i> Active
                                                    </a>
                                                    <?php } else { ?>
                                                    <a href="<?= base_url(); ?>company/status-warehouse/<?= $warehouse_value->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-ban"></i> Inactive
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url(); ?>company/edit-warehouse/<?= $warehouse_value->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>company/delete-warehouse/<?= $warehouse_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger">
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