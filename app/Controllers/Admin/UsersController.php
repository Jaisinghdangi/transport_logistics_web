<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Role;
use App\Models\Users;

class UsersController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Users();
        $data['title'] = 'All Users';
        $data['users'] = $model->where('delete_status',0)->where('id !=',1)->get()->getResult();  
        return view('Logistics/Users/index', $data);
    }

    public function create(){
        $model = new Users();
        $role = new Role();
        $data = ['title' => 'Add Users'];
        $data['roles'] = $role->where('id !=',1)->get()->getResult();
        $data['users'] = $model->where('delete_status',0)->get()->getResult(); 
        return view('Logistics/Users/create', $data);
    }

    public function store(){
        $validation = [
            'name' => 'required', 
            'role' => 'required', 
            'email'    => 'required|valid_email|is_unique[users.email]',
            'mobile'    => 'required|min_length[10]|is_unique[users.mobile]',
            'password'    => 'required|min_length[8]', 
            'confirm_password' => 'required|matches[password]',
        ]; 
        $validatedData = $this->request->getPost(); 
        $this->validation->setRules($validation); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {   
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{  
            $model = new Users();
            $data = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
                'mobile' => $validatedData['mobile'],
                'pwd' => $validatedData['password'],
                'password' => md5($validatedData['password']),
                // 'date' => date('Y-m-d'),
                'created' => current_time(),
            ]; 
            if($_FILES['profile']['error'] == 0){ 
                $file = $this->request->getFile('profile'); 
                $newName = $file->getRandomName();
                $file->move('uploads/profiles/', $newName); 
                $data['profile'] = 'uploads/profiles/'.$newName;
            } 
            $model->insert($data);
            session()->setFlashdata('success', 'User Added Successfully.');
            return redirect()->to(base_url('admin/users')); 
        }
    }

    public function edit($id){
        $model = new Users();
        $role = new Role();
        $data = ['title' => 'Edit Users'];
        $data['roles'] = $role->get()->getResult(); 
        $data['user'] = $model->where('id',$id)->get()->getRow();
        return view('Logistics/Users/edit', $data);
    }  

    public function update($id)
    {
        $validation = [
            'name' => 'required',  
            'email' => 'required|is_unique[users.email, users.id, ' . $id . ']',
            'mobile' => 'required|min_length[10]', 
        ]; 
        $validatedData = $this->request->getPost(); 
        $this->validation->setRules($validation); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {    
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{  
            $model = new Users();
            $data = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'mobile' => $validatedData['mobile'], 
                'updated' => current_time(),
            ]; 
            if($_FILES['profile']['error'] == 0){ 
                $file = $this->request->getFile('profile'); 
                $newName = $file->getRandomName();
                $file->move('uploads/profiles/', $newName); 
                $data['profile'] = 'uploads/profiles/'.$newName;
            }  
            $model->set($data)->where('id',$id)->update();
            session()->setFlashdata('success', 'User Update Successfully.');
            return redirect()->to(base_url('admin/users')); 
        }
    }

    public function delete($id){
        $model = new Users(); 
        $model->where('id',$id)->set(['delete_status'=>1])->update();    
        session()->setFlashdata('success', 'User Delete Successfully.');
        return redirect()->to(base_url('admin/users'));
    }
    
    
    public function change_status($user_id){
        $model = new Users(); 
        $user_data = $model->where(['delete_status'=>0,'id'=>$user_id])->get()->getRow(); 
        if($user_data->status){
            $status = $model->set('status',0)->where(['id'=>$user_id])->update(); 
        }else{
            $status = $model->set('status',1)->where(['id'=>$user_id])->update();
        }
        session()->setFlashdata('success', 'User Status Changed Successfully.');
        return redirect()->to(base_url('admin/users'));
    }
    
    public function user_login($id){   
        $model = new Users();   
                //  echo  session()->get('Role');die;

        if($role = session()->get('Role') != 1){
            $user_data = $model->where('id',$id)->first(); 
            session()->set('Admin', session()->get('UserId'));
            session()->remove('UserId');  
            session()->remove('UserName');  
            session()->remove('Role');  
            session()->remove('user_data');  
            session()->set('user_data', $user_data);  
            return redirect()->to(base_url('admin/dashboard'));
        }elseif(session()->has('Admin')){ 
            $user_data = $model->where('id',session()->get('Admin'))->first(); 
            session()->remove('Admin');
            session()->set('UserId', $user_data['id']);  
            session()->set('UserName', $user_data['name']);  
            session()->set('Role', $user_data['role']);     
            session()->set('user_data', $user_data);  
            return redirect()->to(base_url('admin/dashboard'));
        }else{
            session()->setFlashdata('error', 'This Service only For Admin.');
            return redirect()->to(previous_url());
        }
    }
}
