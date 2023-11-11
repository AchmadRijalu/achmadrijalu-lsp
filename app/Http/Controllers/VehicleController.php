<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorevehicleRequest;
use App\Http\Requests\UpdatevehicleRequest;
use App\Models\car;
use App\Models\vehicle;
use App\Models\customer;
use App\Models\motorcycle;
use App\Models\truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
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
        return view('create-vehicle');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commonRules = [
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'passenger_count' => 'required|integer|min:1',
            'manufacture' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'vehicle_type' => 'required|in:motor,car,truck',
            'photo' => 'nullable|mimes:pdf,jpeg|max:10000',
        ];


        $this->validate($request, $commonRules);


        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move('assets', $filename);
        } else {
            $filename = null;
        }

        // Check the vehicle type and create the specific type data
        $vehicleType = $request->vehicle_type;

        if ($vehicleType === 'motor') {

            $motorcycleRules = [
                'petrol_capacity' => 'required|numeric|min:1',
                'luggage_size' => 'required|numeric|min:1',
            ];

            $this->validate($request, $motorcycleRules);

            $motor = Motorcycle::create([
                'petrol_capacity' => $request->petrol_capacity,
                'luggage_size' => $request->luggage_size,
            ]);

            $vehicle = Vehicle::create([
                'model' => $request->model,
                'year' => $request->year,
                'passenger_count' => $request->passenger_count,
                'manufacture' => $request->manufacture,
                'price' => $request->price,
                'photo' => $filename,
            ]);

            $motor->vehicle()->save($vehicle);
        } elseif ($vehicleType === 'car') {

            $carRules = [
                'fuel_type' => 'required|string|max:255',
                'trunk_area' => 'required|numeric|min:1',
            ];

            $this->validate($request, $carRules);

            $car = Car::create([
                'fuel_type' => $request->fuel_type,
                'trunk_area' => $request->trunk_area,
            ]);

            $vehicle = Vehicle::create([
                'model' => $request->model,
                'year' => $request->year,
                'passenger_count' => $request->passenger_count,
                'manufacture' => $request->manufacture,
                'price' => $request->price,
                'photo' => $filename,
            ]);

            $car->vehicle()->save($vehicle);
        } elseif ($vehicleType === 'truck') {

            $truckRules = [
                'number_tires' => 'required|integer|min:1',
                'spacious_cargo_area' => 'required|numeric|min:1',
            ];

            $this->validate($request, $truckRules);

            $truck = Truck::create([
                'number_tires' => $request->number_tires,
                'spacious_cargo_area' => $request->spacious_cargo_area,
            ]);

            $vehicle = Vehicle::create([
                'model' => $request->model,
                'year' => $request->year,
                'passenger_count' => $request->passenger_count,
                'manufacture' => $request->manufacture,
                'price' => $request->price,
                'photo' => $filename,
            ]);

            $truck->vehicle()->save($vehicle);
        }

        return redirect(route('vehicle.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($request)
    {
        //
        $vehicle = vehicle::findorFail($request);
        return view('edit-vehicle', ['title' => 'Edit Vehicle'], compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commonRules = [
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'passenger_count' => 'required|integer|min:1',
            'manufacture' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'photo' => 'nullable|mimes:pdf,jpeg|max:10000',

        ];
        $this->validate($request, $commonRules);


        $vehicle = Vehicle::findOrFail($id);
        $vehicleType = $vehicle->vehicleable_type;

        // Update common vehicle fields
        $vehicle->update([
            'model' => $request->model,
            'year' => $request->year,
            'passenger_count' => $request->passenger_count,
            'manufacture' => $request->manufacture,
            'price' => $request->price,
        ]);

        // Update specific vehicle type fields
        if ($vehicleType === 'App\Models\motorcycle') {
            $motorcycleRules = [
                'petrol_capacity' => 'required|numeric|min:1',
                'luggage_size' => 'required|numeric|min:1',
            ];

            $this->validate($request, $motorcycleRules);

            $motorcycle = Motorcycle::findOrFail($vehicle->vehicleable->id);
            $motorcycle->update([
                'petrol_capacity' => $request->petrol_capacity,
                'luggage_size' => $request->luggage_size,
            ]);
        } elseif ($vehicleType === 'App\Models\car') {
            $carRules = [
                'fuel_type' => 'required|string|max:255',
                'trunk_area' => 'required|numeric|min:1',
            ];

            $this->validate($request, $carRules);
            $car = Car::findOrFail($vehicle->vehicleable->id);
            $car->update([
                'fuel_type' => $request->fuel_type,
                'trunk_area' => $request->trunk_area,
            ]);
        } elseif ($vehicleType === 'App\Models\truck') {
            $truckRules = [
                'number_tires' => 'required|integer|min:1',
                'spacious_cargo_area' => 'required|numeric|min:1',
            ];

            $this->validate($request, $truckRules);
            $truck = Truck::findOrFail($vehicle->vehicleable->id);
            $truck->update([
                'number_tires' => $request->number_tires,
                'spacious_cargo_area' => $request->spacious_cargo_area,
            ]);
        }
        // Handle photo update
        $filename = $this->updatePhoto($request, $vehicle);
        $vehicle->update(['photo' => $filename]);

        return redirect(route('vehicle.index'));
    }

    // Separate function for updating the photo
    private function updatePhoto(Request $request, Vehicle $vehicle)
    {
        $filename = $vehicle->photo;

        if ($request->hasFile('photo')) {

            $this->validate($request, [
                'photo' => 'mimes:pdf,jpeg|max:10000',
            ]);

            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $this->validate($request, [
                'photo' => "mimes:pdf,jpeg|max:10000"
            ]);
            $request->photo->move('assets', $filename);
        }

        return $filename;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the vehicle by ID
        $vehicle = Vehicle::findOrFail($id);

        // Get the associated model
        $vehicleable = $vehicle->vehicleable;

        // Delete the associated model based on the vehicle type
        if ($vehicleable instanceof motorcycle) {
            $vehicleable->delete();
        } elseif ($vehicleable instanceof car) {
            $vehicleable->delete();
        } elseif ($vehicleable instanceof truck) {
            $vehicleable->delete();
        }

        // Delete the vehicle
        $vehicle->delete();

        return redirect(route('vehicle.index'));
    }
}
