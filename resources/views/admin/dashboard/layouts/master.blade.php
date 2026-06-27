<!DOCTYPE html>
<html lang="en">
@include('admin.dashboard.layouts.head')

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        @include('admin.dashboard.layouts.navbar')
        @include('admin.dashboard.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">

            @yield('content')

        </div>
        {{--     Footer   --}}
        @include('admin.dashboard.layouts.footer')
    </div>
</div>

<!-- General JS Scripts -->
@include('admin.dashboard.layouts.scripts')
</body>
</html>
