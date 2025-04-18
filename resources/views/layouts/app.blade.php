<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-2xl font-bold">LaravelShop</a>
            <div class="space-x-4">
                <a href="#" class="hover:text-blue-200"><i class="fas fa-user mr-1"></i> Account</a>
                <a href="#" class="hover:text-blue-200"><i class="fas fa-shopping-cart mr-1"></i> Cart</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; 2023 LaravelShop. All rights reserved.</p>
            <div class="mt-4 space-x-4">
                <a href="#" class="hover:text-blue-400"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-blue-400"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>