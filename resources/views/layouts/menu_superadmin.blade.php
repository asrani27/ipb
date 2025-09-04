<li class="{{ (request()->is('superadmin/beranda')) ? 'active' : '' }}"><a href="/superadmin/beranda"><i
                        class="fa fa-home"></i> <span>Dashboard</span></a></li>
<li class="{{ (request()->is('superadmin/skpd*')) ? 'active' : '' }}"><a href="/superadmin/skpd"><i
                        class="fa fa-institution"></i> <span>SKPD</span></a></li>
<li class="{{ (request()->is('superadmin/pengajuan*')) ? 'active' : '' }}"><a href="/superadmin/pengajuan"><i
                        class="fa fa-th"></i> <span>Pengajuan Pergeseran</span></a></li>
<li class="{{ (request()->is('superadmin/pengaturan/batasinput*')) ? 'active' : '' }}"><a
                href="/superadmin/pengaturan/batasinput"><i class="fa fa-clock-o"></i> <span>Pengaturan Batas
                        Input</span></a>
</li>
<li class="{{ (request()->is('superadmin/laporan*')) ? 'active' : '' }}"><a href="/superadmin/laporan"><i
                        class="fa fa-file-o"></i> <span>Laporan RFK</span></a></li>

<li class="{{ (request()->is('superadmin/jenisrfk*')) ? 'active' : '' }}"><a href="/superadmin/jenisrfk"><i
                        class="fa fa-list"></i> <span>Jenis RFK</span></a></li>
<li class="{{ (request()->is('superadmin/importdata*')) ? 'active' : '' }}"><a href="/superadmin/importdata"><i
                        class="fa fa-upload"></i> <span>Import Data</span></a></li>

<li class="{{ (request()->is('gantipass')) ? 'active' : '' }}"><a href="/gantipass"><i class="fa fa-key"></i>
                <span>Ganti Password</span></a></li>