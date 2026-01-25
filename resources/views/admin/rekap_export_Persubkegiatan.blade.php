@extends('template')
@section('content')
    <div class="alert alert-info" role="alert">
        Export Rekapitulasi Penilaian Perjalanan Dinas
    </div>
    <div class="row">
        <!-- Form Tahunan -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Form Export Tahunan
                </div>
                <div class="card-body mt-3">
                    <form action="{{ url('rekap_export/download') }}" method="post">
                        @csrf
                        <input type="hidden" name="type" value="yearly">
                        <div class="form-group mb-3">
                            <label for="tahun_yearly">Tahun</label>
                            <select name="tahun" id="tahun_yearly" class="form-control select2" required>
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2023; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun_yearly">Tahun</label>
                            <select name="tahun" id="tahun_yearly" class="form-control select2" required>
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2023; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-file-excel"></i> Export
                            Tahunan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form Bulanan -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    Form Export Bulanan
                </div>
                <div class="card-body mt-3">
                    <form action="{{ url('rekap_export/download') }}" method="post">
                        @csrf
                        <input type="hidden" name="type" value="monthly">
                        <div class="form-group mb-3">
                            <label for="tahun_monthly">Tahun</label>
                            <select name="tahun" id="tahun_monthly" class="form-control select2" required>
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2023; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="bulan_monthly">Bulan</label>
                            <select name="bulan" id="bulan_monthly" class="form-control select2" required>
                                <option value="">Pilih Bulan</option>
                                @php
                                    $months = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember'
                                    ];
                                @endphp
                                @foreach ($months as $num => $name)
                                    <option value="{{ $num }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun_yearly">Tahun</label>
                            <select name="tahun" id="tahun_yearly" class="form-control select2" required>
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2023; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-file-excel"></i> Export
                            Bulanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Option",
                allowClear: true,
                theme: 'bootstrap4',
                width: '100%'
            });
        });
    </script>

@endsection
