<div
  role="status"
  id="toaster"
  x-data="toasterHub(@js($toasts), @js($config))"
  @class([
      "pointer-events-none fixed z-[100] flex w-full flex-col p-4 sm:p-6",
      "bottom-0" => $alignment->is("bottom"),
      "top-1/2 -translate-y-1/2" => $alignment->is("middle"),
      "top-0" => $alignment->is("top"),
      "items-start rtl:items-end" => $position->is("left"),
      "items-center" => $position->is("center"),
      "items-end rtl:items-start" => $position->is("right"),
  ])
>
  <template x-for="toast in toasts" :key="toast.id">
    <div
      x-show="toast.isVisible"
      x-init="$nextTick(() => toast.show($el))"
      @if ($alignment->is("bottom"))
          x-transition:enter-start="translate-y-12 opacity-0"
          x-transition:enter-end="translate-y-0 opacity-100"
      @elseif ($alignment->is("top"))
          x-transition:enter-start="-translate-y-12 opacity-0"
          x-transition:enter-end="translate-y-0 opacity-100"
      @else
          x-transition:enter-start="scale-90 opacity-0"
          x-transition:enter-end="scale-100 opacity-100"
      @endif
      x-transition:leave-end="scale-90 opacity-0"
      @class(["pointer-events-auto relative mt-2 flex w-full max-w-xs transform items-start justify-between rounded-lg bg-white p-4 text-neutral-500 shadow-lg transition duration-300 ease-in-out"])
    >
      <!-- Kondisi If Else berdasarkan tipe toast -->
      <div class="flex items-start gap-4">
        <div
          :class="toast.select({ error: 'toaster-error', info: 'text-black bg-gray-200', success: 'toaster-success', warning: 'toaster-warning' })"
          @class(["inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg"])
        >
          <template x-if="toast.type === 'success'">
            <svg
              class="h-5 w-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 20 20"
              class=""
            >
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
              />
            </svg>
            <span class="sr-only">Check icon</span>
          </template>

          <template x-if="toast.type === 'error'">
            <svg
              class="h-5 w-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"
              />
            </svg>
            <span class="sr-only">Error icon</span>
          </template>

          <template x-if="toast.type === 'info'">
            <p class="text-sm text-blue-700">Info message</p>
          </template>

          <template x-if="toast.type === 'warning'">
            <svg
              class="h-5 w-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"
              />
            </svg>
            <span class="sr-only">Warning icon</span>
          </template>
        </div>
        <p x-text="toast.message" class="flex min-h-8 items-center"></p>
      </div>

      @if ($closeable)
        <button
          @click="toast.dispose()"
          aria-label="@lang("close")"
          class="{{ $alignment->is("bottom") ? "top-3" : "top-0" }} p-2 focus:outline-none"
        >
          <svg
            class="h-4 w-4"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
          >
            <path
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </button>
      @endif
    </div>
  </template>
</div>
