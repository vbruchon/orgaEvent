<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-custom-purple">
        <x-application-logo class="text-white" />

        <ul class="mt-8 space-y-2 font-medium">
            <li class="w-full">
                <x-nav-link :href="route('dashboard')" class="w-full flex items-center px-2 py-2 rounded-lg text-white hover:bg-custom-blue">
                    <svg fill="#f6f5f4" class="w-7" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                        <g id="SVGRepo_iconCarrier">
                            <path d="M27 18.039L16 9.501 5 18.039V14.56l11-8.54 11 8.538v3.481zm-2.75-.31v8.251h-5.5v-5.5h-5.5v5.5h-5.5v-8.25L16 11.543l8.25 6.186z" />
                        </g>
                    </svg> <span class="ml-3">Tableau de bord</span>
                </x-nav-link>
            </li>
            @foreach(\App\Helpers\NavigationHelper::getNavigationLinks() as $link)
            <li class="w-full">

                <x-nav-link :href="$link['url']" :active="request()->routeIs($link['url'])" class="w-full flex items-center px-2 py-2 rounded-lg text-white hover:bg-custom-blue">
                    {!! $link['svg'] !!}
                    <span class="ml-3">{{ $link['label'] }}</span>
                </x-nav-link>
            </li>
            @if ($link['label'] === 'Utilisateurs')
            <li>
                <hr class="mt-6 mb-4 border-gray-300 dark:border-gray-700">
            </li>
            @endif

            @endforeach
        </ul>
    </div>
</aside>