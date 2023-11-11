<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-w-full min-h-screen bg-white p-10">
        <form method="POST" action="{{ route('order.store') }}">
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <label for="customer_id" class="text-sm text-gray-500 dark:text-gray-400">Customer</label>
                <select name="customer_id" id="customer_id" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600">
                    <option value="" selected disabled>Select Customer</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="vehicle_id" class="text-sm text-gray-500 dark:text-gray-400">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" onchange="updatePrice()">
                    <option value="" selected disabled>Select Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" data-price="{{ $vehicle->price }}">{{ $vehicle->model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="number" name="order_count" id="model" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="model" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Order Count</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="price" id="price" readonly class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>

            <script>
                function updatePrice() {
                    const vehicleSelect = document.getElementById('vehicle_id');
                    const priceInput = document.getElementById('price');
                    const orderCountInput = document.getElementById('model');
                    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
                    const price = selectedOption.getAttribute('data-price');
                    const orderCount = parseInt(orderCountInput.value, 10);

                    if (orderCount >= 1) {
                        priceInput.value = price * orderCount;
                    } else {
                        priceInput.value = ''; // Set to empty string or any default value.
                    }
                }
                // Ensure the updatePrice function is called when the order count changes.
                document.getElementById('model').addEventListener('input', updatePrice);
            </script>


        </form>
    </div>
</body>

</html>