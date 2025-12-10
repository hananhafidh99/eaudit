@extends('template')
@section('content')
    <div class="alert alert-info" role="alert">
        Edit SKPD
    </div>
    <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ url('skpd_edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="">Instansi</label>
                        <input type="text" class="form-control" name="instansi" id="basic-default-fullname"
                            value="{{ $data['instansi'] }}" />
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">SKPD </label>
                        <input type="text" class="form-control" name="skpd" id="basic-default-fullname"
                            value="{{ $data['skpd'] }}" />
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Alamat </label>
                        <input type="text" class="form-control" name="alamat" id="basic-default-fullname"
                            value="{{ $data['alamat'] }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="">Telp/Fax </label>
                        <input type="text" class="form-control" name="telp" id="basic-default-fullname"
                            value="{{ $data['telp'] }}" />
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Website</label>
                        <input type="text" class="form-control" name="website" id="basic-default-fullname"
                            value="{{ $data['website'] }}" />
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" id="basic-default-fullname"
                            value="{{ $data['email'] }}" />
                    </div>

                </div>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="">Kode Pos </label>
                        <input type="text" class="form-control" name="kodepos" id="basic-default-fullname"
                            value="{{ $data['kodepos'] }}" />
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Logo</label>
                        <input type="file" class="form-control" name="logo" id="basic-default-fullname" />
                        @if (!empty($data['logo']))
                            <img src="{{ 'http://127.0.0.1:8000/storage/logo/' . $data['logo'] }}" class="mt-3" alt="Logo"
                                style="width: 50px">
                        @else
                            <p class="mt-3">Logo belum tersedia</p>
                        @endif
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Nomor Surat Dalam Daerah </label>
                        <input type="text" class="form-control" name="nomorsurat" id="basic-default-fullname"
                            value="{{ $data['nomorsurat'] }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="">Pimpinan</label>
                        <select class="form-control" name="id_pimpinan" id="pemimpin">
                            <option value="">Pilih</option>
                            @if (!empty($pegawai))
                                @foreach ($pegawai as $g)
                                    @php
                                        if ($g['id'] == $data['id_pimpinan']) {
                                            # code...
                                            session(['id_pimpinan' => $g['id'], 'nama_pemimpin' => $g['nama_pegawai'], 'nip_pemimpin' => $g['nip'], 'pangkat_pemimpin' => $g['pangkat']['nama_pangkat']]);
                                        }
                                    @endphp
                                    <option value="{{ $g['id'] }}" {{ $g['id'] == $data['id_pimpinan'] ? 'selected' : ''}}>
                                        {{ $g['nama_pegawai'] }}
                                    </option>
                                @endforeach
                            @else
                                <option value="">Data pegawai tidak tersedia</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="">Bendahara</label>
                        <select class="form-control" name="id_bendahara" id="bendahara">
                            <option value="">Pilih</option>
                            @if (!empty($pegawai))
                                @foreach ($pegawai as $v)
                                    @php
                                        if ($v['id'] == $data['id_bendahara']) {
                                            # code...
                                            session(['id_bendahara' => $v['id'], 'nama_bendahara' => $v['nama_pegawai'], 'nip_bendahara' => $v['nip'], 'pangkat_bendahara' => $v['pangkat']['nama_pangkat']]);
                                        }
                                    @endphp
                                    <option value="{{ $v['id'] }}" {{ $v['id'] == $data['id_bendahara'] ? 'selected' : ''}}>
                                        {{ $v['nama_pegawai'] }}
                                    </option>
                                @endforeach
                            @else
                                <option value="">Data pegawai tidak tersedia</option>
                            @endif
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Nomor Surat</h5>
            </div>
            <div class="card-body">
                <form action="{{ url("skpd_edit") }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    <div class="row mb-3">
                        <div class="col-md-6 mt-3">
                            <label class="form-label" for="basic-default-fullname">Nomor Surat Dalam Daerah</label>
                        </div>
                        <div class="col-md-6 mt-3">
                            <input type="text" class="form-control" name="nomorsurat" id="basic-default-fullname"
                                value="{{ $data['nomorsurat'] }}" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Ubah Data</button>

                </form>
            </div>
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