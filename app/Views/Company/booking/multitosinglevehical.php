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


    table,
    td,
    th {
        border-color: #000 !important;
    }

    .below-right .row {
        justify-content: flex-end;
    }

    .table.table-address td {
        padding: 3px 5px !important;
    }

    .challan_date {
        display: block;
        width: 100%;
        text-align: right;
        font-size: 12px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
    }

    .consign_number {
        display: block;
        float: left;
        text-align: right;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        margin-right: 15px;
        margin-bottom: 5px;
    }

    .consign_numberss_css {
        display: none;
    }
    .remove-btn {
        background-color: #ff6666;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
<main class="app-main">
    <div style="background-color:#fff;">
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

        <body>
            <div class="app-content">
                <form action="<?= base_url(); ?>save-MultiToSingleVehical" method="POST" enctype="multipart/form-data" id="yourFormId">

                    <div class="container-fluid mx-0">
                        <div class="container-main py-1">
                            <h4 class="text-center mb-0 font-18">Vehical Placement</h4>
                            <img class="logo pl-5" src="<?= base_url('Assets/Images/logo.png') ?>" alt="logo" />

                            <?php $booking_number = $booking->booking_no ?>
                            <input type="hidden" name="delivery_point" value="<?= $delivery_point ?>" />
                            <input type="hidden" name="loading_point" value="<?= $loading_point ?>" />
                            <input type="hidden" name="quotation_id" value="<?= $quotation_id ?>" />
                            <input type="hidden" name="booking_type" value="<?= $booking_type ?>" />
                            <input type="hidden" name="booking_number" value="<?= $booking_number ?>" />


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
                                        <p>BOOKING DATE <span><?= date('d-m-Y', strtotime($booking->date)); ?></span></p>
                                        <p>ENQUIRY DATE <span><?= date('d-m-Y', strtotime($result->quotation_date)); ?></span></p>
                                        <p>FROM <span><?= $result ? $result->state_name : ''; ?> </span></p>
                                        <p>TO <span><?= $consignee_details ? $consignee_details->District : ''; ?> </span></p>
                                        <p>PLACE OF SUPPLY<span><?= $consignee_details ? $consignee_details->StateName : ''; ?> </span></p>
                                        <p>CHALLAN NO<span> <?= getVoucherNumber('Challan') ?> </span>
                                            <input type="hidden" name="challan_number" id="challan_number" value="<?= getVoucherNumber('Challan') ?>" />
                                        </p>

                                        <p>CHALLAN DATE<span> <input type="date" class="challan_date" name="challan_date" id="challan_date" class="form-control" value="<?= date('Y-m-d') ?>" /> </span></p>
                                        <p id="showsplit" style="display:none;"> <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="openpinmodel">split Bill</a> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12" id="appendconsignee">
                                    <div class="inside-container-fluid inside-container-left pb-2">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>
                                                    <h5>Consign Date</h5>
                                                </th>
                                                <th>
                                                    <h5>Consignor Details</h5>
                                                </th>

                                                <th>
                                                    <h5>Consignee Details</h5>
                                                </th>
                                                <th>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="addconsignedetail">+</a>
                                                </th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" style="width:17.66666667%;">
                                                        <p><input type="date" name="consign_date[]" id="consign_date" class="form-control" value="<?= date('Y-m-d') ?>" placeholder="Consign No" required /></p>
                                                        <h5>Consign Number <i class="bi bi-plus-square" id="addConsignNumber" style="cursor:pointer;"></i></h5>

                                                    </td>

                                                    <td>
                                                        <table class="table table-address mb-0">
                                                            <tr>
                                                                <td class="text-bold border-end" style="width: 30%;">Name:</td>
                                                                <td><?php if (!empty($consignor_details)) {
                                                                        echo ucfirst($consignor_details->name);
                                                                    }  ?>
                                                                   <input type="hidden" name="consignorr_id[]" class="consignorr_idn" value="<?=$consignor_details->id; ?>">  
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Address:</td>
                                                                <td><?php if (!empty($consignor_details)) {
                                                                        echo strtoupper($result->consinor_address);
                                                                    } ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">GSTN:</td>
                                                                <td><?php if (!empty($consignor_details)) {
                                                                        echo $consignor_details->gst_number;
                                                                    } ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                    <td>
                                                        <table class="table table-address mb-0">
                                                            <tr>
                                                                <td class="text-bold border-end" style="width: 30%;">Name:</td>
                                                                <td>
                                                                    <select id="consignee_id" name="consignee_id" class="form-control" style="border: 0px;" required>
                                                                        <option value="">Select Consignee</option>
                                                                        <?php foreach ($consignee as $key => $value) {
                                                                        ?>
                                                                            <option value="<?= $value->id ?>"><?= ucfirst($value->name) . ' (' .$value->nickname.')' .' ( '.$value->mobile . ' )'; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <a href="<?= base_url('company/add-consignee') ?>" style="position: relative;top: -26px;float: right;color:blue;" target="_blank"><b>Add New</b></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Address:</td>
                                                                <td id="consignee_address"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">GSTN:</td>
                                                                <td id="consignee_gst"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot id="consign_numbers" >
                                                
                                            </tfoot>
                                        </table>
                                        
                                    </div>
                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="inside-container-fluid inside-container-left pb-2">
                                        <h5>VEHICLES/LORRY DETAILS</h5>
                                    </div>
                                </div>

                                <div class="col-md-3">

                                    <table class="table table-address mb-0 border-end" style="border-color:#000 !important">
                                        <tr>
                                            <td class="text-bold border-end">Broker Name:</td>
                                            <td><?= $brokers ? $brokers->name : ''; ?></td>
                                        <tr>
                                            <td class="text-bold border-end">Broker Mobile:</td>
                                            <td><?= $brokers ? $brokers->mobile : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Broker Email:</td>
                                            <td><?= $brokers ? $brokers->email : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Broker Address:</td>
                                            <td><?= $brokers ? $brokers->address_1 : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Broker GST:</td>
                                            <td><?= $brokers ? $brokers->gst_number : ''; ?></td>
                                        </tr>
                                        

                                    </table>
                                </div>
                                <div class="col-md-5">
                                    <table class="table table-address mb-0 border-end" style="border-color:#000 !important">
                                        <tr>
                                            <td class="text-bold border-end" style="width: 30%;">VEHICLE NO.:</td>
                                            <td>
                                                <input type="text" name="vehical_number" id="vehical_number" class="form-control" required />
                                                <input type="hidden" name="vehical_id" id="vehical_id" value="0" />
                                                <input type="hidden" name="booking_id" id="booking_id" value="<?= $booking->id ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Make:</td>
                                            <td id="vehical_Make">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Modal:</td>
                                            <td id="vehical_Modal">Drop Down</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Colour:</td>
                                            <td id="vehical_colour">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">CHASSIS NO:</td>
                                            <td id="vehical_chassis_no">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">ENGINE NO.:</td>
                                            <td id="vehical_engine_no">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">TAX TOKEN NO. :</td>
                                            <td id="vehical_tax_token">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end border-bottom-0">ROAD PERMIT NO:</td>
                                            <td class=" border-bottom-0" id="vehical_road_permit_no">-</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-address mb-0 border-start" style="border-color:#000 !important">
                                        <tr>
                                            <td class="text-bold border-end" style="width: 30%;">FITNESS VALIDITY:</td>
                                            <td id="vehical_fitness_validity"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">INSURED FROM:</td>
                                            <td id="vehical_insured_from">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">DATE OF INSURANCE:</td>
                                            <td id="vehical_date_of_insurance">Drop Down</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">INSURED BY:</td>
                                            <td id="vehical_insured_by">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">CERTIFICATE:</td>
                                            <td id="vehical_certificate">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">DIVISION NO.:</td>
                                            <td id="vehical_division_no">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">FINANCER'S NAME:</td>
                                            <td id="vehical_financers_name">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end border-bottom-0">ADDRESS::</td>
                                            <td class=" border-bottom-0" id="vehical_financers_address">-</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <div class="inside-container-fluid inside-container-left pt-2">
                                        <h5>Drivers Details</h5>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <table class="table table-address mb-0 border-end" style="border-color:#000 !important">
                                        <tr>
                                            <td class="text-bold border-end" style="width: 30%;">Driver’s Name:</td>
                                            <td id="driver_name"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Driver’s Address:</td>
                                            <td id="driver_address">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Owner’s Name:</td>
                                            <td id="vehical_owner_name"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Owner’s Address:</td>
                                            <td id="vehical_address">-</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <table class="table table-address mb-0 border-start" style="border-color:#000 !important">
                                        <tr>
                                            <td class="text-bold border-end" style="width: 30%;">Driving License No.: </td>
                                            <td id="driving_license"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Validity:</td>
                                            <td id="license_validity">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Driver's Mobile No.:</td>
                                            <td id="driver_mobile"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold border-end">Owner’s Mobile No.:</td>
                                            <td id="owner_mobile">-</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end py-3 me-3">
                                    <input type="submit" class="btn btn-primary btn-sm" form="yourFormId" value="Submit" />

                                        <!-- <button type="submit" class="btn btn-success">Save</button> -->
                                        <button type="button" class="btn btn-warning ms-2">Modify</button>
                                        <button type="button" class="btn btn-primary ms-2">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </body>

    </div>
</main>

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
 
</thead>
<tbody>
    <tr class="append_split_table">
        
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

<?php $booking_json = json_encode($booking); ?>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script>

function removeBox(button) {
    $(button).closest('.remove-box').remove();
}

let clickCount = 0;
 $('#yourFormId').submit(function(e) {
    var bill_type ='<?= $booking_type; ?>';

    clickCount++;
        e.preventDefault(); 
        if(bill_type == 'Paid'){
        if(clickCount >=2){
            this.submit();
            }
            else{
        if (confirm("Are you want to Split Booking Charges ?")) { 
            $('#showsplit').show();
            $('#myModal').modal('show');
            $('#openpinmodel').click();
            $("#openpinmodel").trigger('click'); 
        } 
        else {
         this.submit();
        }
        }
        }else{
         this.submit();
  
        }
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


    $(document).ready(() => {

    $(document).on("click", "#openpinmodel", function(){

    $('#onsubmit').removeAttr('disabled');
    var bill_type ='<?= $booking_type; ?>';

if(bill_type == 'Paid'){
    var error = false;
    $('.consignorr_idn').each(function() {
        if ($(this).val() == '') {
            error = true;
            return false; 
        }
    });
    if (error) {
        $('#openpinmodel').removeAttr('data-toggle');
        alert('Please fill in all Consignor Name ');
            //  $('#myModal').modal('hide');

        return;
    }
    $('#openpinmodel').attr('data-toggle', 'modal');

}else{
    var error = false;
    $('select[name="consignee_id[]"]').each(function() {
        if ($(this).val() == '') {
            error = true;
            return false; 
        }
    });
    if (error) {
        $('#openpinmodel').removeAttr('data-toggle');
        alert('Please fill in all Consignee Name ');
            //  $('#myModal').modal('hide');

        return;
    }
    $('#openpinmodel').attr('data-toggle', 'modal');
}
    // $('#myModal').modal('show');

//////////
var bookingid =$('#booking_id').val();
////////////
if(bill_type == 'Paid'){

    var inputValues = [];
$('.consignorr_idn').each(function() {
    inputValues.push($(this).val());

});
console.log(inputValues,'consignor vale');

}else{

    var inputValues = [];
$('select[name="consignee_id[]"]').each(function() {
    inputValues.push($(this).val());
});
}

var booking_detail=<?= $booking_json; ?>;

////////
var res= [];

/////////
let append_split_table = `<td class="text-left" style="width:29.66666667%;"><table class="table table-address table-pad mb-0" border="0"><tr><td class="text-bold"> `+((bill_type == 'Paid') ? 'Consignor Name': 'Consignee Name')+`</td></tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Booking Amount:<input type="text"  value="`+booking_detail.booking_amount+`" id="tot_bookingamt" style="float: right;" disabled>
                    <input type="hidden" value="`+bookingid+`" name="booking_id_new" id="bookingnewid"></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">RTO Fine, if any:<input type="number" value="`+booking_detail.rto_fine+`" id="tot_rto_fine" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Advance, if any:<input type="number" value="`+booking_detail.advance_pay+`" id="tot_advance_pay" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Statical Charge:<input type="number" value="`+booking_detail.statical_charge+`" id="tot_statical_charge" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Loading Point Charges:<input type="number" value="`+booking_detail.detention_charge_loading+`" id="tot_charge_loading" style="float: right;" disabled></td>
                </tr>
                <tr style="line-height:3;">
                    <td class="text-bold">Unloading Point Charges:<input type="number" value="`+booking_detail.detention_charge_unloading+`" id="tot_charge_unloading" style="float: right;" disabled></td>
                </tr>
            </table>
        </td>`;
let appendheading =`<th style="background-color: #00297a;" ><h5 style="color:white;">Booking Fields</h5></th>`;

    $.ajax({
            url: '<?= base_url('get-split-bill-data') ?>',
            method: 'post',
            data: function(){
                if(bill_type == 'Paid'){
                    return {
               consignorid: inputValues,
               consigneeid: 'null',

                brokerid: bookingid,
                    }
                }else {

                    return {
             consignorid: 'null',
               consigneeid: inputValues,
                brokerid: bookingid,
                    }
                }
                

            }(),
            success: function(data) {
                 res = JSON.parse(data);
               console.log(res,'get-split-bill-split_count');
///////////
var countPrint=null;
if(inputValues.length > res.split_count){
 countPrint= inputValues.length;
}else{
    countPrint =res.split_count;
}
console.log(typeof(countPrint),'countPrint');
for (let i = 0; i < inputValues.length; i++) {

    appendheading += `<th style="background-color: #00297a;"><h5 style="color:white;">`+((bill_type == 'Paid') ? 'Consignor': 'Consignee')+`</h5></th>`;
append_split_table += `<td>
        <table class="table table-address table-pad mb-0">
            <tr>
                <td class="text-bold" style="width: 30%;">`+res.result[i][0]['name']+`
                <input type="hidden" name="consignor_id[]" value="`+res.result[i][0]['id']+`">
                <input type="hidden" name="consignee_id[]" value="`+res.result[i][0]['id']+`">
            
                </td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="booking_amt[]" class="form-control" style="width:65%;" value="`+((res.split_data[0][i] && res.split_data[0][i]['booking_amt'] != undefined ) ? res.split_data[0][i]['booking_amt'] : '') +`" onchange="validateBookingAmount(this,'booking_amt[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="rto_fine[]" class="form-control"  value="`+((res.split_data[0][i] && res.split_data[0][i]['rto_fine'] != undefined) ? res.split_data[0][i]['rto_fine'] : '') +`" style="width: 65%;" onchange="validateBookingAmount(this,'rto_fine[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="advance_pay[]" class="form-control"  value="`+((res.split_data[0][i] && res.split_data[0][i]['advance_pay'] != undefined) ? res.split_data[0][i]['advance_pay'] : '') +`" style="width:65%;" onchange="validateBookingAmount(this,'advance_pay[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="statical_charge[]" class="form-control" value="`+((res.split_data[0][i] && res.split_data[0][i]['statical_charge'] != undefined) ? res.split_data[0][i]['statical_charge'] : '') +`" style="width: 65%;" onchange="validateBookingAmount(this,'statical_charge[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="detention_charge_loading[]" class="form-control"  value="`+((res.split_data[0][i] && res.split_data[0][i]['detention_charge_loading'] != undefined) ? res.split_data[0][i]['detention_charge_loading'] : '') +`" style="width:65%;" onchange="validateBookingAmount(this,'detention_charge_loading[]')" required></td>
            </tr>
            <tr>
                <td class="text-bold"><input type="number" name="detention_charge_unloading[]" class="form-control"  value="`+((res.split_data[0][i] && res.split_data[0][i]['detention_charge_unloading'] != undefined) ? res.split_data[0][i]['detention_charge_unloading'] : '') +`" style="width: 65%;" onchange="validateBookingAmount(this,'detention_charge_unloading[]')" required></td>
            </tr>
        </table>
    </td>`;

              //////////// 
            }
            $(".appendheading").html(appendheading);

        $(".append_split_table").html(append_split_table);
            },
            error: function(xhr, status, error) {
            console.error(xhr.responseText,'error accured');
        }
        });
   
    });
      
         });
    // }
    

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
            if(res.status == '1'){
             $('.modal').find('.close').click();
             $("#myModal").modal('hide');

        }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText,'error accured');
        }
    });
});


    $(document).ready(function() {
        let consign_number = `<tr><td><div class="input-container">
                            <input type="number" name="consign_number[]" id="consign_number" class="consign_number form-control" placeholder="Enter Consign No." required />
                            <input type="hidden" name="consign_consignee_id[]" id="consign_consignee_id" value="" class="consign_consignee_id"/>
                            <input type="hidden" name="consign_consignor_id[]" id="consign_consignor_id" value="" class="consign_consignor_id"/>
                            <span class="errormsg" style="font-size: 10px;color: red;"></span>
                          </div></td><td colspan="2" ><textarea rows="1" cols="6" name="service_description[]" id="service_description" class="form-control" placeholder="ENTER DESCRIPTION OF GOODS/SERVICES" style="width:40%;display: inline;"></textarea>
                          <input type="text" id="eway_bill" name="eway_bill[]" class="form-control" placeholder="Eway Bill" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_date" name="eway_bill_date[]" onfocus="(this.type='date')" placeholder="Eway Date" class="form-control placeholder-shown" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_expire" name="eway_bill_expire[]" class="form-control" placeholder="Eway Expire" onfocus="(this.type='date')" style="width:20%;display: inline;vertical-align: top;" required></td></tr>`;
        $("#consign_numbers").html(consign_number);
    });

    $("#addConsignNumber").click(function() {
        $(".consign_numberss").removeClass("consign_numberss_css");
        let consign_number = `<tr><td><div class="input-container">
                            <input type="number" name="consign_number[]" id="consign_number" class="consign_number form-control" placeholder="Enter Consign No." required />
                            <input type="hidden" name="consign_consignee_id[]" id="consign_consignee_id" value="" class="consign_consignee_id"/>
                            <input type="hidden" name="consign_consignor_id[]" id="consign_consignor_id" value="" class="consign_consignor_id"/>
                            <span class="errormsg" style="font-size: 10px;color: red;"></span>
                          </div></td><td colspan="2" ><textarea rows="1" cols="6" name="service_description[]" id="service_description" class="form-control" placeholder="ENTER DESCRIPTION OF GOODS/SERVICES" style="width:40%;display: inline;"></textarea>
                          <input type="text" id="eway_bill" name="eway_bill[]" class="form-control" placeholder="Eway Bill" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_date" name="eway_bill_date[]" onfocus="(this.type='date')" placeholder="Eway Date" class="form-control placeholder-shown" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_expire" name="eway_bill_expire[]" class="form-control" placeholder="Eway Expire" onfocus="(this.type='date')" style="width:20%;display: inline;vertical-align: top;" required></td><td><button class='remove-btn' onclick='removeRow(this)'><i class="bi bi-trash"></i></button></td></tr>`;
        $("#consign_numbers").append(consign_number);
    });

    //
    $(document).on("click", ".addConsignNumber", function() {
        // $(".consign_numberss").removeClass("consign_numberss_css");
        var consignee_id = $('#consignee_id').val();
if(consignee_id != ''){
        var $table = $(this).closest('table');

        let consign_number = `<tr><td><div class="input-container">
                            <input type="number" name="consign_number[]" id="consign_number" class="consign_number form-control" placeholder="Enter Consign No." required />
                            <input type="hidden" name="consign_consignee_id[]" id="consign_consignee_id" value="" class="consign_consignee_id"/>
                            <input type="hidden" name="consign_consignor_id[]" id="consign_consignor_id" value="" class="consign_consignor_id"/>
                            <span class="errormsg" style="font-size: 10px;color: red;"></span>
                          </div></td><td colspan="2" ><textarea rows="1" cols="6" name="service_description[]" id="service_description" class="form-control" placeholder="ENTER DESCRIPTION OF GOODS/SERVICES" style="width:40%;display: inline;"></textarea>
                          <input type="text" id="eway_bill" name="eway_bill[]" class="form-control" placeholder="Eway Bill" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_date" name="eway_bill_date[]" onfocus="(this.type='date')" placeholder="Eway Date" class="form-control placeholder-shown" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_expire" name="eway_bill_expire[]" class="form-control" placeholder="Eway Expire" onfocus="(this.type='date')" style="width:20%;display: inline;vertical-align: top;" required></td><td><button class='remove-btn' onclick='removeRow(this)'><i class="bi bi-trash"></i></button></td></tr>`;
        // $(".consign_numbers").append(consign_number);
        $table.find(".consign_numbers").append(consign_number);
} else{
            alert('select Consignee name!');
            // $('.consign_consignee_id').select();
            $('#consignee_id').focus();

    }
    });
    /////

    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
    $(document).ready(function() {
    // On page load
    $('.consignorr_idn').each(function() {
        var $childTable = $(this).closest('table'); // Find the parent table of the current .consignorr_idn
        var consignor_id = $(this).val(); // Get the value of the current .consignorr_idn
        var $parentTable = $childTable.parents('table'); // Find the parent table of the child table
        $parentTable.find(".consign_consignor_id").val(consignor_id); // Set the value to the .consign_cons table

    });
});
    /////
    $("#addConsignNumber").click(function(){
    // On page load
    $('.consignorr_idn').each(function() {
        var $childTable = $(this).closest('table'); // Find the parent table of the current .consignorr_idn
        var consignor_id = $(this).val(); // Get the value of the current .consignorr_idn
        var consignee_id = $('select[name="consignee_id"]').val(); // Get the value of the current .consignorr_idn
        var $parentTable = $childTable.parents('table'); // Find the parent table of the child table
        $parentTable.find(".consign_consignor_id").val(consignor_id); // Set the value to the .consign_cons table
        $parentTable.find(".consign_consignee_id").val(consignee_id); // Set the value to the .consign_cons table

    });
});
    /////
    $(document).on("click", ".addConsignNumber", function() {
    var $closestConsignorr = $(this).closest('tr').find('.consignorr_idn');
    
    var consignor_id = $(this).closest('table').find('.consign_consignor_id').val();
    var consignee_id = $('.consign_consignee_id').val();

    // var consignee_id = $(this).closest('table').find('.consign_consignee_id').val();
    
     $(this).closest('table').find('.consign_consignor_id').val(consignor_id);
    // $(this).closest('table').find('.consign_consignee_id').val(consignee_id);

    $closestConsignorr.closest('tr').find('.consign_consignor_id').val(consignor_id);
    $('.consign_consignee_id').val(consignee_id);
    
   
});
    /////
    $(document).on("change", "select[name='consignee_id']", function() {
        var consignor_id = $(this).val(); // Get the value of the current .consignorr_idn
    $(".consign_consignee_id").val(consignor_id); // Set the value to the .consign_cons table

});
    /////
    $(document).on("change", "select[name='consignorr_id[]']", function() {
    // On page load
    $(this).each(function() {
        var $childTable = $(this).closest('table'); // Find the parent table of the current .consignorr_idn
        var consignor_id = $(this).val(); // Get the value of the current .consignorr_idn
        var $parentTable = $childTable.parents('table'); // Find the parent table of the child table
        $parentTable.find(".consign_consignor_id").val(consignor_id); // Set the value to the .consign_cons table

    });
});

    //////
    $(document).on("change", ".consignorr_idn", function() {
    var selectedValues = []; // Array to store selected values

    $(".consignorr_idn").each(function() {

        var curr_value = $(this).val();

        if (selectedValues.indexOf(curr_value) !== -1) {
            $(this).val("");
            alert("Each Consignor must be unique. Please select a different Consignor.");
        } else {
            selectedValues.push(curr_value);
        }
    });
});
    //
    var appendCounter = 0;

    $("#addconsignedetail").click(function() {
        appendCounter++;

        let consign_number = ` <div class="inside-container-fluid inside-container-left pb-2 remove-box">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>
                                                    <h5>Consign Date</h5>
                                                </th>
                                                <th>
                                                    <h5>Consignor Details</h5>
                                                </th>
                                                <th>
                                                <button class="remove-btn" onclick="removeBox(this)">X</button>
                                                </th>
                                               
                                               
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" style="width:17.66666667%;">
                                                        <p><input type="date" name="consign_date[]" id="consign_date" class="form-control" value="<?= date('Y-m-d') ?>" placeholder="Consign No" required /></p>
                                                        <h5>Consign Number <a class="addConsignNumber text-white"><i class="bi bi-plus-square"  style="cursor:pointer;"></i><a></h5>

                                                    </td>

                                                    <td>
                                                        <table class="table table-address mb-0">
                                                            <tr>
                                                                <td class="text-bold border-end" style="width: 30%;">Name:</td>
                                                                <td><select name="consignorr_id[]" class="consignorr_idn form-control" style="border: 0px;" required>
                                                                        <option value="">Select Consignor</option>
                                                                        <?php foreach ($consignorr as $key => $value) {
                                                                        ?>
                                                                            <option value="<?= $value->id ?>"><?= ucfirst($value->name) . ' (' .$value->nickname.')' .' ( '.$value->mobile . ' )'; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">Address:</td>
                                                                <td class="consignorr_address"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold border-end">GSTN:</td>
                                                                <td class="consignorr_gst"></td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                   
                                                </tr>
                                            </tbody>
                                            <tfoot class="consign_numbers" >
                                            <tr><td><div class="input-container">
                            <input type="number" name="consign_number[]" id="consign_number" class="consign_number form-control" placeholder="Enter Consign No." required />
                            <input type="hidden" name="consign_consignee_id[]" id="consign_consignee_id" value="" class="consign_consignee_id"/>
                            <input type="hidden" name="consign_consignor_id[]" id="consign_consignor_id" value="" class="consign_consignor_id"/>
                            <span class="errormsg" style="font-size: 10px;color: red;"></span>
                          </div></td><td colspan="2" >
                          <textarea rows="1" cols="6" name="service_description[]" id="service_description" class="form-control" placeholder="ENTER DESCRIPTION OF GOODS/SERVICES" style="width:40%;display: inline;"></textarea>
                          <input type="text" id="eway_bill" name="eway_bill[]" class="form-control" placeholder="Eway Bill" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_date" name="eway_bill_date[]" onfocus="(this.type='date')" placeholder="Eway Date" class="form-control placeholder-shown" style="width:19%;display: inline;vertical-align: top;" required>
                          <input type="text" id="eway_bill_expire" name="eway_bill_expire[]" class="form-control" placeholder="Eway Expire" onfocus="(this.type='date')" style="width:20%;display: inline;vertical-align: top;" required></td></tr>
                                            </tfoot>
                                        </table>
                                        
                                    </div>`;
        $("#appendconsignee").append(consign_number);
        console.log('Append count:', appendCounter);

    });
    ////////
    $(document).on("change", ".consign_number", function() {
        let input_value = parseInt($(this).val()); // Parse the input value as an integer
        var startVal = parseInt("<?= $ConsignNumberValue->start_number; ?>");
        var endVal = parseInt("<?= $ConsignNumberValue->end_number; ?>");
        // typeof(input_value);
        // Parse the bookingConsignNum array from PHP
        var bookingConsignNum = <?php echo json_encode($bookingConsignNum); ?>;
        var hasDuplicates = false;
        var isInRange = input_value >= startVal && input_value <= endVal;
        var isValidInput = input_value !== '' && isInRange;
        var isValid = true;
        var checkEachInputDuplicates = false;
        for (var i = 0; i < bookingConsignNum.length; i++) {
            // console.log(typeof input_value); // Output: "string"
            if (bookingConsignNum[i].consignment_number == input_value) {
                hasDuplicates = true;
                isValid = false;
                break; // Exit the loop if a match is found
            }
        }
        $(".consign_number").not(this).each(function() {
            if (parseInt($(this).val()) === input_value) {
                checkEachInputDuplicates = true;
                return false; // Exit the loop early if duplicate is found
            }
        });
        if (isValidInput && !hasDuplicates && !checkEachInputDuplicates) {
            $(this).closest(".input-container").find(".errormsg").text('');
        } else {
            var errorMsg = '';
            if (input_value === '') {
                errorMsg = "Please enter a value.";
            } else if (!isInRange) {
                errorMsg = "Value must be between " + startVal + " and " + endVal + ".";
            } else if (hasDuplicates) {
                errorMsg = "This Consign Number  already Used.";
            } else if (checkEachInputDuplicates) {
                errorMsg = "Value must be Unique";
            }
            $(this).closest(".input-container").find(".errormsg").text(errorMsg);
            $(this).val('');
        }
    });

    function getQuatation() {
        return true;
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
        let advance_pay = $("#advance_pay").val();
        let statical_charge = $("#statical_charge").val();
        let detention_loading = $("#detention_charge_loading").val();
        let detention_unloading = $("#detention_charge_unloading").val();
        let total_cgst = $("#total_cgst").val();
        let total_sgst = $("#total_sgst").val();
        let total_igst = $("#total_igst").val();
        let net_amount = 0;
        net_amount = parseFloat(total_quation_amount) + parseFloat(rto_fine) + parseFloat(advance_pay) + parseFloat(statical_charge) + parseFloat(detention_loading) + parseFloat(detention_unloading) + parseFloat(total_cgst) + parseFloat(total_sgst) + parseFloat(total_igst);
        $("#net_amount").val(net_amount.toFixed(2));
    })

    $(".broker_blance_payable").change(function(e) {
        let total_broker_amount = $("#total_broker_amount").val();
        if (total_broker_amount == NaN) {
            total_broker_amount = 0;
        }
        let advance_paid = $("#advance_paid").val();
        let mamul_charges = $("#mamul_charges").val();
        let balance_payable = 0;
        balance_payable = parseFloat(total_broker_amount) - (parseFloat(advance_paid) + parseFloat(mamul_charges));
        $("#balance_payable").val(balance_payable.toFixed(2));
        $("#net_balance_payable").val(balance_payable.toFixed(2));
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
    });
    $("#consignee_id").change(function(e) {
        console.log(e.target.value, 'target value');
        $.ajax({
            url: '<?= base_url('get-consigee-details') ?>',
            method: 'post',
            data: {
                'id': e.target.value,
            },
            success: function(data) {
                let result = JSON.parse(data);
                if (result.status == 1) {
                    let consignee = result.result;
                    $("#consignee_gst").html(consignee.gst_number);

                    $("#consignee_address").html(consignee.delivery_address);
                }
                console.log(result, 'responce');
            },
        });
    })

    $(document).on("change", ".consignorr_idn", function(){
        var val=$(this).val();
        console.log(val, 'target value consignorr_idn');
        var $selectedOption = $(this).find('option:selected');
    var $table = $selectedOption.closest('.table-address');
        $.ajax({
            url: '<?= base_url('get-consignor-details') ?>',
            method: 'post',
            data: {
                'id': val,
            },
            success: function(data) {
                let result = JSON.parse(data);
                if (result.status == 1) {
                    let consignee = result.result;
                 
                $table.find(".consignorr_gst").html(consignee.gst_number);
                $table.find(".consignorr_address").html(consignee.delivery_address);
                }
                console.log(result, 'responce');
            },
        });
    })


    $("#vehical_number").keyup(function(e) {
        let vehical_number = e.target.value;
        if (vehical_number.length >= 4) {
            $.ajax({
                url: '<?= base_url('get-vehical-details') ?>',
                method: 'post',
                data: {
                    'vehical_number': vehical_number,
                },
                success: function(data) {
                    let res = JSON.parse(data);
                    if (res.status == 1) {
                        let result = res.result;
                        console.log(result, 'result');
                        $("#vehical_id").val(result.id);
                        $("#vehical_Make").html(result.make);
                        $("#vehical_Modal").html(result.model_number);
                        $("#vehical_colour").html(result.color);
                        $("#vehical_chassis_no").html(result.chassis_number);
                        $("#vehical_engine_no").html(result.engine_number);
                        $("#vehical_tax_token").html(result.tax_token);
                        $("#vehical_road_permit_no").html(result.road_permmit);
                        $("#vehical_fitness_validity").html(result.fitness_validity);
                        $("#vehical_insured_from").html(result.insurance_by);
                        $("#vehical_date_of_insurance").html(result.insurance_date);
                        $("#vehical_insured_by").html(result.insurance_by);
                        $("#vehical_certificate").html(result.certificate);
                        $("#vehical_division_no").html(result.division_number);
                        $("#vehical_financers_name").html(result.financed_by);
                        $("#vehical_financers_address").html(result.make);

                        $("#driver_name").html(result.driver_name);
                        $("#driver_address").html(result.driver_address);
                        $("#vehical_owner_name").html(result.owner_name);
                        $("#vehical_address").html(result.owner_address);
                        $("#driving_license").html(result.driving_licence_no);
                        $("#license_validity").html(result.fitness_validity);
                        $("#driver_mobile").html(result.driver_mobile);
                        $("#owner_mobile").html(result.owner_mobile);

                    } else {
                        $("#vehical_id").val(0);
                        $("#vehical_Make").html(`<input type="text" name="vehical_Make" id="make" class="form-control" placeholder="Enter Make" style="text-transform:uppercase;border:0px;"  />`);
                        $("#vehical_Modal").html(`<input type="text" name="vehical_Modal" id="Modal" class="form-control" placeholder="Enter Modal No"  style="text-transform:uppercase;border:0px;" />`);
                        $("#vehical_colour").html(`<input type="text" name="vehical_colour" id="colour" class="form-control" placeholder="Enter Vehical Colour"  style="border:0px;" />`);
                        $("#vehical_chassis_no").html(`<input type="text" name="vehical_chassis_no" id="chassis_no" class="form-control" placeholder="Enter Chassis no"  style="text-transform:uppercase;border:0px;" />`);
                        $("#vehical_engine_no").html(`<input type="text" name="vehical_engine_no" id="engine_no" class="form-control" placeholder="Enter Engine no"  style="text-transform:uppercase;border:0px;" />`);
                        $("#vehical_tax_token").html(`<input type="text" name="vehical_tax_token" id="tax_token" class="form-control" placeholder="Enter Tax Toke"  style="text-transform:uppercase;border:0px;" />`);
                        $("#vehical_road_permit_no").html(`<input type="text" name="vehical_road_permit_no" id="road_permit_no" class="form-control" placeholder="Enter Road Permit Number"  style="text-transform:uppercase;border:0px;" />`);
                        $("#vehical_fitness_validity").html(`<input type="date" name="vehical_fitness_validity" id="fitness_validity" class="form-control"  style="border:0px;" />`);
                        $("#vehical_insured_from").html(`<input type="text" name="vehical_insured_from" id="insured_from" class="form-control" placeholder="Enter Insured from"  style="border:0px;" />`);
                        $("#vehical_date_of_insurance").html(`<input type="date" name="vehical_date_of_insurance" id="date_of_insurance" class="form-control" placeholder="Enter Date of Insurance"  style="border:0px;" />`);
                        $("#vehical_insured_by").html(`<input type="text" name="vehical_insured_by" id="insured_by" class="form-control" placeholder="Enter insured by"  style="border:0px;" />`);
                        $("#vehical_certificate").html(`<input type="text" name="vehical_certificate" id="certificate" class="form-control" placeholder="Enter Certificate No"  style="text-transform:uppercase;border:0px;" />`);
                        $("#vehical_division_no").html(`<input type="text" name="vehical_division_no" id="division_no" class="form-control" placeholder="Enter Division No"  style="text-transform:uppercase;border:0px;" />`);
                        $("#vehical_financers_name").html(`<input type="text" name="vehical_financers_name" id="financers_name" class="form-control" placeholder="Enter Financers Name"  style="border:0px;" />`);
                        $("#vehical_financers_address").html(`<input type="text" name="vehical_financers_address" id="financers_address" class="form-control" placeholder="Enter Financers Address"  style="border:0px;" />`);

                        $("#driver_name").html(`<input type="text" name="driver_name" id="drivername" class="form-control" placeholder="Enter Driver Name *" required style="text-transform:uppercase;border:0px;" />`);
                        $("#driver_address").html(`<input type="text" name="driver_address" id="driveraddress" class="form-control" placeholder="Enter Driver Address"  style="border:0px;" />`);
                        $("#vehical_owner_name").html(`<input type="text" name="vehical_owner_name" id="vehicalowner_name" class="form-control" placeholder="Enter Owner Name"  style="border:0px;" />`);
                        $("#vehical_address").html(`<input type="text" name="vehical_address" id="vehicaladdress" class="form-control" placeholder="Enter Owner Address"  style="border:0px;" />`);
                        $("#driving_license").html(`<input type="text" name="driving_license" id="drivinglicense" class="form-control" placeholder="Enter Driving License"  style="text-transform:uppercase;border:0px;" />`);
                        $("#license_validity").html(`<input type="date" name="license_validity" id="licensevalidity" class="form-control" placeholder="Enter License Validity"  style="border:0px;" />`);
                        $("#driver_mobile").html(`<input type="text" name="driver_mobile" id="drivermobile" class="form-control" placeholder="Enter Driver mobile *" required style="border:0px;" minlength="10" maxlength="10" />`);
                        $("#owner_mobile").html(`<input type="text" name="owner_mobile" id="ownermobile" class="form-control" placeholder="Enter Owner Mobile"  style="border:0px;" minlength="10" maxlength="10" />`);

                    }
                    console.log(res, 'res');
                },
            })

        }

    });

    $("#make").keyup(function() {
        let input_value = $("#make").val();
        console.log(input_value, 'make');
        $("#make").val(input_value.toUpperCase());
    })
</script>
<?= $this->endSection(); ?>