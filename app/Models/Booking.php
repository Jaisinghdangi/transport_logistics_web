<?php

namespace App\Models;

use CodeIgniter\Model;

class Booking extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'quatation_id',
        'comp_id',
        'booking_no',
        'date',
        'booking_type',
        'loading_type',
        'unloading_type',
        'booking_amount',
        'rto_fine',
        'advance_pay',
        'statical_charge',
        'detention_charge_loading',
        'detention_charge_unloading',
        'total_payable',
        'total_cgst',
        'total_sgst',
        'total_igst',
        'net_amount',
        'financial_year',
        'user_id',
        'quotationNumber',
        'cr_id',
        'cr_country',
        'cr_state_id',
        'cr_district',
        'cr_address',
        'ce_pincode',
        'ce_pincode_id',
        'ce_address',
        'quotation_date',
        'amount_in_word',
        'dimension',
        'billingCustomerId',
        'remark',
        'consignee_id',
        'vehical_id',
        'vehical_number',
        'driver_name',
        'driver_address',
        'driver_mobile',
        'driving_licence_no',
        'driving_validity',
        'owner_name',
        'owner_address',
        'owner_mobile',
        'broker_id',
        'total_broker_amount',
        'vehicle_type',
        'estmate_deliv_dt',
        'created_by',
        'created',
        'updated',
        'is_delete',
        'status',
    ];

    protected bool $allowEmptyInserts = false;

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
