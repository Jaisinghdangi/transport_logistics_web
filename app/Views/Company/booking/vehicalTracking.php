<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
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

        background-color: #a3bcb7;
        /* Update background color */
    }

    .quotation-sent {
        background-color: #333;
        /* Update background color */
    }

    .quotation-approved {
        background-color: #ec7180;
        /* Update background color */
    }

    .quotation-execution {
        background-color: #307baa;
        /* Update background color */
        color: #fff;
        /* Update text color */
    }
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Vehical Tracking</h3>
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
                <div class="box enquiry-received col" style="background-color: #a3bcb7;width:13%;">Upcoming Trip<br><span style="font-size: 34px"><?= $upcomingTrip; ?></span></div>
                <div class="box quotation-sent col" style="width:13%;">Ongoing Trip <br><span style="font-size: 34px"><?= $ongoingTrip; ?></span></div>
                <div class="box quotation-announcement col" style="background-color:#0070fc;width:22%;">Intime<br><span style="font-size: 34px"><?= $estimate_date_in; ?></span></div>
                <div class="box quotation-Delay col" style="background-color:#59e4d2;width:22%;">Delay<br><span style="font-size: 34px"><?= $estimate_date_out; ?></span></div>
                <div class="box quotation-approved col" style="background-color:#ec7180;width:16%;">Completed <br><span style="font-size: 34px"><?= $completed; ?></span></div> 
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
                            <form method="get" action="<?= base_url('company/vehical-tracking') ?>">
                                <span style="margin-left: 78px;color:blue;margin-bottom: 5px;"><b>From Date</b>&nbsp;<input type="date" name="from_date" id="from_date" value="<?= $from_date ?>" class="unitDropdown" /></span>
                                <span style="margin-left: 10px;color:blue;margin-bottom: 5px;"><b>To Date</b>&nbsp;<input type="date" name="to_date" id="to_date" value="<?= $to_date ?>" class="unitDropdown" /></span>
                                <span style="margin-bottom: 5px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                    <a href="<?= base_url('company/vehical-tracking'); ?>" class="btn btn-danger btn-sm">
                                        Reset
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
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Consignor <i class="bi bi-person-circle"></i></th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($bookings) && count($bookings) > 0) {
                                            foreach ($bookings as $consign_key => $consign_value) {
                                                $vehical_attateched = "";
                                                if ($consign_value->vehical_id != null) {
                                                    $vehical_attateched = "vehical_attatched";
                                                }
                                                $booking_from = get_title('cities', ['id' => $consign_value->cr_district], 'name');
                                                $booking_to = get_title('pincodes', ['id' => $consign_value->ce_pincode_id], 'District');
                                                // $booking_state=get_title('pincodes', ['id' => $consign_value->ce_pincode_id], 'StateName');

                                                $billing_customer=get_title('consignors', ['id' => $consign_value->cr_id], 'name');
                                        ?>
                                                <tr class="align-middle <?= $vehical_attateched ?>">
                                                    <td><?= $consign_key + 1 ?></td>
                                                    <td><?= $consign_value->booking_no ?></td>
                                                    <td><?= dispalyDate($consign_value->date) ?></td>
                                                    <td><?= $consign_value->booking_type ?></td>
                                                    <td><?= $billing_customer ?></td>
                                                    <td><?= $booking_from ?></td>
                                                    <td><?= $booking_to ?></td>

                                                    <td>

                                                            <?php if($consign_value->is_orderReached !=1){ ?>
                                                            <a href="<?= base_url(); ?>booking-order-status/<?= $consign_value->id; ?>" onclick="return confirm('Are you sure, the order has reached the destination?') " class="btn btn-sm btn-info" title="The order has been successfully delivered to the destination ?">
                                                                <i class="bi bi-truck-flatbed"></i>
                                                            </a>
                                                            <?php }else{ ?>
                                                                <i class="bi bi-receipt"></i>
                                                            <?php } ?>
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
                                    <td>` + (key + 1) + ` &nbsp;&nbsp;<input type="radio" id="quotation_id" name="quotation_id" value="` + element.id + `" required /></td>
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
</script>

<?= $this->endSection(); ?>