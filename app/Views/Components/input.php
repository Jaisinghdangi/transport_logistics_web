<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
    <label for="<?= $name ?>"><?= $label ?> 
    <?php if($required): ?>
        <span class="text-danger">*</span></label>
    <?php endif; ?> 
    <input 
        type="text" 
        name="<?= $name ?>" 
        id="<?= $name ?>" 
        value="<?= $value ?? '' ?>" 
        class="form-control form-control-sm <?= $classes ?? '' ?>" 
        placeholder="<?= $placeholder ?? '' ?>" 
        autocomplete="<?= $autocomplete ?? 'off' ?>" 
        required="<?= $required ?>" 
        <?php if(isset($maxlength)): ?>
            maxlength="<?= $maxlength ?>"
        <?php endif; ?>
        <?php if(isset($minlength)): ?>
            minlength="<?= $minlength ?>"
        <?php endif; ?>
        <?php if(isset($pattern)): ?>
            pattern="<?= $pattern ?>"
        <?php endif; ?>
        <?php if(isset($readonly) && $readonly): ?>
            readonly
        <?php endif; ?>
        <?php if(isset($disabled) && $disabled): ?>
            disabled
        <?php endif; ?>
        <?php if(isset($autofocus) && $autofocus): ?>
            autofocus
        <?php endif; ?>
        <?php if(isset($step)): ?>
            step="<?= $step ?>"
        <?php endif; ?>
        <?php if(isset($min)): ?>
            min="<?= $min ?>"
        <?php endif; ?>
        <?php if(isset($max)): ?>
            max="<?= $max ?>"
        <?php endif; ?>
    />
    <?php if(isset($error) && !empty($error)): ?>  
        <div class="text-danger"> <?= $error ?></div>
    <?php endif; ?>
</div>
