<div class="w-full">
  <!-- Button untuk membuka modal -->
  <button wire:click="openModal" type="button" class="btn-primary">Simpan</button>

  <!-- Modal -->
  @if ($isOpen)
    <div
      class="fixed inset-0 z-50 flex items-end justify-center bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out md:items-center"
    >
      <div
        @click.outside="$wire.closeModal()"
        class="scale-{{ $isOpen ? '100' : '0' }} opacity-{{ $isOpen ? '100' : '0' }} {{ $isOpen ? 'block' : 'hidden' }} w-[500px] transform rounded-lg bg-white p-6 shadow-lg transition-all duration-300 ease-in-out"
      >
        <div class="sm:flex sm:items-start">
          <div
            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
          >
            <svg
              class="h-6 w-6 text-red-600"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              aria-hidden="true"
              data-slot="icon"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
              />
            </svg>
          </div>
          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
            <h3 class="sub-heading text-center sm:text-start" id="modal-title">Konfirmasi Simpan Data</h3>
            <div class="mt-2">
              <p class="caption text-neutral-500">
                Harap tinjau kembali informasi yang telah dimasukkan untuk memastikan semuanya benar. Apakah Anda yakin
                ingin melanjutkan proses ini?
              </p>
            </div>
          </div>
        </div>
        <div class="pt-3 sm:flex sm:flex-row-reverse">
          <button
            type="submit"
            wire:click="closeModal"
            class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm tracking-wide text-white shadow-sm transition duration-300 hover:bg-red-600 sm:ml-3 sm:w-auto"
          >
            Ya, Simpan
          </button>
          <button
            type="button"
            wire:click="closeModal"
            class="mt-3 inline-flex w-full justify-center rounded-md bg-neutral-100 px-3 py-2 text-sm tracking-wide text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 transition duration-300 hover:bg-neutral-200 sm:mt-0 sm:w-auto"
          >
            Batal
          </button>
        </div>
      </div>
    </div>
  @endif
</div>
