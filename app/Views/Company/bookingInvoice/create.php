<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>
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

<div class="container-fluid mx-0">
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
              Registered office:
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
                  <?= strtoupper($consignor_details->name) ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper($result->consinor_address) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= $consignor_details->gst_number ?></td>
              </tr>
            <?php } else if ($booking_type == 'To Pay') {  ?>
              <tr>
                <td class="text-bold">Name:</td>
                <td>
                  <?= strtoupper($consignee->name) ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper($result->delivery_address) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= $consignee->gst_number ?></td>
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
                  <?= strtoupper($consignor_details->name) ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper($result->consinor_address) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= $consignor_details->gst_number ?></td>
              </tr>
            <?php } else if ($booking_type == 'Paid') {  ?>
              <tr>
                <td class="text-bold">Name:</td>
                <td>
                  <?= strtoupper($consignee->name) ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?= strtoupper($result->delivery_address) ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?= $consignee->gst_number ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>

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
            <td class="text-right"><?= indian_rupee($booking->booking_amount) ?></td>
          </tr>
          <?php foreach ($consign_data as $key => $consign_value) { ?>
            <tr>
              <td><?php if ($key == 0) {
                    echo $consign_value['consign_date'];
                  } ?></td>
              <td><?= $consign_value['consignment_number'] ?></td>
              <td class="text-left"><?= $consign_value['service_description'] ?></td>

              <td></td>
              <td></td>
            </tr>
          <?php } ?>
          <?php if($booking->rto_fine >0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">RTO Fine, if any</td>
            <td></td>
            <td class="text-right"> <?= $booking ? indian_rupee($booking->rto_fine) : '0.00'; ?></td>
          </tr>
          <?php } ?>
          <?php if($booking->statical_charge>0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">Statistical Charges @ Rs.80</td>
            <td></td>
            <td class="text-right"> <?= $booking ? indian_rupee($booking->statical_charge) : '0.00'; ?></td>
          </tr>
          <?php } ?>
          <?php if($booking->detention_charge_loading>0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">Detention Charges at Loading Point</td>
            <td></td>
            <td class="text-right"> <?= $booking ? indian_rupee($booking->detention_charge_loading) : '0.00'; ?></td>
          </tr> 
          <?php } ?>
          <?php if($booking->detention_charge_unloading>0){ ?>
          <tr>
            <td></td>
            <td></td>
            <td class="text-left">Detention Charges at Unloading Point</td>
            <td></td>
            <td class="text-right"> <?= $booking ? indian_rupee($booking->detention_charge_unloading) : '0.00'; ?></td>
          </tr>
          <?php } ?>
        </table>
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
                <p><?= indian_rupee($net_amount - $booking->advance_pay) ?></p>
                
              </div>
            </div>
          </div>
          <?php $gst_data=calculate_gst($net_amount,$booking); 
        
          $booking->total_cgst=$gst_data['cgst'];
          $booking->total_sgst=$gst_data['sgst'];
          $booking->total_igst=$gst_data['igst']; 
          $net_amount=$net_amount+$booking->total_cgst+$booking->total_sgst+$booking->total_igst;
          ?>
          <div class="below-table below-right">
            <div class="row">
              <div class="w-90px bg-color">
                <p>TOTAL PAYABLE</p>
              </div>
              <div class="w-90px bg-color">
                <p style="text-align:right !important;"><?= indian_rupee($total_amount) ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>CGST @ 2.5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?= indian_rupee($booking->total_cgst) ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>SGST @ 2.5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?= indian_rupee($booking->total_sgst) ?></p>
              </div>
            </div>
            <div class="row">
              <div class="w-90px">
                <p>IGST @5%</p>
              </div>
              <div class="w-90px">
                <p style="text-align:right !important;"><?= indian_rupee($booking->total_igst) ?></p>
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
            <p class="bg-color font-small text-left px-3 mb-1">
              Payable (Amount in Words): <?= ucfirst(convertNumberToWords($net_amount)); ?>
            </p>
          </div>
          <div class="col-sm-6 p-0 ">
            <p class="mb-0 font-small text-left px-3 bg-orange mr-2">
              TDS - NIL as per Section 194 (C) of Income Tax Act, 1961
            </p>
          </div>
         
          <?php if(checkBillingCustomerGst($booking)==1){ ?>
          <div class="col-sm-6 p-0">
            <p class="mb-0 font-small text-left px-3 bg-color ml-2">
              Note: GST is payable by recipient of service under Reverse
              Charge Mechanism
            </p>
          </div>
          <?php } ?>
            <br>
            <br> 
          <div class="col-sm-12 p-0 ">  
            <textarea cols="12" rows="2" name="remark" id="remark" class="form-control" placeholder="Enter Here Remark ..." required></textarea>
          </div>
          <input type="hidden" name="total_amount" id="total_amount" value="<?= $net_amount ?>" />
          <input type="hidden" name="freight_charge" id="freight_charge" value="<?= $booking->booking_amount ?>" />

          <input type="hidden" name="total_sgst" id="total_sgst" value="<?= $booking->total_sgst ?>" />
          <input type="hidden" name="total_cgst" id="total_cgst" value="<?= $booking->total_cgst ?>" />
          <input type="hidden" name="total_igst" id="total_igst" value="<?= $booking->total_igst ?>" />
          <input type="hidden" name="amount_in_word" id="amount_in_word" value="<?= ucfirst(convertNumberToWords($net_amount)) ?>" />

          <div class="col-sm-12 sign-container-fluid mt-1 py-1  ">
            <div class="d-flex justify-content-end py-3">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-warning ms-2">Modify</button>
              <button type="button" class="btn btn-primary ms-2">Submit</button>
            </div>
          </div>

        </div>
      </div>
    </div>
                </form>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->endSection(); ?>