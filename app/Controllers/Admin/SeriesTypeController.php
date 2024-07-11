<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SeriesType;

class SeriesTypeController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new SeriesType();
        $data['series_types'] = $model->where('is_delete', 1)->get()->getResult();
        $data['title'] = 'All Series Type';
        return view('Masters/Series_type/Index', $data);
    }

    public function add(){
        $data['title'] = 'New Series Type';
        return view('Masters/Series_type/Create', $data);
    }

    public function store(){
        $this->validation->setRules(
            [
                'name' => 'required',   
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new SeriesType();
            $data = [
                'name' => $validatedData['name'],  
                'created' => current_time()
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'Series Type Created Successfully.');
            return redirect()->to(base_url('admin/series-type')); 
        }
    }
  
    public function update($id){
        $this->validation->setRules(
            [
                'name' => 'required',   
            ]
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $validatedData = $this->request->getPost();
            $model = new SeriesType();
            $data = [
                'name' => $validatedData['name'],  
                'updated' => current_time()
            ];
            $model->where('id',$id)->set($data)->update();
            session()->setFlashdata('success', 'Series Type Updated Successfully.');
            return redirect()->to(base_url('admin/series-type')); 
        }
    }

    public function edit($id){
        $model = new SeriesType();
        $data['series_type'] = $model->where('id', $id)->get()->getRow();
        $data['title'] = 'Update Series Type';
        return view('Masters/Series_type/Edit', $data);
    }

    public function delete($id){
        $model = new SeriesType();
        $find = $model->where('id', $id)->get()->getRow();
        $update['is_delete'] = 0;
        $model->where('id', $id)->set($update)->update();
        session()->setFlashdata('success', 'Series Type Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
