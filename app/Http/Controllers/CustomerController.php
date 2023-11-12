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
     * Display a list of all customers and vehicles.
     */
    public function index()
    {
        //
        $customers = customer::all();
        $vehicles = vehicle::all();
        return view('create-data', compact('customers', 'vehicles'));
    }

    /**
     * Show the form page for creating a new customer.
     */
    public function create()
    {
        //

        return view('create-customer');
    }

    /**
    * Store a newly created customer in database.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric', // Ensure it is numeric
            'id_card' => 'required|numeric', // Ensure it is numeric
        ]);

        customer::create($validatedData);

        return redirect(route('customer.index'));
    }

    /**
     * not used
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form page for editing the specified customer.
     */
    public function edit($request)
    {
        //
        $customer = customer::findorFail($request);
        return view('edit-customer', ['title' => 'Edit Data Customer'], compact('customer'));
    }

    /**
     * Update the specified customer.
     */
    public function update(Request $request, string $id)
    {
        $customer = customer::findorFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric', // Ensure it is numeric
            'id_card' => 'required|numeric', // Ensure it is numeric
        ]);

        $customer->update($validatedData);

        return redirect(route('customer.index'));
    }

    /**
     * Remove the specified customer from database.
     */
    public function destroy($customer)
    {
        //
        $customer = customer::findorFail($customer);

        $customer->delete();

        return redirect(route('customer.index'));
    }
}
