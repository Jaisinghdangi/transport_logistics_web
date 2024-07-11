<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController; 
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PaymentMode;

class PaymentModeController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new PaymentMode();
        $data['title'] = 'Payment Mode'; 
        $data['modes'] = $model->orderBy('id', 'DESC')->get()->getResult();  
        return view('Masters/Payment-mode/Index', $data);
    }
    
    public function add(){
        $data['title'] = 'Create Payment Mode'; 
        return view('Masters/Payment-mode/Create', $data);
    }

    public function store(){
        $this->validation->setRules(
            [
                'method'    => 'required', 
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new PaymentMode();
            $data = [
                'method' => $validatedData['method'], 
                'created' => current_time()
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'Payment Mode Added Successfully.');
            return redirect()->to(base_url('admin/payment-mode')); 
        }
    }

    public function status($id){
        $model = new PaymentMode();
        $user_data = $model->where(['id' => $id])->get()->getRow();
        if ($user_data->status) {
            $model->set(['status' => 0])->where(['id' => $id])->update();
        } else {
            $model->set(['status' => 1])->where(['id' => $id])->update();
        }

        session()->setFlashdata('success', 'Status Changed Successfully.');
        return redirect()->to(base_url('admin/payment-mode'));
    }

    public function edit($id){
        $model = new PaymentMode();
        $data['title'] = 'Add Financial Years';
        $data['mode'] = $model->where(['id' => $id])->get()->getRow();
        return view('Masters/Payment-mode/Edit', $data);
    }

    public function update($id){
        $this->validation->setRules(
            [
                'method' => 'required',
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new PaymentMode();
            $data = [
                'method' => $validatedData['method'],  
                'updated' => current_time(),  
            ];
            $model->where('id',$id)->set($data)->update();
            session()->setFlashdata('success', 'Payment Mode Updated Successfully.');
            return redirect()->to(base_url('admin/payment-mode')); 
        }
    }

    public function delete($id){
        $model = new PaymentMode(); 
        $model->where('id',$id)->delete();    
        session()->setFlashdata('success', 'Payment Mode Deleted Successfully.');
        return redirect()->to(previous_url());
    }
}
