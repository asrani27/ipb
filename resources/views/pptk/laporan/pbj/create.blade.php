@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <!-- Block buttons -->
        <div class="box">
          <form class="form-horizontal" method="post" action="/bidang/laporanrfk-rfk_pbj/tambah-pbj/{{$id}}/{{$bulan}}">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Uraian Paket Pekerjaan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="deskripsi">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nilai DPA</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="nilai_dpa" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Pengadaan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="jenis">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">BARANG</label>
                <div class="col-sm-10">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Belum</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="b_belum" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sedang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="b_sedang" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Selesai</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="b_selesai" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">JASA KONSULTASI</label>
                <div class="col-sm-10">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Belum</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="jk_belum" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sedang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="jk_sedang" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Selesai</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="jk_selesai" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">PEKERJAAN KONSTRUKSI</label>
                <div class="col-sm-10">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Belum</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="pk_belum" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sedang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="pk_sedang" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Selesai</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="pk_selesai" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-2 control-label">JASA LAINNYA</label>
                <div class="col-sm-10">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Belum</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="jl_belum" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sedang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="jl_sedang" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Selesai</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-sm" name="jl_selesai" onkeypress="return hanyaAngka(event)"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-block btn-flat btn-primary">SIMPAN</button>
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

