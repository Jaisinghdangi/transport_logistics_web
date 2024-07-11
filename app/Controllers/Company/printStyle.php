<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\termsCondition as termcondition;
use App\Models\SeriesType;
use App\Models\print_style;



class printStyle  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = 'print style';
        $model = new print_style();
        $data['printstyle'] = $model->where('comp_id',session()->get('CompId'))->get()->getResult();
        return view('Company/printStyle/index', $data);
    }
  
    public function add(){ 
        $data['title'] = 'Add print style';
        $model = new print_style();
        $data['printstyle'] = $model->where('comp_id',session()->get('CompId'))->get()->getResult();
        return view('Company/printStyle/create', $data);
    }

  public function store() {
    $model = new print_style();
    $validatedData = $this->request->getPost();   
    $data = [
        'print_type' => $validatedData['print_type'],
        'bg_color' => $validatedData['bg_color'],
        'text_color' => $validatedData['text_color'],
        'text_font' => $validatedData['text_font'],
        'comp_id'    => $validatedData['comp_id'],
        'status' => '1',
    ];   
    $ins_id = $model->insert($data);
    if ($ins_id) { 
        session()->setFlashdata('success', 'print style Created Successfully.');
        return redirect()->to(base_url('company/print-style-master')); 
    } else {
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }   
}



    public function edit($id){  
        $data['title'] = 'Edit print style';
        $model = new print_style();
        $data['printstyle'] = $model->where('id', $id)->where('comp_id',session()->get('CompId'))->get()->getRow();
        $data['printstyle1'] = $model->where('id !=', $id)->where('comp_id',session()->get('CompId'))->get()->getResult();

        return view('Company/printStyle/edit', $data);
    }
    
    public function update($id){
        $validatedData = $this->request->getPost();  
        $model = new print_style();
            $data = [
                'print_type' => $validatedData['print_type'],
                'bg_color' => $validatedData['bg_color'],
                'text_color' => $validatedData['text_color'],
                'text_font' => $validatedData['text_font'],

            ];   
            $ins_id = $model->set($data)->where('id',$id)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'print style Updated Successfully.');
                return redirect()->to(base_url('company/print-style-master')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        
    }

    public function status($id) {
        $consign = new print_style();
    $comp = $consign->where('id', $id)->get()->getRow(); 
        $currentStatus = $comp->status;
        $consign->set(['status' => 0])->where('id', $id)->update();
        $update['status'] = ($currentStatus == 0) ? 1 : 0;
        $consign->where('id', $id)
                ->set($update)
                ->update();   
        session()->setFlashdata('success', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }
    

    public function delete($id){
        $consign = new termcondition();
        $consign_info = $consign->where('id', $id)->set('is_delete', 0)->update();
        session()->setFlashdata('success', 'Terms Condition  Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
