{{-- Start Header --}}
<header class="w-full border-b border-neutral-100 bg-white">
  <div
    x-data="{ isOpen: false }"
    class="relative mx-auto flex h-[70px] items-center justify-between md:h-[90px] md:px-4 lg:max-w-[1440px] lg:px-0"
  >
    <img class="ml-4 h-10 md:h-12" src="{{ asset('assets/SIG_Logo.svg') }}" alt="logo SIG" />
    <div x-on:click="isOpen = !isOpen" class="mr-4 flex gap-2 md:mr-0">
      <img
        class="h-12 w-12 rounded-full object-cover"
        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
        alt="Foto Profile"
      />
      <div
        :class="isOpen ? 'rotate-180 text-red-500' : 'rotate-0'"
        class="my-auto text-neutral-500 transition-all duration-300 hover:text-red-500"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="h-4 w-4"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
      </div>
    </div>
    <div
      x-cloak
      x-show="isOpen"
      @click.outside="isOpen = false"
      class="absolute right-4 top-20 z-10"
      id="mobile-menu"
    >
      <div class="w-[300px] rounded-xl border-2 border-neutral-100 bg-white p-4">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <div class="w-full space-y-1">
          <div class="mb-2 flex items-center gap-2">
            <img
              class="h-10 w-10 rounded-full object-cover"
              src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
              alt="Foto Profile"
            />
            <div>
              <h6 class="font-semibold">{{ $user->name }}</h6>
              <p class="text-sm text-neutral-500">{{ $user->email }}</p>
            </div>
          </div>

          <div class="space-y-3 border-t border-neutral-100 pt-4">
            <a href="" class="navlink w-full pl-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="size-5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"
                />
              </svg>
              Pusat Informasi
            </a>
            <button wire:click="logout" class="navlink w-full pl-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="size-5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"
                />
              </svg>
              Keluar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
{{-- End Header --}}

