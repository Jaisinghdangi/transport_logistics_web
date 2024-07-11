<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\State;
use App\Models\FinancialYear;
use App\Models\Company;
use App\Models\BusinessType;
use App\Models\ComapnyProfile;

class CompanyController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $company = New Company();
        $data['companies'] = $company->where('is_delete', 1)
            ->where('user_id',session()->get('UserId'))
            ->where('financial_year',session()->get('FinancialYear'))
            ->get()->getResult();
        $data['title'] = 'Companies'; 
        return view('Masters/Company/index', $data);
    }
    
    public function add(){ 
        $busi_model = new BusinessType();
        $data['title'] = 'Add Company';
        $data['countries'] = get_countries();  
        $data['business_types'] = $busi_model->get()->getResult();
        return view('Masters/Company/create', $data);
    }

    public function store(){
        $validatedData = $this->request->getPost(); 
     
        $validationRule = [
            'company_code' => 'required', //min_length[5]|max_length[50]
            'company_type' => 'required', //min_length[5]|max_length[50]
            'company_name' => 'required', //min_length[5]|max_length[50]
            'company_mobile'    => 'required|min_length[10]|max_length[10]',
            'company_email'    => 'required|valid_email', 
            'country'    => 'required', 
            'state'    => 'required', 
            'district'    => 'required', 
            'address_1'    => 'required', 
            'pin_code'    => 'required|min_length[6]|max_length[6]',  
            'company_mobile'    => 'required|min_length[10]|max_length[10]',  
            'alternet_mobile'    => 'required|min_length[10]|max_length[10]',  
            // 'ifsc_code'    => 'required|min_length[11]|max_length[11]',  
            'pan_number'    => 'required|min_length[10]|max_length[10]',   
        ] ;
        if(isset($validatedData['gst_number']) && !empty($validatedData['gst_number'])){
            $validationRule['gst_number'] = 'is_unique[companies.gst_number]|min_length[15]|max_length[15]';
        }
        $this->validation->setRules($validationRule);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{  

            if($validatedData['gst_status']==0){
                $validatedData['gst_number']="";  
            }
            if($validatedData['msme_status']==0){
                $validatedData['msme_number']="";  
            }

            
            $model = new Company();
            $data = [
                'comp_code' => $validatedData['company_code'],
                'comp_type' => $validatedData['company_type'],
                'company_name' => $validatedData['company_name'],
                'company_mobile'    => $validatedData['company_mobile'],
                'alternet_mobile'    => $validatedData['alternet_mobile'],
                'company_email'    => $validatedData['company_email'],
                'country'    => $validatedData['country'],
                'state'    => $validatedData['state'],
                'district'    => $validatedData['district'],
                'address_1'    => $validatedData['address_1'],
                'address_2'    => $validatedData['address_2'] ?? '',
                'address_3'    => $validatedData['address_3'] ?? '',
                'pin_code'    => $validatedData['pin_code'],
                'gst_number'    => $validatedData['gst_number'] ?? '',
                'pan_number'    => $validatedData['pan_number'] ?? '',
                'tan_number'    => $validatedData['tan_number'] ?? '',
                'msme_number'    => $validatedData['msme_number'] ?? '',
                'iec_number'    => $validatedData['iec_number'] ?? '',
                'contact_person'    => $validatedData['contact_person'] ?? '',
                'company_website'    => $validatedData['company_website'] ?? '',
                'contact_person_mobile'    => $validatedData['contact_person_mobile'] ?? '', 
                'ac_type'    => $validatedData['ac_type'] ?? '', 
                'ac_number'    => $validatedData['ac_number'] ?? '', 
                'bank_name'    => $validatedData['bank_name'] ?? '', 
                'ifsc_code'    => $validatedData['ifsc_code'] ?? '', 
                'pf_no'    => $validatedData['pf_no'] ?? '', 
                'esi_no'    => $validatedData['esi_no'] ?? '', 
                'est_no'    => $validatedData['est_no'] ?? '',  
                'cin_number' => $validatedData['cin_number']??'',
                'iso_number' => $validatedData['iso_number']??'',
                'ies_number'    => $validatedData['ies_number'] ?? '',
                'gst_status'    => $validatedData['gst_status'] ?? '', 
                'msme_status'    => $validatedData['msme_status'] ?? '', 
               // new field start
                'pf_number' => $validatedData['pf_number']??'',
                'esi_number' => $validatedData['esi_number']??'',
                'pt_number' => $validatedData['pt_number']??'',
                'contact_person_email' => $validatedData['contact_person_email']??'',
               // new field end
                'financial_year'    => session()->get('FinancialYear'),
                'created' => current_time(),
                'user_id' => session()->get('UserId'),
                'created_by' => session()->get('UserName'),
            ];  
            $ins_id = $model->insert($data); 
            if($ins_id){
                $comp_profile = new ComapnyProfile();
                $profile_data = [
                    'comp_id' => $ins_id,
                    'created' => current_time(),
                ];
                $comp_profile->insert($profile_data);
                session()->setFlashdata('success', 'Company Created Successfully.');
                return redirect()->to(base_url('admin/companies')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(base_url('admin/add-company')); 
            }
        }
    }

    public function status($id){
        $company  = new Company();
        $comp = $company->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $update = [];
        if($comp->status){
            $update['status'] = 0; 
        }else{
            $update['status'] = 1; 
        } 
        $company->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('error', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 

    }

    public function edit($id){ 
        $busi_model = new BusinessType();
        $company  = new Company();
        $data['title'] = 'Edit Company';
        $data['countries'] = get_countries();  
        $data['business_types'] = $busi_model->get()->getResult(); 
        $data['company'] = $company->where('id', $id)->where('is_delete', 1)->get()->getRow();  
        return view('Masters/Company/edit', $data);
    }
    
    public function update($id){
        $validatedData = $this->request->getPost(); 
        $validationRule = [
            'company_code' => 'required', //min_length[5]|max_length[50]
            'company_type' => 'required', //min_length[5]|max_length[50]
            'company_name' => 'required', //min_length[5]|max_length[50]
            'company_mobile'    => 'required|min_length[10]|max_length[10]',
            'company_email'    => 'required|valid_email', 
            'country'    => 'required', 
            'state'    => 'required', 
            'district'    => 'required', 
            'address_1'    => 'required', 
            'pin_code'    => 'required|min_length[6]|max_length[6]',  
            'company_mobile'    => 'required|min_length[10]|max_length[10]',  
            'alternet_mobile'    => 'required|min_length[10]|max_length[10]',  
            // 'ifsc_code'    => 'required|min_length[11]|max_length[11]',  
            'pan_number'    => 'required|min_length[10]|max_length[10]',  
            'gst_number'    => 'required|min_length[15]|max_length[15]',  
        ];
        if(isset($validatedData['gst_number']) && !empty($validatedData['gst_number'])){
            $validationRule['gst_number'] = 'is_unique[companies.gst_number,companies.id,' . $id . ']';
        }
        $this->validation->setRules($validationRule);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{  
 
                
            if($validatedData['gst_status']==0){
                $validatedData['gst_number']="";  
            }
            if($validatedData['msme_status']==0){
                $validatedData['msme_number']="";  
            }

            $model = new Company();
            $data = [
                'comp_code' => $validatedData['company_code'],
                'comp_type' => $validatedData['company_type'],
                'company_name' => $validatedData['company_name'],
                'company_mobile'    => $validatedData['company_mobile'],
                'alternet_mobile'    => $validatedData['alternet_mobile'],
                'company_email'    => $validatedData['company_email'],
                'country'    => $validatedData['country'],
                'state'    => $validatedData['state'],
                'district'    => $validatedData['district'],
                'address_1'    => $validatedData['address_1'],
                'address_2'    => $validatedData['address_2'] ?? '',
                'address_3'    => $validatedData['address_3'] ?? '',
                'pin_code'    => $validatedData['pin_code'],
                'gst_number'    => $validatedData['gst_number'] ?? '',
                'pan_number'    => $validatedData['pan_number'] ?? '',
                'tan_number'    => $validatedData['tan_number'] ?? '',
                'msme_number'    => $validatedData['msme_number'] ?? '',
                'ies_number'    => $validatedData['ies_number'] ?? '',
                'contact_person'    => $validatedData['contact_person'] ?? '',
                'company_website'    => $validatedData['company_website'] ?? '',
                'contact_person_mobile'    => $validatedData['contact_person_mobile'] ?? '', 
                'ac_type'    => $validatedData['ac_type'] ?? '', 
                'ac_number'    => $validatedData['ac_number'] ?? '', 
                'bank_name'    => $validatedData['bank_name'] ?? '', 
                'ifsc_code'    => $validatedData['ifsc_code'] ?? '', 
                'pf_no'    => $validatedData['pf_no'] ?? '',  
                'est_no'    => $validatedData['est_no'] ?? '', 
                'esi_no'    => $validatedData['esi_no'] ?? '',  
                'iec_number'    => $validatedData['iec_number'] ?? '',
                'financial_year'    => session()->get('FinancialYear'),
                'updated' => current_time(), 
                'gst_status'    => $validatedData['gst_status'] ?? '', 
                'msme_status'    => $validatedData['msme_status'] ?? '', 
                'user_id' => session()->get('UserId'),
                'created_by' => session()->get('UserName'),
                'cin_number' => $validatedData['cin_number']??'',
                'iso_number' => $validatedData['iso_number']??'',
                 // new field start
                 'pf_number' => $validatedData['pf_number']??'',
                 'esi_number' => $validatedData['esi_number']??'',
                 'pt_number' => $validatedData['pt_number']??'',
                 'contact_person_email' => $validatedData['contact_person_email']??'',
                // new field end
            ];   
         
            $ins_id = $model->where('id',$id)->set($data)->update();  
            if($ins_id){ 
                session()->setFlashdata('success', 'Company Updated Successfully.');
                return redirect()->to(base_url('admin/companies')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function delete($id){
        $company  = new Company();
        $comp_info = $company->where('id', $id)->set('is_delete', 0)->update();
        session()->setFlashdata('success', 'Company Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
