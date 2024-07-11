<?php

namespace App\Models;

use CodeIgniter\Model;

class termsCondition extends Model
{

    // allowed fields to manage

    protected $table      = 'term_and_condition';
    // allowed fields to manage
    protected $allowedFields    = [
        'id',
        'voucher_id',
         'description',
         'comp_id',
         'created_by',   
         'created',
         'updated',
         'updated_by',
         'is_delete',
         'status'
     ];
    
   
    }

   

    
    // Validation
