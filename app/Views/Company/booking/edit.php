<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Booking</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/booking">Booking</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


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
    </style>

    <body>
        <div class="app-content">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="header-title text-primary">
                                        Update Booking
                                    </h5>
                                </div>
                                <a href="<?= base_url('company/booking'); ?>" class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-table"></i> Report
                                </a>


                            </div>
                            <form action="<?= base_url('update-Booking') ?>" method="POST" enctype="multipart/form-data">
                                <?php $booking_number = $bookings->booking_no; ?>
                                <input type="hidden" name="delivery_point" value="<?= $delivery_point ?>" />
                                <input type="hidden" name="loading_point" value="<?= $loading_point ?>" />
                                <input type="hidden" name="quotation_id" value="<?= $quotation_id ?>" />
                                <input type="hidden" name="booking_type" value="<?= $booking_type ?>" />
                                <input type="hidden" name="booking_number" value="<?= $booking_number ?>" />
                                <input type="hidden" name="booking_id" value="<?= $bookings->id ?>" />
                                <input type="hidden" name="previous_url" value="<?= $previous_url ?>" />

                                <div class="container-fluid mx-0">

                                    <div class="container-main py-1">
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
                                                    <p>QUATATION NO. <span class="invoice-no"><?= $result->quotation_number ?></span></p>
                                                    <p>BOOKING NO. <span><?= $booking_number ?> </span></p>
                                                    <p>BOOKING DATE <span><?= date('d-m-Y'); ?></span></p>
                                                    <p>ENQUIRY DATE <span><?= date('d-m-Y', strtotime($result->quotation_date)); ?></span></p>
                                                    <p>FROM <span><?= $result ? $result->state_name : ''; ?> </span></p>
                                                    <p>TO <span><?= $consignee_details ? $consignee_details->District : ''; ?> </span></p>
                                                    <!-- <p>PLACE OF SUPPLY <span><?//= $consignee_details ? $consignee_details->StateName : ''; ?> </span></p> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col-sm-6">
                                                <div class="inside-container-fluid inside-container-left pb-2">
                                                    <h5>Consignor Details</h5>
                                                    <table class="table table-address mb-0">
                                                        <tr>
                                                            <td class="text-bold">Name:</td>
                                                            <td><?php echo ucfirst($consignor_details->name); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Address:</td>

                                                            <td>
                                                                <?php echo strtoupper($result->consinor_address);  ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">GSTIN:</td>
                                                            <td>
                                                                <?php echo $consignor_details->gst_number; ?>
                                                            </td>
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
                                                            <td><input type="number" class="calculate_booking_amount" id="rto_fine" name="rto_fine" value="<?= $bookings ? $bookings->rto_fine : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Advance, if any</td>
                                                            <td><input type="number" class="" id="advance_pay" name="advance_pay" value="<?= $bookings ? $bookings->advance_pay : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Statical Charge (Rs. 80 for AMS)</td>
                                                            <td><input type="number" class="calculate_booking_amount" id="statical_charge" name="statical_charge" value="<?= $bookings ? $bookings->statical_charge : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Detention Charges at Loading Point</td>
                                                            <td><input type="number" class="calculate_booking_amount" id="detention_charge_loading" name="detention_charge_loading" value="<?= $bookings ? $bookings->detention_charge_loading : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Detention Charges at Unloading Point</td>
                                                            <td><input type="number" class="calculate_booking_amount" id="detention_charge_unloading" name="detention_charge_unloading" value="<?= $bookings ? $bookings->detention_charge_unloading : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr class="d-none" >
                                                            <td class="text-bold">Total Payable</td>
                                                            <td><input type="number" class="calculate_booking_amount" id="total_payable" name="total_payable" value="<?= $bookings ? $bookings->total_payable : 0; ?>" style="border: 0px;text-align: right;" readonly /></td>
                                                        </tr>
                                                        <tr class="d-none" >
                                                            <td class="text-bold">CGST 2.5%</td>
                                                            <td><input type="number" class="calculate_booking_amount" id="total_cgst" name="total_cgst" value="<?= $bookings ? $bookings->total_cgst : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr class="d-none" >
                                                            <td class="text-bold">SGST 2.5%</td>
                                                            <td><input type="number" class="calculate_booking_amount" id="total_sgst" name="total_sgst" value="<?= $bookings ? $bookings->total_sgst : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr class="d-none" >
                                                            <td class="text-bold">IGST 5.5%</td>
                                                            <td><input type="number" class="calculate_booking_amount" id="total_igst" name="total_igst" value="<?= $bookings ? $bookings->total_igst : 0; ?>" style="border: 0px;text-align: right;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Total</td>
                                                            <td><input type="number" id="net_amount" name="net_amount" value="<?= $bookings ? $bookings->net_amount : 0; ?>" style="border: 0px;text-align: right;" readonly /></td>
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
                                                                    <select id="broker_id" name="broker_id" class="form-control" style="border: 0px;" required>
                                                                        <option value="">Select Broker</option>
                                                                        <?php foreach ($brokers as $key => $value) {
                                                                        ?>
                                                                            <option value="<?= $value->id ?>" <?= $bookings->broker_id == $value->id ? 'selected' : ''; ?>><?= ucfirst($value->name) . ' ( ' . $value->mobile . ' )'; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <a href="<?= base_url('company/add-broker') ?>" style="position: relative;top: -26px;float: right;color:blue;" target="_blank"><b>Add New</b></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Loading Advice No.:</td>
                                                                <td><input type="number" id="loading_advice_no" name="loading_advice_no" value="0" style="border: 0px;text-align: right;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Type of Vehicle:</td>
                                                                <td><select id="vehicle_type" name="vehicle_type" class="form-control" style="border:0px;">
                                                                        <option value="">Vehicle Type</option>
                                                                        <?php // foreach (type_of_vehicle() as $key => $value) { ?>
                                                                            <!-- <option value="<?//= $key ?>" <?//= $bookings->vehicle_type==$key?'selected':''; ?> ><?//= $value ?></option> -->
                                                                        <?php //} ?>
                                                                        <?php foreach ($VehicalType as $key => $value) { ?>
                                        <option value="<?= $value->id ?>" <?= ($bookings->vehicle_type== $value->id) ? 'selected':''; ?>><?= $value->vehical_type ?></option>
                                                                        <?php } ?>
                                                                    </select></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Width:</td>
                                                                <td><input type="number" id="vehicle_weight" name="vehicle_weight" value="0" style="border: 0px;text-align: right;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Length:</td>
                                                                <td><input type="number" id="vehicle_length" name="vehicle_length" value="0" style="border: 0px;text-align: right;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end border-bottom-0">Height:</td>
                                                                <td class=" border-bottom-0">
                                                                    <input type="number" id="vehicle_height" name="vehicle_height" value="0" style="border: 0px;text-align: right;" />
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
                                                                $total_lorry_hire_charge = $bookings->total_broker_amount + $bookings_brokers->rto_fine;
                                                            }

                                                            ?> 
                                                            <tr>
                                                                <td class="text-bold border-end">Lorry Hire Charges:</td>
                                                                <td><input type="number" class="broker_blance_payable" id="total_broker_amount" name="total_broker_amount" value="<?= ($bookings->total_broker_amount == '0' || $bookings->total_broker_amount == '') ? '' : $bookings->total_broker_amount ?>" style="border: 0px;text-align: right;" placeholder="(Amount in Rs.)" required /></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">RTO fine:</td>
                                                                <td><input type="number" class="broker_blance_payable" id="broker_rto_fine" name="broker_rto_fine" value="<?= $bookings_brokers ? $bookings_brokers->rto_fine : '0'; ?>" style="border: 0px;text-align: right;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Detention Charges, if any:</td>
                                                                <td><input type="number" class="broker_blance_payable" id="detention_charges" name="detention_charges" value="<?= $bookings_brokers ? $bookings_brokers->detention_charge : '0'; ?>" style="border: 0px;text-align: right;" /></td>
                                                            </tr>


                                                            <tr>
                                                                <td class="text-bold border-end text-danger">Late delivery Charges:</td>
                                                                <td><input type="number" class="broker_blance_payable" id="late_delivery_charges" name="late_delivery_charges" value="<?= $bookings_brokers ? $bookings_brokers->late_delivery_charge : '0'; ?>" style="border: 0px;text-align: right;" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-bold border-end text-danger">Other Deduction Charges:</td>
                                                                <td><input type="number" class="broker_blance_payable" id="other_deduction_charges" name="other_deduction_charges" value="<?= $bookings_brokers ? $bookings_brokers->other_deduction_charges : '0'; ?>" style="border: 0px;text-align: right;" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-bold border-end" style="background:#f3f3f3;"><b>Total Lorry Hire Charges:</b></td>
                                                                <td style="background:#f3f3f3;"><input type="number" id="total_lorry_hire_charge" name="total_lorry_hire_charge" value="<?= $total_lorry_hire_charge ?>" style="border: 0px;text-align: right;background:#f3f3f3" readonly=""></td>
                                                            </tr>



                                                            <tr>
                                                                <td class="text-bold border-end " style="color:#3daa25">Advance:</td>
                                                                <td><input type="number" id="advance" name="advance" value="<?= $bookings_brokers ? $bookings_brokers->advance : '0'; ?>" class="total_advance_paid" style="border: 0px;text-align: right;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end" style="color:#3daa25">Mamul Charges (A):</td>
                                                                <td><input type="number" id="mamul_chargesa" name="mamul_chargesa" value="<?= $bookings_brokers ? $bookings_brokers->mamul_charges_A : '0'; ?>" class="total_advance_paid" style="border: 0px;text-align: right;" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-bold border-end" style="color:#3daa25">Advance Payable:</td>
                                                                <td><input type="number" id="advance_payable" name="advance_payable" value="<?= $bookings_brokers ? $bookings_brokers->advance_payable : '0'; ?>" style="border: 0px;text-align: right;" readonly /></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-bold border-end" style="color:#3daa25">Advance Paid:</td>
                                                                <td><input type="number" id="advance_paid" name="advance_paid" value="<?= $bookings_brokers ? $bookings_brokers->advance_paid : '0'; ?>" class="total_advance_paid" style="border: 0px;text-align: right;" /></td>
                                                            </tr>


                                                            <tr>
                                                                <td class="text-bold border-end" style="color:#3daa25">Balance:</td>
                                                                <td><input type="number" id="total_balance" name="total_balance" value="<?= $bookings_brokers ? $bookings_brokers->balance : '0'; ?>" style="border: 0px;text-align: right;" readonly /></td>
                                                            </tr>





                                                            <tr>
                                                                <td class="text-bold border-end" style="color:#3daa25">Mamul Charges (B):</td>
                                                                <td><input type="number" id="mamul_chargesb" name="mamul_chargesb" value="<?= $bookings_brokers ? $bookings_brokers->mamul_charges_B : '0'; ?>" class="balance_payable" style="border: 0px;text-align: right;" /></td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-bold border-end " style="background:#f3f3f3;color:#3daa25"><b>Balance Payabe:</b></td>
                                                                <td style="background:#f3f3f3;"><input type="number" id="balance_payable" name="balance_payable" value="<?= $bookings_brokers ? $bookings_brokers->balance_payabe : '0'; ?>" style="border: 0px;text-align: right;color:#3daa25;background:#f3f3f3;" readonly /></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end ">Balance Paid:</td>
                                                                <td><input type="number" id="total_balance_payable" name="balance_paid" value="<?= $bookings_brokers ? $bookings_brokers->balance_paid : '0'; ?>" class="balance_payable" style="border: 0px;text-align: right;font-weight: 500;" /></td>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end py-3">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                <a href="<?= base_url('company/booking'); ?>" class="btn btn-warning">
                                                    Back
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
</main>


<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Booking Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-body">
                    <form action="<?= base_url('company/edit-Booking') ?>" method="GET" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <label for="name" class="form-label">Booking Type<span class="text-danger">*</span></label>
                                <select class="form-control" id="booking_type" name="booking_type" data="<?= $booking_type ?>" required>
                                    <option value="">-Select Booking Type-</option>
                                    <option value="Paid">Paid</option>
                                    <option value="To Pay">To Pay</option>
                                    <option value="both">TOPAY & PAID Basis</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <label for="loading_point" class="form-label">Loading Point<span class="text-danger">*</span></label>
                                <select class="form-control" id="loading_point" name="loading_point" data="<?= $loading_point ?>" required>
                                    <option value="">-Select Loading Point-</option>
                                    <option value="Single Point">Single Point</option>
                                    <option value="Multi Point">Multi Point</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <label for="delivery_point" class="form-label">Delivery Point<span class="text-danger">*</span></label>
                                <select class="form-control" id="delivery_point" name="delivery_point" data="<?= $delivery_point ?>" required>
                                    <option>-Select Delivery Point-</option>
                                    <option value="Single Point">Single Point</option>
                                    <option value="Multi Point">Multi Point</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Sn.</th>
                                        <th>Quotaion Number</th>
                                        <th>Date</th>
                                        <th>Consignor</th>
                                        <th>Delivery Address</th>
                                    </tr>
                                </thead>
                                <tbody id="quotation_list">
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12" style="text-align: right; background: white; padding-right: 20px;">
                                <button type="submit" id="submit_btn" class="btn btn-success btn-sm" value="Submit">Configure</button>
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
 $(document).ready(function() {
            // Vehicle data from PHP
            const vehicleData = {
                <?php foreach ($VehicalType as $value) { ?>
                    <?= $value->id ?>: {
                        weight: <?= $value->width ?>,
                        length: <?= $value->length ?>,
                        height: <?= $value->height ?>
                    },
                <?php } ?>
            };

            function updateVehicleFields(vehicleId) {
                if (vehicleId && vehicleData[vehicleId]) {
                    $('#vehicle_weight').val(vehicleData[vehicleId].weight);
                    $('#vehicle_length').val(vehicleData[vehicleId].length);
                    $('#vehicle_height').val(vehicleData[vehicleId].height);
                } else {
                    $('#vehicle_weight').val(0);
                    $('#vehicle_length').val(0);
                    $('#vehicle_height').val(0);
                }
            }

            // Bind change event to vehicle type dropdown
            $('#vehicle_type').change(function() {
                const vehicleId = $(this).val();
                updateVehicleFields(vehicleId);
            });

            // On document load, set the initial values if a vehicle type is already selected
            const initialVehicleId = $('#vehicle_type').val();
            updateVehicleFields(initialVehicleId);
        });


    function getQuatation() {
        $('#booking_type').val($('#booking_type').attr('data'))
        $('#loading_point').val($('#loading_point').attr('data'))
        $('#delivery_point').val($('#delivery_point').attr('data'))

        $.ajax({
            url: '<?= base_url('get-quotation-list') ?>',
            method: 'post',
            data: {
                'id': 0
            },
            success: function(data) {
                let res = JSON.parse(data);
                let qutation_html = "";
                if (res.status == 1) {
                    res.result.forEach((element, key) => {
                        let selected = "<?= $quotation_id ?>";
                        let radio_check = "";
                        if (selected == element.id) {
                            radio_check = "checked";
                        }
                        console.log(element, 'element');
                        qutation_html += `<tr>
                                    <td>` + (key + 1) + ` &nbsp;&nbsp;<input type="radio" id="quotation_id" name="quotation_id" value="` + element.id + `" required ` + radio_check + ` /></td>
                                    <td>` + element.quotation_number + `</td>
                                    <td>` + element.quotation_date + `</td>
                                    <td>` + element.consignor_name + `</td>
                                    <td>` + element.delivery_short_address + `</td>
                                </tr>`;
                    });
                    $("#quotation_list").html(qutation_html);
                }
                console.log(res, 'res');
            },
        });
    }





    $(".calculate_booking_amount").change(function(e) {
        let total_quation_amount = "<?= $result ? $result->amount : 0; ?>";
        let rto_fine = $("#rto_fine").val(); 
        let statical_charge = $("#statical_charge").val();
        let detention_loading = $("#detention_charge_loading").val();
        let detention_unloading = $("#detention_charge_unloading").val();
        let total_cgst = $("#total_cgst").val();
        let total_sgst = $("#total_sgst").val();
        let total_igst = $("#total_igst").val();
        let net_amount = 0;
        net_amount = parseFloat(total_quation_amount) + parseFloat(rto_fine) + parseFloat(statical_charge) + parseFloat(detention_loading) + parseFloat(detention_unloading) + parseFloat(total_cgst) + parseFloat(total_sgst) + parseFloat(total_igst);
        $("#net_amount").val(net_amount.toFixed(2));

    })

    $(".broker_blance_payable").change(function(e) {
        let total_broker_amount = $("#total_broker_amount").val();
        let broker_rto_fine = $("#broker_rto_fine").val();
        let detention_charges = $("#detention_charges").val();
        let late_delivery_charges = $("#late_delivery_charges").val();
        let other_deduction_charges = $("#other_deduction_charges").val();

        let balance_payable = 0;
        balance_payable = parseFloat(total_broker_amount) + (parseFloat(broker_rto_fine) + parseFloat(detention_charges));

        let totl_reduces = parseFloat(late_delivery_charges) + parseFloat(other_deduction_charges);
        let total_lorry_hire_charge = parseFloat(balance_payable) - parseFloat(totl_reduces);
        // $("#balance_payable").val(balance_payable.toFixed(2));
        $("#total_lorry_hire_charge").val(total_lorry_hire_charge.toFixed(2));
        // $("#balance_payable").val(balance_payable.toFixed(2));
        calculate_balance_payable();
    });

    $(".broker_net_payable").change(function(e) {
        let total_broker_amount = $("#total_broker_amount").val();
        if (total_broker_amount == NaN) {
            total_broker_amount = 0;
        }
        let advance_paid = $("#advance_paid").val();
        let mamul_charges = $("#mamul_charges").val();
        let detention_charges = $("#detention_charges").val();
        let late_delivery_charges = $("#late_delivery_charges").val();
        let net_payable = 0;
        net_payable = parseFloat(total_broker_amount) - (parseFloat(detention_charges) + parseFloat(late_delivery_charges) + parseFloat(advance_paid) + parseFloat(mamul_charges));
        $("#net_balance_payable").val(net_payable.toFixed(2));
        total_deduction();
    });

    $(".total_advance_paid").change(function(e) {
        total_advance_paid();
    });

    function total_advance_paid() {
        let advance = $("#advance").val();
        let mamul_chargesa = $("#mamul_chargesa").val();
        let advance_paid = $("#advance_paid").val();
        let advance_payable = $("#advance_payable").val();
        if (parseFloat(advance_payable) < parseFloat(advance_paid)) {
            $("#advance_paid").val(0);
            alert('Advance paid amount is should we less than and equal of Advance payable');
            $("#advance_paid").select();
        } else if (parseFloat(advance_payable) < parseFloat(mamul_chargesa)) {
            $("#mamul_chargesa").val(0);
            alert('Advance paid amount is should we less than and equal of Mamul(A) Charges');
            $("#mamul_chargesa").select();
        } else {
            let total_advacne_paid = parseFloat(advance) - (parseFloat(mamul_chargesa) + parseFloat(advance_paid));
            $("#advance_payable").val(total_advacne_paid);
        }
        // net_balance_payable(); 
    }

    function total_deduction() {
        let late_delivery_charges = $("#late_delivery_charges").val();
        let other_deduction_charge = $("#other_deduction_charges").val();
        let total_deduction = parseFloat(late_delivery_charges) + parseFloat(other_deduction_charge);
        $("#total_deduction").val(total_deduction);
        net_balance_payable();
    }

    function net_balance_payable() {
        let balance_payable = $("#balance_payable").val();
        let total_deduction = $("#total_deduction").val();
        let total_advance_ = 0; // 
        let total_balance = parseFloat(balance_payable) - (parseFloat(total_deduction) + parseFloat(total_advance_));
        $("#net_balance_payable").val(total_balance);
    }


    $("#advance").change(function(e) {
        let advance = $("#advance").val();
        let total_lorry_hire_charge = $("#total_lorry_hire_charge").val();
        if (parseFloat(advance) > parseFloat(total_lorry_hire_charge)) {
            alert('lorry advance amount is should we less than and equal of total lorry charges');
            $("#advance").val(0);
            total_advance_paid();
            $("#advance").select();
        } else {
            let balance = parseFloat(total_lorry_hire_charge) - parseFloat(advance);
            $("#total_balance").val(balance);
            calculate_balance_payable();
        }
    });


    $(".balance_payable").change(function(e) {
        calculate_balance_payable();
    })

    function calculate_balance_payable() {
        let total_lorry_hire_charge = $("#total_lorry_hire_charge").val();
        let advance = $("#advance").val();
        let total_balance = parseFloat(total_lorry_hire_charge) - parseFloat(advance);
        let mamul_chargesb = $("#mamul_chargesb").val();
        let balance_paid = $("#total_balance_payable").val();
        console.log(total_lorry_hire_charge, 'total_lorry_hire_charge');
        console.log(advance, 'total_lorry_hire_charge');
        console.log(mamul_chargesb, 'total_lorry_hire_charge');
        console.log(balance_paid, 'total_lorry_hire_charge');

        if (parseFloat(total_balance) < parseFloat(balance_paid)) {
            $("#total_balance_payable").val(0);
            alert('Balance Payable amount is should we less than and equal of Balance Paid');
            $("#total_balance_payable").select();
        } else if (parseFloat(total_balance) < parseFloat(mamul_chargesb)) {
            $("#mamul_chargesb").val(0);
            alert('balance amount is should we less than and equal of Mamul(B) Charges');
            $("#mamul_chargesb").select();
        } else {
            let balance_payable = parseFloat(total_balance) - (parseFloat(mamul_chargesb) + parseFloat(balance_paid));
            $("#balance_payable").val(balance_payable);
        }


    }
</script>
<?= $this->endSection(); ?>