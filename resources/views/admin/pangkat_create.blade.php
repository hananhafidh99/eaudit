@extends('template')
@section('content')
<div class="alert alert-info" role="alert">
    Tambah Data Pangkat
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/pangkat') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Nama Pangkat </label>
                    <input type="text" name="nama_pangkat" class="form-control" >
                </div>
            </div>
            <button class="btn btn-primary onclhiden"  >Tambah Pangkat</button>

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
        <script>
            document.querySelectorAll(".onclhiden").forEach(element => {
                element.addEventListener("click", function() {
                    this.style.display = "none";
                });
            });
          </script>
@endsection

