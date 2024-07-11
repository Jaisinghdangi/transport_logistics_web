<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\Company;

class DashbordController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    { 
        $user = new Users();
        $data['title'] =  'Dashboard';
        $data['user_count'] = $user->where('delete_status',0)->countAllResults(); 
        return view('Logistics/Dashboard', $data); 
    }
    
    public function my_profile(){ 
        $data = ['title' => 'My Profile'];
        return view('Logistics/Profile/index', $data);
    }

    public function update_profile()
    {
        $id = session()->get('user_data')['id'];
        $validation = [
            'name' => 'required',  
            'email' => 'required|valid_email|is_unique[users.email, users.id, ' . $id . ']',
            'mobile'    => 'required|min_length[10]|max_length[10]|numeric|is_unique[users.mobile, users.id, ' . $id . ']', 
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
            ]; 
            if($_FILES['profile']['error'] == 0){ 
                $file = $this->request->getFile('profile'); 
                $newName = $file->getRandomName();
                $file->move('uploads/profiles/', $newName); 
                $data['profile'] = 'uploads/profiles/'.$newName;
            }  
            $model->set($data)->where('id',$id)->update();
            $user_data = $model->where('id',$id)->get()->getRow(); 
            session()->set('user_data', json_decode(json_encode($user_data), true));
            session()->setFlashdata('success', 'User Update Successfully.');
            return redirect()->to(previous_url()); 
        }
    }

    public function change_password(){
        $validation = [ 
            'current_Password'    => 'required|', 
            'new_Password'    => 'required|min_length[8]', 
            'confirm_Password' => 'required|matches[new_Password]',
        ]; 
        $validatedData = $this->request->getPost(); 
        $this->validation->setRules($validation); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {   
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{  
            $model = new Users();
            $id = session()->get('user_data')['id'];
            $data = [
                'pwd' => $validatedData['new_Password'],
                'password' => md5($validatedData['new_Password']), 
            ]; 
            $model->set($data)->where('id', $id)->update();
            $user_data = $model->where('id',$id)->get()->getRow(); 
            session()->set('user_data', json_decode(json_encode($user_data), true));
            session()->setFlashdata('success', 'Password Changed Successfully.');
            return redirect()->to(base_url('admin/my-profile')); 
        }
    }
    
    public function change_financial_year($f_id){
        session()->set('FinancialYear', $f_id);
        session()->setFlashdata('success', 'Financial Year Changed Successfully.');
        return redirect()->to(previous_url()); 
    } 
}
