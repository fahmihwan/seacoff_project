@extends('admin.layouts.main')

@section('container')
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Dashboard </h3>
                    <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="card float-start" style="width:500px;">
            <div class="card-body">
                <h4 class="card-title">Basic form elements</h4>
                <p class="card-description">
                    Basic form elements
                </p>
                <form action="/admin/item" class="forms-sample" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="menu">Menu Baru</label>
                        <input type="text" class="form-control" id="menu" name="nama" autocomplete="off"
                            placeholder="menu baru">
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option selected>Pilih kategori menu</option>
                            <option value="hot">hot</option>
                            <option value="ice">ice</option>
                            <option value="snack">snack</option>
                            <option value="food">food</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" placeholder="Harga" name="harga"
                            autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <label>upload foto</label>
                        <div class="input-group col-xs-12">
                            <input type="file" class="form-control file-upload-info" onChange="previewImage()"
                                placeholder="Upload Image" id="image" name="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="/admin/item" class="btn btn-warning ">Kembali</a>
                </form>
            </div>
        </div>
        <div class="box-img card float-end ms-sm-0 ms-md-3 mt-sm-3 mt-md-3 mt-lg-0 " style="width:500px">
            <div class="card-body ">
                <div style="border: 5px solid rgb(221, 221, 221); border-style: dashed; padding:5px">
                    <img src="" class="img-preview img-fluid" width="400px" height="400px">
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        const boxImg = document.getElementsByClassName('box-img')[0]



        function previewImage() {

            imgPreview.style.display = 'block'

            const dataUrl = URL.createObjectURL(image.files[0]); //<-- cara gampang preview IMG
            imgPreview.src = dataUrl
        }
    </script>
@endsection
