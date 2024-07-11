<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;  
use App\Models\Broker; 
use App\Models\Consignee; 
use App\Models\Consignee as Consignees;
use App\Models\Booking; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ChallanController extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Calcutta");
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {  
        $db = \Config\Database::connect();
        $where['is_delete'] = 0;
        $where['comp_id'] =session()->get('CompId');
        $currentDate = new \DateTime();
        $currentDate->modify('first day of this month');
        $firstDateOfMonth = $currentDate->format('Y-m-d');
        $from_date = $firstDateOfMonth;  //date('Y-m-d');
        $to_date =  date('Y-m-d');

       // $from_date = date('Y-m-d');
       // $to_date = date('Y-m-d');
        if ($_GET) {
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
        }
        $where['challan_date >='] = $from_date;
        $where['challan_date <='] = $to_date;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['title'] = 'All Challan Invoice';
        $data['invoices'] =$db->table('bookings')->where($where)->orderBy('id', 'DESC')->get()->getResult();
        return view('Company/challan/index', $data);
    }
    public function print($id){ 
        $db = \Config\Database::connect();
        $data['title'] = 'Create Invoice'; 
        $bookings = $db->table('bookings')->where('id', $id)->get()->getRow();
        $data['booking']=$bookings;
         $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }
        $data['companies_details']=$companies_details;
     
        $data['booking_type'] = $bookings->booking_type;
        $data['loading_point'] = $bookings->loading_type;
        $data['delivery_point'] = $bookings->unloading_type; 

      
        $result_quotation =  $db->table('quotation')->where(['id' => $bookings->quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = ''; 
        if (!empty($result_quotation)) {
            $status = 1;
            $result_quotation->consinor_address = get_consinor_quotoation_address($result_quotation->id);
            $result_quotation->delivery_address = get_delivery_quotoation_address($result_quotation->id);
            $result_quotation->consignor_name = get_title('consignors', ['id' => $result_quotation->consignor], 'name');
            $result_quotation->state_name = get_title('states', ['id' => $result_quotation->state_id], 'name');
            $result_quotation->districts_name = get_title('cities', ['id' => $result_quotation->district], 'name');
            $data['consignee_details'] = $db->table('pincodes')->where(['id' => $result_quotation->delivery_address_id])->get()->getRow();
            $data['consignor_details'] = $db->table('consignors')->where(['id' => $result_quotation->consignor])->get()->getRow();
            $result_quotation->dimension = $result_quotation->dimension != null ? json_decode($result_quotation->dimension) : [];
        }
        $data['result'] = $result_quotation; 
         
        $data['brokers'] = $db->table('brokers')->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->broker_id])->get()->getRow();
        $data['vehicles'] = $db->table('vehicles')->where('is_delete', 1)->where(['id' => $bookings->vehical_id])->get()->getRow();
        $data['booking_broker']=$db->table('bookings_brokers')->where(['booking_id'=>$id])->get()->getRow();
        $data['booking_consignment_number']=$db->table('booking_consignment_number')->where(['booking_id'=>$id])->get()->getResult();
          
        return view('Company/challan/print', $data);
    }

    public function getBookingDetails()
    {
        $db = \Config\Database::connect();

        $id = $this->request->getPost('id');
        $status = 0;
        $otherdata=[];
        $result_array[] = $db->table('bookings')->where('id', $id)->get()->getRow();
        $data['brokers'] = $db->table('brokers')->where(['id' => $result_array[0]->broker_id])->get()->getRow();
        $result_quotation[] =  $db->table('quotation')->where(['id' => $result_array[0]->quatation_id])->get()->getRow();
        $otherdata['bookings_brokers']=$db->table('bookings_brokers')->where('booking_id',$id)->get()->getRow();

        $otherdata['state_name'] = get_title('states', ['id' => $result_quotation[0]->state_id], 'name');
        $otherdata['district'] = $db->table('pincodes')->where(['id' => $result_quotation[0]->delivery_address_id])->get()->getRow();

        $otherdata['borkername'] =($data['brokers']) ? $data['brokers']->name : '';
        $otherdata['consinorName'] = (getConsinorName($result_array[0]->cr_id)) ? getConsinorName($result_array[0]->cr_id) : '' ;
        $otherdata['consineeName'] = (getConsineeName($result_array[0]->consignee_id)) ? getConsineeName($result_array[0]->consignee_id) : '';
        if (count($result_array) > 0) {
            $status = 1;
        }
        return json_encode(['status' => $status, 'result' => $result_array,'otherdata'=>$otherdata]);
    }

    public function getHtmlData()
    {
        // Fetch HTML data from your source (database, API, etc.)
        $htmlData = "<table><thead><tr><th>Column 1</th><th>Column 2</th></tr></thead><tbody><tr><td>Data 1</td><td>Data 2</td></tr></tbody></table>";
        
        return $this->response->setJSON(['htmlData' => $htmlData]);
    }

    public function downloadExcel($id)
{
    $db = \Config\Database::connect();
    $employee_object =new Booking();
    $data = $employee_object->findAll();
    $result_array[] = $db->table('bookings')->where('id', $id)->get()->getRow();
    $otherdata['brokers'] = $db->table('brokers')->where(['id' => $result_array[0]->broker_id])->get()->getRow();
    $result_quotation[] =  $db->table('quotation')->where(['id' => $result_array[0]->quatation_id])->get()->getRow();
    $otherdata['state_name'] = get_title('states', ['id' => $result_quotation[0]->state_id], 'name');
    $otherdata['district'] = $db->table('pincodes')->where(['id' => $result_quotation[0]->delivery_address_id])->get()->getRow();
    $otherdata['consinorName'] = (getConsinorName($result_array[0]->cr_id)) ? getConsinorName($result_array[0]->cr_id) : '' ;
    $otherdata['consineeName'] = (getConsineeName($result_array[0]->consignee_id)) ? getConsineeName($result_array[0]->consignee_id) : '';
    $file_name = 'ChallanData_'.$id.'.xlsx';

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();
////////////
    $sheet->getColumnDimension('A')->setWidth(20);
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(30);
    $sheet->getColumnDimension('D')->setWidth(20);
    $sheet->getColumnDimension('E')->setWidth(20);
    $sheet->getColumnDimension('F')->setWidth(20);
    $sheet->getColumnDimension('G')->setWidth(25);
    $sheet->getColumnDimension('H')->setWidth(20);
    $sheet->getColumnDimension('I')->setWidth(20);
    $sheet->getColumnDimension('J')->setWidth(20);
    $sheet->getColumnDimension('K')->setWidth(30);
    $sheet->getColumnDimension('L')->setWidth(30);
    $sheet->getColumnDimension('M')->setWidth(40);
    //////
    $sheet->setCellValue('A1', 'Date of Booking');

    $sheet->setCellValue('B1', 'Challan No.');

    $sheet->setCellValue('C1', 'Broker Name');

    $sheet->setCellValue('D1', 'Vehicle');
    $sheet->setCellValue('E1', 'From');

    $sheet->setCellValue('F1', 'To');

    $sheet->setCellValue('G1', 'Lorry Hire Charges');

    $sheet->setCellValue('H1', 'Advance');

    $sheet->setCellValue('I1', 'Balance');
    $sheet->setCellValue('J1', 'Cong. Note #');

    $sheet->setCellValue('K1', 'Consignor');
    $sheet->setCellValue('L1', 'Consignee');
    $sheet->setCellValue('M1', 'Remark');
    $count = 2;

    foreach($data as $row)
    {
        if($row['id'] == $id){
        $sheet->setCellValue('A' . $count, $row['date']);

        $sheet->setCellValue('B' . $count, $row['challan_number']);

        $sheet->setCellValue('C' . $count,  $otherdata['brokers']->name);

        $sheet->setCellValue('D' . $count, $row['vehical_number']);
        $sheet->setCellValue('E' . $count, $otherdata['state_name']);

        $sheet->setCellValue('F' . $count,  $otherdata['district']->District);
        $sheet->setCellValue('G' . $count, $row['total_broker_amount']);

        $sheet->setCellValue('H' . $count, $row['advance_pay']);
        $sheet->setCellValue('I' . $count, $row['booking_amount']);

        $sheet->setCellValue('J' . $count,  '');

                $sheet->setCellValue('K' . $count,$otherdata['consinorName']);
                $sheet->setCellValue('L' . $count, $otherdata['consineeName']);

                $sheet->setCellValue('M' . $count, $row['remark']);

        $count++;
        }
    }

    $writer = new Xlsx($spreadsheet);

    $writer->save($file_name);

    header("Content-Type: application/vnd.ms-excel");

    header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

    header('Expires: 0');

    header('Cache-Control: must-revalidate');

    header('Pragma: public');

    header('Content-Length:' . filesize($file_name));

    flush();

    readfile($file_name);

    exit;

}
public function saveBookingDetails()
{
    $db = \Config\Database::connect();
    $PostData= $this->request->getPost();

    $updateData=[
        'lorry_hire_charge'=> $PostData['lorry_hire_charge'],
        'detention_charge'=> $PostData['detention_charge'],
        'rto_fine'=> $PostData['rto_fine'],
        'late_delivery_charge'=> $PostData['late_delivery_charge'],
        'other_deduction_charges'=> $PostData['other_deduction_charges'],
        'advance'=> $PostData['advance'],
        'mamul_charges_A'=> $PostData['mamul_charges_A'],
        'balance'=> $PostData['balance'],
        'mamul_charges_B'=> $PostData['mamul_charges_B'],
        'balance_payabe' => $PostData['balance_payabe'],
        'advance_paid' => $PostData['advance_paid'],
        ];

    $ins_id= $db->table('bookings_brokers')->where('booking_id',  $PostData['booking_id'])->set($updateData)->update();

    if ($ins_id) {
        session()->setFlashdata('success', 'Challan Booking Detail Saved Successfully.');
        return redirect()->to(base_url('company/challan'));
    } else {
        session()->setFlashdata('error', 'Something Went Wrong.');
        return redirect()->to(previous_url());
    }
}
}