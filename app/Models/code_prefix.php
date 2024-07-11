<?php

namespace App\Models;

use CodeIgniter\Model;

class code_prefix extends Model
{

    // allowed fields to manage

    protected $table      = 'code_prefix';
    // allowed fields to manage
    protected $allowedFields    = [
        'id',
        'series_type',
         'first_prefix',
         'second_prefix',
         'comp_id',   
         'user_id',
         'created_by',   
         'created',
         'updated',
         
     ];
    
   
    }

   

    
    // Validation
