<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Code Prefix Master </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/terms-condition'); ?>">Code Prefix Master </a>
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
                                Code Prefix Master                               </h5>
                            </div>
                            <?php 
    $showAnchorTag = true;
    $matchCount = 0; 
    foreach ($code_prepix_count as $terms => $term) {
        if ($term->series_type == 'Consignee' || $term->series_type == 'Consignor' || $term->series_type == 'Broker') {
            $matchCount++;
        }
    }
    if ($matchCount == 3) { 
        $showAnchorTag = false;
    }
    if ($showAnchorTag) { 
?>
        <a href="<?= base_url('company/add-code_prefix'); ?>" class="btn btn-primary btn-sm float-end">
            <i class="bi bi-plus-circle"></i> Create
        </a>
<?php 
    } 
?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Series Type</th> 

                                            <th>First Prefix</th> 
                                            <th>Second Prefix</th> 

                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php  if (isset($code_prepix) && count($code_prepix) > 0) { 
                                            $countValue= count($code_prepix);
                                            foreach ($code_prepix as $terms => $term) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $terms+1; ?></td> 
                                                <td><?=$term->series_type ; ?></td>

                                                <td><?= $term->first_prefix; ?></td>
                                                <td><?= $term->second_prefix; ?></td>

                                              


                        
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