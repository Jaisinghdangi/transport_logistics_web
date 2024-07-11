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
                    <h3 class="mb-0">Series Type</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/series">Series </a>
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
                                    Add Series
                                </h5>
                            </div>
                            <a href="<?= base_url('company/series'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="series_type" class="form-label">Series Type <span class="text-danger">*</span></label>
                                        <select name="series_type" id="series_type" class="form-control" required>
                                            <option value="">Select Series</option>
                                            <?php foreach ($series_types as $series_type_val) : ?>
                                                <option value="<?= $series_type_val->id ?>" <?= $series->series_type == $series_type_val->id ? 'selected' : ''  ?>><?= $series_type_val->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (array_key_exists('series_type', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['series_type'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="financial_year" class="form-label">Financial Year <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-8">
                                                <select name="financial_year" id="financial_year" class="form-control">
                                                    <option value="">Financial Year</option>
                                                    <?php foreach ($financial_years as $financial_year_key => $financial_year) : ?>
                                                        <option value="<?= $financial_year->id ?>" <?= $financial_year->id == $series->financial_year ? 'selected' : '' ?>><?= $financial_year->year ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if (array_key_exists('financial_year', $errors)) : ?>
                                                    <div class="text-danger"> <?= $errors['financial_year'];  ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-4">
                                                <select name="financial_year_pos" id="financial_year_pos" class="form-control">
                                                    <option value="1" <?= $series->financial_year_pos == 1 ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= $series->financial_year_pos == 2 ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= $series->financial_year_pos == 3 ? 'selected' : '' ?>>3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="prefix" class="form-label">Prefix <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="prefix" id="prefix" value="<?= $series->prefix ?>" placeholder="Prefix" class="form-control" required>
                                                <?php if (array_key_exists('prefix', $errors)) : ?>
                                                    <div class="text-danger"> <?= $errors['prefix'];  ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-4">
                                                <select name="prefix_pos" id="prefix_pos" class="form-control" required>
                                                    <option value="1" <?= $series->financial_year_pos == 1 ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= $series->financial_year_pos == 2 ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= $series->financial_year_pos == 3 ? 'selected' : '' ?>>3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="start_point" class="form-label">Starting At <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="start_point" value="<?= $series->start_point ?>" id="start_point" placeholder="00001" class="form-control" required>
                                                <?php if (array_key_exists('start_point', $errors)) : ?>
                                                    <div class="text-danger"> <?= $errors['start_point'];  ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-4">
                                                <select name="start_point_pos" id="start_point_pos" class="form-control" required>
                                                    <option value="1" <?= $series->financial_year_pos == 1 ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= $series->financial_year_pos == 2 ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= $series->financial_year_pos == 3 ? 'selected' : '' ?>>3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <label for="symbl" class="form-label">Separate By <span class="text-danger">*</span></label>
                                        <input type="text" name="symbl" value="<?= $series->symbl ?>" id="symbl" placeholder="Ex: / " class="form-control">
                                        <?php if (array_key_exists('symbl', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['symbl'];  ?></div>
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

<?= $this->endSection(); ?>