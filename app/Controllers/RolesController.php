<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Role;

class RolesController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Role();
        $data['title'] = 'Roles';
        $data['roles'] = $model->orderBy('id', 'DESC')->where(['delete_status'=>0, 'id !='=>1,'comp_id'=> NULL])->get()->getResult(); 
        return view('Logistics/Roles/index', $data);
    }

    public function create(){
        $data = ['title' => 'Add New Role'];
        return view('Logistics/Roles/create', $data);
    }
    
    public function store(){
        $this->validation->setRules(
            [
                'name' => 'required',
            ]
        ); 
        
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new Role();
            $data = [
                'name' => $validatedData['name'], 
                'created' => current_time(), 
            ];
            if(isset($validatedData['permissions'])){
                $data['permissions'] = implode(',', $validatedData['permissions']);
            } 
            $model->insert($data);
            session()->setFlashdata('success', 'Role Added Successfully.');
            return redirect()->to(base_url('admin/roles')); 
        }
    }

    public function edit($id){
        $model = new Role();
        $data['title'] = 'Edit Role';
        $data['role'] = $model->where('id',$id)->get()->getRow(); 
        return view('Logistics/Roles/edit', $data);
    }

    public function update($id){
        $this->validation->setRules(
            [
                'name' => 'required',
            ]
        );  
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new Role();
            $data = [
                'name' => $validatedData['name'], 
                'created' => current_time(), 
            ];
            if(isset($validatedData['permissions'])){
                $data['permissions'] = implode(',', $validatedData['permissions']);
            } 
            $model->where('id', $id)->set($data)->update();
            session()->setFlashdata('success', 'Role Update Successfully.');
            return redirect()->to(base_url('admin/roles')); 
        }
    }

    public function delete($id){
        $model = new Role(); 
        $model->where('id',$id)->set(['delete_status'=>1])->update();   
        session()->setFlashdata('success', 'Role Delete Successfully.');
        return redirect()->to(previous_url());
    }
}
