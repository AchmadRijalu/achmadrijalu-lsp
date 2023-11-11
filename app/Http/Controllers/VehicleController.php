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

        if ($request->photo === null) {
            // $filename = time().'.'.$request->foto->getClientOriginalExtension();
            $this->validate($request, [

                'photo' => "mimes:pdf,jpeg|max:10000"
            ]);
            // $request->foto->move('assets', $filename);
            // Check the vehicle type and create the specific type data
            $vehicleType = $request->vehicle_type;
            // dd($vehicleType);
            if ($vehicleType === 'motor') {
                $motor = motorcycle::create([
                    'petrol_capacity' => $request->petrol_capacity,
                    'luggage_size' => $request->luggage_size,
                ]);

                $vehicle = Vehicle::create([
                    'model' => $request->model,
                    'year' => $request->year,
                    'passenger_count' => $request->passenger_count,
                    'manufacture' => $request->manufacture,
                    'price' => $request->price,
                ]);
                $motor->vehicle()->save($vehicle);
            } elseif ($vehicleType === 'car') {
                $car = car::create([
                    'fuel_type' => $request->fuel_type,
                    'trunk_area' => $request->trunk_area,
                ]);

                $vehicle = Vehicle::create([
                    'model' => $request->model,
                    'year' => $request->year,
                    'passenger_count' => $request->passenger_count,
                    'manufacture' => $request->manufacture,
                    'price' => $request->price,
                ]);
                $car->vehicle()->save($vehicle);
            } elseif ($vehicleType === 'truck') {
                $truck = truck::create([
                    'number_tires' => $request->number_tires,
                    'spacious_cargo_area' => $request->spacious_cargo_area,
                ]);
                $vehicle = Vehicle::create([
                    'model' => $request->model,
                    'year' => $request->year,
                    'passenger_count' => $request->passenger_count,
                    'manufacture' => $request->manufacture,
                    'price' => $request->price,
                    'photo' => $request->photo
                ]);
                $truck->vehicle()->save($vehicle);
            }
        } else if ($request->photo != null) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $this->validate($request, [

                'photo' => "mimes:pdf,jpeg|max:10000"
            ]);
            $request->photo->move('assets', $filename);
            // Check the vehicle type and create the specific type data
            $vehicleType = $request->vehicle_type;
            // dd($vehicleType);
            if ($vehicleType === 'motor') {
                $motor = motorcycle::create([
                    'petrol_capacity' => $request->petrol_capacity,
                    'luggage_size' => $request->luggage_size,
                ]);

                $vehicle = Vehicle::create([
                    'model' => $request->model,
                    'year' => $request->year,
                    'passenger_count' => $request->passenger_count,
                    'manufacture' => $request->manufacture,
                    'price' => $request->price,
                    'photo' => $filename
                ]);
                $motor->vehicle()->save($vehicle);
            } elseif ($vehicleType === 'car') {
                $car = car::create([
                    'fuel_type' => $request->fuel_type,
                    'trunk_area' => $request->trunk_area,
                ]);

                $vehicle = Vehicle::create([
                    'model' => $request->model,
                    'year' => $request->year,
                    'passenger_count' => $request->passenger_count,
                    'manufacture' => $request->manufacture,
                    'price' => $request->price,
                    'photo' => $filename
                ]);
                $car->vehicle()->save($vehicle);
            } elseif ($vehicleType === 'truck') {
                $truck = truck::create([
                    'number_tires' => $request->number_tires,
                    'spacious_cargo_area' => $request->spacious_cargo_area,
                ]);
                $vehicle = Vehicle::create([
                    'model' => $request->model,
                    'year' => $request->year,
                    'passenger_count' => $request->passenger_count,
                    'manufacture' => $request->manufacture,
                    'price' => $request->price,
                    'photo' => $filename
                ]);
                $truck->vehicle()->save($vehicle);
            }
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
        $this->validate($request, [
            'photo' => 'nullable|mimes:pdf,jpeg|max:10000',
        ]);

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
            $motorcycle = Motorcycle::findOrFail($vehicle->vehicleable->id);
            $motorcycle->update([
                'petrol_capacity' => $request->petrol_capacity,
                'luggage_size' => $request->luggage_size,
            ]);
        } elseif ($vehicleType === 'App\Models\car') {
            $car = Car::findOrFail($vehicle->vehicleable->id);
            $car->update([
                'fuel_type' => $request->fuel_type,
                'trunk_area' => $request->trunk_area,
            ]);
        } elseif ($vehicleType === 'App\Models\truck') {
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
