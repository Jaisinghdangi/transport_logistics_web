<?php

namespace App\Models;

use CodeIgniter\Model;

class booking_consignment_number extends Model
{

    // allowed fields to manage

    protected $table      = 'booking_consignment_number';
    // allowed fields to manage
    protected $allowedFields    = [
        'id',
        'quotation_no',
         'booking_id',
         'consignment_number',
         'consign_date',
         'consignor_id',   
         'consignee_id',
         'loading_location',
         'unloading_location',
         'user_id',
         'comp_id',
         'created_by',
         'created',
         'status'



     ];
    
   
    }

   

    
    // Validation
