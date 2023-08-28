@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{$count_program}}</h3>

          <p>TOTAL PROGRAM</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
            <h3>{{$count_kegiatan}}</h3>

          <p>TOTAL KEGIATAN</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$count_subkegiatan}}</h3>

          <p>TOTAL SUB KEGIATAN</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>Capaian {{$tahun}} </h3>

          <p>.</p>
        </div>
        <div class="icon">
          <i class="fa fa-files-o"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
{{-- 
  <a href="/admin/laporan/{{$tahun}}/{{$bulan}}/excel" class="btn bg-purple btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</a> --}}
  
  <div class="row">
    <div class="col-md-12">
      <!-- Block buttons -->
      <div class="box">
        <div class="box-body table-responsive">
          <table class="table table-bordered table-condensed">
            <tbody>
              <tr style="font-size:10px;" class="bg-purple">
                <th style="width: 10px">#</th>
                <th style="text-align: center">Uraian Kegiatan</th>
                <th style="text-align: center">Capaian</th>
              </tr>
              

              @php
              $keg = 1;
              $subkeg = 1;
              @endphp
              @foreach ($program as $key => $item)

              <tr style="font-size:11px;font-weight:bold;" class="bg-danger">
                <td style="width: 11px;"></td>
                <td width="400px">{{$item->nama}}</td>
                <td class="text-center">
                    @if (checkCapaianProgram($item->skpd_id, $item->tahun, $item->kode) != false)
                    <a href="#" class=" edit-capaian" data-uraian="{{$item->nama}}" data-kode="{{$item->kode}}" data-jenis="program"  data-tahun="{{$item->tahun}}"> {{checkCapaianProgram($item->skpd_id, $item->tahun, $item->kode)}}</a>
                    @else
                        <a href="#" class="btn btn-xs btn-flat btn-success add-capaian" data-uraian="{{$item->nama}}" data-kode="{{$item->kode}}"  data-tahun="{{$item->tahun}}"><i class="fa fa-edit"></i></a>
                    @endif
                </td>
              </tr>

                @foreach ($item->kegiatan as $key2 => $item2)

                <tr style="font-size:10px;" class="bg-warning">
                  <td></td>
                  <td width="200px">{{$item2->nama}}</td>
                  <td class="text-center">

                    @if (checkCapaianKegiatan($item2->skpd_id, $item2->tahun, $item2->kode) != false)
                    
                    <a href="#" class=" edit-capaian" data-uraian="{{$item2->nama}}" data-kode="{{$item2->kode}}" data-jenis="kegiatan" data-tahun="{{$item2->tahun}}"> {{checkCapaianKegiatan($item2->skpd_id, $item2->tahun, $item2->kode)}}</a>
                    @else
                        <a href="#" class="btn btn-xs btn-flat btn-success add-capaian2" data-uraian="{{$item2->nama}}" data-kode="{{$item2->kode}}"  data-tahun="{{$item2->tahun}}"><i class="fa fa-edit"></i></a>
                    @endif
                  </td>
                </tr>

                    @foreach ($item2->subkegiatan as $key3 => $item3)

                    <tr style="font-size:10px;">
                    <td>{{$subkeg++}}</td>
                    <td width="200px">{{$item3->nama}}</td>
                    <td class="text-center">

                        @if (checkCapaianSubkegiatan($item3->skpd_id, $item3->tahun, $item3->kode) != false)
                        <a href="#" class="edit-capaian" data-uraian="{{$item3->nama}}" data-kode="{{$item3->kode}}" data-jenis="subkegiatan"  data-tahun="{{$item3->tahun}}"> {{checkCapaianSubkegiatan($item3->skpd_id, $item3->tahun, $item3->kode)}}</a>
                        @else
                            <a href="#" class="btn btn-xs btn-flat btn-success add-capaian3" data-uraian="{{$item3->nama}}" data-kode="{{$item3->kode}}"  data-tahun="{{$item3->tahun}}"><i class="fa fa-edit"></i></a>
                        @endif
                        
                    </td>
                    </tr>
                    @endforeach
                  {{-- @foreach ($datasubkegiatan->where('kegiatan_id', $item2->id) as $item3)
                  @if ($item3->status_kirim == null)
                  <tr style="font-size:10px; background-color:#d3f1f9">
                  @else
                  <tr style="font-size:10px;">
                  @endif
                    <td>
                      @if ($item3->status_kirim == 1)
                      <a href="/admin/laporan/batal/{{$item3->id}}/{{$bulan}}" onclick="return confirm('Yakin Ingin Di Batalkan?');"><i class="fa fa-times-circle text-danger"></i></a>
                      @endif
                    </td>
                    <td>{{$subkeg++}}</td>
                    <td width="200px">{{$item3->nama}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom3)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom4, 2)}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom5)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom6, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom7, 2)}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom8)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom9, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom10, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom11, 2)}}</td>
                    <td style="text-align: right;">{{number_format($item3->kolom12)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom13, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom14, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom15, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom16, 2)}}</td>
                    <td style="text-align: right;">{{round($item3->kolom17, 2)}}</td>
                  </tr>
                  @endforeach --}}
                @endforeach
              @endforeach
              
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-addcapaian">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="ion ion-clipboard"></i> Isi Capaian</h4>
        </div>
        <form method="post" action="/admin/capaian/program">
        <div class="modal-body">
            @csrf
            <div class="form-group">
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="text" id="tahun" class="form-control" name="tahun" readonly>
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <input type="text" id="jenis" class="form-control" name="jenis" value="program" readonly>
            </div>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" id="kode" class="form-control" name="kode" readonly>
            </div>
            <div class="form-group">
                <label>Uraian</label>
                <input type="text" id="uraian" class="form-control" name="uraian" readonly>
            </div>
            <div class="form-group">
                <label>Capaian</label>
                <input type="text" id="capaian" class="form-control" name="capaian" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
          <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="modal-addcapaian2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="ion ion-clipboard"></i> Isi Capaian</h4>
        </div>
        <form method="post" action="/admin/capaian/kegiatan">
        <div class="modal-body">
            @csrf
            <div class="form-group">
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="text" id="tahun2" class="form-control" name="tahun" readonly>
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <input type="text" id="jenis2" class="form-control" name="jenis" value="kegiatan" readonly>
            </div>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" id="kode2" class="form-control" name="kode" readonly>
            </div>
            <div class="form-group">
                <label>Uraian</label>
                <input type="text" id="uraian2" class="form-control" name="uraian" readonly>
            </div>
            <div class="form-group">
                <label>Capaian</label>
                <input type="text" id="capaian2" class="form-control" name="capaian" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
          <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="modal-addcapaian3">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="ion ion-clipboard"></i> Isi Capaian</h4>
        </div>
        <form method="post" action="/admin/capaian/subkegiatan">
        <div class="modal-body">
            @csrf
            <div class="form-group">
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="text" id="tahun3" class="form-control" name="tahun" readonly>
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <input type="text" id="jenis3" class="form-control" name="jenis" value="subkegiatan" readonly>
            </div>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" id="kode3" class="form-control" name="kode" readonly>
            </div>
            <div class="form-group">
                <label>Uraian</label>
                <input type="text" id="uraian3" class="form-control" name="uraian" readonly>
            </div>
            <div class="form-group">
                <label>Capaian</label>
                <input type="text" id="capaian3" class="form-control" name="capaian" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
          <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-editcapaian">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="ion ion-clipboard"></i> Edit Capaian</h4>
        </div>
        <form method="post" action="/admin/capaian/update">
        <div class="modal-body">
            @csrf
            <div class="form-group">
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="text" id="tahun4" class="form-control" name="tahun" readonly>
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <input type="text" id="jenis4" class="form-control" name="jenis" readonly>
            </div>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" id="kode4" class="form-control" name="kode" readonly>
            </div>
            <div class="form-group">
                <label>Uraian</label>
                <input type="text" id="uraian4" class="form-control" name="uraian" readonly>
            </div>
            <div class="form-group">
                <label>Capaian</label>
                <input type="text" id="capaian4" class="form-control" name="capaian" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
          <button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</section>

@endsection
@push('js')

<script>
    $(document).on('click', '.edit-capaian', function() {
    $('#kode4').val($(this).data('kode'));
    $('#jenis4').val($(this).data('jenis'));
    $('#tahun4').val($(this).data('tahun'));
    $('#uraian4').val($(this).data('uraian'));
    $("#modal-editcapaian").modal();
  });
  </script>

<script>
    $(document).on('click', '.add-capaian', function() {
    $('#kode').val($(this).data('kode'));
    $('#tahun').val($(this).data('tahun'));
    $('#uraian').val($(this).data('uraian'));
    $("#modal-addcapaian").modal();
  });
  </script>

<script>
    $(document).on('click', '.add-capaian2', function() {
    $('#kode2').val($(this).data('kode'));
    $('#tahun2').val($(this).data('tahun'));
    $('#uraian2').val($(this).data('uraian'));
    $("#modal-addcapaian2").modal();
  });
</script>

<script>
    $(document).on('click', '.add-capaian3', function() {
    $('#kode3').val($(this).data('kode'));
    $('#tahun3').val($(this).data('tahun'));
    $('#uraian3').val($(this).data('uraian'));
    $("#modal-addcapaian3").modal();
  });
</script>
@endpush
