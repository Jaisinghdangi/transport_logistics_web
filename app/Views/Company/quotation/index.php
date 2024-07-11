<?= $this->extend('Company/layout'); ?>
<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    .remove-btn {
        background-color: #ff6666;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }

    .add-btn {
        background-color: green;
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }

    .addcls {
        margin: 0px 27px 0px 0px;
    }

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
   
    body {
    background: linear-gradient(to right, #3c8dbc, #00c0ef);
}

.box {
    width: 200px;
    height: 44px;
    color: white;
    font-weight: 600;
    display: inline-block;
    margin: 0px 16px 0px 10px;
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

        /* pie chart css */

        .highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 660px;
    margin: 0.1em ;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 1px ;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 0em 0;
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
.highcharts-container{
    height: 211px !important;

}
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Quotaion </h3>
                </div>
                <div class="col-sm-6" style="width: 49%;">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('company/quotation'); ?>" style="color:white;">Quotation</a>
                        </li>
                    </ol>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box enquiry-received" style="background-color: #a3bcb7;width:100%; margin:0px">Enquiry Received</div>
                                <div class="box enquiry-received" style="background-color: #a3bcb7;font-size: 33px;width:100%; margin:0px"><?=$quatationEnquiry;?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="box quotation-sent" style="width:100%; margin:0px">Quotation Sent</div>
                                <div class="box quotation-sent" style="font-size: 33px;width:100%; margin:0px"><?=$quatationSent+$quatationApproved;?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="box quotation-approved" style="background-color:#ec7180;width:100%; margin:0px">Quotation Approved</div>
                                <div class="box quotation-approved" style="background-color:#ec7180;font-size: 33px;width:100%; margin:0px"><?=$quatationApproved;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box quotation-execution" style="background-color: #307baa; width:100%; margin:0px">Quotation Execution Ratio %</div>
                        <div class="" style="">
                        <figure class="highcharts-figure" style="margin:0px;">
                            <div id="container"></div>
                        </figure>
                    </div>
                </div>
                </div>
            
            </div>
        </div>
    <!-- </div> -->
    <div class="app-content">
        <div class="container-fluid" style="margin-top:15px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-primary">
                                    Quotaion Report <?php $currentFY= getFinancialYear(session()->get('FinancialYear'));?>
                                </h5>
                            </div>
                            <form method="get" action="<?= base_url('company/quotation') ?>">
                                <span style="margin-left:55px;color:blue;margin-bottom: 5px;"><b>From Date</b>&nbsp;<input type="date" name="from_date" id="from_date" value="<?= $from_date ?>" class="unitDropdown"  min="<?=$currentFY;?>"/></span>
                                <span style="margin-left: 10px;color:blue;margin-bottom: 5px;"><b>To Date</b>&nbsp;<input type="date" name="to_date" id="to_date" value="<?= $to_date ?>" class="unitDropdown" /></span>
                                <span style="margin-bottom: 5px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                    <a href="<?= base_url('company/quotation'); ?>" class="btn btn-danger btn-sm">
                                        Reset
                                    </a>
                                </span>
                                <span style="margin-bottom: 5px;">

                                <a href="<?= base_url('company/add-quotation'); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i> Create
                                </a>
                                </span>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>SL. No.</th>
                                            <th>Quotation Number</th>
                                            <th>Quotation Date</th>
                                            <th>Consignor</th>
                                            <th>Consignor Address</th>
                                            <th>Delivery Address</th>
                                            <th>Quotation Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($result) && count($result) > 0) {
                                            foreach ($result as $product_key => $value) {
                                                $consingor_address = get_consinor_quotoation_address($value->id);
                                                $delivery_address = get_delivery_quotoation_address($value->id);
                                                // $delivery_dimension= getDymentionDetails($value->dimension);
                                        ?>
                                                <tr class="align-middle">
                                                    <td><?= $product_key + 1; ?></td>
                                                    <td><?= $value->quotation_number; ?> </td>
                                                    <td><?= dispalyDate($value->quotation_date); ?> </td>
                                                    <td><?= get_title('consignors', ['id' => $value->consignor], 'name'); ?> </td>

                                                    <td><?= $consingor_address; ?> </td>
                                                    <td><?= $delivery_address; ?> </td>
                                                    <td><?= $value->amount ?></td>
                                                    <td>
                                                        <?php if ($value->is_approved == 0) { ?>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal" onclick="open_modal(<?= $value->parent_quotation_id; ?>)">
                                        <i class="bi bi-recycle" aria-hidden="true" title="Review Quotation"></i>
                                                            </a>
                                                            <a href="<?= base_url('approved-quotation/' . $value->id); ?>" onclick=" return confirm('Are you sure you want to approve this for booking?')" class="btn btn-sm btn-info">
                                                                <i class="bi bi-check-circle"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <a href="<?= base_url('print-quotation/' . $value->id); ?>" class="btn btn-sm btn-warning">
                                                            <i class="bi bi-printer"></i>
                                                        </a>
                                                        <a href="<?=base_url('company/editnew-quotation/' . $value->id);?>" class="btn btn-sm btn-success" style="float: left;" >
                                                            <i class="bbi bi-pencil"></i>
                                                        </a>
                                                        <a href="<?= base_url(); ?>company/view-quotation/<?= $value->id; ?>" class="btn btn-primary btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
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
                <h4 class="modal-title">Revise quotation</h4>
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

// Data retrieved from https://www.ssb.no/en/transport-og-reiseliv/landtransport/statistikk/bilparken
// Radialize the colors
var receiv = parseInt('<?=($quatationEnquiry) ? $quatationEnquiry : '0.05';?>'); 
var sent = parseInt('<?=($quatationSent) ? $quatationSent : '0.05';?>'); 
var approved = parseInt('<?=($quatationApproved) ? $quatationApproved : '0.1';?>'); 

Highcharts.setOptions({
  colors: Highcharts.map(Highcharts.getOptions().colors, function(color) {
    return {
      radialGradient: {
        cx: 0.5,
        cy: 0.3,
        r: 0.7
      },
      stops: [
        [0, color],
        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
      ]
    };
  })
});

// Build the chart

Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: '<span style="color:#008bd8;">Received &nbsp;&nbsp;</span> <span style="color:#0b0f83;">Sent &nbsp;&nbsp;</span> <span style="color:#00cc64;">Approved</span>',
    align: 'left'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f} %</b>'
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
        enabled: true,
        format: '<span style="font-size: 1.2em"><b>{point.name}</b></span><br>' +
          '<span style="opacity: 0.6">{point.percentage:.1f} %</span>',
        connectorColor: 'rgba(128,128,128,0.5)'
      }
    }
  },
  series: [{
    name: 'Share',
    data: [{
        name: 'Receiv',
        y: receiv
      },
      {
        name: 'Sent',
        y: sent
      },
      {
        name: 'Approve',
        y: approved
      },
    ]
  }],
});




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
            url: '<?= base_url('get-quotation-details') ?>',
            method: 'post',
            data: {
                'id': id
            },
            success: function(data) {
                let res = JSON.parse(data);
                if (res.status) {
                    let result = res.result;
                    let accodian_html = "";
                    result.forEach((element, index) => {
                        console.log(element, 'element');
                        index++;
                        let accordian_open_css = "";
                        let footerHtml = "";

                        let dymention_html = "";
                        if (element.dimension.length != 0) {
                            element.dimension.height.forEach((tbl_row, row_index) => {
                                dymention_html += `<tr>
                          <td scope="row" >` + (row_index + 1) + `</td>
                          <td>` + element.dimension.width[row_index] + element.dimension.width_unit[row_index] + `</td>
                          <td>` + element.dimension.height[row_index] + element.dimension.height_unit[row_index] + `</td>
                          <td>` + element.dimension.length[row_index] + element.dimension.length_unit[row_index] + `</td> 
                          <td>` + element.dimension.weight[row_index] + element.dimension.weight_unit[row_index] + `</td> 
                          </tr>`;
                            });
                        }


                        if (index != result.length) {

                            accodian_html += `<div class="card">
                        <div class="card-header" id="heading` + index + `">
                            <h5 class="mb-0">
                                <button class="btn  collapsed" data-toggle="collapse" data-target="#collapse` + index + `" aria-expanded="false" aria-controls="collapse` + index + `" style="color:blue;">
                                ` + element.quotation_number + ` ` + element.consignor_name + `  ` + element.quotation_date + `  <i class="bi bi-reply"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse` + index + `" class="collapse ` + accordian_open_css + `" aria-labelledby="heading` + index + `" data-parent="#accordion">
                            <div class="card-body"> 
                            <input type="hidden" id="id" name="id" value="` + element.parent_quotation_id + `" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4"> 
                                        <label for="name" class="form-label"><b>Quotation No</b></label><br>
                                        <span> ` + element.quotation_number + ` </span> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4"> 
                                    <label for="name" class="form-label"><b>Quotation Date</b></label><br>
                                        <span> ` + element.quotation_date + ` </span>   
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                    <label for="name" class="form-label"><b>Consignor</b></label><br>
                                        <span> ` + element.consignor_name + ` </span>    
                                    </div> 

                                    <div class="row mt-3"> 
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <label for="name" class="form-label"><b>Consignor address</b></label><br>
                                            <span>` + element.consinor_address + `</span>
                                        </div>
 
                                    </div>
                                    <div class="row mt-3"> 
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <label for="name" class="form-label"><b>Delivery Address</b></label><br>
                                             <span >` + element.delivery_address + `</span>
                                        </div> 
                                    </div>  
  
                                    <div class="row mt-3"  > 
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="name" class="form-label"><b>Product Dimensions</b></label><br>
                                        <table class="table table-striped"> 
                                          <thead>
                                            <th scope="col" >SNo.</th>
                                            <th scope="col" >Width</th>
                                            <th scope="col" >Height</th>
                                            <th scope="col" >Length</th> 
                                            <th scope="col" >Weight</th>  
                                          </thead>
                                            <tbody>  
                                            ` + dymention_html + `
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="row mt-3"> 
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                           <label for="name" class="form-label"><b>Estimate amount (Rs.)</b></label><br>
                                            <span> ` + element.amount + ` </span>    
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">

                                        <label for="name" class="form-label"><b>Remark</b></label><br>
                                            <span> ` + element.remark + ` </span>   
                                            </div>
                                    </div> 
                                </div>
                            </div>
                            ` + footerHtml + ` 
                            </div>
                        </div>
                    </div>`;
                        } else {

                            accordian_open_css = "show";
                            footerHtml = `<div  >
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4" style="margin-left: 17px;">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit" /> 
                                    </div>
                                </div>
                            </div> `;

                            accodian_html += `<div class="card">
                        <div class="card-header" id="heading` + index + `">
                            <h5 class="mb-0">
                                <button class="btn  collapsed" data-toggle="collapse" data-target="#collapse` + index + `" aria-expanded="false" aria-controls="collapse` + index + `" style="color:blue;">
                                ` + element.quotation_number + ` ` + element.consignor_name + `  ` + element.quotation_date + `  <i class="bi bi-reply"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse` + index + `" class="collapse ` + accordian_open_css + `" aria-labelledby="heading` + index + `" data-parent="#accordion">
                            <div class="card-body" style="background:#fbfbfb;">
                            <p class="text-center" ><u>Revise quotation</u></b>
                            <form action="<?= base_url('replay-quotation') ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id" value="` + element.parent_quotation_id + `" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4"> 
                                        <label for="name" class="form-label"><b>Quotation No</b></label><br> 
                                        <input type="text" name="quotation_number" class="form-control" id="quotation_number" value="` + element.quotation_number + `" readonly> 
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4"> 
                                    <label for="quotation_date" class="form-label"><b>Quotation Date</b></label> 
                                    <input type="date" name="quotation_date" class="form-control" id="quotation_date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>"> 
                                    </div> 

                                    <?php
                                    echo render_view('Components/countries', ['data' => $consignor, 'required' => true, 'label' => 'Consignor', 'name' => 'consignor', 'value' => '', 'classes' => 'select2']);
                                    ?>

                                     <div class="row mt-3">
                                        <h4>From Address</h4>
                                        <?php
                                        echo render_view('Components/countries', ['data' => $countries, 'required' => true, 'label' => 'Country', 'name' => 'country', 'value' => 101, 'classes' => 'select2']);
                                        ?>

                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                                            <select name="state_id" id="state_id" onchange="getDistice()" class="form-control">
                                                <option value="">Select State</option>
                                            </select> 
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                            <select name="district" id="district" class="form-control">
                                                <option value="">Select District</option>
                                            </select> 
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Consignor Local Address <small class="text-danger">*</small></label>
                                            <textarea name="consignor_local_address" class="form-control" id="consignor_local_address" placeholder="Consignor Local Address">` + element.consignor_local_address + `</textarea>
                                         
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <h4>Delivery Address</h4>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                                            <input type="text" id="pincode" name="pincode" onchange="getPincodeAddress()" value="` + element.pincode + `" class="form-control" placeholder="Search by Pincode" />
                                        
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="delivery_address_id" class="form-label">Post Office <span class="text-danger">*</span></label>
                                            <select id="postofficeList" onchange="getPostofficeList()" name="delivery_address_id" class="form-control select2"> 
                                            </select>
                                       
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <span id="delivery_address_by_pincode"></span>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <label for="local_delivery_address">Local Delivery Address <small class="text-danger">*</small></label>
                                            <textarea name="local_delivery_address" id="local_delivery_address" class="form-control" placeholder="Full Address">` + element.local_delivery_address + `</textarea>
                                            
                                        </div>
                                    </div>
  
                                    <div class="row mt-3"  > 
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <label for="name" class="form-label"><b>Product Dimensions</b></label><br>
                                        <table class="table table-striped" id="myTable"> 
                                          <thead>
                                            <th scope="col" >SNo.</th>
                                            <th scope="col" >Length</th> 
                                            <th scope="col" >Width</th>
                                            <th scope="col" >Height</th> 
                                            <th>Aproximate Weight</th>
                                            <th scope="col" >Action</th>  
                                          </thead>
                                            <tbody>   
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                    
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                            <label for="name" class="form-label">Estimate amount <b>(Rs.)</b><span class="text-danger">*</span></label>
                                            <input type="text" name="amount" class="form-control" id="amount" value="` + element.amount + `">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <label for="name" class="form-label">Remark <span class="text-danger">*</span></label>
                                            <textarea name="remark" class="form-control" id="remark" placeholder="remark">` + element.remark + `</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ` + footerHtml + `
                        </form>
                            </div>
                        </div>
                    </div>`;

                            console.log(element.consignor, 'mahesh');
                            getState(101);
                            setTimeout(function() {
                                $("#consignor").val(parseInt(element.consignor))
                            }, 1000);
                            setTimeout(function() {
                                $("#state_id").val(parseInt(element.state_id));
                                getDistice();
                            }, 1000);
                            setTimeout(function() {
                                $("#district").val(parseInt(element.district))
                            }, 1500);
                            setTimeout(function() {
                                getPincodeAddress();
                            }, 1000);

                            setTimeout(function() {
                                $("#postofficeList").val(element.delivery_address_id);
                                getPostofficeList();
                            }, 2000);

                            setTimeout(function() {


                                if (element.dimension.length != 0) {
                                    console.log(element.dimension, 'dimension dimension mahesh');
                                    element.dimension.height.forEach((tbl_row, row_index) => {
                                        addRow();
                                        $("#weight_" + (row_index + 1)).val(element.dimension.weight[row_index]);
                                        $("#width_" + (row_index + 1)).val(element.dimension.width[row_index]);
                                        $("#height_" + (row_index + 1)).val(element.dimension.height[row_index]);
                                        $("#length_" + (row_index + 1)).val(element.dimension.length[row_index]);
                                        $("#length_unit_" + (row_index + 1)).val(element.dimension.length_unit[row_index]);
                                        $("#width_unit_" + (row_index + 1)).val(element.dimension.width_unit[row_index]);
                                        $("#height_unit_" + (row_index + 1)).val(element.dimension.height_unit[row_index]);
                                        $("#weight_unit_" + (row_index + 1)).val(element.dimension.weight_unit[row_index]);
                                    });
                                }

                            }, 1500);


                        }
                    })

                    $("#accordion").html(accodian_html);
                    // $("#consignor_name").html(result.consignor_name);
                    // $("#consignor_address").html(result.consinor_address);
                    // $("#delivery_address").html(result.delivery_address);
                    // $("#estimate_amount").html(result.amount);
                }
            }
        })
    }

    $(document).ready(() => {
        getState(101);
    });
    $('#country').change(function() {
        let country_id = $(this).val();
        getState(country_id);
    })

    function getState(country_id) {
        $.ajax({
            url: '<?= base_url('get-states') ?>',
            method: 'post',
            data: {
                'country_id': country_id
            },
            success: function(data) {
                $('#state_id').html(data)
            }
        })
    }

    function getDistice() {
        let id = $("#state_id").val();
        $.ajax({
            url: '<?= base_url('get-districts') ?>',
            method: 'post',
            data: {
                'state_id': id
            },
            success: function(data) {
                $('#district').html(data)
            }
        })
    }

    function getPincodeAddress() {

        let pincode = $("#pincode").val();
        $.ajax({
            url: '<?= base_url('getAddressByPincode') ?>',
            method: 'post',
            data: {
                'pincode': pincode
            },
            success: function(data) {
                let result = JSON.parse(data);
                let deliveryAdd = "";
                let post_office_html = "<option value=''>Select Post Office</option>";
                if (result.status) {
                    result.result.forEach((element) => {
                        post_office_html += `<option value=` + element.Id + ` >` + element.OfficeName + `</option>`;
                        deliveryAdd = "<b>State</b> : " + element.StateName + " , <b>District</b> :" + element.District + ", <b>City</b>:" + element.DivisionName + ", <b>Pincode</b>:" + element.Pincode;
                    });
                    console.log(deliveryAdd, 'data');
                    $("#delivery_address_by_pincode").html(deliveryAdd);
                    $("#postofficeList").html(post_office_html);
                }
                // $('#finance_state').html(data)
            }
        })
    }

    function getPostofficeList() {
        $.ajax({
            url: '<?= base_url('getAddressByPincodePost') ?>',
            method: 'post',
            data: {
                'postoffice_id': $("#postofficeList").val()
            },
            success: function(data) {
                let result = JSON.parse(data);
                let deliveryAdd = "";
                if (result.status) {
                    result.result.forEach((element) => {
                        deliveryAdd = "<b>State</b> : " + element.StateName + " , <b>District</b> :" + element.District + ", <b>City</b>:" + element.DivisionName + ", <b>Pincode</b>:" + element.Pincode + " ,<b>Post Office</b>:" + element.OfficeName;
                    });
                    console.log(deliveryAdd, 'data');
                    $("#delivery_address_by_pincode").html(deliveryAdd);
                }
                // $('#finance_state').html(data)
            }
        })
    }


    function addRow() {
        var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        cell1.innerHTML = table.rows.length;
        cell2.innerHTML = `<input type="text" name="dimension[length][]" class="form-control" id="length_` + table.rows.length + `" placeholder="Enter length" style="width:115px;float:left;" required><select name="dimension[length_unit][]" id="length_unit_` + table.rows.length + `"  class="unitDropdown" required >'<?= dimension_unit_html() ?>'</select>`;
        cell4.innerHTML = `<input type="text" name="dimension[height][]" class="form-control" id="height_` + table.rows.length + `" placeholder="Enter height" style="width:115px;float:left;" required> <select name="dimension[height_unit][]" id="height_unit_` + table.rows.length + `"  class="unitDropdown" required >'<?= dimension_unit_html() ?>'</select>`;
        cell3.innerHTML = `<input type="text" name="dimension[width][]" class="form-control" id="width_` + table.rows.length + `" placeholder="Enter width" style="width:115px;float:left;" required> <select name="dimension[width_unit][]" id="width_unit_` + table.rows.length + `"  class="unitDropdown" required >'<?= dimension_unit_html() ?>'</select>`;
        cell5.innerHTML = `<input type="text" name="dimension[weight][]" class="form-control" id="weight_` + table.rows.length + `" placeholder="Enter Weight" style="width:115px;float:left;" required><select name="dimension[weight_unit][]" id="weight_unit_` + table.rows.length + `"  class="unitDropdown" required >'<?= weight_unit_html() ?>'</select>`;

        if (table.rows.length == 1) {
            cell6.innerHTML += "<button type='button' class='add-btn addcls' onclick='addRow()'>Add</button>";
        } else {
            cell6.innerHTML += "<button class='remove-btn' onclick='removeRow(this)'>Remove</button>";
        }
    }


    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

<?= $this->endSection(); ?>