<?php

namespace App\Models;

use CodeIgniter\Model;

class Series extends Model
{
    protected $table            = 'series';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'series_type',
        'financial_year',
        'start_point',
        'status',
        'comp_id',
        'user_id',
        'symbl',
        'prefix_pos',
        'start_point_pos',
        'financial_year_pos',
        'prefix',
        'start_point',
        'last_series',
        'is_delete',
        'created_by',   
        'created',
        'updated',
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
