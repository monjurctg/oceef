<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Cadex - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Initially expanded -->
        <div id="sidebar" class="bg-primary-800 text-white w-64 transition-all duration-300 ease-in-out flex flex-col fixed h-full lg:relative">
            <!-- Logo/Brand -->
            <div class="p-4 flex items-center justify-between border-b border-primary-700">
                <span class="text-xl font-bold whitespace-nowrap">CollegeCadex</span>
                <button id="toggleSidebar" class="text-white focus:outline-none lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-home w-6 text-center"></i>
                    <span class="ml-3">Dashboard</span>
                </a>



                <a href="/registrations" class="flex items-center p-3 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-clipboard-list w-6 text-center"></i>
                    <span class="ml-3">Registrations</span>
                </a>

                <a href="/celebration-registrations" class="flex items-center p-3 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-calendar-alt w-6 text-center"></i>
                    <span class="ml-3">Celebration Registrations</span>
                </a>

             @if($user['type'] == 1)
                <a href="/users" class="flex items-center p-3 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-user-graduate w-6 text-center"></i>
                    <span class="ml-3">users</span>
                </a>
                <a href="/create-user" class="flex items-center p-3 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-user-plus w-6 text-center"></i>
                    <span class="ml-3">Create User</span>
                </a>
            @endif
                <!--<a href="#" class="flex items-center p-3 rounded-lg hover:bg-primary-700 transition-colors">-->
                <!--    <i class="fas fa-cog w-6 text-center"></i>-->
                <!--    <span class="ml-3">Settings</span>-->
                <!--</a>-->
            </nav>

            <!-- Bottom section -->
            <div class="p-4 border-t border-primary-700">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center">
                        <span class="text-xs font-bold">{{ strtoupper(substr($user['name'], 0, 2)) }}</span>
                    </div>
                   @php
                    $roles = [
                        1 => 'Admin',
                        2 => 'Moderator',
                        // Add more roles as needed
                    ];
                @endphp

                <div class="ml-3">
                    <div class="font-medium text-sm">{{ $user['name'] }}</div>
                    <div class="text-xs text-primary-200">{{ $roles[$user['type']] ?? 'User' }}</div>
                </div>

                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" class="flex items-center p-3 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    <span class="ml-3">Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ml-0">
            <!-- Topbar with mobile menu button -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button id="mobileMenuButton" class="mr-4 text-gray-500 focus:outline-none lg:hidden">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2">
                           <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                                @php
                                    $roles = [
                                        1 => 'Admin',
                                        2 => 'Moderator',
                                        // Add more roles as needed
                                    ];
                                @endphp

                                <span class="text-xs font-bold text-primary-800">{{ $roles[$user['type']] ?? 'User' }}</span>
                            </div>

                            <span class="hidden md:inline">{{ $user['name'] }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-3 md:p-5 bg-gray-50">
            @yield('content')
        </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleSidebar = document.getElementById('toggleSidebar');

        // Toggle sidebar on mobile
        mobileMenuButton.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('block');
            mainContent.classList.toggle('ml-0');
            mainContent.classList.toggle('ml-64');
        });

        // Close sidebar on mobile when clicking the close button
        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.add('hidden');
            sidebar.classList.remove('block');
            mainContent.classList.add('ml-0');
            mainContent.classList.remove('ml-64');
        });

        // Auto-hide sidebar on small screens
        function handleResize() {
            if (window.innerWidth < 1024) {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('block');
                mainContent.classList.add('ml-0');
                // mainContent.classList.remove('ml-64');
            } else {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('block');
                mainContent.classList.remove('ml-0');
                // mainContent.classList.add('ml-64');
            }
        }

        // Initial check on load
        handleResize();

        // Add resize event listener
        window.addEventListener('resize', handleResize);

        // Optional: Add toggle for desktop (if you want to allow collapsing)
        // const desktopToggle = document.createElement('button');
        // desktopToggle.innerHTML = '<i class="fas fa-chevron-left"></i>';
        // desktopToggle.className = 'hidden lg:block absolute -right-3 top-1/2 bg-white rounded-full w-6 h-6 shadow-md flex items-center justify-center text-primary-800 transform -translate-y-1/2';
        // desktopToggle.addEventListener('click', toggleDesktopSidebar);
        // sidebar.appendChild(desktopToggle);

        // function toggleDesktopSidebar() {
        //     sidebar.classList.toggle('w-64');
        //     sidebar.classList.toggle('w-20');
        //     mainContent.classList.toggle('ml-64');
        //     mainContent.classList.toggle('ml-20');
        //
        //     // Toggle text labels
        //     document.querySelectorAll('.sidebar-text').forEach(el => {
        //         el.classList.toggle('hidden');
        //     });
        //
        //     // Change icon
        //     if (sidebar.classList.contains('w-20')) {
        //         desktopToggle.innerHTML = '<i class="fas fa-chevron-right"></i>';
        //     } else {
        //         desktopToggle.innerHTML = '<i class="fas fa-chevron-left"></i>';
        //     }
        // }
    </script>
</body>
</html>