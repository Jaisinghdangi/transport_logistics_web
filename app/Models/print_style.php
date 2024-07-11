<?php

namespace App\Models;

use CodeIgniter\Model;

class print_style extends Model
{

    // allowed fields to manage

    protected $table      = 'print_style';
    // allowed fields to manage
    protected $allowedFields    = [
        'id',
        'print_type',
         'bg_color',
         'text_color',   
         'text_font',
         'comp_id',
         'status'
     ];
    
   
    }

   

    
    // Validation
