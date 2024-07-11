<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?>


<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
        <?= $this->include('Includes/Message') ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Permissions</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url('company/add-permissions') ?>" class="btn btn-primary">Add</a></li>
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
                                        <th>Perent Module</th>
                                        <th>Name</th>
                                        <th>URL</th> 
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($permissions) && count($permissions) > 0): ?>
                                        <?php foreach ($permissions as $key => $value): ?>
                                            <tr class="align-middle">
                                                <td><?= $key+1 ?></td>
                                                <td>
                                                    <i class="bi <?= $value->parent_id == 0 ? $value->icon : 'bi-circle' ?>"></i> <?= get_module_name($value->parent_id) ?></td>
                                                <td><?= $value->name ?></td>
                                                <td><?= $value->url  ?? '' ?></td> 
                                                <td>
                                                    <a href="<?= base_url('company/permissions/'.$value->id); ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i></a>
                                                    <a onclick="return confirm('Really You want Delete')" href="<?= base_url('company/delete-permissions/'.$value->id); ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
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