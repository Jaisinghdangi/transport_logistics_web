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
use App\Models\code_prefix as codeprefix;



class code_prefix  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = 'code prefix';
        $model = new codeprefix() ;
        $data['code_prepix'] = $model->where('comp_id',session()->get('CompId'))->get()->getResult();
        $model = new codeprefix();

        $data['code_prepix_count'] = $model->where('comp_id', session()->get('CompId'))
                                            ->groupBy('series_type') // Corrected method name
                                            ->get()
                                            ->getResult();
        return view('Company/code_prefix/index', $data);
    }
  
    public function add(){ 
        $data['title'] = 'Add code prefix';
        $model = new codeprefix() ;
        $data['code_prepix'] = $model->where('comp_id',session()->get('CompId'))->get()->getResult();
        return view('Company/code_prefix/create', $data);
    }

  public function store() {

    $model = new codeprefix() ;
    $validatedData = $this->request->getPost();   
    $data = [
        'series_type' => $validatedData['series_type'],
        'first_prefix' => $validatedData['first_prefix'],
        'second_prefix' => $validatedData['second_prefix'],
        'created' => current_time(),
        'comp_id' => session()->get('CompId'),
        'created_by' => session()->get('UserName'),
    ];   
    $ins_id = $model->insert($data);
    if ($ins_id) { 
        session()->setFlashdata('success', 'Code Prefix Created Successfully.');
        return redirect()->to(base_url('company/code_prefix_master')); 
    } else {
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }   
}


 
}
