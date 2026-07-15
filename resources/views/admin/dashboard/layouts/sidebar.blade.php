<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">St</a>
        </div>
        <ul class="sidebar-menu">
            {{--  Dashboard Route  --}}
            <li class="menu-header">Dashboard</li>
            <li class="{{setSidebarActive(['admin.dashboard'])}}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="far fa-square"></i> <span>Dashboard</span></a></li>

            {{--  Sections Route  --}}
            <li class="menu-header">Sections</li>
            <li class="dropdown {{setSidebarActive(['admin.hero.*'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Sections</span></a>
                <ul class="dropdown-menu">

                    {{--  Hero Section  --}}
                    <li class="{{setSidebarActive(['admin.hero.index'])}}"><a class="nav-link " href="{{ route('admin.hero.index') }}">Hero Section</a></li>

                </ul>
            </li>

            {{--  Listing Route  --}}
            <li class="menu-header">Listing</li>
            <li class="dropdown {{setSidebarActive(['admin.categories.*','admin.locations.*','admin.amenities.*'])}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Listing</span></a>
                <ul class="dropdown-menu">
                    <li class="{{setSidebarActive(['admin.categories.*'])}}"><a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a></li>
                    <li class="{{setSidebarActive(['admin.locations.*'])}}"><a class="nav-link" href="{{ route('admin.locations.index') }}">Locations</a></li>
                    <li class="{{setSidebarActive(['admin.amenities.*'])}}"><a class="nav-link" href="{{ route('admin.amenities.index') }}">Amenities</a></li>
                </ul>
            </li>



            <li><a class="nav-link" href="#"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
        </ul>
    </aside>
</div>
