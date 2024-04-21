@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <a href="/admin/datatarik" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-arrow-left"></i> Kembali</a>
          
          <a href="/admin/subkegiatan/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus"></i> Tambah Sub Kegiatan</a>
          <br/><br/>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Subkegiatan</h3>
    
              <div class="box-tools">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding table-border">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th></th>
                  <th class="text-center">No</th>
                  <th>Tahun</th>
                  <th>Kode</th>
                  <th>Subkegiatan</th>
                  <th>PPTK</th>
                </tr>
                <form method="post" action="/admin/datatarik/pptk">
                  @csrf
                @foreach ($data as $key => $item)
                <tr>
                    <td width="70px">
                    <a href="/admin/subkegiatan/delete/{{$item->id}}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Ingin dihapus, uraian yang terkait akan juga ikut terhapus?');"><i class="fa fa-trash"></i></a>
                    <a href="/admin/subkegiatan/edit/{{$item->id}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                  </td>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->tahun}}</td>
                    <td>

                      {{$item->kode}}
                    </td>
                    <td>
                      {{$item->nama}}

                    </td>
                    <td>
                      <select name="pptk_id[]">
                        <option value="">-</option>
                      @foreach ($pptk as $item2)
                          <option value="{{$item2->id}}" {{$item2->id == $item->pptk_id ? 'selected':''}}>{{$item2->nip_pptk}} - {{$item2->nama_pptk}}</option>
                      @endforeach
                      </select>
                    </td>
                    <input type="hidden" name="subkegiatan_id[]" value="{{$item->id}}">
                </tr>
                @endforeach
                <tr>
                  <td colspan='6'>
                    <button type="submit" class="btn btn-block btn-primary">UPDATE PPTK</button>
                  </td>
                </tr>
                </form>
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

