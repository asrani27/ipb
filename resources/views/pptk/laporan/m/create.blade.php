@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <form class="form-horizontal" method="post" action="/pptk/laporanrfk/{{$id}}/{{$tahun}}/{{$bulan}}/m/add">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="deskripsi">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Permasalahan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="permasalahan">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Upaya</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="upaya">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Pihak Pembantu</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="pihak_pembantu">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-block btn-flat btn-primary">SIMPAN MASALAH</button>
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

