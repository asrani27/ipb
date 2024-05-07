@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-institution"></i><h3 class="box-title">Data Pengajuan Pergeseran</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Nama SKPD</th>
                <th>Status</th>
                <th>Pengajuan</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->nama}}</td>
                <td>
                  @if ($item->pergeseran == null)
                      murni
                  @else
                      Sedang di Pergeseran ke : {{$item->pergeseran->ke}}
                  @endif
                </td>
                <td>
                  @if ($item->pengajuan == null)
                      
                  @else
                      Mengajukan Pergeseran ke : {{$item->pengajuan->ke}}
                  @endif
                </td>
                <td>
                  @if ($item->pengajuan == null)
                      
                  @else
                    <a href="/superadmin/pengajuan/verifikasi/{{$item->id}}/{{$item->pengajuan->id}}" class="btn btn-xs btn-success" onclick="return confirm('Yakin ingin di setujui');"><i
                            class="fa fa-check"></i> Verifikasi / Setujui</a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        
    </div>
</div>
@endsection
@push('js')

@endpush
