<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SeriesType;
use App\Models\Series;
use App\Models\FinancialYear;

class SeriesController extends BaseController
{
    
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Series();
        $data['series'] = $model->where('financial_year', session()->get('FinancialYear'))->where('is_delete',1)->get()->getResult();
        $data['title'] = 'All Series';
        return view('Company/Series/index', $data);
    }

    public function add(){
        $series_model = new SeriesType();
        $financial_model = new FinancialYear();
        $data['financial_years'] = $financial_model->where('delete_status', 0)->get()->getResult();
        $data['series'] = $series_model->where('is_delete',1)->get()->getResult();
        $data['title'] = 'Create Series'; 
        return view('Company/Series/create', $data);
    }

    public function store(){
        $validatedData = $this->request->getPost();     
        $rules = [
            'series_type' => 'required', 
            'start_point'    => 'required',
            'start_point_pos'    => 'required',
            'prefix'    => 'required',
            'prefix_pos'    => 'required', 
        ]; 
        $this->validation->setRules($rules);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Series();
            $data = [
                'series_type' => $validatedData['series_type'], 
                'financial_year'    => $validatedData['financial_year'] ?? '',
                'financial_year_pos'  => $validatedData['financial_year_pos'] ?? '',
                'start_point'    => $validatedData['start_point'],
                'start_point_pos'    => $validatedData['start_point_pos'], 
                'prefix'    => $validatedData['prefix'], 
                'prefix_pos'    => $validatedData['prefix_pos'],  
                'symbl'    => $validatedData['symbl'],  
            ];
            $ins_id = $model->insert($data);
            if($ins_id){ 
                session()->setFlashdata('success', 'Series Created Successfully.');
                return redirect()->to(base_url('company/series')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function status($id){
        $consign  = new Series();
        $comp = $consign->where('id', $id)->get()->getRow(); 
        $update = [];
        if($comp->status){
            $update['status'] = 0; 
        }else{
            $update['status'] = 1; 
        }
        $consign->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('error', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }
    
    public function edit($id){
        $series = new Series();
        $series_type = new SeriesType();
        $f_year = new FinancialYear();
        $data['financial_years'] = $f_year->where('delete_status',0)->get()->getResult();
        $data['series_types'] = $series_type->where('is_delete',1)->get()->getResult();
        $data['series'] = $series->where('financial_year', session()->get('FinancialYear'))->where('id',$id)->get()->getRow(); 
        $data['title'] = 'All Series'; 
        return view('Company/Series/edit', $data); 
    }

    public function update($id){
        $validatedData = $this->request->getPost();     
        $rules = [
            'series_type' => 'required', 
            'start_point'    => 'required',
            'start_point_pos'    => 'required',
            'prefix'    => 'required',
            'prefix_pos'    => 'required', 
        ]; 
        $this->validation->setRules($rules);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Series();
            $data = [
                'series_type' => $validatedData['series_type'], 
                'financial_year'    => $validatedData['financial_year'] ?? '',
                'financial_year_pos'  => $validatedData['financial_year_pos'] ?? '',
                'start_point'    => $validatedData['start_point'],
                'start_point_pos'    => $validatedData['start_point_pos'], 
                'prefix'    => $validatedData['prefix'], 
                'prefix_pos'    => $validatedData['prefix_pos'],  
                'symbl'    => $validatedData['symbl'],  
            ];
            // print_r($data);die;
            $ins_id = $model->where('id',$id)->set($data)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Series Updated Successfully.');
                return redirect()->to(base_url('company/series')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function delete($id){
        $series  = new Series();
        $series->where('id', $id)->set(['is_delete'=> 0])->update();
        session()->setFlashdata('success', 'Series Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }

}
