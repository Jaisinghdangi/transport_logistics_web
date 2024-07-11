<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
  @font-face {
    font-family: Orbitron-Bold_iq;
    src: url("fonts/Orbitron-Bold_iq.woff") format("woff");
  }

  .container-main {
    border: 1px solid #000;
  }

  .container-main h4 {
    font-weight: bolder;
  }

  .logo {
    width: 140px;
  }

  .text-left {
    text-align: left;
  }

  .text-right {
    text-align: right;
    font-weight: 500;
    font-size: 10px;
  }

  h6 {
    font-family: Orbitron-Bold_iq;
    color: #002060;
    font-size: 18px;
  }

  .text-detail p {
    font-size: 12px;
    margin-bottom: 0;
    font-weight: bold;
  }

  .text-detail p span {
    font-weight: 500;
  }

  .side-detail p {
    font-size: 10px;
    margin-bottom: 0;
    font-weight: bolder;
  }

  .side-detail p span {
    padding: 3px;
    border: 1px solid #000;
    display: inline-block;
    width: 140px;
    font-weight: 500;
    color: #000;
  }

  .invoice-no {
    background-color: #e68422;
    color: #fff !important;
    font-weight: bold !important;
  }

  .pl-5 {
    padding-left: 1.5rem;
  }

  .inside-container-fluid {
    height: 100%;
    border: 1px solid #000;
  }

  .inside-container-left {
    border-width: 1px 1px 1px 0;
  }

  .inside-container-right {
    border-width: 1px 0 1px 1px;
  }

  .inside-container-fluid h5 {
    background-color: #00297a;
    color: #fff;
    font-size: 12px;
    padding: 5px;
    text-align: center;
  }

  .text-bold {
    font-weight: bold;
  }

  .table-address td {
    border: none !important;
    font-size: 12px;
    color: #000;
    padding-top: 0;
    padding-bottom: 0;
  }

  .detail-table th,
  .detail-table td {
    border: 1px solid #000;
    font-size: 10px !important;
  }

  .detail-table td {
    border: 1px solid #000;
    border-width: 0 1px !important;
    /* background-color: #f5f5f5; */
  }

  .detail-description {
    text-align: justify !important;
  }

  .detail-description div:first-child {
    margin-top: 0 !important;
  }

  .detail-description div:last-child {
    margin-bottom: 0 !important;
  }

  .detail-description>div {
    margin: 100px 0;
  }

  .detail-table th {
    background-color: #00297a;
    color: #fff;
    font-size: 12px;
    white-space: nowrap;
  }

  .w-90px {
    width: 110px;
  }

  .detail-table td {
    font-size: 13px;
    color: #000;
    font-weight: 500;
  }

  .detail-table tr:last-child td {
    border-bottom-width: 1px !important;
  }

  .table-down {
    justify-content: space-between;
  }

  .below-table {
    width: 240px;
  }

  .below-table div {
    padding: 0;
  }

  .below-table div p {
    margin: 0;
    text-align: left;
    border: 1px solid #000;
    padding: 0 10px;
    font-size: 12px;
    font-weight: 500;
  }

  .bg-color {
    background-color: #00297a;
    color: #fff;
  }

  .font-small {
    font-size: 12px;
  }

  .bg-orange {
    background-color: #e68422;
    color: #fff;
  }

  .mr-2 {
    margin-right: 1rem !important;
  }

  .ml-2 {
    margin-left: 1rem !important;
  }

  .width-fix {
    width: fit-content !important;
  }

  .sign-container-fluid {
    border-width: 1px 0 0 0 !important;
    border: 1px solid #000;
  }

  .sign {
    margin-left: auto;
  }

  .sign p {
    font-weight: bold;
  }

  .conditions li {
    list-style-type: decimal;
    font-size: 10px !important;
    text-align: justify;
  }

  .font-18 {
    font-size: 18px;
  }

  .pl-0 {
    padding-left: 0 !important;
  }

  .oneline {
    white-space: nowrap;
  }



  .below-right .row {
    justify-content: flex-end;
  }
</style>
<div class="container-fluid mx-0" id="headerrefresh">
<!-- ; -->
<?php  //print_r($split_bill);
// $total_payable =0;
$net_payable =0;
$net_fraight=0;
$igst=0;
$cgst=0;
$sgst=0;

for($i=1; $i <= $printpage; $i++){  ?>

  <div class="container-main py-1" style="margin-top: 27px;background: #fff;" >
    <img class="logo pl-5" src="<?= base_url('Assets/Images/logo.png') ?>" alt="logo" />
    <form action="<?= base_url('company/add-invoice') ?>" method="POST" enctype="multipart/form-data" id="yourFormId">
    <input type="hidden" name="booking_id" id="booking_id" value="<?= $booking->id ?>" />
    <div class="row pl-5 pr-0">
      <div class="col-sm-7 p-0">
        <?php if ($companies_details) {
          $companies_info = $companies_details;
        ?>

          <h6 class="oneline"><?= $companies_info->company_name ?></h6>
          <div class="text-detail">
            <p>(An <?= $companies_info->iso_number ?> Certified Company)</p>
            <p class="col-sm-10">
              Registered office :
              <span># <?= $companies_info->address_1 ?>, PAN <?= $companies_info->pan_number ?>,
                <?= $companies_info->district_name ?>, <?= $companies_info->state_name ?>-<?= $companies_info->pin_code ?>,<?= $companies_info->country_name ?></span>
            </p>
            <p>
              Ph:<span>
                <a href="tel: +91-<?= $companies_info->company_mobile ?>"> +91 <?= $companies_info->company_mobile ?></a></span>
              Email:<span>
                <a href="mailto: <?= $companies_info->company_email ?>">
                  <?= $companies_info->company_email ?></a></span>
              Website:<span><a href="<?= $companies_info->company_website ?>"> <?= $companies_info->company_website ?></a></span>
            </p>
            <p>CIN : <?= $companies_info->cin_number ?></p>
            <p>Booking Type : <span><?= $booking_type ?></span> </p>
            <p>Loading point: <span><?= $loading_point ?></span> </p>
            <p>Delivery point: <span> <?= $delivery_point ?></span></p>
          </div>
        <?php } ?>
      </div>
      <div class="col-sm-5 text-right pl-0">
        <div class="side-detail">
        <?php
$prefix = getMultiVoucherNumber('Invoice')['prefix'];
$number = getMultiVoucherNumber('Invoice')['number'] + $i - 1;
$formattedNumber = str_pad($number, strlen(getMultiVoucherNumber('Invoice')['number']), '0', STR_PAD_LEFT);
?>
          <p>INVOICE NO. <span class="invoice-no"><?//= getVoucherNumber('Invoice'); ?><?= $prefix . $formattedNumber; ?></span></p>
          <!-- <input type="hidden" name="multiinvoiceNumber[]" value="<?//= $prefix . $formattedNumber; ?>"> -->
          <p>QUATATION NO. <span><?= $result->quotation_number ?></span></p>
          <p>BOOKING NO. <span><?= $booking->booking_no ?> </span></p>
          <p>BOOKING DATE <span><?= date('d-m-Y', strtotime($booking->date)); ?></span></p>
          <p>ENQUIRY DATE <span><?= date('d-m-Y', strtotime($result->quotation_date)); ?></span></p>
          <p>CHALLAN NUMBER <span><?= $booking->challan_number ?></span></p>
          <p>CHALLAN DATE <span><?= $booking->challan_date ?></span></p>
          <p>FROM <span><?= $result ? strtoupper($result->state_name) : ''; ?> </span></p>
          <p>TO <span><?= $consignee_details ? strtoupper($consignee_details->District) : ''; ?> </span></p>
          <p>PLACE OF SUPPLY <span><?= $consignee_details ? strtoupper($consignee_details->StateName) : ''; ?> </span></p>
         <?php if($i == 1){?> <p id="showsplit"><a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="openpinmodel">split Bill</a> </p> <?php  }  ?>
        </div>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-sm-6">
        <div class="inside-container-fluid inside-container-left">
          <h5>Billing Customer & <?php if ($booking_type == 'Paid') {
                                    echo "Consignor";
                                  } else {
                                    echo "Consignee";
                                  } ?> Details</h5>
          <table class="table table-address mb-0">
            <?php if ($booking_type == 'Paid') { ?>
              <tr>
                <td class="text-bold">Name:</td>
                <td>
                  <?= strtoupper(getConsinorName($MultiBookingVehical[$i-1]->consignor_id)) ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper(get_consinor_address($MultiBookingVehical[$i-1]->consignor_id)) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= getConsinorGST($MultiBookingVehical[$i-1]->consignor_id) ;?></td>
              </tr>
            <?php } else if ($booking_type == 'To Pay') {  ?>
              <tr>
                <td class="text-bold">Name:</td>
                <td>
                  <?= strtoupper(getConsineeName($MultiBookingVehical[$i-1]->consignee_id)); ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper(get_consinee_address($MultiBookingVehical[$i-1]->consignee_id)) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= getConsineeGST($MultiBookingVehical[$i-1]->consignee_id);?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="inside-container-fluid inside-container-right">
          <h5><?php if ($booking_type == 'To Pay') {
                echo "Consignor";
              } else {
                echo "Consignee";
              } ?> Details</h5>
          <table class="table table-address mb-0">
            <?php if ($booking_type == 'To Pay') { ?>
              <tr>
                <td class="text-bold">Name:</td>
                <td>
                  <?= strtoupper(getConsinorName($MultiBookingVehical[$i-1]->consignor_id)) ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper(get_consinor_address($MultiBookingVehical[$i-1]->consignor_id)) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= getConsinorGST($MultiBookingVehical[$i-1]->consignor_id) ;?></td>
              </tr>
            <?php } else{  ?>

              <tr>
                <td class="text-bold">Name:</td>
                <td>
                  <?= strtoupper(getConsineeName($MultiBookingVehical[$i-1]->consignee_id)); ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper(get_consinee_address($MultiBookingVehical[$i-1]->consignee_id)) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= getConsineeGST($MultiBookingVehical[$i-1]->consignee_id);?></td>
              </tr>

            <?php } ?>
          </table>
        </div>
      </div>
    </div>

    <div class="container-fluid" >
      <div class="row text-center justify-content-center">
        <table class="table detail-table mb-0">
          <thead>
            <th class="w-90px">CONSGT DATE</th>
            <th class="w-90px">CONSGT NO.</th>
            <th>DESCRIPTION OF GOODS/SERVICES</th>
            <th class="w-90px">TYPES OF VEHICLE</th>
            <th class="w-90px">AMOUNT</th>
          </thead>
          <tr>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">
              <div>
                <div>
                  Being the amount charged towards transportation of your
                  materials/ machine from <?= $result ? $result->state_name : ''; ?> to <?= $consignee_details ? $consignee_details->District : ''; ?>, <?= $consignee_details ? $consignee_details->StateName : ''; ?> by
                  Vehicle No. <?= $booking->vehical_number ?>
                </div>
                <div>
                </div>
              </div>
            </td>
            <td>Open Truck</td>
            <td class="text-right"><?php 
             $total_payable =0;
             echo ($split_bill) ? indian_rupee($split_bill[$i-1]->booking_amt) : ''; ?>
             </td>
          </tr>
          <?php     //foreach ($consign_data as $key => $consign_value) {
            
            $previous_consignor_id = null; // Initialize previous consignor_id
            foreach($bookingConsignNum as $value) {
            if ($MultiBookingVehical[$i-1]->booking_id == $value->booking_id && $MultiBookingVehical[$i-1]->consignor_id == $value->consignor_id) {
            ?>
            <tr>
              <td><?php echo $MultiBookingVehical[$i-1]->consign_date;?></td>
              <td><?= $value->consignment_number; ?></td>
              <td class="text-left"><?= $value->service_description ;?></td>

              <td></td>
              <td></td>
            </tr>
          <?php 
           if ($previous_consignor_id !== $value->consignor_id) {
            $previous_consignor_id = $value->consignor_id;
        }
    
        if ($previous_consignor_id !== $value->consignor_id) {
            break;
        } 
    }
   
        } 
          
          
          ?>
          <?php if($booking->rto_fine >0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">RTO Fine, if any</td>
            <td></td>
            <td class="text-right"> <?= ($split_bill) ? indian_rupee($split_bill[$i-1]->rto_fine) : '0.00'; ?></td>
          </tr>
          <?php } ?>
          <?php if($booking->statical_charge>0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">Statistical Charges</td>
            <td></td>
            <td class="text-right"> <?= ($split_bill) ? indian_rupee(indian_rupee($split_bill[$i-1]->statical_charge)) : '0.00'; ?></td>
          </tr>
          <?php } ?>
          <?php if($booking->detention_charge_loading>0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">Detention Charges at Loading Point</td>
            <td></td>
            <td class="text-right"> <?= ($split_bill) ? indian_rupee($split_bill[$i-1]->detention_charge_loading) : '0.00'; ?></td>
          </tr> 
          <?php } ?>
          <?php if($booking->detention_charge_unloading>0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">Detention Charges at Unloading Point</td>
            <td></td>
            <td class="text-right"> <?= ($split_bill)? indian_rupee($split_bill[$i-1]->detention_charge_unloading) : '0.00'; ?></td>
          </tr>
          <?php } ?>
        </table>
        <?php
        
        $total_payable += ( (($split_bill) ? $split_bill[$i-1]->booking_amt : 0) + (($split_bill) ? $split_bill[$i-1]->rto_fine : 0) + (($split_bill) ? $split_bill[$i-1]->statical_charge : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_loading : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_unloading : 0) );
     
        $net_payable += ( (($split_bill) ? $split_bill[$i-1]->booking_amt : 0) + (($split_bill) ? $split_bill[$i-1]->rto_fine : 0) + (($split_bill) ? $split_bill[$i-1]->statical_charge : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_loading : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_unloading : 0) );
       
        $net_fraight += ($split_bill ? $split_bill[$i-1]->booking_amt : 0 );

        $total_amount = $booking->booking_amount + $booking->detention_charge_unloading + $booking->detention_charge_loading + $booking->statical_charge + $booking->rto_fine; ?>
        <?php $net_amount = $booking->total_cgst + $booking->total_sgst + $booking->total_igst + $total_amount;  ?>
        <div class="row table-down px-0">
          <div class="below-table my-4">
            <div class="row">
              <div class="w-90px">
                <p>Total Freight</p>
              </div>
              <div class="w-90px">
                <p><?= $split_bill ? indian_rupee($split_bill[$i-1]->booking_amt) : '0.00'; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>Advance Paid </p>
              </div>
              <div class="w-90px">
                <p> <?= $split_bill ? indian_rupee($split_bill[$i-1]->advance_pay) : '0.00'; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>Balance</p>
              </div>
              <div class="w-90px">
                <p><?= $split_bill ? indian_rupee($total_payable - $split_bill[$i-1]->advance_pay) : 0; ?></p>
                
              </div>
            </div>
          </div>
          <?php //$gst_data=calculate_gst($net_amount,$booking); 
        $gst_data=multiple_calculate_gst($total_payable,$MultiBookingVehical[$i-1]->consignor_id,$MultiBookingVehical[$i-1]->consignee_id,$booking);
         
//         print_r($gst_data);
//            $gst_data['cgst']=null;
//            $gst_data['sgst']=null;
//            $gst_data['igst']=null;
// echo $gst_data['cgst'];
          $booking->total_cgst=$gst_data['cgst'];
          $booking->total_sgst=$gst_data['sgst'];
          $booking->total_igst=$gst_data['igst']; 
          $net_amount=$total_payable+$gst_data['cgst']+$gst_data['sgst']+$gst_data['igst'];
          ?>
          <div class="below-table below-right">
            <div class="row">
              <div class="w-90px bg-color">
                <p>TOTAL PAYABLE</p>
              </div>
              <div class="w-90px bg-color">
                <p style="text-align:right !important;"><?= $total_payable; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>CGST @ 2.5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?php echo indian_rupee($gst_data['cgst']); $cgst +=$gst_data['cgst']; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>SGST @ 2.5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?php echo indian_rupee($gst_data['sgst']); $sgst +=$gst_data['sgst']; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>IGST @5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?php echo  indian_rupee($gst_data['igst']); $igst += $gst_data['igst'] ;?></p>
              </div>
            </div>

            <div class="row">
              <div class="w-90px">
                <p>TOTAL</p>
              </div>
              <div class="w-90px">
               
                <p style="text-align:right;"><?= indian_rupee($net_amount) ?></p>
              </div>
            </div>
          </div>
        </div>

          <?php if($i == $printpage){  
            
            ?>
            <div class="row table-down px-0">
              <hr><div style="font-weight: 600;">Total Final Calculation</div><hr>
            <div class="below-table my-4">
            <div class="row">
              <div class="w-90px">
                <p>Total Freight</p>
              </div>
              <div class="w-90px">
                <p><?= $booking ? indian_rupee($net_fraight) : '0.00'; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>Advance Paid </p>
              </div>
              <div class="w-90px">
                <p> <?= $booking ? indian_rupee($booking->advance_pay) : '0.00'; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>Balance</p>
              </div>
              <div class="w-90px">
                <p><?= indian_rupee($net_payable - $booking->advance_pay) ?></p>
                
              </div>
            </div>
          </div>

            <div class="below-table below-right">
            <div class="row">
              <div class="w-90px bg-color">
                <p>TOTAL PAYABLE</p>
              </div>
              <div class="w-90px bg-color">
                <p style="text-align:right !important;"><?=$net_payable; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>CGST @ 2.5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?= indian_rupee($cgst) ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>SGST @ 2.5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?= indian_rupee($sgst) ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>IGST @5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?= indian_rupee($igst); ?></p>
              </div>
            </div>

            <div class="row">
              <div class="w-90px">
                <p>TOTAL</p>
              </div>
              <div class="w-90px">
               
                <p style="text-align:right;"><?= indian_rupee($net_payable + $igst + $cgst +$sgst); ?></p>
              </div>
            </div>
          </div>
            </div>
        <div class="row p-0">
          <div class="col-sm-9 p-0">
            <p class="bg-color font-small text-left px-3 mb-1">
              Payable (Amount in Words): <?= ucfirst(convertNumberToWords($net_payable + $igst + $cgst +$sgst)); ?>
            </p>
          </div>
          <div class="col-sm-6 p-0 ">
            <p class="mb-0 font-small text-left px-3 bg-orange mr-2">
              TDS - NIL as per Section 194 (C) of Income Tax Act, 1961
            </p>
          </div>
         
          <?php //if(checkBillingCustomerGst($booking)==1){ ?>
          <div class="col-sm-6 p-0">
            <p class="mb-0 font-small text-left px-3 bg-color ml-2">
              Note: GST is payable by recipient of service under Reverse
              Charge Mechanism
            </p>
          </div>
          <?php //} ?>
            <br>
            <br> 
          <div class="col-sm-12 p-0 ">  
            <textarea cols="12" rows="2" name="remark" id="remark" class="form-control" placeholder="Enter Here Remark ..." required></textarea>
          </div>
          <input type="hidden" name="total_amount" id="total_amount" value="<?= ($net_payable + $igst + $cgst +$sgst) ?>" />
          <input type="hidden" name="freight_charge" id="freight_charge" value="<?= $net_fraight ?>" />
          <?php 
            $prefix = getMultiVoucherNumber('Invoice')['prefix'];

            for($ii=1; $ii <= $printpage; $ii++){ 
            $number = getMultiVoucherNumber('Invoice')['number'] + $ii - 1;
            $formattedNumber = str_pad($number, strlen(getMultiVoucherNumber('Invoice')['number']), '0', STR_PAD_LEFT);
            ?>
            <input type="hidden" name="multiinvoiceNumber[]" value="<?= $prefix . $formattedNumber; ?>">
            <input type="hidden" name="invoiceindex[]" value="<?= $ii;?>">

            <?php } ?>
          <input type="hidden" name="total_sgst" id="total_sgst" value="<?= $cgst ?>" />
          <input type="hidden" name="total_cgst" id="total_cgst" value="<?= $sgst ?>" />
          <input type="hidden" name="total_igst" id="total_igst" value="<?= $igst ?>" />
          <input type="hidden" name="amount_in_word" id="amount_in_word" value="<?= ucfirst(convertNumberToWords($net_payable + $igst + $cgst +$sgst)) ?>" />

          <div class="col-sm-12 sign-container-fluid mt-1 py-1  ">
            <div class="d-flex justify-content-end py-3">
            <!-- <input type="submit" class="btn btn-primary btn-sm" form="yourFormId" value="Submit" id="mainform"/> -->

              <button type="submit" class="btn btn-success" style="display:none;"  id="mainform">Submit</button>
              <!-- <button type="button" class="btn btn-warning ms-2">Modify</button> -->
              <button type="button" class="btn btn-success"  id="checkform">Submit</button>
            </div>
          </div>

        </div>
        <?php } ?>
      </div>
    </div>
                </form>
  </div>
  <?php  } ?>

</div>



<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Split Bill</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-body">
                    <form action="#" method="POST" id="create-form">
                        <div class="row">
<div class="card-body">
    <div class="row">
           
    <table class="table table-bordered" >
<thead class="appendheading">
<th style="background-color: #00297a;" ><h5 style="color:white;">Booking Fields</h5></th>
 <?php for($i=1; $i <= $printpage; $i++){ ?>
  <th style="background-color: #00297a;"><h5 style="color:white;"><?= ($booking_type == 'Paid') ? 'Consignor': 'Consignee' ;?></h5></th>
  <?php  } ?>
</thead>
<tbody>
    <tr class="append_split_table">
    <td class="text-left" style="width:29.66666667%;"><table class="table table-address table-pad mb-0" border="0"><tr><td class="text-bold">Consignee Name</td></tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Booking Amount:<input type="text"  value="<?= $booking ? $booking->booking_amount : '0';?>" id="tot_bookingamt" style="float: right;" disabled>
                    <input type="hidden" value="<?= $booking->id ?>" name="booking_id_new" id="bookingnewid"></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">RTO Fine, if any:<input type="number" value="<?= $booking ? $booking->rto_fine : '0' ; ?>" id="tot_rto_fine" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Advance, if any:<input type="number" value="<?= $booking ? $booking->advance_pay : '0'; ?>" id="tot_advance_pay" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Statical Charge:<input type="number" value="<?= $booking ? $booking->statical_charge : '0'; ?>" id="tot_statical_charge" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Loading Point Charges:<input type="number" value="<?= $booking ? $booking->detention_charge_loading : '0'; ?>" id="tot_charge_loading" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Unloading Point Charges:<input type="number" value="<?= $booking ? $booking->detention_charge_unloading : '0'; ?>" id="tot_charge_unloading" style="float: right;" disabled></td>
                </tr>
            </table>
        </td>
        <?php for($i=1; $i <= $printpage; $i++){ ?>
          <td>
        <table class="table table-address table-pad mb-0">
            <tr>
                <td class="text-bold" style="width: 30%;"><?= ($booking_type == 'Paid') ? getConsinorName($MultiBookingVehical[$i-1]->consignor_id) : getConsineeName($MultiBookingVehical[$i-1]->consignee_id) ;?>
                <input type="hidden" name="consignor_id[]" value="<?= $MultiBookingVehical[$i-1]->consignor_id;?>">
                <input type="hidden" name="consignee_id[]" value="<?= $MultiBookingVehical[$i-1]->consignee_id;?>">
            
                </td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="booking_amt[]" class="form-control" style="width:65%;" value="<?=$split_bill ? indian_rupee($split_bill[$i-1]->booking_amt) : ''; ?>" onchange="validateBookingAmount(this,'booking_amt[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="rto_fine[]" class="form-control"  value="<?=$split_bill ? indian_rupee($split_bill[$i-1]->rto_fine) : ''; ?>" style="width: 65%;" onchange="validateBookingAmount(this,'rto_fine[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="advance_pay[]" class="form-control"  value="<?=$split_bill ? indian_rupee($split_bill[$i-1]->advance_pay) : ''; ?>" style="width:65%;" onchange="validateBookingAmount(this,'advance_pay[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="statical_charge[]" class="form-control" value="<?=$split_bill ? indian_rupee($split_bill[$i-1]->statical_charge) : ''; ?>" style="width: 65%;" onchange="validateBookingAmount(this,'statical_charge[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="detention_charge_loading[]" class="form-control"  value="<?=$split_bill ? indian_rupee($split_bill[$i-1]->detention_charge_loading) : ''; ?>" style="width:65%;" onchange="validateBookingAmount(this,'detention_charge_loading[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="detention_charge_unloading[]" class="form-control"  value="<?=$split_bill ? indian_rupee($split_bill[$i-1]->detention_charge_unloading) : ''; ?>" style="width: 65%;" onchange="validateBookingAmount(this,'detention_charge_unloading[]')" required></td>
            </tr>
        </table>
    </td>
          <?php }  ?>
    </tr>
</tbody>
</table>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
            <input type="submit" class="btn btn-primary btn-sm" form="create-form" value="Submit" id="onsubmit"/>
            <input type="reset" class="btn btn-danger btn-sm" />
        </div>
    </div>
</div>
</form>
                        </div>
                      
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>

let clickCount = 0;

$(document).on("click", "#checkform", function(){
var remark =$('#remark').val();
 if(remark !='' ){
      clickCount++;
    $('#showsplit').show();
     $('#myModal').modal('show');
     $('#openpinmodel').click();
    $("#openpinmodel").trigger('click');
  //  $('#mainform').show();
  //  $('#checkform').hide();
 
    }else{
   alert('Filled remark !');
   $('#remark').focus();

}
});





$("#create-form").submit(function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    $.ajax({
        url: '<?= base_url() ?>save-split-bill-data',
        method: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#onsubmit').attr('disabled', 'disabled');

        },
        success: function(data) {
            res = JSON.parse(data);
            var remark1 =$('#remark').val();

            if(res.status == '1'){
             $('.modal').find('.close').click();
             $("#myModal").modal('hide');
      $("#headerrefresh").load(location.href + " #headerrefresh", function() {
          $('#remark').val(remark1);
           $('#mainform').show();
         $('#checkform').hide();
    });
             
        }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText,'error accured');
        }
    });
});



function validateBookingAmount(input,name) {
    var bookingAmtInputs ='';
    var totBookingAmt ='';
    var alertmsg ='';
    if(name == 'booking_amt[]'){

     bookingAmtInputs = $('input[name="booking_amt[]"]');
     totBookingAmt = parseFloat($('#tot_bookingamt').val());
     alertmsg ='Total booking amount entered cannot exceed the total booking amount';
    }else if(name == 'rto_fine[]'){

     bookingAmtInputs = $('input[name="rto_fine[]"]');
     totBookingAmt = parseFloat($('#tot_rto_fine').val());
     alertmsg ='Total RTO Fine entered cannot exceed the total RTO Fine';

    }else if(name == 'advance_pay[]'){

        bookingAmtInputs = $('input[name="advance_pay[]"]');
     totBookingAmt = parseFloat($('#tot_advance_pay').val());
     alertmsg ='Total Advance entered cannot exceed the total Advance';

    }else if(name == 'statical_charge[]'){

        bookingAmtInputs = $('input[name="statical_charge[]"]');
     totBookingAmt = parseFloat($('#tot_statical_charge').val());
     alertmsg ='Total Statical Charge entered cannot exceed the total Statical Charge';

    }else if(name == 'detention_charge_loading[]'){

        bookingAmtInputs = $('input[name="detention_charge_loading[]"]');
     totBookingAmt = parseFloat($('#tot_charge_loading').val());
     alertmsg ='Total Loading Point Charges entered cannot exceed the total Loading Point Charges';

    }else if(name == 'detention_charge_unloading[]'){

        bookingAmtInputs = $('input[name="detention_charge_unloading[]"]');
     totBookingAmt = parseFloat($('#tot_charge_unloading').val());
     alertmsg ='Total UnLoading Point Charges entered cannot exceed the total UnLoading Point Charges';

    }
    
    var allInputsFilled = true;

    var totalBookingAmtEntered = 0;
    bookingAmtInputs.each(function() {
        var bookingAmt = parseFloat($(this).val());
        if (isNaN(bookingAmt)) {
            allInputsFilled = false;
        } else {
            totalBookingAmtEntered += bookingAmt;
        }

    });

    if (totalBookingAmtEntered > totBookingAmt) {
        $(input).val('');
        alert(alertmsg);
    }
    if (allInputsFilled && totalBookingAmtEntered < totBookingAmt) {
        var remainingAmt = totBookingAmt - totalBookingAmtEntered;
        alert('Adjust charges this is less than the Total Booking charges ! ');
        $(input).val('');

    }
}



</script>
<?= $this->endSection(); ?>
