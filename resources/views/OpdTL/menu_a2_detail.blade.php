@extends('template')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-file-document-box-outline"></i>
            </span>
            Detail Data Dukung Rekomendasi
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('opdTL.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('opdTL.menuA2') }}">Menu A2</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <!-- Informasi Pengawasan -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">
                            <i class="mdi mdi-information-outline text-info me-2"></i>
                            Informasi Pengawasan
                        </h4>
                        <a href="{{ route('opdTL.menuA2') }}" class="btn btn-sm btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><strong>Nomor Surat:</strong></label>
                                <p class="form-control-plaintext">{{ '700.1.1/' . ($pengawasan['noSurat'] ?? '-') . '/03' . '/' . date('Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><strong>Tanggal Keluar:</strong></label>
                                <p class="form-control-plaintext">{{ $pengawasan['tglkeluar'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><strong>Jenis Pengawasan:</strong></label>
                                <p class="form-control-plaintext">{{ $pengawasan['nama_jenispengawasan'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><strong>Obrik:</strong></label>
                                <p class="form-control-plaintext">{{ $pengawasan['nama_obrik'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Temuan dan Rekomendasi -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="mdi mdi-clipboard-list-outline text-warning me-2"></i>
                        Data Temuan dan Rekomendasi (Read Only)
                    </h4>

                    @if(count($data) > 0)
                        @foreach($data as $key => $parent)
                            <div class="accordion accordion-bordered" id="accordion{{ $parent->id }}">
                                <div class="card">
                                    <div class="card-header" id="heading{{ $parent->id }}">
                                        <h6 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse{{ $parent->id }}" aria-expanded="false" 
                                                    aria-controls="collapse{{ $parent->id }}">
                                                <i class="mdi mdi-folder-outline me-2"></i>
                                                <strong>{{ $parent->kode_temuan }}</strong> - {{ $parent->nama_temuan }}
                                            </button>
                                        </h6>
                                    </div>

                                    <div id="collapse{{ $parent->id }}" class="collapse" 
                                         aria-labelledby="heading{{ $parent->id }}" data-bs-parent="#accordion{{ $parent->id }}">
                                        <div class="card-body">
                                            <!-- Parent Details -->
                                            <div class="mb-3 p-3 border-left border-primary bg-light">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><strong>Kode Temuan:</strong> {{ $parent->kode_temuan }}</p>
                                                        <p><strong>Nama Temuan:</strong> {{ $parent->nama_temuan }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>Kode Rekomendasi:</strong> {{ $parent->kode_rekomendasi ?? '-' }}</p>
                                                        <p><strong>Nama Rekomendasi:</strong> {{ $parent->nama_rekomendasi ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sub Items -->
                                            @if(count($parent->sub) > 0)
                                                <h6 class="text-muted mb-3">Sub Temuan/Rekomendasi:</h6>
                                                @foreach($parent->sub as $subKey => $sub)
                                                    <div class="card mb-2">
                                                        <div class="card-body p-3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="mb-1"><strong>Kode:</strong> {{ $sub->kode_temuan }}</p>
                                                                    <p class="mb-1"><strong>Temuan:</strong> {{ $sub->nama_temuan }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="mb-1"><strong>Kode Rekomendasi:</strong> {{ $sub->kode_rekomendasi ?? '-' }}</p>
                                                                    <p class="mb-1"><strong>Rekomendasi:</strong> {{ $sub->nama_rekomendasi ?? '-' }}</p>
                                                                </div>
                                                            </div>

                                                            <!-- Nested Sub Items -->
                                                            @if(count($sub->sub) > 0)
                                                                <div class="mt-2 ps-4">
                                                                    <h6 class="text-muted mb-2">Detail Lebih Lanjut:</h6>
                                                                    @foreach($sub->sub as $nestedKey => $nested)
                                                                        <div class="border-start border-info ps-3 mb-2">
                                                                            <small class="text-muted d-block">{{ $nested->kode_temuan }} - {{ $nested->nama_temuan }}</small>
                                                                            @if($nested->nama_rekomendasi)
                                                                                <small class="text-info d-block">Rekomendasi: {{ $nested->nama_rekomendasi }}</small>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="mdi mdi-information-outline mdi-48px text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak Ada Data Temuan</h5>
                            <p class="text-muted">Belum ada data temuan dan rekomendasi yang dapat Anda akses untuk pengawasan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- File Upload dan Data Dukung -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="mdi mdi-file-multiple-outline text-success me-2"></i>
                        Data Dukung yang Diupload
                    </h4>

                    @if(count($uploadedFiles) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama File</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($uploadedFiles as $index => $file)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <i class="mdi mdi-file-outline me-2"></i>
                                                {{ basename($file->nama_file) }}
                                            </td>
                                            <td>{{ $file->created_at ? $file->created_at->format('d/m/Y H:i') : '-' }}</td>
                                            <td>
                                                <a href="{{ url($file->nama_file) }}" target="_blank" 
                                                   class="btn btn-sm btn-success btn-rounded">
                                                    <i class="mdi mdi-download"></i> Unduh
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="mdi mdi-file-outline mdi-48px text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada File</h5>
                            <p class="text-muted">Belum ada file data dukung yang diupload untuk pengawasan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Auto-collapse accordion items except first one
    $('.accordion .collapse:first').addClass('show');
});
</script>
@endpush
@endsection