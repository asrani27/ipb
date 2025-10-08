@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header">
        <i class="fa fa-file-o"></i>
        <h3 class="box-title">Export Laporan</h3>
      </div>
      <!-- /.box-header -->


      <div class="box-body">
        <a href="/superadmin/belanjaskpd/export" class="btn btn-primary btn-block" id="exportLink" onclick="handleExportClick(event)">
          <i class="fa fa-download"></i> Export Laporan Belanja
        </a>
      </div>
      <!-- /.box-body -->
    </div>

  </div>
</div>

@push('js')
<script>
function handleExportClick(event) {
    event.preventDefault();
    
    const link = document.getElementById('exportLink');
    const originalHref = link.href;
    const originalContent = link.innerHTML;
    
    // Disable link dan tampilkan loading state
    link.href = '#';
    link.style.pointerEvents = 'none';
    link.style.opacity = '0.6';
    link.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sedang Memproses...';
    
    // Mulai download
    window.location.href = originalHref;
    
    // Deteksi ketika download selesai menggunakan focus event
    // Browser akan kehilangan focus saat download dialog muncul
    // dan mendapatkan focus kembali setelah dialog ditutup
    let downloadStarted = false;
    let focusTimer;
    
    // Monitor focus changes
    function checkDownloadComplete() {
        if (document.hasFocus() && downloadStarted) {
            // Download selesai, enable kembali link
            link.href = originalHref;
            link.style.pointerEvents = 'auto';
            link.style.opacity = '1';
            link.innerHTML = originalContent;
            clearInterval(focusTimer);
        } else if (!downloadStarted && document.hasFocus()) {
            // Download belum dimulai, tunggu focus loss
            setTimeout(() => {
                if (!document.hasFocus()) {
                    downloadStarted = true;
                }
            }, 100);
        }
    }
    
    // Mulai monitoring focus
    focusTimer = setInterval(checkDownloadComplete, 500);
    
    // Fallback: enable setelah 30 detik jika tidak terdeteksi
    setTimeout(() => {
        clearInterval(focusTimer);
        link.href = originalHref;
        link.style.pointerEvents = 'auto';
        link.style.opacity = '1';
        link.innerHTML = originalContent;
    }, 30000);
}
</script>
@endpush
@endsection
