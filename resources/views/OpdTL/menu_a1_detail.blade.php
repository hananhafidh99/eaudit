@extends('template')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-file-document-box"></i>
            </span>
            Detail Data Dukung Rekomendasi
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('opdTL.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('opdTL.menuA1') }}">Menu A1</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <!-- Data Pengawasan Info (Read Only) -->
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="mdi mdi-information"></i>
                        Informasi Pengawasan
                        <span class="badge badge-warning ml-2">Read Only</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Surat:</label>
                                <input type="text" class="form-control" value="{{ $pengawasan['noSurat'] ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Pengawasan:</label>
                                <input type="text" class="form-control" value="{{ $pengawasan['jenis'] ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Obrik Pengawasan:</label>
                                <input type="text" class="form-control" value="{{ $pengawasan['obrik'] ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Pelaksanaan:</label>
                                <input type="text" class="form-control" value="{{ $pengawasan['tglkeluar'] ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Status LHP:</label>
                                <input type="text" class="form-control" value="{{ $pengawasan['status_LHP'] ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Temuan & Rekomendasi (Read Only) -->
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0">
                        <i class="mdi mdi-clipboard-text"></i>
                        Temuan & Rekomendasi
                        <span class="badge badge-light ml-2">Sesuai Permission Anda</span>
                    </h4>
                </div>
                <div class="card-body">
                    @if($data && count($data) > 0)
                        @foreach($data as $index => $parent)
                        <div class="mb-4">
                            <div class="alert alert-info">
                                <h5><strong>{{ chr(65 + $index) }}. {{ $parent->rekomendasi }}</strong></h5>
                                <p class="mb-1"><strong>Keterangan:</strong> {{ $parent->keterangan ?? 'Tidak ada keterangan' }}</p>
                                <p class="mb-0"><strong>Pengembalian:</strong> Rp {{ number_format($parent->pengembalian ?? 0, 0, ',', '.') }}</p>
                            </div>

                            @if($parent->sub && count($parent->sub) > 0)
                            <div class="ml-4">
                                @foreach($parent->sub as $subIndex => $sub)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h6><strong>{{ chr(65 + $index) }}.{{ $subIndex + 1 }}. {{ $sub->rekomendasi }}</strong></h6>
                                        <p class="text-muted mb-1">{{ $sub->keterangan ?? 'Tidak ada keterangan' }}</p>
                                        <small class="text-success">Pengembalian: Rp {{ number_format($sub->pengembalian ?? 0, 0, ',', '.') }}</small>

                                        @if($sub->sub && count($sub->sub) > 0)
                                        <div class="ml-3 mt-2">
                                            @foreach($sub->sub as $nestedIndex => $nested)
                                            <div class="border-left border-secondary pl-3 mb-2">
                                                <p class="mb-1"><strong>{{ chr(65 + $index) }}.{{ $subIndex + 1 }}.{{ $nestedIndex + 1 }}. {{ $nested->rekomendasi }}</strong></p>
                                                <p class="text-muted small mb-1">{{ $nested->keterangan ?? 'Tidak ada keterangan' }}</p>
                                                <small class="text-info">Pengembalian: Rp {{ number_format($nested->pengembalian ?? 0, 0, ',', '.') }}</small>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="mdi mdi-information-outline mdi-48px text-muted"></i>
                            <p class="text-muted mt-3">Tidak ada data temuan & rekomendasi yang dapat diakses sesuai permission Anda</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upload Data Dukung (Only allowed action) -->
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-gradient-success text-white">
                    <h4 class="mb-0">
                        <i class="mdi mdi-upload"></i>
                        Upload Data Dukung
                        <span class="badge badge-light ml-2">Aksi yang Diizinkan</span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <i class="mdi mdi-alert-circle"></i>
                        <strong>Perhatian:</strong> Anda hanya dapat mengunggah file. Tidak dapat mengedit data lainnya.
                    </div>

                    <form id="uploadForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_pengawasan" value="{{ $pengawasan['id'] }}">

                        <div class="form-group">
                            <label for="file">Pilih File:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip,.xlsx,.xls,.ppt,.pptx">
                                <label class="custom-file-label" for="file">Pilih file...</label>
                            </div>
                            <small class="form-text text-muted">
                                Format yang didukung: PDF, DOC, DOCX, JPG, PNG, ZIP, XLSX, XLS, PPT, PPTX (Maksimal 10MB)
                            </small>
                        </div>

                        <button type="submit" class="btn btn-gradient-success">
                            <i class="mdi mdi-upload"></i> Upload File
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Berkas Data Dukung yang Sudah Upload -->
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="mdi mdi-folder-multiple"></i>
                        Berkas Data Dukung
                    </h4>
                </div>
                <div class="card-body">
                    @if($uploadedFiles && count($uploadedFiles) > 0)
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
                                            <i class="mdi mdi-file-document"></i>
                                            {{ basename($file->nama_file) }}
                                        </td>
                                        <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ asset($file->nama_file) }}" class="btn btn-gradient-info btn-sm" target="_blank">
                                                <i class="mdi mdi-download"></i> Download
                                            </a>
                                            <span class="badge badge-secondary ml-1">View Only</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="mdi mdi-folder-open mdi-48px text-muted"></i>
                            <p class="text-muted mt-3">Belum ada file yang diupload</p>
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
    // File name display
    $('.custom-file-input').on('change', function() {
        const fileName = $(this)[0].files[0]?.name || 'Pilih file...';
        $(this).next('.custom-file-label').text(fileName);
    });

    // Upload form submission
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();

        // Show loading
        submitBtn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> Uploading...');

        $.ajax({
            url: '{{ route("opdTL.uploadFile") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success) {
                    // Show success message
                    showAlert('success', response.message);

                    // Reset form
                    $('#uploadForm')[0].reset();
                    $('.custom-file-label').text('Pilih file...');

                    // Reload page after delay
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    showAlert('error', response.message);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                const message = response?.message || 'Terjadi kesalahan saat upload file';
                showAlert('error', message);
            },
            complete: function() {
                // Restore button
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });

    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;

        $('.card-body:first').prepend(alertHtml);

        // Auto dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
});
</script>
@endpush
@endsection
