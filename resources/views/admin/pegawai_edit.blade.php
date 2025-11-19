@extends('template')
@section('content')
<div class="alert alert-info" role="alert">
    Edit Data Pegawai
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
            <form action="{{ url('pegawai_baru/'.$pegawai['id']) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
               <div class="col-6 mb-3">
                    <label for="">Nama Pegawai </label>
                    <input type="text" name="nama_pegawai" class="form-control" value="{{ $pegawai['nama_pegawai'] }}" >
                </div>
                <div class="col-6 mb-3">
                    <label for="">Nip Pegawai  </label>
                    <input type="text" name="nip" class="form-control" value="{{ $pegawai['nip']}}" >
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Pangkat Pegawai  </label>
                         <select id="pangkat" class="form-control" name="id_pangkat">
                        <option value="" disabled selected>Select your option</option>
                         @foreach ($pangkat as $key => $p)
                            <option value="{{ $p['id'] }}" {{ $p['id']==$pegawai['id_pangkat']?'selected':''}}>
                          {{ $p['nama_pangkat'] }}
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-3">
                <label for="">Jabatan Pegawai  </label>
                 <select id="jabatan" class="form-control" name="id_jabatan">
                    <option value="" disabled selected>Select your option</option>
                        @foreach ($jabatan as $key => $jt)
                            <option value="{{ $jt['id'] }}" {{ $jt['id']==$pegawai['id_jabatan']?'selected':''}}>
                          {{ $jt['nama_jabatan'] }}
                        @endforeach
                </select>
            </div>

            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Eselon Pegawai  </label>
                    <select id="eselon" class="form-control" name="id_eselon">
                        <option value="" disabled selected>Select your option</option>
                        @foreach ($eselon as $key => $es)
                            <option value="{{ $es['id'] }}" {{ $es['id']==$pegawai['id_eselon']?'selected':''}}>
                          {{ $es['nama_eselon'] }}
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-3">
                <label for="">Rekening Pegawai  </label>
                <input type="text" name="rekening_pegawai" class="form-control" value="{{ $pegawai['rekening_pegawai'] }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Status Pegawai  </label>
                     <select id="status" class="form-control" name="status_pegawai">
                         <option>- Pilih Status Pegawai -</option>
                         <option value="Aktif" {{ $pegawai["status_pegawai"] == "Aktif" ? 'selected' : '' }}>AKTIF</option>
                         <option value="tidakAktif" {{ $pegawai["status_pegawai"] == "tidakAktif" ? 'selected' : '' }}>TIDAK AKTIF</option>
                    </select>
                </div>


            <button class="btn btn-primary">Edit Pegawai</button>
        </form>
    </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script>
            $(document).ready(function () {
                $("#pangkat").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#kendaraan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#jabatan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                 $("#status").select2({
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
@endsection

