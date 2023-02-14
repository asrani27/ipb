@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Tambah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/admin/perioderfk/add" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-10">
                        <select name="tahun" class="form-control" required>
                            <option value="">-pilih-</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Januari</label>
                  <div class="col-sm-10">
                    <select name="januari" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Februari</label>
                  <div class="col-sm-10">
                    <select name="februari" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Maret</label>
                  <div class="col-sm-10">
                    <select name="maret" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">April</label>
                  <div class="col-sm-10">
                    <select name="april" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Mei</label>
                  <div class="col-sm-10">
                    <select name="mei" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Juni</label>
                  <div class="col-sm-10">
                    <select name="juni" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Juli</label>
                  <div class="col-sm-10">
                    <select name="juli" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Agustus</label>
                  <div class="col-sm-10">
                    <select name="agustus" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">September</label>
                  <div class="col-sm-10">
                    <select name="september" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Oktober</label>
                  <div class="col-sm-10">
                    <select name="oktober" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">November</label>
                  <div class="col-sm-10">
                    <select name="november" class="form-control" required>
                        <option value="">-pilih-</option>
                        <option value="murni">Murni</option>
                        <option value="pergeseran">Pergeseran</option>
                        <option value="perubahan">Perubahan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Desember</label>
                  <div class="col-sm-10">
                    <select name="desember" class="form-control" required>
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
                    <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i> Simpan</button>
                    <a href="/admin/perioderfk" class="btn bg-gray btn-flat btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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

@endpush

