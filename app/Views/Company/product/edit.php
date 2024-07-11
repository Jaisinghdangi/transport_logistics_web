<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>
<?php $errors = [];
if (session()->has('errors')) {
    $errors = session()->get('errors');
} ?>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Products</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li> 
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/products">Products</a>
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
                                    Add Product
                                </h5>
                            </div>
                            <a href="<?= base_url('company/products'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                                <div class="row"> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="<?= $product->name; ?>" id="name" class="form-control form-control-sm" placeholder="Warehouse Name" autocomplete="off" required="" />
                                        <?php if (array_key_exists('name', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['name'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <label for="description" class="form-label">Product Description <span class="text-danger">*</span></label>
                                        <input type="text" name="description" value="<?= $product->description; ?>" id="description" class="form-control form-control-sm" placeholder="Description" autocomplete="off" />
                                        <?php if (array_key_exists('description', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['description'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="mrp" class="form-label">Mrp </label>
                                        <input type="text" onkeyup="update_price()" onchange="update_price()" name="mrp" value="<?= $product->mrp; ?>" id="mrp" class="form-control form-control-sm" placeholder="Mrp" autocomplete="off" />
                                        <?php if (array_key_exists('mrp', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['mrp'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="discount" class="form-label">Discount (%) </label>
                                        <input type="text" name="discount" onkeyup="update_price()" onchange="update_price()" value="<?= $product->discount; ?>" id="discount" class="form-control form-control-sm" placeholder="Discount" autocomplete="off" />
                                        <?php if (array_key_exists('discount', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['discount'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" name="price" value="<?= $product->price; ?>" id="price" class="form-control form-control-sm" placeholder="Price" autocomplete="off" readonly />
                                        <?php if (array_key_exists('price', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['price'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="price" class="form-label">Select Tax <span class="text-danger">*</span></label>
                                        <select name="tax" id="tax" required class="form-control form-control-sm">
                                            <option value="">Select Tax</option>
                                            <?php foreach ($taxes as $tax_key => $tax_val):?>
                                                <option value="<?= $tax_val->id ?>" <?= $tax_val->id ==  $product->tax ? 'selected' : ''; ?> ><?= $tax_val->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (array_key_exists('price', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['price'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                </div> 
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit" />
                                        <input type="reset" class="btn btn-danger btn-sm" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $('#finance_state').change(function() {
        $.ajax({
            url: '<?= base_url('admin/get-districts') ?>',
            method: 'post',
            data: {
                'state_id': $(this).val()
            },
            success: function(data) {
                $('#finance_district').html(data)
            }
        })
    })

    $('#driver_state').change(function() {
        $.ajax({
            url: '<?= base_url('admin/get-districts') ?>',
            method: 'post',
            data: {
                'state_id': $(this).val()
            },
            success: function(data) {
                $('#driver_district').html(data)
            }
        })
    })

    function update_price(){
       mrp =  $('#mrp').val()
       discount =  $('#discount').val()
       if(discount > 0){
        mrp = parseInt(mrp) - parseInt(discount)
       }
       $('#price').val(parseFloat(mrp).toFixed(2))
    }
</script>
<?= $this->endSection(); ?>