@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header">
        <i class="fa fa-file-o"></i>
        <h3 class="box-title">Export Laporan</h3>
      </div>
      <!-- /.box-header -->

      <form class="form-horizontal" action="/superadmin/laporan/rfk" method="get">
        @csrf
        <div class="box-body">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Bulan</label>
            <div class="col-sm-10">
              <select name="bulan" class="form-control" required>
                <option value="">-pilih-</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
            <div class="col-sm-10">
              <select name="tahun" class="form-control" required>
                <option value="">-pilih-</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
              </select>
            </div>
          </div>
          {{-- <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-10">
              <select name="jenis" class="form-control" required>
                <option value="">-pilih-</option>
                <option value="murni">Murni</option>
                <option value="pergeseran">Pergeseran</option>
                <option value="perubahan">Perubahan</option>
              </select>
            </div>
          </div> --}}
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary btn-block" value="excel" name="button">Export Excel</button>
              <button type="submit" class="btn btn-primary btn-block" value="masalah" name="button">Export
                Permasalahan</button>
            </div>
          </div>
        </div>
      </form>
      <!-- /.box-body -->
    </div>

  </div>
</div>


<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header">
        <i class="fa fa-file-o"></i>
        <h3 class="box-title">Data Pelaporan Tahun 2025</h3>
      </div>
      <!-- /.box-header -->

      <form class="form-horizontal" action="/superadmin/laporan/rfk" method="get">
        @csrf
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <td>NO</td>
              <td>SKPD</td>
              <td>JANUARI</td>
              <td>FEBRUARI</td>
              <td>MARET</td>
              <td>APRIL</td>
              <td>MEI</td>
              <td>JUNI</td>
              <td>JULI</td>
              <td>AGUSTUS</td>
              <td>SEPTEMBER</td>
              <td>OKTOBER</td>
              <td>NOVEMBER</td>
              <td>DESEMBER</td>
            </tr>
            @foreach ($skpd as $key => $item)

            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$item->nama}}</td>
              <td class="text-center">
                @if ($item->januari == null)
                @else
                @if ($item->januari->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('01', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('01', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->februari == null)
                @else
                @if ($item->februari->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('02', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('02', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->maret == null)
                @else
                @if ($item->maret->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('03', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('03', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->april == null)
                @else
                @if ($item->april->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('04', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('04', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->mei == null)
                @else
                @if ($item->mei->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('05', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('05', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->juni == null)
                @else
                @if ($item->juni->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('06', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('06', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->juli == null)
                @else
                @if ($item->juli->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('07', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('07', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->agustus == null)
                @else
                @if ($item->agustus->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('08', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('08', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->september == null)
                @else
                @if ($item->september->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('09', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('09', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->oktober == null)
                @else
                @if ($item->oktober->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('10', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('10', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->november == null)
                @else
                @if ($item->november->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('11', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('11', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
              <td class="text-center">
                @if ($item->desember == null)
                @else
                @if ($item->desember->data == '[]')
                <a href="/superadmin/laporan-batalkan/{{idLaporan('12', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a><br />
                no data
                @else
                <a href="/superadmin/laporan-batalkan/{{idLaporan('12', $tahun, $item->id)}}"
                  onclick="return confirm('Yakin ingin dibatalkan?')"><i class="fa fa-check text-green"></i></a>
                @endif
                @endif
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </form>
      <!-- /.box-body -->
    </div>

  </div>
</div>
@endsection
@push('js')

@endpush