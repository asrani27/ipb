@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data KRK/KKPR</h3>

            {{-- <div class="box-tools">
              <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div> --}}
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Pekerjaan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->pekerjaan}}</td>
                <td>
                    @if ($item->status == 0)
                    <span class="label label-danger">Di Proses</span>
                    @endif
                    @if ($item->status == 1)
                    <span class="label label-success">Verified</span>
                    @endif
                </td>
                <td>
                    @if ($item->status == 0)
                    <a href="/superadmin/krk/{{$item->id}}/verifikasi" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-check"></i>  Verifikasi</a>
                    @else
                    <a href="/superadmin/krk/{{$item->id}}/unverifikasi" class="btn btn-primary btn-xs btn-flat" onclick="return confirm('Yakin verifikasi di batalkan?');"><i class="fa fa-times"></i>  Batal Verifikasi</a>
                    @endif

                    <a href="/superadmin/krk/{{$item->id}}/edit" class="btn btn-success btn-xs btn-flat"><i class="fa fa-edit"></i></a>
                    <a href="/superadmin/krk/{{$item->id}}/delete" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('Yakin ingin di hapus?');"><i class="fa fa-trash"></i></a>
                    <a href="/superadmin/krk/{{$item->id}}/print" class="btn btn-danger btn-xs btn-flat" target="_blank"><i class="fa fa-print"></i>  PDF</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
