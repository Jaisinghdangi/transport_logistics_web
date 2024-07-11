<?= $this->extend('Company/layout') ?>
<?= $this->section('content') ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script src="https://code.highcharts.com/modules/data.js"></script>
<style>
   .highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    
    max-width: 660px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
.highcharts-button-box{
    display: none !important;
}
.highcharts-button-symbol{
    display: none !important;

}
.highcharts-credits{
    display: none !important;

}
.highcharts-legend, .highcharts-no-tooltip{
    display: none !important;

}
.highcharts-container {
    width: 100% !important;
    height: 365px !important;
}


#container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.textsize tr th{
    font-size: 13px !important;
}
/* ///////////////////// */

#container {
    height:290px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#datatable {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

#datatable caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

#datatable th {
    font-weight: 600;
    padding: 0.5em;
}

#datatable td,
#datatable th,
#datatable caption {
    padding: 0.5em;
}

#datatable thead tr,
#datatable tr:nth-child(even) {
    background: #f8f8f8;
}

#datatable tr:hover {
    background: #f1f7ff;
}

.secondfigure{
    margin-left: -3px;
    min-width: 280px !important;
}
#datatable {
            display: none;
        }

.small-box {
    margin-bottom: 10px;
}
</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
        <?= $this->include('Includes/Message'); ?>
            <div class="row">
       <div class="col-lg-5 col-6">
                    <div class="small-box text-bg-lite text-center">
                    <!-- Sales & Purchase -->
                        <div class="inner">
                        <!-- <figure class="highcharts-figure">
            <div id="container1"></div>
    
                 </figure> -->

                 <figure class="highcharts-figure">
    <div id="container1"></div>
    <?php 
// Connect to the database
$db = \Config\Database::connect();
  $currentFY = getFinancialYear(session()->get('FinancialYear'));
$to_date = date('Y-m-d');
$totalBookingRows = $db->table('bookings')->countAllResults();
$approvedQuatation = $db->table('quotation')->where('is_approved','1')->countAllResults();
$allQuatation = $db->table('quotation')->countAllResults();


$where['is_delete'] = 0;
$where['comp_id'] =session()->get('CompId');
$where['is_orderReached'] = 1; 
$where['is_billing']='NO';

// $unBilledBooking = $db->table('bookings')->where($where)->countAllResults();

$unBilledBooking = $db->table('bookings')->where($where)->get()->getResult();
// $unBilledCount =count($unBilledBooking);
$unBilledBookingAmt = 0;

foreach ($unBilledBooking as $unbilled ) {
    $unBilledBookingAmt += $unbilled->booking_amount;
}
// Fetch and aggregate monthly invoice amounts from the bookings table
$invoiceQuery = $db->table('bookings')
    ->select("SUM(booking_amount) as total_amount, DATE_FORMAT(date, '%Y-%m') as month")
    ->where(['date >=' => $currentFY, 'date <=' => $to_date, 'comp_id' => session()->get('CompId'), 'is_billing' => 'YES'])
    ->groupBy("DATE_FORMAT(date, '%Y-%m')")
    ->get();
$invoiceData = $invoiceQuery->getResultArray(); // Use getResultArray() for easier array handling

// Fetch and aggregate monthly challan data from the bookings table and calculate total balance payable from bookings_brokers table
$challanQuery = $db->table('bookings')
    ->select("DATE_FORMAT(bookings.date, '%Y-%m') as month, SUM(bookings_brokers.balance_payabe) as total_balance_payable,SUM(advance_payable) as advance_payable")
    ->join('bookings_brokers', 'bookings.id = bookings_brokers.booking_id', 'left')
    ->where(['bookings.date >=' => $currentFY, 'bookings.date <=' => $to_date, 'bookings.comp_id' => session()->get('CompId')])
    ->groupBy("DATE_FORMAT(bookings.date, '%Y-%m')")
    ->get();
$challanData = $challanQuery->getResultArray(); // Use getResultArray() for easier array handling
////
$bookingQuery = $db->table('bookings')
    ->select("SUM(booking_amount) as booking_amount")
    ->where(['bookings.date >=' => $currentFY, 'bookings.date <=' => $to_date, 'bookings.comp_id' => session()->get('CompId')])
    ->get();
$bookingTotal = $bookingQuery->getResult();
// echo $bookingTotal[0]['booking_amount'];

$totalBookingAmt =0;
foreach ($bookingTotal  as $bookingamt ) {
    $totalBookingAmt += $bookingamt->booking_amount;
}
// echo  $totalBookingAmt;
////
// Prepare combined data for the table
$combinedData = [];
foreach ($invoiceData as $invoice) {
    $combinedData[$invoice['month']]['invoice'] = $invoice['total_amount'];
}
$totaladvance_payable=0;
foreach ($challanData as $challan) {
    $combinedData[$challan['month']]['challan'] = $challan['total_balance_payable'];
    $totaladvance_payable += $challan['advance_payable'];
}

// Fill missing months in combinedData
$months = array_unique(array_merge(array_keys($combinedData), array_column($invoiceData, 'month'), array_column($challanData, 'month')));
foreach ($months as $month) {
    if (!isset($combinedData[$month])) {
        $combinedData[$month] = ['invoice' => 0, 'challan' => 0];
    } else {
        if (!isset($combinedData[$month]['invoice'])) {
            $combinedData[$month]['invoice'] = 0;
        }
        if (!isset($combinedData[$month]['challan'])) {
            $combinedData[$month]['challan'] = 0;
        }
    }
}

// Sort combined data by month
ksort($combinedData);

// Function to convert 'Y-m' format to 'F' (full month name)
function formatMonth($month) {
    $date = DateTime::createFromFormat('Y-m', $month);
    return $date->format('F');
}
///////////////////

$compId = session()->get('CompId');

$where = [
    'is_delete' => 0,
    'comp_id' => $compId,
];

$invoices = $db->table('invoice')->where($where)->orderBy('id', 'DESC')->get()->getResult();
$customer_totals = [];

if (!empty($invoices)) {
    foreach ($invoices as $invoice) {
        $arrinvoice_number = get_title_full('multi_invoice_number', ['booking_id' => $invoice->booking_id], 'invoice_number');
        if (!empty($arrinvoice_number)) {
            foreach ($arrinvoice_number as $key1 => $value1) {
                $customer_id = ($invoice->booking_type == 'Paid')
                    ? get_title_full('multiple_booking_vehical', ['booking_id' => $invoice->booking_id], 'consignor_id')[$key1]->consignor_id
                    : get_title_full('multiple_booking_vehical', ['booking_id' => $invoice->booking_id], 'consignee_id')[$key1]->consignee_id;

                $customer_name = ($invoice->booking_type == 'Paid')
                    ? getConsinorName($customer_id)
                    : getConsineeName($customer_id);

                if (empty($customer_name)) {
                    continue; // Skip if customer name is blank
                }

                if (!isset($customer_totals[$customer_id])) {
                    $customer_totals[$customer_id] = [
                        'name' => $customer_name,
                        'total_amount' => 0,
                    ];
                }

                $total_amount = get_title_full('split_bill', ['booking_id' => $invoice->booking_id], 'booking_amt')
                    ? get_title_full('split_bill', ['booking_id' => $invoice->booking_id], 'booking_amt')[$key1]->booking_amt
                    : $invoice->total_amount;

                $customer_totals[$customer_id]['total_amount'] += $total_amount;
            }
        } else {
            $customer_id = $invoice->billing_customer_id;

            $customer_name = ($invoice->booking_type == 'Paid')
                ? getConsinorName($customer_id)
                : getConsineeName($customer_id);

            if (empty($customer_name)) {
                continue; // Skip if customer name is blank
            }

            if (!isset($customer_totals[$customer_id])) {
                $customer_totals[$customer_id] = [
                    'name' => $customer_name,
                    'total_amount' => 0,
                ];
            }

            $total_amount = $invoice->total_amount;
            $customer_totals[$customer_id]['total_amount'] += $total_amount;
        }
    }
}

// Sort customers by total amount in descending order
usort($customer_totals, function ($a, $b) {
    return $b['total_amount'] <=> $a['total_amount'];
});

// Get the top 10 customers
$top_customers = array_slice($customer_totals, 0, 12);

$rows = [];
$sno = 0;

foreach ($top_customers as $customer) {
    $sno++;
    $rows[] = '<tr class="align-middle" style="line-height: 1;">
        <td>' . $sno . '</td>
        <td>' . htmlspecialchars($customer['name']) . '</td>
        <td style="text-align: right;">' . indian_rupee($customer['total_amount']) . '</td>
    </tr>';
}

if (empty($rows)) {
    $table = '<span class="text-danger text-center">No Record found.</span>';
} else {
    $table = '<table class="table table-bordered" style="font-size:12px;">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Customer Name</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>' . implode('', $rows) . '</tbody>
    </table>';
}

// echo $table;


// echo $table;



/////////////////////
$bookings = $db->table('bookings')->where($where)->where(['is_vehicalPlaced'=>'1','is_orderReached'=>'1'])->orderBy('id', 'DESC')->limit(20)->get()->getResult();
// echo count($bookings);
?>

<table id="datatable">
    <thead>
        <tr>
            <th></th>
            <th>Sale</th>
            <th>Purchase</th>
        </tr>
    </thead>
    <tbody>
        <?php  $tatalSale =0; foreach ($combinedData as $month => $data): 
            
            $tatalSale += $data['invoice'];
            ?>
            <tr>
                <th><?php echo formatMonth($month); ?></th>
                <td><?php echo $data['invoice']; ?></td>
                <td><?php echo $data['challan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

   
</figure>
                           </div>
                    </div>
                </div>

                <div class="col-lg-2 col-6 text-center" style="width:;">
                    <div class="small-box text-bg-danger">
                        <div class="inner" style="padding:0px !important;">
                            <p style="margin-bottom: 0px;">Total Booking Amount</p>
                           <span style="font-size:25px;"> <?= ($totalBookingAmt) ?  $totalBookingAmt  : 0 ;?> </span>
                        </div>
                    </div>
                    <div class="small-box text-bg-primary">
                        <div class="inner" style="padding:0px !important;">
                            <p style="margin-bottom: 0px;">Advance Pending</p>
            <span style="font-size:25px;"> <?= ($totaladvance_payable) ? $totaladvance_payable : 0 ;?> </span>
                        </div>
                    </div>
                    <div class="small-box text-bg-secondary">
                        <div class="inner" style="padding:0px !important;">
                            <p style="font-size: 91%; margin-bottom: 0px;">Quoation Approved</p>
                            <span style="font-size:25px;"> <?= ($approvedQuatation) ? $approvedQuatation : 0 ;?></span>
                        </div>
                    </div>
                    <div class="small-box text-bg-info">
                        <div class="inner" style="padding:0px !important;">
                            <p style="margin-bottom: 0px;">Quotation Sent</p>
                            
                            <span style="font-size:25px;"> <?=($allQuatation) ? $allQuatation : 0 ;?></span>

                        </div>
                    </div>
                    <div class="small-box text-bg-danger">
                        <div class="inner" style="padding:0px !important;">
                            <p style="margin-bottom:0px;">Unbilled Consginment Amount</p>
                           
                            <span style="font-size:25px;"> <?=($unBilledBookingAmt) ?  $unBilledBookingAmt : 0;?></span>

                        </div>
                    </div>
                    <div class="small-box text-bg-danger">
                        <div class="inner" style="padding:0px !important;">
                            <p style="margin-bottom:0px;">Total Sale</p>
                           
                            <span style="font-size:25px;"> <?=($tatalSale ) ?  $tatalSale  : 0;?></span>

                        </div>
                    </div>
                </div>
                

                <div class="col-lg-5 col-6 text-center">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <p>Account's Summary</p>
                        </div>
                    </div>
                    <div class="small-box text-bg-white">
                    <div class="inner">

                        <figure class="highcharts-figure secondfigure">
                  <div id="container"></div>
                       </figure>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6 col text-center">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <p>Sales Outstanding</p>
                        </div>
                       
                    </div>
                    <div class="small-box text-bg-lite text-start">
                        <div class="inner">
                        <table class="table table-border table-sm" border="1">
                            <tr>
                              <td>April</td>
                            </tr>
                            <tr>
                            <td>May</td>

                            </tr> 
                            <tr>
                            <td>June</td>


                            </tr> 
                            <tr>
                            <td>July</td>


                            </tr> 
                            <tr>
                            <td>August</td>


                            </tr> 
                            <tr>
                            <td>September</td>


                            </tr>
                            <tr>
                            <td>October</td>


                            </tr>
                            <tr>
                            <td>November</td>


                            </tr>
                            <tr>
                            <td>December</td>


                            </tr>
                            <tr>
                            <td>January</td>


                            </tr>
                            <tr>
                            <td>February</td>


                            </tr>
                            <tr>
                            <td>March</td>


                            </tr>

                           </table>
                        </div>
                       
                    </div>
                </div>

                <div class="col-lg-3 col-6 col text-center">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <p>Total Balance Outstanding</p>
                        </div>
                       
                    </div>
                    <div class="small-box text-bg-lite text-start">
                        <div class="inner">
                        <table class="table table-border table-sm" border="1">
                            <tr>
                              <td>April</td>
                            </tr>
                            <tr>
                            <td>May</td>

                            </tr> 
                            <tr>
                            <td>June</td>


                            </tr> 
                            <tr>
                            <td>July</td>


                            </tr> 
                            <tr>
                            <td>August</td>


                            </tr> 
                            <tr>
                            <td>September</td>


                            </tr>
                            <tr>
                            <td>October</td>


                            </tr>
                            <tr>
                            <td>November</td>


                            </tr>
                            <tr>
                            <td>December</td>


                            </tr>
                            <tr>
                            <td>January</td>


                            </tr>
                            <tr>
                            <td>February</td>


                            </tr>
                            <tr>
                            <td>March</td>


                            </tr>

                           </table>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-6 col text-center">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <p>Total Sales</p>
                        </div>
                       
                    </div>
                    <div class="small-box text-bg-lite">
                        <div class="inner">
             <?= $table;?>
                        <table class="table table-border table-sm d-none" border="1">
                            <tr>
                              <td>Top 10 Customers</td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>

                            </tr> 
                            <tr>
                            <td>&nbsp;</td>


                            </tr> 
                            <tr>
                            <td>&nbsp;</td>


                            </tr> 
                            <tr>
                            <td>&nbsp;</td>


                            </tr> 
                            <tr>
                            <td>&nbsp;</td>


                            </tr>
                            <tr>
                            <td>&nbsp;</td>


                            </tr>
                            <tr>
                            <td>&nbsp;</td>


                            </tr>
                            <tr>
                            <td>&nbsp;</td>


                            </tr>
                           </table>
                        </div>
                       
                    </div>
                </div>

                
                <div class="col-lg-3 col-6 col text-center d-none">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <p>Previous Invoice</p>
                        </div>
                       
                    </div>
                    <div class="small-box text-bg-lite text-start">
                        <div class="inner">
                        <table class="table table-border table-sm">
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            </tr> 
                            <tr>
                            <td>&nbsp;</td>
                            </tr> 
                            <tr>
                            <td>&nbsp;</td>
                            </tr> 
                            <tr>
                            <td>&nbsp;</td>
                            </tr> 
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            </tr>
                            
                            

                           </table>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-6 col text-center">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <p>Assignment Details</p>
                        </div>
                       
                    </div>
                    <div class="small-box text-center">
                        <div class="inner">
                        <table class="table table-bordered table-sm textsize">
                        <tr>

                                <td style="width: 2%;">Upcoming</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            <tr>
                                <td style="width: 2%;">&nbsp;</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            
                         
                            <tr>
                                <td style="width: 2%;">Ongoing</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            <tr>
                                <td style="width: 2%;">&nbsp;</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            <tr>
                                <td style="width: 2%;">Completed</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            <tr>
                                <td style="width: 2%;">&nbsp;</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            <tr>
                                <td style="width: 2%;">In time</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            <tr>
                                <td style="width: 2%;">&nbsp;</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                            <tr>
                                <td style="width: 2%;">Delay</td>
                                <td>&nbsp;</td>
                                
                                <td>&nbsp;</td>
                            </tr> 
                           
                
                           </table>
                        </div>
                       
                    </div>
                </div>

               
       </div>

       <div class="row">
      
      
                <div class="col-lg-12 col-6 text-center">
                    <div class="small-box text-bg-secondary">
                        <div class="inner">
                            <p>Tracking Status of Last 20 Vehciles</p>
                        </div>
                       
                    </div>
                    <div class="small-box text-center">
                        <div class="inner">
                        <table class="table table-bordered table-sm textsize">
                            <tr>
                            <th>Dispatch Date</th>
                            <th>Consg Note#</th>
                            <th>Vehicle#</th>
                           <th>Conignor</th>
                           <th>From</th>
                            <th>To</th>
                            <th>Eway Bill Validity </th>
                            <th>Eway Bill Number</th>
                            <th>Delivery Date</th>
                                  </tr>
                                  <?php
if (isset($bookings) && count($bookings) > 0) {
    // Initialize an array to store all consignment numbers
    $all_consignment_numbers = [];

    foreach ($bookings as $consign_key => $consign_value) {
        $vehical_attateched = "";
        if ($consign_value->vehical_id != null) {
            $vehical_attateched = "vehical_attatched";
        }

        $booking_from = get_title('cities', ['id' => $consign_value->cr_district], 'name');
        $booking_to = get_title('pincodes', ['id' => $consign_value->ce_pincode_id], 'District');
        $billing_customer = get_title('consignors', ['id' => $consign_value->cr_id], 'name');

        // Fetch consignment numbers for the current booking
        $consignment_numbers = $db->table('booking_consignment_number')
            ->where('booking_id', $consign_value->id)
            ->get()
            ->getResultArray(); // Get as array for easier manipulation

        // Add each consignment number to the array with associated details
        foreach ($consignment_numbers as $record) {
            $all_consignment_numbers[] = [
                'date' => $consign_value->date,
                'consignment_number' => $record['consignment_number'],
                'vehical_number' => $consign_value->vehical_number,
                'billing_customer' => get_title('consignors', ['id' => $consign_value->cr_id], 'name'),
                'booking_from' => $booking_from,
                'booking_to' => $booking_to,
                'vehical_reach_date' => $consign_value->vehical_reach_date,
                'Eway_bill_Validity' => $record['eway_bill_expire'],
                'Eway_bill_number' => $record['eway_bill'],

            ];
        }
    }

    // Limit the array to the first 20 consignment numbers
    $limited_consignment_numbers = array_slice($all_consignment_numbers, 0, 20);

    // Generate the table rows for the limited consignment numbers
    foreach ($limited_consignment_numbers as $row) {
?>
        <tr style="font-size: 13px;">
            <td><?= dispalyDate($row['date']) ?></td>
            <td><?= $row['consignment_number'] ?></td>
            <td><?= $row['vehical_number'] ?></td>
            <td><?= $row['billing_customer'] ?></td>
            <td><?= $row['booking_from'] ?></td>
            <td><?= $row['booking_to'] ?></td>
            <td><?= $row['Eway_bill_Validity'] ? dispalyDate($row['Eway_bill_Validity']) : '' ; ?></td>
            <td><?= $row['Eway_bill_number'] ? $row['Eway_bill_number'] : '' ;?></td>
            <td><?= ($row['vehical_reach_date']) ? dispalyDate($row['vehical_reach_date']) : '' ;?></td>
        </tr>
<?php
    }
}
?>

                           
                          
                           
                       
                            
                           
                
                           </table>
                        </div>
                       
                    </div>
                </div>
               
       </div>


        </div>
    </div>
</main>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script type="text/javascript">

$(document).ready(function() {
            // Example function to read data from the hidden table
            function readTableData() {
                let data = [];
                $('#datatable tbody tr').each(function() {
                    let row = {};
                    row.item = $(this).find('td').eq(0).text();
                    row.sale = parseFloat($(this).find('td').eq(1).text());
                    row.purchase = parseFloat($(this).find('td').eq(2).text());
                    data.push(row);
                });
                return data;
            }

            // Fetch and log the table data
            let tableData = readTableData();
            console.log(tableData);
        });




// Data retrieved from https://netmarketshare.com/
// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Debtor Creditor Cash in Hand/ Bank',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Chrome',
            y: 74.77,
            sliced: true,
            selected: true
        },  {
            name: 'Edge',
            y: 12.82
        },  {
            name: 'Firefox',
            y: 4.63
        }, {
            name: 'Safari',
            y: 2.44
        }, {
            name: 'Internet Explorer',
            y: 2.02
        }, {
            name: 'Other',
            y: 3.28
        }]
    }]
});


Highcharts.chart('container1', {
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: '<span style="color:#00b2ff;">Sale</span> <span style="color:#514fc4;">Purchase</span>'
    },
    subtitle: {
        text:
            '<a href="https://www.ssb.no/en/statbank/table/04231" target="_blank"></a>'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Amount'
        }
    }
});


// Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
// Highcharts.chart('container1', {
//     chart: {
//         type: 'column'
//     },
//     title: {
//         text: 'sale purchase'
//     },
//     subtitle: {
//         text: ''
//     },
//     xAxis: {
//         type: 'category',
//         labels: {
//             autoRotation: [-45, -90],
//             style: {
//                 fontSize: '13px',
//                 fontFamily: 'Verdana, sans-serif'
//             }
//         }
//     },
//     yAxis: {
//         min: 0,
//         title: {
//             text: 'Population (millions)'
//         }
//     },
//     legend: {
//         enabled: false
//     },
//     tooltip: {
//         pointFormat: 'Population in 2021: <b>{point.y:.1f} millions</b>'
//     },
//     series: [{
//         name: 'Population',
//         colors: [
//             '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
//             '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
//             '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
//             '#03c69b',  '#00f194'
//         ],
//         colorByPoint: true,
//         groupPadding: 0,
//         data: [
//             ['Tokyo', 37.33],
//             ['Delhi', 31.18],
//             ['Shanghai', 27.79],
//             ['Sao Paulo', 22.23],
//             ['Mexico City', 21.91],
//             ['Dhaka', 21.74],
//             ['Cairo', 21.32],
//             ['Beijing', 20.89],
//             ['Mumbai', 20.67],
//             ['Osaka', 19.11],
//             ['Karachi', 16.45],
//             ['Chongqing', 16.38],
//             ['Istanbul', 15.41],
//             ['Buenos Aires', 15.25],
//             ['Kolkata', 14.974],
//             ['Kinshasa', 14.970],
//             ['Lagos', 14.86],
//             ['Manila', 14.16],
//             ['Tianjin', 13.79],
//             ['Guangzhou', 13.64]
//         ],
//         dataLabels: {
//             enabled: true,
//             rotation: -90,
//             color: '#FFFFFF',
//             inside: true,
//             verticalAlign: 'top',
//             format: '{point.y:.1f}', // one decimal
//             y: 10, // 10 pixels down from the top
//             style: {
//                 fontSize: '13px',
//                 fontFamily: 'Verdana, sans-serif'
//             }
//         }
//     }]
// });


</script>
<!-- write js here -->
<?= $this->endSection() ?>