
<section class="sidebar">
    <div class="user-panel text-center">
    <div class=" image">
        <img src="/logo/Logo-PU.jpeg" class="img-circl" alt="User Image">
    </div>
    {{-- <div class="pull-left info">
        <!-- Status -->
    </div> --}}
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    <li class="{{ (request()->is('superadmin/permohonan')) ? 'active' : '' }}"><a href="/superadmin/permohonan"><i class="fa fa-list"></i> <span>Permohonan</span></a></li>
    <li class="{{ (request()->is('superadmin/krk*')) ? 'active' : '' }}"><a href="/superadmin/krk"><i class="fa fa-file-o"></i> <span>KRK/KKPR</span>
        <span class="pull-right-container">
            @if (newKrk() == 0)
                
            @else
            <small class="label pull-right bg-red">{{newKrk()}}</small>
            @endif
        </span>
    </a></li>
    <li class="{{ (request()->is('superadmin/surat-pernyataan*')) ? 'active' : '' }}"><a href="#"><i class="fa fa-file-o"></i> <span>Surat Pernyataan</span></a></li>
    <li class="{{ (request()->is('superadmin/berita-acara*')) ? 'active' : '' }}"><a href="#"><i class="fa fa-file-o"></i> <span>Berita Acara</span></a></li>
    @else
        
    <li class="{{ (request()->is('pemohon')) ? 'active' : '' }}"><a href="/pemohon"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    <li class="{{ (request()->is('pemohon/daftar-layanan*')) ? 'active' : '' }}"><a href="/pemohon/daftar-layanan"><i class="fa fa-list"></i> <span>Daftar Layanan</span></a></li>
    @endif
    </ul>
    <!-- /.sidebar-menu -->
</section>