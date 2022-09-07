<x:component::layouts.dashboard>
    <x-slot name="header">
        <div class="flex items-center gap-1">
            <x:component::icon.setting class="h-12" />
            <h2 class="font-semibold leading-tight">
                {{ __('Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container px-3 py-12 mx-auto">

            @livewire('component::setting.index')

        </div>
    </div>
</x:component::layouts.dashboard>
