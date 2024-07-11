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
use App\Models\booking_consignment_number as bookingConsignNumber;
use App\Models\Broker; 



class consignmentNote  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $bookingConsignNum = new bookingConsignNumber();

        $data['title'] = 'Consignors';
        $model = new termcondition();
        $data['terms'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();
        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();

        $data['bookingConsignNumber'] = $bookingConsignNum->where('comp_id',session()->get('CompId'))->orderBy('id','DESC')->get()->getResult();

        return view('Company/consignment_note/index', $data);
    }
  
    public function add(){ 
        $data['title'] = 'Add Consignor';
        $model = new termcondition();
        $data['terms'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();
        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        return view('Company/termsCondition/create', $data);
    }

    public function printnote($id){
        $bookingConsignNum = new bookingConsignNumber();
        $getData = $this->request->getGet();
        $db = \Config\Database::connect();
        $data['title'] = 'Create Invoice';
        $data['bookingConsignNumber'] = $bookingConsignNum->where('id',$id)->get()->getRow();
        
        $data['booking_data'] = $db->table('bookings')->where(['id' => $data['bookingConsignNumber']->booking_id])->get()->getRow();
        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }
        $data['companies_details']=$companies_details;
        // $data['bookingConsignNumber']->consignee_id; die;

        return view('Company/consignment_note/consignmentprint', $data);
    }

    
}
