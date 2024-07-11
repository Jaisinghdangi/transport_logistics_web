<?php

namespace App\Models;

use CodeIgniter\Model;

class Broker extends Model
{
    protected $table            = 'brokers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 
        'broker_code',
        'broker_type',
        'name',
        'nickname',
        'mobile',
        'alternet_mobile',
        'email',
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
        'iec_number',
        'msme_number',
        'contact_person',
        'contact_person_mobile',
        'company_website',
        'ac_type',
        'ac_number',
        'bank_name',
        'ifsc_code',
        'tds_status',
        'gst_status',
        'msme_status',
        'contact_person_email',
        'comp_id',
        'created',
        'created_by', 
        'updated',
        'updated_by',
        'is_delete',
        'status',
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
