@extends('admin.layouts.main')
@section('styles')
<style>
    div.card-dashboard-item {
        padding: 0px;
        background-color: white;
        border-radius: 6px;
        transition: 0.3s;
        overflow: hidden;
        border: none;
        text-decoration: none;
        color: black;
        background-image: linear-gradient(to bottom, #ffffff, #ffffff, #ffffff, #ffffff, #ffffff,
                #ffffff, #ffffff, #ffffff, #ffffff, #ffffff, #e4e4e4);
    }

    div.card-dashboard-item p {
        margin: 0;
    }

    div.card-dashboard-item:hover {
        transform: translateY(-4px);
        background-image: linear-gradient(to bottom, #ffffff, #ffffff, #ffffff, #ffffff, #ffffff,
                #ffffff, #ffffff, #ffffff, #ffffff, #ffffff, #e8e8e8);
        /* box-shadow: rgba(255, 234, 8, 0.15) 0px 15px 25px, rgba(255, 247, 0, 0.05) 0px 5px 10px; */
    }

    .img-container-item {
        position: relative;
    }

    .img-container-item a {
        position: absolute;
        right: 0;
        color: grey;
    }

    .img-container-item a:hover {
        color: red;
    }

    a.edit-stok-tersedia {
        background-color: #0e6efd;
        border-radius: 0px 0px 0px 10px;
        text-decoration: none;
        padding: 0px 4px;
        color: white;
        transition: 0.3s;
    }

    a.edit-stok-tersedia:hover {
        background-color: white;
        color: blue;
    }

    .btn-outline-primary {
        border-radius: 2px;
    }
</style>
@endsection

@section('container')
<div class="row">
    <div class="col-sm-12 mb-4 mb-xl-0">
        <div class="d-flex bd-highlight mb-3 ">
            <div class="me-auto p-2 bd-highlight">
                <h3 class="text-dark font-weight-bold mb-2">Menu </h3>
                <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6>
            </div>
            <div class="p-2 bd-highlight">
                <input type="text" class="form-control" placeholder="cari menu ...  ">
            </div>
            <div class="p-2 bd-highlight">
                <a href="item/create" class="btn btn-primary">Tambah Menu</a>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <?php
    $i = 1;
    ?>
    @foreach ($all_menu as $menu)
    <div class="card card-dashboard-item m-3" style="width :14rem;">
        <div class="img-container-item">
            <a href="/admin/item/{{ $menu->id }}/{{ $menu->status }}/update" data-id="{{ $menu->id }}" class="edit-stok-tersedia confirm-status">
                {{ $menu->status }} </a>
            {{-- <img src="{{ asset('assets/Foto Deluna/' . $i++ . '.jpeg') }}" alt="..." width="100%" height="200px"> --}}
            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="..." width="100%" height="100%">
        </div>
        <div class="card-body p-2">
            <div class="d-flex bd-highlight  ">
                <div class="me-auto bd-highlight">
                    <h5 class="card-title p-0 m-0">{{ $menu->nama }}</h5>
                    <p class="text-danger">Rp.{{ $menu->harga }}</p>
                </div>
                <div class="bd-highlight text-end ">
                    <p class="text-muted p-0 m-0">{{ $menu->kategori }}</p>
                    {{-- <p class="text-success"></p> --}}
                    <a href="/admin/item/{{ $menu->id }}/edit " class="btn btn-sm btn-outline-primary" style="padding:0px 2px">edit</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

{{-- @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9']) --}}
@include('sweetalert::alert')
@section('script')
<script>
    const btnStatus = document.getElementsByClassName('confirm-status');

    for (let i = 0; i <= btnStatus.length - 1; i++) {
        if (btnStatus[i].innerText == 'habis') {
            btnStatus[i].style.backgroundColor = "red";
        }
        btnStatus[i].addEventListener('click', function(e) {
            e.preventDefault()
            fetch('/admin/item/' + btnStatus[i].getAttribute('data-id'))
                .then(response => response.json())
                .then(res => {
                    Swal.fire({
                        title: 'ubah sekarang?',
                        // text: "ubah ketersediaan stok sekarang?" + res.nama,
                        text: res.status == 'tersedia' ? `apakah menu (${res.nama} - ${res.kategori}) sudah habis?` : `apakah menu (${res.nama} - ${res.kategori}) sudah terseida lagi?`,
                        imageUrl: '/assets/images/sea_coff-logo.jpeg',
                        imageHeight: 80,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: res.status == 'tersedia' ? 'Ya, sudah habis!' : 'Ya, sudah tersedia!',
                        cancelButtonText: 'batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(btnStatus[i].href)
                                .then(response => response.json())
                                .then(err => console.log(err))
                            window.location.href = '/admin/item'
                        }
                    })
                })
                .catch(err => console.log(err))


        })
    }
</script>
@endsection