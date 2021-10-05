<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
//backend
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/update_stats','HomeController@updateStats')->name('updateStats');

//middleware group
Route::group(['middleware' => 'auth'], function () {
    //manage user route
    Route::group(['prefix' => 'users'], function () {
        Route::get('/view', 'Backend\UserController@view')->name('users.view');
        Route::get('/add', 'Backend\UserController@add')->name('users.add');
        Route::post('/store', 'Backend\UserController@store')->name('users.store');
        Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
        Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
    });
    //manage Inventory route
    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/overview', 'Backend\InventoryController@overview')->name('inventory.overview');
        Route::get('/stocks', 'Backend\InventoryController@stocks')->name('inventory.stocks');
        Route::get('/pending-orders', 'Backend\InventoryController@porders')->name('inventory.porders');
        Route::get('/reports', 'Backend\InventoryController@reports')->name('inventory.reports');
    });
    // manage profile route
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/view', 'Backend\ProfileController@view')->name('profile.view');
        Route::get('/edit', 'Backend\ProfileController@edit')->name('profile.edit');
        Route::post('/update', 'Backend\ProfileController@update')->name('profile.update');
        Route::get('/pass/view', 'Backend\ProfileController@passview')->name('profile.pass.view');
        Route::post('/pass/change', 'Backend\ProfileController@passchange')->name('profile.pass.change');
    });
    // manage suppliers
    Route::group(['prefix' => 'vendors'], function () {
        Route::get('/view', 'Backend\VendorController@view')->name('vendors.view');
        Route::get('/add', 'Backend\VendorController@add')->name('vendors.add');
        Route::post('/store', 'Backend\VendorController@store')->name('vendors.store');
        Route::get('/edit/{id}', 'Backend\VendorController@edit')->name('vendors.edit');
        Route::post('/update/{id}', 'Backend\VendorController@update')->name('vendors.update');
        Route::get('/delete/{id}', 'Backend\VendorController@delete')->name('vendors.delete');
    });

    //manage prescriptions
    Route::group(['prefix' => 'prescriptions'], function () {
        Route::get('/view', 'Backend\PrescriptionController@view')->name('prescriptions.view');
        Route::get('/add', 'Backend\PrescriptionController@add')->name('prescriptions.add');
        Route::post('/store', 'Backend\PrescriptionController@store')->name('prescriptions.store');
        Route::get('/edit/{id}', 'Backend\PrescriptionController@edit')->name('prescriptions.edit');
        Route::post('/update/{id}', 'Backend\PrescriptionController@update')->name('prescriptions.update');
        Route::get('/print/{id}', 'Backend\PrescriptionController@printPrescription')->name('prescriptions.print');
    });
    Route::post('get-states-by-country','Backend\CustomerController@getState')->name('customers.getState');
    Route::post('get-cities-by-state','Backend\CustomerController@getCity')->name('customers.getCity');
    Route::post('/ajaxaddvendor', 'Backend\PurchaseController@ajaxaddvendor')->name('purchase.ajaxaddvendor');
    Route::post('/ajaxaddcategory', 'Backend\PurchaseController@ajaxaddcategory')->name('purchase.ajaxaddcategory');
    Route::post('/ajaxaddproduct', 'Backend\PurchaseController@ajaxaddproduct')->name('purchase.ajaxaddproduct');
    Route::post('/ajaxaddpayment', 'Backend\InvoiceController@ajaxaddpayment')->name('invoice.ajaxaddpayment');
    Route::post('/ajaxupdateproduct/{id}', 'Backend\InvoiceController@ajaxupdateproduct')->name('invoice.ajaxupdateproduct');
    Route::post('/ajaxaddcustomer', 'Backend\InvoiceController@ajaxaddcustomer')->name('invoice.ajaxaddcustomer');
    Route::post('/ajaxaddprescription', 'Backend\InvoiceController@ajaxaddprescription')->name('invoice.ajaxaddprescription');
    Route::post('get-taxes-by-category','Backend\PurchaseController@getTaxes')->name('purchase.getTaxes');
    //manage customers
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/view', 'Backend\CustomerController@view')->name('customers.view');
        Route::get('/profile/{id}', 'Backend\CustomerController@viewProfile')->name('customers.profile');
        Route::get('/add', 'Backend\CustomerController@add')->name('customers.add');
        Route::post('/store', 'Backend\CustomerController@store')->name('customers.store');
        Route::get('/edit/{id}', 'Backend\CustomerController@edit')->name('customers.edit');
        Route::post('/update/{id}', 'Backend\CustomerController@update')->name('customers.update');
        Route::get('/delete/{id}', 'Backend\CustomerController@delete')->name('customers.delete');
        Route::get('/credit','Backend\CustomerController@creditCustomer')->name('customers.credit');
        Route::get('/credit/pdf','Backend\CustomerController@creditCustomerpdf')->name('customers.credi.pdf');
        Route::get('/invoice/edit/{invoice_id}', 'Backend\CustomerController@editinvoice')->name('customers.edit.invoice');
        Route::post('/invoice/update/{invoice_id}', 'Backend\CustomerController@updateinvoice')->name('customers.update.invoice');
        Route::get('/invoice/details/pdf/{invoice_id}', 'Backend\CustomerController@detailsInvoice')->name('invoice.details.pdf');
        Route::get('/paid/customer','Backend\CustomerController@paidCustomer')->name('customers.paid');
        Route::get('/paid/pdf','Backend\CustomerController@paidCustomerpdf')->name('customers.paid.pdf');
    });
    Route::group(['prefix' => 'units'], function () {
        Route::get('/view', 'Backend\UnitController@view')->name('units.view');
        Route::get('/add', 'Backend\UnitController@add')->name('units.add');
        Route::post('/store', 'Backend\UnitController@store')->name('units.store');
        Route::get('/edit/{id}', 'Backend\UnitController@edit')->name('units.edit');
        Route::post('/update/{id}', 'Backend\UnitController@update')->name('units.update');
        Route::get('/delete/{id}', 'Backend\UnitController@delete')->name('units.delete');
    });

    //manage Brands route
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/view', 'Backend\BrandController@view')->name('brands.view');
        Route::get('/add', 'Backend\BrandController@add')->name('brands.add');
        Route::post('/store', 'Backend\BrandController@store')->name('brands.store');
        Route::get('/edit/{id}', 'Backend\BrandController@edit')->name('brands.edit');
        Route::post('/update/{id}', 'Backend\BrandController@update')->name('brands.update');
        Route::get('/delete/{id}', 'Backend\BrandController@delete')->name('brands.delete');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/view', 'Backend\CategoriesController@view')->name('categories.view');
        Route::get('/add', 'Backend\CategoriesController@add')->name('categories.add');
        Route::post('/store', 'Backend\CategoriesController@store')->name('categories.store');
        Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('categories.edit');
        Route::post('/update/{id}', 'Backend\CategoriesController@update')->name('categories.update');
        Route::get('/delete/{id}', 'Backend\CategoriesController@delete')->name('categories.delete');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/view', 'Backend\ProductController@view')->name('products.view');
        Route::get('/add', 'Backend\ProductController@add')->name('products.add');
        Route::post('/store', 'Backend\ProductController@store')->name('products.store');
        Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('products.edit');
        Route::post('/update/{id}', 'Backend\ProductController@update')->name('products.update');
        Route::get('/delete/{id}', 'Backend\ProductController@delete')->name('products.delete');
    });
    Route::group(['prefix' => 'purchase'], function () {
        Route::get('/view', 'Backend\PurchaseController@view')->name('purchase.view');
        Route::get('/add', 'Backend\PurchaseController@add')->name('purchase.add');
        Route::post('/store', 'Backend\PurchaseController@store')->name('purchase.store');
        Route::get('/edit/{id}', 'Backend\PurchaseController@edit')->name('purchase.edit');
        Route::post('/update/{id}', 'Backend\PurchaseController@update')->name('purchase.update');
        Route::get('/pending', 'Backend\PurchaseController@PendingList')->name('pending.view.list');
        Route::get('/approve/{id}', 'Backend\PurchaseController@approve')->name('purchase.approve');
        Route::get('/delete/{id}', 'Backend\PurchaseController@delete')->name('purchase.delete');
    });
    Route::get('/get-product', 'Backend\DefaultController@getProduct')->name('get-product');
    Route::get('/get-product-invoice', 'Backend\DefaultController@getProductinvoice')->name('get-product-invoice');
    Route::get('/get-stock', 'Backend\DefaultController@getStock')->name('check-product-stock');
    Route::get('/get-prescriptions', 'Backend\DefaultController@getprescriptions')->name('check-prescriptions');

    Route::group(['prefix' => 'sales-invoice'], function () {
        Route::get('/view', 'Backend\SalesInvoiceController@view')->name('sales-invoice.view');
        Route::get('/add', 'Backend\SalesIInvoiceController@add')->name('sales-invoice.add');
        Route::post('/store', 'Backend\SalesIInvoiceController@store')->name('sales-invoice.store');

    });
    Route::get('/search', 'Backend\SearchController@search')->name('search');

    //manage invoice
    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/view', 'Backend\InvoiceController@view')->name('invoice.view');
        Route::get('/add', 'Backend\InvoiceController@add')->name('invoice.add');
        Route::post('/store', 'Backend\InvoiceController@store')->name('invoice.store');
        Route::get('/edit/{id}', 'Backend\InvoiceController@edit')->name('invoice.edit');
        Route::post('/update/{id}', 'Backend\InvoiceController@update')->name('invoice.update');
        Route::get('/pending', 'Backend\InvoiceController@PendingList')->name('invoice.pending.list');
        Route::get('/approve/{id}', 'Backend\InvoiceController@approve')->name('invoice.approve');
        Route::get('/delete/{id}', 'Backend\InvoiceController@delete')->name('invoice.delete');
        Route::post('/approve/store/{id}', 'Backend\InvoiceController@approval_store')->name('approval.store');
        Route::get('/delete_approve/{id}', 'Backend\InvoiceController@delete_approve')->name('invoice.approve.delete');
        Route::get('/print/{id}', 'Backend\InvoiceController@printInvoice')->name('invoice.print');
        Route::get('/print-advance/{id}', 'Backend\InvoiceController@printAdvanceReceipt')->name('advreceipt.print');
        Route::get('/daily/report', 'Backend\InvoiceController@dailyReport')->name('invoice.daily.report');
        Route::get('/daily/report/pdf', 'Backend\InvoiceController@dailyReportPdf')->name('invoice.daily.report.pdf');

    });
    //manage stock
    Route::group(['prefix' => 'stock'], function () {
        Route::get('/report', 'Backend\StockController@StockReport')->name('stock.report');
        Route::get('/report/pdf', 'Backend\StockController@StockReportpdf')->name('stock.report.pdf');

        
    });
});


