<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Warehouse;

class WarehouseController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    { 
        $warehouse_model = new Warehouse(); 
        $data['warehouse'] = $warehouse_model->where('is_delete', 1)->where('comp_id',session()->get('CompId'))->get()->getResult();  
        $data['title'] = 'All Warehouses';   
        return view('Company/warehouse/index', $data);
    }

    public function add(){
        $data['title'] = 'Add Warehouse';
        return view('Company/warehouse/create', $data);
    }

    public function store(){
        $validatedData = $this->request->getPost();   
        $rules = [
            'name' => 'required',
            'location'    => 'required',
        ];
        if(isset($validatedData['mobile']) && !empty($validatedData['mobile'])){
            $rules['mobile'] = 'required|min_length[10]|max_length[10]|numeric';
        }
        if(isset($validatedData['email']) && !empty($validatedData['email'])){
            $rules['email'] = 'required|valid_email';
        }
        $this->validation->setRules($rules);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Warehouse();
            $data = [
                'name' => $validatedData['name'], 
                'location'    => $validatedData['location'],
                'contact_person'  => $validatedData['contact_person'] ?? '',
                'email'    => $validatedData['email'] ?? '',
                'mobile'    => $validatedData['mobile'] ?? '',
                'remark'    => $validatedData['remark'] ?? '', 
                // other columns 
                'created' => current_time(),
                'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];
            $ins_id = $model->insert($data);
            if($ins_id){ 
                session()->setFlashdata('success', 'Warehouse Created Successfully.');
                return redirect()->to(base_url('company/warehouse')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function status($id){
        $warehouse  = new Warehouse();
        $comp = $warehouse->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $update = [];
        if($comp->status){
            $update['status'] = 0; 
        }else{
            $update['status'] = 1; 
        }
        $warehouse->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('error', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }

    public function edit($id){
        $warehouse  = new Warehouse();
        $data['warehouse'] = $warehouse->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $data['title'] = 'Update Warehouse';  
        return view('Company/warehouse/edit', $data);
    }

    public function update($id){
        $validatedData = $this->request->getPost();   
        $rules = [
            'name' => 'required',
            'location'    => 'required',
        ];
        if(isset($validatedData['mobile']) && !empty($validatedData['mobile'])){
            $rules['mobile'] = 'required|min_length[10]|max_length[10]|numeric';
        }
        if(isset($validatedData['email']) && !empty($validatedData['email'])){
            $rules['email'] = 'required|valid_email';
        }
        $this->validation->setRules($rules);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Warehouse();
            $data = [
                'name' => $validatedData['name'], 
                'location'    => $validatedData['location'],
                'contact_person'  => $validatedData['contact_person'] ?? '',
                'email'    => $validatedData['email'] ?? '',
                'mobile'    => $validatedData['mobile'] ?? '',
                'remark'    => $validatedData['remark'] ?? '', 
                // other columns 
                'created' => current_time(),
                'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];
            $ins_id = $model->where('id',$id)->set($data)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Warehouse Created Successfully.');
                return redirect()->to(base_url('company/warehouse')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }


    public function delete($id){
        $warehouse  = new Warehouse();
        $comp = $warehouse->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $update = [];
        $update['is_delete'] = 0;  
        $warehouse->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('success', 'Warehouse Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}