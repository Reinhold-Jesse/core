@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['timeout' => null, 'show' => false, 'style' => $style, 'message' => $message]) }}"
    :class="{
        'bg-green-500': style == 'success',
        'bg-red-700': style == 'danger',
        'bg-gray-500': style != 'success' && style !=
            'danger'
    }"
    style="display: none;" x-show="show && message" x-init="() => {
        clearTimeout(timeout);
        timeout = setTimeout(() => { shown = false }, 2000);
    },
    document.addEventListener('banner-message', event => {
        style = event.detail.style;
        message = event.detail.message;
        show = true;
    });"
    class="fixed z-50 rounded-md shadow-sm bottom-10 w-96 right-7">
    <div class="max-w-screen-xl px-3 py-2 mx-auto sm:px-6 lg:px-5">
        <div class="flex flex-wrap items-center justify-between">
            <div class="flex items-center flex-1 w-0 min-w-0">
                <span class="flex p-2 rounded-lg"
                    :class="{ 'bg-green-600': style == 'success', 'bg-red-600': style == 'danger' }">
                    <svg x-show="style == 'success'" class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style == 'danger'" class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style != 'success' && style != 'danger'" class="w-5 h-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>

                <p class="ml-3 text-sm font-medium text-white" x-text="message"></p>
            </div>

            <div class="shrink-0 sm:ml-3">
                <button type="button" class="flex p-2 -mr-1 transition rounded-md focus:outline-none sm:-mr-2"
                    :class="{
                        'hover:bg-green-600 focus:bg-green-600': style ==
                            'success',
                        'hover:bg-red-600 focus:bg-red-600': style == 'danger'
                    }"
                    aria-label="Dismiss" x-on:click="show = false">
                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>