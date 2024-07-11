<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Print Style Master</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('/company/print-style-master'); ?>">Print Style Master</a>
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
                                Print Style Master for Basic Pritable Page designe                           </h5>
                            </div>
                            <a href="<?= base_url('company/add-print-style'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Print Type</th> 
                                            <th>Background Color</th> 
                                            <th>Text Color</th> 
                                            <th>Font Color</th> 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php  if (isset($printstyle) && count($printstyle) > 0) { 
                                            // $countValue= count($terms);
                                            foreach ($printstyle as $terms => $term) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $terms+1; ?></td> 
                                                <td><?= $term->print_type; ?></td>
                                                <td><input type="color" value="<?= $term->bg_color; ?>" readonly></td>
                                                <td><input type="color" value="<?= $term->text_color; ?>" readonly></td>
                                                <td><?= $term->text_font; ?></td>
                                                <td>
                                                    <?php if ($term->status) { ?>
                                                    <a href="<?= base_url(); ?>company/status-print-style/<?= $term->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-patch-check"></i> Active
                                                    </a>
                                                    <?php } else { ?>
                                                    <a href="<?= base_url(); ?>company/status-print-style/<?= $term->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-ban"></i> Inactive
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url(); ?>company/edit-print-style/<?= $term->id; ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-pencil-square"></i>
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