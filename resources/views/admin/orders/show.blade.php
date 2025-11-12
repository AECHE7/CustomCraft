<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Order #{{ $order->id }}</h3>
                    <p><strong>Customer Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Status:</strong> {{ $order->status }}</p>

                    <h3 class="text-lg font-bold mt-4">Order Items</h3>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Customization</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->product->name }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($item->customization_data)
                                            <ul>
                                                @foreach (json_decode($item->customization_data) as $key => $value)
                                                    <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        @if ($item->customization_data && isset(json_decode($item->customization_data, true)['file_path']))
                                            <a href="{{ route('admin.orders.download', $item) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Download Design</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
