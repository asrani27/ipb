@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            @include('bidang.uraian.deskripsi')
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Uraian Kegiatan</h3>
        
                  <div class="box-tools">
                    <a href="/bidang/perubahan/program/kegiatan/{{$program->id}}/sub/{{$kegiatan->id}}/" class="btn btn-sm bg-gray btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="/bidang/perubahan/program/kegiatan/{{$program->id}}/sub/{{$kegiatan->id}}/uraian/{{$subkegiatan->id}}/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Uraian</a>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding  text-sm">
                  <table class="table table-hover">
                    <tbody>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Uraian</th>
                      <th>DPA</th>
                      <th></th>
                      <th>Aksi</th>
                    </tr>
                    @foreach ($data as $key => $item)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{$item->kode_rekening}}<br/>{{$item->nama}}<br/>{{$item->keterangan}}</td>
                        <td>{{number_format($item->dpa)}} - {{$item->keterangan}}</td>
                        <td>
                          
                            <a href="/bidang/perubahan/program/angkas/{{$program_id}}/{{$kegiatan_id}}/{{$subkegiatan_id}}/{{$item->id}}"
                              class="btn btn-xs btn-flat btn-primary">Anggaran Kas</a>
                        </td>
                        <td>

                          <a href="/bidang/perubahan/program/kegiatan/{{$program_id}}/sub/{{$kegiatan_id}}/uraian/{{$subkegiatan_id}}/edit/{{$item->id}}"
                            class="btn btn-xs btn-flat btn-success"><i class="fa fa-edit"></i></a>
                            
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                      <td></td>
                      <td>Total</td>
                      <td>{{number_format($data->sum('dpa'))}}</td>
                      <td></td>
                    </tr>
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

