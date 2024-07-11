<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

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
    /* background-color: #e68422; */
    color: black !important;
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
    /* background-color: #00297a; */
    color: black;
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
    /* background-color: #00297a; */
    color: black;
    font-size: 15px;
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
<script>
  function printInvoice() {
  window.print();
  }

  setTimeout(returnRedirect, 3000);

  function returnRedirect() {
    window.location.replace("<?= base_url('company/invoices') ?>");
  }
</script>
<body onload="printInvoice()">

<div class="container-fluid mx-0">
<!-- ; -->
<?php  //print_r($split_bill);
// $total_payable =0;
$net_payable =0;
$net_fraight=0;
$igst=0;
$cgst=0;
$sgst=0;
if($booking_type == 'Paid'){
    $printpage=1;
}
for($i=1; $i <= $printpage; $i++){  ?>

  <div class="container-main py-1" style="margin-top: 27px;background: #fff;">
    <img class="logo pl-5" src="<?= base_url('Assets/Images/logo.png') ?>" alt="logo" />
    <form action="<?= base_url('company/add-invoice') ?>" method="POST" enctype="multipart/form-data">
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
          <p>INVOICE NO. <span class="invoice-no"><?= getVoucherNumber('Invoice') ?></span></p>
          <p>QUATATION NO. <span><?= $result->quotation_number ?></span></p>
          <p>BOOKING NO. <span><?= $booking->booking_no ?> </span></p>
          <p>BOOKING DATE <span><?= date('d-m-Y', strtotime($booking->date)); ?></span></p>
          <p>ENQUIRY DATE <span><?= date('d-m-Y', strtotime($result->quotation_date)); ?></span></p>
          <p>CHALLAN NUMBER <span><?= $booking->challan_number ?></span></p>
          <p>CHALLAN DATE <span><?= $booking->challan_date ?></span></p>
          <p>FROM <span><?= $result ? strtoupper($result->state_name) : ''; ?> </span></p>
          <p>TO <span><?= $consignee_details ? strtoupper($consignee_details->District) : ''; ?> </span></p>
          <p>PLACE OF SUPPLY <span><?= $consignee_details ? strtoupper($consignee_details->StateName) : ''; ?> </span></p>

        </div>
      </div>
    </div>
   
   <?php  //print_r($MultiBookingVehical); 
   foreach($MultiBookingVehical as $key1 => $value1){
   ?>

    <div class="row my-3">
        <?php if($key1 == 0){ ?>
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
      <?php }else{ ?>
      <div class="col-sm-6">
        <div class="inside-container-fluid inside-container-left">

        </div>
      </div>
      <?php } ?>
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
                  <?= strtoupper(getConsineeName($value1->consignee_id)); ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper(get_consinee_address($value1->consignee_id)) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= getConsineeGST($value1->consignee_id);?></td>
              </tr>

            <?php } ?>
          </table>
        </div>
      </div>
    </div>
<?php } ?>
    <div class="container-fluid">
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
            echo indian_rupee($booking->booking_amount) ?>
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
          
          
          
          
        </table>
        <?php
        
        $total_payable += ( (($split_bill) ? $split_bill[$i-1]->booking_amt : 0) + (($split_bill) ? $split_bill[$i-1]->rto_fine : 0) + (($split_bill) ? $split_bill[$i-1]->statical_charge : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_loading : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_unloading : 0) );
     
        $net_payable += ( (($split_bill) ? $split_bill[$i-1]->booking_amt : 0) + (($split_bill) ? $split_bill[$i-1]->rto_fine : 0) + (($split_bill) ? $split_bill[$i-1]->statical_charge : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_loading : 0) + (($split_bill) ? $split_bill[$i-1]->detention_charge_unloading : 0) );
       
        $net_fraight += ($split_bill ? $split_bill[$i-1]->booking_amt : 0 );

        $total_amount = $booking->booking_amount + $booking->detention_charge_unloading + $booking->detention_charge_loading + $booking->statical_charge + $booking->rto_fine; ?>
        <?php $net_amount = $booking->total_cgst + $booking->total_sgst + $booking->total_igst + $total_amount;  ?>

        <?php $total_amount = $booking->booking_amount + $booking->detention_charge_unloading + $booking->detention_charge_loading + $booking->statical_charge + $booking->rto_fine; ?>
        <?php $net_amount = $booking->total_cgst + $booking->total_sgst + $booking->total_igst + $total_amount;  ?>
        
        <div class="row table-down px-0">
          <div class="below-table my-4">
            <div class="row">
              <div class="w-90px">
                <p>Total Freight</p>
              </div>
              <div class="w-90px">
                <p><?= $booking ? indian_rupee($booking->booking_amount) : '0.00'; ?></p>
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
                <p><?= indian_rupee($net_amount - $booking->advance_pay)  ?></p>
                
              </div>
            </div>
          </div>
          <?php //$gst_data=calculate_gst($net_amount,$booking); 
        $gst_data=multiple_calculate_gst($net_amount , $MultiBookingVehical[$i-1]->consignor_id,$MultiBookingVehical[$i-1]->consignee_id,$booking);
         
//         print_r($gst_data);
//            $gst_data['cgst']=null;
//            $gst_data['sgst']=null;
//            $gst_data['igst']=null;
// echo $gst_data['cgst'];
          $booking->total_cgst=$gst_data['cgst'];
          $booking->total_sgst=$gst_data['sgst'];
          $booking->total_igst=$gst_data['igst']; 
          $net_amount=$total_amount+$gst_data['cgst']+$gst_data['sgst']+$gst_data['igst'];
          ?>
          <div class="below-table below-right">
            <div class="row">
              <div class="w-90px">
                <p>TOTAL PAYABLE</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?= indian_rupee($total_amount) ; ?></p>
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
            
        <div class="row p-0">
          <div class="col-sm-9 p-0">
            <p class="font-small text-left px-3 mb-1">
              Payable (Amount in Words): <?= ucfirst(convertNumberToWords($net_amount)); ?>
            </p>
          </div>
          <div class="col-sm-12 text-left text-detail">
              <p class="mb-0">Bank Account Information : <span></span></p>
              <p class="mb-0">
                Account Name :
                <span> <?= $companies_details?$companies_details->company_name:''; ?> </span>| Current
                Account No : <?= $companies_details?$companies_details->ac_number:''; ?>
              </p>
              <p>
                Bank Name :
                <span>
                <?= $companies_details?$companies_details->bank_name:''; ?> | IFSC Code: <?= $companies_details?$companies_details->ifsc_code:''; ?>, Branch:
                  <?= $companies_details?$companies_details->address_1:''; ?>, <?= $companies_details?$companies_details->district_name:''; ?> - <?= $companies_details?$companies_details->pin_code:''; ?></span>
              </p>
            </div>
            <div class="col-sm-12 sign-container-fluid mt-1 py-1">
              <div class="sign width-fix text-right">
                <p class="mt-0 mb-5">For Sunpro Logistics Private Limited</p>
                <p class="mt-5 mb-2">Authorised Signatory</p>
              </div>
            </div>
            <div class="col-sm-12 px-0">
            <p class="mb-0" style="border-top:1px solid;font-size: 18px;font-weight: 600;" >Terms and Conditions:</p>
            <ul class="text-left conditions mb-0">
            <?= ($terms) ? $terms->description : '' ;?>
   
          </ul>
          </div>
         
         
          
          

        </div>
      </div>
    </div>
                </form>
  </div>
  <?php  } ?>

</div>
</body>

</html>