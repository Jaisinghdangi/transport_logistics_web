<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
        <?= $this->include('Includes/Message') ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Employees</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('company/add-employee') ?>" class="btn btn-primary">Add New Employee</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header"> 
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Profile</th>
                                        <th>Status</th>
                                        <th>Employee Role</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($users) && count($users) > 0): ?>
                                        <?php foreach ($users as $key => $value): ?> 
                                                <tr class="align-middle">
                                                    <td><?= $key+1 ?></td> 
                                                    <td>
                                                        <a href="<?= base_url('company/employee-login/'.$value->id) ?>">
                                                            <?= $value->name ?></td> 
                                                        </a>
                                                    <td><?= $value->mobile ?></td> 
                                                    <td><?= $value->email ?></td> 
                                                    <td>
                                                        <img width="50px" class="rounded-circle" src="<?= base_url($value->profile ?? 'dist/assets/img/default.jpg') ?>" alt="">
                                                    </td>  
                                                    <td>
                                                        <a class="btn btn-sm btn-<?= $value->status == 1 ? 'success' : 'danger' ?>" href="<?= base_url('company/employee-status/'.$value->id) ?>" onclick="return confirm('Are You Confirm To <?= $value->status == 1 ? 'Inactive' : "Active" ?> Employee')" title="Current Status <?= $value->status == 1 ? 'Active' : "Inactive" ?>">
                                                            <?php if($value->status): ?>
                                                                <i class="bi bi-patch-check"></i> Active
                                                                <?php else: ?>
                                                                    <i class="bi bi-ban"></i> Inactive
                                                            <?php endif; ?>
                                                        </a>
                                                    </td>
                                                    <td><?= get_role($value->role) ?></td> 
                                                    <td>
                                                        <a href="<?= base_url('company/employee/'.$value->id); ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i></a>
                                                        <a href="<?= base_url('company/delete-employee/'.$value->id); ?>" onclick="return confirm('Really You want Delete')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                                    </td> 
                                                </tr> 
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>Record Not Dound</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section('js') ?> 
<!-- write js here -->
<script>
$('#datatable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
});
</script>
<?= $this->endSection() ?>