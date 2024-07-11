<?= $this->extend('Logistics/Logistics') ?>
<?= $this->section('content') ?>
<?php
$errors = [];
if (session()->has('errors')) {
    $errors = session()->get('errors');
}
?>
<main class="app-main"><!--begin::App Content Header-->
    <div class="app-content-header"><!--begin::Container-->
        <div class="container-fluid"><!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Update Roles & Permission</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('admin/role-has-permission') ?>" class="btn btn-secondary">Back</a>
                        </li>
                    </ol>
                </div>
            </div><!--end::Row-->
        </div><!--end::Container-->
    </div><!--end::App Content Header--><!--begin::App Content-->
    <div class="app-content"><!--begin::Container-->
        <div class="container-fluid"><!--begin::Row-->
            <div class="row g-4">
                <div class="col-md-12">
                    <form method="post">
                        <?= csrf_field(); ?>
                        <div class="card card-dafault mb-4"><!--begin::Header-->
                            <div class="card-header">
                                <div class="card-header"><?= $user->name ?? '' ?> - Roles & Permissions </div>
                            </div>
                            <div class="card-body mb-3">
                                <div class="row"> 
                                   <?php if(isset($permissions) && count($permissions) > 0): ?>
                                        <?php foreach ($permissions as $permission_key => $permission_value): ?>
                                            <div class="col-md-12">
                                                <input class="m-2" type="checkbox" name="parent_permissions[]" id="roles_<?= $permission_value->id ?>" value="<?= $permission_value->id ?>" onclick="on_checkbox($(this),<?= $permission_value->id ?>)" <?= in_array($permission_value->id,$role_has_permission) ? 'checked' : '' ?> ><?= $permission_value->name ?>
                                            </div>
                                            <?php
                                                $this->db = \Config\Database::connect();
                                                $sub_menus = $this->db->table('permissions')->where('parent_id',$permission_value->id)->get()->getResult(); 
                                            ?>
                                            <?php if(count($sub_menus) > 0): ?>
                                                <div class="col-md-12 mx-5"> 
                                                    <?php foreach($sub_menus as $sub_m_key => $sub_m_value): ?>
                                                        <input class="m-2 child_permissions_<?= $permission_value->id ?>" type="checkbox" name="child_permissions_<?= $permission_value->id ?>[]" value="<?= $sub_m_value->id ?>" onclick="child_checkbox(<?= $permission_value->id ?>)" <?= in_array($sub_m_value->id,$role_has_permission) ? 'checked' : '' ?> ><?= $sub_m_value->name ?> | 
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>Permission Not Dound</td>
                                        </tr>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--end::Container-->
    </div><!--end::App Content-->
</main>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- write js here -->
<script>
    function on_checkbox(parent, attr_id){ 
        if(parent.prop('checked')){
            $('.child_permissions_'+attr_id).prop('checked', true)
        }else{
            $('.child_permissions_'+attr_id).prop('checked', false)
        }
    }
    
    function child_checkbox(attr_id) {
    var parentCheckbox = $('#roles_' + attr_id);
 
    var atLeastOneChecked = false;

    $('.child_permissions_' + attr_id).each(function() {
        if ($(this).prop('checked')) {
            atLeastOneChecked = true;
            return false; 
        }
    }); 
    parentCheckbox.prop('checked', atLeastOneChecked);
}

</script>
<?= $this->endSection() ?>