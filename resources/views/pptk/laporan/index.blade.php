@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Laporan</h3>
        
                  <div class="box-tools">
                    {{-- <a href="/pptk/murni/subkegiatan/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Sub Kegiatan</a> --}}
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Tahun</th>
                      <th>Jenis</th>
                      <th>Subkegiatan</th>
                      <th>Bulan</th>
                    </tr>
                    
                    @foreach ($data as $key => $item)
                    <tr>
                        <td class="text-center">{{1 + $key}}</td>
                        <td>{{$item->tahun}}</td>
                        <td>{{$item->jenis_rfk}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/01" class="btn btn-xs btn-flat {{$item->kirim_rfk_januari != null ? 'btn-success':'btn-primary'}}"><strong> Jan</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/02" class="btn btn-xs btn-flat {{$item->kirim_rfk_februari != null ? 'btn-success':'btn-primary'}}"><strong> Feb</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/03" class="btn btn-xs btn-flat {{$item->kirim_rfk_maret != null ? 'btn-success':'btn-primary'}}"><strong> Mar</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/04" class="btn btn-xs btn-flat {{$item->kirim_rfk_april != null ? 'btn-success':'btn-primary'}}"><strong> Apr</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/05" class="btn btn-xs btn-flat {{$item->kirim_rfk_mei != null ? 'btn-success':'btn-primary'}}"><strong> Mei</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/06" class="btn btn-xs btn-flat {{$item->kirim_rfk_juni != null ? 'btn-success':'btn-primary'}}"><strong> Jun</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/07" class="btn btn-xs btn-flat {{$item->kirim_rfk_juli != null ? 'btn-success':'btn-primary'}}"><strong> Jul</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/08" class="btn btn-xs btn-flat {{$item->kirim_rfk_agustus != null ? 'btn-success':'btn-primary'}}"><strong> Aug</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/09" class="btn btn-xs btn-flat {{$item->kirim_rfk_september != null ? 'btn-success':'btn-primary'}}"><strong> Sept</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/10" class="btn btn-xs btn-flat {{$item->kirim_rfk_oktober != null ? 'btn-success':'btn-primary'}}"><strong> Okt</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/11" class="btn btn-xs btn-flat {{$item->kirim_rfk_november != null ? 'btn-success':'btn-primary'}}"><strong> Nov</strong></a>
                            <a href="/pptk/laporanrfk/{{$item->id}}/{{$item->tahun}}/12" class="btn btn-xs btn-flat {{$item->kirim_rfk_desember != null ? 'btn-success':'btn-primary'}}"><strong> Des</strong></a>
                        
                        </td>
                        
                    </tr>
                    @endforeach
                    
                  </tbody></table>
                </div>
                <!-- /.box-body -->
              </div>
        </div>
    </div>
    
</section>


@endsection
@push('js')

@endpush

