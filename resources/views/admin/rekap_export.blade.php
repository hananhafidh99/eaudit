@extends('template')
@section('content')
    <div class="alert alert-info" role="alert">
        Export Rekapitulasi Penilaian Perjalanan Dinas
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Form Export Excel
        </div>
        <div class="card-body">
            <form action="{{ url('rekap_export/download') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun_export" class="form-control" required>
                            <option value="">Pilih Tahun</option>
                            @for ($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" id="bulan_export" class="form-control" required>
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
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#tahun_export').select2({
                placeholder: "Pilih Tahun",
                allowClear: true,
                theme: 'bootstrap4'
            });
            $('#bulan_export').select2({
                placeholder: "Pilih Bulan",
                allowClear: true,
                theme: 'bootstrap4'
            });
        });
    </script>
@endsection