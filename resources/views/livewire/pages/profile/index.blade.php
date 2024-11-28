<div x-data="{ profileUploaded: false }" class="dashboard-container">
  <div class="section-wrapper">
    <div class="title-wrapper">
      <h2 class="heading">Profil</h2>
    </div>
    <div class="content-wrapper">
      {{-- Banner --}}
      <div class="relative">
        <img
          class="h-[120px] w-full rounded-lg bg-gray-200 object-cover"
          src="{{ asset('storage/banners/default-banner.png') }}"
        />

        @if ($openPhotoEditor)
          <div class="absolute left-6 top-20 flex w-[calc(100%-1.5rem)] items-end justify-between">
            <form wire:submit="updatePhoto" class="flex w-full flex-col items-center gap-2">
              @csrf
              <div
                x-cloak
                class="input-wrapper w-full"
                x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false, profileUploaded = true"
                x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
              >
                <div class="flex items-end gap-10">
                  <div class="flex flex-col gap-2">
                    <div
                      class="relative flex h-24 w-24 items-center justify-center rounded-full bg-neutral-300 text-neutral-500"
                    >
                      @error('tempProfilePicture')
                        <img
                          class="h-24 w-24 rounded-full border-4 border-white object-cover drop-shadow-lg"
                          src="{{ asset('storage/' . $user->profile_picture) }}"
                        />
                      @else
                        @if ($tempProfilePicture)
                          <img
                            class="h-24 w-24 rounded-full border-4 border-white object-cover drop-shadow-lg"
                            src="{{ $tempProfilePicture->temporaryUrl() }}"
                          />
                        @elseif ($user->profile_picture)
                          <img
                            class="h-24 w-24 rounded-full border-4 border-white object-cover drop-shadow-lg"
                            src="{{ asset('storage/' . $user->profile_picture) }}"
                          />
                        @else
                          <img
                            class="h-24 w-24 rounded-full border-4 border-white object-cover drop-shadow-lg"
                            src="{{ asset('storage/profile-pictures/default-profile-picture.png') }}"
                          />
                        @endif
                      @enderror

                      <label for="tempProfilePicture">
                        <span
                          class="absolute -right-6 bottom-0 flex w-fit rounded-full border-4 border-white bg-gray-500 p-3 text-lg text-white transition-all duration-300 hover:bg-gray-600"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-6 w-6"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"
                            />
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"
                            />
                          </svg>
                        </span>
                        <input
                          type="file"
                          name="tempProfilePicture"
                          id="tempProfilePicture"
                          class="hidden"
                          wire:model.live.debounce.500ms="tempProfilePicture"
                        />
                      </label>
                    </div>
                  </div>

                  @error('tempProfilePicture')
                    <span class="rounded-md border border-gray-300 bg-gray-50 p-1 text-sm text-gray-500">
                      {{ $message }}
                    </span>
                  @else
                    <span class="text-sm italic text-neutral-400">Format : .jpg, .jpeg, .png (500kb max)</span>
                  @enderror
                </div>
                <div x-show="uploading" class="relative mt-2 h-1 w-full">
                  <progress class="progress-bar absolute h-full w-full" max="100" x-bind:value="progress"></progress>
                </div>
              </div>
              @error('tempProfilePicture')
              @else
                <div x-show="profileUploaded" class="flex justify-center gap-4">
                  <button wire:click="togglePhotoEditor" type="button" class="btn-secondary">Batal</button>
                  <div class="w-fit">
                    <livewire:components.submit-modal />
                  </div>
                </div>
              @enderror
            </form>
          </div>
        @else
          <div class="absolute left-6 top-20 flex w-[calc(100%-1.5rem)] items-end justify-between">
            <div class="flex items-end gap-4">
              <img
                class="h-24 w-24 rounded-full border-4 border-white bg-white object-cover drop-shadow-lg"
                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile-pictures/default-profile-picture.jpg') }}"
                alt=""
              />
              <div>
                <h3 class="sub-heading">{{ $user->nama }}</h3>
                <p class="caption text-neutral-500">{{ $user->email }}</p>
              </div>
            </div>
            <button
              wire:click="togglePhotoEditor"
              class="md:caption flex h-fit items-center gap-1 rounded-full border border-neutral-200 bg-neutral-50/50 px-4 py-2 text-xs transition duration-300 hover:bg-neutral-100"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-3 w-3 md:h-4 md:w-4"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"
                />
              </svg>
              Edit
            </button>
          </div>
        @endif
      </div>

      @if ($openProfileEditor)
        {{-- Edit - Data Diri --}}
        <form wire:submit="updateProfile" class="mt-16 rounded-xl border border-neutral-100 p-4">
          @csrf
          {{-- Title --}}
          <div class="flex justify-between">
            <h5 class="sub-heading font-medium">Edit Data Diri</h5>
          </div>
          {{-- Data --}}
          <div class="mt-4 grid w-full grid-cols-2 gap-4">
            {{-- Nama --}}
            <livewire:components.disabled-input label="Nama" content="{{ $user->nama }}" />
            {{-- Email --}}
            <livewire:components.disabled-input label="Email" content="{{ $user->email }}" />

            {{-- Nim --}}
            <label for="nim" class="input-wrapper">
              <span class="input-label-required">NIM</span>
              <input
                type="text"
                name="nim"
                id="nim"
                autocomplete="off"
                placeholder="Masukkan NIM"
                class="@error('nim') input-error @else input @enderror"
                wire:model.live.debounce.800ms="nim"
              />

              @error('nim')
                <span class="input-info-error">{{ $message }}</span>
              @enderror
            </label>

            {{-- Alamat --}}
            <label for="alamat" class="input-wrapper">
              <span class="input-label-required">Alamat</span>
              <input
                type="text"
                name="alamat"
                id="alamat"
                autocomplete="off"
                placeholder="Masukkan alamat"
                class="@error('alamat') input-error @else input @enderror"
                wire:model.live.debounce.800ms="alamat"
              />

              @error('alamat')
                <span class="input-info-error">{{ $message }}</span>
              @enderror
            </label>
          </div>
          <div class="mt-8 flex justify-center gap-4">
            <button wire:click="toggleProfileEditor" type="button" class="btn-secondary">Batal</button>
            <div class="w-fit">
              <livewire:components.submit-modal />
            </div>
          </div>
        </form>
      @else
        {{-- Data Diri --}}
        <div class="mt-24 overflow-hidden rounded-xl border border-neutral-100 p-4">
          {{-- Title --}}
          <div class="flex justify-between">
            <h5 class="sub-heading font-medium">Data Diri</h5>
            <button
              wire:click="toggleProfileEditor"
              class="md:caption flex items-center gap-1 rounded-full border border-neutral-200 bg-neutral-50/50 px-4 py-2 text-xs transition duration-300 hover:bg-neutral-100"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-3 w-3 md:h-4 md:w-4"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"
                />
              </svg>
              Edit
            </button>
          </div>
          {{-- Data --}}
          <div class="mt-4 grid w-full grid-cols-2 gap-4">
            {{-- Nama --}}
            <div class="flex flex-col gap-1">
              <p class="text-sm text-neutral-500">Nama</p>
              <p class="text-sm font-medium text-neutral-600 md:text-base">
                {{ $user->nama ?? '-' }}
              </p>
            </div>

            {{-- Email --}}
            <div class="flex flex-col gap-1">
              <p class="text-sm text-neutral-500">Email</p>
              <p class="text-sm font-medium text-neutral-600 md:text-base">
                {{ $user->email ?? '-' }}
              </p>
            </div>

            {{-- NIM --}}
            <div class="flex flex-col gap-1">
              <p class="text-sm text-neutral-500">NIM</p>
              <p class="text-sm font-medium text-neutral-600 md:text-base">
                {{ $user->nim ?? '-' }}
              </p>
            </div>

            {{-- Alamat --}}
            <div class="flex flex-col gap-1">
              <p class="text-sm text-neutral-500">Alamat</p>
              <p class="text-sm font-medium text-neutral-600 md:text-base">
                {{ $user->alamat ?? '-' }}
              </p>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
