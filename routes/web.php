<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemCodeController;
use App\Http\Controllers\MaterialRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesEnquiryController;
use App\Http\Controllers\SOAController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyMasterController;
use App\Livewire\Budget\BudgetForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/budgets', BudgetForm::class)->name('budgets.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/profile/picture', [ProfileController::class, 'picture'])->name('profile.picture');
    Route::post('/profile/upload', [ProfileController::class, 'upload'])->name('profile.upload');
    Route::get('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/dashboard/permissions/add', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/dashboard/permissions/add', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/dashboard/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/dashboard/permissions/{id}/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/dashboard/permissions/{id}/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
    Route::post('/dashboard/permissions/{id}/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/dashboard/roles/add', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/dashboard/roles/add', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/dashboard/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/dashboard/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/dashboard/roles/{id}/delete', [RoleController::class, 'delete'])->name('roles.delete');
    Route::post('/dashboard/roles/{id}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/employees', [UserController::class, 'list'])->name('users.list');
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/dashboard/users/{id}/view', [UserController::class, 'view'])->name('users.view');
    Route::get('/dashboard/users/add', [UserController::class, 'create'])->name('users.create');
    Route::post('/dashboard/users/add', [UserController::class, 'store'])->name('users.store');
    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/dashboard/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/dashboard/users/{id}/roles', [UserController::class, 'roles'])->name('users.roles');
    Route::post('/dashboard/users/{id}/designate', [UserController::class, 'designate'])->name('users.designate');
    Route::get('/dashboard/users/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::post('/dashboard/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/item_codes', [ItemCodeController::class, 'index'])->name('item_codes.index');
    Route::get('/dashboard/item_codes/add', [ItemCodeController::class, 'create'])->name('item_codes.create');
    Route::post('/dashboard/item_codes/add', [ItemCodeController::class, 'store'])->name('item_codes.store');
    Route::get('/dashboard/item_codes/{id}/edit', [ItemCodeController::class, 'edit'])->name('item_codes.edit');
    Route::post('/dashboard/item_codes/{id}/update', [ItemCodeController::class, 'update'])->name('item_codes.update');
    Route::get('/dashboard/item_codes/{id}/delete', [ItemCodeController::class, 'delete'])->name('item_codes.delete');
    Route::post('/dashboard/item_codes/{id}/destroy', [ItemCodeController::class, 'destroy'])->name('item_codes.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/dashboard/clients/add', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/dashboard/clients/add', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/dashboard/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::post('/dashboard/clients/{id}/update', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/dashboard/clients/{id}/delete', [ClientController::class, 'delete'])->name('clients.delete');
    Route::post('/dashboard/clients/{id}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/dashboard/suppliers/add', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/dashboard/suppliers/add', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/dashboard/suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::post('/dashboard/suppliers/{id}/update', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::get('/dashboard/suppliers/{id}/delete', [SupplierController::class, 'delete'])->name('suppliers.delete');
    Route::post('/dashboard/suppliers/{id}/destroy', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/sales_enquiries', [SalesEnquiryController::class, 'index'])->name('sales_enquiries.index');
    Route::get('/dashboard/sales_enquiries/{id}/view', [SalesEnquiryController::class, 'show'])->name('sales_enquiries.view');
    Route::get('/dashboard/sales_enquiries/add', [SalesEnquiryController::class, 'create'])->name('sales_enquiries.create');
    Route::get('/dashboard/sales_enquiries/{id}/edit', [SalesEnquiryController::class, 'edit'])->name('sales_enquiries.edit');
    Route::get('/dashboard/sales_enquiries/{id}/delete', [SalesEnquiryController::class, 'delete'])->name('sales_enquiries.delete');
    Route::post('/dashboard/sales_enquiries/{id}/destroy', [SalesEnquiryController::class, 'destroy'])->name('sales_enquiries.destroy');
    Route::get('/dashboard/sales_enquiries/{id}/print_preview', [SalesEnquiryController::class, 'print_preview'])->name('sales_enquiries.print_preview');
    Route::post('/dashboard/sales_enquiries/{id}/print', [SalesEnquiryController::class, 'print'])->name('sales_enquiries.print');
    Route::get('/dashboard/sales_enquiries_chart_data', [SalesEnquiryController::class, 'chart_data'])->name('sales_enquiries.chart_data');
    Route::get('/export-sales-enquiries', [SalesEnquiryController::class, 'export'])->name('sales_enquiries.export');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/dashboard/invoices/{id}/view', [InvoiceController::class, 'show'])->name('invoices.view');
    Route::get('/dashboard/invoices/add', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::get('/dashboard/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::get('/dashboard/invoices/{id}/delete', [InvoiceController::class, 'delete'])->name('invoices.delete');
    Route::post('/dashboard/invoices/{id}/destroy', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::get('/dashboard/invoices/{id}/print_preview', [InvoiceController::class, 'print_preview'])->name('invoices.print_preview');
    Route::post('/dashboard/invoices/{id}/print', [InvoiceController::class, 'print'])->name('invoices.print');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/dashboard/payments/add', [PaymentController::class, 'create'])->name('payments.create');
    Route::get('/dashboard/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::get('/dashboard/payments/{id}/delete', [PaymentController::class, 'delete'])->name('payments.delete');
    Route::post('/dashboard/payments/{id}/destroy', [PaymentController::class, 'destroy'])->name('payments.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/soa/client', [SOAController::class, 'client'])->name('soa.client');
    Route::get('/dashboard/soa/supplier', [SOAController::class, 'supplier'])->name('soa.supplier');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/material_requests', [MaterialRequestController::class, 'index'])->name('material_requests.index');
    Route::get('/dashboard/material_requests/{id}/view', [MaterialRequestController::class, 'show'])->name('material_requests.view');
    Route::get('/dashboard/material_requests/add', [MaterialRequestController::class, 'create'])->name('material_requests.create');
    Route::get('/dashboard/material_requests/{id}/edit', [MaterialRequestController::class, 'edit'])->name('material_requests.edit');
    Route::get('/dashboard/material_requests/{id}/delete', [MaterialRequestController::class, 'delete'])->name('material_requests.delete');
    Route::post('/dashboard/material_requests/{id}/destroy', [MaterialRequestController::class, 'destroy'])->name('material_requests.destroy');
    Route::get('/dashboard/material_requests/{id}/print_preview', [MaterialRequestController::class, 'print_preview'])->name('material_requests.print_preview');
    Route::post('/dashboard/material_requests/{id}/print', [MaterialRequestController::class, 'print'])->name('material_requests.print');
    Route::patch('/dashboard/material_requests/{id}/deliver', [MaterialRequestController::class, 'markAsDelivered'])->name('material_requests.deliver');
});


Route::middleware('auth')->group(function () {  
    Route::get('/dashboard/company/add', [CompanyMasterController::class, 'create'])->name('company.create');
    Route::post('/dashboard/company/add', [CompanyMasterController::class, 'store'])->name('company.store');
     Route::get('/dashboard/company', [CompanyMasterController::class, 'index'])->name('company.index');
    
});


require __DIR__ . '/auth.php';
