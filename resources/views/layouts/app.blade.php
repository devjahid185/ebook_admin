<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Dashboard')</title>

    {{-- Dynamic Favicon --}}
    

    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            600: '#2a2185'
                        }
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @stack('styles')
</head>

<body class="min-h-screen bg-white text-slate-800">
    <!-- ✅ Toast Container -->
    <div x-data="{ show: false, message: '', type: '' }"
        x-show="show"
        x-transition
        x-init="
        window.addEventListener('toast', e => {
            message = e.detail.message;
            type = e.detail.type;
            show = true;
            setTimeout(() => show = false, 3000);
        });
     "
        class="fixed top-5 left-1/2 transform -translate-x-1/2 z-[9999]">
        <div x-show="show"
            x-transition
            :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'"
            class="text-black px-6 py-3 rounded-full shadow-lg text-center text-sm font-semibold">
            <span x-text="message"></span>
        </div>
    </div>
    <div class="relative">
        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-72 bg-brand-600 text-white shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-50">
            <div class="h-16 flex items-center px-4 border-b border-white/10">
                <span class="flex items-center gap-2 font-semibold">
                    <img src="{{ asset('images/logo.png') }}" alt="BDStore" class="h-8 w-auto object-contain">
                    <span class="text-lg">Dashboard</span>
                </span>
            </div>

            {{-- Sidebar partial goes here --}}
            <div class="p-2">
                @include('partials.sidebar')
            </div>
        </aside>

        {{-- Overlay for mobile --}}
        <div id="overlay" class="hidden fixed inset-0 bg-black/40 md:hidden z-40"></div>

        {{-- Main area --}}
        <div class="md:ml-72 transition-[margin] duration-200">
            {{-- Topbar --}}
            <header class="h-16 flex items-center justify-between px-4 sm:px-6 border-b bg-white shadow-sm sticky top-0 z-30">

                <!-- Sidebar Toggle (Mobile) -->
                <button id="sidebarToggle" class="md:hidden p-2 -ml-2 rounded hover:bg-gray-100">
                    <ion-icon name="menu-outline" class="text-2xl text-gray-700"></ion-icon>
                </button>

                <!-- User Info -->
                <div class="flex items-center gap-4">

                    <!-- User Balances (Always Horizontal) -->
                    <div class="flex items-center gap-3 bg-gray-50 px-3 py-1.5 rounded-lg border text-xs sm:text-sm">

                        
                    </div>


                    

                </div>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-slate-200 focus:outline-none">
                        
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50">

                        <div class="px-4 py-2 border-b text-sm text-gray-700">
                            <p class="font-semibold">{{ auth()->user()->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">ID: #{{ auth()->id() }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <ion-icon name="person-outline" class="mr-2"></ion-icon> Profile
                        </a>

                        <a href="https://t.me/your_telegram_username_or_group" target="_blank"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <ion-icon name="paper-plane-outline" class="mr-2"></ion-icon> Join Telegram
                        </a>

                        <a href="https://wa.me/+8801742354495" target="_blank"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <ion-icon name="logo-whatsapp" class="mr-2"></ion-icon> Join WhatsApp
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <ion-icon name="log-out-outline" class="mr-2"></ion-icon> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>



            {{-- Page content --}}
            <main class="p-4 md:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- JS (Tailwind class toggle only; no custom CSS needed) --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        toggleBtn?.addEventListener('click', () => {
            if (sidebar.classList.contains('-translate-x-full')) openSidebar();
            else closeSidebar();
        });
        overlay?.addEventListener('click', closeSidebar);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });
    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            // ✅ Wait until Alpine fully initialized
            setTimeout(() => {
                @if(session('success'))
                console.log("✅ Success toast triggered");
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        message: "{{ session('success') }}",
                        type: 'success'
                    }
                }));
                @endif

                @if(session('error'))
                console.log("❌ Error toast triggered");
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        message: "{{ session('error') }}",
                        type: 'error'
                    }
                }));
                @endif

                @if($errors -> any())
                console.log("⚠️ Validation error toast triggered");
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        message: "{{ $errors->first() }}",
                        type: 'error'
                    }
                }));
                @endif
            }, 400);
        });
    </script>

    {{-- Ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    @stack('scripts')
</body>

</html>
