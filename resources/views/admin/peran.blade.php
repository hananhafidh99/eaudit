@extends('template')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <h5>Daftar Peran
        <div class="d-flex justify-content-end"><a href="{{ url('Peran_baru') }}" class="btn btn-success">Tambah Peran</a>
        </div>
    </h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peran</th>
                    <th>Tarif per hari</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $no = 1; ?>
                @foreach ($data as $index => $v)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $v['nama_peran'] }}</td>
                        <td>{{ number_format($v['tarif']) }}</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-4 mb-2">
                                    <a href="{{ url('peran/' . $v['id'] . '/edit') }}"
                                        class="btn btn-outline-primary btn-sm">Edit</a>
                                </div>
                                <div class="col-sm-4 ">
                                    <form action="{{ url('peran/' . $v['id'] . '/hapus') }}" method="POST"
                                        class="d-inline mb-3">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        $(document).ready(function() {
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
