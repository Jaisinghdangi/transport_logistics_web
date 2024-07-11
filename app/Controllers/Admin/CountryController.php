<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Country;

class CountryController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->country = new Country();
    }

    public function index()
    {
        $data['title'] = 'Countries';
        $data['countries'] = $this->country->where('is_delete',1)->get()->getResult(); 
        return view('Masters/Country/Index', $data);
    }
    
    public function add()
    {
        $data['title'] = 'New Countries';
        $data['countries'] = $this->country->get()->getResult(); 
        return view('Masters/Country/Create', $data);
    }
    
    public function store()
    {
        $validatedData = $this->request->getPost(); 
        $validationRule = [
            'shortname' => 'required',
            'name'    => 'required',
            'phonecode'    => 'required',  
        ] ; 
        $this->validation->setRules($validationRule);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Country();
            $data = [
                'shortname' => $validatedData['shortname'],
                'name'    => $validatedData['name'],
                'phonecode'    => $validatedData['phonecode'], 
            ];  
            $ins_id = $model->insert($data);
            if($ins_id){ 
                session()->setFlashdata('success', 'Country Add Successfully.');
                return redirect()->to(base_url('admin/countries')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(base_url('admin/add-countries')); 
            }
        }
    }

    public function status($id){
        $country = $this->country->where('id',$id)->get()->getRow();
        $update = [];
        if($country->status){
            $update['status'] = 0;
        }else{
            $update['status'] = 1;
        }
        $this->country->where('id',$id)->set($update)->update();
        session()->setFlashdata('success', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }

    public function edit($id){
        $data['country'] = $this->country->where('id',$id)->get()->getRow();
        $data['title'] = 'Update Country';
        return view('Masters/Country/Edit',$data);
    }

    public function update($id)
    {
        $validatedData = $this->request->getPost(); 
        $validationRule = [
            'shortname' => 'required',
            'name'    => 'required',
            'phonecode'    => 'required',  
        ] ; 
        $this->validation->setRules($validationRule);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Country();
            $data = [
                'shortname' => $validatedData['shortname'],
                'name'    => $validatedData['name'],
                'phonecode'    => $validatedData['phonecode'], 
            ];
            $ins_id = $model->where('id',$id)->set($data)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Country Updated Successfully.');
                return redirect()->to(base_url('admin/countries')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function delete($id){
        $country = $this->country->where('id',$id)->get()->getRow();
        $update['is_delete'] = 0; 
        $this->country->where('id',$id)->set($update)->update();
        session()->setFlashdata('success', 'Country Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
