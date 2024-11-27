<div class="w-full">
  <!-- Button untuk membuka modal -->
  <button wire:click="openModal" class="rounded p-1 transition-all duration-300 hover:bg-red-50 hover:text-red-500">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="size-5"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
      />
    </svg>
  </button>

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
            <h3 class="sub-heading text-center sm:text-start" id="modal-title">Apakah Anda Yakin?</h3>
            <div class="mt-2">
              <p class="caption text-neutral-500">
                Apakah Anda yakin menghapus
                <span class="font-medium leading-relaxed text-red-500">{{ $name }}</span>
                ? Semua data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
              </p>
            </div>
          </div>
        </div>
        <div class="py-3 sm:flex sm:flex-row-reverse">
          <button
            type="button"
            wire:click="destroy"
            class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm tracking-wide text-white shadow-sm transition duration-300 hover:bg-red-600 sm:ml-3 sm:w-auto"
          >
            Ya, Hapus
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
