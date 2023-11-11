<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecustomerRequest;
use App\Http\Requests\UpdatecustomerRequest;
use App\Models\customer;
use App\Models\vehicle;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = customer::all();
        $vehicles = vehicle::all();
        return view('create-data', compact('customers', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view('create-customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        customer::create(
            [
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'id_card' => $request->id_card

            ]
        );
        return redirect(route('customer.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($request)
    {
        //
        $customer = customer::findorFail($request);
        return view('edit-customer', ['title' => 'Edit Data Customer'], compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $customer = customer::findorFail($id);
        $customer->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'id_card' => $request->id_card,

            ]
        );
        return redirect(route('customer.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($customer)
    {
        //
        $customer = customer::findorFail($customer);

        $customer->delete();

        return redirect(route('customer.index'));
    }
}
