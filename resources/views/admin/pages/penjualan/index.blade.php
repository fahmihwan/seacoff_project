@extends('admin.layouts.main')

@section('styles')
<style>
    div.card-dashboard-item {
        padding: 0px;
        background-color: white;
        border-radius: 4px;
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

    .img-container-item span {
        position: absolute;
        right: 0;
        color: grey;
    }

    .img-container-item span:hover {
        color: red;
    }

    span.edit-stok-tersedia {
        background-color: #0e6efd;
        border-radius: 0px 0px 0px 3px;
        text-decoration: none;
        padding: 0px 4px;
        color: white;
        transition: 0.3s;
        background-color: #da291c;
        width: 50px;
        height: 20px;
    }

    span.edit-stok-tersedia:hover {
        background-color: white;
        color: blue;
    }

    .btn-outline-primary {
        border-radius: 2px;
    }

    .cart-menu {
        position: fixed;
        top: 130px;
        /* top: 85px; */

        right: 20px;
        background-color: white;
        height: 78vh;
        /* height: 85vh; */
        transition: 0.4s;

    }

    ul.list-cart-menu {
        overflow: scroll;
    }

    ul.list-cart-menu li {
        list-style-type: none;
        background-color: #fff5de;
        border-radius: 5px;
        margin-bottom: 10px;
        padding: 0 5px 0 5px;
    }

    ul.list-cart-price li {
        list-style-type: none;
        margin-bottom: 10px;
        padding: 0 5px 0 5px;
    }
</style>
@endsection


@section('container')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex bd-highlight  ">
            <div class="me-auto  bd-highlight">
                <h3 class="text-dark font-weight-bold mb-2">Penjualan </h3>
                <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6>
            </div>
        </div>
        <div class="d-flex flex-wrap">
            @foreach ($all_menu as $menu)
            <div class="card card-dashboard-item m-3" style="width :10.8rem; ">
                <div class="img-container-item ">
                    <span data-id="{{ $menu->id }}" class="edit-stok-tersedia confirm-status">
                        Add
                    </span>

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
                            <p class=" p-0 m-0 text-success">{{ $menu->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach ($all_menu as $menu)
            <div class="card card-dashboard-item m-3" style="width :10.8rem; ">
                <div class="img-container-item ">
                    <span data-id="{{ $menu->id }}" class="edit-stok-tersedia confirm-status">
                        Add
                    </span>

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
                            <p class=" p-0 m-0 text-success">{{ $menu->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <div class="col-md-4 cart-menu card">
        <h3 class="text-center py-3">Cart Menu</h3>

        <ul class="list-cart-menu ps-0" style="height: 300px;">
            <!-- <li>americano <span class="float-end"><input type="number" value="1"></span></li> -->
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>
            <li>americano <span class="float-end">12</span></li>

        </ul>

        <ul class="list-cart-price  ps-0 m-0">
            <hr>
            <li>Dasar Pengenaan Pajak <span class="float-end">Rp.0</span></li>
            <li>PPN(10%) <span class="float-end">Rp.0</span></li>
            <li>Total <span class="float-end">Rp.0</span></li>
        </ul>
        <div class="d-flex align-items-end mb-4 " style="height:55px">
            <button class="btn btn-primary" type="button" style="width: 100%">simpan</button>
        </div>




    </div>

</div>


@endsection

@section('script')
<script>
    const btnStatus = document.getElementsByClassName('confirm-status');
    const cartMenu = document.getElementsByClassName('cart-menu')[0];

    for (let i = 0; i <= btnStatus.length - 1; i++) {
        if (btnStatus[i].innerText == 'habis') {
            btnStatus[i].style.backgroundColor = "red";
        }
    }

    window.addEventListener('scroll', function() {
        const currentScroll = window.scrollY //74
        if (currentScroll >= 75) {
            // console.log(cartMenu)

            cartMenu.style.top = "85px"
            cartMenu.style.height = "85vh"
        } else {
            cartMenu.style.top = "130px"
            cartMenu.style.height = "78vh"
        }
        console.log(cartMenu.style.top)

    })
</script>


@endsection