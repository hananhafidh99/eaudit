@extends('template')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-bookmark-outline"></i>
            </span>
            Menu A2
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
                <div class="card-body text-center">
                    <div class="py-5">
                        <i class="mdi mdi-construction mdi-72px text-muted mb-4"></i>
                        <h3 class="text-muted">Menu A2 - Coming Soon</h3>
                        <p class="lead text-muted">Menu ini sedang dalam tahap pengembangan.</p>
                        <p class="text-muted">Fitur akan segera tersedia untuk memberikan akses tambahan sesuai kebutuhan Anda.</p>

                        <div class="mt-4">
                            <a href="{{ route('opdTL.dashboard') }}" class="btn btn-gradient-primary">
                                <i class="mdi mdi-arrow-left"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
