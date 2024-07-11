<?php

namespace App\Models;

use CodeIgniter\Model;

class multiple_booking_vehical extends Model
{

    // allowed fields to manage

    protected $table      = 'multiple_booking_vehical';
    // allowed fields to manage
    protected $allowedFields    = [
         'id',
         'consignor_id',
         'consign_date',
         'consignee_id',
         'eway_bill',
         'eway_bill_date',
         'eway_bill_expire',
         'booking_type',   
         'comp_id',
         'booking_id'
     ];
    
   
    }

   

    
    // Validation
