<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Tax;

class TaxController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Tax();
        $data['title'] = 'Taxes'; 
        $data['taxes'] = $model->orderBy('id', 'DESC')->get()->getResult();  
        return view('Masters/Taxes/Index', $data);
    }
    
    public function add(){
        $data['title'] = 'Create Tax'; 
        return view('Masters/Taxes/Create', $data);
    }

    public function store(){
        $this->validation->setRules(
            [
                'name' => 'required', 
                'cgst' => 'required', 
                'sgst' => 'required', 
                'igst' => 'required', 
                'cess' => 'required', 
                'tax_per' => 'required', 
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new Tax();
            $data = [
                'name' => $validatedData['name'], 
                'cgst' => $validatedData['cgst'], 
                'sgst' => $validatedData['sgst'], 
                'igst' => $validatedData['igst'], 
                'cess' => $validatedData['cess'], 
                'tax_per' => $validatedData['tax_per'], 
                'created_at' => current_time()
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'Tax Added Successfully.');
            return redirect()->to(base_url('admin/tax')); 
        }
    }

    public function status($id){
        $model = new Tax();
        $user_data = $model->where(['id' => $id])->get()->getRow();
        if ($user_data->status) {
            $model->set(['status' => 0])->where(['id' => $id])->update();
        } else {
            $model->set(['status' => 1])->where(['id' => $id])->update();
        }

        session()->setFlashdata('success', 'Status Changed Successfully.');
        return redirect()->to(base_url('admin/tax'));
    }

    public function edit($id){
        $model = new Tax();
        $data['title'] = 'Update Tax';
        $data['tax'] = $model->where(['id' => $id])->get()->getRow();
        return view('Masters/Taxes/Edit', $data);
    }

    public function update($id){
        $this->validation->setRules(
            [
                'name' => 'required', 
                'cgst' => 'required', 
                'sgst' => 'required', 
                'igst' => 'required', 
                'cess' => 'required', 
                'tax_per' => 'required', 
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new Tax();
            $data = [
                'name' => $validatedData['name'], 
                'cgst' => $validatedData['cgst'], 
                'sgst' => $validatedData['sgst'], 
                'igst' => $validatedData['igst'], 
                'cess' => $validatedData['cess'], 
                'tax_per' => $validatedData['tax_per'], 
                'updated_at' => current_time()
            ];
            $model->set($data)->where('id',$id)->update();
            session()->setFlashdata('success', 'Tax Updated Successfully.');
            return redirect()->to(base_url('admin/tax')); 
        }
    }

    public function delete($id){
        $model = new Tax(); 
        $model->where('id',$id)->delete();    
        session()->setFlashdata('success', 'Tax Deleted Successfully.');
        return redirect()->to(previous_url());
    }
}
