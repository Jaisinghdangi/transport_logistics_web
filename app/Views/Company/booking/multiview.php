<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>

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
    background-color: #e68422;
    color: #fff !important;
    font-weight: bold !important;
  }

  .pl-5 {
    padding-left: 1.5rem;
  }

  .inside-container-fluid {
    /* height: 100%; */
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
    font-size: 12px;
    color: #000;
    padding-top: 0;
    padding-bottom: 0;
    border-color: #000 !important;
  }

  .detail-table th,
  .detail-table td {
    border: 1px solid #000;
    font-size: 10px !important;
  }

  .detail-table td {
    border: 1px solid #000;
    border-width: 0 1px !important;
    background-color: #f5f5f5;
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
    width: 90px;
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

  #booking-table .textalign {
    text-align: right;
    padding-right: 74px;
  }
</style>

<script>
  function printInvoice() {
    window.print();
  }
</script>

<body>
  <div class="container-fluid mx-0">
    <div class="card-header">
      <div class="card-title">
        <h5 class="header-title text-primary">
          Booking Details
        </h5>
      </div>
      <a href="<?= $previous_url; ?>" class="btn btn-primary btn-sm float-end">
        <i class="bi bi-table"></i> Report
      </a>


    </div>
    <div class="container-main py-1" style="background-color:#fff;">
      <img class="logo pl-5" src="<?= base_url('Assets/Images/logo.png') ?>" alt="logo" />

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
            </div>
          <?php } ?>
        </div>

        <div class="col-sm-5 text-right pl-0">
          <div class="side-detail">
            <p>QUATATION NO. <span class="invoice-no" data-toggle="modal" data-target="#myModal" onclick="getQuatation()" style="cursor:pointer;"><?= $result->quotation_number ?></span></p>
            <p>BOOKING NO. <span><?= $booking->booking_no ?> </span></p>
            <p>BOOKING DATE <span><?= date('d-m-Y', strtotime($booking->date)); ?></span></p>
            <p>ENQUIRY DATE <span><?= date('d-m-Y', strtotime($result->quotation_date)); ?></span></p>
            <p>FROM <span><?= $result ? $result->state_name : ''; ?> </span></p>
            <p>TO <span><?= $consignee_details ? $consignee_details->District : ''; ?> </span></p>
            <p>PLACE OF SUPPLY <span><?= $consignee_details ? $consignee_details->StateName : ''; ?> </span></p>
          </div>
        </div>
      </div>
      <div class="row my-3">
        <div class="col-sm-6">
          <div class="inside-container-fluid inside-container-left pb-2">
            <h5>Billing Customer & <?php if ($booking_type == 'To Pay') {
                                      echo "Consignee";
                                    } else {
                                      echo "Consignor";
                                    } ?> Details</h5>
            <table class="table table-address mb-0">
              <tr>
                <td class="text-bold">Name:</td>
                <td><?php if ($booking_type == 'To Pay') {
                      echo "<b style='color:red;' >Empty</b>";
                    } else {
                      if (!empty($consignor_details)) {
                        echo ucfirst($consignor_details->name);
                      }
                    } ?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>

                <td>
                  <?php if ($booking_type == 'To Pay') {
                    echo $result->delivery_address;
                  } else {
                    echo $result->consinor_address;
                  }  ?>
                </td>
              </tr>
              <tr>
                <td class="text-bold">GSTIN:</td>
                <td><?php if ($booking_type == 'To Pay') {
                      echo "";
                    } else {
                      if (!empty($consignor_details)) {
                        echo $consignor_details->gst_number;
                      }
                    }  ?></td>
              </tr>
            </table>
          </div>

          <div class="inside-container-fluid inside-container-left mt-2">
            <table class="table table-address mb-0 border-bottom-0">
              <tr>
                <td class="text-bold border-end border-bottom-0" style="width: 30%;">Booking Type:</td>
                <td class="border-bottom-0"><?= $booking_type ?></td>
              </tr>
            </table>
          </div>

          <div class="inside-container-fluid inside-container-left mt-2">
            <table class="table table-address mb-0 border-bottom-0">
              <tr>
                <td class="text-bold border-end border-bottom-0" style="width: 30%;">Loading/Unloading:</td>
                <td class="border-bottom-0"><?= $loading_point ?>/<?= $delivery_point ?></td>
              </tr>
            </table>
          </div>

        </div>
        <div class="col-sm-6">
          <div class="inside-container-fluid inside-container-right pb-2">
            <h5>Booking Details</h5>
            <table class="table table-address mb-0">
              <tr>
                <td class="text-bold">Booking Amount:</td>
                <td style="text-align: right;padding-right: 70px;"><?= $result ? $result->amount : 0; ?></td>
              </tr>
              <tr>
                <td class="text-bold">RTO Fine, if any</td>
                <td><input type="number" class="calculate_booking_amount" id="rto_fine" name="rto_fine" value="<?= $booking ? $booking->rto_fine : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">Advance, if any</td>
                <td><input type="number" class="" id="advance_pay" name="advance_pay" value="<?= $booking ? $booking->advance_pay : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">Statical Charge (Rs. 80 for AMS)</td>
                <td><input type="number" class="calculate_booking_amount" id="statical_charge" name="statical_charge" value="<?= $booking ? $booking->statical_charge : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">Detention Charges at Loading Point</td>
                <td><input type="number" class="calculate_booking_amount" id="detention_charge_loading" name="detention_charge_loading" value="<?= $booking ? $booking->detention_charge_loading : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">Detention Charges at Unloading Point</td>
                <td><input type="number" class="calculate_booking_amount" id="detention_charge_unloading" name="detention_charge_unloading" value="<?= $booking ? $booking->detention_charge_unloading : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">Total Payable</td>
                <td><input type="number" class="calculate_booking_amount" id="total_payable" name="total_payable" value="<?= $booking ? $booking->total_payable : 0; ?>" style="border: 0px;text-align: right;" readonly disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">CGST 2.5%</td>
                <td><input type="number" class="calculate_booking_amount" id="total_cgst" name="total_cgst" value="<?= $booking ? $booking->total_cgst : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">SGST 2.5%</td>
                <td><input type="number" class="calculate_booking_amount" id="total_sgst" name="total_sgst" value="<?= $booking ? $booking->total_sgst : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">IGST 5.5%</td>
                <td><input type="number" class="calculate_booking_amount" id="total_igst" name="total_igst" value="<?= $booking ? $booking->total_igst : 0; ?>" style="border: 0px;text-align: right;" disabled /></td>
              </tr>
              <tr>
                <td class="text-bold">Total</td>
                <td><input type="number" id="net_amount" name="net_amount" value="<?= $booking ? $booking->net_amount : 0; ?>" style="border: 0px;text-align: right;" readonly disabled /></td>
              </tr>

            </table>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row p-0">
          <div class="col-sm-9 p-0">
            <p class="bg-color font-small text-left px-3 mb-1">
              Payable (Amount in Words): <?= ucfirst($result->amount_in_word) ?>
            </p>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 p-0">
            <p class="mb-0 text-center px-3 bg-orange">Brokers Details</p>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 ps-0">
            <div class="inside-container-fluid inside-container-left mt-2">
              <h5 class="text-start mb-0">Broker Information</h5>
              <table class="table table-address mb-0">
                <tr>
                  <td class="text-bold border-end" style="width: 30%;">Name of Broker:</td>
                  <td>
                    <span><?= $brokers ? ucfirst($brokers->name) . ' ( ' . $brokers->mobile . ')' : ''; ?></span>
                  </td>
                </tr>
                <tr>
                  <td class="text-bold border-end">Loading Advice No.:</td>
                  <td><input type="number" id="loading_advice_no" name="loading_advice_no" value="0" style="border: 0px;text-align: right;" disabled /></td>
                </tr>
                <tr>
                  <td class="text-bold border-end">Type of Vehicle:</td>
                  <td><select id="vehicle_type" name="vehicle_type" class="form-control" style="border:0px;" disabled>
                                                                        <option value=""></option>
                                                                        <?php foreach (type_of_vehicle() as $key => $value) { ?>
                                                                            <option value="<?= $key ?>" <?= $booking->vehicle_type==$key?'selected':''; ?> ><?= $value ?></option>
                                                                        <?php } ?>
                                                                    </select></td>
                </tr>
                <tr>
                  <td class="text-bold border-end">Weight:</td>
                  <td><input type="number" id="vehicle_weight" name="vehicle_weight" value="0" style="border: 0px;text-align: right;" disabled /></td>
                </tr>
                <tr>
                  <td class="text-bold border-end">Length:</td>
                  <td><input type="number" id="vehicle_length" name="vehicle_length" value="0" style="border: 0px;text-align: right;" disabled /></td>
                </tr>
                <tr>
                  <td class="text-bold border-end border-bottom-0">Height:</td>
                  <td class=" border-bottom-0">
                    <input type="number" id="vehicle_height" name="vehicle_height" value="0" style="border: 0px;text-align: right;" disabled />
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="col-sm-6 pe-0">
            <div class="inside-container-fluid inside-container-left mt-2 border-start border-end-0" style="border-color: #000 !important;">
              <h5 class="text-start mb-0">Broker Billing</h5>
              <table class="table table-address mb-0">
                <?php
                $total_lorry_hire_charge = 0;
                if (!empty($bookings_brokers)) {
                  $total_lorry_hire_charge = $booking->total_broker_amount + $bookings_brokers->rto_fine;
                }

                ?>
                <tr>
                  <td class="text-bold border-end">Lorry Hire Charges:</td>
                  <td><input type="number" class="broker_blance_payable" id="total_broker_amount" name="total_broker_amount" value="<?= $booking->total_broker_amount ?>" style="border: 0px;text-align: right;" placeholder="(Amount in Rs.)" required disabled /></td>
                </tr>
                <tr>
                  <td class="text-bold border-end">RTO fine:</td>
                  <td><input type="number" class="broker_blance_payable" id="broker_rto_fine" name="broker_rto_fine" value="<?= $bookings_brokers ? $bookings_brokers->rto_fine : '0'; ?>" style="border: 0px;text-align: right;" disabled /></td>
                </tr>
                <tr>
                  <td class="text-bold border-end">Detention Charges, if any:</td>
                  <td><input type="number" class="broker_blance_payable" id="detention_charges" name="detention_charges" value="<?= $bookings_brokers ? $bookings_brokers->detention_charge : '0'; ?>" style="border: 0px;text-align: right;" disabled /></td>
                </tr>


                <tr>
                  <td class="text-bold border-end text-danger">Late delivery Charges:</td>
                  <td><input type="number" class="broker_blance_payable" id="late_delivery_charges" name="late_delivery_charges" value="<?= $bookings_brokers ? $bookings_brokers->detention_charge : '0'; ?>" style="border: 0px;text-align: right;" disabled /></td>
                </tr>

                <tr>
                  <td class="text-bold border-end text-danger">Other Deduction Charges:</td>
                  <td><input type="number" class="broker_blance_payable" id="other_deduction_charges" name="other_deduction_charges" value="<?= $bookings_brokers ? $bookings_brokers->other_deduction_charges : '0'; ?>" style="border: 0px;text-align: right;" disabled /></td>
                </tr>

                <tr>
                  <td class="text-bold border-end" style="background:#f3f3f3;"><b>Total Lorry Hire Charges:</b></td>
                  <td style="background:#f3f3f3;"><input type="number" id="total_lorry_hire_charge" name="total_lorry_hire_charge" value="<?= $total_lorry_hire_charge ?>" style="border: 0px;text-align: right;background:#f3f3f3" readonly="" disabled></td>
                </tr>



                <tr>
                  <td class="text-bold border-end " style="color:#3daa25">Advance:</td>
                  <td><input type="number" id="advance" name="advance" value="<?= $bookings_brokers ? $bookings_brokers->advance : '0'; ?>" class="total_advance_paid" style="border: 0px;text-align: right;" disabled /></td>
                </tr>
                <tr>
                  <td class="text-bold border-end" style="color:#3daa25">Mamul Charges (A):</td>
                  <td><input type="number" id="mamul_chargesa" name="mamul_chargesa" value="<?= $bookings_brokers ? $bookings_brokers->mamul_charges_A : '0'; ?>" class="total_advance_paid" style="border: 0px;text-align: right;" disabled /></td>
                </tr>

                <tr>
                  <td class="text-bold border-end" style="color:#3daa25">Advance Payable:</td>
                  <td><input type="number" id="advance_payable" name="advance_payable" value="<?= $bookings_brokers ? $bookings_brokers->advance_payable : '0'; ?>" style="border: 0px;text-align: right;" readonly disabled /></td>
                </tr>

                <tr>
                  <td class="text-bold border-end" style="color:#3daa25">Advance Paid:</td>
                  <td><input type="number" id="advance_paid" name="advance_paid" value="<?= $bookings_brokers ? $bookings_brokers->advance_paid : '0'; ?>" class="total_advance_paid" style="border: 0px;text-align: right;" disabled /></td>
                </tr>


                <tr>
                  <td class="text-bold border-end" style="color:#3daa25">Balance:</td>
                  <td><input type="number" id="total_balance" name="total_balance" value="<?= $bookings_brokers ? $bookings_brokers->balance : '0'; ?>" style="border: 0px;text-align: right;" readonly disabled /></td>
                </tr>





                <tr>
                  <td class="text-bold border-end" style="color:#3daa25">Mamul Charges (B):</td>
                  <td><input type="number" id="mamul_chargesb" name="mamul_chargesb" value="<?= $bookings_brokers ? $bookings_brokers->mamul_charges_B : '0'; ?>" class="balance_payable" style="border: 0px;text-align: right;" disabled /></td>
                </tr>

                <tr>
                  <td class="text-bold border-end " style="background:#f3f3f3;color:#3daa25"><b>Balance Payabe:</b></td>
                  <td style="background:#f3f3f3;"><input type="number" id="balance_payable" name="balance_payable" value="<?= $bookings_brokers ? $bookings_brokers->balance_payabe : '0'; ?>" style="border: 0px;text-align: right;color:#3daa25;background:#f3f3f3;" readonly disabled /></td>
                </tr>
                <tr>
                  <td class="text-bold border-end ">Balance Paid:</td>
                  <td><input type="number" id="total_balance_payable" name="balance_paid" value="<?= $bookings_brokers ? $bookings_brokers->balance_paid : '0'; ?>" class="balance_payable" style="border: 0px;text-align: right;font-weight: 500;" disabled /></td>
                </tr>

              </table>
            </div>
          </div>
        </div>


      </div>

      <div class="row mt-3">
        <div class="col-md-12">
          <div class="inside-container-fluid inside-container-left pb-2">
            <h5 style="background:#e68422;">CONSIGN DETAILS</h5>
          </div>
        </div>
        <?php $maincount = count($MultiBookingVehical);
        foreach ($MultiBookingVehical as $key1 => $multivalue) { ?>
          <div class="col-sm-12">
            <div class="inside-container-fluid inside-container-left pb-2">
              <table class="table table-bordered">
                <thead>
                  <th>
                    <h5>Consign No. / Consign Date</h5>
                  </th>
                  <?php if ($loading_point == 'Single Point' && $delivery_point == 'Multi Point' && $key1 == '0') {  ?>
                    <th>
                      <h5>Consignor Details</h5>
                    </th>
                  <?php    }
                  if ($loading_point == 'Multi Point' && $delivery_point == 'Multi Point') { ?>
                    <th>
                      <h5>Consignor Details</h5>
                    </th>
                  <?php  }
                  if ($loading_point == 'Multi Point' && $delivery_point == 'Single Point') { ?>
                    <th>
                      <h5>Consignor Details</h5>
                    </th>

                  <?php  } ?>



                  <?php if ($loading_point == 'Multi Point' && $delivery_point == 'Single Point' && $key1 == '0') {  ?>

                    <th>
                      <h5>Consignee Details</h5>
                    </th>
                  <?php  } ?>
                  <?php if ($loading_point == 'Multi Point' && $delivery_point == 'Multi Point') {  ?>

                    <th>
                      <h5>Consignee Details</h5>
                    </th>
                  <?php  }
                  if ($loading_point == 'Single Point' && $delivery_point == 'Multi Point') { ?>
                    <th>
                      <h5>Consignee Details</h5>
                    </th>
                  <?php } ?>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center" style="width:17.66666667%;">
                      <p><?= $multivalue->consign_date; ?></p>
                      <p>
                      </p>
                    </td>
                    <?php if ($loading_point == 'Single Point' && $delivery_point == 'Multi Point' && $key1 == '0') {  ?>

                      <td>
                        <table class="table table-address mb-0">
                          <tr>
                            <td class="text-bold border-end" style="width: 30%;">Name:</td>
                            <td> <?php foreach ($consignorr as $key => $value) {
                                    if ($value->id == $multivalue->consignor_id) {
                                      echo ucfirst($value->name);
                                    }
                                  } ?></td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">Address:</td>
                            <td><?php
                                echo get_consinor_address($multivalue->consignor_id); ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">GSTN:</td>
                            <td><?php if (!empty($consignor_details)) {
                                  echo $consignor_details->gst_number;
                                } ?></td>
                          </tr>
                        </table>
                      </td>
                    <?php }
                    if ($loading_point == 'Multi Point' && $delivery_point == 'Multi Point') { ?>
                      <td>
                        <table class="table table-address mb-0">
                          <tr>
                            <td class="text-bold border-end" style="width: 30%;">Name:</td>
                            <td> <?php foreach ($consignorr as $key => $value) {
                                    if ($value->id == $multivalue->consignor_id) {
                                      echo ucfirst($value->name);
                                    }
                                  } ?></td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">Address:</td>
                            <td><?php
                                echo get_consinor_address($multivalue->consignor_id); ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">GSTN:</td>
                            <td><?php if (!empty($consignor_details)) {
                                  echo $consignor_details->gst_number;
                                } ?></td>
                          </tr>
                        </table>
                      </td>

                    <?php }
                    if ($loading_point == 'Multi Point' && $delivery_point == 'Single Point') { ?>
                      <td>
                        <table class="table table-address mb-0">
                          <tr>
                            <td class="text-bold border-end" style="width: 30%;">Name:</td>
                            <td> <?php foreach ($consignorr as $key => $value) {
                                    if ($value->id == $multivalue->consignor_id) {
                                      echo ucfirst($value->name);
                                    }
                                  } ?></td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">Address:</td>
                            <td><?php
                                echo get_consinor_address($multivalue->consignor_id); ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">GSTN:</td>
                            <td><?php if (!empty($consignor_details)) {
                                  echo $consignor_details->gst_number;
                                } ?></td>
                          </tr>
                        </table>
                      </td>


                    <?php }  ?>
                    <?php if ($loading_point == 'Multi Point' && $delivery_point == 'Single Point' && $key1 == '0') { ?>
                      <td>
                        <table class="table table-address mb-0">
                          <tr>
                            <td class="text-bold border-end" style="width: 30%;">Name: <?= $loading_point . ' ' . $delivery_point; ?></td>
                            <td> <?php foreach ($consignees as $key => $valuen) {
                                    if ($valuen->id == $multivalue->consignee_id) {  ?>
                                  <?= ($valuen->name) ? ucfirst($valuen->name) : ''; ?>
                              <?php
                                    }
                                  } ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">Address:</td>
                            <td id="consignee_address">
                              <?= get_consinee_address($multivalue->consignee_id); ?></td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">GSTN:</td>
                            <td id="consignee_gst"><?= $consignee ? $consignee->gst_number : ''; ?></td>
                          </tr>
                        </table>
                      </td>
                    <?php }
                    if ($loading_point == 'Multi Point' && $delivery_point == 'Multi Point') { ?>

                      <td>
                        <table class="table table-address mb-0">
                          <tr>
                            <td class="text-bold border-end" style="width: 30%;">Name: <?= $loading_point . ' ' . $delivery_point; ?></td>
                            <td> <?php foreach ($consignees as $key => $valuen) {
                                    if ($valuen->id == $multivalue->consignee_id) {  ?>
                                  <?= ($valuen->name) ? ucfirst($valuen->name) : ''; ?>
                              <?php
                                    }
                                  } ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">Address:</td>
                            <td id="consignee_address">
                              <?= get_consinee_address($multivalue->consignee_id); ?></td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">GSTN:</td>
                            <td id="consignee_gst"><?= $consignee ? $consignee->gst_number : ''; ?></td>
                          </tr>
                        </table>
                      </td>


                    <?php  }
                    if ($loading_point == 'Single Point' && $delivery_point == 'Multi Point') { ?>

                      <td>
                        <table class="table table-address mb-0">
                          <tr>
                            <td class="text-bold border-end" style="width: 30%;">Name: </td>
                            <td> <?php foreach ($consignees as $key => $valuen) {
                                    if ($valuen->id == $multivalue->consignee_id) {  ?>
                                  <?= ($valuen->name) ? ucfirst($valuen->name) : ''; ?>
                              <?php
                                    }
                                  } ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">Address:</td>
                            <td id="consignee_address">
                              <?= get_consinee_address($multivalue->consignee_id); ?></td>
                          </tr>
                          <tr>
                            <td class="text-bold border-end">GSTN:</td>
                            <td id="consignee_gst"><?= $consignee ? $consignee->gst_number : ''; ?></td>
                          </tr>
                        </table>
                      </td>

                    <?php  } ?>
                  </tr>
                  <?php
                  if ($loading_point == 'Single Point' && $delivery_point == 'Multi Point') {
                    $previous_consignor_id = null; // Initialize previous consignor_id
                    foreach ($bookingConsignNum as $value) {
                      if ($multivalue->booking_id == $value->booking_id && $multivalue->consignee_id == $value->consignee_id) {


                        //  foreach ($consign_data as $consign) { 
                  ?>
                        <tr>
                          <td><?= $value->consignment_number  ?></td>
                          <td colspan="2"><?= $value->service_description ?></td>
                        </tr>
                        <?php //}
                        if ($previous_consignor_id !== $value->consignee_id) {
                          $previous_consignor_id = $value->consignee_id;
                        }

                        if ($previous_consignor_id !== $value->consignee_id) {
                          break;
                        }
                      }
                    }
                  } else {
                    $previous_consignor_id = null; // Initialize previous consignor_id
                    foreach ($bookingConsignNum as $value) {
                      if ($multivalue->booking_id == $value->booking_id && $multivalue->consignor_id == $value->consignor_id) {


                        //  foreach ($consign_data as $consign) { 
                        ?>
                        <tr>
                          <td><?= $value->consignment_number  ?></td>
                          <td colspan="2"><?= $value->service_description ?></td>
                        </tr>
                  <?php //}
                        if ($previous_consignor_id !== $value->consignor_id) {
                          $previous_consignor_id = $value->consignor_id;
                        }

                        if ($previous_consignor_id !== $value->consignor_id) {
                          break;
                        }
                      }
                    }
                  }  ?>
                </tbody>
              </table>

            </div>
          </div>
        <?php } ?>
        <div class="col-md-12">
          <div class="inside-container-fluid inside-container-left pb-2">
            <h5 style="background:#e68422;">VEHICLES/LORRY DETAILS</h5>
          </div>
        </div>
        <div class="col-md-5">
          <table class="table table-address mb-0 border-end" style="border-color:#000 !important">
            <tr>
              <td class="text-bold border-end" style="width: 30%;">VEHICLE NO.:</td>
              <td>
                <?= $vehical ? $vehical->vehicle_number : ''; ?>
              </td>
            </tr>
            <tr>
              <td class="text-bold border-end">Make:</td>
              <td id="vehical_Make"><?= $vehical ? $vehical->make : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Modal:</td>
              <td id="vehical_Modal"> <?= $vehical ? $vehical->model_number : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Colour:</td>
              <td id="vehical_colour"><?= $vehical ? $vehical->color : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">CHASSIS NO:</td>
              <td id="vehical_chassis_no"><?= $vehical ? $vehical->chassis_number : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">ENGINE NO.:</td>
              <td id="vehical_engine_no"><?= $vehical ? $vehical->engine_number : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">TAX TOKEN NO. :</td>
              <td id="vehical_tax_token"><?= $vehical ? $vehical->tax_token : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end border-bottom-0" style="    border-bottom: 1px solid black !important;">ROAD PERMIT NO:</td>
              <td class=" border-bottom-0" id="vehical_road_permit_no" style="    border-bottom: 1px solid black !important;"><?= $vehical ? $vehical->road_permmit : ''; ?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
          <table class="table table-address mb-0 border-start" style="border-color:#000 !important">
            <tr>
              <td class="text-bold border-end" style="width: 30%;">FITNESS VALIDITY:</td>
              <td id="vehical_fitness_validity"><?= $vehical ? $vehical->fitness_validity : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">INSURED FROM:</td>
              <td id="vehical_insured_from"><?= $vehical ? $vehical->insurance_by : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">DATE OF INSURANCE:</td>
              <td id="vehical_date_of_insurance"><?= $vehical ? $vehical->insurance_date : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">INSURED BY:</td>
              <td id="vehical_insured_by"><?= $vehical ? $vehical->insurance_by : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">CERTIFICATE:</td>
              <td id="vehical_certificate"><?= $vehical ? $vehical->certificate : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">DIVISION NO.:</td>
              <td id="vehical_division_no"><?= $vehical ? $vehical->division_number : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">FINANCER'S NAME:</td>
              <td id="vehical_financers_name"><?= $vehical ? $vehical->financed_by : ''; ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end border-bottom-0">ADDRESS::</td>
              <td class=" border-bottom-0" id="vehical_financers_address"><?= $vehical ? $vehical->financed_address : ''; ?></td>
            </tr>
          </table>
        </div>

        <div class="col-md-12">
          <div class="inside-container-fluid inside-container-left pt-2">
            <h5 style="background:#e68422;">Drivers Details</h5>
          </div>
        </div>
        <div class="col-md-5">
          <table class="table table-address mb-0 border-end" style="border-color:#000 !important">
            <tr>
              <td class="text-bold border-end" style="width: 30%;">Driver’s Name:</td>
              <td id="driver_name" style="width: 30%;"><?= $booking->driver_name ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Driver’s Address:</td>
              <td id="driver_address"><?= $booking->driver_address ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Owner’s Name:</td>
              <td id="vehical_owner_name"><?= $booking->owner_name ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Owner’s Address:</td>
              <td id="vehical_address"><?= $booking->owner_address ?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">
          <table class="table table-address mb-0 border-start" style="border-color:#000 !important">
            <tr>
              <td class="text-bold border-end" style="width: 30%;">Driving License No.:</td>
              <td id="driving_license" style="width: 30%;"><?= $booking->driving_licence_no ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Validity:</td>
              <td id="license_validity"><?= $booking->driving_validity ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Driver's Mobile No.:</td>
              <td id="driver_mobile"><?= $booking->driver_mobile ?></td>
            </tr>
            <tr>
              <td class="text-bold border-end">Owner’s Mobile No.:</td>
              <td id="owner_mobile"><?= $booking->owner_mobile ?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-12">
          <div class="d-flex justify-content-end py-3 me-3">
            <a href="<?= $previous_url; ?>" class="btn btn-success">
              Back
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<?= $this->endSection(); ?>