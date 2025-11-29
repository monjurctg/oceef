<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Cadex - Celebration Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Main Content -->
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="bg-primary-600 text-white rounded-lg p-2">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900">CollegeCadex</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/" class="text-gray-600 hover:text-gray-900 flex items-center">
                            <i class="fas fa-home mr-1"></i> Home
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex justify-center md:justify-start">
                        <p class="text-center text-sm text-gray-500">
                            &copy; {{ date('Y') }} CollegeCadex. All rights reserved.
                        </p>
                    </div>
                    <div class="mt-4 flex justify-center md:mt-0">
                        <div class="flex space-x-6">
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Facebook</span>
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Twitter</span>
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Instagram</span>
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>