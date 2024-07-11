<?php

namespace App\Models;

use CodeIgniter\Model;

class vehicalType extends Model
{

    // allowed fields to manage

    protected $table      = 'vehical_type';
    // allowed fields to manage
    protected $allowedFields    = [
          'id',
          'width',
          'height',
          'length',   
          'vehical_type',
          'capacity',
          'groundclearance',
          'is_delete',
          'status',
          'comp_id',
          'created_by',   
          'created',
          'updated',
     ];
    
   
    }

   

    
    // Validation
