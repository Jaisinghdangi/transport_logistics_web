<?php

namespace App\Models;

use CodeIgniter\Model;

class consignorNumber extends Model
{

    // allowed fields to manage

    protected $table      = 'company_consign_numbers';
    // allowed fields to manage
    protected $allowedFields    = [
        'id',
        'start_number',
         'end_number',
         'user_id',
         'comp_id',
         'created_by',   
         'created',
         'updated',
         'is_delete',
         'status'
     ];
    
   
    }

   

    
    // Validation
