<?= $this->extend('Logistics/Logistics'); ?>

<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Countries</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>countries">Countries</a>
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
                                    Country Report
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/add-country" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Country</th>
                                            <th>Country Code</th>
                                            <th>Phone Code</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if (isset($countries) && count($countries) > 0) {
                                                $Sr = 0;
                                                foreach ($countries as $key => $value) { ?>
                                        <tr class="align-middle">
                                            <td><?= $key+1; ?></td> 
                                            <td><?= $value->shortname; ?></td> 
                                            <td><?= $value->name; ?></td> 
                                            <td><?= $value->phonecode; ?></td> 
                                            <td>
                                                <?php if ($value->status) { ?>
                                                    <a href="<?= base_url(); ?>admin/status-country/<?= $value->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-patch-check"></i> Active
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="<?= base_url(); ?>admin/status-country/<?= $value->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-ban"></i> Inactive
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url(); ?>admin/edit-country/<?= $value->id; ?>" class="btn btn-sm btn-success">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/delete-country/<?= $value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger">
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