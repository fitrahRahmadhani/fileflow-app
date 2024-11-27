<div class="dashboard-container">
  <div class="section-wrapper">
    <div class="title-wrapper">
      <h2 class="heading">Kategori</h2>
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
              placeholder="Cari kategori"
              required
            />
          </div>
        </div>
        <a href="{{ route('categories.create') }}" class="btn-success w-fit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path
              d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z"
            />
          </svg>

          <span class="hidden md:inline">Tambah Kategori</span>
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
              <th scope="col" class="px-6 py-5">Nama</th>
              <th scope="col" class="px-6 py-5">Keterangan</th>
              <th scope="col" class="px-4 py-5">Jumlah Dokumen</th>
              <th scope="col" class="px-6 py-5">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach ($categories as $index => $category)
              <tr class="bg-white">
                <th scope="row" class="whitespace-nowrap px-4 py-4">
                  {{ ($categories->currentPage() - 1) * $categories->perPage() + $index + 1 }}
                </th>
                <td class="px-6 py-4">
                  {{ $category->nama }}
                </td>
                <td class="px-6 py-4">
                  {{ $category->keterangan }}
                </td>
                <td class="px-6 py-4">
                  {{ $category->getCountDocument() }}
                </td>
                <td class="flex gap-3 px-6 py-4">
                  <a
                    href="{{ route('categories.edit', $category->slug) }}"
                    class="rounded p-1 transition-all duration-300 hover:bg-yellow-50 hover:text-yellow-600"
                  >
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
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                      />
                    </svg>
                  </a>
                  <livewire:components.delete-modal :key="$category->id" :id="$category->id" :name="$category->nama" />
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @if (! $categories->count())
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

      @if ($categories->count())
        <div class="pt-4">
          {{ $categories->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
