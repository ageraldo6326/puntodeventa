<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseController;

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/login', [LoginController::class, 'loginPost'])->name('loginPost');

Route::get('/register',[LoginController::class, 'register'])->name('register');

Route::post('/register', [LoginController::class, 'registerPost'])->name('registerPost');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/admin/products', function () { 
        return view('admin.products');
    })->name('admin.products');

    Route::get('/admin/categories', function () { 
        return view('admin.categories');
    })->name('admin.categories');

    Route::get('/admin/customers', function () { 
        return view('admin.customers');
    })->name('admin.customers');  
    
    Route::get('/admin/providers', function () { 
        return view('admin.providers');
    })->name('admin.providers'); 

    Route::get('/admin/purchases-list', function () { 
        return view('admin.purchases-list');
    })->name('admin.purchases-list');     

    Route::get('/admin/invoices-list', function () { 
        return view('admin.invoices-list');
    })->name('admin.invoices-list'); 

    Route::get('/admin/quotes-list', function () { 
        return view('admin.quotes-list');
    })->name('admin.quotes-list');     

    Route::get('/admin/invoices-list', function () { 
        return view('admin.invoices-list');
    })->name('admin.invoices-list');    

    Route::get('/admin/quote-new', function () { 
        return view('admin.quote-new');
    })->name('admin.quote-new');   

    Route::get('/admin/purchase-new', function () { 
        return view('admin.purchase-new');
    })->name('admin.purchase-new');    
    
    Route::get('/admin/invoice-new', function () { 
        return view('admin.invoice-new');
    })->name('admin.invoice-new');     

    Route::get('/admin/editinvoice/{invoice}', function ($invoice) {
        return view('admin.edit-invoice',compact('invoice'));
    })->name('admin.editInvoice');

    Route::get('/admin/editquote/{quote}', function ($quote) {
        return view('admin.edit-quote',compact('quote'));
    })->name('admin.editQuote');   
    
    Route::get('/admin/editpurchase/{purchase}', function ($purchase) {
        return view('admin.edit-purchase',compact('purchase'));
    })->name('admin.editPurchase');    

    Route::get('/admin/ncf', function () {
        return view('admin.ncf');
    })->name('admin.ncf');    

    Route::get('/admin/purchase', [PurchaseController::class, 'index'])->name('admin.purchase'); 

    Route::get('/admin/company', [CompanyController::class, 'index'])->name('admin.company'); 
    
    Route::get('/admin/showinvoice/{id}', [InvoiceController::class, 'showinvoice'])->name('admin.showinvoice'); 

    Route::get('/admin/showquote/{id}', [QuoteController::class, 'showquote'])->name('admin.showquote'); 

    Route::get('/admin/showpurchase/{id}', [PurchaseController::class, 'showpurchase'])->name('admin.showpurchase');

    Route::get('/admin/pdfinvoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('admin.generateinvoice'); 

    Route::get('/admin/pdfquote/{id}', [QuoteController::class, 'generateQuote'])->name('admin.generatequote');

    Route::get('/admin/pdfpurchase/{id}', [PurchaseController::class, 'generatePurchase'])->name('admin.generatepurchase');




    




});