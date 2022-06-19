@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-sm-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h6 class="text-dark font-weight-bold p-0 m-0">Edit Menu </h6>
                    <p class="text-muted"> Last login was 23 hours ago. </p>
                </div>
                <div class="p-2 bd-highlight">

                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center " style="margin-bottom: 40px">
        <div class="card float-start" style="width:500px;">
            <div class="card-body">
                <h4 class="card-title">Basic form elements</h4>
                <p class="card-description">
                    Basic form elements
                </p>
                <form action="/admin/item/{{ $menu[0]->id }}" class="forms-sample" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group mb-2">
                        <label for="menu">Menu Baru</label>
                        <input type="text" class="form-control" id="menu" name="nama" autocomplete="off"
                            placeholder="Name" value="{{ old('nama', $menu[0]->nama) }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option value="hot" {{ $menu[0]->kategori == 'hot' ? 'selected' : '' }}>hot</option>
                            <option value="ice" {{ $menu[0]->kategori == 'ice' ? 'selected' : '' }}>ice</option>
                            <option value="snack" {{ $menu[0]->kategori == 'snack' ? 'selected' : '' }}>snack</option>
                            <option value="food" {{ $menu[0]->kategori == 'food' ? 'selected' : '' }}>food</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" placeholder="Name" name="harga"
                            autocomplete="off" value="{{ $menu[0]->harga }}">
                    </div>
                    <div class="form-group mb-2">
                        <label>upload foto</label>
                        <div class="input-group col-xs-12">
                            <input type="file" class="form-control file-upload-info" onChange="previewImage()"
                                placeholder="Upload Image" id="image" name="gambar" value="{{ $menu[0]->gambar }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="/admin/item" class="btn btn-warning ">Kembali</a>
                </form>
            </div>
        </div>
        <div class="card float-end ms-sm-0 ms-md-3 mt-sm-3 mt-md-3 mt-lg-0  " style="width:500px">
            <div class="card-body ">
                <div style="border: 5px solid rgb(221, 221, 221); border-style: dashed; padding:5px">
                    @if ($menu[0]->gambar)
                        <img src="{{ asset('storage/' . $menu[0]->gambar) }}" class="img-preview img-fluid" width="400px"
                            height="400px">
                    @else
                        <img src="" class="img-preview img-fluid">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row float-end py-2">
        <form action="/admin/item/{{ $menu[0]->id }}" method="post" id="submit-form" hidden>
            @method('delete')
            @csrf
        </form>
        <p class="me-5 pb-5"> Tekan <a href="/admin" id='delete-item'>Hapus</a>, jika ingin menghapus menu
            <b>{{ $menu[0]->nama }} -
                {{ $menu[0]->kategori }}</b> ?
        </p>
    </div>
@endsection

@section('script')
    <script>
        function previewImage() {

            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            console.log(image)
            imgPreview.style.display = 'block'

            const dataUrl = URL.createObjectURL(image.files[0]); //<-- cara gampang preview IMG
            imgPreview.src = dataUrl

        }

        const btnDelete = document.getElementById('delete-item');

        btnDelete.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('submit-form').submit()

                }
            })
        })
    </script>
@endsection
