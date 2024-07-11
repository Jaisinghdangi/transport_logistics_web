<?php
$htmlAttributes = '';
if(isset($attrs) && is_array($attrs)){
    $array = $attrs;
    foreach ($array as $attribute => $value) { 
        if (is_array($value)) {
            $value = implode(' ', $value);
        } 
        $htmlAttributes .= "$attribute=\"$value\" ";
    }
}
?>
<div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4" >
    <label for="<?= $name ?>"><?= $label ?? '' ?>
    <?php if($required): ?>
        <span class="text-danger">*</span></label>
    <?php endif; ?></label>   
   <?php if(isset($addbutton) && $label == 'Consignor'){ ?>
<a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalnewmy" style="float: right;">+</a>
<?php } ?>
    <select <?= $htmlAttributes ?> name="<?= $name ?>" id="<?= $name ?>" <?= $required == 1  ? 'required' : '' ?> class="form-control <?= $classes ?? '' ?>">
        <option value="">Select <?= $label ?? '' ?></option>
            <?php if(isset($data) && !empty($data)): ?>
                <?php foreach ($data as $data_key => $data_value): ?>
                    <option value="<?= $data_value->id ?>"
                    <?php if(isset($value)){
                        echo $data_value->id == $value ? 'selected' : '';
                    } ?>
                    ><?= $data_value->name ;?> <?= (!empty($data_value->nickname)) ? '- ('.$data_value->nickname.')' : '' ; ?></option>
                <?php endforeach; ?>
            <?php endif; ?> 
    </select> 

    <?php if(isset($error) && !empty($error)): ?>  
        <div class="text-danger"> <?= $error ?></div>
    <?php endif; ?>
</div>