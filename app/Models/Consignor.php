<?php

namespace App\Models;

use CodeIgniter\Model;

class Consignor extends Model
{
    protected $table            = 'consignors';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'consignor_code',
        'consignor_type',
        'name',
        'nickname',
        'email',
        'mobile',   
        'alternet_mobile',
        'country',
        'state',
        'district',
        'address_1',
        'address_2',
        'address_3',
        'pin_code',
        'gst_number',
        'pan_number',
        'tan_number',
        'msme_number',
        'ies_number',
        'contact_person_mobile',
        'contact_person',
        'company_website',
        'ac_type',
        'ac_number',
        'bank_name',
        'ifsc_code',
        'financial_year',
        'status', 
        'gst_status',
        'msme_status',
        'user_id',
        'created_by',
        'created',
        'updated',
        'is_delete',
        'comp_id', 
        'msme_number',
        'iec_number',
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
