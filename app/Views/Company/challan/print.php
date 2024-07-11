<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Challan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </head>
  <style>
    @font-face {
      font-family: Orbitron-Bold_iq;
      src: url("fonts/Orbitron-Bold_iq.woff") format("woff");
    }

    .logo {
      width: 200px;
    }
    td,th, h5, h6 {color:#000;}

    .container-front {
      border: 1px solid #000;
    }

    h6 {
      font-family: Orbitron-Bold_iq;
      /* color: #25a5ca; */
      font-size: 18px;
      margin-bottom: 0;
      /* text-shadow: 2px 2px 4px #888; */
      -webkit-text-stroke: thin;
    }
    .logo-text {
      color: #012160 !important;
    }
    
    .company-details p {
      color: #000;
      font-weight: 600;
      font-size: 10px;
    }
    .company-details p span {
      font-weight: 400;
    }

    .first-box p {
      border: 1px solid #000;
      margin: 0;
      width: 130px;
      font-weight: bold;
      font-size: 10px;
    }

    .first-box p.first-heading,
    .bg-grey {
      background-color: #bfbfbf !important;
    }
    .first-box p.second-heading,
    .bg-blue {
      background-color: #f1f3ff !important;
    }

    .bg-black-dark {
      background-color: #404040;
      color: #fff;
    }

    .text-bold {
      font-weight: bold;
    }

    .font-500 {
      font-weight: 500 !important;
    }

    .border-box {
      border: 1px solid #000;
    }

    .text-center {
      text-align: center;
    }
    table td {
      border: 1px solid #000;
    }
    .width-200px {
      width: 200px;
    }
    .width-50px {
      width: 50px;
    }

    table {
      margin-bottom: 0.2rem !important;
    }

    .mt-small {
      margin-top: 0.2rem !important;
    }
    .third-box table td,
    .fourth-box table td,
    .fifth-box table td {
      font-size: 8px;
      padding: 1px 3px;
      vertical-align: middle;
      font-weight: bold;
      color: #000;
    }

    .width-130px {
      width: 130px;
    }
    .fifth-box ul li {
      list-style: decimal;
      font-weight: normal;
    }

    .underline {
      text-decoration: underline;
    }
    .font-normal {
      font-weight: normal !important;
    }

    table input {
      vertical-align: middle;
    }

    .text-justify {
      text-align: justify;
    }

    .second-box p {
      font-size: 10px;
    }
    .oneline {
      white-space: nowrap;
    }

    .fourth-box .bg-blue {
      font-weight: normal !important;
      padding: 5px 10px !important;
      color:5px;
    }

    .text-right {
      text-align: right;
    }

    .justify-space-between {
      justify-content: space-between;
    }

    .text-bold{
        font-weight: bold !important;
    }

    table {border-collapse: collapse;box-sizing: border-box; width:100%; border:1px solid #000}
    td {padding:5px;}

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
                height: 98vh;
                table-layout: fixed;
              }
  
      }
        
body{
  -webkit-print-color-adjust:exact !important;
  print-color-adjust:exact !important;
}
.no-border td {border:0px}
td {font-size: 12px; padding:0 5px}
  </style>
  
  <script>
    function printInvoice() {
       // window.print();
        setTimeout(function(){
          returnRedirect(); 
        },5000);
    }
    function returnRedirect() {
   // window.location.replace("<?= base_url('company/challan') ?>");
  }
</script>


  <body onload="printInvoice()"> 
    <div class="container-front" id="print-wrapper">
      <table class="my-table">
        <tr>
          <td style="border:0px">
            <table class="no-border" style="border:0px">
              <tr>
                <td><img class="logo" src="<?= base_url('Assets/Images/logo.png') ?>" alt="logo" /></td>
                <td class="company-details text-center">
                  <?php if ($companies_details) {
                    $companies_info = $companies_details;
                  ?>

                    <h6 class="text-bold"><?= $companies_info->company_name ?></h6>
                    <p class="mb-0 logo-text text-bold">(An <?= $companies_info->iso_number ?> Certified Company)</p>
                    <p class="mb-0 logo-text text-bold">
                      Registered Office:
                      <span
                        ># <?= $companies_info->address_1 ?>, PAN <?= $companies_info->pan_number ?>,
                          <?= $companies_info->district_name ?>, <?= $companies_info->state_name ?>-<?= $companies_info->pin_code ?>,<?= $companies_info->country_name ?></span
                      >
                    </p>
                    <p class="mb-0 logo-text text-bold">
                      Contact:
                      <a href="tel: +91-<?= $companies_info->company_mobile ?>"> <span>+91-<?= $companies_info->company_mobile ?></span></a>
                      &nbsp; Email:
                      <a href="mailto: <?= $companies_info->company_email ?>"> <span><?= $companies_info->company_email ?></span></a>
                      &nbsp; Website:
                      <a href="<?= $companies_info->company_website ?>"> <span><?= $companies_info->company_website ?></span></a>
                    </p>
                    <p class="text-stroke logo-text text-bold">(CIN: <?= $companies_info->cin_number ?>)</p>

                  <?php } ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="border:0px; padding-top:5px;padding-bottom:5px">
            <table style="border:0px">
              <tr>
                <td class="first-heading" style="width:20%; background-color:#bfbfbf"><b>Challan No.</b></td>
                <td style="width:20%"><b><?= $booking->challan_number ?></b></td>
                <td style="border:0px"></td>
              </tr>
              <tr>
                <td class="first-heading;" style=" background-color:#bfbfbf"><b>Date</b></td>
                <td><b><?= $booking->challan_date ?></b></td>
                <td style="border:0px"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td style="border:0px;padding-top:5px;padding-bottom:5px">
            <table>
              <tr>
                <td class="first-heading" style="width:10%; background-color:#404040; color:#fff"><b>From:</b></td>
                <td style="width:40%"><?= $result ? strtoupper($result->state_name) : ''; ?></td>
                <td style="width:10%;background-color:#404040;color:#fff">To:</td>
                <td style="width:40%"><?= $consignee_details ? strtoupper($consignee_details->District) : ''; ?></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="third-box" style="border:0px; padding-top:5px;padding-bottom:5px">
          <table class="table">
            <tr>
              <td class="bg-grey font-500 text-center" colspan="6">
                VEHICLES/LORRY DETAILS
              </td>
            </tr>
            <tr>
              <td class="width-130px">VEHICLE NO</td>
              <td class="bg-blue width-200px">&nbsp;<?= $booking?$booking->vehical_number:''; ?></td>
              <td class="width-130px">FITNESS VALIDITY</td>
              <td class="bg-blue" colspan="3">&nbsp;<?= $vehicles?dispalyDate($vehicles->fitness_validity):''; ?></td>
            </tr>
            <tr>
              <td class="width-130px">MAKE</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?$vehicles->make:''; ?></td>
              <td class="width-130px">INSURED FROM</td>
              <td class="bg-blue" colspan="3">&nbsp;<?= $vehicles?$vehicles->insurance_by:''; ?></td>
            </tr>
            <tr>
              <td class="width-130px">MODEL</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?$vehicles->model_number:''; ?></td>
              <td class="width-130px">DATE OF INSURANCE</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?dispalyDate($vehicles->insurance_date):''; ?></td>
              <td class="width-50px text-center">VALIDITY</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?dispalyDate($vehicles->licence_validity):''; ?></td>
            </tr>
            <tr>
              <td class="width-130px">COLOUR</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?$vehicles->color:''; ?></td>
              <td class="width-130px">INSURED BY</td>
              <td class="bg-blue" colspan="3">&nbsp;<?= $vehicles?$vehicles->insurance_by:''; ?></td>
            </tr>
            <tr>
              <td class="width-130px">REGISTERED AT</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?dispalyDate($vehicles->registered_date):''; ?></td>
              <td class="width-130px">CERTIFICATE</td>
              <td class="bg-blue" colspan="3">&nbsp;<?= $vehicles?$vehicles->certificate:''; ?></td>
            </tr>
            <tr>
              <td class="width-130px">CHASSIS NO</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?$vehicles->chassis_number:''; ?></td>
              <td class="width-130px">DIVISION NO.</td>
              <td class="bg-blue" colspan="3">&nbsp;<?= $vehicles?$vehicles->division_number:''; ?></td>
            </tr>
            <tr>
              <td class="width-130px">ENGINE NO.</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?$vehicles->engine_number:''; ?></td>
              <td rowspan="3">FINANCER'S NAME & ADDRESS:</td>
              <td class="bg-blue" colspan="3">&nbsp;<?= $vehicles?$vehicles->financed_by:''; ?></td>
            </tr>
            <tr>
              <td class="width-130px">TAX TOKEN NO</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?$vehicles->tax_token:''; ?></td>
              <td class="bg-blue" colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td class="width-130px">ROAD PERMIT NO</td>
              <td class="bg-blue width-200px">&nbsp;<?= $vehicles?$vehicles->road_permmit:''; ?></td>
              <td class="bg-blue" colspan="3">&nbsp;</td>
            </tr>
          </table>    
         </td>
        </tr>
        <tr>
          <td class="fourth-box" style="border:0px; padding-top:5px;padding-bottom:5px">
          <table class="table text-center">
            <tr>
              <td class="bg-grey width-50px">Sl. No</td>
              <td class="bg-grey width-50px">Billty No.</td>
              <td class="bg-grey width-50px">No. of Packages</td>
              <td class="bg-grey width-130px">Contents</td>
              <td class="bg-grey width-50px">Weights</td>
              <td class="bg-grey width-130px">From</td>
              <td class="bg-grey width-130px">To</td>
            </tr>
           <?php foreach($booking_consignment_number as $key=>$value){ ?>
            <tr>
              <td class="bg-blue"><?= ++$key ?></td>
              <td class="bg-blue"><?= $value->consignment_number ?></td>
              <td class="bg-blue">1</td>
              <td class="bg-blue"><?= $value->service_description ?></td>
              <td class="bg-blue"></td>
              <td class="bg-blue"><?= $result ? strtoupper($result->state_name) : ''; ?></td>
              <td class="bg-blue"><?= $consignee_details ? strtoupper($consignee_details->District) : ''; ?></td>
            </tr>
            <?php } ?>
          
          </table>
          </td>
        </tr>
        <tr>
          <td class="fifth-box" style="border:0px; padding-top:5px;padding-bottom:5px">
          <table class="table">
            <tr>
              <td colspan="6">
                <div>
                  <p class="mb-0 px-3 underline">Note:</p>
                  <ul class="my-1">
                    <li>
                      Transit time…………………………………………..days excluding loading date.
                      Penalty @...............per day.
                    </li>
                    <li>
                      Sign acknowledgement to be submitted within 10 days after
                      unloading of the goods, otherwise penalty Rs. 200 per day
                      will be levied.
                    </li>
                    <li>
                      No. amount payable if sign acknowledgement submitted after
                      30 days from unloading date
                    </li>
                  </ul>
                </div>
              </td>
            </tr>

            <tr>
              <td class="width-130px">Loaded by</td>
              <td colspan="2" class="bg-blue"  style="width: 20%;"></td>
              <td colspan="1" class="width-130px oneline" style="width: 25%;">
                Dispatching In charge's Signature
              </td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td class="width-130px">Loading Remark:</td>
              <td colspan="2" class="bg-blue oneline width-130px"  style="width: 20%;"></td>
              <td  class="bg-blue oneline width-130px text-center"  style="width:25%;"><b>Broker Bank Detail</b></td>

              <td class="width-130px">Particulars</td>
              <td class="width-130px">(Amount in Rs)</td>
            </tr>
            
            <tr>
              <td rowspan="3">Broker's Name & Address</td>
              <td colspan="2" class="bg-blue" style="width: 20%;"><?= $brokers?$brokers->name:''; ?></td>
              <td class="bg-blue" style="width: 25%;">Account Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php if(isset($brokers)){ if($brokers->ac_type == 1){
                                             echo 'Saving A/c';  
                                            }else if($brokers->ac_type == 2){
                                                echo   'Current A/c';
                                             }else if($brokers->ac_type == 3){
                                                echo 'Credit A/c';
                                             }else{
                                                echo '';
                                             }} ?></td>
              
              <td class="font-500">Lorry Hire Charges:</td>
              <td class="bg-blue"><?= $booking_broker?$booking_broker->lorry_hire_charge:'0'; ?></td>
            </tr>
            
            <tr>
              <td colspan="2" class="bg-blue"  style="width: 20%;"><?= $brokers?$brokers->address_1:''; ?></td>
              <td class="bg-blue" style="width:25%;">Account Number &nbsp;: <?= $brokers?$brokers->ac_number:''; ?></td>

              <td class="font-500">
                <div class="d-flex justify-space-between">
                  <div>RTO Fine, if any</div>
                  <div>[+]</div>
                </div>
              </td>
              <td class="bg-blue"><?= $booking_broker?$booking_broker->rto_fine:'0'; ?></td>
            </tr>
            <tr>
              <td colspan="2" class="bg-blue"  style="width: 20%;"><?= $brokers?$brokers->mobile:''; ?></td>
              <td class="bg-blue" style="width:25%;">IFSC Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $brokers?$brokers->ifsc_code:''; ?></td>

              <td class="font-500">
                <div class="d-flex justify-space-between">
                  <div>Detention Charges, if any</div>
                  <div>[+]</div>
                </div>
              </td>
              <td class="bg-blue"><?= $booking_broker?$booking_broker->detention_charge:'0'; ?></td>
            </tr>
            <tr>
              <td>Loading Advice No.:</td>
              <td colspan="2" class="bg-blue"  style="width: 20%;"></td>
              <td class="bg-blue" style="width:25%;">Bank Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $brokers?$brokers->bank_name:''; ?></td>

              <td class="font-500" >
               <div class="d-flex justify-space-between">
                  <div>Late delivery Charges , if any:</div>
                  <div>[-]</div>
                </div>
              </td>
              <td class="bg-blue"><?= $booking_broker?$booking_broker->late_delivery_charge:'0'; ?></td>
            </tr>
            <tr>
              <td rowspan="3">Driver's Name & Address</td>
              <td colspan="3" class="bg-blue"><?= $booking?$booking->driver_name:''; ?></td>
              <td class="font-500">
                <div class="d-flex justify-space-between">
                  <div>Other Deduction Charges:</div>
                  <div>[+]</div>
                </div>
              </td>
              <td class="bg-blue"><?= $booking_broker?$booking_broker->other_deduction_charges:'0'; ?></td>
            </tr>
            <tr>
              <td colspan="3" class="bg-blue"><?= $booking?$booking->driver_address:''; ?></td>
              <td  > Total Lorry Hire Cost
                
              </td>
              <td class="bg-blue"><?php if(isset($booking_broker)){   $total_lorry_hire_charge=($booking_broker->lorry_hire_charge+$booking_broker->rto_fine+$booking_broker->detention_charge+$booking_broker->other_deduction_charges)-($booking_broker->late_delivery_charge);
              echo $total_lorry_hire_charge;
              
              }?></td>
            </tr>
            <tr>
              <td colspan="3" class="bg-blue"><?= $booking?$booking->driver_mobile:''; ?></td>
              <td class="font-500" >
                 
                  <div class="d-flex justify-space-between">
                  <div>Advance Paid:</div>
                  <div>[-]</div>
                </div>
              </td>
              <td class="bg-blue"><?= $booking_broker?$booking_broker->advance_paid:'0'; ?></td>
            </tr>
            <tr>
              <td>Driving License No.:</td>
              <td class="bg-blue width-130px"><?= $booking?$booking->driving_licence_no:''; ?></td>
              <td class="width-50px text-center">Validity</td>
              <td class="bg-blue"><?= $booking?dispalyDate($booking->driving_validity):''; ?></td>
              <td  >Balance Payabe: 
              </td>
              <td class="bg-blue"><?= $booking_broker?$booking_broker->balance_payabe:'0'; ?></td>
            </tr>
            <tr>
              <td rowspan="3">Owner's Name & Address</td>
              <td colspan="3" class="bg-blue"><?= $booking?$booking->owner_name:''; ?></td>
              <td class="font-500">
                
              </td>
              <td class="bg-blue"> </td>
            </tr>
            <tr>
              <td colspan="3" class="bg-blue"><?= $booking?$booking->owner_address:''; ?></td>
              <td></td>
              <td class="bg-blue"></td>
            </tr>
            <tr>
              <td colspan="3" class="bg-blue"><?= $booking?$booking->owner_mobile:''; ?></td>
              <td colspan="2">
                <i> Unloading Remark, if any, see over leaf</i>
              </td>
            </tr>
            <tr>
              <td colspan="6" class="text-justify">
                I…………………………………………………………………..Driver/Owner of above mentioned
                vehicle, do hereby confirm having received in proper condition,
                the goods detailed in above noted Lorry Challan for safe
                carriage to delivery destination at my risk and liability at the
                hire rate detailed and calculated above. I agree and undertake
                that (a) goods will be loaded and delivered as per loading
                /unloading office's instructions; (b) no other
                good(s)/material(s) will be loaded into vehicle with Customer’s
                consignments, and if found, balance payment will not be made;
                and (c) no unloading will be done on Sunday /Holiday
              </td>
            </tr>
            <tr>
              <td colspan="3">
                Driver/Owner's Photo Taken: Yes <input type="checkbox" /> &nbsp;
                No <input type="checkbox" />
              </td>
              <td colspan="3" class="pt-5 text-right">
                Left Thumb Impression and Signature of Driver/Owner
              </td>
            </tr>
          </table>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
