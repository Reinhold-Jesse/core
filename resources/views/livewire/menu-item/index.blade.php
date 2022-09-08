<div>
    <x-slot name="header">
        <div class="flex items-center gap-1">
            <h2 class="font-semibold leading-tight">
                {{ $menu->name }} {{ __('Menu Items') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">

        <div class="container px-3 mx-auto">

            <div class="flex justify-end gap-5 pb-12">
                <button wire:click="create" type="button"
                    class="flex items-center justify-center w-56 px-5 py-3 text-white bg-teal-500 border-0 rounded-md shadow-sm hover:text-white hover:bg-teal-600 default-transition">
                    Menu Item erstellen
                </button>
            </div>

            <div class="overflow-x-auto bg-white shadow md:rounded-lg">
                <x:component::table.wrapper>
                    <x-slot:head>
                        <x:component::table.row>
                            <x:component::table.cell class="w-[30px] p-2" />
                            <x:component::table.cell class="w-2/12 font-semibold text-left text-gray-700">Titel
                            </x:component::table.cell>
                            <x:component::table.cell class="w-2/12 font-semibold text-left text-gray-700">URL
                            </x:component::table.cell>
                            <x:component::table.cell class="w-2/12 font-semibold text-left text-gray-700">Route
                            </x:component::table.cell>
                            <x:component::table.cell class="w-1/12 font-semibold text-left text-gray-700">Parent Id
                            </x:component::table.cell>
                            {{-- <x:component::table.cell class="w-1/12 font-semibold text-left text-gray-700">Order
                            </x:component::table.cell> --}}
                            <x:component::table.cell />
                        </x:component::table.row>
                    </x-slot:head>

                    <x-slot:body wire:sortable="reorder" drag-root>
                        @foreach ($content as $value)
                            <x:component::table.row class="hover:bg-gray-50" draggable="true"
                                wire:sortable.item="{{ $value->id }}" drag-item="{{ $value->id }}">
                                <x:component::table.cell
                                    class="flex items-center justify-center text-gray-300 cursor-pointer hover:text-teal-500"
                                    wire:sortable.handle>
                                    <x:component::icon.drag-indicator />
                                </x:component::table.cell>
                                <x:component::table.cell class="text-gray-500">{{ $value->title }}
                                </x:component::table.cell>
                                <x:component::table.cell class="text-gray-500">
                                    @if (!empty($value->url))
                                        <a href="{{ $value->url }}" target="_blank"
                                            class="hover:text-teal-500">{{ $value->url }}</a>
                                    @endif
                                </x:component::table.cell>
                                <x:component::table.cell class="text-gray-500">
                                    @if (!empty($value->route))
                                        <a href="{{ route($value->route) }}" target="_blank"
                                            class="hover:text-teal-500">{{ $value->route }}</a>
                                    @endif
                                </x:component::table.cell>
                                <x:component::table.cell class="text-gray-500">{{ $value->parent_id }}
                                </x:component::table.cell>
                                {{-- <x:component::table.cell class="text-gray-500">{{ $value->order }}
                                </x:component::table.cell> --}}


                                <x:component::table.cell class="flex justify-end gap-2">

                                    <x:component::button.edit wire:click.prevent="edit({{ $value->id }})"
                                        type="button" />


                                    <x:component::element.modal>
                                        <x-slot:trigger>

                                            <x:component::button.delete @click.prevent="modal=true" />

                                        </x-slot:trigger>

                                        <x-slot:content>
                                            <div class="flex justify-center ">
                                                <div
                                                    class="flex items-center justify-center text-red-500 bg-red-200 rounded-full shadow-sm w-28 h-28">
                                                    <x:component::icon.delete class="h-16" />
                                                </div>
                                            </div>
                                            <div class="flex justify-center mt-7">
                                                <h3 class="text-lg font-bold text-center text-gray-700">
                                                    {{ $value->title }} <br />unwiderruflich löschen?</h3>
                                            </div>
                                        </x-slot:content>

                                        <x-slot:controller>
                                            <button @click.prevent="modal=false" type="button"
                                                class="flex justify-center w-full px-4 py-2 mr-2 font-medium text-center text-white bg-gray-300 border border-transparent rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Abbrechen</button>

                                            <button wire:click='deleteEntry({{ $value->id }})'
                                                @click.prevent="modal=false" type="button"
                                                class="flex justify-center w-full px-4 py-2 font-medium text-center text-white bg-red-500 border border-transparent rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">löschen</button>
                                        </x-slot:controller>
                                    </x:component::element.modal>
                                </x:component::table.cell>
                            </x:component::table.row>
                        @endforeach
                    </x-slot:body>

                </x:component::table.wrapper>
            </div>
        </div>


        @if ($openEdit)
            @include('component::livewire.menu-item.edit')
        @endif

    </div>
</div>
