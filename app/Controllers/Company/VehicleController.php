<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\State;
use App\Models\Broker;
use App\Models\Vehicle;

use App\Models\code_prefix as codeprefix;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
class VehicleController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    { 
        $vehicle = new Vehicle(); 
        $data['vehicles'] = $vehicle->where('is_delete', 1)->where('comp_id',session()->get('CompId'))->get()->getResult();  
        $data['title'] = 'All Vehicles';  
        return view('Company/vehicle/index', $data);
    }

    public function viewpage($id){ 
        $vehicle = new Vehicle();
        $broker = new Broker(); 
        $data['title'] = 'Updtae Vehicle Details';
        $data['countries'] = get_countries();  
        $data['vehicle'] = $vehicle->where('id',$id)->get()->getRow();  
        $data['brokers'] = $broker->where('is_delete', 1)->where('comp_id',session()->get('CompId'))->get()->getResult(); 
        // print_r($data['vehicle']); die;  
        return view('Company/vehicle/viewpage', $data);
    }
    
    public function add(){
        $state = new State();  
        $broker = new Broker(); 
        $data['title'] = 'Add Vehicle';
        $data['countries'] = get_countries();  
        $data['brokers'] = $broker->where('is_delete', 1)->where('comp_id',session()->get('CompId'))->get()->getResult();  
        return view('Company/vehicle/create', $data);
    }
 
    public function store(){
        
        $validatedData = $this->request->getPost();   
        // $this->validation->setRules([
        //    // 'broker' => 'required', //min_length[5]|max_length[50] 
        //     'vehicle_number'    => 'required',
        //     'model_number'    => 'required', 
        //     'color'    => 'required', 
        //     'registered_date'    => 'required', 
        //     'chassis_number'    => 'required', 

        //     'fitness_validity'    => 'required', 
        //    // 'country'    => 'required',  
        //    // 'state'    => 'required',  
        //    ////// 'district'    => 'required',  
        //     // driver validation
        //   //  'driver_name'    => 'required',  
        //    // 'driver_country'    => 'required',  
        //    // 'driver_state'    => 'required',  
        //    // 'driver_district'    => 'required',  
        //    // 'driving_licence_no'    => 'required',  
        //    // 'licence_validity'    => 'required',  
        //  //   'driver_mobile'    => 'required|numeric|min_length[10]',  
        //     'owner_name'    => 'required',  
        //    // 'owner_mobile'    => 'required|numeric|min_length[10]',  

        // // ]);  
        // if (!$this->validation->withRequest($this->request)->run()) {  
        //     return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        // } else{ 
            $model = new Vehicle();
            $data = [
               // 'broker_id' => $validatedData['broker'], 
                'vehicle_number'    => $validatedData['vehicle_number'],
                'model_number'    => $validatedData['model_number'],
                'make'    => $validatedData['make'],
                'color'    => $validatedData['color'],
                'registered_date'    => $validatedData['registered_date'],
                'chassis_number'    => $validatedData['chassis_number'],
                'engine_number'    => $validatedData['engine_number'],
                'tax_token'    => $validatedData['tax_token'],
                //'road_permmit'    => $validatedData['road_permmit'],
                'fitness_validity'    => $validatedData['fitness_validity'],
              //  'finance_country'    => $validatedData['country'],
               // 'finance_state'    => $validatedData['state'],
               // 'finance_district'    => $validatedData['district'],
                'insurance_date'    => $validatedData['insurance_date'],
                'insurance_by'    => $validatedData['insurance_by'],
              //  'certificate'    => $validatedData['certificate'],
                //'division_number'    => $validatedData['division_number'],
                'financed_by'    => $validatedData['financed_by'],
               // 'financed_address'    => $validatedData['financed_address'], 
                // driver columns
               'driver_name'    =>  $validatedData['driver_name'],  
              //  'driver_country'    =>  $validatedData['driver_country'],  
              //  'driver_state'    =>  $validatedData['driver_state'],  
               // 'driver_district'    =>  $validatedData['driver_district'],  
                 'driver_address'    =>  $validatedData['driver_address'] ?? '',  
               'driving_licence_no'    =>  $validatedData['driving_licence_no'],  
               // 'licence_validity'    =>  $validatedData['licence_validity'],  
                'driver_mobile'    =>  $validatedData['driver_mobile'],  
                'owner_name'    =>  $validatedData['owner_name'],  
              //  'owner_mobile'    =>  $validatedData['owner_mobile'],  
              //  'owner_address'    =>  $validatedData['owner_address'] ?? '',  
                'owner_relative'    =>  $validatedData['owner_relative'],  
                'vehicle_class'    =>  $validatedData['vehicle_class'],  
                'vehicle_description'    =>  $validatedData['vehicle_description'],  
                'fuel_type'    =>  $validatedData['fuel_type'],  
                'emission_norm'    =>  $validatedData['emission_norm'],  
                'seat_capacity'    =>  $validatedData['seat_capacity'],  
                'standing_capacity'    =>  $validatedData['standing_capacity'],  
                'insurance_policy_no'    =>  $validatedData['insurance_policy_no'],  
                'puccno'    =>  $validatedData['puccno'],  
                'pucc_validity'    =>  $validatedData['pucc_validity'],  
                'national_permit_no'    =>  $validatedData['national_permit_no'],  
                'national_permit_validity'    =>  $validatedData['national_permit_validity'],  
                'permit_validity'    =>  $validatedData['permit_validity'],  
                // other columns
                'created' => current_time(),
                'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];
            $ins_id = $model->insert($data); 
            if($ins_id){ 
                session()->setFlashdata('success', 'Vehicle Added Successfully.');
                return redirect()->to(base_url('company/vehicles')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
       // }
    }
/////////////

public function import()
{
    // Load spreadsheet
    $model = new Vehicle();

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

    function convertExcelDate($excelDate)
        {
            if (is_numeric($excelDate)) {
                // Convert Excel date to PHP date
                return date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($excelDate));
            } else {
                // If not a valid Excel date, set blank
                return '';
            }
        }
  //  $where = ['status'=>1, 'is_delete'=>1];
    foreach($importData as  $validatedData){
       // foreach($importData as $data){ old foreatch

//$state = $state_model->like(['name'=>$data['state']])->where($where)->where(['country_id'=>'101'])->orderBy('name')->first();
//$district=  $dis->like(['name'=>$data['district']])->where($where)->orderBy('name')->first();

        // if (empty($data['state']) || !$state) {
          
        //     $errors[] = "State not found in database , in Excel row ".$rowNumber . ",  insert correct value";
        //     $errors1[] = "State not found in database , in Excel row ".$rowNumber . ",  insert correct value";

        // }
        // if (empty($data['district']) || !$district) {
        //     $errors[] = "District ".$data['district']." not found in database, in Excel row ".$rowNumber . ",  insert correct value";
        //     $errors1[] = "District ".$data['district']." not found in database, in Excel row ".$rowNumber . ",  insert correct value";

        // }
        // if(empty($validatedData['Vehicle No.'])){
        //     $errors[] = "Vehicle No. not found in Excel row ".$rowNumber . ",  insert correct value";
        //     $errors1[] = 'Failed to insert row: ' .$rowNumber ;
        // }
        $validationRules = [
            'Registered Date' => 'permit_empty|valid_date[Y-m-d]',
            'Tax Valid UpTo' => 'permit_empty|valid_date[Y-m-d]',
            'Fitness Valid UpTo' => 'permit_empty|valid_date[Y-m-d]',
            'Insurance Valid UpTo' => 'permit_empty|valid_date[Y-m-d]',
            'PUCC Valid UpTo' => 'permit_empty|valid_date[Y-m-d]',
            'National Permit Valid UpTo' => 'permit_empty|valid_date[Y-m-d]',
            'Permit Valid UpTo' => 'permit_empty|valid_date[Y-m-d]',
        ];

        if (!$this->validate($validationRules, $validatedData)) {
            $errors[] = $this->validator->getErrors();
            $errors1[] = 'Failed to insert row: ' .$rowNumber ;

        } else {
            $phpDate = convertExcelDate($validatedData['Registered Date'] ?? '');
            $phpDate1 = convertExcelDate($validatedData['Tax Valid UpTo'] ?? '');
            $phpDate2 = convertExcelDate($validatedData['Fitness Valid UpTo'] ?? '');
            $phpDate3 = convertExcelDate($validatedData['Insurance Valid UpTo'] ?? '');
            $phpDate4 = convertExcelDate($validatedData['PUCC Valid UpTo'] ?? '');
            $phpDate5 = convertExcelDate($validatedData['National Permit Valid UpTo'] ?? '');
            $phpDate6 = convertExcelDate($validatedData['Permit Valid UpTo'] ?? '');

        }
    $arrykey++;
    $rowNumber++;
    if (empty($errors)) {
        $arrnew++;
        
       $insertdata= [
 // 'broker_id' => $validatedData['broker'], 
 'owner_name'    =>  $validatedData['Owner Name'] ?? '',  
 'owner_relative'    =>  $validatedData['S/W/D OF'] ?? '', 
 'vehicle_number'    => $validatedData['Vehicle No.'] ?? '',
 'model_number'    => $validatedData['Model No.'] ?? '',
 'make'    => $validatedData['Maker Name'] ?? '',
 'color'    => $validatedData['Color'] ?? '' ,
 'registered_date'    => $phpDate ?? '',
 'chassis_number'    => $validatedData['Chassis No.'] ?? '',
 'engine_number'    => $validatedData['Engine Number'] ?? '',
 'tax_token'    => $phpDate1 ?? '',
 'vehicle_class'    =>  $validatedData['Vehicle Class'] ?? '',
 'vehicle_description'    =>  $validatedData['Vehicle Description'] ?? '', 
 'fuel_type'    =>  $validatedData['Fuel Type'] ?? '',  
 'emission_norm'    =>  $validatedData['Emission Norms'] ?? '',  
 'seat_capacity'    =>  $validatedData['Seat Capacity'] ?? '',  
 'standing_capacity'    =>  $validatedData['Standing Capacity']   ?? '',  
 'financed_by'    => $validatedData['Financier'] ?? '',
 'insurance_by'    => $validatedData['Insurance Company'] ?? '',
 'fitness_validity'    => $phpDate2 ?? '',
 'insurance_date'    => $phpDate3 ?? '',
 'insurance_policy_no'    =>  $validatedData['Insurance Policy No.'] ?? '',  
 'puccno'    =>  $validatedData['PUCC No.'] ?? '',  
 'pucc_validity'    =>  $phpDate4 ?? '',  
 'national_permit_no'    =>  $validatedData['National Permit No.'] ?? '',  
 'national_permit_validity'    => $phpDate5 ?? '',  
 'permit_validity'    =>  $phpDate6 ?? '',  

'driver_name'    =>  $validatedData['Driver Name'] ?? '',  
'driving_licence_no'    =>  $validatedData['Driver Licence No.'] ?? '',  
 'driver_mobile'    =>  $validatedData['Driver Mobile'] ?? '', 
 'driver_address'    =>  $validatedData['Driver Address'] ?? '',  
  
 // other columns
 'created' => current_time(),
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
       
     } else {
        if($insert){ 
        session()->setFlashdata('success', 'Vehicle Added Successfully.');
        return redirect()->to(base_url('company/vehicles')); 
    }else{
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }
 }
}


//////////

    public function downloadExcel()
{
    $file = WRITEPATH . 'excel/vehicleMaster_demo_import.xlsx';
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
            ->setHeader('Content-Disposition', 'attachment; filename="vehicleMaster_demo_import.xlsx"')
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
    public function status($id){
        $vehicle  = new Vehicle();
        $comp = $vehicle->where('id', $id)->where('is_delete', 1)->get()->getRow(); 
        $update = [];
        if($comp->status){
            $update['status'] = 0; 
        }else{
            $update['status'] = 1; 
        }
        $vehicle->where('id', $id)->set($update)->update(); 
        session()->setFlashdata('error', 'Vehicle Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }

    public function edit($id){ 
        $vehicle = new Vehicle();
        $broker = new Broker(); 
        $data['title'] = 'Updtae Vehicle Details';
        $data['countries'] = get_countries();  
        $data['vehicle'] = $vehicle->where('id',$id)->get()->getRow();  
        $data['brokers'] = $broker->where('is_delete', 1)->where('comp_id',session()->get('CompId'))->get()->getResult(); 
        // print_r($data['vehicle']); die;  
        return view('Company/vehicle/edit', $data);
    }

    public function update($id){
        $validatedData = $this->request->getPost();   
        $this->validation->setRules([
            'vehicle_number'    => 'required',
            'model_number'    => 'required', 
            'color'    => 'required', 
            'registered_date'    => 'required', 
            'chassis_number'    => 'required', 
            'fitness_validity'    => 'required', 
            // driver validation
            'owner_name'    => 'required',  
            'fuel_type'=> 'required', 
        ]);  
        if (!$this->validation->withRequest($this->request)->run()) {  
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
        } else{ 
            $model = new Vehicle();
            $data = [
                'vehicle_number'    => $validatedData['vehicle_number'],
                'model_number'    => $validatedData['model_number'],
                'make'    => $validatedData['make'],
                'color'    => $validatedData['color'],
                'registered_date'    => $validatedData['registered_date'],
                'chassis_number'    => $validatedData['chassis_number'],
                'engine_number'    => $validatedData['engine_number'],
                'tax_token'    => $validatedData['tax_token'],
                'fitness_validity'    => $validatedData['fitness_validity'],
                'insurance_date'    => $validatedData['insurance_date'],
                'insurance_by'    => $validatedData['insurance_by'],
                'financed_by'    => $validatedData['financed_by'],
                // driver columns
                'owner_name'    =>  $validatedData['owner_name'],  
                'owner_relative'    =>  $validatedData['owner_relative'],  
                'fuel_type'=>  $validatedData['fuel_type'], 
                'emission_norm'    =>  $validatedData['emission_norm'],  
                'seat_capacity'    =>  $validatedData['seat_capacity'],  
                'standing_capacity'    =>  $validatedData['standing_capacity'], 
                'insurance_policy_no'    =>  $validatedData['insurance_policy_no'],  
                'vehicle_class'    =>  $validatedData['vehicle_class'],  
                'vehicle_description'    =>  $validatedData['vehicle_description'],  
                'puccno'    =>  $validatedData['puccno'],  
                'pucc_validity'    =>  $validatedData['pucc_validity'],  
                'national_permit_no'    =>  $validatedData['national_permit_no'],  
                'national_permit_validity'    =>  $validatedData['national_permit_validity'],  
                'permit_validity'    =>  $validatedData['permit_validity'], 
                'driver_name'    =>  $validatedData['driver_name'],  
                'driver_address'    =>  $validatedData['driver_address'] ?? '',  
                'driving_licence_no'    =>  $validatedData['driving_licence_no'],  
                'driver_mobile'    =>  $validatedData['driver_mobile'],  

                // other columns
                'updated' => current_time(), 
                'updated_by' => session()->get('UserName'),
            ];
            
            $ins_id = $model->where('id', $id)->set($data)->update(); 
            if($ins_id){ 
                session()->setFlashdata('success', 'Vehicle Updated Successfully.');
                return redirect()->to(base_url('company/vehicles')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        }
    }

    public function delete($id){
        $vehicle  = new Vehicle();
        $broker_info = $vehicle->where('id', $id)->get()->getRow();
        if($broker_info->is_delete){ 
            $vehicle->where(['id'=> $id])->set(['is_delete'=> 0])->update();
            session()->setFlashdata('success', 'Vehicle Deleted Successfully.');
        }else{
            session()->setFlashdata('error', 'Something Went Wrong.');
        }
        return redirect()->to(previous_url()); 
    }
}