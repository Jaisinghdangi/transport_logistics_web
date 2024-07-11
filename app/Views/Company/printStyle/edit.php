<?= $this->extend('Company/layout'); ?>

<?= $this->section('content'); ?> 
<?php $errors = [];
if(session()->has('errors')){
    $errors = session()->get('errors');
} ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<style>
    /* Hide the default checkbox */
    .switch input {
        display: none;
    }

    /* Style the switch */
    .switch label {
        display: inline-block;
        width: 60px;
        height: 34px;
        background-color: #ccc;
        border-radius: 17px;
        position: relative;
    }

    /* Style the switch handle */
    .switch label::after {
        content: '';
        position: absolute;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: white;
        top: 4px;
        left: 4px;
        transition: left 0.3s;
    }

    /* Move the handle when the checkbox is checked */
    .switch input:checked+label::after {
        left: 30px;
    }

    /* Change background color when the switch is on */
    .switch input:checked+label {
        background-color: #2196F3;
    }

    .validationResult {
        color: red;
    }
    .ck-editor__editable[role="textbox"] {
                /* Editing area */
                min-height: 200px;
            }
</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <?= $this->include('Includes/Message'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= base_url('/company/print-style-master'); ?>">Print Style Master</a>
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
                              Add  Print Style                                   
                                  
                                </h5>
                            </div>
                          
                        </div>
                        <form method="POST">
                            <div class="card-body"> 
                                <div class="row">
                                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="print_type" class="form-label">Print Page Type <span class="text-danger">*</span></label>
                                        <select name="print_type" id="print_type" class="form-control" required >
                                                <option value="">Select Print Page Type</option>
                                                <option value="quotation" <?= ($printstyle->print_type == 'quotation') ? 'selected' : ''; ?>>Quotation</option>
                                                <option value="challan" <?= ($printstyle->print_type == 'challan') ? 'selected' : ''; ?>>Challan</option>
                                                <option value="invoice" <?= ($printstyle->print_type == 'invoice') ? 'selected' : ''; ?>>invoice</option>

                                        </select>
                                        
                                    </div>
                                    <br> <br>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="bg_color" class="form-label">Background Color<span class="text-danger">*</span></label>
                                        <input type="color" name="bg_color" id="bg_color" required class="form-control" value=
                                        "<?= $printstyle->bg_color; ?>">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="text_color" class="form-label">Text Color<span class="text-danger">*</span></label>
                                        <input type="color" name="text_color" id="text_color" required class="form-control" value=
                                        "<?= $printstyle->text_color; ?>">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4"> 
                                        <label for="text_font" class="form-label">Text Font<span class="text-danger">*</span></label>
                                        <input type="text" name="text_font" id="text_font" required class="form-control" placeholder="enter define or varified text font" value=
                                        "<?= $printstyle->text_font; ?>">
                                    </div>
                                    <input type="hidden" name="comp_id" value="<?= session()->get('CompId');?>" id="comp_id" />
                                </div>

                              
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <button type="submit" id="submit_btn" class="btn btn-primary btn-sm" value="Submit" >Submit</button>
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

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>   

    <script>
    $(document).on("change", "#print_type", function() {
        var series_types =  $(this).val();
        var terms = <?php echo json_encode($printstyle1); ?>;
        for (var i = 0; i < terms.length; i++) {
         if(terms[i].print_type == series_types){
     alert('this print Types alredy exist, choose another');
            $(this).val('');
         }
        }
    });
</script>
<?= $this->endSection(); ?>