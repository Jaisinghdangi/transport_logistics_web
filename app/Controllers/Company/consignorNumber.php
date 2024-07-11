<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Country;
use App\Models\BusinessType;
use App\Models\Consignor as Consign;
use App\Models\consignorNumber as consignorNum;

class consignorNumber  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Consign();
        $data['title'] = 'Consignors';
        // $data['consigns'] = $model->where('is_delete',1)->get()->getResult();
        $model = new consignorNum();
        $data['consignsNumbers'] = $model->where('is_delete',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getResult();


        return view('Company/consignorNumber/index', $data);
    }
    
    public function add(){ 
        $model = new consignorNum();

        $busi_model = new BusinessType();
        $data['title'] = 'Add Consignor';
        $data['countries'] = get_countries();  
        $data['ConsignNumberValue'] =  $model->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->orderBy('id', 'DESC')->get()
->getRow();
        $data['business_types'] = $busi_model->get()->getResult();
        return view('Company/consignorNumber/create', $data);
    }

  public function store() {
    $validatedData = $this->request->getPost();   
    $model = new consignorNum();
    
    // Update existing records to set 'status' to '0'
    $upData = [ 'status' => '0'];  

    $model->set($upData)->where('comp_id', $validatedData['comp_id'])
          ->where('user_id', $validatedData['user_id'])
          ->update();
//  $model->set($upData)->where('id',$id)->update();

    // Insert the new record
    $data = [
        'start_number' => $validatedData['start_number'],
        'end_number' => $validatedData['end_number'],
        'comp_id'    => $validatedData['comp_id'],
        'user_id' => $validatedData['user_id'],
        'created' => current_time(),
        'created_by' => session()->get('UserName'),
        'is_delete' => '1',
        'status' => '1',
    ];   
    $ins_id = $model->insert($data);
    
    if ($ins_id) { 
        session()->setFlashdata('success', 'Consignor Created Successfully.');
        return redirect()->to(base_url('company/company-consignor-number')); 
    } else {
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }   
}

public function status($id) {
    $consign = new consignorNum();
      
    // Retrieve the record to toggle its status
    $comp = $consign->where('id', $id)
                    ->where('is_delete', 1)
                    ->get()
                    ->getRow(); 

    // Get the current status
    $currentStatus = $comp->status;
    // Update all records to set 'status' to 0
    $consign->set(['status' => 0])->where('is_delete', 1)->update();
    // Set the status of the current record
    $update['status'] = ($currentStatus == 0) ? 1 : 0;
    $consign->where('id', $id)
            ->set($update)
            ->update(); 
$anyEnabled = $consign->where('status', 1)->where('is_delete', 1)->countAllResults();
if($anyEnabled=='0'){
$query = $consign->orderBy('id', 'DESC')->limit(1)->get();
$row = $query->getRow();
$update['status'] = 1;
$consign->where('id', $row->id)->set($update)->update(); 
session()->setFlashdata('Status_success', ' And Any one Status Always Active.');

}
    session()->setFlashdata('success', 'Status Changed Successfully.');
    return redirect()->to(previous_url()); 
}


    public function edit($id){  
        $consign  = new consignorNum();
       // $data['ConsignNumberValue'] =  $consign->where('id', $id-1)->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();

       $data['ConsignNumberValue'] = $consign->where('id <', $id)->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->orderBy('id', 'DESC')->get()->getRow();
       
        $data['ConsignNumberValExtra'] =  $consign->where('id >', $id)->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        // var_dump($data);die;
        $data['title'] = 'Edit Consigner';
        $data['consign'] = $consign->where('id', $id)->get()->getRow(); 
        // echo '<pre>';  
        // print_r($data['consign']); die;
        return view('Company/consignorNumber/edit', $data);
    }
    
    public function update($id){
        $validatedData = $this->request->getPost();  
            $model = new consignorNum();
            $data = [
                'start_number' => $validatedData['start_number'],
                'end_number' => $validatedData['end_number'],
                'comp_id'    => $validatedData['comp_id'],
                'user_id' => $validatedData['user_id'],
                'updated' => current_time(), 

            ];   
          
            $ins_id = $model->set($data)->where('id',$id)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Consignor Updated Successfully.');
                return redirect()->to(base_url('company/company-consignor-number')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        
    }

    public function delete($id){
        $consign  = new consignorNum();
        $consign_info = $consign->where('id', $id)->set('is_delete', 0)->update();
        session()->setFlashdata('success', 'Consignor Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
