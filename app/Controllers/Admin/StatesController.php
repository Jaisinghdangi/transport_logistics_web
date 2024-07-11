<?php
    namespace App\Controllers\Admin;
    
    use App\Controllers\BaseController;
    use App\Models\CustomModel;
    use App\Models\Country;
    use App\Models\State;

    class StatesController extends BaseController
    {
        private $CustomModel = null;
        
        public function __construct()
        {
            $this->validation = \Config\Services::validation();
            $this->CustomModel = new CustomModel();
            $this->country = new Country();
            $this->state = new State();
        }
        
        public function index() 
        {
            $data['title'] = 'States';  
            $data['states'] = $this->state->select('id, name, country_id, status, state_code')->where('is_delete', 1)->get()->getResult();
            return view('Masters/States/Index', $data);
        }
        
        public function add() 
        {
            $data['title'] = 'Add States';
            $data['countries'] = $this->country->where('is_delete', 1)->get()->getResult();
            return view('Masters/States/Create', $data);
        }
        
        public function store() 
        {
            $validatedData = $this->request->getPost(); 
            $validationRule = [
                'country_id' => 'required',
                'name'    => [
                    'rules'=>'required|is_unique[states.name]',
                    'errors' => [
                        'required' => 'The name field is required.',
                        'is_unique' => 'The name field must be unique.',
                    ],
                ],
                'state_code'    => [
                    'rules'=>'required|is_unique[states.state_code]',    
                    'errors' => [
                        'required' => 'The State Code field is required.',
                        'is_unique' => 'The State Code field must be unique.',
                    ], 
                ] 
            ]; 
            $this->validation->setRules($validationRule);  
            if (!$this->validation->withRequest($this->request)->run()) {  
                return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
            } else{ 
                $model = new State();
                $data = [
                    'country_id' => $validatedData['country_id'],
                    'name'    => $validatedData['name'],
                    'state_code'    => $validatedData['state_code'], 
                ];  
                $ins_id = $model->insert($data);
                if($ins_id){ 
                    session()->setFlashdata('success', 'State Add Successfully.');
                    return redirect()->to(base_url('admin/states')); 
                }else{
                    session()->setFlashdata('error', 'Something Went Wrong.');
                    return redirect()->to(previous_url()); 
                }
            }   
        } 
        
        public function update($id) 
        {
            $validatedData = $this->request->getPost(); 
            $validationRule = [
                'country_id' => 'required',
                'name'    => [
                    'rules'=>'required|is_unique[countries.name,countries.id,'. $id . ']',
                    // 'rules'=>'required|is_unique[states.name]',
                    'errors' => [
                        'required' => 'The name field is required.',
                        'is_unique' => 'The name field must be unique.',
                    ],
                ],
                'state_code'    => [
                    'rules'=>'required|is_unique[states.state_code]',    
                    'errors' => [
                        'required' => 'The State Code field is required.',
                        'is_unique' => 'The State Code field must be unique.',
                    ], 
                ] 
            ]; 
            $this->validation->setRules($validationRule);  
            if (!$this->validation->withRequest($this->request)->run()) {  
                return redirect()->to(previous_url())->withInput()->with('errors', $this->validation->getErrors()); 
            } else{ 
                $model = new State();
                $data = [
                    'country_id' => $validatedData['country_id'],
                    'name'    => $validatedData['name'],
                    'state_code'    => $validatedData['state_code'], 
                ];   
                $ins_id = $model->where('id',$id)->set($data)->update();
                if($ins_id){ 
                    session()->setFlashdata('success', 'State Updated Successfully.');
                    return redirect()->to(base_url('admin/states')); 
                }else{
                    session()->setFlashdata('error', 'Something Went Wrong.');
                    return redirect()->to(previous_url()); 
                }
            }   
        } 
        
        public function status($id){
            $state = $this->state->where('id',$id)->get()->getRow();
            $update = [];
            if($state->status){
                $update['status'] = 0;
            }else{
                $update['status'] = 1;
            }
            $this->state->where('id',$id)->set($update)->update();
            session()->setFlashdata('success', 'Status Changed Successfully.');
            return redirect()->to(previous_url()); 
        }
    
        public function edit($id){
            $data['state'] = $this->state->where('id',$id)->get()->getRow();
            $data['countries'] = $this->country->where('is_delete', 1)->get()->getResult();
            $data['title'] = 'Update State';
            return view('Masters/States/Edit',$data);
        }
        
        public function delete($id)
        {
            $model = new State();
            $country = $model->where('id',$id)->get()->getRow(); 
            $update['is_delete'] = 0; 
            $model->where('id',$id)->set($update)->update();
            session()->setFlashdata('success', 'State Deleted Successfully.');
            return redirect()->to(previous_url()); 
        }
    }