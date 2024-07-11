<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

<!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap-multiselect.min.css" /> -->
<style type="text/css">
    .select2-container--default .select2-results__option {
        padding: 5px 5px;
    }
    .select2-results__option--selectable, select.form-control-sm~.select2-container--default {
        font-size: 0.7rem !important;
    }
    .select2-container .select2-selection--single {
        height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        top: 60%;
    }
    .table:not(.table-dark) {
        color: #000000;
    }
    .form-group label {
        color: #fff;
    }
    .btn-group{
        display: block;
    }
    .custom-select {
        height: calc(2rem + 1px);
        line-height: 1;
    }
    .form-check-label {
        color: #000 !important;
    }
    table.dataTable tfoot th {
        padding: 10px 5px 6px 5px;
    }
    .multiselect-container {
        transform: translate3d(0px, 32px, 0px) !important;
    }
    .dropdown-menu.show {
        height: auto;
        max-height: 200px;
        overflow-y: scroll;
    }
    label {
  color: white;
}
</style>

<div class="content-wrapper" id="headerrefresh">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="header" style="background-color:#2C4668;">
                    <div class="col-md-12 col-xl-12 col-lg-12">
                        <div class="header-body">
                            <h4 style="color: white; padding: 5px 0px 0px 0px;" class="text-center">
                            Challan Payment
                            </h4>
                            <form id="dataForm" method="POST" >
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="financial_year">Financial Year <span class="text-danger">*</span></label>
                                            <select name="financial_year" id="financial_year" class="form-control form-control-sm" title="Financial Year" required="">
                                                <?php foreach ($FinancialYear as $key => $data) { ?>
                                                <option value="<?=$data->id;?>" <?= (session()->get('FinancialYear') ==$data->id) ? 'selected':'' ?>><?= $data->year ;?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="voucher_type">Voucher Type <span class="text-danger">*</span></label>
                                            <select name="voucher_type" id="voucher_type" class="form-control form-control-sm" title="Voucher Type" required="">
                                            <?php //foreach ($SeriesType as $key => $data) { ?>
                                                <option value="3">Challan</option>
                                                <?php // } ?>
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none">
                                        <div class="form-group">
                                            <label for="voucher_number">Voucher Number <span class="text-danger">*</span></label>
                                            <input type="text" name="voucher_number" id="voucher_number" value="<?= set_value('voucher_number'); ?>" class="form-control form-control-sm" required="" readonly="" />
                                        </div>                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="date">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" id="date" value="<?= set_value('date', date('Y-m-d')); ?>" class="form-control form-control-sm" required="" />
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 d-none">
                                        <div class="form-group">
                                            <label for="account_group">Account Group <span class="text-danger">*</span></label>
                                            <select name="account_group" id="account_group" class="form-control form-control-sm" title="Account Group" onchange="GetParties(this.value);" required="">
                                                <option value="" selected="" disabled="">Select Account Group</option>
                                                <?php
                                                  //  $AccountGroup = $this->db->where('status', 1)->where('name', 'Sundry Creditors')->or_where('name', 'Sundry Debitors')->order_by('name', 'ASC')->get('accounting_group')->result();
                                                    //if ($AccountGroup) { foreach ($AccountGroup as $key => $Group) {
                                                ?>
                                                <option></option>
                                                <?php //} } ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-1 col-sm-1 col-lg-1 d-none">
                                        <div class="form-group">
                                            <label for="estimate">Estimate</label>
                                            <br />
                                            <input type="checkbox" name="estimate" value="true" <?= set_checkbox('estimate', 'true'); ?> id="estimate" title="Estimate" />
                                        </div>
                                    </div>

                                  
                                        
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="party_id">Party Name <span class="text-danger">*</span></label>
                                            <select name="party_id" id="party_id" class="select2 form-control " title="Party Name" required=""  onchange="handleCustomerChange(this)">
                                            <option>Select Party Name</option>
                                            <?php
if (isset($invoices) && count($invoices) > 0) {
    $customers = [];

    foreach ($invoices as $invoice) {
     
        $customer_name  = get_title('brokers', ['id' => $invoice->broker_id], 'name');
        $customer_id  = $invoice->broker_id;
        $customer_type = 'Broker';

        // Collect customer data
        $customers[] = [
            'id' => $customer_id,
            'name' => $customer_name,
            'type' => $customer_type

        ];


       
    }

    // Remove duplicates
    $customers = array_unique($customers, SORT_REGULAR);

    // Sort customers by name
    usort($customers, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });

    // Display options
    foreach ($customers as $customer) {
        if($customer['id'] != ''){
            echo '<option value="' . htmlspecialchars($customer['id']) .','. htmlspecialchars($customer['type']).'">' . htmlspecialchars($customer['name']) . '</option>';
        }
       
    }
}
?>

    </select>
  </div>
                                  


                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="balance_amount">Balance Amount <span class="text-danger">*</span></label>
                                            <input type="text" name="balance_amount" value="<?= set_value('balance_amount'); ?>" id="balance_amount" class="form-control form-control-sm" placeholder="Balance Amount" required="" readonly="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="invoices">Select Challan <span class="text-danger">*</span></label>
                                            <select name="invoices[]" id="invoices" class="select2 form-control form-control-sm" placeholder="Select Invoices" title="Select Invoices" required="" multiple>
                                                <option selected="" disabled="" value="">Select Challan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="invoice_amount">Invoice Amount <span class="text-danger">*</span></label>
                                            <input type="text" name="invoice_amount" value="<?= set_value('invoice_amount'); ?>" id="invoice_amount" class="form-control form-control-sm" min="0" placeholder="Invoice Amount" required="" readonly="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="receivedPaidAmount">Received Paid Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="receivedPaidAmount" value="<?= set_value('receivedPaidAmount'); ?>" id="receivedPaidAmount" class="form-control form-control-sm" min="0" placeholder="Received Paid Amount" step="0.1" onchange="calculatePaidAmount();" oninput="calculatePaidAmount();" required="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="cashDiscountAmount">Cash Discount Amount</label>
                                            <input type="number" name="cashDiscountAmount" value="<?= set_value('cashDiscountAmount'); ?>" id="cashDiscountAmount" class="form-control form-control-sm" min="0" placeholder="Cash Discount Amount" step="0.1" onchange="calculatePaidAmount();" oninput="calculatePaidAmount();" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="paid_amount">Paid Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="paid_amount" value="<?= set_value('paid_amount'); ?>" id="paid_amount" class="form-control form-control-sm" min="0" placeholder="Paid Amount" step="0.1" required="" readonly="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="payment_type">Payment Type <span class="text-danger">*</span></label>
                                            <select name="payment_type" id="payment_type" class="form-control form-control-sm" title="Payment Type" required="">
                                                <option value="">Select Payment Type</option>
                                                <option value="Receipt" <?= set_select('payment_type', 'Receipt'); ?>>Receipt</option>
                                                <option value="Payment" <?= set_select('payment_type', 'Payment'); ?>>Payment</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="payment_mode">Payment Mode <span class="text-danger">*</span></label>
                                            <select name="payment_mode" id="payment_mode" class="form-control form-control-sm" title="Payment Mode" onchange="ifCheque();" required="">
                                                <option value="">Select Payment Mode</option>
                                                <?php
                                                     foreach ($PaymentMode as $row) {
                                                ?>
                                                <option value="<?=$row->id?>" ><?=$row->method;?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4 Cheque d-none">
                                        <div class="form-group">
                                            <label for="ChequeDate">Cheque Date</label>
                                            <input type="date" name="ChequeDate" value="<?= set_value('ChequeDate', date('Y-m-d')); ?>" id="ChequeDate" class="form-control form-control-sm" title="Cheque Date" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="remark">Remark</label>
                                            <textarea name="remark" id="remark" class="form-control form-control-sm" placeholder="Remark" rows="1"><?= set_value('remark'); ?></textarea>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary btn-sm" form="dataForm">
                                                Save
                                            </button>
                                           
                                                                </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12 col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="card-title">
                                </div>
                               
                                <div class="pull-right" style="float: right;">
                                    
                                
                                
<button id="downloadPdf" class="btn btn-success btn-xs" style="position: relative;">
    <span id="buttonText">Payment Statement</span>
    <img id="loadingGif" src="<?= base_url(); ?>/Assets/Images/loading-loading-gif.gif" alt="Loading..." style="width: 20px; height: 20px; display: none; margin-left: 10px;">
</button>
                              <input type="hidden" value="" name="party_txt_name" id="party_txt_name">
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="searchForm" method="POST" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="date" name="From" class="form-control form-control-sm" id="From" title="From" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="date" name="To" class="form-control form-control-sm" id="To" title="To" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-search text-white"></i> Search
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm d">
                                                    <i class="fa fa-refresh text-white"></i>
                                                </button>
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm" title="Print Statement" onclick="printStatement();">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive" >
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentRemark" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"></div>
    </div>
</div>
<div id="offscreen" style="position: absolute; left: -9999px;"></div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?> 
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jszip.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap-multiselect.min.js"></script>
<!-- <<<<<<< HEAD -->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!-- ======= -->
<!-- >>>>>>> 216b10fc47d49aa1252e007ea9d4c598997e3cc0 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script type="text/javascript">

$('#party_id').on('change', function() {66
                var selectedText = $('#party_id option:selected').text();
                $('#party_txt_name').val(selectedText);
            });

            $('#downloadPdf').on('click', function() {
                // Extract the table data
               var partyname= $('#party_txt_name').val(); 
  if(partyname != ''){

    var table = $('#allPayments');
  var tableRows = table.find('tbody tr').length;

                var completeHtml;
    if (table.length === 0 || tableRows === 0) {
        alert('Data not found , try again !');
    }else{
    var tableHtml = $('#allPayments')[0].outerHTML;

    completeHtml = `
                    <div id="pdf-content">
                        <style>
                            #pdf-content {
                                width: 100%;
                            }
                            #pdf-content table {
                                width: 100%;
                                border-collapse: collapse;
                            }
                            #pdf-content table, #pdf-content th, #pdf-content td {
                                border: 1px solid black;
                            }
                            #pdf-content th, #pdf-content td {
                                padding: 8px;
                                text-align: left;
                            }
                            #pdf-content .header {
                                text-align: center;
                                margin-bottom: 20px;
                            }
                        </style>
                        <div class="header">
                            <h2>Challan Payment Statement</h2>
                            <h3>Party Name: ${partyname}</h3>
                        </div>
                        ${table[0].outerHTML}
                    </div>
                `;
        //         $.ajax({
        //             url: '<?= base_url('company/challan-statement-pdf') ?>',
        //             method: 'POST',
        //             data: { html: completeHtml },
        //             xhrFields: { responseType: 'blob' },
        //             success: function(response) {
        //                 // console.log(response,'response');
        //                  var blob = new Blob([response], { type: 'application/pdf' });
        //                 var link = document.createElement('a');
        //                  link.href = window.URL.createObjectURL(blob);
        //                  link.download = 'Challan_Payment.pdf';
        //                  link.click();
        //             },
        //             error: function(xhr, status, error) {
        //     console.error('Error:', xhr.responseText, error);
        // }
        //         }); 
                $('#offscreen').html(completeHtml); 

            $('#loadingGif').show();
                // $('#loading').show();

            html2canvas($('#offscreen')[0]).then(canvas => {
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();
                const imgData = canvas.toDataURL('image/png');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('Challan_Payment.pdf');

                // Hide loading GIF
                $('#loadingGif').hide();
                        }).catch(function(error) {
                console.error('Error generating PDF:', error);

                // Hide loading GIF in case of error
                $('#loadingGif').hide();
                        });
                




          }  }else{
                alert('Select Party Name !');
                $('#party_id').focus();

                }
            });
        // });

$('#invoices').change(function(){
                var selectedValues = $(this).val();
                var totalInvoiceAmt = 0;

                // Iterate over the selected values
                selectedValues.forEach(function(invoiceValue) {
                    var invoiceParts = invoiceValue.split(','); 
                    var invoiceAmt = parseFloat(invoiceParts[2]); 
                    totalInvoiceAmt += invoiceAmt; 
                });
                $('#invoice_amount').val(totalInvoiceAmt);

                var invoice_amount = parseFloat($('#invoice_amount').val());

                var paid_amount = parseFloat($('#paid_amount').val());
                if(paid_amount > invoice_amount){
                        $('#paid_amount').val('');
                        $('#receivedPaidAmount').val('');
                        $('#cashDiscountAmount').val('');
                    }
            });

            $("#receivedPaidAmount").on("keyup", function() {
                var invoiceAmt = parseFloat($('#invoice_amount').val());
                var receivedPaidAmount = parseFloat($(this).val());
                var cashDiscountAmount = parseFloat($('#cashDiscountAmount').val()) || 0;

                if ((receivedPaidAmount + cashDiscountAmount) > invoiceAmt) {
                    alert("Received Paid Amount cannot be greater than Invoice Amount!");
                    $(this).val(''); 
                    $('#cashDiscountAmount').val(''); 
                    $('#paid_amount').val('');

                }
            });
            
            $("#cashDiscountAmount").on("keyup", function() {
                var invoiceAmt = parseFloat($('#invoice_amount').val());
                var receivedPaidAmount = parseFloat($('#receivedPaidAmount').val());
                var cashDiscountAmount = parseFloat($(this).val());
                   var paidAmount = receivedPaidAmount + cashDiscountAmount;
                if (paidAmount > invoiceAmt) {
                    alert("Cash Discount Amount cannot exceed Invoice Amount!");
                    $(this).val(''); 
                  var paid_amount=  parseFloat($('#paid_amount').val());
                  $('#paid_amount').val(paid_amount - cashDiscountAmount);
                }
            });



        //     });
        // });
        function handleCustomerChange(selectElement) {
            var selectedOption = selectElement.value.split(',');
            var customerId = selectedOption[0];
            var customerType = selectedOption[1];
            getInvoiceList(customerId, customerType);
        }
        // $(document).ready(() => {
        //  getInvoiceList(6, 'Consignor');

        // });

        function getInvoiceList(customerId, customerType) { 
    var url = '<?= base_url('company/get-challan-list') ?>';
    // console.log('URL:', url);

    $.ajax({
        url: url,
        method: 'post',
        data: {
            'customerId': customerId,
            'customerType': customerType,
        },
        success: function(data) {
            //  console.log('Response:', data.statusvalue); // Inspect the response
            if (data) {
                $(".table-responsive").html(data.rows);
                $("#invoices").html(data.newdata);
                $('#balance_amount').val(data.blanceAmount);
            
            }  
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText, error);
        }
    });
}



 $("#dataForm").submit(function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    $.ajax({
        url: '<?= base_url('company/save-challan-list') ?>', 
        method: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            res = JSON.parse(data);
            console.log(res);
            if(res.status == '1'){
                var selectedValue =$('#party_id').val();
                var parts = selectedValue.split(',');
                 var customerId = parts[0];
              var customerType = parts[1];

          $('#party_id').val(selectedValue);
          getInvoiceList(customerId,customerType);
          $('#invoice_amount').val('');
          $('#paid_amount').val('');
          $('#receivedPaidAmount').val('');

       swal({ 
      position: 'top-end',
      title: 'Payment Done', 
      imageUrl: '<?= base_url(); ?>/Assets/Images/one-loop-gif.gif'  ,
      showConfirmButton: false,
       timer: 2000
      });  
        }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText,'error accured Add Payment ');
        }
    });
});





   
    

    
    const calculatePaidAmount = () => {
        var receivedPaidAmount = $("#receivedPaidAmount").val();
        var cashDiscountAmount = $("#cashDiscountAmount").val();
        var TotalPaidAmount = Number(receivedPaidAmount) + Number(cashDiscountAmount);
        $("#paid_amount").val(parseFloat(TotalPaidAmount).toFixed(2));
    };
    
   
  
   
    
    const ifCheque = () => {
        if ($('#payment_mode').val() == 6) {
            $('.Cheque').removeClass('d-none');
        } else {
            $('.Cheque').addClass('d-none');
        }
    };
</script>



<!-- write js here -->
<script type="text/javascript">
    $('.table').DataTable({
        "pageLength" : 20,
        "lengthMenu" : [[20, 50, 100, 500, -1], [20, 50, 100, 500, "All"]],
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false
    });
</script>
<?= $this->endSection(); ?>