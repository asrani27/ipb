<li class="{{ (request()->is('pptk/beranda')) ? 'active' : '' }}"><a href="/pptk/beranda"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
<li class="{{ (request()->is('pptk/subkegiatan*')) ? 'active' : '' }}"><a href="/pptk/subkegiatan"><i class="fa fa-clipboard"></i> <span>Angkas Subkegiatan</span></a></li>
{{-- <li class="{{ (request()->is('pptk/perubahan/program*')) ? 'active' : '' }}"><a href="/pptk/perubahan/program"><i class="fa fa-clipboard"></i> <span>RFK Perubahan</span></a></li> --}}
<li class="{{ (request()->is('pptk/realisasi*')) ? 'active' : '' }}"><a href="/pptk/realisasi"><i class="fa fa-clipboard"></i> <span>Realisasi</span></a></li>
<li class="{{ (request()->is('pptk/laporanrfk*')) ? 'active' : '' }}"><a href="/pptk/laporanrfk"><i class="fa fa-clipboard"></i> <span>RFK Laporan</span></a></li>
{{-- <li class="{{ (request()->is('pptk/kirimdata*')) ? 'active' : '' }}"><a href="/pptk/kirimdata"><i class="fa fa-send"></i> <span>Status Kirim Data</span></a></li> --}}
<li class=""><a href="/logout"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>