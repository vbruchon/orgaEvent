<aside id="logo-sidebar" class="fixed z-50 top-0 left-0 z-40 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-custom-purple">
        <x-application-logo class="text-white" />

        <ul class="mt-8 space-y-2 font-medium">
            @foreach(\App\Helpers\NavigationHelper::getNavigationLinks() as $link)
            @if ($link['label'] === 'Tableau de bord')
            <li class="w-full mb-8">
                @else
            <li class="w-full">
                @endif

                @if ($link['label'] === 'Mon profile')
            <li>
                <hr class="mt-6 mb-4 border-gray-300 dark:border-gray-700">
            </li>
            @endif 


            @if ($link['label'] === 'Déconnexion')
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <x-nav-link href="route('logout')" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full flex items-center px-2 py-2 rounded-lg text-white hover:bg-custom-blue">
                    {!! $link['svg'] !!}
                    <span class="ml-3 ">{{ $link['label'] }}</span>
                </x-nav-link>
            </form>
            @else
            @if ($link['label'] === 'Mon profile')

            @endif
            <x-nav-link :href="$link['url']" :active="request()->routeIs($link['url'])" class="w-full flex items-center px-2 py-2 rounded-lg text-white hover:bg-custom-blue">
                {!! $link['svg'] !!}
                <span class="ml-3">{{ $link['label'] }}</span>
            </x-nav-link>
            </li>
            @endif


            @endforeach
        </ul>
    </div>
</aside>