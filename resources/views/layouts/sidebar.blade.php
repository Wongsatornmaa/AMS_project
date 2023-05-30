@php
$apartment = asset('image/apartment.png');
@endphp
<aside class="main-sidebar sidebar-lightblue elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ $apartment }}" class="brand-image ">
        <span class="brand-text font-weight-light">AMS</span>
    </a>

    <div class="sidebar bg-white">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
