<!doctype html>
<html lang="en-GB">
<head>
    <title>@yield('pageheader','Content not available') | Big Vision Games</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resource/')
</head>
<body class="bg-red-900 text-white font-bold">
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-red-600 text-white font-bold">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{route('admin.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->role != "Warehouse")
            <li>
                <a href="{{route('admin.users')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">View Users</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.appointments')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">View Appointments</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.orders')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">View Orders</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->role != "Store")
                <li>
                    <a href="{{route('admin.products')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="flex-1 ms-3 whitespace-nowrap">View Products</span>
                    </a>
                </li>
            @endif
            <li>
                <form id="userLogout" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route("logout")}}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                       onclick="event.preventDefault();document.getElementById('userLogout').submit()"
                       tabindex="-1" id="user-menu-item-2">
                        <span class="flex-1 ms-3 whitespace-nowrap">Log out</span></a>
                </form>
            </li>
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="flex-1 ms-3 whitespace-nowrap">Return to website</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<div id="main-body" class="p-4 sm:ml-64">
        @yield("content")
</div>
</body>
</html>
