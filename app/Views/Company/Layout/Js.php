<script src="<?= base_url('admin/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('admin/js/popper.min.js') ?>"></script>
<script src="<?= base_url('admin/js/bootstrap.min.js') ?>"></script> 
<script src="<?= base_url(); ?>Assets/Js/adminlte.js"></script> 


<script src="<?= base_url('admin/js/overlayscrollbars.browser.es6.min.js') ?>"></script>
<script src="<?= base_url('admin/js/Sortable.min.js') ?>"></script> 


<script src="<?= base_url('admin/js/apexcharts.min.js') ?>"></script> 
<script src="<?= base_url('admin/js/jsvectormap.min.js') ?>"></script> 
<script src="<?= base_url('admin/js/world.js') ?>"></script> 

<!-- datatable -->
<script src="<?= base_url('admin/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('admin/datatables/dataTables.min.js') ?>"></script>


<!-- apexcharts -->


<!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>  -->

<script type="text/javascript"> 
$(document).ready(function(){
    $(".select2").select2();
     
    setTimeout(() => {
        $('.alert').hide(2000)
    }, 5000);
    
})
</script>