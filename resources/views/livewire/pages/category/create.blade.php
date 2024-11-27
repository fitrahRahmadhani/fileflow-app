<div class="dashboard-container">
  <div class="section-wrapper flex flex-col">
    <div class="title-wrapper flex-col items-start">
      <h2 class="heading">Tambah Kategori</h2>
      <ol class="flex items-center whitespace-nowrap">
        <li class="inline-flex items-center">
          <a
            class="flex items-center text-sm text-gray-400 transition duration-300 hover:font-medium hover:text-gray-600"
            href="{{ route('categories.index') }}"
          >
            Kategori
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
          <div class="flex items-center text-sm font-medium text-gray-500">Tambah Kategori</div>
        </li>
      </ol>
    </div>

    <form wire:submit.prevent="store" class="content-wrapper flex-auto flex-col justify-between">
      <div class="space-y-3">
        <label for="name" class="input-wrapper">
          <span class="input-label-required">Nama Kategori</span>
          <input
            type="text"
            name="name"
            id="name"
            autocomplete="off"
            placeholder="Masukkan nama kategori"
            class="@error('name') input-error @else input @enderror"
            wire:model.live.debounce.800ms="name"
          />
          @error('name')
            <span class="input-info-error">{{ $message }}</span>
          @enderror
        </label>
        <label for="description" class="input-wrapper">
          <span class="input-label-required">Deskripsi</span>
          <textarea
            name="description"
            id="description"
            rows="3"
            placeholder="Masukkan deskripsi kategori"
            class="@error('description') input-error @else input @enderror resize-none"
            wire:model.live.debounce.800ms="description"
          ></textarea>
          @error('description')
            <span class="input-info-error">{{ $message }}</span>
          @enderror
        </label>
      </div>

      <div class="mx-auto mb-20 flex gap-3 md:mb-0">
        <a href="{{ route('categories.index') }}" class="btn-secondary">Batal</a>
        <livewire:components.submit-modal />
      </div>
    </form>
  </div>
</div>
