<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FinancialYear;

class FinancialYearsController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new FinancialYear();
        $data['title'] = 'Financial Years'; 
        $data['years'] = $model->where('delete_status',0)->orderBy('id', 'DESC')->get()->getResult();  
        return view('Masters/Financial-year/Index', $data);
    }
    
    public function Add(){
        $data['title'] = 'Add Financial Years';
        return view('Masters/Financial-year/Create', $data);
    }

    public function Store(){
        $this->validation->setRules(
            [
                'year' => 'required|min_length[6]|max_length[7]', //min_length[5]|max_length[50]
                'start_date'    => 'required',
                'end_date'    => 'required', 
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new FinancialYear();
            $data = [
                'year' => $validatedData['year'],
                'starting_year' => $validatedData['start_date'],
                'ending_year' => $validatedData['end_date'], 
                'created_at' => current_time()
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'Financial Year Added Successfully.');
            return redirect()->to(base_url('admin/FinancialYears')); 
        }
    }

    public function Default($id){
        $model = new FinancialYear();
        $model->where('id>', 0)->set(['default_year' => 0])->update();
        $model->where(['id' => $id])->set(['default_year' => 1])->update();
        session()->setFlashdata('success', 'Default Financial Year Changed Successfully.');
        return redirect()->to(previous_url());
    }

    public function status($id){
        $model = new FinancialYear();
        $user_data = $model->where(['id' => $id])->get()->getRow();
        if ($user_data->status) {
            $model->set(['status' => 0])->where(['id' => $id])->update();
        } else {
            $model->set(['status' => 1])->where(['id' => $id])->update();
        }

        session()->setFlashdata('success', 'Status Changed Successfully.');
        return redirect()->to(base_url('admin/FinancialYears'));
    }

    public function Edit($id){
        $model = new FinancialYear();
        $data['title'] = 'Add Financial Years';
        $data['year'] = $model->where(['id' => $id])->get()->getRow();
        return view('Masters/Financial-year/Edit', $data);
    }

    public function Update($id){
        $this->validation->setRules(
            [
                'year' => 'required|min_length[6]|max_length[7]', //min_length[5]|max_length[50]
                'start_date'    => 'required',
                'end_date'    => 'required', 
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new FinancialYear();
            $data = [
                'year' => $validatedData['year'],
                'starting_year' => $validatedData['start_date'],
                'ending_year' => $validatedData['end_date'],  
                'updated_at' => current_time(),  
            ];
            $model->where('id',$id)->set($data)->update();
            session()->setFlashdata('success', 'Financial Year Updated Successfully.');
            return redirect()->to(base_url('admin/FinancialYears')); 
        }
    }

    public function Delete($id){
        $model = new FinancialYear(); 
        $model->where('id',$id)->set('delete_status',1)->update();    
        session()->setFlashdata('success', 'Financial Year Deleted Successfully.');
        return redirect()->to(previous_url());
    }
}
