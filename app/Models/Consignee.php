<?php

namespace App\Models;

use CodeIgniter\Model;

class Consignee extends Model
{
    protected $table            = 'consignees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'consignee_code',
        'consignee_type',
        'name',
        'nickname',
        'alternate_mobile',
        'email',
        'mobile',
        'country',
        'state',
        'district',
        'pin_code',
        'address_1',
        'address_2',
        'address_3',
        'gst_number',
        'pan_number',
        'tan_number',
        'msme_number',
        'ies_number',
        'contact_person',
        'contact_person_mobile',
        'company_website',
        'ac_type',
        'ac_number',
        'bank_name',
        'pf_no',
        'esi_no',
        'est_no',
        'financial_year',
        'created_by',
        'user_id',
        'status',
        'gst_status',
        'msme_status',
        'is_delete',
        'comp_id',
        'created',
        'updated',
        'ifsc_code',
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
