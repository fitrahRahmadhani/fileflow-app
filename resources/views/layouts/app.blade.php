<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title ?? ' ' }} | FileFlow</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="font-sans antialiased">
    <div class="flex min-h-screen w-full flex-col justify-between bg-white lg:bg-neutral-50">
      {{-- Start Header --}}
      <livewire:components.header />
      {{-- End Header --}}

      {{-- Start Main Section --}}
      <main class="w-full flex-grow lg:pb-10 lg:pt-10">
        <section class="mx-auto flex max-w-[1440px] justify-between">
          {{-- Start Navigation --}}
          <livewire:components.navigation />
          {{-- End Navigation --}}
          {{ $slot }}
        </section>
      </main>
      {{-- End Main Section --}}
    </div>
    <x-toaster-hub />
  </body>
</html>
