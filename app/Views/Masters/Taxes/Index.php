<?= $this->extend('Logistics/Logistics'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Taxes</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>tax">Taxes</a>
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
                                    Taxes Report
                                </h5>
                            </div>
                            <a href="<?= base_url('admin/add-tax'); ?>" class="btn btn-primary btn-sm float-end">
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
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>IGST</th>
                                            <th>CESS</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($taxes) && count($taxes) > 0) { 
                                            foreach ($taxes as $tax_key => $tax_value) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $tax_key+1; ?></td> 
                                                <td><?= $tax_value->name; ?></td> 
                                                <td><?= $tax_value->cgst; ?></td> 
                                                <td><?= $tax_value->sgst; ?></td> 
                                                <td><?= $tax_value->igst; ?></td> 
                                                <td><?= $tax_value->cess; ?></td>  
                                                <td>
                                                    <a class="btn btn-sm btn-<?= $tax_value->status == 1 ? 'success' : 'danger' ?>" href="<?= base_url('admin/status-tax/'.$tax_value->id) ?>" onclick="return confirm('Are You Confirm To <?= $tax_value->status == 1 ? 'Inactive' : "Active" ?> User')" title="Current Status <?= $tax_value->status == 1 ? 'Active' : "Inactive" ?>">
                                                        <?php if($tax_value->status): ?>
                                                            <i class="bi bi-patch-check"></i> Active
                                                            <?php else: ?>
                                                                <i class="bi bi-ban"></i> Inactive
                                                        <?php endif; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url(); ?>admin/edit-tax/<?= $tax_value->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>admin/delete-tax/<?= $tax_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger">
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