<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Country;
use App\Models\BusinessType;
use App\Models\Consignor as Consign;
use App\Models\consignorNumber as consignorNum;
use App\Models\termsCondition as termcondition;
use App\Models\SeriesType;
use App\Models\vehicalType;

use App\Models\code_prefix as codeprefix;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class vehicalTypeMaster  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = 'Vehical Type';
        $model = new vehicalType();
        $data['VehicalType'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();
       
        return view('Company/vehicalTypeMaster/index', $data);
    }
  
    
    public function add(){ 
        $data['title'] = 'Add Vehical Type';
        return view('Company/vehicalTypeMaster/create', $data);
    }

  public function store() {
    $model = new vehicalType();

    $validatedData = $this->request->getPost();   
    $data = [
        'width' => $validatedData['width'],
        'height' => $validatedData['height'],
        'length' => $validatedData['length'],
        'vehical_type' => $validatedData['vehical_type'],
        'capacity' => $validatedData['capacity'],
        'groundclearance' => $validatedData['groundclearance'],
        'status' => '1',
        'is_delete'=>'1',
        'created' => current_time(),
        'comp_id' => session()->get('CompId'),
        'created_by' => session()->get('UserName'),
    ];   
    $ins_id = $model->insert($data);
    if ($ins_id) { 
        session()->setFlashdata('success', 'Vehical Type Created Successfully.');
        return redirect()->to(base_url('company/vehical-type-master')); 
    } else {
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }   
}

    public function edit($id){  
        $data['title'] = 'Edit Vehical Type';
        $model = new vehicalType();        
        $data['VehicalType'] = $model->where('id', $id)->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getRow();
        return view('Company/vehicalTypeMaster/edit', $data);
    }
    
    public function update($id){
        $validatedData = $this->request->getPost();  
        $model = new vehicalType();        
        $data = [
            'width' => $validatedData['width'],
            'height' => $validatedData['height'],
            'length' => $validatedData['length'],
            'vehical_type' => $validatedData['vehical_type'],
            'capacity' => $validatedData['capacity'],
            'groundclearance' => $validatedData['groundclearance'],
            'updated' => current_time(), 

        ];  
            $ins_id = $model->set($data)->where('id',$id)->update();
            if($ins_id){ 
                session()->setFlashdata('success', 'Vehical Type Updated Successfully.');
                return redirect()->to(base_url('company/vehical-type-master')); 
            }else{
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url()); 
            }
        
    }


    
public function import()
{
    // Load spreadsheet
    $model = new vehicalType();        


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

  //  $where = ['status'=>1, 'is_delete'=>1];
    foreach($importData as  $validatedData){
      
    
    $arrykey++;
    $rowNumber++;
    if (empty($errors)) {
       
        
       $insertdata= [
        'vehical_type' => $validatedData['Vehical Type'] ?? '',
        'width' => $validatedData['Width'] ?? '',
        'height' => $validatedData['Height'] ?? '',
        'length' => $validatedData['Length'] ?? '',
        'capacity' => $validatedData['Capacity'] ?? '',
        'groundclearance' => $validatedData['Ground Clearance'] ?? '',
        'status' => '1',
        'is_delete'=>'1',
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
        session()->setFlashdata('success', 'Vehicle Type Master Added Successfully.');
        return redirect()->to(base_url('company/vehical-type-master')); 
    }else{
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url()); 
    }
 }
}




    public function downloadExcel()
    {
        $file = WRITEPATH . 'excel/vehicleTypeMaster_demo_import.xlsx';
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
                ->setHeader('Content-Disposition', 'attachment; filename="vehicleTypeMaster_demo_import.xlsx"')
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
    public function status($id) {
        $consign = new termcondition();
          
        // Retrieve the record to toggle its status
        $comp = $consign->where('id', $id)->get()->getRow(); 
    
        // Get the current status
        $currentStatus = $comp->status;
        // Update all records to set 'status' to 0
        $consign->set(['status' => 0])->where('id', $id)->update();
        // Set the status of the current record
        $update['status'] = ($currentStatus == 0) ? 1 : 0;
        $consign->where('id', $id)
                ->set($update)
                ->update();   
        session()->setFlashdata('success', 'Status Changed Successfully.');
        return redirect()->to(previous_url()); 
    }
    

    public function delete($id){
        $model = new vehicalType();        
        $consign_info = $model->where('id', $id)->set('is_delete', 0)->update();
        session()->setFlashdata('success', 'Vehical Type  Deleted Successfully.');
        return redirect()->to(previous_url()); 
    }
}
