<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Products </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li> 
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/product'); ?>">Products</a>
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
                                    Product Report
                                </h5>
                            </div>
                            <a href="<?= base_url('company/add-product'); ?>" class="btn btn-primary btn-sm float-end">
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
                                            <th>Description</th>
                                            <th>Tax</th>
                                            <th>MRP</th>
                                            <th>Discount (%)</th>
                                            <th>Price</th>  
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  if (isset($products) && count($products) > 0) { 
                                            foreach ($products as $product_key => $product_value) {   ?>
                                            <tr class="align-middle">
                                                <td><?= $product_key+1; ?></td> 
                                                <td><?= $product_value->name; ?>  </td>
                                                <td><?= $product_value->description; ?>  </td>
                                                <td><?= get_title('taxes', ['id'=>$product_value->tax], 'name'); ?>  </td>
                                                <td><?= $product_value->mrp; ?></td>
                                                <td><?= $product_value->discount; ?></td> 
                                                <td><?= $product_value->price; ?></td>  
                                                    <td>
                                                    <?php if ($product_value->status) { ?>
                                                    <a href="<?= base_url(); ?>company/status-product/<?= $product_value->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-patch-check"></i> Active
                                                    </a>
                                                    <?php } else { ?>
                                                    <a href="<?= base_url(); ?>company/status-product/<?= $product_value->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                        <i class="bi bi-ban"></i> Inactive
                                                    </a>
                                                    <?php } ?>
                                                    <a href="<?= base_url(); ?>company/edit-product/<?= $product_value->id; ?>" class="btn btn-sm btn-success mt-2">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= base_url(); ?>company/delete-product/<?= $product_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger mt-2">
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
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false
    });
</script>
<?= $this->endSection(); ?>