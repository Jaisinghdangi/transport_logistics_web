<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\Country;
use App\Models\State;
use App\Models\Company;
use App\Models\Consignee;
use App\Models\Consignor;
use App\Models\Broker;
use function PHPUnit\Framework\isNull;

function get_module_name($id)
{
    $model = new Permission();
    $name = '';
    if ($id == 0) {
        $name = 'Root';
    } else {
        $data = $model->where('id', $id)->get()->getRow();
        if ($data !== null) {
            $name = $data->name;
        }
    }
    return $name;
}
function dispalyDate($date)
{
    return date('d-M-Y', strtotime($date));
}

function current_time()
{
    return date('d-m-Y h:i:s A');
}

function display_error($validation, $field)
{
    if ($validation->hasError($field)) {
        return $validation->getError($field);
    } else {
        return false;
    }
}

function get_role($id)
{
    $user =  new Role();
    $user_data = $user->where('id', $id)->get()->getRow();
    $role = '';
    if ($user_data != null) {
        $role = $user_data->name;
    }
    return $role;
}

function get_title($table, $where, $name)
{
    $db = \Config\Database::connect();
    $builder = $db->table($table);
    if (!empty($where)) {
        $builder->where($where);
    }
    $builder->select($name);
    $result = $builder->get()->getRow();
      
    if ($result) {
        return $result->$name;
    } else {
        return "";
    }
}

function get_title_full($table, $where, $name)
{
    $db = \Config\Database::connect();
    $builder = $db->table($table);
    if (!empty($where)) {
        $builder->where($where);
    }
    $builder->select($name);
    $result = $builder->orderBy('id', 'DESC')->get()->getResult();
    return  $result;
    // if ($result) {
    //     return $result->$name;
    // } else {
    //     return "";
    // }
}
function get_countries()
{
    $model = new Country();
    return $model->where('status', 1)->where('is_delete', 1)->orderBy('name', 'asc')->get()->getResult();
}


function get_states()
{
    $model = new State();
    return $model->where('status', 1)->where('is_delete', 1)->orderBy('name', 'asc')->get()->getResult();
}

function get_series()
{
    $db = \Config\Database::connect();
    if ($db->select('Prefix, Starting')->where($Where)->where(['Prefix != ' => '', 'Starting != ' => ''])->get('employee_config')->num_rows()) {
        $SeriesData = $db->select('Prefix, Starting')->where($Where)->get('employee_config')->row();
        $PreviousEmployeeId = $db->select('EmployeeId')->where($Where)->where('IsDeleted', 1)->order_by('Id', 'DESC')->get('employees')->row('EmployeeId');
        if ($PreviousEmployeeId) {
            $EmployeeIdStr = explode("/", $PreviousEmployeeId);
            $Series = $EmployeeIdStr[1] + 1;
            if ($Series < '10') {
                $NewSeries = $SeriesData->Starting;
            } elseif ($Series < '100') {
                $NewSeries = "0$Series";
            } elseif ($Series < '1000') {
                $NewSeries = "$Series";
            } else {
                $NewSeries = "$Series";
            }
            $EmployeeId = $SeriesData->Prefix . "/" . $NewSeries . "/" . date('Y');
        } else {
            $EmployeeId = $SeriesData->Prefix . "/" . $SeriesData->Starting . "/" . date('Y');
        }
    } else {
        $EmployeeId = $db->select('EmployeeId')->where($Where)->where('IsDeleted', 1)->order_by('Id', 'DESC')->get('employees')->row('Id') + 1;
    }
    $data['EmployeeId'] = $EmployeeId;
}

function create_company_code()
{
    $comp_model = new Company();
    for ($i = 0; $i <= 100; $i++) {
        $randomString = random_string('alnum', 8);
        $check_ = $comp_model->where('comp_code', $randomString)->get()->getRow();
        if (isNull($check_)) {
            break;
        } else {
            continue;
        }
    }
    return $randomString;
}

function create_consignee_code()
{
    $comp_model = new Consignee();
    for ($i = 0; $i <= 100; $i++) {
        $randomString = random_string('alnum', 8);
        $check_ = $comp_model->where('consignee_code', $randomString)->get()->getRow();
        if (isNull($check_)) {
            break;
        } else {
            continue;
        }
    }
    return $randomString;
}

function create_broker_code()
{
    $comp_model = new Broker();
    for ($i = 0; $i <= 100; $i++) {
        $randomString = random_string('alnum', 8);
        $check_ = $comp_model->where('broker_code', $randomString)->get()->getRow();
        if (isNull($check_)) {
            break;
        } else {
            continue;
        }
    }
    return $randomString;
}

function create_consignor_code()
{
    $comp_model = new Consignor();
    for ($i = 0; $i <= 100; $i++) {
        $randomString = random_string('alnum', 8);
        $check_ = $comp_model->where('consignor_code', $randomString)->get()->getRow();
        if (isNull($check_)) {
            break;
        } else {
            continue;
        }
    }
    return $randomString;
}



function render_view($view, $params)
{
    return view($view, $params);
}


if (!function_exists('get_consinor_quotoation_address')) {
    function get_consinor_quotoation_address($id)
    {
        $db = \Config\Database::connect();
        $result = $db->table('quotation')->where(['id' => $id])->orderBy('id', 'DESC')->get()->getRow();

        $address = "";
        if (!empty($result)) {
            $consignor = $db->table('consignors')->where(['id' => $result->consignor])->orderBy('id', 'DESC')->get()->getRow();

            $state = get_title('states', ['id' => $result->state_id], 'name');
            $districts = get_title('cities', ['id' => $result->district], 'name');
            $consignor_address = $result->consignor_local_address;
            // $address="<b>State</b> :".$state." <b>District :</b> ".$districts." <b> Address</b> :".$consignor_address; 
            $address = $consignor_address . ' , ' . $consignor->pin_code . ' , ' . $districts . ' , ' . $state;
        }
        return $address;
    }
}


if (!function_exists('getConsinorGST')) {
    function getConsinorGST($id)
    {
        $db = \Config\Database::connect();

            $consignor = $db->table('consignors')->where(['id' => $id])->get()->getRow();
            $name = $consignor->gst_number;
        
        return $name;
    }
}
if (!function_exists('getConsinorName')) {
    function getConsinorName($id)
    {
        $db = \Config\Database::connect();

            $consignor = $db->table('consignors')->where(['id' => $id])->get()->getRow();
            $name = ($consignor) ? $consignor->name : '';
        
        return $name;
    }
}

if (!function_exists('get_consinor_address')) {
    function get_consinor_address($id)
    {
        $db = \Config\Database::connect();

        // $address = "";
        // if (!empty($result)) {
            $consignor = $db->table('consignors')->where(['id' => $id])->get()->getRow();

            $state = get_title('states', ['id' => $consignor->state], 'name');
            $districts = get_title('cities', ['id' => $consignor->district], 'name');
            $consignor_address = $consignor->address_1.' '.$consignor->address_2;
            // $address="<b>State</b> :".$state." <b>District :</b> ".$districts." <b> Address</b> :".$consignor_address; 
            $address = $consignor_address . ' , ' . $consignor->pin_code . ' , ' . $districts . ' , ' . $state;
        //}
        return $address;
    }
}

if (!function_exists('getConsineeGST')) {
    function getConsineeGST($id)
    {
        $db = \Config\Database::connect();

            $consignor = $db->table('consignees')->where(['id' => $id])->get()->getRow();

          
            $gst_number = $consignor->gst_number ;
        
        return $gst_number;
    }
}

if (!function_exists('getConsineeName')) {
    function getConsineeName($id)
    {
        $db = \Config\Database::connect();

            $consignor = $db->table('consignees')->where(['id' => $id])->get()->getRow();

          
            $name = ($consignor) ? $consignor->name : '';
        
        return $name;
    }
}

if (!function_exists('get_consinee_address')) {
    function get_consinee_address($id)
    {
        $db = \Config\Database::connect();

        // $address = "";
        // if (!empty($result)) {
            $consignor = $db->table('consignees')->where(['id' => $id])->get()->getRow();

            $state = get_title('states', ['id' => $consignor->state], 'name');
            $districts = get_title('cities', ['id' => $consignor->district], 'name');
            $consignor_address = $consignor->address_1.' '.$consignor->address_2;
            // $address="<b>State</b> :".$state." <b>District :</b> ".$districts." <b> Address</b> :".$consignor_address; 
            $address = $consignor_address . ' , ' . $consignor->pin_code . ' , ' . $districts . ' , ' . $state;
        //}
        return $address;
    }
}


if (!function_exists('get_delivery_quotoation_address')) {
    function get_delivery_quotoation_address($id)
    {
        $db = \Config\Database::connect();
        $result = $db->table('quotation')->where(['id' => $id])->orderBy('id', 'DESC')->get()->getRow();
        $address = "";
        if (!empty($result)) {
            $post_address = $db->table('pincodes')->where(['id' => $result->delivery_address_id])->orderBy('id', 'DESC')->get()->getRow();
            // $address="<b>State :</b> ".$post_address->StateName." <b>District</b> ".$post_address->District." <b>Post Office:</b> ".$post_address->OfficeName." <b>Pincode</b>:".$post_address->Pincode. " <b>Address</b> :".$result->local_delivery_address;
            $address = $result->local_delivery_address . ' , ' . $post_address->OfficeName . ' , ' . $post_address->Pincode . ' , ' . $post_address->District . ' , ' . $post_address->StateName;
        }
        return $address;
    }
}

if (!function_exists('delivery_short_address')) {
    function delivery_short_address($id)
    {
        $db = \Config\Database::connect();
        $result = $db->table('quotation')->where(['id' => $id])->orderBy('id', 'DESC')->get()->getRow();
        $address = "";
        if (!empty($result)) {
            $post_address = $db->table('pincodes')->where(['id' => $result->delivery_address_id])->orderBy('id', 'DESC')->get()->getRow();
            // $address="<b>State :</b> ".$post_address->StateName." <b>District</b> ".$post_address->District." <b>Post Office:</b> ".$post_address->OfficeName." <b>Pincode</b>:".$post_address->Pincode. " <b>Address</b> :".$result->local_delivery_address;
            $address = $post_address->District . ' , ' . $post_address->StateName . '-' . $post_address->Pincode;
        }
        return $address;
    }
}

if (!function_exists('getDymentionDetails')) {
    function getDymentionDetails($dimention)
    {
        if (!empty($dimention)) {
            $dimention = json_decode($dimention);
            echo "<pre>";
            print_r($dimention);
            die;
        }
    }
}

if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }
}


if (!function_exists('type_of_vehicle')) {
    function type_of_vehicle()
    {
        $arra = [1 => 'Trailer', 2 => 'Conveyor', 3 => 'Truck', 4 => 'Open Truck'];
        return $arra;
    }
}

if (!function_exists('weight_unit')) {
    function weight_unit()
    {
        $array = [
            'Kg' => 'Kg',
            'Ton' => 'Ton',
            'Metric Ton' => 'Metric Ton'
        ];
        return $array;
    }
}

if (!function_exists('dimension_unit')) {
    function dimension_unit()
    {
        $array = [
            'Feet' => 'Feet',
            'MM' => 'MM',
        ];
        return $array;
    } 
}


if(!function_exists('dimension_unit_html')){
    function dimension_unit_html(){
       $array=dimension_unit();
       $html="";
       foreach($array as $key=>$value){
       $html.="<option value=".'"'.$key.'"'.">".$value."</option>";
       }
       return $html;
    } 
}
 
if(!function_exists('weight_unit_html')){
    function weight_unit_html(){
        $array=weight_unit();
        $html="";
        foreach($array as $key=>$value){
        $html.="<option value=".'"'.$key.'"'.">".$value."</option>";
        }
        return $html; 
    } 
}

if (!function_exists('getVoucherName')) {
    function getVoucherName($type)
    {
        $db = \Config\Database::connect();
        $result = $db->table('series_types')->where(['name' => $type])->select('id')->get()->getRow();
        $VoucherName = $result->id;
        return $VoucherName;
    }
}

if (!function_exists('getVoucherNumber')) {
    function getVoucherNumber($type)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('series_types');
        $builder->where(['name' => $type]);
        $builder->select('id');
        $res = $builder->get()->getRow()->id;
        $where['comp_id'] = session()->get('CompId');
        $where['series_type'] = $res;
        $builder = $db->table('series');
        $builder->where($where);
        $result = $builder->get()->getRow();
        $start_point = "";
        $prefix = "";
        if (empty($result)) {
            $insData = [
                'series_type' => $res,
                'comp_id' => session()->get('CompId'),
                'financial_year' => $_SESSION['FinancialYear'],
                'start_point' => '000001',
                'prefix' => strtoupper(substr($type, 0, 2)),
                'user_id' => $_SESSION['UserId'],
                'created_by' => $_SESSION['UserName'],
            ];
            $db->table('series')->insert($insData);
            $start_point = '000001';
            $prefix = strtoupper(substr($type, 0, 2));
        } else {
            $start_point = $result->start_point;
            $prefix = strtoupper($result->prefix);
        }
        $number = str_pad($start_point, 6, "0", STR_PAD_LEFT);
        $invoice_number = $prefix . $number;
        return $invoice_number;
    }
}
if (!function_exists('getMultiVoucherNumber')) {
    function getMultiVoucherNumber($type)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('series_types');
        $builder->where(['name' => $type]);
        $builder->select('id');
        $res = $builder->get()->getRow()->id;
        $where['comp_id'] = session()->get('CompId');
        $where['series_type'] = $res;
        $builder = $db->table('series');
        $builder->where($where);
        $result = $builder->get()->getRow();
        $start_point = "";
        $prefix = "";
        if (empty($result)) {
            $insData = [
                'series_type' => $res,
                'comp_id' => session()->get('CompId'),
                'financial_year' => $_SESSION['FinancialYear'],
                'start_point' => '000001',
                'prefix' => strtoupper(substr($type, 0, 2)),
                'user_id' => $_SESSION['UserId'],
                'created_by' => $_SESSION['UserName'],
            ];
            $db->table('series')->insert($insData);
            $start_point = '000001';
            $prefix = strtoupper(substr($type, 0, 2));
        } else {
            $start_point = $result->start_point;
            $prefix = strtoupper($result->prefix);
        }
        $number = str_pad($start_point, 6, "0", STR_PAD_LEFT);
        $invoice_number = $prefix . $number;
        $invoice_arr = ['prefix'=>$prefix,'number'=>$number];
        return $invoice_arr;
    }
}



if (!function_exists('updateVoucherNumber')) {
    function updateVoucherNumber($type)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('series_types');
        $builder->where(['name' => $type]);
        $builder->select('id');
        $res = $builder->get()->getRow()->id;
        $where['comp_id'] = session()->get('CompId');
        $where['series_type'] = $res;
        $builder = $db->table('series');
        $builder->where($where);
        $result = $builder->get()->getRow();
        $start_point = $result->start_point + 1;
        $number = str_pad($start_point, 6, "0", STR_PAD_LEFT);
        $db->table('series')->where($where)->set(['start_point' => $number])->update();
    }
}


if (!function_exists('checkBillingCustomerGst')) {
    function checkBillingCustomerGst($booking)
    {
        $gst_status = 0;
        $consignor_state_id = $booking->cr_state_id;
        $db = \Config\Database::connect();
        $builder = $db->table('consignees');
        $builder->where(['id' => $booking->consignee_id]);
        $consignee = $builder->get()->getRow();
        $consignee_state_id = $consignee->state;

        if ($booking->booking_type == "Paid") {
            $db = \Config\Database::connect();
            $builder = $db->table('consignors');
            $builder->where(['id' => $booking->billingCustomerId]);
            $res = $builder->get()->getRow();
            if ($res->gst_status == 1) {
                $gst_status = 1;
            }
        } else if ($booking->booking_type == "To Pay") {
            if ($consignee->gst_status == 1) {
                $gst_status = 1;
            }
        }
        return $gst_status;
    }
}

if (!function_exists('calculate_gst')) {
    function calculate_gst($amount, $booking)
    {
        $consignor_state_id = $booking->cr_state_id;
        $db = \Config\Database::connect();
        $builder = $db->table('consignees');
        $builder->where(['id' => $booking->consignee_id]);
        $consignee = $builder->get()->getRow();
        $consignee_state_id = $consignee->state;
        $total_gst = $amount * GST_PER / 100;
        $data['sgst'] = 0;
        $data['cgst'] = 0;
        $data['igst'] = 0;
        if (checkBillingCustomerGst($booking) == 0) {
            if ($consignor_state_id == $consignee_state_id) {
                $data['sgst'] = $total_gst / 2;
                $data['cgst'] = $total_gst / 2;
            } else {
                $data['igst'] = $total_gst;
            }
        }
        return $data;
    }
}

if (!function_exists('multiple_calculate_gst')) {
    function multiple_calculate_gst($amount, $consinorID,$consigneeID,$booking)
    {
        $gst_status = 0;
        // $consignor_state_id = $booking->cr_state_id;
        $db = \Config\Database::connect();
        $builder = $db->table('consignors');
        $builder->where(['id' => $consinorID]);
        $consignor = $builder->get()->getRow();
        $consignor_state_id = $consignor->state;



        $builder = $db->table('consignees');
        $builder->where(['id' =>$consigneeID]);
        $consignee = $builder->get()->getRow();
        $consignee_state_id = $consignee->state;
        $total_gst = $amount * GST_PER / 100;
        $data['sgst'] = 0;
        $data['cgst'] = 0;
        $data['igst'] = 0;

        if ($booking->booking_type == "Paid") {
            if ($consignor->gst_status == 1) {
                $gst_status = 1;
            }
        } else if ($booking->booking_type == "To Pay") {
            if ($consignee->gst_status == 1) {
                $gst_status = 1;
            }
        }

        if ($gst_status == 0) {
            if ($consignor_state_id == $consignee_state_id) {
                $data['sgst'] = $total_gst / 2;
                $data['cgst'] = $total_gst / 2;
            } else {
                $data['igst'] = $total_gst;
            }
        }
        return $data;
    }
}

if (!function_exists('getFinancialYear')) {
    function getFinancialYear($yearId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('financial_year');
        $builder->where(['id' => $yearId]);
        $financial_year = $builder->get()->getRow();
        $currentfinancialYear = $financial_year->starting_year;
        return $currentfinancialYear;
    }
}

if (!function_exists('indian_rupee')) {
    function indian_rupee($number)
    {
        setlocale(LC_MONETARY, 'en_IN');  
        $formatted_number = number_format($number,2);
        return $formatted_number;
    }
}



if (!function_exists('get_consinee_address_saprate')) {
    function get_consinee_address_saprate($id)
    {
        $db = \Config\Database::connect(); 
            $consignor = $db->table('consignees')->where(['id' => $id])->get()->getRow();  
            $state = get_title('states', ['id' => $consignor->state], 'name');
            $districts = get_title('cities', ['id' => $consignor->district], 'name');
            $countries = get_title('countries', ['id' => $consignor->country], 'name');
            $data['address1']=$consignor->address_1;
            $data['address2']=$consignor->address_2 .' , '. $districts .' , ' .$consignor->pin_code ;
            $data['address3']=$state.' , '. $countries; 
        return $data;
    }
}


if (!function_exists('get_consinor_address_saprate')) {
    function get_consinor_address_saprate($id)
    {
        $db = \Config\Database::connect(); 
            $consignor = $db->table('consignors')->where(['id' => $id])->get()->getRow(); 
            $state = get_title('states', ['id' => $consignor->state], 'name');
            $districts = get_title('cities', ['id' => $consignor->district], 'name');
            $countries = get_title('countries', ['id' => $consignor->country], 'name');
            $data['address1']=$consignor->address_1;
            $data['address2']=$consignor->address_2 .' , '.$districts.' , '.$consignor->pin_code ;
            $data['address3']=$state.' , '. $countries;  
        return $data;
    }
}



if (!function_exists('get_data')) {
    function get_data($table,$condition=[])
    {
        $db = \Config\Database::connect(); 
        $row = $db->table($table)->where($condition)->get()->getRow();
        return $row;
    }
} 

if(!function_exists('quatation_delivery_address')){
    function quatation_delivery_address($result){ 
            $db = \Config\Database::connect(); 
            $delivery_address = $db->table('pincodes')->where(['id' => $result->delivery_address_id])->get()->getRow();  
            $data['address1']=$result->local_delivery_address;
            $data['address2']=$delivery_address->District.' , '.$delivery_address->Pincode ;
            $data['address3']=$delivery_address->StateName.' , India';   
            return $data;
    }
}