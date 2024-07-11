<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\RoleHasPermission;
use App\Models\Permission;
use App\Models\Role;


class RoleHasPermissionController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $role = new Role(); 
        $data['title'] = 'Roles Has Permissions';
        $data['roles'] = $role->orderBy('id', 'DESC')->where(['delete_status'=>0,'comp_id' => session()->get('CompId')])->get()->getResult(); 
        return view('Company/Logistics/Role-has-permission/index', $data);
    }
    
    public function edit($id){
        $role_has_permission = new RoleHasPermission();
        $roles = new Role();
        $data['user'] = $roles->where(['id'=>$id])->get()->getRow();
        $permissions = new Permission();
        $roles_has_permissions = new RoleHasPermission();
        $data['title'] = 'Roles';
        $data['permissions'] = $permissions->where(['parent_id'=>0,'module_type'=>'Company',])->get()->getResult();
        $role_has_permission = $roles_has_permissions->where('role_id',$id)->get()->getResult(); 
        $arr = []; 
        foreach ($role_has_permission as $key => $value) {
            $arr[]  = $value->permission_id;
        }
        $data['role_has_permission'] = $arr; 
        return view('Company/Logistics/Role-has-permission/edit', $data);
    }

    public function update($id){
        $roles_has_permissions = new RoleHasPermission();
        // $roles_has_permissions->where('role_id',$id)->delete(); 
        $roles = new Role();
        $user_actions = $roles->where('id',$id)->get()->getRow();
        $user_data = $this->request->getPost();  
        $parent_permissions = $user_data['parent_permissions'];
        $batch_insert = [];
        foreach ($parent_permissions as $key => $value) {
            $insert_data = [
                'role_id' =>$id,
                'permission_id'=>$value,
                'action'=>$user_actions->permissions,
                'comp_id' => session()->get('CompId'),

            ]; 
            $batch_insert[] = $insert_data;
            if(isset($user_data['child_permissions_'.$value])){
                foreach ($user_data['child_permissions_'.$value] as $child_key => $child_value) {
                    $insert_data = [
                        'role_id' =>$id,
                        'permission_id'=>$child_value,
                        'action'=>$user_actions->permissions,
                        'comp_id' => session()->get('CompId'),

                    ]; 
                    $batch_insert[] = $insert_data;
                }
            }
        }
        $roles_has_permissions->insertBatch($batch_insert);
        session()->setFlashdata('success', 'Roles Has Permissions Updated Successfully.');
        return redirect()->to(base_url('company/role-has-permission')); 
    }
}
