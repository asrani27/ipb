@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-clipboard"></i> Laporan Triwulan</h3>
          </div>

          <form class="form-horizontal" action="/admin/laptriwulan" method="post">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                <div class="col-sm-10">
                  <select class="form-control" name="tahun">
                    <option value="">-pilih-</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                  </select>
                </div>
              </div>
              {{-- <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">TRIWULAN</label>
                <div class="col-sm-10">
                  <select class="form-control" name="triwulan">
                    <option value="">-pilih-</option>
                    <option value="1">TW I</option>
                    <option value="2">TW 2</option>
                    <option value="3">TW 3</option>
                    <option value="4">TW 4</option>
                  </select>
                </div>
              </div> --}}
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">JENIS RFK</label>
                <div class="col-sm-10">
                  <select class="form-control" name="jenis">
                    <option value="">-pilih-</option>
                    <option value="murni">Murni</option>
                    <option value="pergeseran">Pergeseran</option>
                    <option value="perubahan">perubahan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-sm bg-purple btn-flat">Export</button>
                </div>
              </div>
            </div>
          </form>
          <!-- /.box-body -->
      </div>
    </div>
  </div>
</section>

@endsection
@push('js')

@endpush
