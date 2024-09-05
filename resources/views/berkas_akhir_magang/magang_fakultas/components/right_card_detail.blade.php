@if($berkas->status_berkas == 'pending')
<div class="card">
    <div class="card-body">
        <a href="#" onclick="approve()" class="btn btn-primary w-100 mb-2">Lengkap</a>
        <a href="#" onclick="reject()" class="btn btn-danger w-100">Tidak Lengkap</a>
    </div>
</div>
@elseif($berkas->status_berkas == 'approved')
<div class="card">
    <div class="card-body">
        <h5>Berkas Telah Disetujui</h5>
    </div>
</div>
@else
<div class="card">
    <div class="card-body">
        <h6>Alasan penolakan dokumen:</h6>
        <p>{{ $berkas->rejected_reason }}</p>
    </div>
</div>
@endif