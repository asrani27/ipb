<li class="{{ (request()->is('superadmin/beranda')) ? 'active' : '' }}"><a href="/superadmin/beranda"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
<li class="{{ (request()->is('superadmin/skpd*')) ? 'active' : '' }}"><a href="/superadmin/skpd"><i class="fa fa-institution"></i> <span>SKPD</span></a></li>

{{-- <li class="{{ (request()->is('superadmin/jenisrfk*')) ? 'active' : '' }}"><a href="/superadmin/jenisrfk"><i class="fa fa-list"></i> <span>Jenis RFK</span></a></li> --}}