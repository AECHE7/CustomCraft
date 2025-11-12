<x-storefront-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                            <p class="text-gray-600">{{ $product->description }}</p>
                            <p class="text-lg font-bold mt-4">{{ $product->base_price }}</p>
                        </div>
                        <div>
                            @if ($product->product_type == 'Simple')
                                <p class="text-gray-600">In Stock: {{ $product->inventory_count }}</p>
                            @else
                                <h3 class="text-lg font-bold">Customize Your Product</h3>
                                <!-- Customization form will go here -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-storefront-layout>
