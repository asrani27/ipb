
<a href="/pptk/laporanrfk/" class="btn bg-purple btn-sm btn-flat"><strong>Kembali</strong></a>  

<a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/srp" class="btn btn-danger btn-sm btn-flat"><strong>Sr Pengantar</strong></a> 
<a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/rfk" class="btn btn-danger btn-sm btn-flat"><strong>RFK</strong></a> 
{{-- <a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/pbj" class="btn btn-warning btn-sm btn-flat"><strong>PBJ</strong></a> 
<a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/st" class="btn btn-warning btn-sm btn-flat"><strong>ST</strong></a>  --}}
<a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/m" class="btn btn-warning btn-sm btn-flat"><strong>M</strong></a> 
{{-- <a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/v" class="btn btn-warning btn-sm btn-flat"><strong>V</strong></a>  --}}
<a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/fiskeu" class="btn btn-success btn-sm btn-flat"><strong>Fis Keu</strong></a>  
@if ($status_kirim == null)
<a href="/pptk/laporanrfk/kirimdata/{{$bulan}}/{{$subkegiatan->id}}" class="btn btn-primary btn-sm btn-flat" onclick="return confirm('Apakah Yakin Ingin Dikirim?');"><strong><i class="fa fa-send"></i> Kirim Data</strong></a>  
@else
<a href="#" class="btn btn-primary btn-sm btn-flat"><strong><i class="fa fa-check"></i> Terkirim</strong></a> 
@endif
<a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/input" class="btn btn-success btn-sm btn-flat"><strong>Input</strong></a>  
{{-- <a href="/pptk/laporanrfk/{{$subkegiatan->id}}/{{$tahun}}/{{$bulan}}/export" class="btn btn-primary btn-sm btn-flat"><strong><i class="fa fa-file-excel-o"></i> Export</strong></a>  --}}