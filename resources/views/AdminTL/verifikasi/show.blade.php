@extends('template')

@section('title', $pageTitle ?? 'Detail Verifikasi Data')
<style>
    .status-badge {
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
    }
    .status-belum-jadi {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    .status-di-proses {
        background-color: #cce5ff;
        color: #004085;
        border: 1px solid #74c0fc;
    }
    .status-diterima {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .status-ditolak {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .file-item {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }
    .file-item:hover {
        border-color: #0d6efd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .update-status-form {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        border: 2px dashed #dee2e6;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .btn-update {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-update:hover {
        background: linear-gradient(45deg, #0056b3, #004085);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        color: white;
    }
    .info-item {
        border-bottom: 1px solid #e9ecef;
        padding: 0.75rem 0;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
</style>

@section('content')
<div class="container-fluid">
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">
                                <i class="fas fa-check-circle text-primary"></i>
                                {{ $pageTitle ?? 'Detail Verifikasi Data' }}
                            </h4>
                            <p class="text-muted mb-0">ID Pengawasan: <strong>{{ $pengawasan->id }}</strong></p>
                        </div>
                        <div>
                            @php
                                $backRoute = isset($pageType) && $pageType === 'temuan'
                                    ? route('adminTL.verifikasi.temuan')
                                    : route('adminTL.verifikasi.rekomendasi');
                            @endphp
                            <a href="{{ $backRoute }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Data Information -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Informasi Data Pengawasan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>ID Pengawasan:</strong><br>
                                <span class="text-muted">{{ $pengawasan->id }}</span>
                            </div>
                            <div class="info-item">
                                <strong>ID Penugasan:</strong><br>
                                <span class="text-muted">{{ $pengawasan->id_penugasan ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Tipe:</strong><br>
                                <span class="text-muted">{{ $pengawasan->tipe ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong>Jenis:</strong><br>
                                <span class="text-muted">{{ $pengawasan->jenis ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Wilayah:</strong><br>
                                <span class="text-muted">{{ $pengawasan->wilayah ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Pemeriksa:</strong><br>
                                <span class="text-muted">{{ $pengawasan->pemeriksa ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="info-item">
                                <strong>Status Saat Ini:</strong><br>
                                @if($pengawasan->status_LHP == 'Belum Jadi')
                                    <span class="status-badge status-belum-jadi">
                                        <i class="fas fa-clock"></i> Belum Jadi
                                    </span>
                                @elseif($pengawasan->status_LHP == 'Di Proses')
                                    <span class="status-badge status-di-proses">
                                        <i class="fas fa-cogs"></i> Di Proses
                                    </span>
                                @elseif($pengawasan->status_LHP == 'Diterima')
                                    <span class="status-badge status-diterima">
                                        <i class="fas fa-check"></i> Diterima
                                    </span>
                                @elseif($pengawasan->status_LHP == 'Ditolak')
                                    <span class="status-badge status-ditolak">
                                        <i class="fas fa-times"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                            <div class="info-item">
                                <strong>Tanggal Keluar:</strong><br>
                                <span class="text-muted">{{ $pengawasan->tglkeluar ? \Carbon\Carbon::parse($pengawasan->tglkeluar)->format('d/m/Y') : 'N/A' }}</span>
                            </div>
                            @if($pengawasan->tgl_verifikasi)
                            <div class="info-item">
                                <strong>Tanggal Verifikasi:</strong><br>
                                <span class="text-muted">{{ \Carbon\Carbon::parse($pengawasan->tgl_verifikasi)->format('d/m/Y H:i:s') }}</span>
                            </div>
                            @endif
                            @if($pengawasan->alasan_verifikasi)
                            <div class="info-item">
                                <strong>Alasan Verifikasi Terakhir:</strong><br>
                                <div class="bg-light p-2 rounded mt-1">
                                    {{ $pengawasan->alasan_verifikasi }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Files Section -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-files"></i>
                        File Data Dukung ({{ $pengawasan->dataDukung->count() }} file)
                    </h5>
                </div>
                <div class="card-body">
                    @if($pengawasan->dataDukung->count() > 0)
                        @foreach($pengawasan->dataDukung as $file)
                        <div class="file-item">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="mb-1">
                                        <i class="fas fa-file-alt text-primary"></i>
                                        {{ basename($file->nama_file) }}
                                    </h6>
                                    @if($file->keterangan_file)
                                        <small class="text-muted">{{ $file->keterangan_file }}</small>
                                    @endif
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i>
                                        Diupload: {{ $file->created_at->format('d/m/Y H:i') }}
                                    </small>
                                    @if($file->id_jenis_temuan)
                                        <br>
                                        <small class="text-info">
                                            <i class="fas fa-tag"></i>
                                            ID Jenis Temuan: {{ $file->id_jenis_temuan }}
                                        </small>
                                    @endif
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="{{ asset($file->nama_file) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ asset($file->nama_file) }}"
                                       download
                                       class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                            <h6 class="text-muted mt-2">Belum ada file yang diupload</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Update Status Form -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit"></i>
                        Update Status
                    </h5>
                </div>
                <div class="card-body">
                    <div class="update-status-form">
                        <form id="updateStatusForm">
                            @csrf
                            <div class="mb-3">
                                <label for="status_LHP" class="form-label fw-bold">Status Baru *</label>
                                <select class="form-select" id="status_LHP" name="status_LHP" required>
                                    <option value="">-- Pilih Status --</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="alasan_verifikasi" class="form-label fw-bold">Alasan Verifikasi *</label>
                                <textarea class="form-control"
                                          id="alasan_verifikasi"
                                          name="alasan_verifikasi"
                                          rows="4"
                                          placeholder="Masukkan alasan perubahan status..."
                                          maxlength="1000"
                                          required></textarea>
                                <div class="form-text">Maksimal 1000 karakter</div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Pastikan alasan yang diberikan jelas dan dapat dipertanggungjawabkan
                                </small>
                            </div>

                            <button type="submit" class="btn btn-update w-100">
                                <i class="fas fa-save"></i> Update Status
                            </button>
                        </form>
                    </div>

                    <!-- Status Flow Info -->
                    <div class="mt-4">
                        <h6 class="fw-bold">
                            <i class="fas fa-route"></i>
                            Alur Status:
                        </h6>
                        <div class="small">
                            <div class="d-flex align-items-center mb-2">
                                <span class="status-badge status-belum-jadi me-2">Belum Jadi</span>
                                <i class="fas fa-arrow-right text-muted me-2"></i>
                                <span class="status-badge status-di-proses">Di Proses</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="status-badge status-di-proses me-2">Di Proses</span>
                                <i class="fas fa-arrow-right text-muted me-2"></i>
                                <span class="status-badge status-diterima me-1">Diterima</span>
                                <span class="text-muted">/</span>
                                <span class="status-badge status-ditolak ms-1">Ditolak</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle"></i> Berhasil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="successMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-circle"></i> Error
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Load status options
        loadStatusOptions();

        // Handle form submission
        $('#updateStatusForm').on('submit', function(e) {
            e.preventDefault();
            updateStatus();
        });

        // Character count for textarea
        $('#alasan_verifikasi').on('input', function() {
            const current = $(this).val().length;
            const max = 1000;
            const remaining = max - current;
            $(this).siblings('.form-text').text(`${current}/1000 karakter (${remaining} tersisa)`);
        });
    });

    function loadStatusOptions() {
        $.get('{{ route("adminTL.verifikasi.statusOptions", [$pageType ?? "rekomendasi", $pengawasan->id]) }}')
        .done(function(response) {
            if (response.success) {
                const select = $('#status_LHP');
                select.empty().append('<option value="">-- Pilih Status --</option>');

                response.options.forEach(function(option) {
                    select.append(`<option value="${option.value}">${option.label}</option>`);
                });
            }
        })
        .fail(function() {
            showError('Gagal memuat opsi status');
        });
    }

    function updateStatus() {
        const formData = {
            status_LHP: $('#status_LHP').val(),
            alasan_verifikasi: $('#alasan_verifikasi').val(),
            _token: $('input[name="_token"]').val()
        };

        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        $('#loadingOverlay').show();

        $.post('{{ route("adminTL.verifikasi.updateStatus", [$pageType ?? "rekomendasi", $pengawasan->id]) }}', formData)
        .done(function(response) {
            if (response.success) {
                showSuccess(response.message);
                // Refresh page after 2 seconds
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            } else {
                showError(response.message || 'Gagal mengupdate status');
            }
        })
        .fail(function(xhr) {
            if (xhr.status === 422) {
                // Validation errors
                const errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(function(field) {
                    const input = $(`[name="${field}"]`);
                    input.addClass('is-invalid');
                    input.siblings('.invalid-feedback').text(errors[field][0]);
                });
            } else {
                showError(xhr.responseJSON?.message || 'Terjadi kesalahan sistem');
            }
        })
        .always(function() {
            $('#loadingOverlay').hide();
        });
    }

    function showSuccess(message) {
        $('#successMessage').text(message);
        $('#successModal').modal('show');
    }

    function showError(message) {
        $('#errorMessage').text(message);
        $('#errorModal').modal('show');
    }
</script>
@endsection
