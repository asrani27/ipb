@extends('layouts.app')
@push('css')

@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-clipboard"></i>

          <h3 class="box-title">Deskripsi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body text-sm">
          <dl>
            <dt>Tahun</dt>
            <dd>{{$subkegiatan->tahun}}</dd><br />
            <dt>Program</dt>
            <dd>{{$subkegiatan->kegiatan == null ? '': $subkegiatan->kegiatan->program->nama}}</dd><br />
            <dt>Kegiatan</dt>
            <dd>{{$subkegiatan->kegiatan == null ? '': $subkegiatan->kegiatan->nama}}</dd><br />
            <dt>Sub Kegiatan</dt>
            <dd>{{$subkegiatan->kode}} <br />{{$subkegiatan->nama}}</dd>
          </dl>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Uraian Kegiatan</h3>

          <div class="box-tools">
            <a href="/pptk/subkegiatan" class="btn btn-sm bg-gray btn-flat"><i class="fa fa-arrow-left"></i> Kembali</a>

            <a href="/pptk/subkegiatan/uraian/{{$subkegiatan->id}}/add" class="btn btn-sm btn-primary btn-flat "><i
                class="fa fa-plus-circle"></i> Tambah Uraian</a>


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
                <td>{{$item->kode_rekening}}<br />{{$item->nama}}<br />{{$item->keterangan}}</td>
                <td>{{number_format($item->dpa)}}</td>
                <td>

                  <a href="/pptk/angkas/{{$item->id}}" class="btn btn-xs btn-flat btn-primary">Anggaran Kas</a>
                </td>
                <td>

                  {{-- @if ($item->status_kirim != 1)
                  <a href="/pptk/kirimuraian/{{$item->id}}" class="btn btn-xs btn-flat btn-success"
                    onclick="return confirm('Yakin dikirim?');"><i class="fa fa-send"></i>Kirim</a> --}}
                  <a href="/pptk/edituraian/{{$item->id}}" class="btn btn-xs btn-flat btn-success"><i
                      class="fa fa-edit"></i></a>
                  <a href="/pptk/deleteuraian/{{$item->id}}" onclick="return confirm('Yakin ingin di hapus');"
                    class="btn btn-xs btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                  {{-- @else
                  <i class="fa fa-check-circle"></i> Terkirim
                  @endif
                  --}}
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td>Total</td>
                <td>{{number_format($data->sum('dpa'))}}</td>
                <td></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

</section>


@endsection
@push('js')

@endpush