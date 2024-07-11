<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Product;
use App\Models\Tax;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    { 
        $product_model = new Product();  
        $data['products'] = $product_model->where('is_delete', 1)->orderBy('id', 'DESC')->get()->getResult();  
        $data['title'] = 'All Products';   
        // print_r($data['products']); die;
        return view('Company/product/index', $data);
    }

    public function add(){
        $model = new Tax(); 
        $data['taxes'] = $model->orderBy('id', 'DESC')->get()->getResult(); 
        $data['title'] = 'Add Product';
        return view('Company/product/create', $data);
    }

    public function store(){
        $validatedData = $this->request->getPost();    
        $rules = [
            'name' => 'required',
            'description'    => 'required',
            'mrp'    => 'required',
            'price'    => 'required',
            'tax'    => 'required',
        ]; 
        $this->validation->setRules($rules);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Product();
            $data = [
                'name' => $validatedData['name'], 
                'description'    => $validatedData['description'],
                'mrp'  => $validatedData['mrp'] ?? '',
                'price'    => $validatedData['price'] ?? '',
                'discount'    => $validatedData['discount'] ?? '', 
                'tax'    => $validatedData['tax'], 
                'created' => current_time(),
                'comp_id' => session()->get('CompId'),
                'user_id' => session()->get('UserId'),
                'created_by' => session()->get('UserName'),
            ]; 
            $ins_id = $model->insert($data);
            if($ins_id){ 
                session()->setFlashdata('success', 'Product Created Successfully.');
                return redirect()->to(base_url('company/products')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function status($id){
        $product_model  = new Product();
        $comp = $product_model->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $update = [];
        if($comp->status){
            $update['status'] = 0; 
        }else{
            $update['status'] = 1; 
        }
        $product_model->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('error', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }

    public function edit($id){
        $warehouse  = new Product();
        $data['product'] = $warehouse->where('id', $id)->where('is_delete', 1)->get()->getRow(); 

        $model = new Tax(); 
        $data['taxes'] = $model->orderBy('id', 'DESC')->get()->getResult(); 
        $data['title'] = 'Update Product';   
        return view('Company/product/edit', $data);
    }

    public function update($id){ 
        $validatedData = $this->request->getPost();    
        $rules = [
            'name' => 'required',
            'description'    => 'required',
            'mrp'    => 'required',
            'price'    => 'required',
            'tax'    => 'required',
        ]; 
        $this->validation->setRules($rules);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Product();
            $data = [
                'name' => $validatedData['name'], 
                'description'    => $validatedData['description'],
                'mrp'  => $validatedData['mrp'] ?? '',
                'price'    => $validatedData['price'] ?? '',
                'discount'    => $validatedData['discount'] ?? '', 
                'tax'    => $validatedData['tax'], 
                'updated' => current_time(),  
            ];
            $ins_id = $model->where('id',$id)->set($data)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Product Created Successfully.');
                return redirect()->to(base_url('company/products')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function delete($id){
        $warehouse  = new Product();
        $comp = $warehouse->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $update = [];
        $update['status'] = 0;  
        $warehouse->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('success', 'Warehouse Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
