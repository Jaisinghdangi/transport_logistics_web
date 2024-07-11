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
                    <h3 class="mb-0">Warehouse</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li> 
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/warehouse">Warehouse</a>
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
                                    Add Warehouse
                                </h5>
                            </div>
                            <a href="<?= base_url('company/warehouse'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                                <div class="row"> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="name" class="form-label">Warehouse Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="<?= set_value('name'); ?>" id="name" class="form-control form-control-sm" placeholder="Warehouse Name" autocomplete="off" required="" />
                                        <?php if (array_key_exists('name', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['name'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" name="location" value="<?= set_value('location'); ?>" id="location" class="form-control form-control-sm" placeholder="Location" autocomplete="off" />
                                        <?php if (array_key_exists('location', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['location'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="mobile" class="form-label">Mobile </label>
                                        <input type="text" name="mobile" value="<?= set_value('mobile'); ?>" id="mobile" class="form-control form-control-sm" placeholder="Mobile" minlength="10" maxlength="10" autocomplete="off" />
                                        <?php if (array_key_exists('mobile', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['mobile'];  ?></div>
                                        <?php endif; ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="email" class="form-label">Email </label>
                                        <input type="email" name="email" value="<?= set_value('email'); ?>" id="email" class="form-control form-control-sm" placeholder="Email" autocomplete="off" />
                                        <?php if (array_key_exists('email', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['email'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 mt-2">
                                        <label for="remark" class="form-label">Remark</label>
                                        <input type="text" name="remark" value="<?= set_value('remark'); ?>" id="remark" class="form-control form-control-sm" placeholder="Remark" autocomplete="off" />
                                        <?php if (array_key_exists('remark', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['remark'];  ?></div>
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
</script>
<?= $this->endSection(); ?>