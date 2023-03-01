<div>
    <div x-data="{ open: false }" class="relative">
        <button type="button" @click.prevent="open = ! open"
            class="flex items-center justify-center text-teal-500 border-2 border-teal-500 rounded-md shadow-sm hover:text-white w-9 h-9 hover:bg-primary-500 default-transition">
            <x:component::icon.colorize />
        </button>

        <div x-clock x-show="open" @click.outside="open = false"
            class="absolute top-0 z-50 overflow-hidden rounded-md shadow-sm left-11">
            <div class="grid grid-cols-1 gap-0 overflow-y-auto w-[336px] max-h-56">
                @foreach ($colorListe as $tint)
                    <div class="flex gap-0">
                        @foreach ($tint as $color)
                            <button type="button" @click.prevent="open = false"
                                class="flex items-center justify-center text-white w-14 h-14"
                                wire:click="setColor('{{ $color }}')"
                                style="background-color: {{ $color }}">
                                @if (!empty($selectedColor) && $selectedColor == $color)
                                    <x:component::icon.check />
                                @endif
                            </button>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
