<?php

namespace App\Models;

use CodeIgniter\Model;

class Vehicle extends Model
{
    protected $table            = 'vehicles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'broker_id',
        'comp_id', 
        'vehicle_number',
        'model_number',
        'make',
        'color',
        'registered_date',
        'chassis_number',
        'engine_number',
        'tax_token',
        'road_permmit',
        'fitness_validity',
        'finance_country',
        'finance_state',
        'finance_district',
        'insurance_date',
        'insurance_by',
        'certificate',
        'division_number',
        'financed_by',
        'financed_address',
        'created',
        'updated',
        'created_by',
        'updated_by',
        'is_delete',
        'status',
        // driver columns
        'driver_name',
        'driver_country',
        'driver_state',
        'driver_district',
        'driver_address',
        'driving_licence_no',
        'licence_validity',
        'driver_mobile',
        'vehicle_class',
        'vehicle_description',
        'fuel_type',
        'emission_norm',
        'seat_capacity',
        'standing_capacity',
        'insurance_policy_no',
        'puccno',
        'pucc_validity',
        'national_permit_no',
        'national_permit_validity',
        'permit_validity',
        'owner_name',
        'owner_relative',
        'owner_mobile',
        'owner_address',
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