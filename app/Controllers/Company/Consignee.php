<?php
namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\State;
use App\Models\Consignee as Consignees;
use App\Models\BusinessType;
use App\Models\City;

use App\Models\code_prefix as codeprefix;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class Consignee extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new Consignees();
        $data['title'] = 'Consignors';
        $data['consigns'] = $model->where(['is_delete'=>1,'comp_id' => session()->get('CompId')])->get()->getResult();
        return view('Company/consignee/index', $data);
    }

    public function import()
{
    // Load spreadsheet
    $busi_model= new BusinessType;
    $state_model = new State();
    $dis = new City();
    $codeprefix = new codeprefix() ;
    $model = new Consignees();

    $request = service('request');
    $file = $request->getFile('excel_file');
    $errors = [];
    $errors1 = [];

    $spreadsheet = IOFactory::load($file);
    // Get the first sheet
    $sheet = $spreadsheet->getActiveSheet();

    $highestRow = $sheet->getHighestDataRow();
    $highestColumn = $sheet->getHighestDataColumn();
    // Iterate through each row of the spreadsheet
    $keys = $sheet->rangeToArray('A1:' . $highestColumn . '1', NULL, TRUE, FALSE);
    $values = [];

    for ($row = 2; $row <= $highestRow; $row++) {
        // Read data from each cell
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
        $values[] = $rowData[0];
    }
    // Combine keys and values into an associative array
    $importData = [];
    foreach ($values as $value) {
        $importData[] = array_combine($keys[0], $value);
    }
    // Insert data into database
    $arrykey=0;
    $rowNumber = 1;
    $arrnew=0;

    $where = ['status'=>1, 'is_delete'=>1];
    foreach($importData as $data){
$state = $state_model->like(['name'=>$data['state']])->where($where)->where(['country_id'=>'101'])->orderBy('name')->first();
$district=  $dis->like(['name'=>$data['district']])->where($where)->orderBy('name')->first();

        if (empty($data['state']) || !$state) {
          
            $errors[] = "State not found in database , in Excel row ".$rowNumber . ",  insert correct value";
            $errors1[] = "State not found in database , in Excel row ".$rowNumber . ",  insert correct value";

        }
        if (empty($data['district']) || !$district) {
            $errors[] = "District ".$data['district']." not found in database, in Excel row ".$rowNumber . ",  insert correct value";
            $errors1[] = "District ".$data['district']." not found in database, in Excel row ".$rowNumber . ",  insert correct value";

        }
        // if (empty($data['country'])) {
            // $errors[] = "Country is blank in row ".$rowNumber;
        // }

    $arrykey++;
    $rowNumber++;

    $data['code_prepix'] = $codeprefix->where('comp_id',session()->get('CompId'))->where('series_type','Consignee')->get()->getRow();
    $code_prepix =$data['code_prepix'];
    if(empty($code_prepix)){
        session()->setFlashdata('success', 'Kindly Set Code Prefix. Required!.');

        return redirect()->to(base_url('company/add-code_prefix')); 

    }
// print_r($data['code_prepix']); die;
    $business_types[] = $busi_model->like(['name'=>$data['consignee_type']])->findAll();

    $all_states[] = $state_model->like(['name'=>$data['state']])->where($where)->where(['country_id'=>'101'])->orderBy('name')->findAll();
    $all_district[] =  $dis->like(['name'=>$data['district']])->where($where)->orderBy('name')->findAll();

    if($data['Account Type']=='Saving' || $data['Account Type']=='saving'){
      $ac_type='1';
    }else if($data['Account Type']=='Current' || $data['Account Type']=='current'){
        $ac_type='2';
    }else if($data['Account Type']=='Credit' || $data['Account Type']=='credit'){
        $ac_type='3';
    }else{
        $ac_type='1';
    }
    if (empty($errors)) {
        $arrnew++;
        $consignee_code1=$data['code_prepix']->second_prefix+$arrnew-1;
        // $consignee_code1=94+$arrnew-1;
        $consignee_code=$data['code_prepix']->first_prefix.$consignee_code1;
       $insertdata= [

        'consignee_code' => $consignee_code,
        'consignee_type' => $business_types[$arrykey-1][0]['id'],
        'name' => $data['name'],
        'nickname' => $data['nickname']?? '',
        'alternate_mobile'    => $data['alternate_mobile'] ?? '',
        'email'    => $data['email'] ?? '',
        'mobile'    => $data['mobile'] ?? '',
        'country'    => '101',
        'state'    => $all_states[$arrykey-1][0]['id'] ?? '',
        'district'    => $all_district[$arrykey-1][0]['id'] ?? '',
        'pin_code'    => $data['pin_code'] ?? '',
        'address_1'    => $data['address_1'] ?? '',  
        'address_2'    => $data['address_2'] ?? '',  
        'address_3'    => $data['address_3'] ?? '',  
        'gst_number'    => $data['gst_number'] ?? '',  
        'pan_number'    => $data['pan_number'] ?? '',  
        'tan_number'    => $data['tan_number'] ?? '',  
        'msme_number'    => $data['msme_number'] ?? '',  
        'ies_number'    => $data['IES Number'] ?? '',  
        'contact_person'    => $data['contact_person'] ?? '',  
        'contact_person_mobile'    => $data['contact_person_mobile'] ?? '',  
        'company_website'    => $data['company_website'] ?? '',  
        'ac_type'    => $ac_type ?? '',  
        'ac_number'    => $data['Account Number'] ?? '',  
        'bank_name'    => $data['Bank Name'] ?? '',  
        'pf_no'    => $data['PF No'] ?? '',  
        'esi_no'    => $data['ESI No'] ?? '',  
        'est_no'    => $data['EST No'] ?? '',  
        'gst_status'    => ($data['GST Status'] =='Yes' || $data['GST Status'] =='YES' || $data['GST Status'] =='yes') ? '1' : '0', 
        'msme_status'    => ($data['MSME Status'] =='Yes' || $data['MSME Status'] =='YES' || $data['MSME Status'] =='yes') ? '1' : '0', 
        'ifsc_code'    => $data['IFSC Code'] ?? '',  
        'financial_year'    => session()->get('FinancialYear'),
        'created' => current_time(),
        'user_id' => session()->get('UserId'),
        'comp_id' => session()->get('CompId'),
        'created_by' => session()->get('UserName'),
       ];
      $insert=  $model->insert($insertdata);
     
    }
    else {
       
        session()->setFlashdata('import_errors', $errors1);
        $errors = [];

    }
    };
    
     if (!empty($errors)) {
       
           // session()->setFlashdata('import_errors11', $errors);
     } else {
        if($insert){ 
    // $incrment_secondprefix=$data['code_prepix']->second_prefix+$arrykey;
      $data1 = [
        'second_prefix' => $consignee_code1+1,
    ];   

    $code_id = $codeprefix->where('comp_id',session()->get('CompId'))->where('series_type','Consignee')->set($data1)->update();
        session()->setFlashdata('success', 'Consignee Created Successfully.');
        return redirect()->to(base_url('company/consignee')); 
    }else{
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }
 }
}
    
public function downloadExcel()
{
    $file = WRITEPATH . 'excel/consignee_demo_import.xlsx';
// echo $file;die;
    // Check if the file exists
    if (file_exists($file)) {
        // Load the Response helper
        helper('download');

        // Read the file contents
        $file_contents = file_get_contents($file);
        // Set the appropriate headers for file download
        $response = $this->response
            ->setHeader('Content-Type', 'application/octet-stream')
            ->setHeader('Content-Disposition', 'attachment; filename="consignee_demo_import.xlsx"')
            ->setBody($file_contents);
        return $response;
    } else {
        // File not found
        session()->setFlashdata('error', 'File not found');
        return redirect()->to(previous_url()); 
    }
}

public function initiateDownload()
{
    return $this->downloadExcel();
}
    public function add(){ 
        $busi_model= new BusinessType;
        $data['title'] = 'Add Consignor';
        $data['countries'] = get_countries();
        $data['business_types'] = $busi_model->get()->getResult();
        $model = new codeprefix() ;
        $data['code_prepix'] = $model->where('comp_id',session()->get('CompId'))->where('series_type','Consignee')->get()->getRow();

        $code_prepix =$data['code_prepix'];
    if(empty($code_prepix)){
        session()->setFlashdata('success', 'Kindly Set Code Prefix. Required!.');

        return redirect()->to(base_url('company/add-code_prefix')); 

    }else{
        return view('Company/consignee/create', $data);

    }
    }

    public function store(){
        $validatedData = $this->request->getPost();  
        $validationRule = [
            'consignee_code' => 'required',
            'consignee_type'=> 'required',
            'name' => 'required', //min_length[5]|max_length[50]
            'mobile'    => 'required|min_length[10]|numeric',
            'email'    => 'required|valid_email', 
            'country' => 'required',
            'state'    => 'required', 
            'district'    => 'required',
            'address_1'    => 'required|min_length[6]', 
            'pin_code'    => 'required|min_length[6]', 
          //  'gst_number'    => 'required', 
          //  'pan_number'    => 'required', 
           // 'tan_number'    => 'required', 
           // 'msme_number'    => 'required', 
           // 'ies_number'    => 'required', 
            // 'contact_person'    => 'required', 
            // 'contact_person_mobile'    => 'required', 
         //   'ac_type'    => 'required', 
          //  'ac_number'    => 'required',  
            
        ];  
        $this->validation->setRules($validationRule);  

        if (!$this->validation->withRequest($this->request)->run()) {  
            // print_r("under if"); die;
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            
            if($validatedData['gst_status']==0){
                $validatedData['gst_number']="";  
            }
            if($validatedData['msme_status']==0){
                $validatedData['msme_number']="";  
            }

            $model = new codeprefix() ;
            $incrment_secondprefix=$validatedData['second_prefix']+1;
            $data1 = [
                'second_prefix' => $incrment_secondprefix,
            ];   
            $code_id = $model->where('comp_id',session()->get('CompId'))->where('series_type','Consignee')->set($data1)->update();

            $model = new Consignees();
            $data = [
                'consignee_code' => $validatedData['consignee_code'],
                'consignee_type' => $validatedData['consignee_type'],
                'name' => $validatedData['name'],
                'nickname' => $validatedData['nickname'],

                
                'alternate_mobile'    => $validatedData['alternate_mobile'] ?? '',
                'email'    => $validatedData['email'],
                'mobile'    => $validatedData['mobile'],
                'country'    => $validatedData['country'],
                'state'    => $validatedData['state'],
                'district'    => $validatedData['district'],
                'pin_code'    => $validatedData['pin_code'],
                'address_1'    => $validatedData['address_1'],  
                'address_2'    => $validatedData['address_2'] ?? '',  
                'address_3'    => $validatedData['address_3'] ?? '',  
                'gst_number'    => $validatedData['gst_number'] ?? '',  
                'pan_number'    => $validatedData['pan_number'] ?? '',  
                'tan_number'    => $validatedData['tan_number'] ?? '',  
                'msme_number'    => $validatedData['msme_number'] ?? '',  
                // 'ies_number'    => $validatedData['ies_number'] ?? '',  
                'contact_person'    => $validatedData['contact_person'] ?? '',  
                'contact_person_mobile'    => $validatedData['contact_person_mobile'] ?? '',  
                'company_website'    => $validatedData['company_website'] ?? '',  
                'ac_type'    => $validatedData['ac_type'] ?? '',  
                'ac_number'    => $validatedData['ac_number'] ?? '',  
                'bank_name'    => $validatedData['bank_name'] ?? '',  
                // 'pf_no'    => $validatedData['pf_no'] ?? '',  
                // 'esi_no'    => $validatedData['esi_no'] ?? '',  
                'est_no'    => $validatedData['est_no'] ?? '',  
                'gst_status'    => $validatedData['gst_status'] ?? '', 
                'msme_status'    => $validatedData['msme_status'] ?? '', 
                'ifsc_code'    => $validatedData['ifsc_code'] ?? '',  
                'financial_year'    => session()->get('FinancialYear'),
                'created' => current_time(),
                'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];  
            if(isset($validatedData['gst_number'])){
                $data['gst_number'] = $validatedData['gst_number'];
            }
        
            // print_r($data); die;
            $ins_id = $model->insert($data); 
            if($ins_id){ 
                session()->setFlashdata('success', 'Consignee Created Successfully.');
                return redirect()->to(base_url('company/consignee')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function status($id){
        $consign  = new Consignees();
        $comp = $consign->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $update = [];
        if($comp->status){
            $update['status'] = 0; 
        }else{
            $update['status'] = 1; 
        }
        $consign->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('error', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }

    public function edit($id){
        $state = new State(); 
        $consign  = new Consignees();
        $busi_model= new BusinessType;
        $data['title'] = 'Edit Consignee';
        $data['consign'] = $consign->where('id', $id)->where('is_delete', 1)->get()->getRow();   
        $data['countries'] =   get_countries();
        $data['business_types'] = $busi_model->get()->getResult();
        return view('Company/consignee/edit', $data);
    }
    
    public function viewpage($id){
        $state = new State(); 
        $consign  = new Consignees();
        $busi_model= new BusinessType;
        $data['title'] = 'Edit Consignee';
        $data['consign'] = $consign->where('id', $id)->where('is_delete', 1)->get()->getRow();   
        $data['countries'] =   get_countries();
        $data['business_types'] = $busi_model->get()->getResult();
        return view('Company/consignee/viewpage', $data);
    }
    
    
    public function update($id){

        $validatedData = $this->request->getPost(); 
        $validationRule = [
            'consignee_code' => 'required',
            'consignee_type'=> 'required',
            'name' => 'required', //min_length[5]|max_length[50]
            'mobile'    => 'required|min_length[10]|numeric',
            'email'    => 'required|valid_email', 
            'country' => 'required',
            'state'    => 'required', 
            'district'    => 'required',
            'address_1'    => 'required|min_length[6]', 
            'pin_code'    => 'required|min_length[6]', 
          //  'gst_number'    => 'required', 
          //  'pan_number'    => 'required', 
           // 'tan_number'    => 'required', 
           // 'msme_number'    => 'required', 
           // 'ies_number'    => 'required', 
            // 'contact_person'    => 'required', 
            // 'contact_person_mobile'    => 'required', 
         //   'ac_type'    => 'required', 
          //  'ac_number'    => 'required',  

        ];  
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

            $model = new Consignees();
            $data = [
                'consignee_code' => $validatedData['consignee_code'],
                'consignee_type' => $validatedData['consignee_type'],
                'name' => $validatedData['name'],
                'nickname' => $validatedData['nickname'],

                'alternate_mobile'  => $validatedData['alternate_mobile'] ?? '',
                'email'    => $validatedData['email'],
                'mobile'    => $validatedData['mobile'],
                'country'    => $validatedData['country'],
                'state'    => $validatedData['state'],
                'district'    => $validatedData['district'],
                'pin_code'    => $validatedData['pin_code'],
                'address_1'    => $validatedData['address_1'],  
                'address_2'    => $validatedData['address_2'] ?? '',  
                'address_3'    => $validatedData['address_3'] ?? '',  
                'gst_number'    => $validatedData['gst_number'] ?? '',  
                'pan_number'    => $validatedData['pan_number'] ?? '',  
                'tan_number'    => $validatedData['tan_number'] ?? '',  
                'msme_number'    => $validatedData['msme_number'] ?? '',  
                // 'ies_number'    => $validatedData['ies_number'] ?? '',  
                'contact_person'    => $validatedData['contact_person'] ?? '',  
                'contact_person_mobile'    => $validatedData['contact_person_mobile'] ?? '',  
                'company_website'    => $validatedData['company_website'] ?? '',  
                'ac_type'    => $validatedData['ac_type'] ?? '',  
                'ac_number'    => $validatedData['ac_number'] ?? '',  
                'bank_name'    => $validatedData['bank_name'] ?? '',  
                // 'pf_no'    => $validatedData['pf_no'] ?? '',  
                // 'esi_no'    => $validatedData['esi_no'] ?? '',  
                'ifsc_code'    => $validatedData['ifsc_code'] ?? '',  
                'gst_status'    => $validatedData['gst_status'] ?? '', 
                'msme_status'    => $validatedData['msme_status'] ?? '', 
                'est_no'    => $validatedData['est_no'] ?? '', 
                'financial_year'    => session()->get('FinancialYear'),
                // 'created' => current_time(),
                // 'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                // 'created_by' => session()->get('UserName'),
                'updated' => current_time(), 
            ];  
            if(isset($validatedData['gst_number'])){
                $data['gst_number'] = $validatedData['gst_number'];
            }
            $upd_id = $model->where('id',$id)->set($data)->update();
            if($upd_id){ 
                session()->setFlashdata('success', 'Consignee Updated Successfully.');
                return redirect()->to(base_url('company/consignee')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
            // print_r( $validatedData ); die;
        }
    }

    public function delete($id){
        $consign  = new Consignees();
        $consign_info = $consign->where('id', $id)->set('is_delete', 0)->update();
        session()->setFlashdata('success', 'Consignee Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
