@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-file-o"></i><h3 class="box-title">Data Laporan</h3>
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
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
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
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
                <div class="col-sm-10">
                      <select name="jenis" class="form-control" required>
                          <option value="">-pilih-</option>
                          <option value="murni">Murni</option>
                          <option value="pergeseran">Pergeseran</option>
                          <option value="perubahan">Perubahan</option>
                      </select>
                </div>
              </div>
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
@endsection
@push('js')

@endpush
