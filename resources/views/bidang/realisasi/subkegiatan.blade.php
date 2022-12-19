@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Realisasi</h3>
    
              {{-- <div class="box-tools">
                <a href="/bidang/program/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Program</a>
              </div> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body text-sm">
                <dl>
                <dd><strong>TAHUN :</strong> {{$tahun}}</dd>
                <dd><strong>PROGRAM :</strong> {{$program->nama}}</dd>
                <dd><strong>KEGIATAN :</strong> {{$kegiatan->nama}}</dd>
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
            <h3 class="box-title ">Pilih Sub Kegiatan</h3>
          </div>
          <div class="box-body">
            @foreach ($data as $item)
                <a href="/bidang/realisasi/{{$tahun}}/{{$program->id}}/{{$kegiatan->id}}/{{$item->id}}" class="btn btn-primary btn-block btn-sm btn-flat"><strong>{{$item->nama}}</strong></a>                
            @endforeach
            <a href="/bidang/realisasi/{{$tahun}}/{{$program->id}}" class="btn bg-purple btn-block btn-sm btn-flat"><strong>Kembali</strong></a>   
          </div>
        </div>
      </div>
    </div>
</section>


@endsection
@push('js')

@endpush

