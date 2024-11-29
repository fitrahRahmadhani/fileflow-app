<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
  public string $nama = '';
  public string $email = '';
  public string $password = '';
  public string $password_confirmation = '';

  /**
   * Handle an incoming registration request.
   */
  public function register(): void
  {
    $validated = $this->validate([
      'nama' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
    ]);

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered(($user = User::create($validated))));

    Auth::login($user);

    $this->redirect(route('documents.index', absolute: false), navigate: true);
  }
}; ?>

<div class="flex min-h-screen w-full items-center justify-center bg-white md:bg-gray-100">
  <div
    class="mx-auto my-20 flex w-[520px] flex-col gap-10 rounded-none bg-white p-5 shadow-none md:rounded-xl md:p-10 md:shadow-xl"
  >
    <div class="flex items-center gap-6">
      <img src="{{ asset('assets/logo/logo_kabupaten_malang.svg') }}" class="h-14" alt="" />
      <div>
        <h2 class="text-2xl font-bold md:text-3xl">Daftar Akun</h2>
        <p class="font-base text-neutral-500">Arsip Desa Karangduren</p>
      </div>
    </div>
    <form wire:submit.prevent="register" class="space-y-6" x-data="{ show: true }">
      @csrf
      <!-- Name -->
      <label for="nama" class="block">
        <span class="text-lg after:ml-0.5 after:text-red-500 after:content-['*']">Nama Lengkap</span>
        <input
          type="text"
          name="nama"
          id="nama"
          autocomplete="off"
          class="@error('nama') input-error @else input @enderror"
          wire:model="nama"
        />
        @error('nama')
          <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
      </label>

      <!-- Email Address -->
      <label for="email" class="block">
        <span class="text-lg after:ml-0.5 after:text-red-500 after:content-['*']">Email</span>
        <input
          type="email"
          name="email"
          id="email"
          autocomplete="off"
          class="@error('email') input-error @else input @enderror"
          wire:model="email"
        />
        @error('email')
          <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
      </label>

      <!-- Password -->
      <label for="password" class="flex flex-col items-end">
        <span class="w-full text-lg after:ml-0.5 after:text-red-500 after:content-['*']">Password</span>
        <input
          type="password"
          name="password"
          id="password"
          autocomplete="off"
          class="@error('password') input-error @else input @enderror"
          wire:model="password"
        />
        @error('password')
          <span class="mt-1 w-full text-sm text-red-500">{{ $message }}</span>
        @enderror
      </label>

      <!-- Confirm Password -->
      <label for="password_confirmation" class="flex flex-col items-end">
        <span class="w-full text-lg">Konfirmasi Password</span>
        <input
          type="password"
          name="password_confirmation"
          id="password_confirmation"
          autocomplete="off"
          class="input"
          wire:model="password_confirmation"
        />
        @error('password_confirmation')
          <span class="mt-1 w-full text-sm text-red-500">{{ $message }}</span>
        @enderror
      </label>

      <div class="flex flex-col items-center justify-end gap-2 pt-6">
        <x-primary-button wire:target="register" class="flex w-full items-center justify-center">
          <svg
            wire:loading
            wire:target="register"
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
          {{ __('Daftar') }}
        </x-primary-button>
        <p class="text-center text-slate-500">
          Sudah punya akun?
          <a
            href="{{ route('login') }}"
            class="font-semibold text-gray-500 transition-all duration-300 hover:text-gray-700 hover:underline"
          >
            Masuk
          </a>
        </p>
      </div>
    </form>
  </div>
</div>
