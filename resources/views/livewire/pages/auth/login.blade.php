<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
  public LoginForm $form;

  /**
   * Handle an incoming authentication request.
   */
  public function login(): void
  {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(default: route('documents.index', absolute: false), navigate: true);
  }
}; ?>

<div x-cloak class="flex h-screen w-full items-center justify-center bg-white md:bg-gray-100">
  <div
    class="mx-auto flex w-[520px] flex-col gap-10 rounded-none bg-white p-5 shadow-none md:rounded-xl md:p-10 md:shadow-xl"
  >
    <div class="flex items-center gap-6">
      <img src="{{ asset('assets/logo/logo_kabupaten_malang.svg') }}" class="h-14" alt="" />
      <div>
        <h2 class="text-2xl font-bold md:text-3xl">Masuk Akun</h2>
        <p class="font-base text-neutral-500">Arsip Desa Karangduren</p>
      </div>
    </div>
    <form wire:submit="login" class="space-y-6" x-data="{ show: true }">
      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />
      <!-- Email Address -->
      <label for="email" class="block">
        <span class="text-lg">Email</span>
        <input
          type="email"
          name="email"
          id="email"
          autocomplete="off"
          class="@error('form.email') input-error @else input @enderror"
          wire:model.live.debounce.800ms="form.email"
        />
        @error('form.email')
          <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
        @enderror
      </label>

      <!-- Password -->
      <label for="password" class="flex flex-col items-end">
        <span class="w-full text-lg">Password</span>
        <div class="relative h-fit w-full">
          <input
            :type="show ? 'password' : 'text'"
            name="password"
            id="password"
            autocomplete="off"
            class="@error('form.password') input-error @else input @enderror"
            wire:model.live.debounce.800ms="form.password"
          />
          <div class="absolute top-0 flex h-full w-full items-center justify-end text-neutral-500">
            <button type="button" @click="show = !show" :class="{'hidden': !show, 'block': show }" class="mr-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
            </button>
            <button type="button" @click="show = !show" :class="{'block': !show, 'hidden': show }" class="mr-3">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                />
              </svg>
            </button>
          </div>
        </div>

        @error('form.password')
          <span class="mt-1 w-full text-sm text-red-500">{{ $message }}</span>
        @enderror
      </label>

      <div class="flex flex-col items-center justify-end gap-2 pt-6">
        <x-primary-button wire:target="login" class="flex w-full items-center justify-center">
          <svg
            wire:loading
            wire:target="login"
            class="mr-2 block h-5 w-5 animate-spin text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
          >
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
          </svg>
          {{ __('Masuk') }}
        </x-primary-button>
        <p class="text-center text-slate-500">
          Belum punya akun?
          <a
            href="{{ route('register') }}"
            class="font-semibold text-gray-500 transition-all duration-300 hover:text-gray-700 hover:underline"
          >
            Daftar
          </a>
        </p>
      </div>
    </form>
  </div>
</div>
