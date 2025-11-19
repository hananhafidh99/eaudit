@extends('template')
@section('content')
<div class="alert alert-info" role="alert">
    Tambah Data Pegawai
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/pegawai_baru') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Nama Pegawai </label>
                    <input type="text" name="nama_pegawai" class="form-control" >
                </div>
                <div class="col-6 mb-3">
                    <label for="">Nip Pegawai  </label>
                    <input type="text" name="nip" class="form-control" >
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Pangkat Pegawai  </label>
                    <select id="pangkat" class="form-control" name="id_pangkat">
                        <option value="" disabled selected>Select your option</option>
                         @foreach ($data as $key => $p)
                           <option value="{{ $p['id'] }}">{{ $p['nama_pangkat'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-3">
                <label for="">Jabatan Pegawai  </label>
                 <select id="jabatan" class="form-control" name="id_jabatan">
                    <option value="" disabled selected>Select your option</option>
                         @foreach ($jabatan as $key => $j)
                           <option value="{{ $j['id'] }}">{{ $j['nama_jabatan'] }}</option>
                        @endforeach
                </select>
            </div>
            </div>

            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Eselon Pegawai  </label>
                    <select id="eselon" class="form-control" name="id_eselon">
                        <option value="" disabled selected>Select your option</option>
                         @foreach ($eselon as $key => $e)
                           <option value="{{ $e['id'] }}">{{ $e['nama_eselon'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="">Rekening Pegawai  </label>
                    <input type="text" name="rekening_pegawai" class="form-control" >
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Status Pegawai  </label>
                         <select id="status" class="form-control" name="status_pegawai">
                             <option>- Pilih Status Pegawai -</option>
                             <option value="Aktif">AKTIF</option>
                             <option value="tidakAktif">TIDAK AKTIF</option>
                        </select>
                    </div>
                </div>
            <button class="btn btn-primary">Tambah Pegawai</button>

        </form>
    </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script>
    $(document).ready(function() {
        $("#pangkat").select2({
            theme: 'bootstrap4',
            placeholder: "-Pangkat Pegawai-"
        });
        $("#kendaraan").select2({
            theme: 'bootstrap4',
            placeholder: " - Kendaraan Pegawai - "
        });
        $("#jabatan").select2({
            theme: 'bootstrap4',
            placeholder: "-Jabatan Pegawai-"
        });
        $("#status").select2({
            theme: 'bootstrap4',
            placeholder: "-Status Pegawai-"
        });
        $("#eselon").select2({
            theme: 'bootstrap4',
            placeholder: "-Eselon Pegawai-"
        });
        $("#tahun").select2({
            theme: 'bootstrap4'
        });
    });
</script>
@endsection

