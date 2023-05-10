<div class="box box-primary">
<div class="box-header with-border">
    <i class="fa fa-clipboard"></i>

    <h3 class="box-title">Deskripsi</h3>
</div>
<!-- /.box-header -->
<div class="box-body text-sm">
    <dl>
    <dt>Tahun</dt>
    <dd>{{$data->first() == null ? '' : 'ada'}}</dd><br/>
    <dt>Program</dt>
    <dd>{{$data->first() == null ? '' : 'ada'}}</dd><br/>
    <dt>Kegiatan</dt>
    <dd>{{$data->first() == null ? '' : 'ada'}}</dd>
    </dl>
</div>
<!-- /.box-body -->
</div>