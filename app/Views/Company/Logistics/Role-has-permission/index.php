<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>


<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
        <?= $this->include('Includes/Message') ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Role Has Permissions</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <!-- <li class="breadcrumb-item"><a href="<?= base_url('company/role-has-permission') ?>" class="btn btn-primary">Add</a></li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header"> 
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>User</th>
                                        <th>Permissions</th> 
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($roles) && count($roles) > 0): ?>
                                        <?php foreach ($roles as $key => $value): ?>
                                            <tr class="align-middle">
                                                <td><?= $key+1 ?></td>
                                                <td><?= $value->name ?></td>
                                                <td>
                                                    <?php 
                                                        $this->db = \Config\Database::connect();
                                                        $main_menus_table = $this->db->table('permissions')->where(['parent_id'=>0,])->get()->getResult(); 
                                                        $role_has_permission_table = $this->db->table('role_has_permissions')->where('role_id',$value->id)->get()->getResult(); 
                                                        $pers_table = []; 
                                                        foreach ($role_has_permission_table as $table_key => $table_value) {
                                                            $pers_table[] = $table_value->permission_id; 
                                                        }  
                                                        foreach ($main_menus_table as $menu_table_key => $menu_table_value) {
                                                            if(in_array($menu_table_value->id,$pers_table)){
                                                                echo '<b>'.$menu_table_value->name.'</b> ';
                                                                $sub_menus_table = $this->db->table('permissions')->where('parent_id',$menu_table_value->id)->get()->getResult();  
                                                                if(count($sub_menus_table) > 0){ 
                                                                    foreach ($sub_menus_table as $sub_table_key => $sub_table_value) { 
                                                                        echo $sub_table_key == 0 ? ' ( ' : '';
                                                                        if(in_array($sub_table_value->id,$pers_table)){ 
                                                                            echo $sub_table_value->name.', ';
                                                                            echo count($sub_menus_table) == ($sub_table_key+1) ? ' )<br>' : ''; 
                                                                        } 
                                                                    }
                                                                }else{  
                                                                    echo '()';
                                                                } 
                                                            }  
                                                            
                                                        }
                                                        echo '<b>Accessibility  - </b>'.($value->permissions == null ? 'No Access' : $value->permissions ) ?? 'No Accesss'; 
                                                        ?>  
                                                </td> 
                                                <td>
                                                    <a href="<?= base_url('company/role-has-permission/'.$value->id); ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i></a>
                                                </td> 
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>Record Not Dound</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section('js') ?> 
<!-- write js here -->
<script>
$('#datatable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
});
</script>
<?= $this->endSection() ?>