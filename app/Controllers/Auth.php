<?php
    namespace App\Controllers;

use App\Models\Users;
use App\Models\PasswordReset;
use PhpParser\Node\Expr\FuncCall;
use App\Models\FinancialYear;
use App\Models\Company;
use App\Models\Employee;

class Auth extends BaseController
{
    public function __construct(){
        $this->validation = \Config\Services::validation();
        helper('text');
    }

    public function index()
    {
        return view('Auth/SignIn');
    }
    
    public function SignIn()
    { 
        $this->validation->setRules(
            [
                'email' => 'required',
                'password' => 'required', 
            ],
            [
                'email' => ['required' => 'email is required'],
                'password' => ['required' => 'password is required'], 
            ]
        );
        // Set rules 
        if (!$this->validation->withRequest($this->request)->run()) {   
            return redirect()->to(previous_url())->with('errors', $this->validation->getErrors()); 
        } else {  
            $model = new Users();
            // $model = new Employee();
            $data = $this->request->getPost(); 
            $check_email = $model->where(['email'=>$data['email']])->first(); 
            if($check_email !== null){
                $check_password = $model->where(['email'=>$data['email'], 'password'=>md5($data['password'])])->first(); 
                if($check_password !== null){  
                    $check_delete_status = $model->where(['id'=>$check_password['id'],'status'=>1,'delete_status'=>0])->first(); 
                    if($check_delete_status !== null){
                        $check_status = $model->where(['id'=>$check_password['id'],'status'=>1])->first(); 
                        $f_year = new FinancialYear();
                        $default = $f_year->where('default_year', 1)->get()->getRow();
                        if($default){
                            session()->set('FinancialYear', $default->id);  
                            if ($check_status !== null) { 
                                session()->set('UserId', $check_status['id']);  
                                session()->set('UserName', $check_status['name']);  
                                session()->set('Role', $check_status['role']);  
                                session()->set('user_data', $check_status);  
                                
                          if($check_status['comp_id'] != 0){
                            session()->set('check_employee','true');  
                            $user_data = $model->where('id',$check_status['id'])->first(); 
                            session()->set('Admin', 1);
                            session()->remove('UserId');  
                            session()->remove('UserName');  
                            session()->set('Role', $user_data['role']);  
                            session()->set('CompId', $user_data['comp_id']);     
   
                            
                            session()->remove('user_data');  
                            session()->set('user_data', $user_data);  
                            return redirect()->to(base_url('company/dashboard'));

                          }else{
                            session()->set('check_employee','false');  

                            return redirect()->to(base_url('admin/dashboard'))->with('success', 'Welcome Back !');  

                          }
                                // return redirect()->to(base_url('company/dashboard'));

                            } else {
                                return redirect()->to(previous_url())->with('errors', ['Currently Blocked User']); 
                            } 
                        }else{
                            return redirect()->to(previous_url())->with('errors', ['Default Financial Year Not Set']);
                        }
                    }else{
                        return redirect()->to(previous_url())->with('errors', ['User Parmanent Removed']); 
                    }
                }else{
                    return redirect()->to(previous_url())->with('errors', ['Password not match']); 
                }
            }else{
                return redirect()->to(previous_url())->with('errors', ['Email not found']); 
            }
        }
    }
    
    public function ForgotPassword()
    {
        return view('Auth/ForgotPassword');
        
    }

    public function logout()
    {
        // Destroy the user session
        session()->destroy();

        // Redirect to the login page or any other page
        return redirect()->to(base_url());
    }

    public function check_email(){
        $model = new Users();
        $data = $this->request->getPost(); 
        $check_email = $model->where(['email'=>$data['email']])->first(); 
        if($check_email !== null){
            $otp = mt_rand(100000, 999999);
            $email = \Config\Services::email();
            $email->setTo('ramshrivas964@gmail.com');
            $email->setSubject('Email Testing');
            $email->setMessage('Reset Password OTP is '. $otp); 
            if ($email->send()) { 
                session()->set('forget_password', $otp);
                session()->set('Useremail', $check_email['email']);
                return redirect()->to(base_url('set-password'))->with('success', 'OTP sent to your Mail');  
            } 
            else {
                return redirect()->to(previous_url())->with('errors', 'Something Went wrong');
            }
        }else{
            return redirect()->to(previous_url())->with('errors', 'You are not registered with us'); 
        }
    }

    public function view_form(){
        return view('Auth/NewPassword');
    }

    public function change_password(){ 
        $this->validation->setRules(
            [
                'otp' => 'required|max_length[6]',
                'new_password'    => 'required',
                'confirm_password'    => 'required|matches[new_password]',
            ],
        ); 
        // Set rules
        if (!$this->validation->withRequest($this->request)->run()) {   
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{
            $model = new Users();
            $data = $this->request->getPost();  // 808970
            // print_r(session()->get('forget_password')); die; 
            if($data['otp'] == session()->get('forget_password')){ 
                // print_r($model->getLastQuery()->query()); die;
                session()->remove('forget_password');
                session()->set('Useremail');
                $update_data = ['password'=>md5($data['new_password']), 'pwd'=>$data['new_password']]; 
                $model->where('email',session()->get('Useremail'))->set($update_data)->update();
                return redirect()->to(base_url('/'))->with('success', 'Password Changed Successfully'); 
            }else{
                return redirect()->to(previous_url())->with('error', 'Otp Does Not Matched.!'); 
            }
        }
    }

    public function company_login($comp_id){
        $comp_model = new Company(); 
        $comp_info = $comp_model->where('id',$comp_id)->get()->getRow(); 
        session()->set('StateId', $comp_info->state);
        session()->set('CompId', $comp_info->id);
        session()->set('Role',6);
        return redirect()->to(base_url('company/dashboard'));
    }
   
    public function company_logout(){ 
        session()->remove('StateId');
        session()->remove('CompId'); 
        session()->set('Role',1);
        return redirect()->to(base_url('admin/dashboard'));
    }
}
