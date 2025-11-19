@extends('template')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Data Instansi</h5>
        </div>
        <div class="card-body">
            <form action="{{ url("skpd_edit") }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data['id'] }}">
            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Instansi</label>
                </div>
                <div class="col-md-8 mt-2">
                    <input type="text" class="form-control" name="instansi" id="basic-default-fullname" value="{{ $data['instansi'] }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">SKPD</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="skpd" id="basic-default-fullname"  value="{{ $data['skpd'] }}"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Alamat</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="alamat" id="basic-default-fullname"  value="{{ $data['alamat'] }}"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Telp/Fax</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="telp" id="basic-default-fullname"  value="{{ $data['telp'] }}"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Website</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="website" id="basic-default-fullname"  value="{{ $data['website'] }}"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email" id="basic-default-fullname"  value="{{ $data['email'] }}"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Kode Pos</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="kodepos" id="basic-default-fullname"  value="{{ $data['kodepos'] }}"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Logo</label>
                </div>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="logo" id="basic-default-fullname" />
                    @if (!empty($data['logo']))
                        <img src="{{ asset('storage/logo/'.$data['logo']) }}" class="mt-3" alt="Logo" style="width: 50px">
                    @else
                        <p class="mt-3">Logo belum tersedia</p>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Pemimpin</label>
                </div>
                <div class="col-md-8">
                      <select class="form-control"  name="id_pemimpin" id="pemimpin">
                         <option value="">Pilih</option>
                         @if (!empty($pegawai))
                            @foreach ($pegawai as $g)
                            @php
                            if ($g['id']==$data['id_pimpinan']) {
                                # code...
                                session(['id_pimpinan' => $g['id'], 'nama_pemimpin' => $g['nama_pegawai'], 'nip_pemimpin' => $g['nip'], 'pangkat_pemimpin' => $g['pangkat']['nama_pangkat'] ]);
                            }
                            @endphp
                                <option value="{{ $g['id'] }}" {{ $g['id']==$data['id_pimpinan']?'selected':''}}>
                                    {{ $g['nama_pegawai'] }}
                                </option>
                            @endforeach
                        @else
                            <option value="">Data pegawai tidak tersedia</option>
                        @endif
                     </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Bendahara</label>
                </div>
                <div class="col-md-8">
                     <select class="form-control"  name="id_bendahara" id="bendahara">
                        <option value="">Pilih</option>
                         @if (!empty($pegawai))
                            @foreach ($pegawai as $v)
                             @php
                            if ($v['id']==$data['id_bendahara']) {
                                # code...
                                session(['id_bendahara' => $v['id'], 'nama_bendahara' => $v['nama_pegawai'] ]);
                                session(['id_bendahara' => $g['id'], 'nama_bendahara' => $g['nama_pegawai'], 'nip_bendahara' => $g['nip'] ]);
                            }
                            @endphp
                                <option value="{{ $v['id'] }}" {{ $v['id']==$data['id_bendahara']?'selected':''}}>
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
    </div>
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Nomor Surat</h5>
        </div>
        <div class="card-body">
          <form action="{{ url("skpd_edit") }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mt-3">
                    <label class="form-label" for="basic-default-fullname">Nomor Surat Dalam Daerah</label>
                </div>
                <div class="col-md-6 mt-3">
                    <input type="text" class="form-control" name="nomordalam"  id="basic-default-fullname" value="{{ $data['nomorsurat'] }}" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Ubah Data</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script>
            $(document).ready(function () {
                $("#kota").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });

                $("#pemimpin").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });

                 $("#bendahara").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
            });

        </script>

       <script>

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}")
        @endif
  </script>

  <script>
            $(document).ready(function () {
                $("#obrik").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Obrik"
                });
                $("#jenis_pengawasan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Jenis Pengawasan"
                });
                $("#bulan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
                $("#tahun23").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
                   $("#tahun").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Anggaran Kegiatan"
                });
            });
        </script>
@endsection

