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
    
    // Tambahkan timestamp ke URL untuk tracking
    const timestamp = Date.now();
    const downloadUrl = originalHref + '?t=' + timestamp;
    
    // Set cookie untuk tracking download
    document.cookie = 'download_start_' + timestamp + '=' + timestamp + '; path=/';
    
    // Mulai download
    window.location.href = downloadUrl;
    
    // Monitor cookie untuk deteksi completion
    let checkCount = 0;
    const maxChecks = 60; // Maximum 60 checks (30 detik)
    
    function checkDownloadComplete() {
        checkCount++;
        
        // Cek apakah download cookie sudah dihapus oleh server
        const cookies = document.cookie.split(';');
        let downloadComplete = true;
        
        for (let cookie of cookies) {
            const [name, value] = cookie.trim().split('=');
            if (name === 'download_start_' + timestamp && value == timestamp) {
                downloadComplete = false;
                break;
            }
        }
        
        if (downloadComplete) {
            // Download selesai, enable kembali link
            link.href = originalHref;
            link.style.pointerEvents = 'auto';
            link.style.opacity = '1';
            link.innerHTML = originalContent;
        } else if (checkCount < maxChecks) {
            // Lanjut monitoring
            setTimeout(checkDownloadComplete, 500);
        } else {
            // Fallback: enable setelah timeout
            link.href = originalHref;
            link.style.pointerEvents = 'auto';
            link.style.opacity = '1';
            link.innerHTML = originalContent;
            // Hapus cookie yang mungkin tersisa
            document.cookie = 'download_start=' + timestamp + '; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/';
        }
    }
    
    // Mulai monitoring setelah delay kecil untuk memastikan download dimulai
    setTimeout(checkDownloadComplete, 1000);
}
</script>
@endpush
@endsection
