<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\State;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\Consignor as Consign;
use App\Models\pincodes as pincode;


class AjaxController extends BaseController
{ 
    public function save_pincode()
    {  $validatedData = $this->request->getPost();  
          $pincode = new pincode();
              $data = [
                'StateName' => $validatedData['pinstate_id'],
                'District' => $validatedData['pindistrict'],
                'Pincode'  => $validatedData['Pincode'],
                'DivisionName'    => $validatedData['city'] ,
                'OfficeName' => $validatedData['postofc'],
                  ]; 
// echo $validatedData['pinstate_id']; die;
            $ins_id = $pincode->insert($data);
             $lastInsertedId = $pincode->insertID();
                    $data= $pincode->where(['id'=>$lastInsertedId])->orderBy('id', 'DESC')->get()->getRow();
                    $data1 = [
                        'StateName' =>$data->StateName,
                        'District' => $data->District,
                        'Pincode' => $data->Pincode,
                        'DivisionName' =>$data->DivisionName,
                         'OfficeName' => $data->OfficeName, ];
                  echo json_encode(array("result"=>$data1));               
                //   return $data1;    
         }

    public function get_states()
    {
        $country_id = $this->request->getPost('country_id');
        $state_model = new State();
        $where = ['status'=>1, 'is_delete'=>1, 'country_id'=>$country_id];
        $all_states = $state_model->where($where)->orderBy('name')->get()->getResult();
        $html = '<option value="" >Select State</option>';
        if(count($all_states) > 0){
            foreach ($all_states as $key => $value) {
                $html .= '<option value="'.$value->id.'">'.$value->name.'</option>'; 
            }
        }else{
            $html = '<option>State Not Found</option>';
        }
        return $html;
    }
    public function get_cities()
    {
        $District = $this->request->getPost('District');
        $pincode = new pincode();
        $pin_cities = $pincode->groupBy('DivisionName')->where(['District'=>$District])->get()->getResult();
        $html = '<option value="" >Select Cities</option>';
        if(count($pin_cities) > 0){
            foreach ($pin_cities as $key => $value) {
                $html .= '<option value="'.$value->DivisionName.'">'.$value->DivisionName.'</option>'; 
            }
        }else{
            $html = '<option>City Not Found</option>';
        }
        return $html;
    }
    
    public function get_pinstates()
    {
        $country_id = $this->request->getPost('country_id');
        $pincode = new pincode();
        $all_states = $pincode->groupBy('StateName')->get()->getResult();
        $html = '<option value="" >Select State</option>';
        if(count($all_states) > 0){
            foreach ($all_states as $key => $value) {
                $html .= '<option value="'.$value->StateName.'">'.$value->StateName.'</option>'; 
            }
        }else{
            $html = '<option>State Not Found</option>';
        }
        return $html;
    }
    public function get_consinor_states()
    {
        $db = \Config\Database::connect();

        $consignor = $this->request->getPost('consignor');
       $quatationId= $this->request->getPost('quatationId');
        $model = new Consign();
        $result = $model->where(['id'=>$consignor])->get()->getRow();
        $country_id =$result->country;
        $state_id =$result->state;
          if(isset($quatationId)){
            $result = $db->table('quotation')->where('id',$quatationId)->get()->getRow();
            $country_id =$result->country;
            $state_id =$result->state_id;
          }

        $state_model = new State();
        $where = ['status'=>1, 'is_delete'=>1,'country_id'=>$country_id];
        $all_states = $state_model->where($where)->orderBy('name')->get()->getResult();
        $html = '<option value="" >Select State</option>';
        if(count($all_states) > 0){
            foreach ($all_states as $key => $value) {
                $selected = ($value->id == $state_id) ? 'selected' : ''; 
    $html .= '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>'; 
            }
        }else{
            $html = '<option>State Not Found</option>'.$country_id.','.$state_id;
        }
        return $html;
    }

    public function get_consinor_disctrict()
    {
        $db = \Config\Database::connect();
        $quatationId= $this->request->getPost('quatationId');

        $consignor = $this->request->getPost('consignor');
        $model = new Consign();
        $result = $model->where(['id'=>$consignor])->get()->getRow();
        $country_id =$result->country;
        $state_id =$result->state;
        $disctrict_id =$result->district;
        if(isset($quatationId)){
            $result = $db->table('quotation')->where('id',$quatationId)->get()->getRow();
            $country_id =$result->country;
            $state_id =$result->state_id;
            $disctrict_id =$result->district;

          }
        $dis = new City();
        $where = ['status'=>1, 'is_delete'=>1, 'state_id'=>$state_id];
        if(!empty($state_id) && $state_id > 0){
            $districts = $dis->where($where)->orderBy('name')->get()->getResult();
            $html = '<option value="" >Select Districts</option>';
            if(count($districts) > 0){
                foreach ($districts as $key => $value) {
                    $selected = ($value->id == $disctrict_id) ? 'selected' : ''; 

                    $html .= '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>'; 
                }
            }else{
                $html = '<option>Districts Not Found</option>';
            }
        }else{
            $html = '<option>Districts Not Found</option>';
        }
        return $html;
    }

    public function get_districts()
    {
        $state_id = $this->request->getPost('state_id');
        $state_name = $this->request->getPost('state_name');
     $dis = new City();
        $where = ['status'=>1, 'is_delete'=>1, 'state_id'=>$state_id];
        if(!empty($state_id) && $state_id > 0){
            $districts = $dis->where($where)->orderBy('name')->get()->getResult();
            $html = '<option value="" >Select Districts</option>';
            if(count($districts) > 0){
                foreach ($districts as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>'; 
                }
            }else{
                $html = '<option>Districts Not Found</option>';
            }
        }else{
            $html = '<option>Districts Not Found</option>';
        }

if($state_name){
    $pincode = new pincode();
    if(!empty($state_name)){
        $districts = $pincode->groupBy('District')->where(['StateName'=>$state_name])->get()->getResult();
        $html = '<option value="" >Select Districts</option>';
        if(count($districts) > 0){
            foreach ($districts as $key => $value) {
                $html .= '<option value="'.$value->District.'">'.$value->District.'</option>'; 
            }
        }else{
            $html = '<option>Districts Not Found</option>';
        }
    }else{
        $html = '<option>Districts Not Found</option>';
    }
}

        return $html;
    }
    public function getAddressByPincode(){
        $db = \Config\Database::connect();
        $pincode=$this->request->getPost('pincode');
        $pincodes = $db->table('pincodes')->where(['pincode'=>$pincode])->orderBy('Pincode')->get()->getResult();
        $status=1;
        if(count($pincodes)==0){
         $status=0;
        }
        return json_encode(['status'=>$status,'result'=>$pincodes]);  
    } 
    public function getAddressByPincodePost(){
        $db = \Config\Database::connect();
        $postoffice_id=$this->request->getPost('postoffice_id');
        $pincodes = $db->table('pincodes')->where(['Id'=>$postoffice_id])->orderBy('Pincode')->get()->getResult();
        $status=1;
        if(count($pincodes)==0){
         $status=0;
        }
        return json_encode(['status'=>$status,'result'=>$pincodes]); 
    }
    public function get_vehicle()
    {
        $id = $this->request->getPost('id');
        $obj = new Vehicle();
        $where = ['status'=>1,'broker_id'=>$id];
        if(!empty($id) && $id > 0){
            $districts = $obj->where($where)->orderBy('vehicle_number')->get()->getResult();
            $html = '<option value="" >Select Vehicle</option>';
            if(count($districts) > 0){
                foreach ($districts as $key => $value) {
                    $html .= '<option value="'.$value->id.'">Vehicle No. '.$value->vehicle_number.'</option>'; 
                }
            }else{
                $html = '<option>Vehicle Not Found</option>';
            }
        }else{
            $html = '<option>Vehicle Not Found</option>';
        }
        return $html;
    }
}
