<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;  
use App\Models\Broker; 
use App\Models\Consignee; 
use App\Models\termsCondition as termcondition;
use App\Models\multiple_booking_vehical as MultipleBookingVehical;
use App\Models\booking_consignment_number as bookingConsignNumber;
use App\Models\multi_invoice_number as MultiInvoiceNumber;


class BookingInvoiceController extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Calcutta");
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {  

        $multiinvocetable =new MultiInvoiceNumber();

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
        $where['invoice_date >='] = $from_date;
        $where['invoice_date <='] = $to_date;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['title'] = 'All Bookings Invoice';
        $data['invoices'] =$db->table('invoice')->where($where)->orderBy('id', 'DESC')->get()->getResult();
        // $data['unbilled_amount'] =$db->table('bookings')->select_sum('net_amount')->where(['is_billing'=>'No'])->orderBy('id', 'DESC')->get()->getResult();
        // echo "<pre>";
        // print_r($data['unbilled_amount']);die;
        // $data['multiinvocetable']=[];
//         foreach($data['invoice'] as $key => $value){
//  $multiinvocetableData = $multiinvocetable->where(['booking_id' => $value->booking_id])->get()->getResult();
//     $data['multiinvocetable'] = array_merge($data['multiinvocetable'], $multiinvocetableData);
// }
//         $data['invoicefilter']=[];
//         foreach($data['multiinvocetable'] as $key => $value){
//     $data['invoicefilter'] =$db->table('invoice')->where($where)->where('booking_id !=',$value->booking_id)->orderBy('id', 'DESC')->get()->getResult();
//         }
        // $data['invoices'] = array_merge($data['multiinvocetable'],$data['invoicefilter']);
        // print_r($data['invoicefilter']);die;

        return view('Company/bookingInvoice/index', $data);
    }

    public function create($id){
        $broker = new Broker();
        $consignee = new Consignee();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Create Invoice';
        $bookings = $db->table('bookings')->where('id', $id)->get()->getRow();
        $data['vehical'] = $db->table('vehicles')->where('id', $bookings->vehical_id)->get()->getRow();
        $data['consign_data']=$db->table('booking_consignment_number')->where('booking_id',$id)->get()->getResultArray();
        $data['booking'] = $bookings;
        $getData['quotation_id'] = $bookings->quatation_id;
        $getData['booking_type'] = $bookings->booking_type;
        $getData['loading_point'] = $bookings->loading_type;
        $getData['delivery_point'] = $bookings->unloading_type;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $getData['quotation_id']])->get()->getRow();
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
        $data['companies_details'] = $companies_details;
        $data['booking_type'] = $getData['booking_type'];
        $data['loading_point'] = $getData['loading_point'];
        $data['delivery_point'] = $getData['delivery_point'];
        $data['quotation_id'] = $getData['quotation_id'];
        // echo $bookings->consignee_id;die;
        $data['consignee'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->consignee_id])->get()->getRow();
      
        $data['brokers'] = $broker->where('id', $bookings->broker_id)->get()->getRow(); 
        
        return view('Company/bookingInvoice/create', $data);
    }

    public function multicreate($id){
        $bookingConsignNum = new bookingConsignNumber();

        $model1 = new MultipleBookingVehical();
        $broker = new Broker();
        $consignee = new Consignee();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Create Invoice';
        $bookings = $db->table('bookings')->where('id', $id)->get()->getRow();
        $data['vehical'] = $db->table('vehicles')->where('id', $bookings->vehical_id)->get()->getRow();
        $data['consign_data']=$db->table('booking_consignment_number')->where('booking_id',$id)->get()->getResultArray();
        $data['booking'] = $bookings;
        $getData['quotation_id'] = $bookings->quatation_id;
        $getData['booking_type'] = $bookings->booking_type;
        $getData['loading_point'] = $bookings->loading_type;
        $getData['delivery_point'] = $bookings->unloading_type;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $getData['quotation_id']])->get()->getRow();
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
        $data['companies_details'] = $companies_details;
        $data['booking_type'] = $getData['booking_type'];
        $data['loading_point'] = $getData['loading_point'];
        $data['delivery_point'] = $getData['delivery_point'];
        $data['quotation_id'] = $getData['quotation_id'];
        // echo $bookings->consignee_id;die;
        $data['consignee'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->consignee_id])->get()->getRow();
        $data['consignees'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId')])->get()->getResult();
        $data['MultiBookingVehical'] = $model1->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$bookings->id])->get()->getResult();
        $data['printpage'] =count($data['MultiBookingVehical']);
        $data['bookingConsignNum'] = $bookingConsignNum->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();
        $data['brokers'] = $broker->where('id', $bookings->broker_id)->get()->getRow(); 
        $data['split_bill'] = $db->table('split_bill')->where(['booking_id'=>$id])->get()->getResult();
        if($data['loading_point'] == 'Multi Point' && $data['delivery_point'] == 'Multi Point'){
            return view('Company/bookingInvoice/multicreate', $data);
        }else if($data['loading_point'] == 'Single Point' && $data['delivery_point'] == 'Multi Point' && $data['booking_type'] == 'Paid'){
         //bill to olny one consignor and can have multiple consignee
          return view('Company/bookingInvoice/singletomulticreate', $data);
        }else if($data['loading_point'] == 'Single Point' && $data['delivery_point'] == 'Multi Point' && $data['booking_type'] == 'To Pay'){
            //olny one consignor and bill to multiple consignee
          return view('Company/bookingInvoice/singletomultiTopaycreate', $data);
              }
        else if($data['loading_point'] == 'Multi Point' && $data['delivery_point'] == 'Single Point' && $data['booking_type'] == 'Paid'){
            //bill to olny one consignor and can have multiple consignee
         return view('Company/bookingInvoice/multitosinglepadaidcreate', $data);
        }
        else if($data['loading_point'] == 'Multi Point' && $data['delivery_point'] == 'Single Point' && $data['booking_type'] == 'To Pay'){
            //bill to olny one consignor and can have multiple consignee
         return view('Company/bookingInvoice/multitosingletopaycreate', $data);
        }
    }

    public function store(){
        $multiinvocetable =new MultiInvoiceNumber();
        $formData = $this->request->getPost();
        $db = \Config\Database::connect();
        if($formData){
            // print_r($formData);die;
         $booking_id=$formData['booking_id']; 
         $remark=$formData['remark']; 
       
         $booking=$db->table('bookings')->where(['id'=>$booking_id])->get()->getRow();
        //  if($booking->loading_type =='Single Point' && $booking->unloading_type == 'Single Point'){
            $invoice_number=getVoucherNumber('Invoice'); 
        //   }else{
        //     $invoice_number = json_encode($formData['multiinvoiceNumber']);
        //   }
         $invoiceData=[ 
            'freight_charge'=>$formData['freight_charge'],
            'total_amount'=>$formData['total_amount'],
            'remark'=>$remark,
            'booking_id'=>$booking->id, 
            'billing_customer_id'=>$booking->billingCustomerId, 
            'invoice_number'=>$invoice_number, 
            'invoice_date'=>date('Y-m-d h:i:s'),
            'booking_type'=>$booking->booking_type, 
            'loading_type'=>$booking->loading_type, 
            'unloading_type'=>$booking->unloading_type, 
            // 'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),

            'total_sgst'=>$formData['total_sgst'],
            'total_cgst'=>$formData['total_cgst'],
            'total_igst'=>$formData['total_igst'],
            'amount_words'=>$formData['amount_in_word'], 
         ];  
         $ins_id= $db->table('invoice')->insert($invoiceData);  
         $lastInsertID = $db->insertID();

        if(isset($formData['multiinvoiceNumber'])){

            // print_r($formData['multiinvoiceNumber']);die;
            foreach($formData['multiinvoiceNumber'] as $key => $value){

            $invoicemultiData=[ 
                'invoice_id'=> $lastInsertID,
                'invoice_number'=>$formData['multiinvoiceNumber'][$key],
                'invoiceindex'=>$formData['invoiceindex'][$key],
                'name'=>'Invoice',
                'booking_id' =>$formData['booking_id'],
                'comp_id' => session()->get('CompId'),
    
             ];  
             //  for updateVoucherNumber here add insert query
             updateVoucherNumber('Invoice'); 

             $multiinvocetable->insert($invoicemultiData);

            }
        }else{
            updateVoucherNumber('Invoice'); 

        }


         if ($ins_id) {

             $update=[
                'is_billing'=>'YES',
             ];
             $db->table('bookings')->where(['id'=>$formData['booking_id']])->set($update)->update(); 
             session()->setFlashdata('success', 'Invoices Created Successfully.');
             return redirect()->to(base_url('company/invoices'));
         } else {
             session()->setFlashdata('error', 'Something Went Wrong.');
             return redirect()->to(previous_url());
         }

        }
    }

    public function print($id){
        $broker = new Broker();
        $model = new termcondition();

        $consignee = new Consignee();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Create Invoice';
        $invoice = $db->table('invoice')->where('id', $id)->get()->getRow();
        $data['invoice']=$invoice;
        $bookings = $db->table('bookings')->where('id', $invoice->booking_id)->get()->getRow();
        $data['booking']=$bookings;
        $data['consign_data']=$db->table('booking_consignment_number')->where('booking_id',$invoice->booking_id)->get()->getResultArray();
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }
        $data['companies_details']=$companies_details;
     
        $data['booking_type'] = $invoice->booking_type;
        $data['loading_point'] = $invoice->loading_type;
        $data['delivery_point'] = $invoice->unloading_type; 

      
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
        $data['consignee'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->consignee_id])->get()->getRow();
      
        $data['terms'] = $model->where('voucher_id', getVoucherName('Invoice'))->where('comp_id',session()->get('CompId'))->get()->getRow();
      
        return view('Company/bookingInvoice/print', $data);
    }

    public function multiprint($id){
        $bookingConsignNum = new bookingConsignNumber();
        $model = new termcondition();
        $multiinvocetable =new MultiInvoiceNumber();

        $model1 = new MultipleBookingVehical();
        $broker = new Broker();
        $consignee = new Consignee();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $invoice = $db->table('invoice')->where('id', $id)->get()->getRow();
        $boolinkgid = $invoice->booking_id;
        $data['title'] = 'Create Invoice';
        $bookings = $db->table('bookings')->where('id', $boolinkgid)->get()->getRow();
        $data['vehical'] = $db->table('vehicles')->where('id', $bookings->vehical_id)->get()->getRow();
        $data['consign_data']=$db->table('booking_consignment_number')->where('booking_id',$boolinkgid)->get()->getResultArray();
        $data['booking'] = $bookings;
        $getData['quotation_id'] = $bookings->quatation_id;
        $getData['booking_type'] = $bookings->booking_type;
        $getData['loading_point'] = $bookings->loading_type;
        $getData['delivery_point'] = $bookings->unloading_type;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $getData['quotation_id']])->get()->getRow();
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
        $data['companies_details'] = $companies_details;
        $data['booking_type'] = $getData['booking_type'];
        $data['loading_point'] = $getData['loading_point'];
        $data['delivery_point'] = $getData['delivery_point'];
        $data['quotation_id'] = $getData['quotation_id'];
        // echo $bookings->consignee_id;die;
        $data['consignee'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->consignee_id])->get()->getRow();
        $data['consignees'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId')])->get()->getResult();
        $data['MultiBookingVehical'] = $model1->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$bookings->id])->get()->getResult();
        $data['printpage'] =count($data['MultiBookingVehical']);
        $data['bookingConsignNum'] = $bookingConsignNum->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$boolinkgid])->get()->getResult();
        $data['brokers'] = $broker->where('id', $bookings->broker_id)->get()->getRow(); 
        $data['split_bill'] = $db->table('split_bill')->where(['booking_id'=>$boolinkgid])->get()->getResult();
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }
        $data['companies_details']=$companies_details;
        $data['terms'] = $model->where('voucher_id', getVoucherName('Invoice'))->where('comp_id',session()->get('CompId'))->get()->getRow();

        $data['multiinvocetable'] =  $multiinvocetable->where('booking_id', $boolinkgid)->get()->getResult();


        if($data['loading_point'] == 'Multi Point' && $data['delivery_point'] == 'Multi Point'){
            return view('Company/bookingInvoice/multiprint', $data);
        }else if($data['loading_point'] == 'Single Point' && $data['delivery_point'] == 'Multi Point' && $data['booking_type'] == 'Paid'){
            //bill to olny one consignor and can have multiple consignee
            return view('Company/bookingInvoice/singletomultiprint', $data);
        }else if($data['loading_point'] == 'Single Point' && $data['delivery_point'] == 'Multi Point' && $data['booking_type'] == 'To Pay'){
            return view('Company/bookingInvoice/singletomultitopayprint', $data);
        } else if($data['loading_point'] == 'Multi Point' && $data['delivery_point'] == 'Single Point' && $data['booking_type'] == 'Paid'){
            return view('Company/bookingInvoice/multitosinglepaidprint', $data);
        }else if($data['loading_point'] == 'Multi Point' && $data['delivery_point'] == 'Single Point' && $data['booking_type'] == 'To Pay'){
            return view('Company/bookingInvoice/multitosingletoPayprint', $data);
        }

    }
}