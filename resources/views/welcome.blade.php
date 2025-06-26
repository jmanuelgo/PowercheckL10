<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowerCheck</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600" x-data="{ open: false }">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo (redirige a la página principal) -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('image/powercheck_logito.jpeg') }}" class="h-8" alt="Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">PowerCheck</span>
            </a>

            <!-- Button to toggle menu (hamburger) -->
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <!-- Botón "Get Started" que redirige al login -->
                <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Iniciar Sesión
                </a>
                <button @click="open = !open" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" :aria-expanded="open.toString()">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>

            <!-- Navbar links for desktop -->
            <div class="hidden md:flex items-center justify-between w-full md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Inicio</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Powerlifting/ABP</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Gyms</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden">
            <ul class="flex flex-col items-center p-4 space-y-4 bg-gray-50 dark:bg-gray-800">
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Inicio</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Powerlifting/ABP</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Gyms</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="bg-gray-800 text-white py-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="text-center">
                    <h1 class="text-4xl font-bold">PowerCheck</h1>
                    <p class="mt-4 text-xl">Una herramienta de seguimiento de rutinas para entrenadores y atletas</p>
                    <p class="mt-2 text-lg">Crea rutinas personalizadas y realiza seguimiento de la técnica mediante la cámara de tu teléfono celular.</p>
                </div>

                <!-- Image or Carousel -->
                <div class="mt-10 flex justify-center">
                    <img src="{{ asset('image/demo_image.jpg') }}" alt="PowerCheck Screenshot" class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            </div>
        </section>

        <!-- Philosophy and Powerlifting Sections -->
        <section class="py-20">
            <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Philosophy of the Association -->
                <div>
                    <h2 class="text-3xl font-semibold text-center mb-4">Filosofía de la Asociación</h2>
                    <p class="text-lg text-center">
                        La Asociación de Powerlifting Bolivia está comprometida con el crecimiento y desarrollo del powerlifting a nivel nacional, promoviendo la integración y el fortalecimiento físico de todos sus miembros.
                    </p>
                </div>
                <!-- What is Powerlifting -->
                <div>
                    <h2 class="text-3xl font-semibold text-center mb-4">¿Qué es Powerlifting?</h2>
                    <p class="text-lg text-center">
                        El powerlifting es un deporte de fuerza en el que los atletas levantan el máximo peso posible en tres movimientos: sentadilla, press de banca y deadlift. Es una disciplina que requiere de disciplina, técnica y constancia.
                    </p>
                </div>
            </div>
        </section>

        <!-- Gyms Section (to display data from the database) -->
        <section class="bg-gray-100 py-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <h2 class="text-3xl font-semibold text-center mb-6">Gyms Registrados</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Example of a gym card, replace with dynamic data from the database -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-2">Gym 1</h3>
                        <p class="text-sm">Ubicación: Santa Cruz, Bolivia</p>
                        <p class="mt-2 text-gray-600">Este gimnasio está equipado con las mejores máquinas para entrenamiento de fuerza.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-2">Gym 2</h3>
                        <p class="text-sm">Ubicación: La Paz, Bolivia</p>
                        <p class="mt-2 text-gray-600">Ofrecemos entrenamientos especializados en powerlifting.</p>
                    </div>
                    <!-- Add more gym cards dynamically here -->
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-secundary text-white py-4 text-center">
        <p>&copy; 2025 PowerCheck | Todos los derechos reservados</p>
    </footer>

    <!-- Add Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>
</html>
