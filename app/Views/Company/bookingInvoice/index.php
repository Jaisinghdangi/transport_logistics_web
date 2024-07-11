<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
      .unitDropdown {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
    }
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Booking Invoice</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/Booking'); ?>">Booking</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary"> 
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-primary">
                                Booking Report
                                </h5>
                            </div>
                            <form method="get" action="<?= base_url('company/invoices') ?>">
                                <span style="margin-left: 78px;color:blue;margin-bottom: 5px;"><b>From Date</b>&nbsp;<input type="date" name="from_date" id="from_date" value="<?= $from_date ?>" class="unitDropdown" /></span>
                                <span style="margin-left: 10px;color:blue;margin-bottom: 5px;"><b>To Date</b>&nbsp;<input type="date" name="to_date" id="to_date" value="<?= $to_date ?>" class="unitDropdown" /></span>
                                <span style="margin-bottom: 5px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                    <a href="<?= base_url('company/booking'); ?>" class="btn btn-danger btn-sm">
                                        Reset
                                    </a>
                                </span>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm float-end" data-toggle="modal" data-target="#myModal" onclick="getQuatation()">
                                Unbilled
                                </a>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th> 
                                            <th>Invoice NO</th> 
                                            <th>Booking No</th> 
                                            <th>Date</th>
                                            <th>Billing <i class="bi bi-person-circle"></i></th>  
                                            <th>Booking Type</th>
                                            <th>Amount</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php   
                                        $sno=0;
                                        if (isset($invoices) && count($invoices) > 0) {
                                            foreach ($invoices as $key => $value) { 
                                                $customer_name=""; 
                                                if($value->booking_type=='Paid'){
                                                    $customer_name=get_title('consignors',['id'=>$value->billing_customer_id],'name');
                                                }else if($value->booking_type=='To Pay'){
                                                    $customer_name=get_title('consignees',['id'=>$value->billing_customer_id],'name');
                                                }
                                                 $arrinvoice_number =[];
                                                // if ($value->invoice_number) {
                                                    // $arrinvoice_number= json_decode($value->invoice_number);
                                                // }        
                                                $arrinvoice_number=  get_title_full('multi_invoice_number',['booking_id'=>$value->booking_id],'invoice_number');                               
                                                      
                                          if($arrinvoice_number != NULL){
                                                    foreach ($arrinvoice_number as $key1 => $value1) { 
                                                        $sno++;
                                                ?>
                                                <tr class="align-middle">
                                                    <td><?= $sno;?></td> 
                                                    <td><?= get_title_full('multi_invoice_number',['booking_id'=>$value->booking_id],'invoice_number')[$key1]->invoice_number; ?></td>
                                                    <td><?= get_title('bookings',['id'=>$value->booking_id],'booking_no') ?></td>
                                                    <td><?= dispalyDate($value->invoice_date) ?></td>  
                                                    <td><?= ($value->booking_type=='Paid') ? getConsinorName(get_title_full('multiple_booking_vehical',['booking_id'=>$value->booking_id],'consignor_id')[$key1]->consignor_id) : getConsineeName(get_title_full('multiple_booking_vehical',['booking_id'=>$value->booking_id],'consignee_id')[$key1]->consignee_id) ?></td>  
                                                    <td><?= $value->booking_type ?></td>
                                                    <td style="text-align: right;">
                                                    <?= ((get_title_full('split_bill',['booking_id'=>$value->booking_id],'booking_amt')) ? indian_rupee(get_title_full('split_bill',['booking_id'=>$value->booking_id],'booking_amt')[$key1]->booking_amt): indian_rupee($value->total_amount)); ?>
                                                    </td>
                                                    <td> 
                                                        <?php if(($value->loading_type=='Multi Point' && $value->unloading_type == 'Multi Point') || ($value->loading_type=='Single Point' && $value->unloading_type == 'Multi Point') || ($value->loading_type=='Multi Point' && $value->unloading_type == 'Single Point')){  ?>
                                                            <form action="<?= base_url(); ?>company/print-multiInvoice/<?= $value->id; ?>" method="GET" enctype="multipart/form-data" style="float: left;">
                                                        <input type="hidden" name="invoice_print" id="invoice_print" value="<?= get_title_full('multi_invoice_number',['booking_id'=>$value->booking_id],'invoiceindex')[$key1]->invoiceindex; ?>" />
                                                        
                                                        <button type="submit" id="submit_btn" class="btn btn-sm btn-info" ><i class="bi bi-printer"></i></button>
                                                        </form>




                                                            <!-- <a href="<?= base_url(); ?>company/print-multiInvoice/<?= $value->id; ?>" class="btn btn-sm btn-info "> -->
                                                            <!-- <i class="bi bi-printer"></i> -->
                                                        <!-- </a>   -->
                                                  
                                                    <?php  }else{ ?>
                                                        <a href="<?= base_url(); ?>company/print-invoice/<?= $value->id; ?>" onclick="" class="btn btn-sm btn-info ">
                                                            <i class="bi bi-printer"></i>
                                                        </a>   
                                                        <?php  }  ?>
                                                    </td>
                                                </tr>
                                        <?php } }else{
                                             $sno++;
                                            ?>
                                             <tr class="align-middle">
                                             <td><?= $sno; ?></td> 
                                             <td><?= $value->invoice_number ?></td>
                                             <td><?= get_title('bookings',['id'=>$value->booking_id],'booking_no') ?></td>
                                             <td><?= dispalyDate($value->invoice_date) ?></td>  
                                             <td><?= ($customer_name) ? $customer_name : 'Multiple Billings' ?></td>  
                                             <td><?= $value->booking_type ?></td>
                                             <td style="text-align: right;">
                                             <?= indian_rupee($value->total_amount) ?>
                                             </td>
                                             <td> 
                                                 <?php if(($value->loading_type=='Multi Point' && $value->unloading_type == 'Multi Point') || ($value->loading_type=='Single Point' && $value->unloading_type == 'Multi Point') || ($value->loading_type=='Multi Point' && $value->unloading_type == 'Single Point')){  ?>
                                                     <a href="<?= base_url(); ?>company/print-multiInvoice/<?= $value->id; ?>" class="btn btn-sm btn-info ">
                                                     <i class="bi bi-printer"></i>
                                                 </a>  
                                           
                                             <?php  }else{ ?>
                                                 <a href="<?= base_url(); ?>company/print-invoice/<?= $value->id; ?>" onclick="" class="btn btn-sm btn-info ">
                                                     <i class="bi bi-printer"></i>
                                                 </a>   
                                                 <?php  }  ?>
                                             </td>
                                         </tr>
                                   <?php     }
                                        
                                    }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Unbilled Consignment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-body">
                    <form action="<?= base_url('company/add-Booking') ?>" method="GET" enctype="multipart/form-data">
                        
                        <div class="row">
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Booking No. </th>
                                        <th>Booking Date</th>
                                        <th>Consignor</th>
                                        <th>Consignee</th>
                                        <th>Loading Address</th>
                                        <th>Delivery Address</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="quotation_list">
                                </tbody>
                            </table>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<!-- write js here -->
<script type="text/javascript">
    $('.table').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [20, 50, 100, 500, -1],
            [20, 50, 100, 500, "All"]
        ],
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false
    });
    


    function getQuatation() {
        var baseurl='<?= base_url(); ?>';
        $.ajax({
            url: '<?= base_url('get-unbilled-consignment') ?>',
            method: 'post',
            data: {
                'id': 0
            },
            success: function(data) {
                let res = JSON.parse(data);
                console.log(res,'res'); 
                let qutation_html = "";
                if (res.status == 1) {
                    res.result.forEach((element, key) => {
                        console.log(element, 'element'); 
                        qutation_html += `<tr>
                                    <td>` + (key + 1) + `</td>
                                    <td>` + element.booking_no + `</td>
                                    <td>` + element.quotation_date + `</td>
                                    <td>` + element.consignor_name + `</td>
                                    <td>` + element.consignee_name + `</td>
                                    <td>` + element.consinor_address + `</td>
                                    <td>` + element.delivery_short_address + `</td>
                                    <td>` + element.net_amount + `</td>
                                    <td><a href="${(element.consignee_name) ? `${baseurl}company/create-invoice/${element.id}` : `${baseurl}company/create-multiInvoice/${element.id}`}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-receipt"></i>
                                                        </a></td>
                                </tr>`;
                    });
                    $("#quotation_list").html(qutation_html);
                } 
            },
        });
    }
</script>

<?= $this->endSection(); ?>