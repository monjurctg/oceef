<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadet Profile - {{ $reg->full_name_en }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(180deg, #1e1b4b 0%, #312e81 100%);
            color: #e5e7eb;
            margin: 0;
            min-height: 100vh;
            display: flex;
        }
        .container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        .sidebar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            width: 280px;
            flex-shrink: 0;
            padding: 1.5rem;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 10;
        }
        .main-content {
            margin-left: 280px;
            flex-grow: 1;
            overflow-y: auto;
            height: 100vh;
            padding: 2rem;
            scrollbar-width: thin;
            scrollbar-color: #14b8a6 #1e1b4b;
        }
        .main-content::-webkit-scrollbar {
            width: 8px;
        }
        .main-content::-webkit-scrollbar-track {
            background: #1e1b4b;
        }
        .main-content::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 4px;
        }
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .content-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.2);
            color: #e5e7eb;
            transition: background 0.3s ease;
        }
        .badge:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .action-button {
            transition: background 0.2s ease, transform 0.2s ease;
        }
        .action-button:hover {
            transform: scale(1.05);
        }
        .section-anchor {
            display: block;
            padding: 0.75rem 1.5rem;
            color: #e5e7eb;
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.2s ease;
        }
        .section-anchor:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .section-anchor.active {
            background: #14b8a6;
        }
        .info-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 400;
        }
        .info-value {
            color: #1f2937;
            font-size: 1rem;
            font-weight: 500;
        }
        .mobile-sidebar-toggle {
            display: none;
        }
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 75%;
                max-width: 280px;
                height: 100%;
                transition: left 0.3s ease;
            }
            .sidebar.open {
                left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            .mobile-sidebar-toggle {
                display: block;
            }
        }
        @media print {
            body {
                background: white;
                color: #000;
                display: block;
            }
            .sidebar, .no-print {
                display: none;
            }
            .main-content {
                margin-left: 0;
                height: auto;
                overflow: visible;
                padding: 0;
            }
            .content-card {
                box-shadow: none;
                transform: none;
                background: white;
            }
            .info-value {
                color: #000;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar no-print">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white">Profile Navigation</h2>
                <button class="mobile-sidebar-toggle lg:hidden text-white" onclick="toggleSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <nav class="space-y-2">
                <a href="#overview" class="section-anchor active">Overview</a>
                <a href="#personal" class="section-anchor">Personal Information</a>
                <a href="#contact" class="section-anchor">Contact Information</a>
                <a href="#cadetship" class="section-anchor">Cadetship Information</a>
                @if($reg->junior_division == 'YES')
                <a href="#junior" class="section-anchor">Junior Division</a>
                @endif
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="flex flex-col md:flex-row justify-between items-center mb-8 no-print">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-white">Cadet Profile</h1>
                    <p class="text-lg text-gray-300">Omargoni MES College Ex-Cadet Forum</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('registrations.index') }}" class="action-button px-6 py-3 bg-white text-gray-800 rounded-lg hover:bg-gray-100 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </a>
                    <button onclick="window.print()" class="action-button px-6 py-3 bg-teal-500 text-white rounded-lg hover:bg-teal-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                        </svg>
                        Print Profile
                    </button>
                </div>
            </header>

            <!-- Overview Section -->
            <section id="overview" class="content-card p-8 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-shrink-0">
                        @if ($reg->photo)
                            <img src="{{ asset('/public/uploads/' . $reg->photo) }}" alt="Cadet Photo" class="w-52 h-52 object-cover rounded-full border-4 border-teal-200/50 shadow-lg">
                        @else
                            <div class="w-52 h-52 bg-gray-200/30 rounded-full flex items-center justify-center text-gray-400 border-4 border-teal-200/50 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-3xl font-bold text-gray-900">{{ $reg->full_name_en }}</h2>
                        <p class="text-xl text-gray-600 mt-1">{{ $reg->full_name_bn }}</p>
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-6">
                            <span class="badge bg-teal-500">Cadet No: {{ $reg->cadetship_no }}</span>
                            <span class="badge bg-indigo-500">Rank: {{ $reg->last_rank }}</span>
                            <span class="badge bg-purple-500">Batch: {{ $reg->cadetship_year }}</span>
                            @if($reg->membership_type)
                            <span class="badge bg-amber-500">Member: {{ $reg->membership_type }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <!-- Personal Information -->
            <section id="personal" class="content-card p-8 mb-8">
                <h3 class="text-xl font-semibold text-gray-900">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <p class="info-label">Father's Name</p>
                        <p class="info-value">{{ $reg->father_name }}</p>
                    </div>
                    <div>
                        <p class="info-label">Mother's Name</p>
                        <p class="info-value">{{ $reg->mother_name }}</p>
                    </div>
                    <div>
                        <p class="info-label">Date of Birth</p>
                        <p class="info-value">{{ $reg->dob }}</p>
                    </div>
                    <div>
                        <p class="info-label">NID Number</p>
                        <p class="info-value">{{ $reg->nid_number }}</p>
                    </div>
                    <div>
                        <p class="info-label">Religion</p>
                        <p class="info-value">{{ $reg->religion }}</p>
                    </div>
                    <div>
                        <p class="info-label">Blood Group</p>
                        <p class="info-value">{{ $reg->blood_group }}</p>
                    </div>
                </div>
            </section>

       @php
    $socials = json_decode($reg->social_media, true);
@endphp

<!-- Contact Information -->
<section id="contact" class="content-card p-8 mb-8">
    <h3 class="text-xl font-semibold text-gray-900">Contact Information</h3>

    <div class="space-y-6 mt-6">
        <div>
            <p class="info-label">Present Address</p>
            <p class="info-value">{{ $reg->present_address }}</p>
        </div>
        <div>
            <p class="info-label">Permanent Address</p>
            <p class="info-value">{{ $reg->permanent_address }}</p>
        </div>
        <div>
            <p class="info-label">Mobile</p>
            <p class="info-value">{{ $reg->personal_cell }}</p>
        </div>
        <div>
            <p class="info-label">Email</p>
            <p class="info-value">{{ $reg->email }}</p>
        </div>

        @if (!empty($socials) && collect($socials)->filter()->isNotEmpty())
            <div>
                <p class="info-label">Social Media</p>
                <div class="flex items-center space-x-4 mt-2">
                    @if (!empty($socials['facebook']))
                        <a href="{{ $socials['facebook'] }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                            <!-- Facebook Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12a10 10 0 10-11.6 9.9v-7H8v-3h2.4V9.5a3.3 3.3 0 013.5-3.5H16v3h-1.5c-1 0-1.2.5-1.2 1.1V12h2.7l-.4 3h-2.3v7A10 10 0 0022 12z"/>
                            </svg>
                        </a>
                    @endif
                    @if (!empty($socials['x']))
                        <a href="{{ $socials['x'] }}" target="_blank" class="text-black hover:text-gray-800">
                            <!-- X (Twitter) Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.4 3H21l-6.6 7.4L22 21h-6.7l-4.3-5.6L6.1 21H3l7.3-8.2L2 3h6.8l4 5.3L18.4 3z"/>
                            </svg>
                        </a>
                    @endif
                    @if (!empty($socials['linkedin']))
                        <a href="{{ $socials['linkedin'] }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                            <!-- LinkedIn Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.77 0 5-2.24 5-5v-14c0-2.76-2.23-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.28c-.97 0-1.75-.78-1.75-1.75S5.53 4.22 6.5 4.22c.97 0 1.75.78 1.75 1.75s-.78 1.75-1.75 1.75zM20 19h-3v-5.5c0-1.1-.9-2-2-2s-2 .9-2 2V19h-3v-10h3v1.4c.52-.9 1.62-1.4 2.75-1.4 2.07 0 3.75 1.68 3.75 3.75V19z"/>
                            </svg>
                        </a>
                    @endif
                    @if (!empty($socials['instagram']))
                        <a href="{{ $socials['instagram'] }}" target="_blank" class="text-pink-600 hover:text-pink-800">
                            <!-- Instagram Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 2 .3 2.5.6.6.3 1.1.8 1.4 1.4.3.5.5 1.3.6 2.5.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.3 2-.6 2.5-.3.6-.8 1.1-1.4 1.4-.5.3-1.3.5-2.5.6-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-2-.3-2.5-.6-.6-.3-1.1-.8-1.4-1.4-.3-.5-.5-1.3-.6-2.5-.1-1.2-.1-1.6-.1-4.8s0-3.6.1-4.8c.1-1.2.3-2 .6-2.5.3-.6.8-1.1 1.4-1.4.5-.3 1.3-.5 2.5-.6 1.2-.1 1.6-.1 4.8-.1zm0-2.2c-3.3 0-3.7 0-5 .1-1.3.1-2.3.3-3.1.6-1.1.4-2 .9-2.9 1.8s-1.4 1.8-1.8 2.9c-.3.8-.5 1.8-.6 3.1-.1 1.3-.1 1.7-.1 5s0 3.7.1 5c.1 1.3.3 2.3.6 3.1.4 1.1.9 2 1.8 2.9s1.8 1.4 2.9 1.8c.8.3 1.8.5 3.1.6 1.3.1 1.7.1 5 .1s3.7 0 5-.1c1.3-.1 2.3-.3 3.1-.6 1.1-.4 2-.9 2.9-1.8s1.4-1.8 1.8-2.9c.3-.8.5-1.8.6-3.1.1-1.3.1-1.7.1-5s0-3.7-.1-5c-.1-1.3-.3-2.3-.6-3.1-.4-1.1-.9-2-1.8-2.9s-1.8-1.4-2.9-1.8c-.8-.3-1.8-.5-3.1-.6-1.3-.1-1.7-.1-5-.1zM12 5.8a6.2 6.2 0 100 12.4 6.2 6.2 0 000-12.4zm0 10.2a4 4 0 110-8 4 4 0 010 8zm6.4-10.9a1.4 1.4 0 11-2.8 0 1.4 1.4 0 012.8 0z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>


    
<!-- Cadetship Information -->
<section id="cadetship" class="content-card p-8 mb-8 bg-white rounded-lg shadow-md">
    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Cadetship Information</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-6">
            <div>
                <p class="info-label text-sm font-semibold text-gray-600">Cadetship Year</p>
                <p class="info-value text-lg text-gray-900">{{ $reg->cadetship_year }}</p>
            </div>
            <div>
                <p class="info-label text-sm font-semibold text-gray-600">Cadetship Number</p>
                <p class="info-value text-lg text-gray-900">{{ $reg->cadetship_no }}</p>
            </div>
            <div>
                <p class="info-label text-sm font-semibold text-gray-600">Last Rank</p>
                <p class="info-value text-lg text-gray-900">{{ $reg->last_rank }}</p>
            </div>
        </div>

        <!-- Training Camps (Scrollable) -->
        <div>
            <p class="text-xl font-semibold text-gray-800 mb-4">Training Camps</p>
            <div class="max-h-[400px] overflow-y-auto space-y-4 pr-2">
                @php $camps = json_decode($reg->training_camps, true); @endphp
                @if (!empty($camps))
                    @foreach ($camps as $camp)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <p class="text-gray-800 font-semibold">{{ $camp['name'] ?? 'N/A' }} <span class="text-sm text-gray-500">({{ $camp['year'] ?? 'N/A' }})</span></p>
                            @if (!empty($camp['rank']))
                                <p class="text-sm text-gray-600">Rank: {{ $camp['rank'] }}</p>
                            @endif
                            @if (!empty($camp['camp_appointment']))
                                <p class="text-sm text-gray-600">Appointment: {{ $camp['camp_appointment'] }}</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 italic">No training camps recorded.</p>
                @endif
            </div>
        </div>
    </div>

         @php
            $references = json_decode($reg->reference, true);
        @endphp
        
        @if (!empty($references))
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2">References</h2>
                
                <div class="overflow-x-auto">
                    <div class="flex gap-6 min-w-full pb-2">
                        @foreach ($references as $ref)
                            <div class="min-w-[250px] bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition duration-300 flex-shrink-0">
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Name</p>
                                    <p class="text-base text-gray-900 font-semibold">{{ $ref['name'] ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Rank</p>
                                    <p class="text-base text-gray-900">{{ $ref['rank'] ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Phone</p>
                                    <p class="text-base text-gray-900">{{ $ref['phone'] ?? 'N/A' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        
        @php
    $bncc_officers_names = json_decode($reg->bncc_officers_names, true); 
@endphp

@if (!empty($bncc_officers_names))
    <div class="mt-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">BNCC Officers Known from Platoon</h2>
        <ul class="list-disc list-inside text-gray-800 space-y-1">
            @foreach ($bncc_officers_names as $officer)
                <li>{{ $officer }}</li>
            @endforeach
        </ul>
    </div>
@endif


</section>


            <!-- Junior Division (Conditional) -->
            @if($reg->junior_division == 'YES')
            <section id="junior" class="content-card p-8 mb-8">
                <h3 class="text-xl font-semibold text-gray-900">Junior Division Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <p class="info-label">Educational Institution</p>
                        <p class="info-value">{{ $reg->junior_institution }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="info-label">Cadetship Year</p>
                            <p class="info-value">{{ $reg->junior_cadetship_year }}</p>
                        </div>
                        <div>
                            <p class="info-label">Last Rank</p>
                            <p class="info-value">{{ $reg->junior_last_rank }}</p>
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <!-- Footer -->
            <footer class="text-center text-sm text-gray-400 mt-8 pt-6 border-t border-gray-600/50">
                <p>System generated document - {{ now()->format('d M Y h:i A') }}</p>
                <p class="mt-1">Omargoni MES College Ex-Cadet Forum</p>
            </footer>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('open');
        }

        // Smooth scroll within main-content
        document.querySelectorAll('.section-anchor').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.section-anchor').forEach(a => a.classList.remove('active'));
                this.classList.add('active');
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                const mainContent = document.querySelector('.main-content');
                const offsetTop = targetElement.offsetTop - mainContent.offsetTop;
                mainContent.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>