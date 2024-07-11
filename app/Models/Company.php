<?php

namespace App\Models;

use CodeIgniter\Model;

class Company extends Model
{
    protected $table            = 'companies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'company_name',
        'comp_code',
        'comp_type',
        'company_mobile'   ,
        'alternet_mobile'   ,
        'company_email'   ,
        'country',
        'state',
        'district'   ,
        'address_1'   ,
        'address_2'   ,
        'address_3'   ,
        'pin_code'   , 
        'gst_number'   ,
        'pan_number'   ,
        'tan_number'   ,
        'msme_number'   ,
        'ies_number'   , 
        'contact_person'   ,
        'contact_person_mobile'   , 
        'company_website'   , 
        'ac_type'   , 
        'ac_number'   , 
        'bank_name'   , 
        'pf_no'   , 
        'esi_no'   , 
        'est_no'   , 
        'financial_year'   ,
        'status'   ,
        'user_id'   ,
        'created_by'   ,
        'created'   ,
        'updated'   ,
        'is_delete'   ,
        'cin_number',
        'iso_number',
        'contact_person_email',
        'gst_status',
        'msme_status',
        'ifsc_code',
        'iec_number',
        'pf_number',
        'esi_number',
        'pt_number',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
