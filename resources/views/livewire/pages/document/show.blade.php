<div class="dashboard-container">
  <div class="section-wrapper">
    <div class="title-wrapper flex-col items-start">
      <h2 class="heading">Detail Dokumen</h2>
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
          <div class="flex items-center text-sm font-medium text-gray-500">Detail Arspi</div>
        </li>
      </ol>
    </div>
    <div class="content-wrapper">
      <div>
        <h4 class="sub-heading">Data Arsip</h4>
        <p>
          <span class="font-medium">Nomor Surat:</span>
          {{ $document->nomor_surat }}
        </p>
        <p>
          <span class="font-medium">Judul:</span>
          {{ $document->judul }}
        </p>
        <p>
          <span class="font-medium">Kategori:</span>
          {{ $document->category->nama }}
        </p>
        <p>
          <span class="font-medium">Diunggah oleh:</span>
          {{ $document->user->nama }}
          <span class="italic text-gray-400">pada {{ $document->formatted_date }}</span>
        </p>
      </div>
      <iframe class="h-[500px]" src="{{ Storage::url($document->file_path) }}" frameborder="0"></iframe>
      <div class="flex w-full justify-end gap-4">
        <a href="" class="btn-secondary">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
            />
          </svg>
          Edit
        </a>
        <button class="btn-secondary">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="size-4"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25"
            />
          </svg>
          Unduh
        </button>
      </div>
    </div>
  </div>
</div>
