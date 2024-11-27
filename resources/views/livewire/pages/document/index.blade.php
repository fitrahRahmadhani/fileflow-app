<div class="dashboard-container">
  <div class="section-wrapper">
    <div class="title-wrapper">
      <h2 class="heading">Arsip</h2>
      <div class="flex w-full flex-row gap-4 md:w-fit md:flex-row">
        <div class="mx-auto w-full md:w-fit md:max-w-md">
          <label for="default-search" class="sr-only mb-2 text-sm font-medium text-gray-900">Search</label>
          <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
              <svg
                class="h-3 w-3 text-gray-500"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
              </svg>
            </div>
            <input
              wire:model.live.debounce.800ms="search"
              type="text"
              class="block w-full rounded-lg border border-gray-200 bg-gray-50 p-2 ps-10 text-sm text-gray-900 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-neutral-500"
              placeholder="Cari judul dokumen"
              required
            />
          </div>
        </div>
        <a href="" class="btn-success w-fit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path
              d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z"
            />
          </svg>

          <span class="hidden md:inline">Tambah Arsip</span>
        </a>
      </div>
    </div>
    <div class="content-wrapper">
      <div
        class="relative h-full overflow-x-auto rounded-md border border-neutral-50 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-neutral-300 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-neutral-100 [&::-webkit-scrollbar]:h-1.5"
      >
        <table class="caption w-full text-left text-gray-500">
          <thead class="bg-gray-100 uppercase text-gray-700">
            <tr>
              <th scope="col" class="px-4 py-5">No</th>
              <th scope="col" class="px-6 py-5">Nomor Surat</th>
              <th scope="col" class="px-6 py-5">Kategori</th>
              <th scope="col" class="px-4 py-5">Judul</th>
              <th scope="col" class="px-4 py-5">Waktu Pengarsipan</th>
              <th scope="col" class="px-4 py-5">Pengarsip</th>
              <th scope="col" class="px-6 py-5">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach ($documents as $index => $document)
              <tr class="bg-white">
                <th scope="row" class="whitespace-nowrap px-4 py-4">
                  {{ ($documents->currentPage() - 1) * $documents->perPage() + $index + 1 }}
                </th>
                <td class="px-6 py-4">
                  {{ $document->nomor_surat }}
                </td>
                <td class="px-6 py-4">
                  {{ $document->category->name }}
                </td>
                <td class="px-6 py-4">
                  {{ $document->judul }}
                </td>
                <td class="px-6 py-4">
                  {{ $document->formatted_date }}
                </td>
                <td class="px-4 py-4">
                  {{ $document->user->name }}
                </td>
                <td class="px-6 py-4">
                  <a
                    href="{{ route('admin.intern.show', $document->slug) }}"
                    target="_blank"
                    class="btn-light px-2 py-1 text-xs"
                  >
                    Detail
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @if (! $documents->count())
          <div class="flex h-[350px] w-full flex-col items-center justify-center">
            <img class="w-[120px] opacity-50 grayscale" src="{{ asset('assets/page_state/no_result.png') }}" alt="" />
            <h5 class="mt-5 text-base font-medium text-neutral-400">Data tidak ditemukan</h5>
            <p class="mt-1 text-center text-xs leading-relaxed text-neutral-400">
              Coba persingkat atau perjelas kembali
              <br />
              pencarian Anda
            </p>
          </div>
        @endif
      </div>

      @if ($documents->count())
        <div class="pt-4">
          {{ $documents->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
