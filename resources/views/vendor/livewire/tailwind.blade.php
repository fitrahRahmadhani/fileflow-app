@php
  if (! isset($scrollTo)) {
    $scrollTo = 'body';
  }

  $scrollIntoViewJsSnippet =
    $scrollTo !== false
      ? <<<JS
        (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
      JS
      : '';
@endphp

<div>
  @if ($paginator->hasPages())
    <nav
      role="navigation"
      aria-label="Pagination Navigation"
      class="flex items-center justify-center sm:justify-between"
    >
      <div class="flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
          <p class="hidden text-sm leading-5 text-neutral-400 md:block">
            <span>{!! __('Menampilkan') !!}</span>
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            <span>{!! __('sampai') !!}</span>
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            <span>{!! __('dari') !!}</span>
            <span class="font-medium">{{ $paginator->total() }}</span>
            <span>{!! __('hasil') !!}</span>
          </p>
        </div>

        <div>
          <span class="relative z-0 inline-flex space-x-2">
            <span>
              {{-- Previous Page Link --}}

              @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                  <span
                    class="relative inline-flex cursor-not-allowed items-center rounded-full bg-neutral-50 px-2 py-2 text-sm font-medium leading-5 text-neutral-300"
                    aria-hidden="true"
                  >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                      <path
                        fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </span>
                </span>
              @else
                <button
                  type="button"
                  wire:click="previousPage('{{ $paginator->getPageName() }}')"
                  x-on:click="{{ $scrollIntoViewJsSnippet }}"
                  dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                  class="-800 -700 relative inline-flex items-center rounded-full bg-neutral-50 px-2 py-2 text-sm font-medium leading-5 text-gray-500 transition duration-300 ease-in-out hover:bg-neutral-200 hover:text-neutral-500"
                  aria-label="{{ __('pagination.previous') }}"
                >
                  <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </button>
              @endif
            </span>

            <span class="space-x-2 rounded-full bg-neutral-50 px-4">
              {{-- Pagination Elements --}}
              @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                  <span aria-disabled="true">
                    <span
                      class="relative -ml-px inline-flex cursor-default items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-neutral-400"
                    >
                      {{ $element }}
                    </span>
                  </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                  @foreach ($element as $page => $url)
                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                      @if ($page == $paginator->currentPage())
                        <span aria-current="page">
                          <span
                            class="b relative -ml-px inline-flex cursor-default items-center rounded-xl bg-neutral-200 px-4 py-2 text-sm font-semibold leading-5 text-neutral-500 shadow-neutral-200"
                          >
                            {{ $page }}
                          </span>
                        </span>
                      @else
                        <button
                          type="button"
                          wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                          x-on:click="{{ $scrollIntoViewJsSnippet }}"
                          class="-300 -800 -700 relative -ml-px inline-flex items-center rounded-xl bg-neutral-50 px-4 py-2 text-sm font-medium leading-5 text-neutral-400 transition duration-300 ease-in-out hover:bg-neutral-100 hover:text-gray-500"
                          aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                        >
                          {{ $page }}
                        </button>
                      @endif
                    </span>
                  @endforeach
                @endif
              @endforeach
            </span>

            <span>
              {{-- Next Page Link --}}

              @if ($paginator->hasMorePages())
                <button
                  type="button"
                  wire:click="nextPage('{{ $paginator->getPageName() }}')"
                  x-on:click="{{ $scrollIntoViewJsSnippet }}"
                  dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                  class="-800 -700 relative inline-flex items-center rounded-full bg-neutral-50 px-2 py-2 text-sm font-medium leading-5 text-gray-400 transition duration-300 ease-in-out hover:bg-neutral-200 hover:text-neutral-500"
                  aria-label="{{ __('pagination.next') }}"
                >
                  <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </button>
              @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                  <span
                    class="relative inline-flex cursor-not-allowed items-center rounded-full bg-neutral-50 px-2 py-2 text-sm font-medium leading-5 text-neutral-300"
                    aria-hidden="true"
                  >
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                      <path
                        fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </span>
                </span>
              @endif
            </span>
          </span>
        </div>
      </div>
    </nav>
  @endif
</div>
