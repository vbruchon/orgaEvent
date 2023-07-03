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

                @if ($link['label'] === 'Mon profil')
            <li>
                <hr class="mt-6 mb-4 border-gray-200">
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

            <a href="{{ $link['url'] }}" class="nav-item w-full flex items-center px-2 py-2 rounded-lg text-white hover:bg-custom-blue hover:border-b-4" data-url="{{ $link['url'] }}">
                {!! $link['svg'] !!}
                <span class="ml-3">{{ $link['label'] }}</span>
            </a>



            </li>
            @endif


            @endforeach
        </ul>
    </div>
</aside>
<script>
    /*     const currentUrl = window.location.pathname;
    console.log(currentUrl);
    const linkElements = document.querySelectorAll('.nav-item');

    linkElements.forEach(linkElement => {
        const linkUrl = linkElement.href;
        const urlSegments = linkUrl.split('/dashboard');


        // Vérifier si le dernier segment de l'URL est inclus dans currentUrl
        if (currentUrl === "/dashboard" && urlSegments[urlSegments.length - 1] === "") {
            linkElement.classList.add('bg-custom-blue');
            linkElement.classList.add('border-b-4');
        } else if (currentUrl.includes(urlSegments[urlSegments.length - 1])) {
            linkElement.classList.add('bg-custom-blue');
            linkElement.classList.add('border-b-4');
        }
    }); */

    const currentUrl = window.location.pathname;
    console.log(currentUrl);
    const linkElements = document.querySelectorAll('.nav-item');

    linkElements.forEach(linkElement => {
        const linkUrl = linkElement.href;
        //Create instance URL by complete url and extract pathname access of URL
        const linkPathname = new URL(linkUrl).pathname;

        // Vérifier si l'URL de la page correspond à l'URL du lien
        if (currentUrl === linkPathname) {
            linkElement.classList.add('bg-custom-blue');
            linkElement.classList.add('border-b-4');
        }
    });
</script>