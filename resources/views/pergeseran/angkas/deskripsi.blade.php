<div class="box box-primary">
<div class="box-header with-border">
    <i class="fa fa-clipboard"></i>

    <h3 class="box-title">Deskripsi</h3>
</div>
<!-- /.box-header -->
<div class="box-body text-sm">
    <dl>
    <dt>Tahun</dt>
    <dd>{{$program->tahun}}</dd><br/>
    <dt>Program</dt>
    <dd>{{$program->nama}}</dd><br/>
    <dt>Kegiatan</dt>
    <dd>{{$kegiatan->nama}}</dd><br/>
    <dt>Sub Kegiatan</dt>
    <dd>{{$subkegiatan->nama}}</dd><br/>
    <dt>Uraian Kegiatan</dt>
    <dd>{{$uraian->nama}}<br/>{{$uraian->keterangan}}</dd><br/>
    <dt>DPA</dt>
    <dd>{{number_format($uraian->dpa)}}</dd>
    </dl>
</div>
<!-- /.box-body -->
</div>