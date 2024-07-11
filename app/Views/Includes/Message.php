<div class="row"  style="padding-top:0px;">
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
        <?php if(session()->has('Status_success')): ?>
            <div class="alert alert-danger">
                <?= session()->get('Status_success') ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>