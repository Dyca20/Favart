<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">

</head>

<body class="">

    <div class="flex flex-row  space-y-5 justify-between w-full h-20 px-2 py-4 bg-gray-50">

        <div class=" flex items-center justify-between text-gray-600 text-3xl px-5"><b>FavArt</b></div>

        <div class="flex flex-row flex-auto">
            <div class="px-2 hover:bg-pink-100 ">
                <div class="flex flex-row space-x-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500 " viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <h4 class="font-bold text-gray-500 hover:text-pink-600">Principal</h4>
                </div>
            </div>

            <div class="px-2 hover:bg-pink-100">
                <div class="flex flex-row space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <h4 class="font-bold text-gray-500 hover:text-pink-600">Comprar</h4>
                </div>
            </div>

            <div class="px-2 hover:bg-pink-100">
                <div class="flex flex-row space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="" />
                    </svg>
                    <h4 class="font-bold text-gray-500 hover:text-pink-600 ">Catálogo</h4>
                </div>
            </div>

            <div class="px-2 hover:bg-pink-100">
                <div class="flex flex-row space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <h4 class="font-regular text-gray-500 hover:text-pink-600">Services</h4>
                </div>
            </div>

        </div>
                <div class="text-sm lg:flex-grow">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <a class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-blue-500 hover:underline mr-4"
                                href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-blue-500 hover:underline mr-4"
                                href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        @endif
                    @else
                        <ul class="block mt-4 lg:inline-block lg:mt-0 text-white   mr-4">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
    </div>
    <div class="flex flex-row ">
        <div class="flex-auto ">
            <div class="flex flex-col">
                <div class="flex flex-col bg-white h-24 p-2 drop-shadow-2xl">
                    <div class="flex flex-row space-x-3">

                        <h4 class="font-bold text-gray-500 p-1 ">Dashboard</h4>

                    </div>
                    <p class="text-gray-400 p-1">30th October 2020 | 1st November 2020</p>
                </div>
                <div class="bg-blue-50 min-h-screen">
                    <div class=" mt-8 grid lg:grid-cols-3 sm:grid-cols-2 p-4 gap-10 ">
                        <!--Grid starts here-->
                        <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm">
                            <div>
                                <div class="text-sm text-gray-400 ">Check in Today</div>
                                <div class="flex items-center pt-1">
                                    <div class="text-3xl font-medium text-gray-600 ">34</div>
                                </div>
                            </div>
                            <div class="text-pink-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm">
                            <div>
                                <div class="text-sm text-gray-400 ">Check Out Today</div>
                                <div class="flex items-center pt-1">
                                    <div class="text-3xl font-medium text-gray-600 ">44</div>
                                </div>
                            </div>
                            <div class="text-pink-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm">
                            <div>
                                <div class="text-sm text-gray-400 ">Total Properties</div>
                                <div class="flex items-center pt-1">
                                    <div class="text-3xl font-medium text-gray-600 ">1000</div>
                                </div>
                            </div>
                            <div class="text-pink-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Grid ends here..-->

                    </div>



                    <div class=" mt-5 grid  lg:grid-cols-3  md:grid-cols-3 p-4 gap-3">

                        <div class="col-span-2 flex flex-col   p-8 bg-white rounded shadow-sm">
                            <b class="flex flex-row text-gray-500">Property Release for today</b>
                            <canvas class="p-5" id="chartLine"></canvas>
                        </div>

                        <div class=" flex flex-col   p-5 bg-white rounded shadow-sm">
                            <b class="flex flex-row text-gray-500">Occupancy Percentage</b>
                            <canvas class="p-5" id="chartRadar"></canvas>
                        </div>



                    </div>
                    <!--Table-->
                    <div class="p-4 font-bold text-gray-600">Clients</div>
                    <div class="grid  lg:grid-cols-1  md:grid-cols-1 p-4 gap-3">
                        <div
                            class="col-span-2 flex flex-auto items-center justify-between  p-5 bg-white rounded shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200 table-auto">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        Jane Cooper
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        jane.cooper@example.com
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Admin
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        Jane Cooper
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        jane.cooper@example.com
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Admin
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>

                                    <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="min-h-screen bg-gray-100 text-gray-800 antialiased px-4 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl mx-auto text-center">
            <span class="text-2xl font-light">Login to your account</span>
            <div class="relative mt-4 bg-white shadow-md sm:rounded-lg text-left">
                <div class="h-2 bg-indigo-400 rounded-t-md"></div>
                <div class="py-6 px-8">
                    <label class="block font-semibold">Username or Email<label>
                            <input type="text" placeholder="Email"
                                class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md">
                            <label class="block mt-3 font-semibold">Password<label>
                                    <input type="password" placeholder="Password"
                                        class=" border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-1 focus:ring-indigo-600 rounded-md">
                                    <div class="flex justify-between items-baseline">
                                        <button
                                            class="mt-4 bg-indigo-500 text-white py-2 px-6 rounded-lg">Login</button>
                                        <a href="#" class="text-sm hover:underline">Forgot password?</a>
                                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart line -->
    <script>
        const labels = ["January", "February", "March", "April", "May", "June"];
        const data = {
            labels: labels,
            datasets: [{
                label: "My First dataset",
                backgroundColor: "hsl(252, 82.9%, 67.8%)",
                borderColor: "hsl(252, 82.9%, 67.8%)",
                data: [0, 10, 5, 2, 20, 30, 45],
            }, ],
        };

        const configLineChart = {
            type: "line",
            data,
            options: {},
        };

        var chartLine = new Chart(
            document.getElementById("chartLine"),
            configLineChart
        );
    </script>

    <script>
        const dataRadar = {
            labels: [
                "Reservation 1",
                "Reservation 2",
                "Reservation 3",
                "Reservation 4",
                "Reservation 5",
                "Reservation 6",
                "Reservation 7",
            ],
            datasets: [{
                    label: "My First Dataset",
                    data: [65, 59, 90, 81, 56, 55, 40],
                    fill: true,
                    backgroundColor: "rgba(255,105,180)",
                    borderColor: "rgb(255,20,147)",
                    pointBackgroundColor: "rgb(133, 105, 241)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgb(133, 105, 241)",
                },
                {
                    label: "My Second Dataset",
                    data: [28, 48, 40, 19, 96, 27, 100],
                    fill: true,
                    backgroundColor: "rgba(255,105,180)",
                    borderColor: "rgb(0,191,255)",
                    pointBackgroundColor: "rgb(54, 162, 235)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgb(54, 162, 235)",
                },
            ],
        };

        const configRadarChart = {
            type: "radar",
            data: dataRadar,
            options: {},
        };

        var chartBar = new Chart(
            document.getElementById("chartRadar"),
            configRadarChart
        );
    </script>



</body>

</html>
