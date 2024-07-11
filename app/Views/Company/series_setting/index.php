<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Series Setting</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/series_setting'); ?>">Series Setting</a>
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
                                Series Setting</h5>
                            </div>
                            <a href="<?= base_url('company/add-series_setting'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-plus-circle"></i> Create
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Series Type</th> 
                                            <th>Prefix</th> 
                                            <th>Start Point</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php  if (isset($seriesSetting) && count($seriesSetting) > 0) { 
                                            // $countValue= count($terms);
                                            foreach ($seriesSetting as $terms => $term) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $terms+1;?></td> 
                                                <?php foreach($SeriesType as $Series_val): ?>
                          <?php $Series_name;($Series_val->id == $term->series_type) ? $Series_name= $Series_val->name : ''?>
                                                           <?php endforeach ?>
                                                <td><?=$Series_name; ?></td>
                                                <td><?= $term->prefix; ?></td>
                                                <td><?= $term->start_point; ?></td>

                                               
                                               
                                                <td>
                                                    <a href="<?= base_url(); ?>company/edit-series_setting/<?= $term->id; ?>" class="btn btn-sm btn-success">
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