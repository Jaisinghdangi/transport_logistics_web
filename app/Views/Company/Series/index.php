<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Series </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/series'); ?>">Series</a>
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
                                    Series Report
                                </h5>
                            </div>
                            <a href="<?= base_url('company/add-series'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Financial Year</th>
                                            <th>Started At</th>
                                            <th>Prefix</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($series) && count($series) > 0) {
                                            foreach ($series as $series_key => $series_val) {   ?>
                                                <tr class="align-middle">
                                                    <td><?= $series_key + 1; ?></td>
                                                    <td><?= get_title('series_types', ['id' => $series_val->series_type], 'name'); ?> </td>
                                                    <td>
                                                        <?= $series_val->start_point; ?>
                                                    </td><td>
                                                        <?= $series_val->prefix; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($series_val->status) { ?>
                                                            <a href="<?= base_url(); ?>company/status-series/<?= $series_val->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                                <i class="bi bi-patch-check"></i> Active
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>company/status-series/<?= $series_val->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                                <i class="bi bi-ban"></i> Inactive
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url(); ?>company/edit-series/<?= $series_val->id; ?>" class="btn btn-sm btn-success mt-2">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="<?= base_url(); ?>company/delete-series/<?= $series_val->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger mt-2">
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