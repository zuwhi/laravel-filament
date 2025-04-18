@extends('layouts.app')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Our Products</h1>
        <div class="flex space-x-2">
            <select class="border rounded px-3 py-1">
                <option>All Categories</option>
                @foreach ($products->unique('category')->pluck('category') as $category)
                    <option>{{ $category }}</option>
                @endforeach
            </select>
            <input type="text" placeholder="Search..." class="border rounded px-3 py-1 w-64">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ file_exists(public_path('storage/' . $product->image))
                        ? asset('storage/' . $product->image)
                        : asset('images/img.jpg') }}"
                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded">{{ $product->category }}</span>
                    <h3 class="font-semibold text-lg mt-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ $product->description }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold text-lg">${{ number_format($product->price, 2) }}</span>
                        <a href="{{ route('products.show', $product) }}"
                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
