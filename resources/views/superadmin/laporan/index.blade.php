@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-file-o"></i><h3 class="box-title">Export Laporan</h3>
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
                  <button type="submit" class="btn btn-primary btn-block">Export Excel</button>
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
          <i class="fa fa-file-o"></i><h3 class="box-title">Data Pelaporan</h3>
        </div>
        <!-- /.box-header -->

        <form class="form-horizontal" action="/superadmin/laporan/rfk" method="get">
          @csrf
          <div class="box-body">
            <table class="table table-border">
              <tr>
                <td>2024</td>
                <td>
                  <a href="/superadmin/laporan/2024/01" class="btn btn-primary btn-sm">JANUARI</a>
                  <a href="/superadmin/laporan/2024/02" class="btn btn-primary btn-sm">FEBRUARI</a>
                  <a href="/superadmin/laporan/2024/03" class="btn btn-primary btn-sm">MARET</a>
                  <a href="/superadmin/laporan/2024/04" class="btn btn-primary btn-sm">APRIL</a>
                  <a href="/superadmin/laporan/2024/05" class="btn btn-primary btn-sm">MEI</a>
                  <a href="/superadmin/laporan/2024/06" class="btn btn-primary btn-sm">JUNI</a>
                  <a href="/superadmin/laporan/2024/07" class="btn btn-primary btn-sm">JULI</a>
                  <a href="/superadmin/laporan/2024/08" class="btn btn-primary btn-sm">AGUSTUS</a>
                  <a href="/superadmin/laporan/2024/09" class="btn btn-primary btn-sm">SEPTEMBER</a>
                  <a href="/superadmin/laporan/2024/10" class="btn btn-primary btn-sm">OKTOBER</a>
                  <a href="/superadmin/laporan/2024/11" class="btn btn-primary btn-sm">NOVEMBER</a>
                  <a href="/superadmin/laporan/2024/12" class="btn btn-primary btn-sm">DESEMBER</a>
                </td>
              </tr>
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
