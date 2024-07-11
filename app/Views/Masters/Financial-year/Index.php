<?= $this->extend('Logistics/Logistics'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Financial year</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>States">Financial year</a>
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
                                    Financial Years Report
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/Add-FinancialYears" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Year</th>
                                            <th>Starting Year</th>
                                            <th>Ending Year</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($years) && count($years) > 0) { 
                                            foreach ($years as $year_key => $years_value) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $year_key+1; ?></td> 
                                                <td><?= $years_value->year; ?></td> 
                                                <td><?= $years_value->starting_year; ?></td> 
                                                <td><?= $years_value->ending_year; ?></td> 
                                                <td>
                                                    <?php if ($years_value->status) { ?>
                                                    <a href="<?= base_url(); ?>admin/status-FinancialYears/<?= $years_value->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-patch-check"></i> Active
                                                    </a>
                                                    <?php } else { ?>
                                                    <a href="<?= base_url(); ?>admin/status-FinancialYears/<?= $years_value->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-ban"></i> Inactive
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('admin/Default-FinancialYears/'.$years_value->id) ?>">
                                                        <input type="radio" style="width:20px; height:20px;" name="f_year" <?= $years_value->default_year == 1 ? 'checked' : '' ?>>
                                                    </a>
                                                    <a href="<?= base_url(); ?>admin/Edit-FinancialYears/<?= $years_value->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>admin/Delete-FinancialYears/<?= $years_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger">
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