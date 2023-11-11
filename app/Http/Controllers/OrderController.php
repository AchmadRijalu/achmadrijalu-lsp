<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Models\order;
use App\Models\customer;
use App\Models\vehicle;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::all();
        return view('orders', ['title' => 'Orders'], compact('orders'));
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
    public function store(Request $request)
    {
        //
        order::create(
            [
                'customer_id' => $request->customer_id,
                'vehicle_id' => $request->vehicle_id,
                'total_count' => $request->order_count,


            ]
        );
        return redirect(route('order.index'));
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
    public function edit(request $request, string $id)
    {
        //
        $order = order::findorFail($id);
        $customers = customer::all();
        $vehicles = vehicle::all();
        return view('edit-order', ['title' => 'Edit Data order'], compact('order', 'customers', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'order_count' => 'required|integer|min:1',
            // Add any other validation rules you need
        ]);

        // Find the order
        $order = Order::findOrFail($id);

        // Update the order with validated data
        $order->update([
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'total_count' => $request->order_count,
            // Add any other fields you need to update
        ]);

        // Redirect back to the index page
        return redirect(route('order.index'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($order)
    {
        //
        //
        $order = order::findorFail($order);

        $order->delete();

        return redirect(route('order.index'));
    }
}
