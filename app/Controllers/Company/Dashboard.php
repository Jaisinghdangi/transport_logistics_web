<?php

namespace App\Controllers\Company;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] =  'Company Dashboard';
        return view('Company/dashboard', $data);
    }
}
