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
              <tr style="font-size:10px;" class="bg-purple" >
                <th style="width: 10px" rowspan="2">No</th>
                <th style="text-align:center" rowspan="2">Uraian Paket Pekerjaan</th>
                <th style="text-align:center" rowspan="2">Nilai DPA (Rp)</th>
                <th style="text-align:center" rowspan="2">Jenis Pengadaan</th>
                <th style="text-align:center" colspan="3">Barang</th>
                <th style="text-align:center" colspan="3">Jasa Konsultasi</th>
                <th style="text-align:center" colspan="3">Pekerjaan Konstruksi</th>
                <th style="text-align:center" colspan="3">Jasa Lainnya</th>
                <th style="text-align:center" colspan="3">Jumlah</th>
                <th></th>
              </tr>
              <tr style="font-size:10px;" class="bg-purple">
                
                <th style="text-align:center">Belum</th>
                <th style="text-align:center">Sedang</th>
                <th style="text-align:center">Selesai</th>
                <th style="text-align:center">Belum</th>
                <th style="text-align:center">Sedang</th>
                <th style="text-align:center">Selesai</th>
                <th style="text-align:center">Belum</th>
                <th style="text-align:center">Sedang</th>
                <th style="text-align:center">Selesai</th>
                <th style="text-align:center">Belum</th>
                <th style="text-align:center">Sedang</th>
                <th style="text-align:center">Selesai</th>
                <th style="text-align:center">Belum</th>
                <th style="text-align:center">Sedang</th>
                <th style="text-align:center">Selesai</th>
                <th></th>
              </tr>
              @if ($pbj->count() != 0)
                  
              @foreach ($pbj as $key => $item)
                  
              <tr style="font-size:10px;">
                <td style="width: 10px">{{$key + 1}}</td>
                <td>{{$item->deskripsi}}</td>
                <td>{{number_format($item->nilai_dpa)}}</td>
                <td>{{$item->jenis}}</td>
                <td>{{$item->b_belum}}</td>
                <td>{{$item->b_sedang}}</td>
                <td>{{$item->b_selesai}}</td>
                <td>{{$item->jk_belum}}</td>
                <td>{{$item->jk_sedang}}</td>
                <td>{{$item->jk_selesai}}</td>
                <td>{{$item->pk_belum}}</td>
                <td>{{$item->pk_sedang}}</td>
                <td>{{$item->pk_selesai}}</td>
                <td>{{$item->jl_belum}}</td>
                <td>{{$item->jl_sedang}}</td>
                <td>{{$item->jl_selesai}}</td>
                <td>{{$item->b_belum + $item->jk_belum + $item->pk_belum + $item->jl_belum}}</td>
                <td>{{$item->b_sedang + $item->jk_sedang + $item->pk_sedang + $item->jl_sedang}}</td>
                <td>{{$item->b_selesai + $item->jk_selesai + $item->pk_selesai + $item->jl_selesai}}</td>
                <td>
                  <a href="/bidang/laporanrfk-rfk_pbj/edit/{{$item->id}}"><i class="fa fa-edit"></i></a>
                  <a href="/bidang/laporanrfk-rfk_pbj/delete/{{$item->id}}" onclick="return confirm('Yakin Ingin Di Hapus?');"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
              @endif
              </tbody>
            </table>
          </div>
        </div>
        <a href="/bidang/laporanrfk-rfk_pbj/tambah-pbj/{{$subkegiatan->id}}/{{$bulan}}" class='btn btn-flat btn-block bg-purple'>TAMBAH</a>
      </div>
    </div>
</section>


@endsection
@push('js')

@endpush

