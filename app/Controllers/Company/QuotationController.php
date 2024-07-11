<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Consignee;
use App\Models\Consignor;
use App\Models\Country;
use App\Models\Product;
use App\Models\termsCondition as termcondition;
use App\Models\State;
use App\Models\City;
use App\Models\code_prefix as codeprefix;

class QuotationController extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $comman_where = ['status' => 1, 'is_delete' => 1];
        $consinor = new Consignor();
        $consinee = new Consignee();
        $product = new Product();
        $contry = new Country();

        $where['status'] = 1;
        $currentDate = new \DateTime();
        $currentDate->modify('first day of this month');
        $firstDateOfMonth = $currentDate->format('Y-m-d');
        $from_date = $firstDateOfMonth;  //date('Y-m-d');
        $to_date =  date('Y-m-d');
          
        $currentFY= getFinancialYear(session()->get('FinancialYear'));

        if ($_GET) {
            $currentFY=$_GET['from_date'];
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
        }
        $where['quotation_date >='] = $from_date;
        $where['quotation_date <='] = $to_date;
        $where['comp_id']=session()->get('CompId');
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;

        $data['consignor'] = $consinor->where($comman_where)->where('comp_id',session()->get('CompId'))->get()->getResult();
        $data['consignee'] = $consinee->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['countries'] = get_countries();

        // $product_model = new Product(); 
        $db = \Config\Database::connect();
        $data['result'] = $db->table('quotation')->where($where)->orderBy('id', 'DESC')->get()->getResult();

         $builder= $db->table('quotation')->where(['quotation_date >=' => $currentFY,'quotation_date <='=>$to_date,'status'=>1])->where('comp_id', session()->get('CompId'))->get()->getResult();
         $data['quatationEnquiry'] = count($builder);

         $builder= $db->table('quotation')->where(['quotation_date >=' => $currentFY,'quotation_date <='=>$to_date,'status'=>1])->where(['comp_id' => session()->get('CompId'),'is_approved'=>'0'])->get()->getResult();
         $data['quatationSent'] = count($builder);

         $builder= $db->table('quotation')->where(['quotation_date >=' => $currentFY,'quotation_date <='=>$to_date,'status'=>1])->where(['comp_id' => session()->get('CompId'),'is_approved'=>'1'])->get()->getResult();
         $data['quatationApproved'] = count($builder);

        $data['title'] = 'All Quotaions';
        return view('Company/quotation/index', $data);
    }

    public function add()
    {
        $comman_where = ['status' => 1, 'is_delete' => 1];
        $consinor = new Consignor();
        $consinee = new Consignee();
        $product = new Product();
        $contry = new Country();
        $data['consignor'] = $consinor->where($comman_where)->where('comp_id',session()->get('CompId'))->get()->getResult();
        $data['consignee'] = $consinee->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['countries'] = get_countries();
        // $db = $this->db = \Config\Database::connect();
        // echo '<pre>';
        // print_r($data['consignee']); die;
        // print_r($db->getLastQuery()->getQuery()); die;
        $data['title'] = 'Add New Quotation';
        return view('Company/quotation/create', $data);
    }
    public function store()
    {
        $validatedData = $this->request->getPost();
        $rules = [
            'consignor' => 'required',
            'country'    => 'required',
            'state_id'    => 'required',
            'district'    => 'required',
            'consignor_local_address'    => 'required',
            'pincode'    => 'required',
            'delivery_address_id'    => 'required',
            'local_delivery_address'    => 'required',
            'amount' => 'required',
            'quotation_number' => 'required',
            'quotation_date' => 'required',
        ];
        $this->validation->setRules($rules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors());
        } else {
            $db = \Config\Database::connect();
            $data = [
                'is_parent' => 1,
                'consignor' => $validatedData['consignor'],
                'country' => $validatedData['country'],
                'state_id'  => $validatedData['state_id'] ?? '',
                'district'    => $validatedData['district'] ?? '',
                'consignor_local_address' => $validatedData['consignor_local_address'] ?? '',
                'pincode'    => $validatedData['pincode'],
                'delivery_address_id'    => $validatedData['delivery_address_id'],
                'local_delivery_address'    => $validatedData['local_delivery_address'],
                // 'width'    => $validatedData['width'], 
                // 'height'    => $validatedData['height'], 
                // 'length'    => $validatedData['length'], 
                'remark'    => $validatedData['remark'],
                'amount' => $validatedData['amount'],
                'amount_in_word' => convertNumberToWords($validatedData['amount']),
                'quotation_number' => $validatedData['quotation_number'],
                'quotation_date' => $validatedData['quotation_date'],
                'dimension' => json_encode($validatedData['dimension']),
                'estmate_deliv_dt'=> $validatedData['estmate_deliv_dt'],
                'created_at' => current_time(),
                'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
                'status' => 1,
            ]; 

            $ins_id =  $db->table('quotation')->insert($data);
            $lastInsertedId = $db->insertID();
            updateVoucherNumber('Quotation');
            $result = $db->table('quotation')->where('id', $lastInsertedId)->set(['parent_quotation_id' => $lastInsertedId])->update();
            if ($ins_id) {
                session()->setFlashdata('success', 'Quotation Added Successfully.');
                return redirect()->to(base_url('company/quotation'));
            } else {
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url());
            }
        }
    }

    public function editnew($id)
    {
        $comman_where = ['status' => 1, 'is_delete' => 1];
        $consinor = new Consignor();
        $consinee = new Consignee();
        $product = new Product();
        $contry = new Country();
        $data['consignor'] = $consinor->where($comman_where)->where('comp_id',session()->get('CompId'))->get()->getResult();
        $data['consignee'] = $consinee->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['countries'] = get_countries();
        $db = \Config\Database::connect();
        $data['quotation'] = $db->table('quotation')->where('id', $id)->get()->getRow();
        $data['title'] = 'edit Quotation';
        $data['editid'] = $id;

        return view('Company/quotation/editnew', $data);
    }
    public function view($id)
    {
        $comman_where = ['status' => 1, 'is_delete' => 1];
        $consinor = new Consignor();
        $consinee = new Consignee();
        $product = new Product();
        $contry = new Country();
        $state_model = new State();
        $dis = new City();

        $db = \Config\Database::connect();
        $data['quotation'] = $db->table('quotation')->where('id', $id)->get()->getRow();
        $data['consignor'] = $consinor->where(['id' => $data['quotation']->consignor])->get()->getRow();
        $data['contry'] = $contry->where(['id' => $data['quotation']->country])->get()->getRow();
        $data['states'] = $state_model->where(['id' => $data['quotation']->state_id])->get()->getRow();
        $data['districts'] = $dis->where(['id' => $data['quotation']->district])->get()->getRow();


        $data['consignee'] = $consinee->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['products'] = $product->where($comman_where)->get()->getResult();
        $data['countries'] = get_countries();
       
        $data['title'] = 'view Quotation';
        $data['editid'] = $id;

        return view('Company/quotation/viewpage', $data);
    }
    public function updatenew($id)
    {
        $validatedData = $this->request->getPost();
        $rules = [
            'consignor' => 'required',
            'country'    => 'required',
            'state_id'    => 'required',
            'district'    => 'required',
            'consignor_local_address'    => 'required',
            'pincode'    => 'required',
            'delivery_address_id'    => 'required',
            'local_delivery_address'    => 'required',
            'amount' => 'required',
            'quotation_number' => 'required',
            'quotation_date' => 'required',
        ];
        $this->validation->setRules($rules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors());
        } else {
            $db = \Config\Database::connect();
            $data = [
                'is_parent' => 1,
                'consignor' => $validatedData['consignor'],
                'country' => $validatedData['country'],
                'state_id'  => $validatedData['state_id'] ?? '',
                'district'    => $validatedData['district'] ?? '',
                'consignor_local_address' => $validatedData['consignor_local_address'] ?? '',
                'pincode'    => $validatedData['pincode'],
                'delivery_address_id'    => $validatedData['delivery_address_id'],
                'local_delivery_address'    => $validatedData['local_delivery_address'],
                // 'width'    => $validatedData['width'], 
                // 'height'    => $validatedData['height'], 
                // 'length'    => $validatedData['length'], 
                'remark'    => $validatedData['remark'],
                'amount' => $validatedData['amount'],
                'amount_in_word' => convertNumberToWords($validatedData['amount']),
                'quotation_number' => $validatedData['quotation_number'],
                'quotation_date' => $validatedData['quotation_date'],
                'estmate_deliv_dt'=> $validatedData['estmate_deliv_dt'],

                'dimension' => json_encode($validatedData['dimension']),
                'created_at' => current_time(),
                'user_id' => session()->get('UserId'),
                'comp_id' => session()->get('CompId'),
                'created_by' => session()->get('UserName'),
                'status' => 1,
            ]; 

            // $ins_id =  $db->table('quotation')->insert($data);
            $ins_id = $db->table('quotation')->set($data)->where('id',$id)->update();

            // $lastInsertedId = $db->insertID();
            $lastInsertedId = $id;

            updateVoucherNumber('Quotation');
            $result = $db->table('quotation')->where('id', $lastInsertedId)->set(['parent_quotation_id' => $lastInsertedId])->update();
            if ($ins_id) {
                session()->setFlashdata('success', 'Quotation Update Successfully.');
                return redirect()->to(base_url('company/quotation'));
            } else {
                session()->setFlashdata('error', 'Something Went Wrong.');
                return redirect()->to(previous_url());
            }
        }
    }



    public function getQuotationDetails()
    {
        $id = $this->request->getPost('id');
        $db = \Config\Database::connect();
        $status = 0;
        $result_array =  $db->table('quotation')->where(['parent_quotation_id' => $id])->get()->getResult();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $temp_array = [];
        if (count($result_array) > 0) {
            $status = 1;
            foreach ($result_array as $result) {
                $result->consinor_address = get_consinor_quotoation_address($result->id);
                $result->delivery_address = get_delivery_quotoation_address($result->id);
                $result->consignor_name = get_title('consignors', ['id' => $result->consignor], 'name');
                $result->dimension = $result->dimension != null ? json_decode($result->dimension) : [];
                $temp_array[] = $result;
            }
        }
        return json_encode(['status' => $status, 'result' => $temp_array]);
    }
    public function saveReplayQuotation()
    {
        $db = \Config\Database::connect();
        $postData = $this->request->getPost();
        $postData['parent_quotation_id'] = $postData['id'];
        array_shift($postData);
        if (count($postData['dimension']) > 0) {
            $postData['dimension'] = json_encode($postData['dimension']);
            $postData['status'] = 1;
            $postData['created_at'] = current_time();
            $postData['amount_in_word'] = convertNumberToWords($postData['amount']);
            $postData['user_id']=session()->get('UserId');
            $postData['comp_id']=session()->get('CompId');  
            $postData['created_by']=session()->get('UserName');   
        }
        $db->table('quotation')->where('parent_quotation_id', $postData['parent_quotation_id'])->set(['status' => 0])->update();

        $ins_id =  $db->table('quotation')->insert($postData);
        if ($ins_id) {
            session()->setFlashdata('success', 'Quotation Replayed Successfully.');
            return redirect()->to(base_url('company/quotation'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }
    public function print($id)
    {
        $db = \Config\Database::connect();
        $result =  $db->table('quotation')->where(['id' => $id])->get()->getRow();
        if (empty($result)) {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }

        $result->consinor_address = get_consinor_quotoation_address($result->id);
        $result->delivery_address = get_delivery_quotoation_address($result->id);
        $result->consignor_name = get_title('consignors', ['id' => $result->consignor], 'name');
        $result->dimension = $result->dimension != null ? json_decode($result->dimension) : [];
        $result->consignee_details = $db->table('consignors')->where(['id' => $result->consignor])->get()->getRow();

        $companies_details = $db->table('companies')->where(['id' => session()->get('CompId')])->get()->getRow();
        if (!empty($companies_details)) {
            $companies_details->country_name = get_title('countries', ['id' => $companies_details->country], 'name');
            $companies_details->state_name = get_title('states', ['id' => $companies_details->state], 'name');
            $companies_details->district_name = get_title('cities', ['id' => $companies_details->district], 'name');
        }
        $result->companies_details = $companies_details;
        $data['title'] = 'Quotation Print';
        $data['result'] = $result;
        $model = new termcondition();
        $data['terms'] = $model->where('voucher_id', getVoucherName('Quotation'))->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getRow();
        //   echo $model->getLastQuery();die;
                return view('Company/quotation/print', $data);
    }

    public function getQuotations()
    {
        $db = \Config\Database::connect();
        $status = 0;
        $result_array =  $db->table('quotation')->where(['status' => 1, 'is_approved' => 1, 'is_booked' => 0])->get()->getResult();
        // $result =  $db->table('quotation')->where(['id'=>$id])->get()->getRow(); 
        $temp_array = [];
        if (count($result_array) > 0) {
            $status = 1;
            foreach ($result_array as $result) {
                $result->quotation_date=dispalyDate($result->quotation_date); 
                $result->consinor_address = get_consinor_quotoation_address($result->id);
                $result->delivery_address = get_delivery_quotoation_address($result->id);
                $result->delivery_short_address = delivery_short_address($result->id);
                $result->consignor_name = get_title('consignors', ['id' => $result->consignor], 'name');
                $result->dimension = $result->dimension != null ? json_decode($result->dimension) : [];
                $temp_array[] = $result;
            }
        }
        return json_encode(['status' => $status, 'result' => $temp_array]);
    }
    public function approve($id)
    {
        $db = \Config\Database::connect();
        $checkData = $db->table('quotation')->where('id', $id)->get()->getRow();
        if (empty($checkData)) {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
        $data = [
            'is_approved' => 1
        ];
        $ins_id =  $db->table('quotation')->where('id', $id)->set($data)->update();
        if ($ins_id) {
            session()->setFlashdata('success', 'Quotation Approved Successfully.');
            return redirect()->to(base_url('company/quotation'));
        } else {
            session()->setFlashdata('error', 'Something Went Wrong.');
            return redirect()->to(previous_url());
        }
    }

    public function save_consignor()
    {
        $db = \Config\Database::connect();
        $consinor = new Consignor();
        $model = new codeprefix() ;
        $formData=$this->request->getPost();

        $data['code_prepix'] = $model->where('comp_id',session()->get('CompId'))->where('series_type','Consignor')->get()->getRow();
        $incrment_secondprefix=$data['code_prepix']->second_prefix+1;

        $data = [
            'consignor_code' => $data['code_prepix']->first_prefix.$data['code_prepix']->second_prefix,
            'name' => $formData['name'],
            'mobile' => $formData['mobile'],
            'email'  => $formData['email'],
            'financial_year' => session()->get('FinancialYear'),
            'country'=> $formData['consigne_country'],
            'state'=> $formData['consigne_state'],
            'district'=> $formData['consigne_district'],
            'created' => current_time(),
            'user_id' => session()->get('UserId'),
            'comp_id'    => session()->get('CompId'),
            'created_by' => session()->get('UserName'),
              ]; 

              $dataset = [
                  'second_prefix' => $incrment_secondprefix,
                          ];   
   $model->where('comp_id',session()->get('CompId'))->where('series_type','Consignor')->set($dataset)->update();
            
             
           $consinor->insert($data);
         $lastInsertedId = $consinor->insertID();

                $data= $consinor->where(['id'=>$lastInsertedId])->get()->getRow();
                $data1 = [
                    'id'=>$lastInsertedId,
                    'Name' =>$data->name,
                     ];
              echo json_encode(array("result"=>$data1));   
       
         
    }

}
