@extends('template')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-file-document-box-multiple-outline"></i>
            </span>
            Menu A2 - Data Dukung Rekomendasi
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('opdTL.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menu A2</li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">
                            <i class="mdi mdi-file-document-box-outline text-primary me-2"></i>
                            Daftar Data Dukung Rekomendasi
                        </h4>
                        <span class="badge badge-info">{{ count($data ?? []) }} Data</span>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(count($data ?? []) > 0)
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Tanggal Disposisi</th>
                                        <th>Nomor Surat</th>
                                        <th>Jenis Pengawasan</th>
                                        <th>Obrik</th>
                                        <th>Tipe Rekomendasi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $v)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $v['tglkeluar'] ?? '-' }}</td>
                                            <td>{{ '700.1.1/' . ($v['noSurat'] ?? '-') . '/03' . '/' . date('Y') }}</td>
                                            <td>{{ $v['nama_jenispengawasan'] ?? '-' }}</td>
                                            <td>{{ $v['nama_obrik'] ?? '-' }}</td>
                                            <td>
                                                <span class="badge badge-{{ $v['tipe'] == 'Temuan' ? 'warning' : 'success' }}">
                                                    {{ $v['tipe'] ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('opdTL.menuA2.detail', $v['id']) }}"
                                                   class="btn btn-sm btn-info btn-rounded">
                                                    <i class="mdi mdi-eye"></i> Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="mdi mdi-information-outline mdi-72px text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak Ada Data</h4>
                            <p class="text-muted">
                                @if(auth()->check())
                                    Belum ada data dukung rekomendasi yang dapat Anda akses.
                                @else
                                    Silakan login untuk melihat data.
                                @endif
                            </p>
                            <a href="{{ route('opdTL.dashboard') }}" class="btn btn-gradient-primary">
                                <i class="mdi mdi-arrow-left"></i> Kembali ke Dashboard
                            </a>
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
    // Initialize DataTable for better user experience
    if ($('#dataTable').length && $('#dataTable tbody tr').length > 0) {
        $('#dataTable').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            order: [[1, 'desc']], // Sort by date column
            pageLength: 25,
            columnDefs: [
                { orderable: false, targets: [6] } // Disable sorting on action column
            ]
        });
    }
});
</script>
@endpush
@endsection
