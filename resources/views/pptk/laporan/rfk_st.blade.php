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
    
              {{-- <div class="box-tools">
                <a href="/bidang/program/add" class="btn btn-sm btn-primary btn-flat "><i class="fa fa-plus-circle"></i> Tambah Program</a>
              </div> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body text-sm">
                <dl>
                <dd><strong>TAHUN :</strong> {{$tahun}}</dd>
                <dd><strong>BULAN :</strong> {{$nama_bulan}}</dd>
                <dd><strong>PROGRAM :</strong> {{$program->nama}}</dd>
                <dd><strong>KEGIATAN :</strong> {{$kegiatan->nama}}</dd>
                <dd><strong>SUB KEGIATAN :</strong> {{$subkegiatan->nama}}</dd>
                <dd><strong>JENIS RFK :</strong> {{$jenisrfk}}</dd>
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
          <div class="box-body">
            @include('bidang.laporan.rfk_menu')
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <div class="box-body">
            <table class="table table-bordered table-condensed">
              <tbody>
              <tr style="font-size:10px;" class="bg-purple">
                <th style="width: 10px">No</th>
                <th>Uraian Paket Pekerjaan</th>
                <th>Nilai DPA (Rp)</th>
                <th>Nilai Pagu Pengadaan BJ (Rp)</th>
                <th>Nilai HPS (Rp)</th>
                <th>Nilai Kontrak (Rp)</th>
                <th>Sisa Tender (Rp)</th>
                <th>Nama Penyedia Jasa</th>
                <th>Nomor Dan Tanggal Kontrak</th>
                <th></th>
              </tr>
              @if ($st->count() != 0)
                  
              @foreach ($st as $key => $item)
                  
              <tr style="font-size:10px;">
                <td style="width: 10px">{{$key + 1}}</td>
                <td>{{$item->deskripsi}}</td>
                <td style="text-align: right">{{number_format($item->nilai_dpa)}}</td>
                <td style="text-align: right">{{number_format($item->nilai_dpa)}}</td>
                <td style="text-align: right">{{number_format($item->nilai_hps)}}</td>
                <td style="text-align: right">{{number_format($item->nilai_kontrak)}}</td>
                <td style="text-align: right">{{number_format($item->nilai_dpa - $item->nilai_kontrak)}}</td>
                <td>{{$item->penyedia}}</td>
                <td>{{$item->nomor_kontrak}} <br/>{{$item->tanggal_kontrak}}</td>
                <td>
                  <a href="/bidang/laporanrfk-rfk_st/edit/{{$item->id}}"><i class="fa fa-edit"></i></a>
                  <a href="/bidang/laporanrfk-rfk_st/delete/{{$item->id}}" onclick="return confirm('Yakin Ingin Di Hapus?');"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
              <tr style="font-size:10px;background-color:#e7e4e6">
                <td></td>
                <td>Jumlah</td>
                <td style="text-align: right">{{number_format($st->sum('nilai_dpa'))}}</td>
                <td style="text-align: right">{{number_format($st->sum('nilai_dpa'))}}</td>
                <td style="text-align: right">{{number_format($st->sum('nilai_hps'))}}</td>
                <td style="text-align: right">{{number_format($st->sum('nilai_kontrak'))}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              @endif
              </tbody>
            </table>
          </div>
        </div>
        <a href="/bidang/laporanrfk-rfk_st/tambah-st/{{$subkegiatan->id}}/{{$bulan}}" class='btn btn-flat btn-block bg-purple'>TAMBAH</a>
      </div>
    </div>
    
</section>


@endsection
@push('js')
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>
@endpush

