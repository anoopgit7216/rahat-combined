 @include('adm.deathSection.layouts.partials.header')
 @include('adm.deathSection.layouts.partials.navbar')
 @include('adm.deathSection.layouts.partials.sidebar')

 @yield('content')

 @include('adm.deathSection.layouts.partials.footer')
@stack('scripts')