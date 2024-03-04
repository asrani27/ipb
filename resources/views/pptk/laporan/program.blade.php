@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Laporan RFK</h3>
    
              
            </div>
            <!-- /.box-header -->
            <div class="box-body text-sm">
                <dl>
                <dd><strong>TAHUN :</strong> {{$tahun}}</dd>
                <dd><strong>BULAN :</strong> {{$nama_bulan}}</dd>
                </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-header text-center">
            <h3 class="box-title ">Pilih Program</h3>
          </div>
          <div class="box-body">
            @foreach ($data as $item)
                <a href="/bidang/laporanrfk/{{$tahun}}/{{$bulan}}/{{$item->id}}" class="btn btn-primary btn-block btn-sm btn-flat"><strong>{{$item->nama}}</strong></a>                
            @endforeach
            <a href="/bidang/laporanrfk/{{$tahun}}" class="btn bg-purple btn-block btn-sm btn-flat"><strong>Kembali</strong></a>   
          </div>
        </div>
      </div>
    </div>
</section>


@endsection
@push('js')

@endpush

