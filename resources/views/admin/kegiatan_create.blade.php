@extends('template')
@section('content')
    <div class="alert alert-info" role="alert">
        Tambah Data Kegiatan
    </div>
    <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ url('/kegiatan_baru') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="">Nomor Rekening </label>
                        <input type="text" name="norek" class="form-control">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="">PPTK </label>
                    <select id="jabatan" class="form-control" name="id_pptk">
                    <option value="" disabled selected>Select your option</option>
                         @foreach ($pegawai as $key => $pg)
                           <option value="{{ $pg['id'] }}">{{ $pg['nama_pegawai'] }}</option>
                        @endforeach
                </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="">Nama Kegiatan </label>
                        <textarea name="kegiatan" id="" class="form-control"></textarea>
                    </div>
                </div>

                <button class="btn btn-primary">Tambah Kegiatan</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $("#pptk").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
            });
            $("#jabatan").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
            });
            $("#eselon").select2({
                theme: 'bootstrap4',
                placeholder: "Please Select"
            });
            $("#tahun").select2({
                theme: 'bootstrap4'
            });
        });
    </script>

    <script>
        @if (session('warning'))
            $(document).ready(function() {
                $("#myModal").modal('show');
            });
        @endif
    </script>
@endsection
