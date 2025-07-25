<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('extraCss')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center shadow">
        <div class="text-xl font-bold">Admin Panel</div>
        <a href="{{ route('auth.logout') }}"" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600 transition">Logout</a>
    </nav>

    <!-- Main Layout -->
    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md border-r border-gray-200 hidden md:block">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2 border-gray-300">Navigation</h2>

                <ul class="space-y-1">
                    <li>
                        <a href="{{ Route('admin.index') }}"
                            class="block px-4 py-2 border border-gray-200 rounded hover:bg-blue-100 hover:border-blue-400 transition">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('admin.schoolDetailsView') }}"
                            class="block px-4 py-2 border border-gray-200 rounded hover:bg-blue-100 hover:border-blue-400 transition">
                            School Vacancy
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('admin.candidateList') }}"
                            class="block px-4 py-2 border border-gray-200 rounded hover:bg-blue-100 hover:border-blue-400 transition">
                            Candidate Revert
                        </a>
                    </li>
                </ul>
            </div>
        </aside>


        <!-- Content Area -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- *** Add Extra Js *** --}}
    @yield('extraJs')
</body>

</html>
