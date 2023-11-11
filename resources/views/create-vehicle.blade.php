<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Vehicle</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-w-full min-h-screen bg-white p-10">
        <form method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="model" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Model</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="year" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Year</label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="passenger_count" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Passenger_count</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="manufacture" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Manufacture</label>
                </div>

            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="price" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="vehicle_type" class="text-sm text-gray-500 dark:text-gray-400">Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600">
                    <option value="" selected disabled>Select Vehicle Type</option>
                    <option value="motor">Motor</option>
                    <option value="car">Car</option>
                    <option value="truck">Truck</option>
                </select>
            </div>

            <div id="motorInputs" style="display: none;">
                <!-- Additional inputs for Motor -->
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="petrol_capacity" id="motor_input" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Petrol-Capacity" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="luggage_size" id="motor_input" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Luggage-Size" />
                </div>
            </div>

            <div id="carInputs" style="display: none;">
                <!-- Additional inputs for Car -->
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="fuel_type" id="car_input" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Fuel Type" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="trunk_area" id="car_input" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Trunk Area" />
                </div>
            </div>

            <div id="truckInputs" style="display: none;">
                <!-- Additional inputs for Truck -->
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="number_tires" id="truck_input" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Number Tires" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="spacious_cargo_area" id="truck_input" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Spacious Cargo Area" />
                </div>
            </div>

            <div class="w-50  mt-4 mb-8">
                <label for="exampleFormControlFile1">Photo Upload</label>
                <br>
                <input type="file" class="form-control bg-primary text-light" name="photo">
            </div>

            @if ($errors->any())
            <div class="bg-red-400 mb-8">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>


            <script>
                const vehicleTypeSelect = document.getElementById('vehicle_type');
                const motorInputs = document.getElementById('motorInputs');
                const carInputs = document.getElementById('carInputs');
                const truckInputs = document.getElementById('truckInputs');

                vehicleTypeSelect.addEventListener('change', function() {
                    motorInputs.style.display = 'none';
                    carInputs.style.display = 'none';
                    truckInputs.style.display = 'none';

                    const selectedValue = vehicleTypeSelect.value;

                    if (selectedValue === 'motor') {
                        motorInputs.style.display = 'block';
                    } else if (selectedValue === 'car') {
                        carInputs.style.display = 'block';
                    } else if (selectedValue === 'truck') {
                        truckInputs.style.display = 'block';
                    }
                });
            </script>
        </form>
    </div>
</body>

</html>