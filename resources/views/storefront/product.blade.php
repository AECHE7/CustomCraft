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
                                <form action="#" method="POST" enctype="multipart/form-data" x-data="{ uploading: false, progress: 0, error: '', file_path: '' }">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="custom_text" class="block text-gray-700 text-sm font-bold mb-2">Custom Text</label>
                                        <input type="text" name="custom_text" id="custom_text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="mb-4">
                                        <label for="special_instructions" class="block text-gray-700 text-sm font-bold mb-2">Special Instructions</label>
                                        <textarea name="special_instructions" id="special_instructions" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="design_file" class="block text-gray-700 text-sm font-bold mb-2">Upload Your Design</label>
                                        <input type="file" name="design_file" id="design_file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            x-on:change="
                                                error = '';
                                                const file = $event.target.files[0];
                                                if (file) {
                                                    if (file.size > 5 * 1024 * 1024) {
                                                        error = 'Error: File exceeds 5MB.';
                                                        $event.target.value = '';
                                                    } else if (!['image/png', 'image/jpeg'].includes(file.type)) {
                                                        error = 'Error: File must be a PNG/JPG.';
                                                        $event.target.value = '';
                                                    } else {
                                                        uploading = true;
                                                        let formData = new FormData();
                                                        formData.append('design_file', file);
                                                        fetch('{{ route('upload-design') }}', {
                                                            method: 'POST',
                                                            headers: {
                                                                'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content
                                                            },
                                                            body: formData
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            file_path = data.file_path;
                                                            uploading = false;
                                                        })
                                                        .catch(() => {
                                                            error = 'File upload failed.';
                                                            uploading = false;
                                                        });
                                                    }
                                                }
                                            ">
                                        <div x-show="uploading" class="w-full bg-gray-200 rounded-full mt-2">
                                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 100%">Uploading...</div>
                                        </div>
                                        <p x-text="error" class="text-red-500 text-xs italic mt-2"></p>
                                        <input type="hidden" name="file_path" x-model="file_path">
                                    </div>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add to Cart</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-storefront-layout>
