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
        padding-top: 8px;
        padding-bottom: 8px;

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
</style>
<?php $errors = [];
if (session()->has('errors')) {
    $errors = session()->get('errors');
} ?>
 
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="header-title text-primary">
                                    New Quotation
                                </h5>
                            </div>
                            <a href="<?= base_url('company/quotation'); ?>" class="btn btn-primary btn-sm float-end">
                                <i class="bi bi-table"></i> Report
                            </a>
                        </div>
                        <form action="<?= base_url('save-quotation') ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                <div class="row" id="refreshconsignor">

                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                        <label for="name" class="form-label">Quotation No<span class="text-danger">*</span></label>
                                        <input type="text" name="quotation_number" class="form-control" id="quotation_number" value="<?= getVoucherNumber('Quotation') ?>" readonly>
                                        <?php if (array_key_exists('quotation_number', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['quotation_number'];  ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                        <label for="name" class="form-label">Quotation Date<span class="text-danger">*</span></label>
                                        <input type="date" name="quotation_date" class="form-control" id="quotation_date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>">
                                        <?php if (array_key_exists('quotation_date', $errors)) : ?>
                                            <div class="text-danger"> <?= $errors['quotation_date'];  ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <?php
                                    echo render_view('Components/countries', ['data' => $consignor, 'required' => true, 'label' => 'Consignor', 'name' => 'consignor', 'error' => array_key_exists('consignor', $errors) ? $errors['consignor'] : '', 'value' => '', 'classes' => 'select2','addbutton'=>'yes']);
                                    ?>

                                  
                             </div>

                                    <div class="row mt-3">
                                        <h4>From Address</h4>
                                        <?php
                                        echo render_view('Components/countries', ['data' => $countries, 'required' => true, 'label' => 'Country', 'name' => 'country', 'error' => array_key_exists('country', $errors) ? $errors['country'] : '', 'value' => 101, 'classes' => 'select2']);
                                        ?>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                                            <select name="state_id" id="state_id" class="form-control" required>
                                                <option value="">Select State</option>
                                            </select>
                                            <?php if (array_key_exists('state_id', $errors)) : ?>
                                                <div class="text-danger"> <?= $errors['state_id'];  ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                            <select name="district" id="district" class="form-control" required>
                                                <option value="">Select District</option>
                                            </select>
                                            <?php if (array_key_exists('district', $errors)) : ?>
                                                <div class="text-danger"> <?= $errors['district'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Consignor Local Address <small class="text-danger">*</small></label>
                                            <textarea name="consignor_local_address" class="form-control" id="consignor_local_address" placeholder="Consignor Local Address" required></textarea>
                                            <?php if (array_key_exists('consignor_local_address', $errors)) : ?>
                                                <div class="text-danger"> <?= $errors['consignor_local_address'];  ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <h4>Delivery Address</h4>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                                            <input type="text" id="pincode" name="pincode" onchange="getPincodeAddress()" class="form-control" placeholder="Search by Pincode" required />
                                            <?php if (array_key_exists('pincode', $errors)) : ?>
                                                <div class="text-danger"> <?= $errors['pincode'];  ?></div>
                                            <?php endif; ?>
                                            
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4" id="pinmodel"  style="width:8%;display:none;"><br>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" id="openpinmodel">+</a>

                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <label for="delivery_address_id" class="form-label">Post Office <span class="text-danger">*</span></label>
                                            <select id="postofficeList" name="delivery_address_id" class="form-control select2" required>
                                            </select>
                                            <?php if (array_key_exists('delivery_address_id', $errors)) : ?>
                                                <div class="text-danger"> <?= $errors['delivery_address_id'];  ?></div>
                                            <?php endif; ?>
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
                                            <textarea name="local_delivery_address" id="local_delivery_address" class="form-control" placeholder="Full Address" required></textarea>
                                            <?php if (array_key_exists('local_delivery_address', $errors)) : ?>
                                                <div class="text-danger"> <?= $errors['local_delivery_address'];  ?></div>
                                            <?php endif; ?>
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

                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <!-- Dynamic rows will be added here -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mt-3">  
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                            <label for="name" class="form-label">Estimate amount (Rs.)<span class="text-danger">*</span></label>
                                            <input type="number" name="amount" class="form-control" id="amount" value="" readonly>
                                        </div> 
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                                            <label for="name" class="form-label">Amount in Words<span class="text-danger">*</span></label><br>
                                            <span id="inwords" style="font-weight:bold;"></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 d-none">
                                            <label for="estmate_deliv_dt" class="form-label">Estimate Delivery Date<span class="text-danger">*</span></label><br>
                                            <input type="date" name="estmate_deliv_dt" id="estmate_deliv_dt" class="form-control">
                                        </div>
                                        
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <label for="name" class="form-label">Remark <span class="text-danger">*</span></label>
                                            <textarea name="remark" class="form-control" id="remark" placeholder="remark"></textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Submit" />
                                        <input type="reset" class="btn btn-danger btn-sm" />
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
<div class="modal fade" id="modalnewmy">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Consignor</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-body">
                    <form action="#" method="POST" id="consignor-form">
                    <div class="card-body">
    <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="consignorname" class="form-label">Consignor Name <span class="text-danger">*</span></label>
                
                <input type="text"  name="name" id="consignorname" class="form-control" required >

            </div>

            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="consignorNo" class="form-label">Mobile No. <span class="text-danger">*</span></label>
                <input type="number"  name="mobile" id="consignorNo" class="form-control" required>

                
            </div>
          
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="consignoremail" class="form-label">E-mail <span class="text-danger">*</span></label>
            
                <input type="email"  name="email" id="consignoremail" class="form-control" required>

            </div>
            
            
        </div>
        <div class="row">
        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="consigne_country" class="form-label">Country <span class="text-danger">*</span></label>
                <select name="consigne_country" id="consigne_country" class="form-control" required>
        <option value="">Select Country</option>
            <?php if(isset($countries) && !empty($countries)): ?>
                <?php foreach ($countries as $data_key => $data_value): ?>
                    <option value="<?= $data_value->id ?>"
            <?php if(isset($data_value)){ echo $data_value->id == '101' ? 'selected' : '';} ?>
                    ><?= $data_value->name ;?></option>
                <?php endforeach; ?>
            <?php endif; ?> 
    </select> 
               
            </div>

            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="consigne_state" class="form-label">State <span class="text-danger">*</span></label>
                <select name="consigne_state" id="consigne_state" class="form-control" required>
                    <option value="">Select State</option>
                </select>
               
            </div>

            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="consigne_district" class="form-label">District <span class="text-danger">*</span></label>
                <select name="consigne_district" id="consigne_district" class="form-control" required>
                    <option value="">Select District</option>
                </select>
                
            </div>
          
            
           
           
        </div>
    </div>
<div class="card-footer">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
            <input type="submit" class="btn btn-primary btn-sm" form="consignor-form" value="Submit" id="addconsignor"/>
            <input type="reset" class="btn btn-danger btn-sm" />
        </div>
    </div>
</div>
</form>
                        </div>
                      
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Pincode</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                          </div>
                        <div class="row">
                        <form action="<?//= base_url('company/save-pincode') ?>#" method="POST" id="create-form">
<div class="card-body">
    <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="pinstate_id" class="form-label">State <span class="text-danger">*</span></label>
                <select name="pinstate_id" id="pinstate_id" class="form-control" required>
                    <option value="">Select State</option>
                </select>
               
            </div>

            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="pindistrict" class="form-label">District <span class="text-danger">*</span></label>
                <select name="pindistrict" id="pindistrict" class="form-control" required>
                    <option value="">Select District</option>
                </select>
                
            </div>
          
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                <!-- <input type="text"  name="city" id="city" class="form-control" required> -->
                <select name="city" id="city" class="form-control" required>
                    <option value="">Select City</option>
                </select>
                
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="Pincode" class="form-label">Pincode<span class="text-danger">*</span></label>
                <input type="number"  name="Pincode" id="Pincode" class="form-control" required readonly>
              
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                <label for="postofc" class="form-label">Post Office  <span class="text-danger">*</span></label>
                <input type="text"  name="postofc" id="postofc" class="form-control" required>
              
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
            <input type="submit" class="btn btn-primary btn-sm" value="Submit" id="onsubmit" data-dismiss="modal"/>
            <!-- <button class="btn btn-primary" form="create-form" type="submit"><i class="fa fa-save"></i> Save Details</button> -->

            <input type="reset" class="btn btn-danger btn-sm" />
        </div>
    </div>
</div>
</form>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>

$('#district').change(function() {
    
        var country = $('#country option:selected').text();
        var state_id = $('#state_id option:selected').text();
        var district = $('#district option:selected').text();
var consignorLocalAdd = district +' , '+ state_id + ' , ' + country;
// console.log(consignorLocalAdd);
 $('#consignor_local_address').val(consignorLocalAdd);
});


// $('#consignor').change(function() {
    
//     var country = $('#country option:selected').text();
//     var state_id = $('#state_id option:selected').text();
//     var district = $('#district option:selected').text();
// var consignorLocalAdd = district +' , '+ state_id + ' , ' + country;
// // console.log(consignorLocalAdd);
// $('#consignor_local_address').val(consignorLocalAdd);
// });



$("#consignor-form").submit(function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    $.ajax({
        url: '<?= base_url() ?>company/save-consignor',
        method: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#addconsignor').attr('disabled', 'disabled');

        },
        success: function(data) {
            res = JSON.parse(data);
            console.log('check',res);
             $('.modal').find('.close').click();
             $("#modalnewmy").modal('hide');
             $("#refreshconsignor").load(location.href + " #refreshconsignor", function() {
        $('#consignor').val(res.result.id);
        getNewconsigneState(res.result.id);
        getNewconsigneDistrict(res.result.id);
    });

        
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText,'error accured');
        }
    });
});

// $(document).ready(function() {
 
    $('#remark').on('input', function() {
        var inputText = $(this).val().toLowerCase();
        var words = inputText.split(' ');
        var capitalizedWords = words.map(function(word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        });
        var capitalizedText = capitalizedWords.join(' ');
        $(this).val(capitalizedText);
    });
// });
    function convertNumberToWords(number) {
    var decimal = Math.round((number - Math.floor(number)) * 100);
    var words = {
        0: '', 1: 'One', 2: 'Two', 3: 'Three', 4: 'Four', 5: 'Five', 6: 'Six', 7: 'Seven', 8: 'Eight', 9: 'Nine',
        10: 'Ten', 11: 'Eleven', 12: 'Twelve', 13: 'Thirteen', 14: 'Fourteen', 15: 'Fifteen', 16: 'Sixteen', 17: 'Seventeen', 18: 'Eighteen', 19: 'Nineteen',
        20: 'Twenty', 30: 'Thirty', 40: 'Forty', 50: 'Fifty', 60: 'Sixty', 70: 'Seventy', 80: 'Eighty', 90: 'Ninety'
    };
    var digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];
    var str = [];
    var i = 0;
    while (number > 0) {
        var divider = (i === 2) ? 10 : 100;
        var num = Math.floor(number % divider);
        number = Math.floor(number / divider);
        i += (divider === 10) ? 1 : 2;
        if (num) {
            var plural = (str.length && num > 9) ? 's' : '';
            var hundred = (str.length === 1 && str[0]) ? ' and ' : '';
            str.push((num < 21) ? words[num] + ' ' + digits[str.length] + plural + ' ' + hundred :
                words[Math.floor(num / 10) * 10] + ' ' + words[num % 10] + ' ' + digits[str.length] + plural + ' ' + hundred);
        } else {
            str.push('');
        }
    }
    var Rupees = str.reverse().join('');
    var paise = (decimal > 0) ? '. ' + (words[Math.floor(decimal / 10) * 10] + ' ' + words[decimal % 10]) + ' Paise' : '';
    return (Rupees ? Rupees + ' Rupees ' : '') + paise;
}


        $('#amount').on('keyup', function() {
            var amount = $(this).val();
            words= convertNumberToWords(amount);
            $('#inwords').text(words);
        });



    $(document).on("click", "#openpinmodel", function() {
        var Pincode  =    $('#pincode').val();
     $('#Pincode').val(Pincode);
    })


 $(document).on("click", "#onsubmit", function() {
     var pinstate_id  =    $('#pinstate_id').val();
     var pindistrict  =    $('#pindistrict').val();
     var Pincode  =    $('#pincode').val();
     var city  =    $('#city').val();
     var postofc  =    $('#postofc').val();
     $.ajax({
            url: '<?= base_url('save_pincode') ?>',
            method: 'post',
            data: {
                'pinstate_id' : pinstate_id,
                'pindistrict' : pindistrict,
                'Pincode' : Pincode,
                'city' : city,
                'postofc' : postofc,   },
            success: function(data) {
                  var res = JSON.parse(data);
            //   console.log(res.result,'data');
              deliveryAdd = "<b>State</b> : " + res.result.StateName + " , <b>District</b> :" + res.result.District + ", <b>City</b>:" + res.result.DivisionName + ", <b>Pincode</b>:" + res.result.Pincode + " ,<b>Post Office</b>:" + res.result.OfficeName;
              $("#delivery_address_by_pincode").html(deliveryAdd);
              $('#pincode').val(res.result.Pincode);
     if(res.result.Pincode){
        $('#pinmodel').hide();

        let pincode = res.result.Pincode;
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
                        post_office_html += `<option value=` + element.Id + ` selected>` + element.OfficeName + `</option>`;
                    });
                    $("#postofficeList").html(post_office_html);
                }
            }
        })
}      
 }
          });

        

});
function getNewconsigneState(consignor) {
     $.ajax({
            url: '<?= base_url('get_consinor_states') ?>',
            method: 'post',
            data: {
                'consignor' : consignor,
            },
            success: function(data) {
                $('#state_id').html(data)
            }
        })
};

function getNewconsigneDistrict(consignor) {
    $.ajax({
            url: '<?= base_url('get_consinor_disctrict') ?>',
            method: 'post',
            data: {
                'consignor' : consignor,
            },
            success: function(data) {
                console.log(data);
                $('#district').html(data)
            }
        })
}

$(document).on("change", "#consignor", function() {
        var consignor =  $(this).val();
     $.ajax({
            url: '<?= base_url('get_consinor_states') ?>',
            method: 'post',
            data: {
                'consignor' : consignor,
            },
            success: function(data) {
                // console.log(data);
                $('#state_id').html(data)
            }
        })
    });

    $(document).on("change", "#consignor", function() {
        var consignor =  $(this).val();
     $.ajax({
            url: '<?= base_url('get_consinor_disctrict') ?>',
            method: 'post',
            data: {
                'consignor' : consignor,
            },
            success: function(data) {
                // console.log(data);

                $('#district').html(data)
                 
    var country = $('#country option:selected').text();
    var state_id = $('#state_id option:selected').text();
    var district = $('#district option:selected').text();
var consignorLocalAdd = district +' , '+ state_id + ' , ' + country;
// console.log(consignorLocalAdd);
$('#consignor_local_address').val(consignorLocalAdd);
            }
        })
    });


    $(document).ready(() => {
        getconsigneState(101);
    });
    $('#consigne_country').change(function() {
              let country_id = parseInt($(this).val());
              $.ajax({
            url: '<?= base_url('get-states') ?>',
            method: 'post',
            data: {
                'country_id': country_id
            },
            success: function(data) {
                console.log(data);

                $('#consigne_state').html(data);
            }
        })


    });
    function getconsigneState(country_id) {
        $.ajax({
            url: '<?= base_url('get-states') ?>',
            method: 'post',
            data: {
                'country_id': country_id
            },
            success: function(data) {
                console.log(data);

                $('#consigne_state').html(data);
            }
        })
    }
    $('#consigne_state').change(function() {
        $.ajax({
            url: '<?= base_url('get-districts') ?>',
            method: 'post',
            data: {
                'state_id': parseInt($(this).val())
            },
            success: function(data) {
                $('#consigne_district').html(data)
            }
        })
    })

    $(document).ready(() => {
        getPinState(101);
    });
    
    function getPinState(country_id) {
        $.ajax({
            url: '<?= base_url('get-pinstates') ?>',
            method: 'post',
            data: {
                'country_id': country_id
            },
            success: function(data) {
                console.log(data);

                $('#pinstate_id').html(data)
            }
        })
    }
    $('#pinstate_id').change(function() {
        $.ajax({
            url: '<?= base_url('get-districts') ?>',
            method: 'post',
            data: {
                'state_name': $(this).val()
            },
            success: function(data) {
                $('#pindistrict').html(data)
            }
        })
    })

    $('#pindistrict').change(function() {
        $.ajax({
            url: '<?= base_url('get-cities') ?>',
            method: 'post',
            data: {
                'District': $(this).val()
            },
            success: function(data) {
                $('#city').html(data)
            }
        })
    })


    $(document).ready(() => {
        getState(101);
        addRow();
    });
    function getPincodeAddress() {
        let pincode = $("#pincode").val();
        if(pincode.length <= 5){
            alert('Insert minimum 6 Number Pincode to search Address');
            $('#pinmodel').hide();

        }else if(pincode.length >= 7){
            alert('Insert Maximum 6 Number Pincode to search Address');
            $('#pinmodel').hide();
        }else{
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
                if (result.status == '1') {
                    result.result.forEach((element) => {
                        post_office_html += `<option value=` + element.Id + ` >` + element.OfficeName + `</option>`;
                        deliveryAdd = "<b>State</b> : " + element.StateName + " , <b>District</b> :" + element.District + ", <b>City</b>:" + element.DivisionName + ", <b>Pincode</b>:" + element.Pincode;
                    });
                    console.log(deliveryAdd, 'data');
                    $("#delivery_address_by_pincode").html(deliveryAdd);
                    $("#postofficeList").html(post_office_html);
                    $('#pinmodel').hide();

                }else{
                $('#pinmodel').show();
                $("#delivery_address_by_pincode").html('');
                    $("#postofficeList").html('');
                }
                // $('#finance_state').html(data)
            }
        })
    }
    }
    $("#postofficeList").change(function() {
        $.ajax({
            url: '<?= base_url('getAddressByPincodePost') ?>',
            method: 'post',
            data: {
                'postoffice_id': $(this).val()
            },
            success: function(data) {
                let result = JSON.parse(data);
                let deliveryAdd = "";
                let localDeliveryAdd = "";
                if (result.status) {
                    result.result.forEach((element) => {
                        deliveryAdd = "<b>State</b> : " + element.StateName + " , <b>District</b> :" + element.District + ", <b>City</b>:" + element.DivisionName + ", <b>Pincode</b>:" + element.Pincode + " ,<b>Post Office</b>:" + element.OfficeName;
                         localDeliveryAdd = element.OfficeName +' , '+ element.DivisionName +' , '+ element.Pincode +' , '+ element.District +' , '+ element.StateName ;
                    });
                    // console.log(deliveryAdd, 'data');
                    $("#delivery_address_by_pincode").html(deliveryAdd);
                    $("#local_delivery_address").val(localDeliveryAdd);


                }
                // $('#finance_state').html(data)
            }
        })
    });
    $('#country').change(function() {
        let country_id = $(this).val();
        getState(country_id);
        $('#district').val('');

    })

    function getState(country_id) {
        $.ajax({
            url: '<?= base_url('get-states') ?>',
            method: 'post',
            data: {
                'country_id': country_id
            },
            success: function(data) {
                console.log(data);

                $('#state_id').html(data)
            }
        })
    }


    $('#state_id').change(function() {
        $.ajax({
            url: '<?= base_url('get-districts') ?>',
            method: 'post',
            data: {
                'state_id': $(this).val()
            },
            success: function(data) {
                $('#district').html(data)
            }
        })
    })

    $('#driver_state').change(function() {
        $.ajax({
            url: '<?= base_url('admin/get-districts') ?>',
            method: 'post',
            data: {
                'state_id': $(this).val()
            },
            success: function(data) {
                $('#driver_district').html(data)
            }
        })
    })

    function update_price() {
        mrp = $('#mrp').val()
        discount = $('#discount').val()
        if (discount > 0) {
            mrp = parseFloat(mrp) - parseFloat(discount)
        }
        $('#price').val(parseFloat(mrp).toFixed(2))
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
        var cell7 = newRow.insertCell(6);

        cell1.innerHTML = table.rows.length; 
        cell2.innerHTML = `<input type="text" name="dimension[length][]" class="form-control" id="length" placeholder="length" style="width:70px;float:left;margin-right: 5px;" required><select name="dimension[length_unit][]" style="width:45%;" class="unitDropdown" required >'<?= dimension_unit_html() ?>'</select>`;
        cell4.innerHTML = `<input type="text" name="dimension[height][]" class="form-control" id="height" placeholder="height" style="width:70px;float:left;margin-right: 5px;" required> <select name="dimension[height_unit][]" style="width: 45%;" class="unitDropdown" required >'<?= dimension_unit_html() ?>'</select>`;
        cell3.innerHTML = `<input type="text" name="dimension[width][]" class="form-control" id="width" placeholder="width" style="width:70px;float:left;margin-right: 5px;" required> <select name="dimension[width_unit][]" style="width:45%;" class="unitDropdown" required >'<?= dimension_unit_html() ?>'</select>`;
        cell5.innerHTML = `<input type="text" name="dimension[weight][]" class="form-control" id="weight" placeholder="Weight" style="width:70px;float:left;margin-right: 5px;" required><select name="dimension[weight_unit][]" style="width:45%;" class="unitDropdown" required >'<?= weight_unit_html() ?>'</select>`;
        cell6.innerHTML = `<input type="number" name="dimension[amt][]" class="form-control amountDimention" id="amt" placeholder="Amount" style="width:95px;float:left;" required>`;


        if (table.rows.length == 1) {
            cell7.innerHTML += "<button type='button' class='add-btn addcls' onclick='addRow()'>Add</button>";
        } else {
            cell7.innerHTML += "<button class='remove-btn' onclick='removeRow(this)'>Remove</button>";
        }
    }



    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateTotal();

    }


    // $(document).ready(function() {
            function updateTotal() {
                let total = 0;
                $('.amountDimention').each(function() {
                    let value = parseFloat($(this).val());
                    if (!isNaN(value)) {
                        total += value;
                    }
                });
                $('input[name="amount"]').val(total);
                words= convertNumberToWords(total);
                 $('#inwords').text(words);            
        }

            // Bind the change event to all amountDimention inputs
            $(document).on('input', '.amountDimention', function() {
                updateTotal();
            });
        // });

    
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