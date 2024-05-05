<!doctype html>
<html lang="en-GB">
<head>
    <title>@yield('pageheader','Content not available') | Big Vision Games</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-600">
<div class="bg-blue-50">
    <!-- NavMenu -->
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button id="AWMenuButton" type="button"
                            class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
                          Icon when menu is closed.

                          Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg id="AWBurgerClosed" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <!--
                          Icon when menu is open.

                          Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg id="AWBurgerOpen" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="/">
                            <img class="h-8 w-auto"
                                 src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                 alt="Your Company">
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="{{route('products.index')}}"
                               class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                               aria-current="page">View Products</a>
                            <a href="#"
                               class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Contact
                                Us</a>
                        </div>
                    </div>

                </div>
                @if(Auth::user() != null)
                    <div id="basket" class="text-gray-50"><a href="{{route('account.basket')}}"><i
                                class="fa-solid fa-basket-shopping">
                                    <?php
                                        //This just gets the count of orderlines to display how many items are in the basket
                                    $order = App\Models\Order::where('CustomerId',  //Grab orders ID
                                        Illuminate\Support\Facades\Auth::user()->id)->where('Status', 'Basket')->first();

                                    if($order != null)
                                    {
                                        echo App\Models\OrderLine::all()
                                            ->where('OrderId', $order->id)
                                            ->count(); //Get count of all order lines
                                    }

                                    ?>
                            </i></a></div>

                    <!-- Settings Dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button"
                                    class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span
                                class="text-2xl right-0 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-white h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </span>
                            </button>
                        </div>

                        <!--
                          Dropdown menu, show/hide based on menu state.

                          Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"-->
                        <div id="profile-menu"
                             class="absolute hidden grid-cols-1 right-0 z-10 w-96 sm:w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                             role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="{{route("dashboard")}}" class="block px-4 py-2 text-2xl sm:text-sm text-gray-700"
                               role="menuitem" tabindex="-1" id="user-menu-item-0">Dashboard</a>
                            <a href="{{route("profile.edit")}}"
                               class="block px-4 py-2 text-2xl sm:text-sm text-gray-700" role="menuitem" tabindex="-1"
                               id="user-menu-item-1">Edit Profile</a>
                            <form id="userLogout" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{route("logout")}}"
                                   onclick="event.preventDefault();document.getElementById('userLogout').submit()"
                                   class="block px-4 py-2 text-2xl sm:text-sm text-gray-700" role="menuitem"
                                   tabindex="-1" id="user-menu-item-2">Sign out</a>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                        <div class="flex space-x-4">
                            <a href="{{route('login')}}"
                               class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Login</a>
                            <a href="{{route('register')}}"
                               class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Register</a>
                        </div>
                    </div>
                @endif



                <!-- Notification bell
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
                -->

                <!-- Profile dropdown
                <div class="relative ml-3">
                    <div>
                        <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                    </div>

                    <!--
                      Dropdown menu, show/hide based on menu state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"

                    <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: ""
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                    </div>
                </div>
            </div>
            -->
            </div>

        </div>

        <!-- MOBILE MENU -->
        <div class="sm:hidden hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{route('products.index')}}"
                   class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a>
                <a href="#"
                   class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Team</a>
                <a href="#"
                   class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Projects</a>
                <a href="#"
                   class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Calendar</a>
            </div>
        </div>
    </nav>
    <!-- Content of page-->
    <div class="grid-cols-1 md:text-6xl text-3xl text-center m-5">
        <h1>@yield('pageheader',"Big Vision Studio")</h1>
    </div>

    <div class="my-10 mx-5">
        @yield('content',"Content not available")
    </div>
</div>

<!-- FOOTER -->
<div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-12 content-center text-center bg-gray-600 text-blue-100">
    <div class="md:mr-20 md:border-r-2 md:border-black md:p-10 md:h-10"><p>Contact Information</p></div>
    <div><p>Quick link</p></div>
    <div class="md:ml-20 md:border-l-2 md:border-black md:p-10 md:h-10"><p>Socials</p></div>
</div>
</body>
</html>
