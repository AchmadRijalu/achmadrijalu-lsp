<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

</head>

<body>
    @extends('main')
    @section("content")
    <div class="min-w-full min-h-screen bg-white p-10 flex flex-col align-middle">
        <button type="submit" onclick="location.href='{{route('order.create')}}'" class=" ml-10 text-white mb-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-44  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Order</button>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Customer name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Vehicle
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Count
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($order->customer)
                            {{ $order->customer->name }}
                            @else
                            Customer Not Found
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->vehicle->model }}
                        </td>
                        <td class="px-6 py-4">
                            {{$order->total_count}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->vehicle->price * $order->total_count }}
                        </td>
                        <td class="px-6 py-4 text-right">

                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline " onclick="location.href='{{route('order.edit', $order->id)}}'">Edit</button>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <form action="{{route('order.destroy', $order->id) }}" method="POST">

                                {{ csrf_field() }}
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>

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