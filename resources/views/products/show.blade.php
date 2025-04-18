@extends('layouts.app')

@section('content')
    <div class=" flex items-center">
        <div class="bg-white my-10  rounded-lg shadow-lg overflow-hidden max-w-7xl mx-auto">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <img src="{{ file_exists(public_path('storage/' . $product->image))
                        ? asset('storage/' . $product->image)
                        : asset('images/img.jpg') }}"
                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="p-8 md:w-1/2">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded">{{ $product->category }}</span>
                            <h1 class="text-2xl font-bold text-gray-800 mt-2">{{ $product->name }}</h1>
                        </div>
                        <span class="text-2xl font-bold text-gray-800">${{ number_format($product->price, 2) }}</span>
                    </div>

                    <p class="mt-6 text-gray-600">{{ $product->description }}</p>

                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600 ml-2">4.5 (42 reviews)</span>
                        </div>

                        <div class="mt-6 flex space-x-4">
                            <div class="flex items-center">
                                <span class="text-gray-600 mr-2">Qty:</span>
                                <select class="border rounded px-2 py-1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <button
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors flex-1">
                                Add to Cart
                            </button>
                        </div>

                        <div class="mt-6 pt-6 border-t">
                            <h3 class="text-sm font-semibold text-gray-600">Product Details</h3>
                            <ul class="mt-2 text-sm text-gray-600 space-y-1">
                                <li><span class="font-medium">Category:</span> {{ $product->category }}</li>
                                <li><span class="font-medium">SKU:</span>
                                    PROD{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                                </li>
                                <li><span class="font-medium">Availability:</span> In Stock</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
