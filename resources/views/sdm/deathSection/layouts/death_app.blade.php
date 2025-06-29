 @include('sdm.deathSection.layouts.partials.header')
 @include('sdm.deathSection.layouts.partials.navbar')
 @include('sdm.deathSection.layouts.partials.sidebar')

 @yield('content')

 @include('sdm.deathSection.layouts.partials.footer')
 @stack('scripts')
