@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <form class="form-horizontal" method="post" action="/bidang/laporanrfk-rfk_st/edit/{{$data->id}}">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="deskripsi" value="{{$data->deskripsi}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nilai DPA</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="nilai_dpa" onkeypress="return hanyaAngka(event)"  value="{{$data->nilai_dpa}}"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nilai HPS</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="nilai_hps" onkeypress="return hanyaAngka(event)"  value="{{$data->nilai_hps}}"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nilai Kontrak</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="nilai_kontrak" onkeypress="return hanyaAngka(event)" value="{{$data->nilai_kontrak}}"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Penyedia</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="penyedia" value="{{$data->penyedia}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nomor Kontrak</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="nomor_kontrak" value="{{$data->nomor_kontrak}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Kontrak</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="tanggal_kontrak" value="{{$data->tanggal_kontrak}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-block btn-flat btn-primary">UPDATE</button>
                </div>
              </div>
            </div>
          </form>
        </div>
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

