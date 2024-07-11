<?= $this->extend('Logistics/Logistics'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Units</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('admin/units'); ?>">Ubits</a>
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
                                    Units Report
                                </h5>
                            </div>
                            <a href="<?= base_url('admin/add-units'); ?>" class="btn btn-primary btn-sm float-end">
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
                                            <th>Unit Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($units) && count($units) > 0) { 
                                            foreach ($units as $unit_key => $unit_value) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $unit_key+1; ?></td> 
                                                <td><?= $unit_value->name; ?></td>
                                                <td><?= $unit_value->unit_code; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-<?= $unit_value->status == 1 ? 'success' : 'danger' ?>" href="<?= base_url('admin/status-units/'.$unit_value->id) ?>" onclick=`return confirm('Are You Confirm To <?= $unit_value->status == 1 ? 'Inactive' : "Active" ?> User')` title="Current Status <?= $unit_value->status == 1 ? 'Active' : "Inactive" ?>">
                                                        <?php if($unit_value->status): ?>
                                                            <i class="bi bi-patch-check"></i> Active
                                                            <?php else: ?>
                                                                <i class="bi bi-ban"></i> Inactive
                                                        <?php endif; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url(); ?>admin/edit-units/<?= $unit_value->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>admin/delete-units/<?= $unit_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger">
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
<?= $this->endSection(); ?>