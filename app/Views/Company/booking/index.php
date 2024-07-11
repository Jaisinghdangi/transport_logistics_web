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
    .box {
        border-radius: 6px;
    width: 200px;
    height: 100px;
    color: white;
    font-weight: 600;
    display: inline-block;
    margin: 4px 10px 5px 10px;
    line-height: 50px;
    text-align: center;
}

.enquiry-received {

    background-color: #a3bcb7; /* Update background color */
}

.quotation-sent {
    background-color: #333; /* Update background color */
}

.quotation-approved {
    background-color: #ec7180; /* Update background color */
}

.quotation-execution {
    background-color: #307baa; /* Update background color */
    color: #fff; /* Update text color */
}
#DataTables_Table_0{
    width: 100% !important;
}
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Booking </h3>
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

            <div class="row">
                <div class="box enquiry-received col" style="background-color: #a3bcb7;width:13%;">Link Broker <br><span style="font-size: 34px"><?=$linkBroker;?></style></div>
                <div class="box quotation-sent col" style="width:13%;">Link Vehicle <br><span style="font-size: 34px"><?=$linkVehicle;?></div>
                <div class="box quotation-approved col" style="background-color:#ec7180;width:16%;">Booking Pending <br><span style="font-size: 34px"><?=$bookingPending;?></div>
                <div class="box quotation-execution col" style="background-color: #307baa;width:21%;font-size: 14px;">Booking Completed <br><span style="font-size: 34px"><?=$bookingCompleted;?></div>
                <div class="box quotation-announcement " style="background-color:#0070fc;width:22%;">Important Announcement </div>

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
                                Booking Report <?php $currentFY= getFinancialYear(session()->get('FinancialYear'));?>
                                </h5>
                            </div>
                            <form method="get" action="<?= base_url('company/booking') ?>">
                                <span style="margin-left: 78px;color:blue;margin-bottom: 5px;"><b>From Date</b>&nbsp;<input type="date" name="from_date" id="from_date" value="<?= $from_date ?>" class="unitDropdown" min="<?=$currentFY;?>"/></span>
                                <span style="margin-left: 10px;color:blue;margin-bottom: 5px;"><b>To Date</b>&nbsp;<input type="date" name="to_date" id="to_date" value="<?= $to_date ?>" class="unitDropdown" /></span>
                                <span style="margin-bottom: 5px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                    <a href="<?= base_url('company/booking'); ?>" class="btn btn-danger btn-sm">
                                        Reset
                                    </a>
                                </span>
                                <span style="margin-left: 3%;">

                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="getQuatation()">
                                Create
                                </a>
                                </span>

                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Booking No</th> 
                                            <th>Quoation Number</th> 
                                            <th>Booking Date</th>
                                            <th>Type</th>
                                            <th>Consignor <i class="bi bi-person-circle"></i></th>
                                            <th>Broker Name</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th class="d-none" >Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($bookings) && count($bookings) > 0) {
                                            foreach ($bookings as $consign_key => $consign_value) { 
                                                $booking_from=get_title('cities', ['id' => $consign_value->cr_district], 'name');
                                                $booking_to=get_title('pincodes', ['id' => $consign_value->ce_pincode_id], 'District');
                                                // $booking_state=get_title('pincodes', ['id' => $consign_value->ce_pincode_id], 'StateName');
                                 
                                                $billing_customer=get_title('consignors', ['id' => $consign_value->cr_id], 'name');
                                                ?>
                                                <tr class="align-middle">
                                                    <td><?= $consign_key+1 ?></td>
                                                    <td><?= $consign_value->booking_no ?></td>
                                                    <td><?= $consign_value->quotationNumber ?></td>
                                                    <td><?= dispalyDate($consign_value->date) ?></td> 
                                                    <td><?= $consign_value->booking_type ?></td>  
                                                    <td><?= $billing_customer ?></td>  
                                                    <td><?= get_title('brokers', ['id' => $consign_value->broker_id], 'name') ?></td>  

                                                    <td><?= $booking_from ?></td>  
                                                    <td><?= $booking_to ?></td>  
                                                    <td class="d-none" >
                                                        <?php if ($consign_value->status) { ?>
                                                            <a href="<?= base_url(); ?>company/status-Booking/<?= $consign_value->id; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                                <i class="bi bi-patch-check"></i> Active
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>company/status-Booking/<?= $consign_value->id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure really want change status?');">
                                                                <i class="bi bi-ban"></i> Inactive
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                     
                                                        <form action="<?= base_url('company/edit-Booking') ?>" method="GET" enctype="multipart/form-data" style="float: left;">
                                                        <input type="hidden" name="booking_type" id="booking_type" value="<?= $consign_value->booking_type ?>" />
                                                        <input type="hidden" name="loading_point" id="loading_point" value="<?= $consign_value->loading_type ?>" />
                                                        <input type="hidden" name="delivery_point" id="delivery_point" value="<?= $consign_value->unloading_type ?>" />
                                                        <input type="hidden" name="booking_id" id="booking_id" value="<?= $consign_value->id ?>" />
                                                        <input type="hidden" name="quotation_id" id="quotation_id" value="<?= $consign_value->quatation_id ?>" />
                                                        
                                                        <button type="submit" id="submit_btn" class="btn btn-sm btn-warning" ><i class="bi bi-pencil"></i></button>
                                                        </form>
                                                        <a href="<?= base_url(); ?>company/view-Booking/<?= $consign_value->id; ?>" class="btn btn-sm btn-info" style="float: left;" >
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="<?= base_url(); ?>company/delete-Booking/<?= $consign_value->id; ?>" onclick="return confirm('Are you sure really want delete?');" class="btn btn-sm btn-danger  d-none">
                                                            <i class="bi bi-trash"></i>
                                                        </a> 
                                                    </td>
                                                </tr>
                                        <?php }
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
                <h4 class="modal-title">Booking Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-body">
                    <form action="<?= base_url('company/add-Booking') ?>" method="GET" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <label for="name" class="form-label">Booking Type<span class="text-danger">*</span></label>
                                <select class="form-control" id="booking_type" name="booking_type" required>
                                    <option value="" >-Select Booking Type-</option>
                                    <option value="Paid">Paid</option>
                                    <option value="To Pay">To Pay</option>
                                    <option value="both">TOPAY & PAID Basis</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <label for="loading_point" class="form-label">Loading Point<span class="text-danger">*</span></label>
                                <select class="form-control" id="loading_point" name="loading_point" required>
                                    <option value="" >-Select Loading Point-</option>
                                    <option value="Single Point">Single Point</option>
                                    <option value="Multi Point">Multi Point</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                <label for="delivery_point" class="form-label">Delivery Point<span class="text-danger">*</span></label>
                                <select class="form-control" id="delivery_point" name="delivery_point" required>
                                    <option value="">-Select Delivery Point-</option>
                                    <option value="Single Point">Single Point</option>
                                    <option value="Multi Point">Multi Point</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Quotation No. </th>
                                        <th>Quotation Date</th>
                                        <th>Consignor</th>
                                        <th>Loading Address</th>
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
                        console.log(element, 'element');
                        qutation_html += `<tr>
                                    <td>` + (key + 1) + ` &nbsp;&nbsp;<input type="radio" id="quotation_id" name="quotation_id" value="`+element.id+`" required /></td>
                                    <td>` + element.quotation_number + `</td>
                                    <td>` + element.quotation_date + `</td>
                                    <td>` + element.consignor_name + `</td>
                                    <td>` + element.consinor_address + `</td>
                                    <td>` + element.delivery_short_address + `</td>
                                </tr>`;
                    });
                    $("#quotation_list").html(qutation_html);
                }
                console.log(res, 'res');
            },
        });
    }
</script>

<?= $this->endSection(); ?>