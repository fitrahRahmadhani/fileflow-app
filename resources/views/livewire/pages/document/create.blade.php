<div class="dashboard-container">
  <div class="section-wrapper flex flex-col">
    <div class="title-wrapper flex-col items-start">
      <h2 class="heading">Tambah Arsip</h2>
      <ol class="flex items-center whitespace-nowrap">
        <li class="inline-flex items-center">
          <a
            class="flex items-center text-sm text-gray-400 transition duration-300 hover:font-medium hover:text-gray-600"
            href="{{ route('documents.index') }}"
          >
            Arsip
          </a>
          <svg
            class="mx-2 size-4 shrink-0 text-gray-400"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </li>
        <li class="inline-flex items-center">
          <div class="flex items-center text-sm font-medium text-gray-500">Tambah Arspi</div>
        </li>
      </ol>
    </div>
    <form
      enctype="multipart/form-data"
      wire:submit.prevent="store"
      class="content-wrapper flex-auto flex-col justify-between"
    >
      <div class="space-y-3">
        {{-- Nomor Surat --}}
        <label for="nomorSurat" class="input-wrapper">
          <span class="input-label-required">Nomor Surat</span>
          <input
            type="text"
            name="nomorSurat"
            id="nomorSurat"
            autocomplete="off"
            placeholder="Masukkan nomor surat"
            class="@error('nomorSurat') input-error @else input @enderror"
            wire:model.live.debounce.800ms="nomorSurat"
          />
          @error('nomorSurat')
            <span class="input-info-error">{{ $message }}</span>
          @enderror
        </label>

        {{-- Judul --}}
        <label for="title" class="input-wrapper">
          <span class="input-label-required">Judul Surat</span>
          <input
            type="text"
            name="title"
            id="title"
            autocomplete="off"
            placeholder="Masukkan judul surat"
            class="@error('title') input-error @else input @enderror"
            wire:model.live.debounce.800ms="title"
          />
          @error('title')
            <span class="input-info-error">{{ $message }}</span>
          @enderror
        </label>

        {{-- Kategori Surat --}}
        <label for="category" class="input-wrapper">
          <span class="input-label-required">Kategori Surat</span>
          <div class="relative w-full">
            <select
              name="category"
              id="category"
              wire:model.live.debounce.800ms="selectedCategory"
              class="@error('category') input-error @else input @enderror appearance-none"
            >
              <option value="">Pilih Kategori Surat</option>

              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nama }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 top-0 flex items-center pr-3"></div>
          </div>
          @error('selectedCategory')
            <span class="input-info-error">{{ $message }}</span>
          @enderror
        </label>

        {{-- Dokumen --}}
        <div
          x-cloak
          x-data="{ uploading: false, progress: 0 }"
          x-on:livewire-upload-start="uploading = true"
          x-on:livewire-upload-finish="uploading = false"
          x-on:livewire-upload-cancel="uploading = false"
          x-on:livewire-upload-error="uploading = false"
          x-on:livewire-upload-progress="progress = $event.detail.progress"
        >
          <label for="document" class="input-wrapper">
            <span class="input-label-required">Unggah Dokumen</span>
            <div class="@error('document') input-error @else input @enderror relative">
              <input
                type="file"
                name="document"
                id="document"
                autocomplete="off"
                class="caption @error('document') input-file-error @else input-file @enderror file:absolute file:right-2 file:top-[7px] file:rounded-md file:border-transparent file:px-4 file:outline file:outline-[1px] file:transition file:duration-300"
                wire:model="document"
              />
            </div>

            @error('document')
              <span class="input-info-error">{{ $message }}</span>
            @else
              <p class="mt-1 text-sm italic text-neutral-500">Hanya menerima file PDF, maksimal 10 MB</p>
            @enderror
          </label>
          <div x-show="uploading" class="relative mt-2 h-1 w-full">
            <progress class="progress-bar absolute h-full w-full" max="100" x-bind:value="progress"></progress>
          </div>
        </div>
      </div>
      <div class="mx-auto mb-20 flex gap-3 md:mb-0">
        <a href="{{ route('documents.index') }}" class="btn-secondary">Batal</a>
        <livewire:components.submit-modal />
      </div>
    </form>
  </div>
</div>
