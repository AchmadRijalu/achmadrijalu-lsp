<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    @vite('resources/css/app.css')
</head>

<body>
    @extends('main')

    @section("content")

    <div class="w-full h-screen bg-blue-950 flex flex-col justify-center gap-4 align-middle ">
        <button type="submit" onclick="location.href='{{route('customer.create')}}'" class=" ml-10 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-44  px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create Customer</button>
        <button type="submit" onclick="location.href='{{route('vehicle.create')}}'" class=" ml-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-44  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Vehicle</button>

        <!-- CUSTOMER -->
        <div class="relative overflow-x-auto p-4 mb-16">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ID Number
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$customer->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$customer->address}}
                        </td>
                        <td class="px-6 py-4">
                            {{$customer->phone_number}}
                        </td>
                        <td class="px-6 py-4">
                            {{$customer->id_card}}
                        </td>
                        <td class="px-6 py-4">
                            <button type="submit" class="btn btn-warning" onclick="location.href='{{route('customer.edit', $customer->id)}}'">Edit</button>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{route('customer.destroy', $customer->id) }}" method="POST">

                                {{ csrf_field() }}
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>

        <!-- VEHICLE -->
        <div class="relative overflow-x-auto p-4 mb-16">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$vehicle->model}}
                        </th>
                        <td class="px-6 py-4">
                            {{$vehicle->year}}
                        </td>
                        <td class="px-6 py-4">
                            {{$vehicle->passenger_count}}
                        </td>
                        <td class="px-6 py-4">
                            {{$vehicle->manufacture}}
                        </td>
                        <td class="px-6 py-4">
                            {{$vehicle->passenger_count}}
                        </td>
                        <td class="px-6 py-4">
                            @if ($vehicle->vehicleable_type == 'App\Models\motorcycle')
                            MotorCycle

                            @elseif ($vehicle->vehicleable_type == 'App\Models\car')
                            Car
                            @elseif ($vehicle->vehicleable_type == 'App\Models\truck')
                            Truck
                            @endif

                        </td>
                        <td class="px-6 py-4">
                            <button type="submit" class="btn btn-warning" onclick="location.href='{{route('vehicle.edit', $vehicle->id)}}'">Edit</button>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


    </div>


    @endsection


</body>

</html>