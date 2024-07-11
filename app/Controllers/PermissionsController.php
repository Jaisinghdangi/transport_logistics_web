<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permission;

class PermissionsController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Permission();
        $data['title'] = 'Permissions';
        $data['permissions'] = $model->where('comp_id', NULL)->orderBy('id', 'DESC')->get()->getResult();  
        return view('Logistics/Permissions/index', $data);
    }
    
    public function create(){
        $model = new Permission();
        $data = ['title' => 'Add Permissions'];
        $data['permissions'] = $model->where('parent_id',0)->where('comp_id', NULL)->get()->getResult();
        return view('Logistics/Permissions/create', $data);
    }

    public function store(){ 
        $this->validation->setRules(
            [
                'url' => 'required', //min_length[5]|max_length[50]
                'name'    => 'required',
                'parent'    => 'required',
                'icon'    => 'required', 
                'module_type'=>'required',
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new Permission();
            $data = [
                'parent_id' => $validatedData['parent'],
                'url' => $validatedData['url'],
                'name' => $validatedData['name'],
                'icon' => $validatedData['icon'],
                'module_type' => $validatedData['module_type'],
                'created' => current_time(),
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'Permission Added Successfully.');
            return redirect()->to(base_url('admin/permissions')); 
        }
    }

    public function edit($id){
        $model = new Permission();
        $data['title'] = 'Edit Permission';
        $data['permission'] = $model->where('id',$id)->get()->getRow();
        $data['permissions'] = $model->where('parent_id',0)->where('comp_id', NULL)->get()->getResult();  
        return view('Logistics/Permissions/edit', $data);
    }

    public function update($id){
        $this->validation->setRules(
            [
                'url' => 'required', //min_length[5]|max_length[50]
                'name'    => 'required',
                'parent'    => 'required',
                'icon'    => 'required', 
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost(); 
            $model = new Permission();
            $data = [
                'parent_id' => $validatedData['parent'],
                'url' => $validatedData['url'],
                'name' => $validatedData['name'],
                'icon' => $validatedData['icon'],
            ];
            $model->set($data)->where('id',$id)->update();
            session()->setFlashdata('success', 'Permission Updated Successfully.');
            return redirect()->to(base_url('admin/permissions')); 
        }
    }
    
    public function delete($id){
        $model = new Permission(); 
        $model->where('id',$id)->delete();   
        session()->setFlashdata('success', 'Permission Delete Successfully.');
        return redirect()->to(previous_url());
    }
}
