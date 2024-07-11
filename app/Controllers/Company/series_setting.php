<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Country;
use App\Models\BusinessType;
use App\Models\Consignor as Consign;
use App\Models\consignorNumber as consignorNum;
use App\Models\termsCondition as termcondition;
use App\Models\SeriesType;
use App\Models\Series;




class series_setting  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = 'series setting';
        $model = new Series();
        $data['seriesSetting'] = $model->where('comp_id',session()->get('CompId'))->get()->getResult();
        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        return view('Company/series_setting/index', $data);
    }
   
    
    public function add(){ 
        $data['title'] = 'Add series setting';
        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        return view('Company/series_setting/create', $data);
    }

  public function store() {
    $model = new Series();
    $validatedData = $this->request->getPost();   
    $data = [
        'series_type' => $validatedData['series_type'],
        'prefix' => $validatedData['prefix'],
        'start_point' => $validatedData['start_point'],
        'symbl' => $validatedData['symbl'],
        'financial_year' => session()->get('FinancialYear'),
        'status' => '1',
        'created' => current_time(),
        'comp_id' => session()->get('CompId'),
        'created_by' => session()->get('UserName'),
    ];   
    $ins_id = $model->insert($data);
    if ($ins_id) { 
        session()->setFlashdata('success', 'Series Setting  Created Successfully.');
        return redirect()->to(base_url('company/series_setting')); 
    } else {
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }   
}



    public function edit($id){  
        // var_dump($data);die;
        $data['title'] = 'Edit series setting';
        $model = new Series();
        $data['seriesSetting'] = $model->where('id', $id)->where('comp_id',session()->get('CompId'))->get()->getRow();
        // $data['termVoucher'] = $model->where('id !=', $id)->where('comp_id',session()->get('CompId'))->get()->getResult();

        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        // echo '<pre>';  
        // print_r($data['consign']); die;
        return view('Company/series_setting/edit', $data);
    }
    
    public function update($id){
        $validatedData = $this->request->getPost();  
        $model = new Series();
        $data = [
            'series_type' => $validatedData['series_type'],
            'prefix' => $validatedData['prefix'],
            'start_point' => $validatedData['start_point'],
            'symbl' => $validatedData['symbl'],
            'financial_year' => session()->get('FinancialYear'),
            'updated' => current_time(), 

            ];   
          
            $ins_id = $model->set($data)->where('id',$id)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Series Setting Updated Successfully.');
                return redirect()->to(base_url('company/series_setting')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        
    }

}
