<li class="{{ (request()->is('bpkpad/beranda')) ? 'active' : '' }}"><a href="/bpkpad/beranda"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
<li class="{{ (request()->is('bpkpad/keuangan')) ? 'active' : '' }}"><a href="/bpkpad/keuangan"><i class="fa fa-money"></i> <span>Keuangan</span></a></li>
<li class="{{ (request()->is('bpkpad/fisik')) ? 'active' : '' }}"><a href="/bpkpad/fisik"><i class="fa fa-th"></i> <span>Fisik</span></a></li>
<li class="{{ (request()->is('bpkpad/laporan')) ? 'active' : '' }}"><a href="/bpkpad/laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
