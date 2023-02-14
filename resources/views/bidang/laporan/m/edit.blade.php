@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <form class="form-horizontal" method="post" action="/bidang/laporanrfk-rfk_m/edit/{{$data->id}}">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="deskripsi" value="{{$data->deskripsi}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Permasalahan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="permasalahan" value="{{$data->permasalahan}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Upaya</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="upaya" value="{{$data->upaya}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Pihak Pembantu</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="pihak_pembantu" value="{{$data->pihak_pembantu}}">
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

