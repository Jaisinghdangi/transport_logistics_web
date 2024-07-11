<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// auth routes 
// $routes->get('/', 'Auth::index'); 
$routes->get('/', function () {
    if (session()->has('user_data')  && session()->get('check_employee') == 'false') {
        return redirect()->to(base_url('admin/dashboard'));
    }else if(session()->has('user_data') && session()->get('check_employee') == 'true'){
        return redirect()->to(base_url('company/dashboard'));
    } else {
        return view('Auth/SignIn');
    }
});
// login and forget password route
$routes->post('login', 'Auth::SignIn');
$routes->get('ForgotPassword', 'Auth::ForgotPassword');
$routes->post('ForgotPassword', 'Auth::check_email');
$routes->get('set-password', 'Auth::view_form');
$routes->post('set-password', 'Auth::change_password');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashbordController::index');
    // permissions master routes
    $routes->get('permissions', 'PermissionsController::index');
    $routes->get('add-permissions', 'PermissionsController::create');
    $routes->post('store-permissions', 'PermissionsController::store');
    $routes->get('permissions/(:num)', 'PermissionsController::edit/$1');
    $routes->post('permissions/(:num)', 'PermissionsController::update/$1');
    $routes->get('delete-permissions/(:num)', 'PermissionsController::delete/$1');

    // role master route
    $routes->get('roles', 'RolesController::index');
    $routes->get('add-roles', 'RolesController::create');
    $routes->post('store-roles', 'RolesController::store');
    $routes->get('roles/(:num)', 'RolesController::edit/$1');
    $routes->post('roles/(:num)', 'RolesController::update/$1');
    $routes->get('delete-roles/(:num)', 'RolesController::delete/$1');

    // role has permission route
    $routes->get('role-has-permission', 'RoleHasPermissionController::index');
    $routes->get('role-has-permission/(:num)', 'RoleHasPermissionController::edit/$1');
    $routes->post('role-has-permission/(:num)', 'RoleHasPermissionController::update/$1');

    // users Route here
    $routes->get('users', 'Admin\UsersController::index');
    $routes->get('add-users', 'Admin\UsersController::create');
    $routes->post('store-users', 'Admin\UsersController::store');
    $routes->get('users/(:num)', 'Admin\UsersController::edit/$1');
    $routes->post('users/(:num)', 'Admin\UsersController::update/$1');
    $routes->get('delete-users/(:num)', 'Admin\UsersController::delete/$1');
    // change user address 
    $routes->get('user-status/(:num)', 'Admin\UsersController::change_status/$1');
    $routes->get('user-login/(:num)', 'Admin\UsersController::user_login/$1');

    // my-profile route here
    $routes->get('my-profile', 'Admin\DashbordController::my_profile');
    $routes->post('my-profile', 'Admin\DashbordController::update_profile');
    $routes->post('change-password', 'Admin\DashbordController::change_password');
    // set Financial Year 
    $routes->get('set-finance-year/(:num)', 'Admin\DashbordController::change_financial_year/$1');

    // FinancialYears routes here
    $routes->get('FinancialYears', 'Admin\FinancialYearsController::index');
    $routes->get('Add-FinancialYears', 'Admin\FinancialYearsController::Add');
    $routes->post('Add-FinancialYears', 'Admin\FinancialYearsController::Store');
    $routes->get('status-FinancialYears/(:num)', 'Admin\FinancialYearsController::status/$1');
    $routes->get('Edit-FinancialYears/(:num)', 'Admin\FinancialYearsController::Edit/$1');
    $routes->post('Edit-FinancialYears/(:num)', 'Admin\FinancialYearsController::Update/$1');
    $routes->get('Delete-FinancialYears/(:num)', 'Admin\FinancialYearsController::Delete/$1');
    $routes->get('Default-FinancialYears/(:num)', 'Admin\FinancialYearsController::Default/$1');


    // payment mode routes here
    $routes->get('payment-mode', 'Admin\PaymentModeController::index');
    $routes->get('add-payment-mode', 'Admin\PaymentModeController::add');
    $routes->post('add-payment-mode', 'Admin\PaymentModeController::store');
    $routes->get('status-payment-mode/(:num)', 'Admin\PaymentModeController::status/$1');
    $routes->get('edit-payment-mode/(:num)', 'Admin\PaymentModeController::edit/$1');
    $routes->post('edit-payment-mode/(:num)', 'Admin\PaymentModeController::update/$1');
    $routes->get('delete-payment-mode/(:num)', 'Admin\PaymentModeController::delete/$1');

    // texes routes here
    $routes->get('tax', 'Admin\TaxController::index');
    $routes->get('add-tax', 'Admin\TaxController::add');
    $routes->post('add-tax', 'Admin\TaxController::store');
    $routes->get('status-tax/(:num)', 'Admin\TaxController::status/$1');
    $routes->get('edit-tax/(:num)', 'Admin\TaxController::edit/$1');
    $routes->post('edit-tax/(:num)', 'Admin\TaxController::update/$1');
    $routes->get('delete-tax/(:num)', 'Admin\TaxController::delete/$1');

    // Units routes here
    $routes->get('units', 'Admin\UnitController::index');
    $routes->get('add-units', 'Admin\UnitController::add');
    $routes->post('add-units', 'Admin\UnitController::store');
    $routes->get('status-units/(:num)', 'Admin\UnitController::status/$1');
    $routes->get('edit-units/(:num)', 'Admin\UnitController::edit/$1');
    $routes->post('edit-units/(:num)', 'Admin\UnitController::update/$1');
    $routes->get('delete-units/(:num)', 'Admin\UnitController::delete/$1');

    // Companies routes here
    $routes->get('companies', 'Admin\CompanyController::index');
    $routes->get('add-company', 'Admin\CompanyController::add');
    $routes->post('add-company', 'Admin\CompanyController::store');
    $routes->get('status-company/(:num)', 'Admin\CompanyController::status/$1');
    $routes->get('edit-company/(:num)', 'Admin\CompanyController::edit/$1');
    $routes->post('edit-company/(:num)', 'Admin\CompanyController::update/$1');
    $routes->get('delete-company/(:num)', 'Admin\CompanyController::delete/$1');

    // series-type routes here
    $routes->get('series-type', 'Admin\SeriesTypeController::index');
    $routes->get('add-series-type', 'Admin\SeriesTypeController::add');
    $routes->post('add-series-type', 'Admin\SeriesTypeController::store');
    $routes->get('edit-series-type/(:num)', 'Admin\SeriesTypeController::edit/$1');
    $routes->post('edit-series-type/(:num)', 'Admin\SeriesTypeController::update/$1');
    $routes->get('delete-series-type/(:num)', 'Admin\SeriesTypeController::delete/$1');

    // Countries routes here
    $routes->get('countries', 'Admin\CountryController::index');
    $routes->get('add-country', 'Admin\CountryController::add');
    $routes->post('add-country', 'Admin\CountryController::store');
    $routes->get('status-country/(:num)', 'Admin\CountryController::status/$1');
    $routes->get('edit-country/(:num)', 'Admin\CountryController::edit/$1');
    $routes->post('edit-country/(:num)', 'Admin\CountryController::update/$1');
    $routes->get('delete-country/(:num)', 'Admin\CountryController::delete/$1');

    // state routes here
    $routes->get('states', 'Admin\StatesController::index');
    $routes->get('add-state', 'Admin\StatesController::add');
    $routes->post('add-state', 'Admin\StatesController::store');
    $routes->get('edit-state/(:num)', 'Admin\StatesController::edit/$1');
    $routes->post('edit-state/(:num)', 'Admin\StatesController::update/$1');
    $routes->get('status-state/(:num)', 'Admin\StatesController::status/$1');
    $routes->get('delete-state/(:num)', 'Admin\StatesController::delete/$1');

    // District routes here
    $routes->get('district', 'Admin\DistrictController::index');
    $routes->get('add-district', 'Admin\DistrictController::add');
    $routes->post('add-district', 'Admin\DistrictController::store');
    $routes->get('status-district/(:num)', 'Admin\DistrictController::status/$1');
    $routes->get('edit-district/(:num)', 'Admin\DistrictController::edit/$1');
    $routes->post('edit-district/(:num)', 'Admin\DistrictController::update/$1');
    $routes->get('delete-district/(:num)', 'Admin\DistrictController::delete/$1');

    // ajax routes
});
// ajax Routes
$routes->post('get-districts', 'AjaxController::get_districts');
$routes->post('get-states', 'AjaxController::get_states');
$routes->post('getAddressByPincode', 'AjaxController::getAddressByPincode');
$routes->post('getAddressByPincodePost', 'AjaxController::getAddressByPincodePost');
$routes->post('get_consinor_states', 'AjaxController::get_consinor_states');
$routes->post('get_consinor_disctrict', 'AjaxController::get_consinor_disctrict');


// company login Route here
$routes->get('company-login/(:num)', 'Auth::company_login/$1');
$routes->get('company-logout', 'Auth::company_logout');

// popup pincode add details
$routes->post('get-pinstates', 'AjaxController::get_pinstates');
$routes->post('get-cities', 'AjaxController::get_cities');
$routes->post('save_pincode', 'AjaxController::save_pincode');

////

// compnaies Routes Here
$routes->group('company', ['filter' => 'company_auth'], function ($routes) {
    $routes->get('dashboard', 'Company\Dashboard::index');


    $routes->get('permissions', 'Company\PermissionsController::index');
    $routes->get('add-permissions', 'Company\PermissionsController::create');
    $routes->post('store-permissions', 'Company\PermissionsController::store');
    $routes->get('permissions/(:num)', 'Company\PermissionsController::edit/$1');
    $routes->post('permissions/(:num)', 'Company\PermissionsController::update/$1');
    $routes->get('delete-permissions/(:num)', 'Company\PermissionsController::delete/$1');

    // role master route
    $routes->get('roles', 'Company\RolesController::index');
    $routes->get('add-roles', 'Company\RolesController::create');
    $routes->post('store-roles', 'Company\RolesController::store');
    $routes->get('roles/(:num)', 'Company\RolesController::edit/$1');
    $routes->post('roles/(:num)', 'Company\RolesController::update/$1');
    $routes->get('delete-roles/(:num)', 'Company\RolesController::delete/$1');


    $routes->get('role-has-permission', 'Company\RoleHasPermissionController::index');
    $routes->get('role-has-permission/(:num)', 'Company\RoleHasPermissionController::edit/$1');
    $routes->post('role-has-permission/(:num)', 'Company\RoleHasPermissionController::update/$1');

    $routes->get('employee', 'Company\UsersController::index');
    $routes->get('add-employee', 'Company\UsersController::create');
    $routes->post('store-employee', 'Company\UsersController::store');
    $routes->get('employee/(:num)', 'Company\UsersController::edit/$1');
    $routes->post('employee/(:num)', 'Company\UsersController::update/$1');
    $routes->get('delete-employee/(:num)', 'Company\UsersController::delete/$1');
    // change user address 
    $routes->get('employee-status/(:num)', 'Company\UsersController::change_status/$1');
    $routes->get('employee-login/(:num)', 'Company\UsersController::user_login/$1');
    // consigor routes here
    $routes->get('consignor', 'Company\Consignor::index');
    $routes->get('add-consignor', 'Company\Consignor::add');
    $routes->post('add-consignor', 'Company\Consignor::store');
    $routes->get('status-consignor/(:num)', 'Company\Consignor::status/$1');
    $routes->get('edit-consignor/(:num)', 'Company\Consignor::edit/$1');
    $routes->post('edit-consignor/(:num)', 'Company\Consignor::update/$1');
    $routes->get('view-consignor/(:num)', 'Company\Consignor::viewpage/$1');
    $routes->get('delete-consignor/(:num)', 'Company\Consignor::delete/$1');
    $routes->post('consignor-import-excel', 'Company\Consignor::import');
    $routes->get('consignor-downloadExcel', 'Company\Consignor::initiateDownload');

    // consigee routes here
    $routes->get('consignee', 'Company\Consignee::index');
    $routes->get('add-consignee', 'Company\Consignee::add');
    $routes->post('add-consignee', 'Company\Consignee::store');
    $routes->get('status-consignee/(:num)', 'Company\Consignee::status/$1');
    $routes->get('edit-consignee/(:num)', 'Company\Consignee::edit/$1');
    $routes->post('edit-consignee/(:num)', 'Company\Consignee::update/$1');
    $routes->get('view-consignee/(:num)', 'Company\Consignee::viewpage/$1');
    $routes->get('delete-consignee/(:num)', 'Company\Consignee::delete/$1');
    $routes->post('import-excel', 'Company\Consignee::import');
    $routes->get('consignee-downloadExcel', 'Company\Consignee::initiateDownload');

    // broker routes here
    $routes->get('broker', 'Company\BrokerController::index');
    $routes->get('add-broker', 'Company\BrokerController::add');
    $routes->post('add-broker', 'Company\BrokerController::store');
    $routes->get('status-broker/(:num)', 'Company\BrokerController::status/$1');
    $routes->get('edit-broker/(:num)', 'Company\BrokerController::edit/$1');
    $routes->post('edit-broker/(:num)', 'Company\BrokerController::update/$1');
    $routes->get('view-broker/(:num)', 'Company\BrokerController::viewpage/$1');
    $routes->get('delete-broker/(:num)', 'Company\BrokerController::delete/$1');
    $routes->post('brokerimport-excel', 'Company\BrokerController::import');
    $routes->get('broker-downloadExcel', 'Company\BrokerController::initiateDownload');

    // vehicles routes here
    $routes->get('vehicles', 'Company\VehicleController::index');
    $routes->get('add-vehicle', 'Company\VehicleController::add');
    $routes->post('add-vehicle', 'Company\VehicleController::store');
    $routes->get('status-vehicle/(:num)', 'Company\VehicleController::status/$1');
    $routes->get('edit-vehicle/(:num)', 'Company\VehicleController::edit/$1');
    $routes->post('edit-vehicle/(:num)', 'Company\VehicleController::update/$1');
    $routes->get('view-vehicle/(:num)', 'Company\VehicleController::viewpage/$1');
    $routes->get('delete-vehicle/(:num)', 'Company\VehicleController::delete/$1');
    $routes->post('vehicles-import-excel', 'Company\VehicleController::import');
    $routes->get('vehicles-downloadExcel', 'Company\VehicleController::initiateDownload');

    // Warehouse routes here
    $routes->get('warehouse', 'Company\WarehouseController::index');
    $routes->get('add-warehouse', 'Company\WarehouseController::add');
    $routes->post('add-warehouse', 'Company\WarehouseController::store');
    $routes->get('status-warehouse/(:num)', 'Company\WarehouseController::status/$1');
    $routes->get('edit-warehouse/(:num)', 'Company\WarehouseController::edit/$1');
    $routes->post('edit-warehouse/(:num)', 'Company\WarehouseController::update/$1');
    $routes->get('delete-warehouse/(:num)', 'Company\WarehouseController::delete/$1');

    // Products routes here
    $routes->get('products', 'Company\ProductController::index');
    $routes->get('add-product', 'Company\ProductController::add');
    $routes->post('add-product', 'Company\ProductController::store');
    $routes->get('status-product/(:num)', 'Company\ProductController::status/$1');
    $routes->get('edit-product/(:num)', 'Company\ProductController::edit/$1');
    $routes->post('edit-product/(:num)', 'Company\ProductController::update/$1');
    $routes->get('delete-product/(:num)', 'Company\ProductController::delete/$1');

    // series routes here
    $routes->get('series', 'Company\SeriesController::index');
    $routes->get('add-series', 'Company\SeriesController::add');
    $routes->post('add-series', 'Company\SeriesController::store');
    $routes->get('status-series/(:num)', 'Company\SeriesController::status/$1');
    $routes->get('edit-series/(:num)', 'Company\SeriesController::edit/$1');
    $routes->post('edit-series/(:num)', 'Company\SeriesController::update/$1');
    $routes->get('delete-series/(:num)', 'Company\SeriesController::delete/$1');

    // Quotaion routes here
    $routes->get('quotation', 'Company\QuotationController::index');
    $routes->get('add-quotation', 'Company\QuotationController::add');
    $routes->post('add-quotation', 'Company\QuotationController::add');
    $routes->get('editnew-quotation/(:num)', 'Company\QuotationController::editnew/$1');
    $routes->post('editnew-quotation/(:num)', 'Company\QuotationController::updatenew/$1');
    $routes->get('view-quotation/(:num)', 'Company\QuotationController::view/$1');
    $routes->post('save-consignor', 'Company\QuotationController::save_consignor');


    $routes->get('status-quotation/(:num)', 'Company\QuotationController::status/$1');
    $routes->get('edit-quotation/(:num)', 'Company\QuotationController::edit/$1');
    $routes->post('edit-quotation/(:num)', 'Company\QuotationController::update/$1');
    $routes->get('delete-quotation/(:num)', 'Company\QuotationController::delete/$1');
    //  $routes->post('save-pincode', 'Company\QuotationController::pincodestore');

    $routes->get('booking', 'Company\BookingController::index');
    $routes->get('add-Booking', 'Company\BookingController::add');
    $routes->post('add-Booking-vehical', 'Company\BookingController::addBookingVehical');
    $routes->get('edit-Booking', 'Company\BookingController::edit'); 
    $routes->get('view-Booking/(:num)','Company\BookingController::view/$1');
    $routes->get('view-MultiBooking/(:num)','Company\BookingController::Multiview/$1');

    $routes->get('print-Booking/(:num)','Company\BookingController::print/$1'); 
    $routes->get('booking-link-vehical', 'Company\BookingController::bookingLink'); 

    //company-consignor-number here
    $routes->get('company-consignor-number', 'Company\consignorNumber::index'); 
    $routes->get('add-company-consignor-number', 'Company\consignorNumber::add');
    $routes->post('add-company-consignor-number', 'Company\consignorNumber::store');
    $routes->get('status-company-consignor-number/(:num)', 'Company\consignorNumber::status/$1');
    $routes->get('edit-company-consignor-number/(:num)', 'Company\consignorNumber::edit/$1');
    $routes->post('edit-company-consignor-number/(:num)', 'Company\consignorNumber::update/$1');
    $routes->get('delete-company-consignor-number/(:num)', 'Company\consignorNumber::delete/$1');
    //company-terms-condition here

    $routes->get('terms-condition', 'Company\termsCondition::index'); 
    $routes->get('add-terms-condition', 'Company\termsCondition::add');
    $routes->post('add-terms-condition', 'Company\termsCondition::store');
    $routes->get('edit-terms-condition/(:num)', 'Company\termsCondition::edit/$1');
    $routes->post('edit-terms-condition/(:num)', 'Company\termsCondition::update/$1');
    $routes->get('status-terms-condition/(:num)', 'Company\termsCondition::status/$1');
    $routes->get('delete-terms-condition/(:num)', 'Company\termsCondition::delete/$1');


    ////
    $routes->get('vehical-type-master', 'Company\vehicalTypeMaster::index'); 
    $routes->get('add-vehical-type', 'Company\vehicalTypeMaster::add');
    $routes->post('add-vehical-type', 'Company\vehicalTypeMaster::store');
    $routes->get('edit-vehical-type/(:num)', 'Company\vehicalTypeMaster::edit/$1');
    $routes->post('edit-vehical-type/(:num)', 'Company\vehicalTypeMaster::update/$1');
    $routes->get('delete-vehical-type/(:num)', 'Company\vehicalTypeMaster::delete/$1');
    $routes->get('vehiclesTypeMaster-downloadExcel', 'Company\vehicalTypeMaster::initiateDownload');
    $routes->post('vehiclesTypeMaster-import-excel', 'Company\vehicalTypeMaster::import');


    //////
    $routes->get('payment-receipt', 'Company\paymentReceipt::index'); 
    $routes->post('get-invoice-list', 'Company\paymentReceipt::getInvoiceList'); 
    $routes->post('save-invoice-list', 'Company\paymentReceipt::saveInvoiceList'); 
    $routes->post('payment-statement-pdf', 'Company\paymentReceipt::paymentStatementPDF'); 

    
/////
    $routes->get('payment-challan', 'Company\paymentChallan::index'); 
    $routes->post('get-challan-list', 'Company\paymentChallan::getInvoiceList'); 
    $routes->post('save-challan-list', 'Company\paymentChallan::saveInvoiceList'); 
    $routes->post('challan-statement-pdf', 'Company\paymentChallan::challamStatementPDF'); 


///
    $routes->get('consignment-note', 'Company\consignmentNote::index'); 
    $routes->get('print-consignment-note/(:num)', 'Company\consignmentNote::printnote/$1'); 

    // booking invoice start

    $routes->get('invoices', 'Company\BookingInvoiceController::index');
    $routes->get('create-invoice/(:num)','Company\BookingInvoiceController::create/$1'); 
    $routes->get('create-multiInvoice/(:num)','Company\BookingInvoiceController::multicreate/$1'); 

    $routes->post('add-invoice','Company\BookingInvoiceController::store');
    $routes->get('print-invoice/(:num)','Company\BookingInvoiceController::print/$1'); 
    $routes->get('print-multiInvoice/(:num)','Company\BookingInvoiceController::multiprint/$1'); 

    // booking invoice end

    // challan start
    $routes->get('challan', 'Company\ChallanController::index');
    $routes->post('get-Booking-Details', 'Company\ChallanController::getBookingDetails');
    $routes->get('download-excel/(:num)', 'Company\ChallanController::downloadExcel/$1');
    $routes->post('save-Booking-Details', 'Company\ChallanController::saveBookingDetails');

    $routes->get('print-challan/(:num)', 'Company\ChallanController::print/$1'); 
    // challan end 

    // vehical traking start
    
    $routes->get('vehical-tracking', 'Company\BookingController::vehicalTracking'); 
    // vehical traking end 

    /// code prefix master start here
    $routes->get('code_prefix_master', 'Company\code_prefix::index'); 
    $routes->get('add-code_prefix', 'Company\code_prefix::add');
    $routes->post('add-code_prefix', 'Company\code_prefix::store');

     /// series setting master start here
     $routes->get('series_setting', 'Company\series_setting::index'); 
     $routes->get('add-series_setting', 'Company\series_setting::add');
     $routes->post('add-series_setting', 'Company\series_setting::store');
     $routes->get('edit-series_setting/(:num)', 'Company\series_setting::edit/$1');
     $routes->post('edit-series_setting/(:num)', 'Company\series_setting::update/$1');
//print-style-master start here

$routes->get('print-style-master', 'Company\printStyle::index'); 
$routes->get('add-print-style', 'Company\printStyle::add');
$routes->post('add-print-style', 'Company\printStyle::store');
$routes->get('edit-print-style/(:num)', 'Company\printStyle::edit/$1');
$routes->post('edit-print-style/(:num)', 'Company\printStyle::update/$1');
$routes->get('status-print-style/(:num)', 'Company\printStyle::status/$1');

});

$routes->post('update-Booking', 'Company\BookingController::update'); 
$routes->post('save-quotation', 'Company\QuotationController::store');
$routes->post('get-quotation-details', 'Company\QuotationController::getQuotationDetails');
$routes->post('get-quotation-list', 'Company\QuotationController::getQuotations');

$routes->post('get-split-bill-data', 'Company\BookingController::getSplitBillData');
$routes->post('save-split-bill-data', 'Company\BookingController::saveSplitBillData');

$routes->post('replay-quotation', 'Company\QuotationController::saveReplayQuotation');
$routes->get('print-quotation/(:num)', 'Company\QuotationController::print/$1');
$routes->get('approved-quotation/(:num)', 'Company\QuotationController::approve/$1');
// $routes->post('save-pincode', 'Company\QuotationController::pincodestore');



$routes->get('logout', 'Auth::logout');
$routes->post('get-vehicle', 'AjaxController::get_vehicle');
$routes->post('save-Booking', 'Company\BookingController::store');  
$routes->get('set-vehical/(:num)', 'Company\BookingController::setVehical/$1');
/////
$routes->get('set-multipointVehical/(:num)', 'Company\BookingController::setmultipointVehical/$1');
$routes->post('save-multipointVehical', 'Company\BookingController::saveMultiPointBookingVehical');
////
$routes->get('set-SingleToMultiVehical/(:num)', 'Company\BookingController::setSingleToMultiVehical/$1');
$routes->post('save-SingleToMultiVehical', 'Company\BookingController::saveSingleToMultiVehical');

//////
$routes->get('set-MultiToSingleVehical/(:num)', 'Company\BookingController::setMultiToSingleVehical/$1');
$routes->post('save-MultiToSingleVehical', 'Company\BookingController::saveMultiToSingleVehical');

////
$routes->get('edit-multipointVehical/(:num)', 'Company\BookingController::editmultipointVehical/$1');
$routes->post('edit-multipointVehical/(:num)', 'Company\BookingController::updatemultipointVehical/$1');

////
$routes->get('edit-SingleToMultiVehical/(:num)', 'Company\BookingController::editSingleToMultiVehical/$1');
$routes->post('edit-SingleToMultiVehical/(:num)', 'Company\BookingController::updateSingleToMultiVehical/$1');

////
$routes->get('edit-MultiToSingleVehical/(:num)', 'Company\BookingController::editMultiToSingleVehical/$1');
$routes->post('edit-MultiToSingleVehical/(:num)', 'Company\BookingController::updateMultiToSingleVehical/$1');

///
$routes->get('edit-vehical/(:num)', 'Company\BookingController::editVehical/$1');
$routes->post('edit-vehical/(:num)', 'Company\BookingController::updateVehical/$1');

$routes->post('get-consigee-details', 'Company\BookingController::getConsigneeDetails');  
$routes->post('get-consignor-details', 'Company\BookingController::getConsignorDetails');  

$routes->post('get-vehical-details','Company\BookingController::getVehicalDetails');  
$routes->post('get-vehical-details','Company\BookingController::getVehicalDetails');  
$routes->get('booking-order-status/(:num)','Company\BookingController::orderReached/$1');
$routes->post('get-unbilled-consignment','Company\BookingController::getUnbilled');




// main menu
// masters
// vouchers
// reports 