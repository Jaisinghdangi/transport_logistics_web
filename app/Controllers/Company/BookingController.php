<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\State;
use App\Models\Broker;
use App\Models\BusinessType;
use App\Models\Consignee;
use App\Models\Consignor;

use App\Models\consignorNumber as consignorNum;
use App\Models\booking_consignment_number as bookingConsignNumber;
use App\Models\multiple_booking_vehical as MultipleBookingVehical;
use App\Models\vehicalType;


class BookingController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $where['is_delete'] = 0;
        $where['comp_id'] =session()->get('CompId');
        $currentDate = new \DateTime();
        $currentDate->modify('first day of this month');
        $firstDateOfMonth = $currentDate->format('Y-m-d');
        $from_date =  $firstDateOfMonth;  //date('Y-m-d');
        $to_date = date('Y-m-d');

        $currentFY= getFinancialYear(session()->get('FinancialYear'));

        if ($_GET) {
            $currentFY=$_GET['from_date'];

            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
        }
        $where['date >='] = $from_date;
        $where['date <='] = $to_date;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;

        $booking = new Booking();
        $data['title'] = 'All Bookings';
        $data['bookings'] = $booking->where($where)->orderBy('id', 'DESC')->get()->getResult();

        $builder = $booking->where(['date >=' =>$currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'broker_id !='=>'0'])->get()->getResult();
        $data['linkBroker']= count($builder);

        $builder = $booking->where(['date >=' =>$currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_vehicalPlaced !='=>'0'])->get()->getResult();
        $data['linkVehicle']= count($builder);

        $builder = $booking->where(['date >=' =>$currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_billing'=>'NO'])->get()->getResult();
        $data['bookingPending']= count($builder);

        $builder = $booking->where(['date >=' => $currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_billing'=>'YES'])->get()->getResult();
        $data['bookingCompleted']= count($builder);

        return view('Company/booking/index', $data);
    }
    public function add()
    {
        $model = new vehicalType();

        $broker = new Broker();
        $getData = $this->request->getGet();
        if(!array_key_exists('quotation_id',$getData)){
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
        $db = \Config\Database::connect();
        $data['title'] = 'Add Brokers';

        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $getData['quotation_id']])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['brokers'] = $broker->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['VehicalType'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();

        return view('Company/booking/create', $data);
    }

    public function store()
    {
        $formData = $this->request->getPost();

        $db = \Config\Database::connect();
        $quotation_details = $db->table('quotation')->where(['id' => $formData['quotation_id']])->get()->getRow();
        if (!empty($quotation_details)) {
            $quatation_data = [
                'quotationNumber' => $quotation_details->quotation_number,
                'cr_id' => $quotation_details->consignor,
                'cr_country' => $quotation_details->country,
                'cr_state_id' => $quotation_details->state_id,
                'cr_district' => $quotation_details->district,
                'cr_address' => $quotation_details->consignor_local_address,
                'ce_pincode' => $quotation_details->pincode,
                'ce_pincode_id' => $quotation_details->delivery_address_id,
                'ce_address' => $quotation_details->local_delivery_address,
                'quotation_date' => $quotation_details->quotation_date,
                'estmate_deliv_dt' => $quotation_details->estmate_deliv_dt,
                'amount_in_word' => $quotation_details->amount_in_word,
                'dimension' => $quotation_details->dimension,
                'remark' => $quotation_details->remark,
            ];
        }
        $booking = new Booking();
        $data = [
            'quatation_id' => $formData['quotation_id'],
            'booking_no' => $formData['booking_number'],
            'date' => date('Y-m-d'),
            'booking_type' => $formData['booking_type'],
            'loading_type' => $formData['loading_point'],
            'unloading_type' => $formData['delivery_point'],
            'booking_amount' => $quotation_details->amount,
            'financial_year' => session()->get('FinancialYear'),
            'broker_id' => $formData['broker_id'],
            'total_broker_amount' => $formData['total_broker_amount'],
            'rto_fine'=>$formData['rto_fine'],
            'advance_pay'=>$formData['advance_pay'],
            'statical_charge'=>$formData['statical_charge'],
            'detention_charge_loading'=>$formData['detention_charge_loading'],
            'detention_charge_unloading'=>$formData['detention_charge_unloading'],
            'total_payable'=>$formData['total_payable'],
            'total_cgst'=>$formData['total_cgst'],
            'total_sgst'=>$formData['total_sgst'],
            'total_igst'=>$formData['total_igst'],
            'net_amount'=>$formData['net_amount'],
            'updated' => 0,
            'is_delete' => 0,
            'status' => 1,
            'vehicle_type' =>$formData['vehicle_type'],
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];


        if (!empty($quotation_details)) {
            $data = array_merge($data, $quatation_data);
        } 

        if ($formData['booking_type'] == 'Paid') {
            $data['billingCustomerId'] = $data['cr_id'];
        }
        // print_r($data);die;
        $ins_id = $booking->insert($data);
        $booking_id=$booking->getInsertID();


        $broker_booking=[
            'booking_id'=>$booking_id,
            'booking_no'=>$formData['booking_number'],
            'broker_id'=>$formData['broker_id'],
            'lorry_hire_charge'=>$formData['total_broker_amount'],
            'rto_fine'=>$formData['broker_rto_fine'],
            'rto_fine_date'=>'',
            'late_delivery_charge'=>$formData['late_delivery_charges'],
            'detention_charge'=>$formData['detention_charges'],
            'advance'=>$formData['advance'],
            'mamul_charges_A'=>$formData['mamul_chargesa'],
            'advance_payable'=>$formData['advance_payable'],
            'advance_paid'=>$formData['advance_paid'],
            'balance'=>$formData['total_balance'],
            'mamul_charges_B'=>$formData['mamul_chargesb'],
            'balance_payabe'=>$formData['balance_payable'],
            'balance_paid'=>$formData['balance_paid'],
            'other_deduction_charges'=>$formData['other_deduction_charges'],
           ];  
           $status=$db->table('bookings_brokers')->insert($broker_booking);
         

 
        $db->table('quotation')->where('id',$formData['quotation_id'])->set(['is_booked'=>1])->update();
        updateVoucherNumber('Booking'); 
        if ($ins_id) {
            session()->setFlashdata('success', 'Booking Created Successfully.');
            return redirect()->to(base_url('company/booking'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }

    public function setVehical($id)
    {
        $model = new consignorNum();
        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        $data['bookingConsignNum'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->get()->getResult();
       
        if(empty($data['ConsignNumberValue'])){
            session()->setFlashdata('success', 'Kindly Set Company Consignor Number. Required!.');
           return redirect()->to(base_url('company/add-company-consignor-number')); 
        }else{
            return view('Company/booking/vehicalPlacement', $data);
        }
        // echo "<pre>";
        //  print_r($data);die;
    }

    public function setmultipointVehical($id)
    {
        $model = new consignorNum();
        
        $Consignor = new Consignor();

        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['consignorr'] = $Consignor->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();

         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        $data['bookingConsignNum'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->get()->getResult();
       
        // echo "<pre>";
        //  print_r($data);die;
        if(empty($data['ConsignNumberValue'])){
            session()->setFlashdata('success', 'Kindly Set Company Consignor Number. Required!.');
           return redirect()->to(base_url('company/add-company-consignor-number')); 
        }else{
            return view('Company/booking/multipointvehicalPlacement', $data);
        }
    }

    public function setSingleToMultiVehical($id)
    {
        $model = new consignorNum();
        
        $Consignor = new Consignor();

        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['consignorr'] = $Consignor->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();

         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        $data['bookingConsignNum'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->get()->getResult();
       
        // echo "<pre>";
        //  print_r($data);die;
        if(empty($data['ConsignNumberValue'])){
            session()->setFlashdata('success', 'Kindly Set Company Consignor Number. Required!.');
           return redirect()->to(base_url('company/add-company-consignor-number')); 
        }else{
            return view('Company/booking/singleTomultiVehical', $data);
        }
    }


    public function setMultiToSingleVehical($id)
    {
        $model = new consignorNum();
        
        $Consignor = new Consignor();

        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['consignorr'] = $Consignor->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();

         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        $data['bookingConsignNum'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->get()->getResult();
       
        // echo "<pre>";
        //  print_r($data);die;
        if(empty($data['ConsignNumberValue'])){
            session()->setFlashdata('success', 'Kindly Set Company Consignor Number. Required!.');
           return redirect()->to(base_url('company/add-company-consignor-number')); 
        }else{
            return view('Company/booking/multitosinglevehical', $data);
        }
    }


    public function saveMultiPointBookingVehical()
    {
        $model1 = new MultipleBookingVehical();

        $formData = $this->request->getPost();
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        if ($formData['vehical_id'] > 0) {
            $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $formData['vehical_id'],
                'driver_name' => $vehical->driver_name,
                'driver_address' => $vehical->driver_address,
                'driver_mobile' => $vehical->driver_mobile,
                'driving_licence_no' => $vehical->driving_licence_no,
                'driving_validity' => $vehical->licence_validity,
                'owner_name' => $vehical->owner_name,
                'owner_address' => $vehical->owner_address,
                'owner_mobile' => $vehical->owner_mobile,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                // 'eway_bill'=>'',
                // 'eway_bill_date'=>'',
                // 'eway_bill_expire'=>'',
                'is_vehicalPlaced'=>1,
            ];

            // if($formData['booking_type']=='To Pay'){
            //   $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            // }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$db->insertID();
        } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->insert($vehical_data);
            $id = $db->insertID();
       

            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                // 'eway_bill'=>$formData['eway_bill'],
                // 'eway_bill_date'=>$formData['eway_bill_date'],
                // 'eway_bill_expire'=>$formData['eway_bill_expire'],
            ];

            // if($formData['booking_type']=='To Pay'){
            //     $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            //   }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        }
        $consignment_numbers = $formData['consignorr_id'];

        // booking consign number start
        foreach($formData['consign_number'] as $key=>$consigment_number){

        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
           // 'consign_date' => $formData['consign_date'][$key],
            'consignor_id' => $formData['consign_consignor_id'][$key], //$formData['consignorr_id'][$key],
            'consignee_id' => $formData['consign_consignee_id'][$key],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
    // }
    $db->table('booking_consignment_number')->insert($consigment_data);

       }
/////////
  

       foreach($formData['consignorr_id'] as $key=>$consignorr_id){
        $consignors_data = [
            'consignor_id' => $formData['consignorr_id'][$key],
            'consignee_id' => $formData['consignee_id'][$key],
            'consign_date'  => $formData['consign_date'][$key],
            // 'eway_bill'=>$formData['eway_bill'][$key],
            // 'eway_bill_date'=>$formData['eway_bill_date'][$key],
            // 'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'booking_id' => $formData['booking_id'],
            'comp_id' => session()->get('CompId'),
        ];
        $model1->insert($consignors_data);
       }

        $id = $db->insertID();
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical Added Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }


    public function saveSingleToMultiVehical()
    {
        $model1 = new MultipleBookingVehical();

        $formData = $this->request->getPost();
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        if ($formData['vehical_id'] > 0) {
            $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $formData['vehical_id'],
                'driver_name' => $vehical->driver_name,
                'driver_address' => $vehical->driver_address,
                'driver_mobile' => $vehical->driver_mobile,
                'driving_licence_no' => $vehical->driving_licence_no,
                'driving_validity' => $vehical->licence_validity,
                'owner_name' => $vehical->owner_name,
                'owner_address' => $vehical->owner_address,
                'owner_mobile' => $vehical->owner_mobile,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                
                'is_vehicalPlaced'=>1,
            ];

            // if($formData['booking_type']=='To Pay'){
            //   $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            // }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$db->insertID();
        } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->insert($vehical_data);
            $id = $db->insertID();
       

            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
               
            ];

            // if($formData['booking_type']=='To Pay'){
            //     $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            //   }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        }
        $consignment_numbers = $formData['consignorr_id'];

        // booking consign number start
        foreach($formData['consign_number'] as $key=>$consigment_number){

        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
           // 'consign_date' => $formData['consign_date'][$key],
            'consignor_id' => $formData['consignorr_id'], //$formData['consignorr_id'][$key],
            'consignee_id' => $formData['consign_consignee_id'][$key],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
    // }
    $db->table('booking_consignment_number')->insert($consigment_data);

       }
/////////
  

       foreach($formData['consignee_id'] as $key=>$consignorr_id){
        $consignors_data = [
            'consignor_id' => $formData['consignorr_id'],
            'consignee_id' => $formData['consignee_id'][$key],
            'consign_date'  => $formData['consign_date'][$key],
            // 'eway_bill'=>$formData['eway_bill'][$key],
            // 'eway_bill_date'=>$formData['eway_bill_date'][$key],
            // 'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'booking_id' => $formData['booking_id'],
            'comp_id' => session()->get('CompId'),
        ];
        $model1->insert($consignors_data);
       }

        $id = $db->insertID();
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical Added Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }

    public function saveMultiToSingleVehical()
    {
        $model1 = new MultipleBookingVehical();

        $formData = $this->request->getPost();
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        if ($formData['vehical_id'] > 0) {
            $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $formData['vehical_id'],
                'driver_name' => $vehical->driver_name,
                'driver_address' => $vehical->driver_address,
                'driver_mobile' => $vehical->driver_mobile,
                'driving_licence_no' => $vehical->driving_licence_no,
                'driving_validity' => $vehical->licence_validity,
                'owner_name' => $vehical->owner_name,
                'owner_address' => $vehical->owner_address,
                'owner_mobile' => $vehical->owner_mobile,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
               
                'is_vehicalPlaced'=>1,
            ];

            if($formData['booking_type']=='To Pay'){
              $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$db->insertID();
        } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->insert($vehical_data);
            $id = $db->insertID();
       

            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
               
            ];

            if($formData['booking_type']=='To Pay'){
                $bookingVehical['billingCustomerId']=$formData['consignee_id'];
              }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        }
        $consignment_numbers = $formData['consignorr_id'];

        // booking consign number start
        foreach($formData['consign_number'] as $key=>$consigment_number){

        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
           // 'consign_date' => $formData['consign_date'][$key],
            'consignor_id' => $formData['consign_consignor_id'][$key], //$formData['consignorr_id'][$key],
            'consignee_id' => $formData['consignee_id'],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
    // }
    $db->table('booking_consignment_number')->insert($consigment_data);

       }
/////////
  

       foreach($formData['consignorr_id'] as $key=>$consignorr_id){
        $consignors_data = [
            'consignor_id' => $formData['consignorr_id'][$key],
            'consignee_id' => $formData['consignee_id'],
            'consign_date'  => $formData['consign_date'][$key],
            // 'eway_bill'=>$formData['eway_bill'][$key],
            // 'eway_bill_date'=>$formData['eway_bill_date'][$key],
            // 'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'booking_id' => $formData['booking_id'],
            'comp_id' => session()->get('CompId'),
        ];
        $model1->insert($consignors_data);
       }

        $id = $db->insertID();
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical Added Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }




    public function getConsigneeDetails()
    {
        $db = \Config\Database::connect();
        $consignee_id = $this->request->getPost('id');
        $consignee = $db->table('consignees')->where(['id' => $consignee_id])->where('comp_id', session()->get('CompId'))->orderBy('name', 'ASC')->get()->getRow();
        $status = 0;
        if (!empty($consignee)) {

            $consignee->country_name = get_title('countries', ['id' => $consignee->country], 'name');
            $consignee->state_name = get_title('states', ['id' => $consignee->state], 'name');
            $consignee->district_name = get_title('cities', ['id' => $consignee->district], 'name');

            $consignee->delivery_address =$consignee->district_name.' , '. $consignee->state_name.' , '.$consignee->country_name;
            $status = 1;
        }
        return json_encode(['status' => $status, 'result' => $consignee]);
    }

    public function getConsignorDetails()
    {
        $db = \Config\Database::connect();
        $consignee_id = $this->request->getPost('id');
        $consignee = $db->table('consignors')->where(['id' => $consignee_id])->where('comp_id', session()->get('CompId'))->orderBy('name', 'ASC')->get()->getRow();
        $status = 0;
        if (!empty($consignee)) {

            $consignee->country_name = get_title('countries', ['id' => $consignee->country], 'name');
            $consignee->state_name = get_title('states', ['id' => $consignee->state], 'name');
            $consignee->district_name = get_title('cities', ['id' => $consignee->district], 'name');

            $consignee->delivery_address =$consignee->district_name.' , '. $consignee->state_name.' , '.$consignee->country_name;
            $status = 1;
        }
        return json_encode(['status' => $status, 'result' => $consignee]);
    }
    public function getVehicalDetails()
    {
        $db = \Config\Database::connect();
        $vehical_number = $this->request->getPost('vehical_number');
        $vehical = $db->table('vehicles')->where(['vehicle_number' => $vehical_number])->orderBy('vehicle_number', 'ASC')->get()->getRow();
        $status = 0;
        if (!empty($vehical)) {
            $status = 1;
        }
        return json_encode(['status' => $status, 'result' => $vehical]);
    }
    public function addBookingVehical()
    {
        $formData = $this->request->getPost();
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        if ($formData['vehical_id'] > 0) {
            $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            $bookingVehical = [
                'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $formData['vehical_id'],
                'driver_name' => $vehical->driver_name,
                'driver_address' => $vehical->driver_address,
                'driver_mobile' => $vehical->driver_mobile,
                'driving_licence_no' => $vehical->driving_licence_no,
                'driving_validity' => $vehical->licence_validity,
                'owner_name' => $vehical->owner_name,
                'owner_address' => $vehical->owner_address,
                'owner_mobile' => $vehical->owner_mobile,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                // 'eway_bill'=>$formData['eway_bill'],
                // 'eway_bill_date'=>$formData['eway_bill_date'],
                // 'eway_bill_expire'=>$formData['eway_bill_expire'],
                'is_vehicalPlaced'=>1,
            ];

            if($formData['booking_type']=='To Pay'){
              $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$db->insertID();
        } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->insert($vehical_data);
            $id = $db->insertID();
       

            $bookingVehical = [
                'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                // 'eway_bill'=>$formData['eway_bill'],
                // 'eway_bill_date'=>$formData['eway_bill_date'],
                // 'eway_bill_expire'=>$formData['eway_bill_expire'],
            ];

            if($formData['booking_type']=='To Pay'){
                $bookingVehical['billingCustomerId']=$formData['consignee_id'];
              }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        }


        // booking consign number start
        foreach($formData['consign_number'] as $key=>$consigment_number){
        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
            'consign_date' => $formData['consign_date'],
            'consignor_id' => 1,
            'consignee_id' => $formData['consignee_id'],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
        $db->table('booking_consignment_number')->insert($consigment_data);
       }
        $id = $db->insertID();
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical Added Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }

    public function updatemultipointVehical($id)
    {
        $model1 = new MultipleBookingVehical();

        $formData = $this->request->getPost();
        // var_dump($formData);die;
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        // if ($formData['vehical_id'] > 0) {
            // $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            // $bookingVehical = [
            //     // 'consignee_id' => $formData['consignee_id'],
            //     'vehical_number' => $formData['vehical_number'],
            //     'vehical_id' => $formData['vehical_id'],
            //     'driver_name' => $formData['driver_name'],
            //     'driver_address' => $vehical->driver_address,
            //     'driver_mobile' =>$formData['driver_mobile'],
            //     'driving_licence_no' => $vehical->driving_licence_no,
            //     'driving_validity' => $vehical->licence_validity,
            //     'owner_name' => $vehical->owner_name,
            //     'owner_address' => $vehical->owner_address,
            //     'owner_mobile' => $vehical->owner_mobile,
            //     'challan_number'=>$formData['challan_number'],
            //     'challan_date'=>$formData['challan_date'],
            //     'eway_bill'=>$formData['eway_bill'],
            //     'eway_bill_date'=>$formData['eway_bill_date'],
            //     'eway_bill_expire'=>$formData['eway_bill_expire'],
            //     'is_vehicalPlaced'=>1,
            // ];

            // if($formData['booking_type']=='To Pay'){
            //   $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            // }  
            // $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            // $booking_id=$db->insertID();
        // } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->where('id', $formData['vehical_id'])->set($vehical_data)->update();
            $id =  $formData['vehical_id'];
       
            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                // 'eway_bill'=>$formData['eway_bill'],
                // 'eway_bill_date'=>$formData['eway_bill_date'],
                // 'eway_bill_expire'=>$formData['eway_bill_expire'],
            ];

            // if($formData['booking_type']=='To Pay'){
            //     $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            //   }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        // }

        // booking consign number start
        // var_dump($formData['booking_id']); die;
    $id_dlt= $db->table('booking_consignment_number')->where('booking_id', $formData['booking_id'])->delete();
if($id_dlt){

    foreach($formData['consign_number'] as $key=>$consigment_number){

        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
           // 'consign_date' => $formData['consign_date'][$key],
            'consignor_id' => $formData['consign_consignor_id'][$key], //$formData['consignorr_id'][$key],
            'consignee_id' => $formData['consign_consignee_id'][$key],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
    // }
    $db->table('booking_consignment_number')->insert($consigment_data);

       }
    }
       // var_dump($formData['booking_id']); die;
       $id_dltnew=  $model1->where('booking_id', $formData['booking_id'])->delete();
       if($id_dltnew){
    foreach($formData['consignorr_id'] as $key=>$consignorr_id){
        $consignors_data = [
            'consignor_id' => $formData['consignorr_id'][$key],
            'consignee_id' => $formData['consignee_id'][$key],
            'consign_date'  => $formData['consign_date'][$key],
            // 'eway_bill'=>$formData['eway_bill'][$key],
            // 'eway_bill_date'=>$formData['eway_bill_date'][$key],
            // 'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'booking_id' => $formData['booking_id'],
            'comp_id' => session()->get('CompId'),
        ];
        $model1->insert($consignors_data);
       }
    }
        // $id = $db->insertID();
    $id = $formData['booking_id'];
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical update Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }

    public function updateMultiToSingleVehical($id)
    {
        $model1 = new MultipleBookingVehical();

        $formData = $this->request->getPost();
        // var_dump($formData);die;
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        // if ($formData['vehical_id'] > 0) {
            // $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            // $bookingVehical = [
            //     // 'consignee_id' => $formData['consignee_id'],
            //     'vehical_number' => $formData['vehical_number'],
            //     'vehical_id' => $formData['vehical_id'],
            //     'driver_name' => $formData['driver_name'],
            //     'driver_address' => $vehical->driver_address,
            //     'driver_mobile' =>$formData['driver_mobile'],
            //     'driving_licence_no' => $vehical->driving_licence_no,
            //     'driving_validity' => $vehical->licence_validity,
            //     'owner_name' => $vehical->owner_name,
            //     'owner_address' => $vehical->owner_address,
            //     'owner_mobile' => $vehical->owner_mobile,
            //     'challan_number'=>$formData['challan_number'],
            //     'challan_date'=>$formData['challan_date'],
            //     'eway_bill'=>$formData['eway_bill'],
            //     'eway_bill_date'=>$formData['eway_bill_date'],
            //     'eway_bill_expire'=>$formData['eway_bill_expire'],
            //     'is_vehicalPlaced'=>1,
            // ];

            // if($formData['booking_type']=='To Pay'){
            //   $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            // }  
            // $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            // $booking_id=$db->insertID();
        // } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->where('id', $formData['vehical_id'])->set($vehical_data)->update();
            $id =  $formData['vehical_id'];
       
            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                
            ];

            if($formData['booking_type']=='To Pay'){
                $bookingVehical['billingCustomerId']=$formData['consignee_id'];
              }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        // }

        // booking consign number start
        // var_dump($formData['booking_id']); die;
    $id_dlt= $db->table('booking_consignment_number')->where('booking_id', $formData['booking_id'])->delete();
if($id_dlt){

    foreach($formData['consign_number'] as $key=>$consigment_number){

        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
           // 'consign_date' => $formData['consign_date'][$key],
            'consignor_id' => $formData['consign_consignor_id'][$key], //$formData['consignorr_id'][$key],
            'consignee_id' => $formData['consignee_id'],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
    // }
    $db->table('booking_consignment_number')->insert($consigment_data);

       }
    }
       // var_dump($formData['booking_id']); die;
       $id_dltnew=  $model1->where('booking_id', $formData['booking_id'])->delete();
       if($id_dltnew){
    foreach($formData['consignorr_id'] as $key=>$consignorr_id){
        $consignors_data = [
            'consignor_id' => $formData['consignorr_id'][$key],
            'consignee_id' => $formData['consignee_id'],
            'consign_date'  => $formData['consign_date'][$key],
            // 'eway_bill'=>$formData['eway_bill'][$key],
            // 'eway_bill_date'=>$formData['eway_bill_date'][$key],
            // 'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'booking_id' => $formData['booking_id'],
            'comp_id' => session()->get('CompId'),
        ];
        $model1->insert($consignors_data);
       }
    }
        // $id = $db->insertID();
    $id = $formData['booking_id'];
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical update Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }


    public function updateSingleToMultiVehical($id)
    {
        $model1 = new MultipleBookingVehical();

        $formData = $this->request->getPost();
        // var_dump($formData);die;
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        // if ($formData['vehical_id'] > 0) {
            // $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            // $bookingVehical = [
            //     // 'consignee_id' => $formData['consignee_id'],
            //     'vehical_number' => $formData['vehical_number'],
            //     'vehical_id' => $formData['vehical_id'],
            //     'driver_name' => $formData['driver_name'],
            //     'driver_address' => $vehical->driver_address,
            //     'driver_mobile' =>$formData['driver_mobile'],
            //     'driving_licence_no' => $vehical->driving_licence_no,
            //     'driving_validity' => $vehical->licence_validity,
            //     'owner_name' => $vehical->owner_name,
            //     'owner_address' => $vehical->owner_address,
            //     'owner_mobile' => $vehical->owner_mobile,
            //     'challan_number'=>$formData['challan_number'],
            //     'challan_date'=>$formData['challan_date'],
            //     'eway_bill'=>$formData['eway_bill'],
            //     'eway_bill_date'=>$formData['eway_bill_date'],
            //     'eway_bill_expire'=>$formData['eway_bill_expire'],
            //     'is_vehicalPlaced'=>1,
            // ];

            // if($formData['booking_type']=='To Pay'){
            //   $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            // }  
            // $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            // $booking_id=$db->insertID();
        // } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->where('id', $formData['vehical_id'])->set($vehical_data)->update();
            $id =  $formData['vehical_id'];
       
            $bookingVehical = [
                // 'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
               
            ];

            // if($formData['booking_type']=='To Pay'){
            //     $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            //   }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        // }

        // booking consign number start
        // var_dump($formData['booking_id']); die;
    $id_dlt= $db->table('booking_consignment_number')->where('booking_id', $formData['booking_id'])->delete();
if($id_dlt){

    foreach($formData['consign_number'] as $key=>$consigment_number){

        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
           // 'consign_date' => $formData['consign_date'][$key],
            'consignor_id' => $formData['consignorr_id'], //$formData['consignorr_id'][$key],
            'consignee_id' => $formData['consign_consignee_id'][$key],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
    // }
    $db->table('booking_consignment_number')->insert($consigment_data);

       }
    }
       // var_dump($formData['booking_id']); die;
       $id_dltnew=  $model1->where('booking_id', $formData['booking_id'])->delete();
       if($id_dltnew){
    foreach($formData['consignee_id'] as $key=>$consignorr_id){
        $consignors_data = [
            'consignor_id' => $formData['consignorr_id'],
            'consignee_id' => $formData['consignee_id'][$key],
            'consign_date'  => $formData['consign_date'][$key],
            // 'eway_bill'=>$formData['eway_bill'][$key],
            // 'eway_bill_date'=>$formData['eway_bill_date'][$key],
            // 'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'booking_id' => $formData['booking_id'],
            'comp_id' => session()->get('CompId'),
        ];
        $model1->insert($consignors_data);
       }
    }
        // $id = $db->insertID();
    $id = $formData['booking_id'];
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical update Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }



    public function updateVehical($id)
    {
        $formData = $this->request->getPost();
        // var_dump($formData);die;
        $db = \Config\Database::connect();
        $status = 0; 
        $booking_id=0;
        // if ($formData['vehical_id'] > 0) {
            $vehical = $db->table('vehicles')->where(['id' => $formData['vehical_id']])->orderBy('vehicle_number', 'ASC')->get()->getRow();
            $bookingVehical = [
                'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $formData['vehical_id'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $vehical->driver_address,
                'driver_mobile' =>$formData['driver_mobile'],
                'driving_licence_no' => $vehical->driving_licence_no,
                'driving_validity' => $vehical->licence_validity,
                'owner_name' => $vehical->owner_name,
                'owner_address' => $vehical->owner_address,
                'owner_mobile' => $vehical->owner_mobile,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                // 'eway_bill'=>$formData['eway_bill'],
                // 'eway_bill_date'=>$formData['eway_bill_date'],
                // 'eway_bill_expire'=>$formData['eway_bill_expire'],
                'is_vehicalPlaced'=>1,
            ];

            if($formData['booking_type']=='To Pay'){
              $bookingVehical['billingCustomerId']=$formData['consignee_id'];
            }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$db->insertID();
        // } else {
            $vehical_data = [
                'make' => $formData['vehical_Make'],
                'model_number' => $formData['vehical_Modal'],
                'color' => $formData['vehical_colour'],
                'chassis_number' => $formData['vehical_chassis_no'],
                'engine_number' => $formData['vehical_engine_no'],
                'tax_token' => $formData['vehical_tax_token'],
                'road_permmit' => $formData['vehical_road_permit_no'],
                'fitness_validity' => $formData['vehical_fitness_validity'],
                'finance_country' => $formData['vehical_insured_from'],
                'insurance_date' => $formData['vehical_date_of_insurance'],
                'insurance_by' => $formData['vehical_insured_by'],
                'certificate' => $formData['vehical_certificate'],
                'division_number' => $formData['vehical_division_no'],
                'financed_by' => $formData['vehical_financers_name'],
                'financed_address' => $formData['vehical_financers_address'],
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'licence_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_mobile' => $formData['owner_mobile'],
                'owner_address' => $formData['vehical_address'],
                'vehicle_number' => $formData['vehical_number'],
                'created' => current_time(),
                //   'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
            ];

            $db->table('vehicles')->where('id', $formData['vehical_id'])->set($vehical_data)->update();
            $id =  $formData['vehical_id'];
       
            $bookingVehical = [
                'consignee_id' => $formData['consignee_id'],
                'vehical_number' => $formData['vehical_number'],
                'vehical_id' => $id,
                'driver_name' => $formData['driver_name'],
                'driver_address' => $formData['driver_address'],
                'driver_mobile' => $formData['driver_mobile'],
                'driving_licence_no' => $formData['driving_license'],
                'driving_validity' => $formData['license_validity'],
                'owner_name' => $formData['vehical_owner_name'],
                'owner_address' => $formData['vehical_address'],
                'owner_mobile' => $formData['owner_mobile'],
                'is_vehicalPlaced'=>1,
                'challan_number'=>$formData['challan_number'],
                'challan_date'=>$formData['challan_date'],
                // 'eway_bill'=>$formData['eway_bill'],
                // 'eway_bill_date'=>$formData['eway_bill_date'],
                // 'eway_bill_expire'=>$formData['eway_bill_expire'],
            ];

            if($formData['booking_type']=='To Pay'){
                $bookingVehical['billingCustomerId']=$formData['consignee_id'];
              }  
            $status = $db->table('bookings')->where('id', $formData['booking_id'])->set($bookingVehical)->update();
            $booking_id=$formData['booking_id'];
        // }

        // booking consign number start
        // var_dump($formData['booking_id']); die;
    $id_dlt= $db->table('booking_consignment_number')->where('booking_id', $formData['booking_id'])->delete();
if($id_dlt){

    foreach($formData['consign_number'] as $key=>$consigment_number){
        $consigment_data = [
            // 'quotation_no' =>0,
            'booking_id' => $formData['booking_id'],
            'consignment_number' => $consigment_number,
            'service_description'=>$formData['service_description'][$key],
            'consign_date' => $formData['consign_date'],
            'consignor_id' => 1,
            'consignee_id' => $formData['consignee_id'],
            'eway_bill'=>$formData['eway_bill'][$key],
            'eway_bill_date'=>$formData['eway_bill_date'][$key],
            'eway_bill_expire'=>$formData['eway_bill_expire'][$key],
            'loading_location' => 1,
            'unloading_location' => 1,
            'financial_year' => 0, 
            'status' => 1,
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id' => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
        ];
        $db->table('booking_consignment_number')->insert($consigment_data);
       }
    }
    $id = $formData['booking_id'];
        // booking consign number end  
        updateVoucherNumber('Challan'); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical update Successfully.');
            return redirect()->to(base_url('company/booking-link-vehical'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }

    public function edit()
    {
        $model = new vehicalType();

        $broker = new Broker();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Booking Update';
        $bookings = $db->table('bookings')->where('id', $getData['booking_id'])->get()->getRow(); 
        $data['bookings_brokers']=$db->table('bookings_brokers')->where('booking_id', $getData['booking_id'])->get()->getRow();

        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $getData['quotation_id']])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['bookings'] = $bookings;
        $data['previous_url']=previous_url();
        $data['brokers'] = $broker->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['VehicalType'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();

        return view('Company/booking/edit', $data);
    }

    public function view($id)
    {
        $broker = new Broker();
        $consignee = new Consignee();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'View Booking';
        $bookings = $db->table('bookings')->where('id', $id)->get()->getRow();
        $data['vehical'] = $db->table('vehicles')->where('id', $bookings->vehical_id)->get()->getRow();
        $data['consign_data']=$db->table('booking_consignment_number')->where('booking_id',$id)->get()->getResultArray();
        $data['booking'] = $bookings;
        $data['bookings_brokers']=$db->table('bookings_brokers')->where('booking_id', $id)->get()->getRow();

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
        $data['consignee'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->consignee_id])->get()->getRow();

        $data['brokers'] = $broker->where('id', $bookings->broker_id)->get()->getRow();  
        $data['previous_url']=previous_url();
        return view('Company/booking/view', $data);
    }

    public function Multiview($id)
    {   $model1 = new MultipleBookingVehical();
        $bookingConsignNum = new bookingConsignNumber();
        $Consignor = new Consignor();

        $broker = new Broker();
        $consignee = new Consignee();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'View Booking';
        $bookings = $db->table('bookings')->where('id', $id)->get()->getRow();
        $data['vehical'] = $db->table('vehicles')->where('id', $bookings->vehical_id)->get()->getRow();
        $data['consign_data']=$db->table('booking_consignment_number')->where('booking_id',$id)->get()->getResultArray();
        $data['booking'] = $bookings;
        $data['bookings_brokers']=$db->table('bookings_brokers')->where('booking_id', $id)->get()->getRow();

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
        $data['consignee'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->consignee_id])->get()->getRow();
        $data['consignees'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['consignorr'] = $Consignor->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['MultiBookingVehical'] = $model1->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();
        $data['bookingConsignNum'] = $bookingConsignNum->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();

        $data['brokers'] = $broker->where('id', $bookings->broker_id)->get()->getRow();  
        $data['previous_url']=previous_url();
        return view('Company/booking/multiview', $data);
    }
    public function update(){   
        $db = \Config\Database::connect();
        $PostData = $this->request->getPost();
        // echo "<pre>";
        // print_r($PostData);die;
        $status=1;
        $updateData=[
        'rto_fine'=>$PostData['rto_fine'],
        'advance_pay'=>$PostData['advance_pay'],
        'statical_charge'=>$PostData['statical_charge'],
        'detention_charge_loading'=>$PostData['detention_charge_loading'],
        'detention_charge_unloading'=>$PostData['detention_charge_unloading'],
        'total_payable'=>$PostData['total_payable'],
        'total_cgst'=>$PostData['total_cgst'],
        'total_sgst'=>$PostData['total_sgst'],
        'total_igst'=>$PostData['total_igst'],
        'net_amount'=>$PostData['net_amount'],
        'Vehicle_type' =>$PostData['vehicle_type'],
        'updated' => current_time(), 

        ];
      
        $db->table('bookings')->where('id',$PostData['booking_id'])->set($updateData)->update(); 

        $broker_booking=[
         'booking_id'=>$PostData['booking_id'],
         'booking_no'=>$PostData['booking_number'],
         'broker_id'=>$PostData['broker_id'],
         'lorry_hire_charge'=>$PostData['total_broker_amount'],
         'rto_fine'=>$PostData['broker_rto_fine'],
         'rto_fine_date'=>'',
         'late_delivery_charge'=>$PostData['late_delivery_charges'],
         'detention_charge'=>$PostData['detention_charges'],
         'advance'=>$PostData['advance'],
         'mamul_charges_A'=>$PostData['mamul_chargesa'],
         'advance_payable'=>$PostData['advance_payable'],
         'advance_paid'=>$PostData['advance_paid'],
         'balance'=>$PostData['total_balance'],
         'mamul_charges_B'=>$PostData['mamul_chargesb'],
         'balance_payabe'=>$PostData['balance_payable'],
         'balance_paid'=>$PostData['balance_paid'],
         'other_deduction_charges'=>$PostData['other_deduction_charges'],

        ]; 
        $check_broker=$db->table('bookings_brokers')->where('booking_id',$PostData['booking_id'])->get()->getRow();
        $status=0;
        if(empty($check_broker)){
        $status=$db->table('bookings_brokers')->insert($broker_booking);
        }else{
        $status=$db->table('bookings_brokers')->where('booking_id',$PostData['booking_id'])->set($broker_booking)->update();
        } 

        if ($status) {
            session()->setFlashdata('success', 'Booking Updated Successfully.');
            return redirect()->to('company/booking');
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }
    public function print($id){
        $broker = new Broker();
        $consignee = new Consignee();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'View Booking';
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
        $data['consignee'] = $consignee->where('is_delete', 1)->where(['comp_id' => session()->get('CompId'), 'id' => $bookings->consignee_id])->get()->getRow();
      
        $data['brokers'] = $broker->where('id', $bookings->broker_id)->get()->getRow(); 
        
        return view('Company/booking/print', $data);
    }

    public function bookingLink(){ 

        $where['is_delete'] = 0;
        $where['comp_id'] =session()->get('CompId'); 

        $currentDate = new \DateTime();
        $currentDate->modify('first day of this month');
        $firstDateOfMonth = $currentDate->format('Y-m-d');

        $from_date =$firstDateOfMonth;  // date('Y-m-d');
        $to_date = date('Y-m-d');

        $currentFY= getFinancialYear(session()->get('FinancialYear'));

        if ($_GET) {
            $currentFY=$_GET['from_date'];

            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
        }
        $where['date >='] = $from_date;
        $where['date <='] = $to_date;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date; 


        $booking = new Booking(); 
        $data['title'] = 'All Bookings';
        $data['bookings'] = $booking->where($where)->orderBy('id', 'DESC')->get()->getResult();

        $upcomingTrip = $booking->where(['date >=' =>$currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_vehicalPlaced'=>'0','is_delete'=>0])->get()->getResult();
        $data['upcomingTrip']= count($upcomingTrip);

        $ongoingTrip = $booking->where(['date >=' =>$currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_vehicalPlaced'=>'1','is_billing'=>'NO','is_delete'=>0])->get()->getResult();
        $data['ongoingTrip']= count($ongoingTrip);

        $completed = $booking->where(['date >=' => $currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_orderReached'=>'1','is_delete'=>0])->get()->getResult();
        $data['completed']= count($completed);

         $result_array = $booking->where(['date >=' => $currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_delete'=>0],)->get()->getResult();
         $estimate_date_in=[];
         $estimate_date_out=[];
if (count($result_array) > 0) {
    foreach ($result_array as $result) {
       $estimate_date_in = $booking->where(['date >=' =>$currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_delete'=>0,'vehical_reach_date <='=>($result->estmate_deliv_dt) ? $result->estmate_deliv_dt : ''],)->get()->getResult();
       $estimate_date_out = $booking->where(['date >=' =>$currentFY,'date <='=>$to_date])->where(['comp_id' => session()->get('CompId'),'is_delete'=>0,'vehical_reach_date >='=>($result->estmate_deliv_dt) ? $result->estmate_deliv_dt : ''],)->get()->getResult();

    }
}
    $data['estimate_date_in'] = count($estimate_date_in); 
    $data['estimate_date_out'] = count($estimate_date_out); 
        return view('Company/booking/readyForVehical', $data);
    }

    public function orderReached($id){
        $db= \Config\Database::connect();
        $update=[
            'is_orderReached'=>1,
            'vehical_reach_date'=>date('Y-m-d'),
        ];
        $status= $db->table('bookings')->where('id',$id)->set($update)->update(); 
        if ($status) {
            session()->setFlashdata('success', 'Vehical status update Successfully.');
            return redirect()->to(previous_url());
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }

    public function getUnbilled(){

        $where['is_delete'] = 0;
        $where['comp_id'] =session()->get('CompId');
        $where['is_orderReached'] = 1; 
        $where['is_billing']='NO';

        $db = \Config\Database::connect(); 
        $unBilledBooking = $db->table('bookings')->where($where)->orderBy('challan_number', 'ASC')->get()->getResult();
        $status = 1;  
        $temp_array=[];
        foreach ($unBilledBooking as $result) {
            $result->date=dispalyDate($result->date); 
            $result->consinor_address = get_consinor_quotoation_address($result->cr_id);
            $result->delivery_address = get_delivery_quotoation_address($result->ce_pincode_id);
            $result->delivery_short_address = delivery_short_address($result->ce_pincode_id);
            $result->consignor_name = get_title('consignors', ['id' => $result->cr_id], 'name'); 
            $result->consignee_name = get_title('consignees', ['id' => $result->consignee_id], 'name'); 
            $temp_array[] = $result;
        }

        return json_encode(['status' => $status, 'result' => $temp_array]);
    }

    public function editVehical($id)
    {
        $model = new consignorNum();
        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        $data['bookingConsignNum'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->get()->getResult();
        $data['updateid']=$id;
        return view('Company/booking/vehicalPlacementedit', $data);
    }

    public function editmultipointVehical($id)
    {
        $model1 = new MultipleBookingVehical();
        $Consignor = new Consignor();

        $model = new consignorNum();
        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['consignorr'] = $Consignor->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();

         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();

        $data['bookingConsignNum'] = $bookingConsignNum->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();

        $data['MultiBookingVehical'] = $model1->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();

        $data['updateid']=$id;
        return view('Company/booking/editMultiPointvehicalPlacement', $data);
    }

    public function editSingleToMultiVehical($id)
    {
        $model1 = new MultipleBookingVehical();
        $Consignor = new Consignor();

        $model = new consignorNum();
        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['consignorr'] = $Consignor->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();

         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        // $data['bookingConsignNum'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->get()->getResult();
        $data['bookingConsignNum'] = $bookingConsignNum->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();
        // print_r($data['bookingConsignNum']);die;
        $data['MultiBookingVehical'] = $model1->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();
        // $data['consignor_details'] = $db->table('consignors')->where(['id' => $result_quotation->consignor])->get()->getRow();

        $data['updateid']=$id;
        return view('Company/booking/editSingleToMultivehicalPlacement', $data);
    }
    public function editMultiToSingleVehical($id)
    {
        $model1 = new MultipleBookingVehical();
        $Consignor = new Consignor();

        $model = new consignorNum();
        $consignee = new Consignee();
        $bookingConsignNum = new bookingConsignNumber();

        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Add Vehical';
        $booking_data = $db->table('bookings')->where(['id' => $id])->get()->getRow();
        $data['brokers']= $db->table('brokers')->where(['id' => $booking_data->broker_id])->get()->getRow();
        $quatation_id = $booking_data->quatation_id;
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }


        $result_quotation =  $db->table('quotation')->where(['id' => $quatation_id])->get()->getRow();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $data['consignor_details'] = '';
        $data['consignee_details'] = '';
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
        $data['booking_type'] = $booking_data->booking_type;
        $data['loading_point'] = $booking_data->loading_type;
        $data['delivery_point'] = $booking_data->unloading_type;
        $data['booking'] = $booking_data;
        $data['quotation_id'] = $quatation_id;
        $data['consignee'] = $consignee->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();
        $data['consignorr'] = $Consignor->where('is_delete', 1)->where('comp_id', session()->get('CompId'))->get()->getResult();

         $data['ConsignNumberValue'] = $model->where('is_delete',1)->where('status',1)->where('comp_id',session()->get('CompId'))->where('user_id', session()->get('user_data')['id'])->get()->getRow();
        // $data['bookingConsignNum'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->get()->getResult();
        $data['bookingConsignNum'] = $bookingConsignNum->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();
        // print_r($data['bookingConsignNum']);die;
        $data['MultiBookingVehical'] = $model1->where(['comp_id'=>session()->get('CompId'),'booking_id'=>$id])->get()->getResult();
        // $data['consignor_details'] = $db->table('consignors')->where(['id' => $result_quotation->consignor])->get()->getRow();

        $data['updateid']=$id;
        return view('Company/booking/editMultiToSinglevehicalPlacement', $data);
    }

    public function vehicalTracking(){
        $where['is_delete'] = 0;
        $where['comp_id'] =session()->get('CompId'); 
        $currentDate = new \DateTime();
        $currentDate->modify('first day of this month');
        $firstDateOfMonth = $currentDate->format('Y-m-d');
        $from_date = $firstDateOfMonth;  //date('Y-m-d');
        $to_date =  date('Y-m-d');
        $currentFY = getFinancialYear(session()->get('FinancialYear'));
      //  $from_date = date('Y-m-d');
       // $to_date = date('Y-m-d');
        if ($_GET) {
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
        }
        $where['date >='] = $from_date;
        $where['date <='] = $to_date;
        $where['is_vehicalPlaced']=1;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date; 


           $booking = new Booking();
        $data['title'] = 'All Bookings';
        $data['bookings'] = $booking->where($where)->orderBy('id', 'DESC')->get()->getResult();

        $upcomingTrip = $booking->where(['date >=' => $currentFY, 'date <=' => $to_date])->where(['comp_id' => session()->get('CompId'), 'is_vehicalPlaced' => '0', 'is_delete' => 0])->get()->getResult();
        $data['upcomingTrip'] = count($upcomingTrip);

        $ongoingTrip = $booking->where(['date >=' => $currentFY, 'date <=' => $to_date])->where(['comp_id' => session()->get('CompId'), 'is_vehicalPlaced' => '1', 'is_billing' => 'NO', 'is_delete' => 0])->get()->getResult();
        $data['ongoingTrip'] = count($ongoingTrip);

        $completed = $booking->where(['date >=' => $currentFY, 'date <=' => $to_date])->where(['comp_id' => session()->get('CompId'), 'is_orderReached' => '1', 'is_delete' => 0])->get()->getResult();
        $data['completed'] = count($completed);

        $result_array = $booking->where(['date >=' => $currentFY, 'date <=' => $to_date])->where(['comp_id' => session()->get('CompId'), 'is_delete' => 0],)->get()->getResult();
        $estimate_date_in = [];
        $estimate_date_out = [];
        if (count($result_array) > 0) {
            foreach ($result_array as $result) {
                $estimate_date_in = $booking->where(['date >=' => $currentFY, 'date <=' => $to_date])->where(['comp_id' => session()->get('CompId'), 'is_delete' => 0, 'vehical_reach_date <=' => ($result->estmate_deliv_dt) ? $result->estmate_deliv_dt : ''],)->get()->getResult();
                $estimate_date_out = $booking->where(['date >=' => $currentFY, 'date <=' => $to_date])->where(['comp_id' => session()->get('CompId'), 'is_delete' => 0, 'vehical_reach_date >=' => ($result->estmate_deliv_dt) ? $result->estmate_deliv_dt : ''],)->get()->getResult();
            }
        }
        $data['estimate_date_in'] = count($estimate_date_in);
        $data['estimate_date_out'] = count($estimate_date_out);

        $booking = new Booking(); 
        $data['title'] = 'All Vehical Tracking';
        $data['bookings'] = $booking->where($where)->orderBy('id', 'DESC')->get()->getResult();
        return view('Company/booking/vehicalTracking', $data);
    }

    public function getSplitBillData()
    {
        $db = \Config\Database::connect();
        // $getData = $this->request->getGet();
        $getData=$this->request->getPost();
        $status = 0;
        $temp_array = [];
        if($getData['consignorid'] != 'null'){
        if (count($getData['consignorid']) > 0) {
            $status = 1;
            foreach ($getData['consignorid'] as $key =>$result) {
     $result_array[] =  $db->table('consignors')->where(['id'=>$getData['consignorid'][$key]])->get()->getResult();
            }

            $split_array[] =  $db->table('split_bill')->where(['booking_id'=>$getData['brokerid']])->get()->getResult();


        }
    }
    if($getData['consigneeid'] != 'null'){

        if (count($getData['consigneeid']) > 0) {
            $status = 1;
            foreach ($getData['consigneeid'] as $key =>$result) {
     $result_array[] =  $db->table('consignees')->where(['id'=>$getData['consigneeid'][$key]])->get()->getResult();
            }

            $split_array[] =  $db->table('split_bill')->where(['booking_id'=>$getData['brokerid']])->get()->getResult();

        }
    }
    $split_count = $db->table('split_bill')->where(['booking_id' => $getData['brokerid']])->countAllResults();

        return json_encode(['status' => $status, 'result' => $result_array,'split_data' =>$split_array,'split_count'=>$split_count]);
    }

    public function saveSplitBillData()
    {
        $db = \Config\Database::connect();
        $formData=$this->request->getPost();
        $status = 0;
        $id_dlt= $db->table('split_bill')->where('booking_id', $formData['booking_id_new'])->delete();
        if($id_dlt){

        foreach($formData['consignor_id'] as $key => $value){

            $split_data = [
                'booking_amt' => $formData['booking_amt'][$key],
                'rto_fine' => $formData['rto_fine'][$key],
                'advance_pay' => $formData['advance_pay'][$key],
                'statical_charge' => $formData['statical_charge'][$key],
                'detention_charge_loading' => $formData['detention_charge_loading'][$key],
                'detention_charge_unloading' => $formData['detention_charge_unloading'][$key],

                'consignor_id' => $formData['consignor_id'][$key],
                'consignee_id' => $formData['consignee_id'][$key],
                'booking_id' => $formData['booking_id_new'],
                'comp_id' => session()->get('CompId'),
            ];
        // }
       $insert= $db->table('split_bill')->insert($split_data);
   
           }
        }
           if($insert){
            $status = 1;
    
        }
        return json_encode(['status' => $status ]);
    }
}
