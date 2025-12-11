<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBMS - User Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        body {
            background: #F9FBFF;
        }
        .navbar {
            background: #be185d; /* pink-700 */
        }
        .nav-link {
            color: #e0e3ec; /* navy-ish */
            font-weight: 600;
            transition: .2s;
        }
        .nav-link:hover {
            color: white;
        }
        .main-content {
            padding: 2rem;
        }
    </style>
</head>
<body class="font-sans">

<!-- ✅ TOP NAVBAR -->
<nav class="navbar border-b border-white/20">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">


            <div class="flex items-center space-x-3">
                <img src="{{asset('images/wbms.png')}}" class="w-12 h-12 rounded-full object-cover">
                <span class="text-white text-xl font-bold">WBMS</span>
            </div>

            <button data-collapse-toggle="navbar-dropdown" type="button"
                class="inline-flex items-center p-2 text-white rounded-lg sm:hidden hover:bg-white/20">
                <i class="ri-menu-line text-xl"></i>
            </button>


            <div id="navbar-dropdown" class="hidden sm:flex space-x-6 items-center">

                <a href="{{route('userdashboard')}}" class="nav-link flex items-center space-x-1">
                    <i class="ri-dashboard-fill text-lg"></i><span>Home</span>
                </a>



                <a href="{{route('user.packages')}}" class="nav-link flex items-center space-x-1">
                    <i class="ri-calendar-event-fill text-lg"></i><span>Packages</span>
                </a>

                <a href="{{route('user.mybook')}}" class="nav-link flex items-center space-x-1">
                    <i class="ri-calendar-event-fill text-lg"></i><span>My Bookings</span>
                </a>

                {{-- <a href="" class="nav-link flex items-center space-x-1">
                    <i class="ri-user-fill text-lg"></i><span>Profile</span>
                </a> --}}


                <form method="POST" action="{{ route('logouts') }}">
                    @csrf
                    <button type="submit"
                        class="bg-white/20 text-white px-4 py-2 rounded-md hover:bg-white/30 transition flex items-center">
                        <i class="ri-logout-box-r-fill mr-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>



<div class="main-content max-w-7xl mx-auto">
    {{ $slot }}
</div>

</body>
</html>
