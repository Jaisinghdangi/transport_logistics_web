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
    width: 190px;
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
    font-size:22px;
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
    /* color: #fff !important;
      font-weight: bold !important; */
  }

  .pl-5 {
    padding-left: 1.5rem;
  }

  .inside-container-fluid {
    height: 100%;
    border: 1px solid #000;
  }

  .inside-container-left {
    border-width: 1px 1px 1px 1px;
  }

  .inside-container-right {
    border-width: 1px 0 1px 1px;
  }

  .inside-container-fluid h5 {
    /* background-color: #00297a; */
    /* color: #fff; */
    border-bottom: 1px solid;
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
    /* background-color: #00297a;
      color: #fff; */
    font-size: 12px;
    white-space: nowrap;
  }

  .w-90px {
    width: 90px;
  }

  .detail-table td {
    font-size: 12px;
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
    /* background-color: #00297a; */
    /* color: #fff; */
  }

  .font-small {
    font-size: 12px;
  }


  .bg-orange {
    /* background-color: #e68422; */
    /* color: #fff; */
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

  p,
  td,
  th {
    font-size: 11px !important;
    color:#000 !important;
  }

  .below-right .row {
    justify-content: flex-end;
  }
  table, th, td {
  /* border:1px solid black; */
}

.h4, h4 {
        font-size: 13px;
    }

    table {
    width: 100%;
}

td {
  padding-left: 5px;
  padding-right: 5px;
  line-height:1.18;
}
th {padding-left:5px; padding-right:5px;}

@media print {
    body * {
        visibility: hidden;
      }
    
      #print-wrapper * {
        visibility: visible;
      }
      table {height:100%;}
      .my-table {
        width: 100%;
        height: 100vh;
        border: solid;
        table-layout: fixed;
      }

}
        
body{
  -webkit-print-color-adjust:exact !important;
  print-color-adjust:exact !important;
}
</style>
<script>
  function printInvoice() {
    window.print();
  }

   setTimeout(returnRedirect, 3000);

   function returnRedirect() {
      window.location.replace("<?= base_url('company/consignment-note') ?>");
    }
</script> 
<?php  
$billing_customer="";
if($booking_data->booking_type=="Paid"){
$billing_customer=get_data('consignors',['id'=>$booking_data->cr_id]);  
}else if($booking_data->booking_type=="To Pay"){
$billing_customer=get_data('consignees',['id'=>$booking_data->consignee_id]);   
} 
 $item_dimention=get_data('quotation',['id'=>$booking_data->quatation_id]);
 $item_dimention =json_decode($item_dimention->dimension);  
$from_state = get_title('states', ['id' => $booking_data->cr_state_id], 'name');
$to_state = get_title('pincodes', ['id' => $booking_data->ce_pincode_id], 'StateName');
?>
<body onload="printInvoice()" id="print-wrapper">
<table class="my-table" style=" border: 1px solid #000;">
        <tr>
            <td style="padding-left: 5px;padding-right: 5px;">
                <table>
                    <tr>
                        <td style="width: 30%;"><img src="<?= base_url('Assets/Images/logo.png') ?>" style="width:200px;"/></td>
                        <?php if ($companies_details) {
          $companies_info = $companies_details;
        ?>
                        <td style="text-align: center; width: 70%;">
                            <h2 style="margin: 0 0 5px 0; font-size:20px;"><?= $companies_info->company_name ?></h2>
                            <h5 style="margin: 0 0 5px 0; font-size:16px;">(An <?= $companies_info->iso_number ?> Certified Company)</h5>
                            <p style="margin: 0;"><b>Registered Office:</b>  <span># <?= $companies_info->address_1 ?>,  <?= $companies_info->address_2 ?>, <?= $companies_info->address_3 ?>,
                <?= $companies_info->district_name ?>, <?= $companies_info->state_name ?>-<?= $companies_info->pin_code ?>,<?= $companies_info->country_name ?></span></p>
                            <p style="margin: 0px;"><b>Contact:</b> +91 <?= $companies_info->company_mobile ?>; <b>Email:</b> <?= $companies_info->company_email ?> <b>Website:</b> www.<?= $companies_info->company_website ?>.in (CIN: <?= $companies_info->cin_number ?>)</p>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="height:100%;">
                    <tr>
                        <td style="width:28%; height: 100%;vertical-align: top;">
                            <table style="border: 1px solid #000; height: 100%;">
                                <tr>
                                  <?php //print_r($bookingConsignNumber); ?>
                                    <td style="text-align: center; border: 1px solid #000;">
                                        <h4 style="color: #ff0000; margin: 0px;">CAUTION</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000;">
                                        <p style="margin: 0px;line-height: 12px;">This consignment will not be detained, diverted, rerouted, re-booked without Consignee Bank’s written
                                            permission and it will be delivered at the destination.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000;">
                                        Address of Delivery Office: ........................................
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000;">
                                        <h4 style="text-align: center; margin: 0px;">CONSIGNMENT NOTE</h4>
                                        <p><strong>No.: <?= $bookingConsignNumber->consignment_number;?></strong></p> 
                                        <p><strong>Date: <?= $booking_data->date; ?></strong></p> 
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:42%;">
                            <table style="border: 1px solid #000; height:100%">
                                <tr>
                                    <td style="text-align: center; border: 1px solid #000;">
                                        <h4 style="margin: 0px;">CONSIGNEE COPY</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border: 1px solid #000;">
                                        <h4 style="margin: 0px;">AT OWNER’S RISK</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border: 1px solid #000;">
                                        <h4 style="margin: 0px;">INSURANCE</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000;">
                                        <p style="margin: 0px;">The Customer has stated that he has not insured consignment<input type="checkbox"/> Or he has insured consignment <input type="checkbox"/></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000;">
                                        Company: ...............................................................<br>
                                        Policy No.................................Date..........................<br>
                                        Amount....................................Date...........................
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000;">
                                        <h4 style="text-align: center; margin: 0px;font-size: 12px;">NOT RESPONSIBLE FOR LEAKAGE & BREAKAGE</h4>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:28%;">
                            <table style="border: 1px solid #000; height: 100%;">
                                <tr>
                                    <td style="text-align: center; border: 1px solid #000;" colspan="2">
                                        <h4 style="margin: 0px;">GOODS AND SERVICE TAX PAID BY</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000;" colspan="2"> 
                                        <p style="margin: 0px;">Consignor : <input type="checkbox" <?= $booking_data->booking_type=="Paid"?"checked":""; ?> /> Consignee: <input type="checkbox" <?= $booking_data->booking_type=="To Pay"?"checked":""; ?> /> Transporter: <input type="checkbox"/></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; font-weight: bold; width:50%">PAN</td>
                                    <td style="border: 1px solid #000; width:50%"><?= $billing_customer!=""?$billing_customer->pan_number:""; ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; font-weight: bold;">GSTIN</td>
                                    <td style="border: 1px solid #000;"><?= $billing_customer!=""?$billing_customer->gst_number:""; ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; font-weight: bold;">SAC</td>
                                    <td style="border: 1px solid #000;"></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; font-weight: bold;">Vehicle No</td>
                                    <td style="border: 1px solid #000; font-weight: bold;"><?= $booking_data->vehical_number ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; font-weight: bold;">From</td>
                                    <td style="border: 1px solid #000;"><?= $from_state ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid #000; font-weight: bold;">To</td>
                                    <td style="border: 1px solid #000;"><?= $to_state ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
          
        <tr>
            <td style="padding: 5px 10px;">
                <table style="border: 1px solid #000; width: 100%; height:100%;">
                    <tr>
                        <td style="border: 1px solid #000; background-color: #eee; text-align: center; width: 50%;"><b>CONSIGNOR’S DETAILS</b></td>
                        <td style="border: 1px solid #000; background-color: #eee; text-align: center; width: 50%;"><b>CONSIGNEE’S DETAILS</b></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000;">
                            <?php $consignor_address= get_consinor_address_saprate($bookingConsignNumber->consignor_id); ?>
                            <div style="margin-bottom: 5px;font-size: 12px;"><b>Name</b>: <?= ($bookingConsignNumber) ? getConsinorName($bookingConsignNumber->consignor_id) : '.........................................';?></div>
                            <div style="margin-bottom: 5px;font-size: 12px;"><b>Address</b>: <?= $consignor_address['address1']; ?>  , </div>
                            <div style="margin-bottom: 5px;font-size: 12px;"><?= $consignor_address['address2']; ?>  , </div>
                            <div style="margin-bottom: 5px;font-size: 12px;"><?= $consignor_address['address3']; ?>   </div>
                            <div style="font-size: 12px;"><b>GSTIN</b>: <?= ($bookingConsignNumber) ? getConsinorGST($bookingConsignNumber->consignor_id) : '.........................................';?></div>
                        </td>
                        <td style="border: 1px solid #000;">
                            <?php $consignee_address=get_consinee_address_saprate($bookingConsignNumber->consignee_id); ?>
                            <div style="margin-bottom: 5px;font-size: 12px;"><b>Name</b>: <?= ($bookingConsignNumber) ? getConsineeName($bookingConsignNumber->consignee_id) : '.........................................';?></div>
                            <div style="margin-bottom: 5px;font-size: 12px;"><b>Address</b>: <?= $consignee_address['address1']; ?>  , </div> 
                            <div style="margin-bottom: 5px;font-size: 12px;"> <?= $consignee_address['address2']; ?>  , </div> 
                            <div style="margin-bottom: 5px;font-size: 12px;"> <?= $consignee_address['address3']; ?>   </div> 
                            
                            <div style="font-size: 12px;"><b>GSTIN</b>: <?= ($bookingConsignNumber) ? getConsineeGST($bookingConsignNumber->consignee_id) : '.........................................';?></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
       
        <tr>
            <td style="padding: 5px 10px;">
            <table>
                <tr>
                    <th style="border: 1px solid #000;width: 15%;" rowspan="2">No. of Packages</th>
                    <th style="border: 1px solid #000;width: 40%;" colspan="4" rowspan="2">Description (said to contain)</th>
                    <th style="border: 1px solid #000;width: 20%;" colspan="2">Weight (in Kgs)</th>
                    <th style="border: 1px solid #000;width: 17%;" rowspan="2">Rate</th>
                    <th style="border: 1px solid #000;width: 8%;text-wrap: nowrap;" rowspan="2">Amount in ₹</th>
                </tr>
                <tr>
                    <th style="border: 1px solid #000;">Actual</th>
                    <th style="border: 1px solid #000;">Charged</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;" rowspan="5"><b>(SCROLL Option – 1,2, 3, 4, 5, etc)</b></td>
                    <td style="border: 1px solid #000;" rowspan="7" colspan="4"><?= ($bookingConsignNumber) ? $bookingConsignNumber->service_description : '';?></td>
                    <td style="border: 1px solid #000;" rowspan="2"></td>
                    <td style="border: 1px solid #000;" rowspan="2"></td>
                    <td style="border: 1px solid #000; text-wrap: nowrap;">FREIGHT CHARGE</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->booking_amount,2) ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;">DETENTION CHARGES @ LOADING POINT</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->detention_charge_loading,2) ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; vertical-align: top;" rowspan="5">Private Mark</td>
                    <td style="border: 1px solid #000;" rowspan="5"></td>
                    <td style="border: 1px solid #000;text-wrap: nowrap; font-size:11px">DETENTION CHARGES @ UNLOADING POINT</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->detention_charge_unloading,2) ?></td>
                </tr>
                <tr>


                    <td style="border: 1px solid #000;text-wrap: nowrap;">OTHER CHARGES</td>
                    <td style="border: 1px solid #000;text-align: right;">0.00</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;text-wrap: nowrap;">STATISTICAL CHARGES</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->statical_charge,2) ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;" rowspan="2">Method of packing </td>
                    <td style="border: 1px solid #000; font-size: 16px; text-align: right; font-weight: bold;">TOTAL</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->booking_amount,2) ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;">CGST @ 2.5%</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->total_cgst,2) ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;" rowspan="3"><b>Box, Wooden Box,Others</b></td>
                    <td style="border: 1px solid #000;" colspan="3">Invoice/Challan No.:(This field shall be manual to enter)</td>
                    <td style="border: 1px solid #000;" rowspan="3" colspan="2">Booking as per terms and Conditions Overleaf.</td>
                    <td style="border: 1px solid #000;" rowspan="3">Freight charges are exclusive of GST</td>
                    <td style="border: 1px solid #000;">SGST @ 2.5%</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->total_sgst,2) ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;">Length</td>
                    <td style="border: 1px solid #000;">Width</td>
                    <td style="border: 1px solid #000;">Height</td>
                    <td style="border: 1px solid #000;">IGST @ 5%</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->total_igst,2) ?></td>
                </tr>
                <tr> 
                    <td style="border: 1px solid #000;"><?= count($item_dimention->length)>0?$item_dimention->length[0].$item_dimention->length_unit[0]:''; ?></td>
                    <td style="border: 1px solid #000;"><?= count($item_dimention->width)>0?$item_dimention->width[0].$item_dimention->width_unit[0]:''; ?></td>
                    <td style="border: 1px solid #000;"><?= count($item_dimention->height)>0?$item_dimention->height[0].$item_dimention->height_unit[0]:''; ?></td> 
                    <td style="border: 1px solid #000; font-size: 16px; text-align: right; font-weight: bold;">GRAND TOTAL</td>
                    <td style="border: 1px solid #000;text-align: right;"><?= number_format($booking_data->net_amount,2) ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000;" rowspan="2" colspan="7">
                        Declared value of Goods………………………… Basis of Booking: <input type="checkbox" /> <b>Paid</b> <input type="checkbox" /> <b>To Pay</b> <input type="checkbox" /> <b>To be billed at</b>…<b>(Place of Supply)</b>…Please pay by A/c payee cheque/DD in favour of <b>Sunpro Logistics Private Limited and not to pay by cash.</b> <b>Bank Name:</b> ICICI Bank Limited, <b>Current A/c No.</b> ____________________<b>IFSC Code:</b>________________

                    </td>
                    <td style="border: 1px solid #000; font-size: 16px; text-align: right; font-weight: bold;display:none;">GRAND TOTAL</td>
                    <td style="border: 1px solid #000;display:none;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; text-align: right; font-weight: bold;" colspan="2">
                        For Sunpro Logistics Private Limited<br><br>
                        Authorised Signatory
                    </td>
                </tr>
            </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;"><b>DO NOT PAY ANY FREIGHT AMOUNT IN CASH TO LORRY DRIVERS. UNLOADING BY CONSIGNEE</b></td>
        </tr>
        
    </table>
</body>

</html>