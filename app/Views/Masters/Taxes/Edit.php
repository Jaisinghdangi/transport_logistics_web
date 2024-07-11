<?= $this->extend('Logistics/Logistics'); ?>
<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} ?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Financial Year</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>admin/FinancialYears">Financial Year</a>
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
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-info">
                                    Create Financial Year
                                </h5>
                            </div>
                            <a href="<?= base_url(); ?>admin/tax" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">  
                                    <div class="col-md-3 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" value="<?= $tax->name ?>" id="name" class="form-control form-control-sm" placeholder="name" autocomplete="off" required="" />
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('name', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['name'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="tax_per" value="<?= $tax->tax_per ?>" id="tax_per" class="form-control form-control-sm" onkeyup="calculate_gst($(this).val())" placeholder="tax_per" autocomplete="off" required="" />
                                            <label for="tax_per" class="form-label">Tax Percent <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('tax_per', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['tax_per'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="igst" value="<?= $tax->igst ?>" id="igst" class="form-control form-control-sm" placeholder="igst" autocomplete="off" required="" readonly />
                                            <label for="igst" class="form-label">IGST <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('igst', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['igst'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="cgst" value="<?= $tax->cgst ?>" id="cgst" class="form-control form-control-sm" placeholder="cgst" autocomplete="off" required="" readonly />
                                            <label for="cgst" class="form-label">CGST <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('cgst', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['cgst'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="sgst" value="<?= $tax->sgst ?>" id="sgst" class="form-control form-control-sm" placeholder="sgst" autocomplete="off" required="" readonly />
                                            <label for="sgst" class="form-label">SGST <span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('sgst', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['sgst'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="cess" value="<?= $tax->cess ?>" id="cess" class="form-control form-control-sm" placeholder="cess" autocomplete="off" required="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                                            <label for="cess" class="form-label">CESS<span class="text-danger">*</span></label>
                                            <?php if(array_key_exists('cess', $errors)): ?>  
                                                <div class="text-danger"> <?= $errors['cess'];  ?></div>
                                            <?php endif; ?>
                                        </div>
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
    function calculate_gst(number){
        cgst = number / 2;
        sgst = number / 2;
        igst = number;
        cess = 0;
        $('#cgst').val(cgst)
        $('#sgst').val(sgst)
        $('#igst').val(igst)
        // $('#cess').val(cess)
    }
</script>

<?= $this->endSection(); ?>