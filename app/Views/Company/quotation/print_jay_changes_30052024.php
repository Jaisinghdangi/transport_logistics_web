<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QUOTATION</title>
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
        /* background-color: #e68422;
        color: #fff !important; */
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
        /* color: #fff; */
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
        /* background-color: #00297a;
        color: #fff; */
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

    p,
    td,
    th {
        font-size: 12px !important;
        color:#000 !important
    }

    .below-right .row {
        justify-content: flex-end;
    }
    .conditions li p {margin-bottom:0px}
    table {border-collapse: collapse;box-sizing: border-box; width:100%; border:1px solid #000}
    td {padding:5px;}
    h5 {font-size:14px; margin-bottom:0px;}
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
                height: 97vh;
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
        setTimeout(function(){
            closePrintView(); 
        },5000);
    }
</script> 

<body onload="printInvoice()" >


    <div id="print-wrapper">
        <p class="text-right mb-1" onclick="printInvoice()">
            ORIGINAL FOR RECIPIENT
        </p>
        <table class="my-table">
            <tr>
                <td>
                    <h4 class="text-center mb-0 font-18">QUOTATION</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <img class="logo" src="<?= base_url('Assets/Images/logo.png') ?>" alt="logo" />
                </td>
            </tr>
            <tr>
                <td>
                    <table style="border:0px">
                    <tr>
                        <td>
                        <?php if($result->companies_details){
                       $companies_info= $result->companies_details;
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
                                    Website:<span><a href="<?= $companies_info->company_website ?>"><?= $companies_info->company_website ?></a></span>
                                </p>
                                <p>CIN : <?= $companies_info->cin_number ?></p>
                            </div>
                            <?php } ?>
                        </td>
                        <td style="width:40%">
                        <div class="side-detail">
                             <table style="border:0px">
                                <tr>
                                    <td class="text-right"><b>QUOTATION NO.</b></td>
                                    <td style="border:1px solid #000"><span class="invoice-no"><?= $result->quotation_number ?> </span></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>Date</b></td>
                                    <td style="border:1px solid #000"><span><?= $result->quotation_date ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b>PLACE OF SUPPLY</b></td>
                                    <td style="border:1px solid #000"><span><?= get_title('pincodes', ['id' => $result->delivery_address_id], 'StateName') ?> </span></td>
                                </tr>
                            </table>
                            </div>
                        </td>
                    </tr>
                    </table>
                </td>
            </tr>
          
            <tr>
                <td>
                    <table style="border: 0;">
                        <tr>
                            <td style="text-align:center; border:1px solid #000; width:48%;"><h5>Consignor Details</h5></td>
                            <td rowspan="2" style="width:4%;"></td>
                            <td style="text-align:center; border:1px solid #000;width:48%;"><h5>Delivery Address</h5></td>
                        </tr>
                        <tr>
                            <td style=" border:1px solid #000">
                            <?php if(!empty($result->consignee_details)){
                            $consinee_details=$result->consignee_details;  
                            // get_consinee_address_saprate
                            ?>
                                <p class="mb-0"><strong>Name:</strong> <?= $consinee_details->name ?></p> 
                                <p class="mb-0"><strong>Email:</strong> <?= $consinee_details->email ?></p>
                                <p class="mb-0"><strong>Mobile:</strong> <?= $consinee_details->mobile ?></p>
                                <?php } ?>
                                <?php $consignor_address_data= get_consinor_address_saprate($result->consignor); ?>
                                <p class="mb-0"><strong>Address:</strong> <?= $consignor_address_data['address1'] ?></p>
                                <p class="mb-0"><?= $consignor_address_data['address2'] ?></p>
                                <p class="mb-0"><?= $consignor_address_data['address3'] ?></p>
                            </td>
                            <td style=" border:1px solid #000; vertical-align:top;">
                                 <?php $consignee_address_data= get_consinor_address_saprate($consinee_details->id); ?>
                                <p class="mb-0 d-none"><strong>Name:</strong> <?= $consinee_details->name ?></p> 
                                <p class="mb-0"><strong>Address:</strong> <?= $consignee_address_data['address1'] ?></p>
                                <p class="mb-0"><?= $consignee_address_data['address2'] ?></p>
                                <p class="mb-0"><?= $consignee_address_data['address3'] ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        $dimension = $result->dimension;
                    ?>
                    <table>
                        <tr>
                            <td colspan="6"><h5>Product Dimention <i>(in feet)</i></h5></td>
                        </tr>
                        <tr>
                            <th colspan="2" style=" border:1px solid #000; text-align:center; width:20%;">S NO.</th>
                            <th style=" border:1px solid #000; text-align:center; width:15%;">Width</th>
                            <th style=" border:1px solid #000; text-align:center; width:15%;">Height</th>
                            <th style=" border:1px solid #000; text-align:center; width:15%;">Length</th>
                            <th style=" border:1px solid #000; text-align:center; width:15%;">Weight</th>
                            <th colspan="2" style=" border:1px solid #000; text-align:center; width:20%;">Amount</th>
                        </tr>
                        <?php  
$totalweight = 0;

$conversion_factors = [
    'Kg' => 1,               
    'Ton' => 1000,          
    'Metric Ton' => 1000      //
];

if (!empty($dimension)) {
    foreach ($dimension->width as $key => $value) {
        $weight_value = $dimension->weight[$key];
        $weight_unit = $dimension->weight_unit[$key];
        if (isset($conversion_factors[$weight_unit])) {
            $converted_weight = $weight_value * $conversion_factors[$weight_unit];
            $totalweight += $converted_weight;
        } else {
            // echo "Unknown unit: $weight_unit";
        }
?>
                                <tr>
                                    <td colspan="2" style=" border:1px solid #000; text-align:center;"><?= $key + 1; ?></td>
                                    <td style=" border:1px solid #000; text-align:center;"><?= $value ?></td>
                                    <td style=" border:1px solid #000; text-align:center;"><?= $dimension->height[$key] ?></td>
                                    <td style=" border:1px solid #000; text-align:center;"><?= $dimension->length[$key] ?></td>
                                    <td style=" border:1px solid #000; text-align:center;"><?= $dimension->weight[$key].' '. $dimension->weight_unit[$key]; ?></td>
                                    <td colspan="2" style=" border:1px solid #000; text-align:center;"></td>
                                </tr>
                        <?php }
                        } ?>
                        <tr>
                            <td colspan="5" style="border:1px solid #000; width:12%;  text-align:right"><b>Total</b></td>
                            <td style="border:1px solid #000;width:8%; text-align:center"><?= $totalweight ?> Kg</td>
                            <td colspan="2" style="border:1px solid #000;width:10%; text-align:center"><?= number_format($result->amount) ?></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border:1px solid #000;"><b>TOTAL</b></td>
                            <td style="border:1px solid #000;"><?= number_format($result->amount) ?></td>
                        </tr> -->
                        <tr>
                            <td colspan="8">
                                <b>Remark</b> : <?= $result->remark ?></br>
                                <b>Payable (Amount in Words):</b> <?= $result->amount_in_word ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="border:1px solid #000; text-align:right">
                            <p class="mt-0 mb-5">For   <?php if($result->companies_details){
                                $companies_info= $result->companies_details;
                                echo ucfirst(strtolower($companies_info->company_name));
                                            }
                                    ?></p>
                                <p class="mb-2">Authorised Signatory</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="bg-color mb-0"><b>Terms and Conditions:</b></p>
                    <ul class="text-left conditions mb-0">
                        <li><?=(isset($terms->description)) ? $terms->description : '' ;?></li>
                    </ul>
                </td>
            </tr>
        </table>

        
        
    </div>
</body> 
<script> 
    function closePrintView() {
        document.location.href = "<?= base_url('company/quotation') ?>";
    }
</script>
</html>