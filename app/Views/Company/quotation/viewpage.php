<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
        padding: 0.360rem 0.45rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
    }

    
.container-fluid {
    /* margin-top: 20px; */
}

/* Card Styles */
.card {
    /* border-radius: 10px; */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-header {
    /* background-color: #007bff; */
    background-color: #b0744b;
    color: #fff;
    border-radius: 10px 10px 0 0;
    /* padding: 15px; */
}
.card-title{
    margin-bottom:0px;
}
.card-body {
    background-color: #fff;
    padding: 20px;
}

/* Form Styles */
.form-label {
    font-weight: bold;
}
label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Text Colors */
.text-primary {
    color: #007bff;
}

.text-danger {
    color: #dc3545;
    display: none;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .card-header {
        border-radius: 10px;
    }
}
h4{  
    background-color: #1a285d;
    color: white;
    font-weight: 600;
}
.card.card-outline {
    border-top: 3px solid #b0744b;
}
.row{padding-top: 15px;}
.empty{    
    color: red;
}
</style>
<?php $errors = [];
if (session()->has('errors')) {
    $errors = session()->get('errors');
} ?>
 
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row" style="padding-top:0px;">
                <div class="col-sm-6">
                    <h3 class="mb-0">Quotation</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url(); ?>company/quotation">Quotation</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row" style="padding-top:0px;">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-white">
                                    View Quotation Detail
                                </h5>
                            </div>
                            <a href="<?= base_url('company/quotation'); ?>" class="btn btn-success btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form action="#" >
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                        <label for="name" class="form-label">Quotation No<span class="text-danger"></span></label>
                                        <br>
                                      <span><?=(getVoucherNumber('Quotation')) ? getVoucherNumber('Quotation') : '<span class="empty">Empty</span>' ?></span>
                                        
                                      
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                        <label for="name" class="form-label">Quotation Date<span class="text-danger">*</span></label>
                                        <br>
                                      <span><?=($quotation -> quotation_date) ? $quotation -> quotation_date : '<span class="empty">Empty</span>' ?></span>
                                        
                                    
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                        <label for="name" class="form-label">Consignor<span class="text-danger"></span></label>
                                        <br>
                                      <span><?=($consignor -> name) ? $consignor -> name : '<span class="empty">Empty</span>' ?></span>
                                        
                                    
                                    </div>

                                    <div class="row mt-3">
                                        <h4>From Address</h4>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="state_id" class="form-label">Country <span class="text-danger"></span></label>
                                         <br>   <span><?=($contry -> name) ? $contry -> name : '<span class="empty">Empty</span>' ?></span>

                                          
                                        </div>

                                    
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="state_id" class="form-label">State <span class="text-danger"></span></label>
                                            
                                            <br>   <span><?=($states -> name) ? $states -> name : '<span class="empty">Empty</span>' ?></span>
  
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="district" class="form-label">District <span class="text-danger"></span></label>
                                               
                                            <br>   <span><?=($districts -> name) ? $districts -> name : '<span class="empty">Empty</span>' ?></span>
  
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Consignor Local Address <small class="text-danger"></small></label>
                                         
                                            <br>   <span><?=($quotation -> consignor_local_address ) ? $quotation -> consignor_local_address  : '<span class="empty">Empty</span>' ?></span>  
                                           
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <h4>Delivery Address</h4>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="pincode" class="form-label">Pincode <span class="text-danger"></span></label>
                                            <br>   <span><?=($quotation -> pincode ) ? $quotation -> pincode  : '<span class="empty">Empty</span>' ?></span>  
                                            <input type="hidden" id="pincode" name="pincode"  class="form-control" placeholder="Search by Pincode" required value="<?=$quotation ->pincode ; ?>"/>
                                           
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4" id="pinmodel"  style="width:8%;display:none;"><br>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="openpinmodel">+</a>

                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="delivery_address_id" class="form-label">Post Office <span class="text-danger"></span></label>
                                            <br>   <span id="postofficeList"></span>  
                                            
                                          
                                            <input type="hidden" value="<?=$quotation ->delivery_address_id ;?>" id="delivery_address_id_value">
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
                                            <br>   <span><?=($quotation -> local_delivery_address ) ? $quotation -> local_delivery_address  : '<span class="empty">Empty</span>' ?></span> 

                                           
                                        </div>
                                    </div>

                                    <div class="row mt-3" style=" margin-left: 0px;">
                                        <h4>Product Dimensions</h4>
                                        <table id="myTable">
                                            <thead>
                                                <th>SNo.</th>
                                                <th>Length</th>
                                                <th>Width</th>
                                                <th>Height</th>
                                                <th>Aproximate Weight</th>
                                                <th>Amount</th>

                                            </thead>
                                            <tbody>
                                                <!-- Dynamic rows will be added here -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mt-3">  
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                            <label for="name" class="form-label">Estimate amount (Rs.)<span class="text-danger">*</span></label>
                                           
                                            <br>   <span><?=($quotation -> amount ) ? $quotation -> amount  : '<span class="empty">Empty</span>' ?></span> 
                                        </div> 
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                            <label for="name" class="form-label">Amount in Words<span class="text-danger">*</span></label><br>
                                            <span id="inwords" style="font-weight:bold;"><?=$quotation ->amount_in_word; ?></span>
                                        </div> 
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <label for="name" class="form-label">Remark <span class="text-danger">*</span></label>
                                            <br>   <span><?=($quotation -> remark ) ? $quotation -> remark  : '<span class="empty">Empty</span>' ?></span> 
                                            
                                        </div>
                                    </div>


                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>

    $(document).ready(() => {
    //     getState(101);
        addRow();
    });

    $(document).ready(() =>{
        let pincode = $("#pincode").val();
        let postofcValue = $("#delivery_address_id_value").val();
      $.ajax({
            url: '<?= base_url('getAddressByPincode') ?>',
            method: 'post',
            data: {
                'pincode': pincode,
                'postofcValue': postofcValue

            },
            success: function(data) {
                let result = JSON.parse(data);
                let deliveryAdd = "";
                let post_office_html = "";
                if (result.status == '1') {
                    var postocename ='';
                    result.result.forEach((element) => {
                        if(element.Id == postofcValue){
                            postocename =element.OfficeName;
                        }
                        deliveryAdd = "<b>State</b> : " + element.StateName + " , <b>District</b> :" + element.District + ", <b>City</b>:" + element.DivisionName + ", <b>Pincode</b>:" + element.Pincode + " ,<b>Post Office</b>:" + postocename;
                    });
                    $("#delivery_address_by_pincode").html(deliveryAdd);
                    $("#postofficeList").html(postocename);

                }else{
                $("#delivery_address_by_pincode").html('');
                    $("#postofficeList").html('');
                }
                // $('#finance_state').html(data)
            }
        })
    
    });



 
  
   
    function update_price() {
        mrp = $('#mrp').val()
        discount = $('#discount').val()
        if (discount > 0) {
            mrp = parseFloat(mrp) - parseFloat(discount)
        }
        $('#price').val(parseFloat(mrp).toFixed(2))
    }

    function addRow() {
        var dimentiondata='<?= $quotation->dimension; ?>';
          dimentiondata = JSON.parse(dimentiondata);
         console.log(dimentiondata,'dimentiondata');
         var maxLength = Math.max(
        dimentiondata.length ? dimentiondata.length.length : 0,
        dimentiondata.height ? dimentiondata.height.length : 0,
        dimentiondata.width ? dimentiondata.width.length : 0,
        dimentiondata.weight ? dimentiondata.weight.length : 0,
        dimentiondata.amt ? dimentiondata.amt.length : 0
    );
        var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
        for (var i = 0; i < maxLength; i++) {
        var newRow = table.insertRow(table.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);

        cell1.innerHTML = table.rows.length; 
    //   $('#length_unit_'+i).val(dimentiondata.length_unit[i]);

      var length = '<select name="dimension[length_unit][]" class="unitDropdown" disabled>';
      length += '<?= dimension_unit_html() ?>'; // This PHP function generates the options
      length += '</select>';
        // Set the value of the select element
        length = length.replace('value="' + dimentiondata.length_unit[i] + '"', 'value="' + dimentiondata.length_unit[i] + '" selected');

        var height = '<select name="dimension[height_unit][]" class="unitDropdown" disabled>';
        height += '<?= dimension_unit_html() ?>'; // This PHP function generates the options
        height += '</select>';
        // Set the value of the select element
        height = height.replace('value="' + dimentiondata.height_unit[i] + '"', 'value="' + dimentiondata.height_unit[i] + '" selected');

        var width = '<select name="dimension[width_unit][]" class="unitDropdown" disabled>';
        width += '<?= dimension_unit_html() ?>'; // This PHP function generates the options
        width += '</select>';
        // Set the value of the select element
        width = width.replace('value="' + dimentiondata.width_unit[i] + '"', 'value="' + dimentiondata.width_unit[i] + '" selected');

        var weight = '<select name="dimension[weight_unit][]" class="unitDropdown" disabled>';
        weight += '<?= weight_unit_html() ?>'; // This PHP function generates the options
        weight += '</select>';
        // Set the value of the select element
        weight = weight.replace('value="' + dimentiondata.weight_unit[i] + '"', 'value="' + dimentiondata.weight_unit[i] + '" selected');
        cell2.innerHTML = `<input type="text" name="dimension[length][]" class="form-control" id="length" placeholder="length" style="width:70px;float:left;margin-right: 5px;" value="`+dimentiondata.length[i]+`" readonly>` +`<span>`+dimentiondata.length_unit[i]+`</span>` ;
        cell4.innerHTML = `<input type="text" name="dimension[height][]" class="form-control" id="height" placeholder="height" style="width:70px;float:left;margin-right: 5px;" value="`+dimentiondata.height[i]+`" readonly>`+`<span>`+dimentiondata.height_unit[i]+`</span>` ;
        cell3.innerHTML = `<input type="text" name="dimension[width][]" class="form-control" id="width" placeholder="width" style="width:70px;float:left;margin-right: 5px;" value="`+dimentiondata.width[i]+`" readonly>` +`<span>`+dimentiondata.width_unit[i]+`</span>` ;
        cell5.innerHTML = `<input type="text" name="dimension[weight][]" value="`+dimentiondata.weight[i]+`" class="form-control" id="weight" placeholder="Weight" style="width:70px;float:left;margin-right: 5px;" readonly>`+`<span>`+dimentiondata.weight_unit[i]+`</span>` ;
        cell6.innerHTML = `<input type="number" name="dimension[amt][]" value="`+ (dimentiondata.amt && dimentiondata.amt[i] !== undefined ? dimentiondata.amt[i] : '') +`" class="form-control amountDimention" id="amt" style="width:95px;float:left;" readonly>`;
       
    }
    }

    

    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }


    
function numberToWords(num) {
    const units = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    const teens = ['', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    const tens = ['', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function convertHundred(num) {
        if (num >= 100) {
            return units[Math.floor(num / 100)] + ' hundred ' + convertTen(num % 100);
        } else {
            return convertTen(num);
        }
    }

    function convertTen(num) {
        if (num < 10) return units[num];
        if (num >= 11 && num <= 19) return teens[num - 10];
        const ten = Math.floor(num / 10);
        const rest = num % 10;
        return tens[ten] + ' ' + units[rest];
    }

    if (num === 0) return 'zero';

    let result = '';
    if (num < 0) {
        result = 'minus ';
        num = Math.abs(num);
    }

    if (num >= 1000000) {
        result += convertHundred(Math.floor(num / 1000000)) + ' million ';
        num %= 1000000;
    }

    if (num >= 1000) {
        result += convertHundred(Math.floor(num / 1000)) + ' thousand ';
        num %= 1000;
    }

    result += convertHundred(num);

    return result.trim();
}

 
</script>
<?= $this->endSection(); ?>