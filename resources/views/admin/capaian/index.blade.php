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
          <h3>{{$tahun}}  </h3>

          <p>CAPAIAN TAHUN</p>
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
          <a href="/admin/capaian/tarik-indikator" class="btn btn-sm btn-primary text-bold"><i class="fa fa-recycle"></i> TARIK INDIKATOR DARI SIKAP</a>
          <a href="/admin/capaian/hapus-indikator" class="btn btn-sm btn-danger text-bold"  onclick="return confirm('Akan menghapus semua indikator dan capaian, Yakin?');"><i class="fa fa-trash"></i> HAPUS INDIKATOR</a>
          <a href="/admin/capaian/hitung-realisasi" class="btn btn-sm btn-success text-bold"  onclick="return confirm('akan menghitung realisasi keuangan?');"><i class="fa fa-money"></i> HITUNG REALISASI</a>
          <table class="table table-bordered table-condensed">
            <tbody>
              <tr style="font-size:10px;" class="bg-purple">
                <th style="width: 10px">#</th>
                <th style="text-align: center">Uraian Kegiatan</th>
                <th style="text-align: center">TW1</th>
                <th style="text-align: center">TW2</th>
                <th style="text-align: center">TW3</th>
                <th style="text-align: center">TW4</th>
                <th style="text-align: center">aksi</th>
              </tr>
              

              @php
              $keg = 1;
              $subkeg = 1;
              @endphp
              @foreach ($program as $key => $item)

              <tr style="font-size:11px;font-weight:bold;" class="bg-danger">
                <td style="width: 11px;"></td>
                <td width="400px">{{$item->kode}} {{$item->nama}}</td>
                @if (checkCapaian($item->skpd_id, $item->tahun, $item->kode, 'program') != null)   
                  @php
                  $data = tampilCapaian($item->skpd_id, $item->tahun, $item->kode, 'program');
                  $capaian = $data['capaian'];
                  $tw1 = $data['tw1'];
                  $tw2 = $data['tw2'];
                  $tw3 = $data['tw3'];
                  $tw4 = $data['tw4'];
                  @endphp 
                  <td class="text-center">
                    {{$tw1}}
                  </td>
                  <td class="text-center">
                    {{$tw2}}
                  </td>
                  <td class="text-center">
                    {{$tw3}}
                  </td>
                  <td class="text-center">
                    {{$tw4}}
                  </td>
                  <td class="text-center">
                    
                    {{-- <a href="#" class="btn btn-xs btn-success edit-capaian" data-uraian="{{$item->nama}}" data-kode="{{$item->kode}}" data-jenis="program" data-tw1="{{$tw1}}" data-tw2="{{$tw2}}" data-tw3="{{$tw3}}" data-tw4="{{$tw4}}" data-tahun="{{$item->tahun}}">Edit Capaian</a> --}}
                  </td>
                @else
                  <td class="text-center">
                    
                  </td>
                  <td class="text-center">
                    
                  </td>
                  <td class="text-center">
                    
                  </td>
                  <td class="text-center">
                    
                  </td>
                  <td class="text-center">
                    {{-- <a href="#" class="btn btn-xs btn-flat btn-success add-capaian" data-uraian="{{$item->nama}}" data-kode="{{$item->kode}}" data-jenis="program" data-tahun="{{$item->tahun}}">Isi Capaian</a> --}}
                  </td>
                @endif
              </tr>
                @foreach (checkIndikator($item->kode, 'program', $item->tahun) as $indikator_program)
                  <tr style="font-size:11px;font-weight:bold;" class="bg-info">
                    <td style="width: 11px;"></td>
                    <td style="width: 11px;">Indikator : {{$indikator_program->nama}}</td>
                    @if (checkCapaian($item->skpd_id, $item->tahun, $indikator_program->kode_indikator, 'indikator_program') != null)   
                    @php
                    $data = tampilCapaian($item->skpd_id, $item->tahun, $indikator_program->kode_indikator, 'indikator_program');
                    $capaian = $data['capaian'];
                    $tw1 = $data['tw1'];
                    $tw2 = $data['tw2'];
                    $tw3 = $data['tw3'];
                    $tw4 = $data['tw4'];
                    @endphp 
                    <td class="text-center">
                      {{$tw1}}
                    </td>
                    <td class="text-center">
                      {{$tw2}}
                    </td>
                    <td class="text-center">
                      {{$tw3}}
                    </td>
                    <td class="text-center">
                      {{$tw4}}
                    </td>
                    <td class="text-center">
                      
                      <a href="#" class="btn btn-xs btn-success edit-capaian" data-uraian="{{$indikator_program->nama}}" data-kode="{{$indikator_program->kode_indikator}}" data-jenis="indikator_program" data-tw1="{{$tw1}}" data-tw2="{{$tw2}}" data-tw3="{{$tw3}}" data-tw4="{{$tw4}}" data-tahun="{{$item->tahun}}">Edit Capaian</a>
                    </td>
                    @else
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center">
                        <a href="#" class="btn btn-xs btn-flat btn-success add-capaian" data-uraian="{{$indikator_program->nama}}" data-kode="{{$indikator_program->kode_indikator}}" data-jenis="indikator_program" data-tahun="{{$item->tahun}}">Isi Capaian</a>
                      </td>
                    @endif
                  </tr>
                @endforeach
                
                @foreach ($item->kegiatan as $key2 => $item2)

                <tr style="font-size:10px;" class="bg-warning">
                  <td></td>
                  <td width="200px">{{$item2->kode}} {{$item2->nama}}</td>
                  @if (checkCapaian($item2->skpd_id, $item2->tahun, $item2->kode, 'kegiatan') != null)   
                    @php
                    $data = tampilCapaian($item2->skpd_id, $item2->tahun, $item2->kode, 'kegiatan');
                    $capaian = $data['capaian'];
                    $tw1 = $data['tw1'];
                    $tw2 = $data['tw2'];
                    $tw3 = $data['tw3'];
                    $tw4 = $data['tw4'];
                    @endphp 
                    <td class="text-center">
                      {{$tw1}}
                    </td>
                    <td class="text-center">
                      {{$tw2}}
                    </td>
                    <td class="text-center">
                      {{$tw3}}
                    </td>
                    <td class="text-center">
                      {{$tw4}}
                    </td>
                    <td class="text-center">
                      
                      <a href="#" class="btn btn-xs btn-success edit-capaian" data-uraian="{{$item2->nama}}" data-kode="{{$item2->kode}}" data-jenis="kegiatan" data-tw1="{{$tw1}}" data-tw2="{{$tw2}}" data-tw3="{{$tw3}}" data-tw4="{{$tw4}}" data-tahun="{{$item2->tahun}}">Edit Capaian</a>
                    </td>
                  @else
                    <td class="text-center">
                      
                    </td>
                    <td class="text-center">
                      
                    </td>
                    <td class="text-center">
                      
                    </td>
                    <td class="text-center">
                      
                    </td>
                    <td class="text-center">
                      {{-- <a href="#" class="btn btn-xs btn-flat btn-success add-capaian" data-uraian="{{$item2->nama}}" data-kode="{{$item2->kode}}" data-jenis="kegiatan" data-tahun="{{$item2->tahun}}">Isi Capaian</a> --}}
                    </td>
                  @endif
                </tr>

                @foreach (checkIndikator($item2->kode, 'kegiatan', $item2->tahun) as $indikator_kegiatan)
                  <tr style="font-size:11px;" class="bg-info">
                    <td style="width: 11px;"></td>
                    <td style="width: 11px;">Indikator : {{$indikator_kegiatan->nama}}</td>
                    @if (checkCapaian($item2->skpd_id, $item2->tahun, $indikator_kegiatan->kode_indikator, 'indikator_kegiatan') != null)   
                    @php
                    $data = tampilCapaian($item2->skpd_id, $item2->tahun, $indikator_kegiatan->kode_indikator, 'indikator_kegiatan');
                    $capaian = $data['capaian'];
                    $tw1 = $data['tw1'];
                    $tw2 = $data['tw2'];
                    $tw3 = $data['tw3'];
                    $tw4 = $data['tw4'];
                    @endphp 
                    <td class="text-center">
                      {{$tw1}}
                    </td>
                    <td class="text-center">
                      {{$tw2}}
                    </td>
                    <td class="text-center">
                      {{$tw3}}
                    </td>
                    <td class="text-center">
                      {{$tw4}}
                    </td>
                    <td class="text-center">
                      
                      <a href="#" class="btn btn-xs btn-success edit-capaian" data-uraian="{{$indikator_kegiatan->nama}}" data-kode="{{$indikator_kegiatan->kode_indikator}}" data-jenis="indikator_kegiatan" data-tw1="{{$tw1}}" data-tw2="{{$tw2}}" data-tw3="{{$tw3}}" data-tw4="{{$tw4}}" data-tahun="{{$item->tahun}}">Edit Capaian</a>
                    </td>
                    @else
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center"></td>
                      <td class="text-center">
                        {{-- <a href="#" class="btn btn-xs btn-flat btn-success add-capaian" data-uraian="{{$indikator_kegiatan->nama}}" data-kode="{{$indikator_kegiatan->kode_indikator}}" data-jenis="indikator_kegiatan" data-tahun="{{$item->tahun}}">Isi Capaian</a> --}}
                      </td>
                    @endif
                  </tr>
                @endforeach
                    @foreach ($item2->subkegiatan as $key3 => $item3)

                    <tr style="font-size:10px;">
                    <td>{{$subkeg++}}</td>
                    <td width="200px">{{$item3->kode}}  {{$item3->nama}}</td>
                    @if (checkCapaian($item3->skpd_id, $item3->tahun, $item3->kode, 'subkegiatan') != null)   
                      @php
                      $data = tampilCapaian($item3->skpd_id, $item3->tahun, $item3->kode, 'subkegiatan');
                      $capaian = $data['capaian'];
                      $tw1 = $data['tw1'];
                      $tw2 = $data['tw2'];
                      $tw3 = $data['tw3'];
                      $tw4 = $data['tw4'];
                      @endphp 
                      <td class="text-center">
                        {{number_format($tw1)}}
                      </td>
                      <td class="text-center">
                        {{number_format($tw2)}}
                      </td>
                      <td class="text-center">
                        {{number_format($tw3)}}
                      </td>
                      <td class="text-center">
                        {{number_format($tw4)}}
                      </td>
                      <td class="text-center">
                        
                        {{-- <a href="#" class="btn btn-xs btn-success edit-capaian" data-uraian="{{$item3->nama}}" data-kode="{{$item3->kode}}" data-jenis="subkegiatan" data-tw1="{{$tw1}}" data-tw2="{{$tw2}}" data-tw3="{{$tw3}}" data-tw4="{{$tw4}}" data-tahun="{{$item3->tahun}}">Edit Capaian</a> --}}
                      </td>
                    @else
                      <td class="text-center">
                        
                      </td>
                      <td class="text-center">
                        
                      </td>
                      <td class="text-center">
                        
                      </td>
                      <td class="text-center">
                        
                      </td>
                      <td class="text-center">
                        {{-- <a href="#" class="btn btn-xs btn-flat btn-success add-capaian" data-uraian="{{$item3->nama}}" data-kode="{{$item3->kode}}" data-jenis="subkegiatan" data-tahun="{{$item3->tahun}}">Isi Capaian</a> --}}
                      </td>
                    @endif
                    </tr>

                    @foreach (checkIndikator($item3->kode, 'subkegiatan', $item3->tahun) as $indikator_subkegiatan)
                    <tr style="font-size:11px;" class="bg-info">
                      <td style="width: 11px;"></td>
                      <td style="width: 11px;">Indikator : {{$indikator_subkegiatan->nama}}</td>
                      @if (checkCapaian($item3->skpd_id, $item3->tahun, $indikator_subkegiatan->kode_indikator, 'indikator_subkegiatan') != null)   
                      @php
                      $data = tampilCapaian($item3->skpd_id, $item3->tahun, $indikator_subkegiatan->kode_indikator, 'indikator_subkegiatan');
                      $capaian = $data['capaian'];
                      $tw1 = $data['tw1'];
                      $tw2 = $data['tw2'];
                      $tw3 = $data['tw3'];
                      $tw4 = $data['tw4'];
                      @endphp 
                      <td class="text-center">
                        {{$tw1}}
                      </td>
                      <td class="text-center">
                        {{$tw2}}
                      </td>
                      <td class="text-center">
                        {{$tw3}}
                      </td>
                      <td class="text-center">
                        {{$tw4}}
                      </td>
                      <td class="text-center">
                        
                        <a href="#" class="btn btn-xs btn-success edit-capaian" data-uraian="{{$indikator_subkegiatan->nama}}" data-kode="{{$indikator_subkegiatan->kode_indikator}}" data-jenis="indikator_subkegiatan" data-tw1="{{$tw1}}" data-tw2="{{$tw2}}" data-tw3="{{$tw3}}" data-tw4="{{$tw4}}" data-tahun="{{$item->tahun}}">Edit Capaian</a>
                      </td>
                      @else
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">
                          <a href="#" class="btn btn-xs btn-flat btn-success add-capaian" data-uraian="{{$indikator_subkegiatan->nama}}" data-kode="{{$indikator_subkegiatan->kode_indikator}}" data-jenis="indikator_subkegiatan" data-tahun="{{$item->tahun}}">Isi Capaian</a>
                        </td>
                      @endif
                    </tr>
                    @endforeach

                    @endforeach
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
        <form method="post" action="/admin/capaian/store">
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
                <input type="text" id="jenis" class="form-control" name="jenis" readonly>
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
                <label>Capaian TW1</label>
                <input type="text" id="tw1" class="form-control" name="tw1">
            </div>
            <div class="form-group">
                <label>Capaian TW2</label>
                <input type="text" id="tw2" class="form-control" name="tw2">
            </div>
            <div class="form-group">
                <label>Capaian TW3</label>
                <input type="text" id="tw3" class="form-control" name="tw3">
            </div>
            <div class="form-group">
                <label>Capaian TW4</label>
                <input type="text" id="tw4" class="form-control" name="tw4">
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
                <input type="text" id="edit-tahun" class="form-control" name="tahun" readonly>
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <input type="text" id="edit-jenis" class="form-control" name="jenis" readonly>
            </div>
            <div class="form-group">
                <label>Kode</label>
                <input type="text" id="edit-kode" class="form-control" name="kode" readonly>
            </div>
            <div class="form-group">
                <label>Uraian</label>
                <input type="text" id="edit-uraian" class="form-control" name="uraian" readonly>
            </div>
            <div class="form-group">
                <label>Capaian TW1</label>
                <input type="text" id="edit-tw1" class="form-control" name="tw1">
            </div>
            <div class="form-group">
                <label>Capaian TW2</label>
                <input type="text" id="edit-tw2" class="form-control" name="tw2">
            </div>
            <div class="form-group">
                <label>Capaian TW3</label>
                <input type="text" id="edit-tw3" class="form-control" name="tw3">
            </div>
            <div class="form-group">
                <label>Capaian TW4</label>
                <input type="text" id="edit-tw4" class="form-control" name="tw4">
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
    $('#edit-kode').val($(this).data('kode'));
    $('#edit-jenis').val($(this).data('jenis'));
    $('#edit-tahun').val($(this).data('tahun'));
    $('#edit-uraian').val($(this).data('uraian'));
    $('#edit-tw1').val($(this).data('tw1'));
    $('#edit-tw2').val($(this).data('tw2'));
    $('#edit-tw3').val($(this).data('tw3'));
    $('#edit-tw4').val($(this).data('tw4'));
    $("#modal-editcapaian").modal();
  });
  </script>

<script>
    $(document).on('click', '.add-capaian', function() {
    $('#kode').val($(this).data('kode'));
    $('#jenis').val($(this).data('jenis'));
    $('#triwulan').val($(this).data('tw'));
    $('#tahun').val($(this).data('tahun'));
    $('#uraian').val($(this).data('uraian'));
    $("#modal-addcapaian").modal();
  });
  </script>
  
@endpush
