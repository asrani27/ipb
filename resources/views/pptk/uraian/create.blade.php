@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
@endpush
@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-header with-border">
              <i class="fa fa-clipboard"></i>
          
              <h3 class="box-title">Deskripsi</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body text-sm">
              <dl>
              <dt>Tahun</dt>
              <dd>{{$subkegiatan->tahun}} - {{$subkegiatan->jenis_rfk}}</dd><br/>
              <dt>Program</dt>
              <dd>{{$subkegiatan->kegiatan->program->nama}}</dd><br/>
              <dt>Kegiatan</dt>
              <dd>{{$subkegiatan->kegiatan->nama}}</dd><br/>
              <dt>Sub Kegiatan</dt>
              <dd>{{$subkegiatan->nama}}</dd>
              </dl>
          </div>
          <!-- /.box-body -->
        </div>
      </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-clipboard"></i> Tambah Uraian Kegiatan</h3>
        
                  <div class="box-tools">
                    
                  </div>
                </div>
                <form class="form-horizontal" action="/pptk/subkegiatan/uraian/{{$subkegiatan_id}}/add" method="post">
                    @csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Kode Rekening</label>
                      <div class="col-sm-10">
                        <select class="form-control select2" name="kode_akun">
                          @foreach ($akun as $item)
                              <option value="{{$item->id}}">{{$item->kode_akun}} - {{$item->nama_akun}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>
                      <div class="col-sm-10">
                        <input type="text" name="keterangan" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">DPA</label>
                      <div class="col-sm-10">
                        <input type="text" name="dpa" class="form-control" id="rupiah">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
                        <a href="/pptk/subkegiatan/uraian/{{$subkegiatan_id}}" class="btn bg-gray btn-flat btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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
<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    })
  var rupiah = document.getElementById("rupiah");
  rupiah.addEventListener("keyup", function(e) {
  rupiah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
var number_string = angka.replace(/[^,\d]/g, "").toString(),
  split = number_string.split(","),
  sisa = split[0].length % 3,
  rupiah = split[0].substr(0, sisa),
  ribuan = split[0].substr(sisa).match(/\d{3}/gi);

// tambahkan titik jika yang di input sudah menjadi angka ribuan
if (ribuan) {
  separator = sisa ? "." : "";
  rupiah += separator + ribuan.join(".");
}

rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
</script>
@endpush

