<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Unit;

class UnitController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Unit();
        $data['title'] = 'Taxes'; 
        $data['units'] = $model->orderBy('id', 'DESC')->get()->getResult();  
        return view('Masters/Units/Index', $data);
    }
    
    public function add(){
        $data['title'] = 'Create Tax'; 
        return view('Masters/Units/Create', $data);
    }

    public function store(){
        $this->validation->setRules(
            [
                'name' => 'required', 
                'unit_code' => 'required',  
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new Unit();
            $data = [
                'name' => $validatedData['name'], 
                'unit_code' => $validatedData['unit_code'],  
                'created_at' => current_time()
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'Unit Added Successfully.');
            return redirect()->to(base_url('admin/units')); 
        }
    }

    public function status($id){
        $model = new Unit();
        $user_data = $model->where(['id' => $id])->get()->getRow();
        if ($user_data->status) {
            $model->set(['status' => 0])->where(['id' => $id])->update();
        } else {
            $model->set(['status' => 1])->where(['id' => $id])->update();
        }
        session()->setFlashdata('success', 'Status Changed Successfully.');
        return redirect()->to(base_url('admin/units'));
    }

    public function edit($id){
        $model = new Unit();
        $data['title'] = 'Update Tax';
        $data['unit'] = $model->where(['id' => $id])->get()->getRow();
        return view('Masters/Units/Edit', $data);
    }

    public function update($id){
        $this->validation->setRules(
            [
                'name' => 'required', 
                'unit_code' => 'required', 
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new Unit();
            $data = [
                'name' => $validatedData['name'], 
                'unit_code' => $validatedData['unit_code'],  
                'updated_at' => current_time(),
            ];
            $model->set($data)->where('id',$id)->update();
            session()->setFlashdata('success', 'Unit Updated Successfully.');
            return redirect()->to(base_url('admin/units')); 
        }
    }

    public function delete($id){
        $model = new Unit(); 
        $model->where('id',$id)->delete();    
        session()->setFlashdata('success', 'Unit Deleted Successfully.');
        return redirect()->to(previous_url());
    }
}
