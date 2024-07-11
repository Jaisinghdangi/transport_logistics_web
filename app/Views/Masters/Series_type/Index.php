<?= $this->extend('Logistics/Logistics'); ?>
<?= $this->section('content'); ?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Series Types </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('admin/series-type'); ?>">Series Type</a>
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
                                    Series Type Report
                                </h5>
                            </div>
                            <a href="<?= base_url('admin/add-series-type'); ?>" class="btn btn-primary btn-sm float-end">
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($series_types) && count($series_types) > 0) {
                                            foreach ($series_types as $series_type_key => $series_type) {   ?>
                                                <tr class="align-middle">
                                                    <td><?= $series_type_key + 1; ?></td>
                                                    <td><?= $series_type->name; ?> </td>
                                                    <td> 
                                                        <a href="<?= base_url(); ?>admin/edit-series-type/<?= $series_type->id; ?>" class="btn btn-sm btn-success mt-2">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="<?= base_url(); ?>admin/delete-series-type/<?= $series_type->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger mt-2">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
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
        "pageLength": 20,
        "lengthMenu": [
            [20, 50, 100, 500, -1],
            [20, 50, 100, 500, "All"]
        ],
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