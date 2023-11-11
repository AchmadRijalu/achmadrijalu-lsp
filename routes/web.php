<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Models\order;



Route::get('/', function () {
    $orders = Order::all();
    return view('orders', ['title' => 'Orders'], compact('orders'));
});

Route::get('/create-order', function () {
    return view('create-order');
});

Route::get('/create-data', function () {
    return view('create-data');
});
Route::get('/edit-customer', function () {
    return view('edit-customer');
});
Route::get('/detail-order', function () {
    return view('detailorder');
});
Route::get('/edit-order', function () {
    return view('editorder');
});

Route::get('/create-customer', function () {
    return view('create-customer');
});


Route::get('/create-vehicle', function () {
    return view('create-vehicle');
});

Route::get('/edit-vehicle', function () {
    return view('edit-vehicle');
});

Route::resource('order', OrderController::class);
Route::resource('customer', CustomerController::class);

Route::resource('vehicle', VehicleController::class);


