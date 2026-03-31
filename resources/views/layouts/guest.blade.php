<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                background-color: #0F192A;
            }
            #particles-js {
                position: fixed;
                inset: 0;
                z-index: 0;
                pointer-events: none;
            }
            .auth-shell {
                position: relative;
                z-index: 1;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @if (request()->routeIs('login'))
            <div id="particles-js" aria-hidden="true"></div>
        @endif
        <x-cursor />
        <div
            class="auth-shell min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
            @if (request()->routeIs('login')) style="background: transparent;" @endif
        >
            <div>
              <a href="{{ route('admin.dashboard') }}">
              <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
              </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
{{ $slot }}
            </div>
        </div>
        @if (request()->routeIs('login'))
            <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    if (typeof particlesJS !== 'function' || !document.getElementById('particles-js')) {
                        return;
                    }

                    particlesJS('particles-js', {
                        particles: {
                            number: { value: 60 },
                            size: { value: 3 },
                            move: { speed: 1.5 },
                            line_linked: { enable: true, opacity: 0.2 },
                            color: { value: '#ffffff' }
                        }
                    });
                });
            </script>
        @endif
    </body>
</html>
