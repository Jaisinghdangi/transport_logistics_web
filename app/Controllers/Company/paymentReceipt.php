<?php

namespace App\Controllers\Company;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Country;
use App\Models\BusinessType;
use App\Models\Consignor as Consign;
use App\Models\consignorNumber as consignorNum;
use App\Models\termsCondition as termcondition;
use App\Models\SeriesType;
use App\Models\FinancialYear;
use App\Models\PaymentMode;
use Dompdf\Dompdf;
use Dompdf\Options;
class paymentReceipt  extends BaseController
{
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {        
        $db = \Config\Database::connect();

        $data['title'] = 'Consignors';
        $model = new termcondition();
        $consinor = new Consign();
        $PaymentMode = new PaymentMode();

        $FinancialYear = new FinancialYear();
        $SeriesType = new SeriesType();
        $comman_where = ['status' => 1, 'is_delete' => 1];
        $where['is_delete'] = 0;
        $where['comp_id'] =session()->get('CompId');

        $data['terms'] = $model->where('comp_id',session()->get('CompId'))->where('is_delete', 1)->get()->getResult();
        $data['FinancialYear'] = $FinancialYear->get()->getResult();
        $data['SeriesType'] = $SeriesType->get()->getResult();
        $data['consignor'] = $consinor->where($comman_where)->where('comp_id',session()->get('CompId'))->get()->getResult();
        $data['PaymentMode'] = $PaymentMode->get()->getResult();
        $data['invoices'] =$db->table('invoice')->where($where)->orderBy('id', 'DESC')->get()->getResult();


        $model = new SeriesType();
        $data['SeriesType'] = $model->get()->getResult();
        return view('Company/paymentReceipt/index', $data);
    }

    public function getInvoiceList()
{
    $db = \Config\Database::connect();
    $customerId = $this->request->getPost('customerId');
    $customerType = $this->request->getPost('customerType');
    $compId = session()->get('CompId');
    
    $where = [
        'is_delete' => 0,
        'comp_id' => $compId,
        
        'booking_type' => ($customerType == 'Consignor') ? 'Paid' : 'To Pay'
    ];
    
    $invoices = $db->table('invoice')->where($where)->orderBy('id', 'DESC')->get()->getResult();


    $rows = [];
    $invoicelist = [];
    $invoicelist[] = '<option disabled>Select Invoices</option>';
    $addpayment = [];
    $sno = 0;
    $sno1 = 0;

    $balanceAmount =0;
    $amount=0;
    if (!empty($invoices)) {
        foreach ($invoices as $invoice) {
            $customer_name = "";
            if ($invoice->booking_type == 'Paid') {
                $customer_name = get_title('consignors', ['id' => $customerId], 'name');
            } elseif ($invoice->booking_type == 'To Pay') {
                $customer_name = get_title('consignees', ['id' => $customerId], 'name');
            }

            $arrinvoice_number = get_title_full('multi_invoice_number', ['booking_id' => $invoice->booking_id], 'invoice_number');


            if (!empty($arrinvoice_number)) {
                foreach ($arrinvoice_number as $key1 => $value1) {
                   
      if($invoice->booking_type == 'Paid'){
       $costomer_id = get_title_full('multiple_booking_vehical', ['booking_id' => $invoice->booking_id], 'consignor_id')[$key1]->consignor_id;
      }else{
        $costomer_id = get_title_full('multiple_booking_vehical', ['booking_id' => $invoice->booking_id], 'consignee_id')[$key1]->consignee_id;
      }

       if( $costomer_id == $customerId){
                    // $sno++;
                    $booking_number = get_title('bookings', ['id' => $invoice->booking_id], 'booking_no');
                    $invoice_number = $value1->invoice_number;
                    $booking_date = dispalyDate($invoice->invoice_date);
                    $customer_name = ($invoice->booking_type == 'Paid') 
                        ? getConsinorName(get_title_full('multiple_booking_vehical', ['booking_id' => $invoice->booking_id], 'consignor_id')[$key1]->consignor_id) 
                        : getConsineeName(get_title_full('multiple_booking_vehical', ['booking_id' => $invoice->booking_id], 'consignee_id')[$key1]->consignee_id);
                    $total_amount = get_title_full('split_bill', ['booking_id' => $invoice->booking_id], 'booking_amt') 
                        ? indian_rupee(get_title_full('split_bill', ['booking_id' => $invoice->booking_id], 'booking_amt')[$key1]->booking_amt) 
                        : indian_rupee($invoice->total_amount);
                        
     
                        $total_amount1 = get_title_full('split_bill', ['booking_id' => $invoice->booking_id], 'booking_amt') 
                        ? get_title_full('split_bill', ['booking_id' => $invoice->booking_id], 'booking_amt')[$key1]->booking_amt
                        : $invoice->total_amount;

                   
    $addpayment = $db->table('add_payment')
    ->select('Invoice_number, receivedPaidAmount')
    ->where('payment_status', 'done')
    ->get()
    ->getResultArray();

$doneInvoices = array_column($addpayment, 'Invoice_number');

$notDonePayments = $db->table('add_payment')
->select('Invoice_number, SUM(receivedPaidAmount) as receivedPaidAmount')
->where('payment_status !=', 'done')
        ->groupBy('Invoice_number')
        ->get()
        ->getResultArray();

$notDoneAmounts = [];
foreach ($notDonePayments as $payment) {
$notDoneAmounts[$payment['Invoice_number']] = $payment['receivedPaidAmount'];
}



if (!in_array($invoice_number, $doneInvoices)) {
// Check if there's a receivedPaidAmount for the current invoice_number
if (isset($notDoneAmounts[$invoice_number])) {
$amount = $total_amount1 - $notDoneAmounts[$invoice_number];
} else {
$amount = $total_amount1;
}

$balanceAmount += $amount;

// Adding to $invoicelist array
$invoicelist[] = '<option value="'.$invoice_number.','.$invoice->booking_id.','.$amount.'">'.$invoice_number.'</option>'; 
}
// }   

$addpayment1 = $db->table('add_payment')->where('Invoice_number',$invoice_number)->orderBy('id','DESC')->get()->getResultArray();
$addpayment1nn = $db->table('add_payment')->where('Invoice_number',$invoice_number)->get()->getResultArray();

// foreach ($addpayment1 as $payment) {
//     if ($payment['Invoice_number'] === $invoice_number) {
//         $payment_info = $payment;
//         break;
//     }
// }
// if (!empty($payment_info)) {

// if($payment['Invoice_number'] === $invoice_number){
//         $paymentStatus = htmlspecialchars($payment_info['payment_status']);
//         $receivedPaidAmount = indian_rupee($payment_info['receivedPaidAmount']);
//         $paymentStatusHTML1 = !empty($paymentStatus) ? $paymentStatus : 'Unpaid';

//         $paymentStatusHTML = ($receivedPaidAmount != '') ? $paymentStatus : 'Unpaid';
//         $payment_row = 
//         '<tr class="align-middle">
//             <td>' . $sno . '</td>
//             <td>' . $payment['Invoice_number'] . '</td>
//             <td>' . htmlspecialchars(dispalyDate($payment['paymentDate'])) . '</td>
//             <td>' . htmlspecialchars($booking_number). '</td>
//             <td>' . indian_rupee($payment_info['receivedPaidAmount']) . '</td>
//             <td>' . $paymentStatusHTML . '</td>
//             <td style="text-align: right;">' . floatval($total_amount) - floatval($payment_info['receivedPaidAmount']) . '</td>
//         </tr>';
    
//         // Add payment row to $rows array
//         $rows[] = $payment_row;
//     }
// }
$statusvalue = [];
foreach ($addpayment1nn as $payment1) {
    $statusvalue[$payment1['Invoice_number']] = $payment1['payment_status'];
}



foreach ($addpayment1 as $payment) {
     $sno++;
    $paymentStatus = htmlspecialchars($payment['payment_status']);
    $receivedPaidAmount = indian_rupee($payment['receivedPaidAmount']);
    $paymentStatusHTML1 = !empty($paymentStatus) ? $paymentStatus : 'Unpaid';

    $paymentStatusHTML = ($receivedPaidAmount != '') ? $paymentStatus : 'Unpaid';
    $payment_row = 
    '<tr class="align-middle">
        <td>' . $sno . '</td>
        <td>' . $payment['Invoice_number'] . '</td>
        <td>' . htmlspecialchars(dispalyDate($payment['paymentDate'])) . '</td>
        <td>Receipt</td>
        <td>' . indian_rupee($payment['receivedPaidAmount']) . '</td>
        <td></td>
        <td style="text-align: right;"></td>
    </tr>';

    // Add payment row to $rows array
    $rows[] = $payment_row;
}
$sno++;

if (isset($statusvalue[$invoice_number])) {
    if ($statusvalue[$invoice_number] == 'done') {
        $paymentStatus = '<span class="text-success"><i class="bi bi-check-circle"></i> Done</span>';
    } else if ($statusvalue[$invoice_number] == 'partial') {
        $paymentStatus = '<span class="text-warning "><i class="bi bi-exclamation-circle"></i> Partial</span>';
    } else {
        $paymentStatus = '<span class="text-danger"><i class="bi bi-exclamation-triangle"></i> UnPaid</span>';
    }
} else {
    $paymentStatus = '<span class="text-danger"><i class="bi bi-exclamation-triangle"></i> UnPaid</span>';
}


                    $rows[] = 
                    '<tr class="align-middle">
                        <td>' . $sno . '</td>
                        <td>' .$invoice_number. '</td>
                        <td>' . htmlspecialchars($booking_date). '</td>
                        <td>Invoice Sale</td>
                        <td></td>
                        <td>'.$paymentStatus.'</td>
                        <td style="text-align: right;">' . $total_amount . '</td>
                        
                    </tr>';

                  
       }
                }
            } else {
                if($invoice->billing_customer_id == $customerId){
                 //   $addpayment= $db->table('add_payment')->where(['payment_status'=>'done'])->get()->getResult();
                // $sno++;
                $booking_number = get_title('bookings', ['id' => $invoice->booking_id], 'booking_no');
                $invoice_number = $invoice->invoice_number;
                $booking_date = dispalyDate($invoice->invoice_date);
                $total_amount = indian_rupee($invoice->total_amount);
                $total_amount1 = $invoice->total_amount;


                $addpayment = $db->table('add_payment')
                ->select('Invoice_number, receivedPaidAmount')
                ->where('payment_status', 'done')
                ->get()
                ->getResultArray();
            
            $doneInvoices = array_column($addpayment, 'Invoice_number');
            
            $notDonePayments = $db->table('add_payment')
            ->select('Invoice_number, SUM(receivedPaidAmount) as receivedPaidAmount')
            ->where('payment_status !=', 'done')
                    ->groupBy('Invoice_number')
                    ->get()
                    ->getResultArray();
            
            $notDoneAmounts = [];
            foreach ($notDonePayments as $payment) {
            $notDoneAmounts[$payment['Invoice_number']] = $payment['receivedPaidAmount'];
            }

                
                 if (!in_array($invoice_number, $doneInvoices)) {
                    if (isset($notDoneAmounts[$invoice_number])) {
                        $amount = $total_amount1  - $notDoneAmounts[$invoice_number];
                        } else {
                        $amount = $total_amount1;
                        }
                        
                $balanceAmount += $amount;
                //  $balanceAmount += $total_amount1;

                $invoicelist[] = '<option value="'.$invoice_number.','.$invoice->booking_id.','.$amount.'">'.$invoice_number.'</option>'; 
                              }

    $addpayment1 = $db->table('add_payment')->where('Invoice_number',$invoice_number)->orderBy('id','DESC')->get()->getResultArray();

    $addpayment1nn = $db->table('add_payment')->where('Invoice_number',$invoice_number)->get()->getResultArray();

                            //   foreach ($addpayment1 as $payment) {
                            //       if ($payment['Invoice_number'] === $invoice_number) {
                            //           $payment_info = $payment;
                            //           break;
                            //       }
                            //   }

                            //   if (!empty($payment_info)) {

                            //   if($payment['Invoice_number'] === $invoice_number){

                            //         $paymentStatus = htmlspecialchars($payment_info['payment_status']);
                            //         $receivedPaidAmount = indian_rupee($payment_info['receivedPaidAmount']);
                            //          $paymentStatusHTML1 = ($paymentStatus) ? $paymentStatus : 'Unpaid';

                            //         $paymentStatusHTML = ($receivedPaidAmount != '') ? $paymentStatus : 'Unpaid';
                            //         $payment_row = 
                            //         '<tr class="align-middle">
                            //             <td>' . $sno . '</td>
                            //             <td>' .$payment['Invoice_number'] . '</td>
                            //             <td>' . htmlspecialchars(dispalyDate($payment['paymentDate'])) . '</td>
                            //             <td>' . htmlspecialchars($booking_number) . '</td>
                            //             <td>' . indian_rupee($payment_info['receivedPaidAmount']) . '</td>
                            //             <td>' .  $paymentStatusHTML . '</td>
                            //             <td style="text-align: right;">' . floatval($invoice->total_amount) - floatval($payment_info['receivedPaidAmount']). '</td>
                            //         </tr>';
                                
                            //         // Add payment row to $rows array
                            //         $rows[] = $payment_row;
                            //     }
                            // }

                            

                             $statusvalue = [];
                            foreach ($addpayment1nn as $payment1) {
                                $statusvalue[$payment1['Invoice_number']] = $payment1['payment_status'];


                            }

                            foreach ($addpayment1 as $payment) {
                                $sno++;
                                $paymentStatus = htmlspecialchars($payment['payment_status']);
                                $receivedPaidAmount = indian_rupee($payment['receivedPaidAmount']);
                                $paymentStatusHTML1 = !empty($paymentStatus) ? $paymentStatus : 'Unpaid';
                            
                                $paymentStatusHTML = ($receivedPaidAmount != '') ? $paymentStatus : 'Unpaid';
                                $payment_row = 
                                '<tr class="align-middle">
                                    <td>' . $sno . '</td>
                                    <td>' . $payment['Invoice_number'] . '</td>
                                    <td>' . htmlspecialchars(dispalyDate($payment['paymentDate'])) . '</td>
                                    <td>Receipt</td>
                                    <td>' . indian_rupee($payment['receivedPaidAmount']) . '</td>
                                    <td></td>
                                    <td style="text-align: right;"></td>
                                </tr>';
                            
                                // Add payment row to $rows array
                                $rows[] = $payment_row;
                            }
                            

                         foreach ($addpayment1 as $payment) {
                                //   if ($payment['Invoice_number'] === $invoice_number) {
                                      $payment_info = $payment;
                                    //   break;
                                //   }
                              }    

                              if (isset($statusvalue[$invoice_number])) {
                                if ($statusvalue[$invoice_number] == 'done') {
                                    $paymentStatus = '<span class="text-success"><i class="bi bi-check-circle"></i> Done</span>';
                                } else if ($statusvalue[$invoice_number] == 'partial') {
                                    $paymentStatus = '<span class="text-warning"><i class="bi bi-exclamation-circle"></i> Partial</span>';
                                } else {
                                    $paymentStatus = '<span class="text-danger"><i class="bi bi-exclamation-triangle"></i> UnPaid</span>';
                                }
                            } else {
                                $paymentStatus = '<span class="text-danger"><i class="bi bi-exclamation-triangle"></i> UnPaid</span>';
                            }
                            
                    $sno++;

                $rows[] = '<tr class="align-middle">
                    <td>' . $sno . '</td>
                    <td>' .$invoice_number. '</td>
                    <td>' . htmlspecialchars($booking_date). '</td>
                    <td>Invoice Sale</td>
                    <td></td>
                    <td>'.$paymentStatus .'</td>
                    <td style="text-align: right;">' . $total_amount . '</td>
                   
                </tr>';

               
                }
            }
        }
    }
    if (empty($rows)) {
        $table = '<span class="text-danger text-center">No Record found.</span>';
    } else {
    $table = '<table class="table table-bordered table-striped" id="allPayments" border="1" style="border-collapse:collapse;">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Invoice Number</th>
            <th>Invoice Date</th>
            <th>Type</th>
            <th>Paid Amount</th>
            <th>Payment Status</th>
            <th>Balance</th>
        </tr>
    </thead>
     <tbody>' . implode('', $rows) . '</tbody>
</table>
<div id="offscreen" style="position: absolute; left: -9999px;"></div>';
    }
    return $this->response->setJSON([
        "result" => $customerId,
        "result1" => $customerType,
        "rows" =>  $table,
        "newdata"=> $invoicelist,
        "blanceAmount"=>$balanceAmount
    ]);
}


public function saveInvoiceList()
{
    $db = \Config\Database::connect();
    $formData = $this->request->getPost();
    $status = 0;
    $invoices = $formData['invoices'] ?? [];
    $paidAmount = $formData['paid_amount'] ?? 0;
    $paidAmount = floatval($paidAmount); // Ensure paidAmount is a float

    if (is_array($invoices)) {
        foreach ($invoices as $invoice) {
            $invoiceParts = explode(',', $invoice);
            $invoiceNumber = $invoiceParts[0];
            $bookingId = $invoiceParts[1];
            $totalAmount = floatval($invoiceParts[2]); // Convert to float

            // Determine payment status based on the remaining paid amount
            if ($paidAmount >= $totalAmount) {
                $paymentStatus = 'done';
                $amountPaid = $totalAmount;
            } else {
                $paymentStatus = $paidAmount > 0 ? 'partial' : 'unpaid';
                $amountPaid = $paidAmount;
            }

            $split_data = [
                'Invoice_number' => $invoiceNumber,
                'booking_id' => $bookingId,
                'receivedPaidAmount' => $amountPaid,
                'cashDiscountAmount' => $formData['cashDiscountAmount'],
                'paymentDate'=>$formData['date'],
                'payment_type'=>$formData['payment_type'],
                'payment_mode'=>$formData['payment_mode'],
                'remark'=>$formData['remark'],
                'ChequeDate'=>$formData['ChequeDate'] ?? '',
                'payment_status' => $paymentStatus,
                'party_name' => $formData['party_id'],
                'comp_id' => session()->get('CompId'),
                'created' => current_time(),
                'created_by' => session()->get('UserName'),
            ];

            $insert = $db->table('add_payment')->insert($split_data);

            // Deduct the amount paid from the total paid amount
            $paidAmount -= $amountPaid;
        }
        if ($insert) {
            $status = 1;
        }
    } else {
        $status = 'No invoices selected.';
    }
    return json_encode(['status' => $status, "data" => 'ghg']);
}
   


    
public function paymentStatementPDF()
{
    $request = \Config\Services::request();
    // Get the HTML content from the request
    $htmlContent = $request->getPost('html');
    // Initialize Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    // Output the generated PDF to Browser
    return $this->response->setHeader('Content-Type', 'application/pdf')
                          ->setBody($dompdf->output())
                          ->send();
}

}
