<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartAppointment</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts

    <style>
        body {
            background-color: #F9FBFF; /* clean soft background */
        }
        .sidebar {
            background: #be185d; /* pink-700 */
        }
        .sidebar a {
            transition: 0.2s;
        }
        .sidebar a:hover {
            background-color: rgba(255,255,255,0.25);
        }
        .nav-icon, .nav-label {
            color: #e0e3ec; /* navy blue */
        }
        .main-content {
            margin-left: 16rem;
            padding: 2rem;
            transition: 0.25s;
        }
        @media (max-width: 640px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="font-sans">

<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
    aria-controls="sidebar-multi-level-sidebar"
    class="inline-flex items-center p-2 mt-2 ms-3 text-gray-700 rounded-lg sm:hidden hover:bg-gray-100">
    <i class="ri-menu-3-line text-xl"></i>
</button>

<!-- ✅ Sidebar (PINK 700 + Navy text/icons) -->
<aside id="sidebar-multi-level-sidebar"
    class="sidebar fixed top-0 left-0 z-40 w-64 h-screen transition-transform sm:translate-x-0 -translate-x-full">

    <div class="h-full px-4 py-6">

        <!-- LOGO -->
        <div class="text-center flex flex-col items-center border-b border-white/40 pb-4">
            <img src="{{asset('images/wbms.png')}}" class="rounded-full w-20 h-20 object-cover shadow" alt="">
            <h2 class="font-bold text-xl mt-2 text-white">WBMS</h2>
            <span class="text-white text-sm">Admin Panel</span>
        </div>

        <!-- NAVIGATION -->
        <ul class="space-y-2 font-medium mt-4">

            <li>
                <a href="{{route('admindashboard')}}" class="flex items-center p-2 rounded-md hover:bg-white/25">
                    <i class="ri-dashboard-fill text-2xl nav-icon"></i>
                    <span class="ms-3 nav-label font-semibold">Dashboard</span>
                </a>
            </li>
        <li>
    <a href="{{route('admin.services')}}" class="flex items-center p-2 rounded-md hover:bg-white/25">
        <i class="ri-tools-fill text-2xl nav-icon"></i>
        <span class="ms-3 nav-label font-semibold">Manage Services</span>
    </a>
</li>


            <li>
                <a href="{{route('admin.bookings')}}" class="flex items-center p-2 rounded-md hover:bg-white/25">
                    <i class="ri-calendar-event-fill text-2xl nav-icon"></i>
                    <span class="ms-3 nav-label font-semibold">Bookings</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.approved')}}" class="flex items-center p-2 rounded-md hover:bg-white/25">
                    <i class="ri-check-double-fill text-2xl nav-icon"></i>
                    <span class="ms-3 nav-label font-semibold">Approved Bookings</span>
                </a>
            </li>

            {{-- <li>
                <a href="" class="flex items-center p-2 rounded-md hover:bg-white/25">
                    <i class="ri-megaphone-fill text-2xl nav-icon"></i>
                    <span class="ms-3 nav-label font-semibold">Reports</span>
                </a>
            </li> --}}



        </ul>
    </div>
</aside>


<div class="main-content">
    <main>
        {{ $slot }}
    </main>
</div>


<form method="POST" action="{{ route('logouts') }}" class="absolute top-4 right-4">
    @csrf
    <button type="submit"
        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition">
        <i class="ri-logout-box-r-fill mr-2"></i> Logout
    </button>
</form>

</body>
</html>
