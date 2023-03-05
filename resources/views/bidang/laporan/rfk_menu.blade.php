
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}" class="btn bg-purple btn-sm btn-flat"><strong>Kembali</strong></a>   
@if ($status_kirim == null)
<a href="/bidang/laporanrfk/kirimdata/{{$bulan}}/{{$subkegiatan->id}}" class="btn btn-primary btn-sm btn-flat" onclick="return confirm('Apakah Yakin Ingin Dikirim?');"><strong><i class="fa fa-send"></i> Kirim Data</strong></a>   
@else
<a href="#" class="btn btn-primary btn-sm btn-flat"><strong><i class="fa fa-check"></i> Terkirim</strong></a> 
@endif
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/srp" class="btn btn-danger btn-sm btn-flat"><strong>Sr Pengantar</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/rfk" class="btn btn-danger btn-sm btn-flat"><strong>RFK</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/pbj" class="btn btn-warning btn-sm btn-flat"><strong>PBJ</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/st" class="btn btn-warning btn-sm btn-flat"><strong>ST</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/m" class="btn btn-warning btn-sm btn-flat"><strong>M</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/v" class="btn btn-warning btn-sm btn-flat"><strong>V</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/fiskeu" class="btn btn-success btn-sm btn-flat"><strong>Fis Keu</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/input" class="btn btn-success btn-sm btn-flat"><strong>Input</strong></a> 
<a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$program->id}}/{{$kegiatan->id}}/{{$subkegiatan->id}}/export" class="btn btn-primary btn-sm btn-flat"><strong><i class="fa fa-file-excel-o"></i> Export</strong></a> 