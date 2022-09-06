<div>
    <div class="pb-3 border-b border-gray-200">
        <a href="#" class="block">
            <h1 class="mb-3 text-3xl font-bold text-center">Company</h1>
        </a>
    </div>
    <div class="px-2 mt-7">
        <x:component::menu.link href="#test">Dashboard</x:component::menu.link>
        <x:component::menu.link href="#test">Profile</x:component::menu.link>
    </div>

    <p class="mb-3 text-base text-teal-500 uppercase mt-7">Administrator</p>
    <hr class="border-gray-200" />
    <div class="px-2 mt-7">
        <x:component::menu.dropdown>
            <x-slot:trigger>Dropdown Example</x-slot:trigger>

            <x-slot:content>
                <x:component::menu.dropdown-link href="#test">Example Link</x:component::menu.dropdown-link>
                <x:component::menu.dropdown-link href="#test">Example Link</x:component::menu.dropdown-link>
            </x-slot:content>
        </x:component::menu.dropdown>

        <x:component::menu.link href="#test">Example Link</x:component::menu.link>
    </div>

    <div class="px-2">
        <!-- Authentication -->
        <form method="POST" action="#" x-data>
            @csrf
            <x:component::menu.link href="#" @click.prevent="$root.submit();"
                class="flex gap-2 text-gray-600 transition-all duration-200 ease-linear hover:text-teal-500">Logout
                <x:component::icon.logout class="text-red-500" />
            </x:component::menu.link>
        </form>
    </div>
</div>
