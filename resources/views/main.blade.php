<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        
        @include('partials.nav')

        <div class="container">
            @include('partials.messages')
            <br>
            @yield('content')    
        </div>
        
    </body>
    @include('partials.footer')
    @yield('scripts')
</html>
