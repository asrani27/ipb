@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Data Pengajuan Pergeseran</h3>
    
              <div class="box-tools">
                <a href="/admin/pengajuan/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus"></i> Tambah</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>Tahun</th>
                  <th>Type</th>
                  <th>Ke</th>
                  <th>Status</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->tahun}}</td>
                    <td>Pergeseran</td>
                    <td>{{$item->ke}}</td>
                    <td>
                    @if ($item->status == 0)
                        menunggu verifikasi superadmin/pembangunan
                    @else
                        Disetujui
                    @endif  
                    </td>
                </tr>
                @endforeach
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
</section>


@endsection
@push('js')

@endpush

