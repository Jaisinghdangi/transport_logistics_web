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



class termsCondition  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = 'Consignors';
        $model = new termcondition();
        $data['terms'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();
        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        return view('Company/termsCondition/index', $data);
    }
    public function show_term($id = null) 
    {
        if (isset($id) && !empty($id)) {
            $model = new termcondition();
            $data['terms'] = $model->where('id', $id)->where('comp_id',session()->get('CompId'))->get()->getRow();
                return view('Company/termsCondition/show_term', $data);

            
        }
    }
    
    public function add(){ 
        $data['title'] = 'Add Consignor';
        $model = new termcondition();
        $data['terms'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();
        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        return view('Company/termsCondition/create', $data);
    }

  public function store() {
    $model = new termcondition();
    $validatedData = $this->request->getPost();   
    $editorContent = $this->request->getPost('editor_content'); // Assuming 'editor_content' is the name of the textarea element
    $data = [
        'description' => $editorContent,
        'voucher_id' => $validatedData['series_types'],
        'created' => current_time(),
        'comp_id' => session()->get('CompId'),
        'created_by' => session()->get('UserName'),
        'status' => '1',
        'is_delete'=>'1'
    ];   
    $ins_id = $model->insert($data);
    if ($ins_id) { 
        session()->setFlashdata('success', 'Terms Condition Created Successfully.');
        return redirect()->to(base_url('company/terms-condition')); 
    } else {
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }   
}



    public function edit($id){  
        // var_dump($data);die;
        $data['title'] = 'Edit Consigner';
        $model = new termcondition();
        $data['terms'] = $model->where('id', $id)->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getRow();
        $data['termVoucher'] = $model->where('id !=', $id)->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();

        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        // echo '<pre>';  
        // print_r($data['consign']); die;
        return view('Company/termsCondition/edit', $data);
    }
    
    public function update($id){
        $validatedData = $this->request->getPost();  
        $model = new termcondition();
        $editorContent = $this->request->getPost('editor_content'); 
            $data = [
                'description' => $editorContent,
                'voucher_id' => $validatedData['series_types'],
                'updated' => current_time(), 

            ];   
          
            $ins_id = $model->set($data)->where('id',$id)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Terms Condition Updated Successfully.');
                return redirect()->to(base_url('company/terms-condition')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        
    }

    public function status($id) {
        $consign = new termcondition();
          
        // Retrieve the record to toggle its status
        $comp = $consign->where('id', $id)->get()->getRow(); 
    
        // Get the current status
        $currentStatus = $comp->status;
        // Update all records to set 'status' to 0
        $consign->set(['status' => 0])->where('id', $id)->update();
        // Set the status of the current record
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
