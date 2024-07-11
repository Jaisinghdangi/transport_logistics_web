<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\State;
use App\Models\City;
use App\Models\Country;

class DistrictController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->city = new City();
        $this->state = new State();
        $this->country = new Country();
    }

    public function index()
    { 
        $data['title'] = 'Districts';
        $validatedData = $this->request->getGet();
        $where_ = [];
        if(isset($validatedData['country_id']) && !empty($validatedData['country_id'])){
            $where_['cities.country_id'] = $validatedData['country_id'];
        }else{
            $where_['cities.country_id'] = 101;
        }

        if(isset($validatedData['state_id']) && !empty($validatedData['state_id'])){
            $where_['cities.state_id'] = $validatedData['state_id'];
        }
        $data['districts'] = $this->city->join('states', 'states.id  = cities.state_id', 'left')
            ->join('countries', 'countries.id  = cities.country_id', 'left')
            ->where($where_)
            ->where('cities.is_delete',1)
            ->select('cities.* , states.name  as state_name, countries.name as country_name')
            ->orderBy('cities.id', 'DESC')->get()->getResult();  
        $data['countries'] = $this->country->where('is_delete',1)->where('status',1)->orderBy('name', 'ASC')->get()->getResult();
        return view('Masters/Districts/Index', $data);
    }
    
    public function add(){ 
        $data['countries'] = $this->country->where('is_delete',1)->where('status',1)->orderBy('name', 'ASC')->get()->getResult();
        $data['title'] = 'Add District';  
        return view('Masters/Districts/Create', $data);
    }

    public function store(){
        $this->validation->setRules(
            [
                'country_id' => 'required', 
                'state_id' => 'required',  
                'name' => 'required',  
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new City();
            $data = [
                'country_id' => $validatedData['country_id'], 
                'state_id' => $validatedData['state_id'],  
                'name' => $validatedData['name'],   
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'District Added Successfully.');
            return redirect()->to(base_url('admin/district')); 
        }
    }

    public function status($id){
        $model = new City();
        $user_data = $model->where(['id' => $id])->get()->getRow();
        if ($user_data->status) {
            $update['status'] = 0; 
        } else {
            $update['status'] = 1;
        }
        $model->set($update)->where(['id' => $id])->update();
        session()->setFlashdata('success', 'Status Changed Successfully.'); 
        return redirect()->to(base_url('admin/district'));
    }

    public function edit($id){
        $country = new Country();
        $dis = new City();
        $data['title'] = 'Update District';
        $data['countries'] = $country->orderBy('name', 'ASC')->where('status', 1)->where('is_delete',1)->get()->getResult(); 
        $data['district'] = $dis->where(['id' => $id])->get()->getRow();
        return view('Masters/Districts/Edit', $data);
    }

    public function update($id){ 
        $this->validation->setRules(
            [
                'country_id' => 'required', 
                'state_id' => 'required',  
                'name' => 'required',  
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new City();
            $data = [
                'country_id' => $validatedData['country_id'], 
                'state_id' => $validatedData['state_id'],  
                'name' => $validatedData['name'],   
            ];
            $model->set($data)->where('id',$id)->update();
            session()->setFlashdata('success', 'District Updated Successfully.');
            return redirect()->to(base_url('admin/district'));
        }
    }

    public function delete($id){
        $model = new City(); 
        $update['is_delete'] = 0;
        $model->where('id',$id)->set($update)->update();    
        session()->setFlashdata('success', 'District Deleted Successfully.');
        return redirect()->to(previous_url());
    }
}