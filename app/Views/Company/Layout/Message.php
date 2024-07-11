<div class="row">
    <div class="col-12">
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
        <?php if(session()->has('error')): ?>
            <div class="alert alert-danger">
                <?= session()->get('error') ?>
            </div>
        <?php endif; ?>
    </div>
</div>