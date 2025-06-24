@props(['links'])

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'PowerCheck - Panel' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen bg-color-primary text-text-primary">

    <!-- SIDEBAR -->
    <aside class="hidden md:flex md:flex-col w-64 bg-color-secundary p-4 space-y-6">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <img src="{{ asset('image/powercheck_logito.jpeg') }}" alt="Logo" class="h-10 w-auto">
            <span class="text-xl font-semibold text-white">PowerCheck</span>
        </div>

        <!-- Links -->
        <nav class="space-y-2">
            @foreach ($links as $link)
                <a href="{{ $link['url'] }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium transition 
                          {{ $link['active'] ? 'bg-button-color text-white' : 'hover:bg-zinc-700 text-white' }}">
                    {!! $link['icon'] !!}
                    {{ $link['name'] }}
                </a>
            @endforeach
        </nav>

        <!-- FOOTER (Dropup PC) -->
        <div x-data="{ open: false }" class="relative mt-auto hidden md:block">
            <!-- Botón desplegable -->
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-white font-medium transition">
                <span>{{ Auth::user()->name }}</span>
                <svg :class="{ 'rotate-180': open }" class="h-4 w-4 transition-transform duration-300"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown hacia ABAJO -->
            <div x-show="open" @click.outside="open = false" x-transition
                class="absolute top-full mt-2 left-0 w-full bg-white text-zinc-800 rounded-lg shadow-lg z-50 overflow-hidden">
                <a href="{{ route('admin.configuracion') }}" class="block px-4 py-2 text-sm hover:bg-zinc-100 transition">
                    Configuración
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 transition">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>


    </aside>

    <!-- MOBILE MENU (Bottom) -->
    <nav
        class="fixed bottom-0 inset-x-0 bg-color-secundary flex justify-around md:hidden py-2 border-t border-gray-700 z-50">
        @foreach ($links as $link)
            <a href="{{ $link['url'] }}"
                class="flex flex-col items-center text-xs {{ $link['active'] ? 'text-button-color' : 'text-white' }}">
                {!! $link['icon'] !!}
                {{ $link['name'] }}
            </a>
        @endforeach

        <!-- Dropup User Menu -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex flex-col items-center text-white text-xs">
                <!-- Ícono usuario -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Perfil</span>
            </button>

            <div x-show="open" @click.away="open = false" x-transition
                class="absolute bottom-12 left-1/2 -translate-x-1/2 w-40 bg-zinc-900 text-white rounded-lg shadow-md z-50">
                <a href="{{ route('admin.configuracion') }}"
                    class="block px-4 py-2 hover:bg-zinc-700 text-sm text-center">Configuración</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 hover:bg-red-600 text-sm text-center">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </nav>


    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 space-y-4">
        @isset($header)
            <header class="border-b border-zinc-700 pb-4">
                {{ $header }}
            </header>
        @endisset
        @if (session('success'))
            <div class="p-4 mb-4 rounded-lg border border-green-300 bg-green-100 text-green-800 shadow">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2l4 -4m2 4a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="text-green-600 hover:text-green-800 text-sm font-bold">
                        ×
                    </button>
                </div>
            </div>
        @endif

        <section>
            {{ $slot }}
        </section>
    </main>

</body>

</html>
