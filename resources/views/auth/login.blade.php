<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Ex-Cadet Data Bank</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-6 px-4 shadow-md">
        <h1 class="text-3xl md:text-4xl font-extrabold text-center tracking-wide">
            Omargoni MES College Ex-Cadet Data Bank
        </h1>
        <p class="text-center text-sm md:text-base text-blue-100 mt-1">
            A trusted platform to preserve cadet legacy and connection
        </p>
    </header>

    <!-- Login Form Section -->
    <main class="flex-grow flex items-center justify-center px-4 py-8">
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
            <h2 class="text-2xl font-semibold text-center text-blue-800 mb-6">Login to Your Account</h2>

            @if(session('error'))
                <p class="text-red-600 text-sm mb-4 text-center">{{ session('error') }}</p>
            @endif

            <form method="POST" action="{{ route('user.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="phone" class="block text-gray-700 font-medium mb-1">Phone</label>
                    <input type="text" id="phone" name="phone" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-md transition duration-200">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer (Optional) -->
    <footer class="bg-white text-center text-gray-500 text-sm py-4 border-t">
        &copy; {{ date('Y') }} Omargoni MES College. All rights reserved.
    </footer>

</body>
</html>
