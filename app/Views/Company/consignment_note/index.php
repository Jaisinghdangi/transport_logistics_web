<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Consignment Note </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/consignment-note'); ?>">Consignment Note</a>
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
            <!-- <h5 class="header-title text-primary">Company Terms & Condition </h5> -->
                            </div>
                            <!-- <a href="<?//= base_url('company/add-terms-condition'); ?>" class="btn btn-primary btn-sm float-end"> -->
                                <!-- <i class="bi bi-plus-circle"></i> Create -->
                            <!-- </a> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Consign Number</th> 
                                            <th>Service Description</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php  if (isset($bookingConsignNumber) && count($bookingConsignNumber) > 0) { 
                                            $countValue= count($bookingConsignNumber);
                                            foreach ($bookingConsignNumber as $terms => $term) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $terms+1; ?></td> 
                                                <td><?= $term->consignment_number; ?></td>
                                                <td><?= $term->service_description; ?></td>

                                                <td>
                                                    <a href="<?= base_url(); ?>company/print-consignment-note/<?= $term->id; ?>" class="btn btn-sm btn-success">
                                                    <i class="bi bi-printer"></i>
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