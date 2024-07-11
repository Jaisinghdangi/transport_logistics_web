<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\Role;
use App\Models\Users;
// use App\Models\Employee as Users;


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
        $data['users'] = $model->where(['comp_id'=>session()->get('CompId'),'delete_status'=>'0'])->get()->getResult();  
        return view('Company/Logistics/employee/index', $data);
    }

    public function create(){
        $model = new Users();
        $role = new Role();
        $data = ['title' => 'Add Users'];
        $data['roles'] = $role->where(['id !='=>1,'comp_id'=>session()->get('CompId'),'delete_status'=>'0'])->get()->getResult();
        $data['users'] = $model->where('delete_status',0)->get()->getResult(); 
        return view('Company/Logistics/employee/create', $data);
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
                'comp_id' =>session()->get('CompId'),
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
            session()->setFlashdata('success', 'Employee Added Successfully.');
            return redirect()->to(base_url('company/employee')); 
        }
    }

    public function edit($id){
        $model = new Users();
        $role = new Role();
        $data = ['title' => 'Edit Users'];
        $data['roles'] = $role->where(['comp_id'=>session()->get('CompId'),'delete_status'=>'0'])->get()->getResult(); 
        $data['user'] = $model->where('id',$id)->get()->getRow();
        return view('Company/Logistics/employee/edit', $data);
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
                'role' => $validatedData['role'],
                'updated' => current_time(),
            ]; 
            if($_FILES['profile']['error'] == 0){ 
                $file = $this->request->getFile('profile'); 
                $newName = $file->getRandomName();
                $file->move('uploads/profiles/', $newName); 
                $data['profile'] = 'uploads/profiles/'.$newName;
            }  
            $model->set($data)->where('id',$id)->update();
            session()->setFlashdata('success', 'Employee Update Successfully.');
            return redirect()->to(base_url('company/employee')); 
        }
    }

    public function delete($id){
        $model = new Users(); 
        $model->where('id',$id)->set(['delete_status'=>1])->update();    
        session()->setFlashdata('success', 'Employee Delete Successfully.');
        return redirect()->to(base_url('company/employee'));
    }
    
    
    public function change_status($user_id){
        $model = new Users(); 
        $user_data = $model->where(['delete_status'=>0,'id'=>$user_id])->get()->getRow(); 
        if($user_data->status){
            $status = $model->set('status',0)->where(['id'=>$user_id])->update(); 
        }else{
            $status = $model->set('status',1)->where(['id'=>$user_id])->update();
        }
        session()->setFlashdata('success', 'Employee Status Changed Successfully.');
        return redirect()->to(base_url('company/employee'));
    }
    
    public function user_login($id){   
        $model = new Users();   
        // echo  session()->get('Role');die;
        if($role = session()->get('Role')){
            // echo $role;die;
            session()->set('check_employee','true');
            $user_data = $model->where('id',$id)->first(); 
            session()->set('Admin', session()->get('UserId'));
            session()->remove('UserId');  
            session()->remove('UserName');  
            // session()->remove('Role');  
            // session()->set('Role', '12');
            session()->set('Role', $user_data['role']);     

            session()->remove('user_data');  
            session()->set('user_data', $user_data);  
            return redirect()->to(base_url('company/dashboard'));
        }elseif(session()->has('Admin')){ 
            $user_data = $model->where('id',session()->get('Admin'))->first(); 
            session()->remove('Admin');
            session()->set('UserId', $user_data['id']);  
            session()->set('UserName', $user_data['name']);  
            session()->set('Role', $user_data['role']);     
            session()->set('user_data', $user_data);  
            return redirect()->to(base_url('company/dashboard'));
        }else{
            session()->setFlashdata('error', 'This Service only For Admin.');
            return redirect()->to(previous_url());
        }
    }
}
