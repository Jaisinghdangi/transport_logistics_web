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
    .modal-body {
    max-height: 400px; /* or any desired height */
    overflow-y: auto;
    overflow-x: auto;
}

#accordion {
    width:100%; /* Ensures the table takes full width */
    table-layout: fixed; /* Ensures the table does not extend beyond the container */
}

#accordion th, #accordion td {
    word-wrap: break-word; /* Ensures long words break to fit within cells */
}
.mt-3 {
    margin-top: -30px !important;
}
#myTable ,tr{
line-height: .9;
}
.modal-content {
    width: 68% !important;
}
.modal{
    left: 110px !important;
}
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Challan Invoice</h3>
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
                                    Challan Report
                                </h5>
                               
                            </div>
                            <form method="get" action="<?= base_url('company/challan') ?>">
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
                                            <th>Challan Number</th>
                                            <th>Date</th>
                                            <th>Broker</th>
                                            <th>Lorry Hire Charge</th>
                                            <th>Total Paid</th>
                                            <th>Balance</th>
                                            <!-- <th>Amount</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($invoices) && count($invoices) > 0) {
                                            foreach ($invoices as $key => $value) {
                                                $db = \Config\Database::connect();
                                                $booking_broker = $db->table('bookings_brokers')->where(['booking_id' => $value->id])->get()->getRow();
                                                $customer_name = "";
                                                $broker_name = get_title('brokers', ['id' => $value->broker_id], 'name');
                                        ?>
                                                <tr class="align-middle">
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $value->challan_number ?></td>
                                                    <td><?= $value->challan_date ?></td>
                                                    <td><?= $broker_name ?></td>
                                                    <td><?= $booking_broker ? ($booking_broker->lorry_hire_charge + $booking_broker->rto_fine + $booking_broker->detention_charge - $booking_broker->late_delivery_charge + $booking_broker->other_deduction_charges) : ''; ?></td>
                                                    <td> <?= $booking_broker ? ($booking_broker->balance_paid) : '' ?></td>
                                                    <td> <?= $booking_broker ? ($booking_broker->balance_payabe) : '' ?></td>
                                                    <!-- <td>
                                                        <?//= $booking_broker ? $booking_broker->balance_payabe : ''; ?>
                                                    </td> -->
                                                    <td>
                                                        <a href="<?= base_url(); ?>company/print-challan/<?= $value->id; ?>" onclick="" class="btn btn-sm btn-info ">
                                                            <i class="bi bi-printer"></i>
                                                        </a>
                                                      
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal" onclick="open_modal(<?= $value->id; ?>)"><i class="bi bi-pencil"></i></a>
                                                        <a href="<?= base_url(); ?>company/download-excel/<?= $value->id; ?>"  class="btn btn-success  btn-sm"><i class="bi bi-filetype-xls"></i></a>
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

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Challan Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="accordion">
                    
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

    function open_modal(id) {
        $.ajax({
            url: '<?= base_url('company/get-Booking-Details') ?>',
            method: 'post',
            data: {
                'id': id
            },
            success: function(data) {
                let res = JSON.parse(data);
                // console.log(res.otherdata.bookings_brokers.rto_fine,'ihuiyhuiyi');
                if (res.status) {
                    let result = res.result;
                    let accodian_html = "";
                    // result.forEach((element, index) => {
                        // console.log(element, 'element');
                        // index++;
                        let accordian_open_css = "";
                        let footerHtml = "";

                        let dymention_html = "";
                            accordian_open_css = "show";
                            footerHtml = `<div  >
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4" style="margin-left: 17px;">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit" /> 
                                    </div>
                                </div>
                            </div> `;

                            accodian_html += `<div class="card">
                        
                        <div id="collapse" class="collapse ` + accordian_open_css + `" aria-labelledby="heading" data-parent="#accordion">
                            <div class="card-body" style="background:#fbfbfb;">
                            <form action="<?= base_url('company/save-Booking-Details') ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="id" name="booking_id" value="`+ id +`" />
                            <div class="card-body">
                                <div class="row" style="">
                                    <div class="row mt-3"  > 
                                    <div class=col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <table class="table table-bordered table-striped"" id="myTable"> 
                                            <tbody>  
                                            <tr style="font-size: 14px;"> 
                                            <td>Date of Booking</td>
                                            <td>`+res.result[0].date+`</td>
                                            </tr>
                                            <tr style="font-size: 14px;"> 
                                            <td>Challan No.</td>
                                            <td>`+res.result[0].challan_number+`</td>
                                            </tr>

                                            <tr style="font-size: 14px;"> 
                                            <td>Broker Name</td>
                                            <td>`+res.otherdata.borkername+`</td>
                                            </tr>

                                            <tr style="font-size: 14px;"> 
                                            <td>Vehicle</td>
                                            <td>`+res.result[0].vehical_number+`</td>
                                            </tr>
                                            <tr style="font-size: 14px;"> 
                                            <td>From</td>
                                            <td>`+res.otherdata.state_name+`</td>
                                            </tr>
                                            <tr style="font-size: 14px;"> 
                                            <td>To</td>
                                            <td>`+res.otherdata.district.District+`</td>
                                            </tr>
                                            <tr style="font-size: 14px;"> 
                                            <td>Lorry Hire Charges</td>
                                            <td><input type="text" name="lorry_hire_charge" value="`+res.otherdata.bookings_brokers.lorry_hire_charge+`" onchange="validateBookingAmount(this,'lorry_hire_charge')"/><input type="hidden" name="lorry_value" id="lorry_value" value="`+res.otherdata.bookings_brokers.lorry_hire_charge+`"/></td>
                                            </tr>
                                            <tr style="font-size: 14px;"> 
                                            <td>RTO fine</td>
                                            <td><input type="text" name="rto_fine" value="`+res.otherdata.bookings_brokers.rto_fine+`" onchange="validateBookingAmount(this,'rto_fine')"/></td>
                                            </tr>
                                            <tr> 
                                            <td>Detention Charges, if any</td>

                                            <td><input type="text" name="detention_charge" value="`+res.otherdata.bookings_brokers.detention_charge+`" onchange="validateBookingAmount(this,'detention_charge')" /></td>
                                            </tr>

                                            <tr style="font-size: 14px;"> 
                                            <td>Late delivery Charges</td>

                                            <td><input type="text" name="late_delivery_charge" value="`+res.otherdata.bookings_brokers.late_delivery_charge+`" onchange="validateBookingAmount(this,'late_delivery_charge')"/></td>
                                            </tr>

                                            <tr style="font-size: 14px;"> 
                                            <td>Other Deduction Charges	</td>
                                            <td><input type="text" name="other_deduction_charges" value="`+res.otherdata.bookings_brokers.other_deduction_charges+`" onchange="validateBookingAmount(this,'other_deduction_charges')"/></td>
                                            </tr>

                                            <tr style="font-size: 14px;"> 
                                            <td>Total Lorry Hire Charges</td>

                                            <td><input type="text" name="tot_lorry_hire_charge" value="`+res.otherdata.bookings_brokers.lorry_hire_charge+`" readonly/></td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Advance	</td>

                                            <td><input type="text" name="advance" value="`+res.otherdata.bookings_brokers.advance+`" onchange="validateBookingAmount(this,'advance')"/></td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Mamul Charges (A)</td>

                                            <td><input type="text" name="mamul_charges_A" value="`+res.otherdata.bookings_brokers.mamul_charges_A+`" onchange="validateBookingAmount(this,'mamul_charges_A')"/></td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Advance Payable</td>

                                            <td><input type="text" name="advance_payable" value="" onchange="validateBookingAmount(this,'advance_payable')" readonly/></td>
                                            </tr>

                                            <tr style="font-size: 14px;"> 
                                            <td>Advance Paid</td>

                                            <td><input type="text" name="advance_paid" value="`+res.otherdata.bookings_brokers.advance_paid+`" onchange="validateBookingAmount(this,'advance_paid')" /></td>
                                            </tr>

                                            <tr style="font-size: 14px;"> 
                                            <td>Balance	</td>

                                            <td ><input type="text" name="balance" value="`+res.otherdata.bookings_brokers.balance+`" onchange="validateBookingAmount(this,'balance')" readonly/></td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Mamul Charges (B)		</td>

                                            <td><input type="text" name="mamul_charges_B" value="`+res.otherdata.bookings_brokers.mamul_charges_B+`" onchange="validateBookingAmount(this,'mamul_charges_B')"/></td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Balance Payable</td>

                                            <td><input type="text" name="balance_payabe" value="`+res.otherdata.bookings_brokers.balance_payabe+`" onchange="validateBookingAmount(this,'balance_payabe')" readonly/></td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Cong. Note #</td>
                                         	
                                            <td></td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Consignor	</td>

                                            <td>`+ ((res.otherdata.consinorName !=='') ? res.otherdata.consinorName : 'Multiple Consignor')+`</td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Consignee</td>

                                            <td>`+ ((res.otherdata.consineeName !== '') ? res.otherdata.consineeName : 'Multiple Consignee') +`</td>
                                            </tr> 

                                            <tr style="font-size: 14px;"> 
                                            <td>Remark</td>

                                            <td>`+res.result[0].remark+`</td>

                                            </tr> 

                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                   
                                   
                                </div>
                            </div>
                            ` + footerHtml + `
                        </form>
                            </div>
                        </div>
                    </div>`;
                        
                    // })

                    $("#accordion").html(accodian_html);
                    
                    var lorryHireCharge = parseFloat($('input[name="lorry_hire_charge"]').val()) ||0;
        var rtoFine = parseFloat($('input[name="rto_fine"]').val()) || 0;
        var detentionCharge = parseFloat($('input[name="detention_charge"]').val()) || 0;
        var lateDeliveryCharge = parseFloat($('input[name="late_delivery_charge"]').val()) || 0;
        var otherDeductionCharges = parseFloat($('input[name="other_deduction_charges"]').val()) || 0;
        var totLorryHireCharge = (lorryHireCharge + rtoFine + detentionCharge) - (lateDeliveryCharge + otherDeductionCharges);
        $('input[name="tot_lorry_hire_charge"]').val(totLorryHireCharge.toFixed(2));    
                }
          
            },
            error: function(xhr, status, error) {
            console.error(xhr.responseText,'error accured');
        }
        })
    }


  

    function validateBookingAmount(input, name) {
    function getFloat(value) {
        var val = parseFloat(value);
        return isNaN(val) ? 0 : val;
    }

    var lorryOldCharge = getFloat($('#lorry_value').val());
    var lorry_hire_charge = getFloat($('input[name="lorry_hire_charge"]').val());
    var rto_fine = getFloat($('input[name="rto_fine"]').val());
    var detention_charge = getFloat($('input[name="detention_charge"]').val());
    var late_delivery_charge = getFloat($('input[name="late_delivery_charge"]').val());
    var other_deduction_charges = getFloat($('input[name="other_deduction_charges"]').val());

    var tot_lorry_hire_charge = getFloat($('input[name="tot_lorry_hire_charge"]').val());
    var advance = getFloat($('input[name="advance"]').val());
    var mamul_charges_A = getFloat($('input[name="mamul_charges_A"]').val());
    var mamul_charges_B = getFloat($('input[name="mamul_charges_B"]').val());
    var balance = getFloat($('input[name="balance"]').val());
    var balance_payabe = getFloat($('input[name="balance_payabe"]').val());
    var advance_payable = getFloat($('input[name="advance_payable"]').val());

    // $('input[name="advance_payable"]').val(advance - currentValue);

    var previousValue = getFloat($(input).attr('data-previous-value'));
    var currentValue = getFloat($(input).val());
    var difference = currentValue - previousValue;

    if (name == 'lorry_hire_charge') {
        if (currentValue < lorryOldCharge || currentValue > lorryOldCharge) {
            $('input[name="rto_fine"]').val('0');
            $('input[name="detention_charge"]').val('0');
            $('input[name="late_delivery_charge"]').val('0');
            $('input[name="other_deduction_charges"]').val('0');
            $('input[name="advance"]').val('0');
            $('input[name="mamul_charges_A"]').val('0');
            $('input[name="mamul_charges_B"]').val('0');

            $('input[name="tot_lorry_hire_charge"]').val(currentValue);
            $('input[name="balance"]').val(currentValue);
            $('input[name="balance_payabe"]').val(currentValue);
        }
    } else if (name == 'rto_fine') {
        $('input[name="tot_lorry_hire_charge"]').val(tot_lorry_hire_charge + difference);
        // $('input[name="balance"]').val(balance + difference);
        $('input[name="balance_payabe"]').val(balance_payabe + difference);
    } else if (name == 'detention_charge') {
        $('input[name="tot_lorry_hire_charge"]').val(tot_lorry_hire_charge + difference);
        // $('input[name="balance"]').val(balance + difference);
        $('input[name="balance_payabe"]').val(balance_payabe + difference);
    } else if (name == 'late_delivery_charge') {
        $('input[name="tot_lorry_hire_charge"]').val(tot_lorry_hire_charge - difference);
        // $('input[name="balance"]').val(balance - difference);
        $('input[name="balance_payabe"]').val(balance_payabe - difference);
    } else if (name == 'other_deduction_charges') {
        $('input[name="tot_lorry_hire_charge"]').val(tot_lorry_hire_charge + difference);
        // $('input[name="balance"]').val(balance - difference);
        $('input[name="balance_payabe"]').val(balance_payabe + difference);
    } else if (name == 'advance') {
        if (currentValue > tot_lorry_hire_charge) {
            alert('Lorry advance amount should be less than or equal to total lorry charges');
            $(input).val('');
        } else {
            
            $('input[name="advance_payable"]').val(difference);

            $('input[name="balance"]').val(tot_lorry_hire_charge - difference);
            $('input[name="balance_payabe"]').val(balance_payabe - difference);
            // console.log(balance,' ',difference,'hhhh');
        }
    } else if (name == 'mamul_charges_A') {
        if (currentValue > advance) {
            alert('Mamul(A) Charges should be less than or equal to advance pay');
            $(input).val('');
        }else{
            $('input[name="advance_payable"]').val(advance - currentValue);

        }
    }else if(name == 'advance_paid'){
         if (advance_payable < currentValue){
            alert('advance Paid should be less than or equal to Advance Payable');
            $(input).val('');
        }
// console.log(advance_payable ,' ',currentValue );
    } else if (name == 'mamul_charges_B') {
        if (currentValue > balance) {
            alert('Mamul(B) Charges should be less than or equal to balance amount');
            $(input).val(0);
        } else {
            var new_balance_payabe = balance_payabe - difference;
            $('input[name="balance_payabe"]').val(new_balance_payabe < 0 ? 0 : new_balance_payabe);
        }
    }

    $(input).attr('data-previous-value', currentValue);
}

$(document).ready(function() {
    $('input[name="lorry_hire_charge"]').attr('data-previous-value', $('input[name="lorry_hire_charge"]').val());
    $('input[name="rto_fine"]').attr('data-previous-value', $('input[name="rto_fine"]').val());
    $('input[name="detention_charge"]').attr('data-previous-value', $('input[name="detention_charge"]').val());
    $('input[name="late_delivery_charge"]').attr('data-previous-value', $('input[name="late_delivery_charge"]').val());
    $('input[name="other_deduction_charges"]').attr('data-previous-value', $('input[name="other_deduction_charges"]').val());
    $('input[name="advance"]').attr('data-previous-value', $('input[name="advance"]').val());
    $('input[name="mamul_charges_A"]').attr('data-previous-value', $('input[name="mamul_charges_A"]').val());
    $('input[name="mamul_charges_B"]').attr('data-previous-value', $('input[name="mamul_charges_B"]').val());
    $('input[name="balance"]').attr('data-previous-value', $('input[name="balance"]').val());
    $('input[name="balance_payabe"]').attr('data-previous-value', $('input[name="balance_payabe"]').val());
});


</script>

<?= $this->endSection(); ?>