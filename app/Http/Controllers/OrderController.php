<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Models\order;
use App\Models\customer;
use App\Models\vehicle;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $order = Order::all();
        return view('orders', ['title' => 'Orders'], compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = customer::all();
        $vehicles = vehicle::all();
        return view('create-order', compact('customers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreorderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateorderRequest $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
