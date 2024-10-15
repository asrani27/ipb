
<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    @if (Auth::user()->hasRole('superadmin'))
        @include('layouts.menu_superadmin');
    @elseif(Auth::user()->hasRole('admin'))
        @include('layouts.menu_admin');
    @elseif(Auth::user()->hasRole('bidang'))
        @include('layouts.menu_bidang');
    @elseif(Auth::user()->hasRole('pptk'))
        @include('layouts.menu_pptk');
    @elseif(Auth::user()->hasRole('bpkpad'))
        @include('layouts.menu_bpkpad');
    @endif
    </ul>
</section>