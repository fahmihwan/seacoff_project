@extends('layout.main')
@section('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* width: 18rem; */

        .bg-color-seacoffe {
            /* background-color: #7c4644; */
            background: linear-gradient(to right, #7c4644 0%, hsl(0, 14%, 70%) 100%);
        }

        .btn:focus {
            outline: none;
            box-shadow: none;
        }

        .sticky-category {
            height: 40px;
            background-color: rgb(243, 243, 243);
            position: sticky;
            position: -webkit-sticky;
            top: 0px;
            z-index: 3;
        }


        nav.navbar-category-css a {
            /* border: 1px solid red; */
            text-decoration: none;
            width: 200px;
            text-align: center;
            color: black;
        }

        nav.navbar-category-css a.nav-active {
            color: #dc3545;
            border-bottom: 2px solid #dc3545;
        }

        .marque-group {
            position: absolute;
            background-color: rgb(244, 81, 81);
            width: 100%;
            color: white
        }



        /* responsive */
        /* When the browser is at least 600px and above */
        @media screen and (max-width: 576px) {
            .cards-menus {
                margin-bottom: 10px;
            }

        }

        @media screen and (min-width: 768px) {
            .cards-menus {
                max-width: 350px;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection

@section('container')
    <div class="row bg-light d-flex">
        <a href="/home/my-order" class="d-inline w-25">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h5 class="ms-5 w-auto ">seacoffe</h5>
    </div>
    <div class="row sticky-category ">
        <nav id="navbar-category" class="navbar-category-css p-2 d-flex justify-content-around">
            <a href="#sec-kategori-hot" class="nav-active">Hot</a>
            <a href="#sec-kategori-ice" class="">Ice</a>
            <a href="#sec-kategori-snack" class="">Snack</a>
            <a href="#sec-kategori-food" class="">Food</a>
        </nav>
    </div>


    {{-- SECTION HOT --}}

    <section id="sec-kategori-hot" class="p-0 ">
        <div class="row mt-2 ">
            <div class="col-md-12 clearfix " style="background-color: white">
                <h5 class="float-start ms-2 my-2">{{ $meja }}</h5>
                <span class="text-muted float-end me-2 my-2" style="font-size: 10px">
                    <p>Selamat Memesan</p>
                </span>
            </div>
        </div>
        <h3 class="mt-2" class="text-muted"> Hot</h3>
        <div class="d-flex flex-wrap ">
            @foreach ($menus as $menu)
                @if ($menu->kategori == 'hot')
                    <div class="card cards-menus  ps-2 me-md-2 mb-2">
                        <input type="hidden" value="{{ $menu->id }}" class="cards-menu-id">
                        <div class="row g-0">
                            <div class="col-4 col-sm-4 col-md-4 py-2 ">
                                <img src="{{ asset('storage/' . $menu->gambar) }}" class="rounded menu-gambar"
                                    alt="{{ $menu->nama }}" width="100%" height="100%">
                            </div>
                            <div class="col-8 col-sm-8 col-md-8">
                                <div class="menuItems card-body">
                                    <h5 class="card-title menu-nama pb-2 m-0">{{ $menu->nama }} </h5>
                                    <span class="text-muted category-menu">{{ $menu->kategori }}</span>
                                    <div class="d-flex bd-highlight ">
                                        <div class="bd-highlight ">
                                            <p class="priceElementItems card-text pt-3 text-danger fw-bold"
                                                style="font-size: 12px">
                                                Rp. {{ $menu->harga }}
                                            </p>
                                        </div>
                                        <div class="ms-auto pt-2 bd-highlight js-order-group">
                                            <button class="js-btn-orders btn btn-sm btn-warning"> order </button>
                                            <div class="js-btn-group-input input-group input-group-sm input-group-md"
                                                style="width:95px; display:none">
                                                <button class="btn js-btn-arrow-spinner-min btn-warning btn-outline-none"
                                                    type="button" id="button-addon1">-</button>
                                                <input type="number" class="js-input-spinner-number form-control" min="0"
                                                    max="100" value="0" disabled>
                                                <button class="btn js-btn-arrow-spinner-plus btn-warning " type="button"
                                                    id="button-addon1">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- SECTION ICE --}}
    <section id="sec-kategori-ice" class="p-0 ">
        <h3 class="mt-5"> Ice</h3>
        <div class=" d-flex flex-wrap ">
            @foreach ($menus as $menu)
                @if ($menu->kategori == 'ice')
                    <div class="card cards-menus border ps-2 me-md-2 mb-2">
                        <input type="hidden" value="{{ $menu->id }}" class="cards-menu-id">
                        <div class="row g-0">
                            <div class="col-4 col-sm-4 col-md-4 py-2 ">
                                <img src="{{ asset('storage/' . $menu->gambar) }}" class="rounded menu-gambar"
                                    alt="{{ $menu->nama }}" width="100%" height="100%">
                            </div>
                            <div class="col-8 col-sm-8 col-md-8">
                                <div class="menuItems card-body">
                                    <h5 class="card-title menu-nama pb-2 m-0">{{ $menu->nama }} </h5>
                                    <span class="text-muted category-menu">{{ $menu->kategori }}</span>
                                    <div class="d-flex bd-highlight ">
                                        <div class="bd-highlight ">
                                            <p class="priceElementItems card-text pt-3 text-danger fw-bold"
                                                style="font-size: 12px">
                                                Rp. {{ $menu->harga }}
                                            </p>
                                        </div>
                                        <div class="ms-auto pt-2 bd-highlight js-order-group">
                                            <button class="js-btn-orders btn btn-sm btn-warning"> order </button>
                                            <div class="js-btn-group-input input-group input-group-sm input-group-md"
                                                style="width:95px; display:none">
                                                <button class="btn js-btn-arrow-spinner-min btn-warning btn-outline-none"
                                                    type="button" id="button-addon1">-</button>
                                                <input type="number" class="js-input-spinner-number form-control" min="0"
                                                    max="100" value="0" disabled>
                                                <button class="btn js-btn-arrow-spinner-plus btn-warning " type="button"
                                                    id="button-addon1">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    {{-- SECTION SNACK --}}
    <section id="sec-kategori-snack" class="p-0 ">
        <h3 class="mt-5"> Snack</h3>
        <div class="d-flex flex-wrap ">
            @foreach ($menus as $menu)
                @if ($menu->kategori == 'snack')
                    <div class="card cards-menus border ps-2 me-md-2 mb-2">
                        <input type="hidden" value="{{ $menu->id }}" class="cards-menu-id">
                        <div class="row g-0">
                            <div class="col-4 col-sm-4 col-md-4 py-2 ">
                                <img src="{{ asset('storage/' . $menu->gambar) }}" class="rounded menu-gambar"
                                    alt="{{ $menu->nama }}" width="100%" height="100%">
                            </div>
                            <div class="col-8 col-sm-8 col-md-8">
                                <div class="menuItems card-body">
                                    <h5 class="card-title menu-nama pb-2 m-0">{{ $menu->nama }} </h5>
                                    <span class="text-muted category-menu">{{ $menu->kategori }}</span>
                                    <div class="d-flex bd-highlight ">
                                        <div class="bd-highlight ">
                                            <p class="priceElementItems card-text pt-3 text-danger fw-bold"
                                                style="font-size: 12px">
                                                Rp. {{ $menu->harga }}
                                            </p>
                                        </div>
                                        <div class="ms-auto pt-2 bd-highlight js-order-group">
                                            <button class="js-btn-orders btn btn-sm btn-warning"> order </button>
                                            <div class="js-btn-group-input input-group input-group-sm input-group-md"
                                                style="width:95px; display:none">
                                                <button class="btn js-btn-arrow-spinner-min btn-warning btn-outline-none"
                                                    type="button" id="button-addon1">-</button>
                                                <input type="number" class="js-input-spinner-number form-control" min="0"
                                                    max="100" value="0" disabled>
                                                <button class="btn js-btn-arrow-spinner-plus btn-warning " type="button"
                                                    id="button-addon1">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- SECTION FOOD --}}
    <section id="sec-kategori-food" class="p-0 ">
        <h3 class="mt-5"> Food</h3>
        <div class="d-flex flex-wrap ">
            @foreach ($menus as $menu)
                @if ($menu->kategori == 'food')
                    <div class="card cards-menus border ps-2 me-md-2 mb-2">
                        <input type="hidden" value="{{ $menu->id }}" class="cards-menu-id">
                        <div class="row g-0">
                            <div class="col-4 col-sm-4 col-md-4 py-2 ">
                                <img src="{{ asset('storage/' . $menu->gambar) }}" class="rounded menu-gambar"
                                    alt="{{ $menu->nama }}" width="100%" height="100%">
                            </div>
                            <div class="col-8 col-sm-8 col-md-8">
                                <div class="menuItems card-body">
                                    <h5 class="card-title menu-nama pb-2 m-0">{{ $menu->nama }} </h5>
                                    <span class="text-muted category-menu">{{ $menu->kategori }}</span>
                                    <div class="d-flex bd-highlight ">
                                        <div class="bd-highlight ">
                                            <p class="priceElementItems card-text pt-3 text-danger fw-bold"
                                                style="font-size: 12px">
                                                Rp. {{ $menu->harga }}
                                            </p>
                                        </div>
                                        <div class="ms-auto pt-2 bd-highlight js-order-group">
                                            <button class="js-btn-orders btn btn-sm btn-warning"> order </button>
                                            <div class="js-btn-group-input input-group input-group-sm input-group-md"
                                                style="width:95px; display:none">
                                                <button class="btn js-btn-arrow-spinner-min btn-warning btn-outline-none"
                                                    type="button" id="button-addon1">-</button>
                                                <input type="number" class="js-input-spinner-number form-control" min="0"
                                                    max="100" value="0" disabled>
                                                <button class="btn js-btn-arrow-spinner-plus btn-warning " type="button"
                                                    id="button-addon1">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- checkout --}}
    <div class="fixed-bottom mb-3" style="display:none" id="element-cart">
        <div class="row ">
            <div class="col-12">
                <div class="card btn btn-danger bg-danger text-light">
                    <div class="d-flex bd-highlight mb-3" style="height:30px;">
                        <div class="p-2 bd-highlight ">
                            <div class="d-inline-block bg-warning rounded-circle text-center"
                                style="width: 30px; height:30px; line-height:30px">
                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            </div>
                            <span id="qtyOrder">0</span> Barang | Rp<span id="totalPrice">0</span>
                        </div>
                        <div class="ms-auto p-2 bd-highlight">
                            <i class="bi bi-chevron-compact-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>
@endsection

@section('script')
    <script>
        document
        document.addEventListener("DOMContentLoaded", function(event) {

            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll("nav#navbar-category a");

            if (window.innerWidth <= 766) {
                window.addEventListener('scroll', function(e) {
                    sections.forEach(e => {
                        let id = e.getAttribute('id')
                        if (window.scrollY >= e.offsetTop - 1 && window.scrollY < e.offsetTop + e
                            .offsetHeight) {
                            navLinks.forEach(link => {
                                link.classList.remove('nav-active')
                                document.querySelector('nav#navbar-category a[href*=' + id +
                                    ']').classList.add('nav-active')
                            });
                        }
                    });
                })
            }

            // CHART JS
            const btnOrders = document.getElementsByClassName('js-btn-orders');
            const btnGroupInputNumber = document.getElementsByClassName('js-btn-group-input');

            // input arrow spinner
            const btnPlus = document.getElementsByClassName(`js-btn-arrow-spinner-plus`);
            const btnMin = document.getElementsByClassName(`js-btn-arrow-spinner-min`);
            const inputNumber = document.getElementsByClassName(`js-input-spinner-number`);

            // cart
            const priceElementItems = document.getElementsByClassName('priceElementItems')
            const qtyOrder = document.getElementById('qtyOrder');
            const totalPrice = document.getElementById('totalPrice')
            const cartElement = document.getElementById('element-cart');


            loadInputNumber()

            function loadInputNumber() {
                for (let i = 0; i < btnPlus.length; i++) {
                    btnPlus[i].addEventListener('click', function(e) {
                        totalOrder(e, '+')
                    })
                    btnMin[i].addEventListener('click', function(e) {
                        totalOrder(e, '-')
                    })
                    btnOrders[i].addEventListener('click', function(e) {
                        e.target.style.display = "none";
                        let btnGroup = e.target.parentNode.parentNode.parentNode.getElementsByClassName(
                            'js-btn-group-input')[0]
                        if (btnGroup.style.removeProperty('display')) {
                            totalOrder(e, '+')
                        }
                    })
                }
            }

            function totalOrder(e, operator) {
                const target = e.target.parentNode.parentNode.parentNode.parentNode
                const ElementOrder = target.getElementsByClassName('js-btn-orders')[0]
                const ElementGroup = target.getElementsByClassName('js-btn-group-input')[0]
                const getNumber = target.getElementsByClassName('js-input-spinner-number')[0]
                const getPrice = target.getElementsByClassName('priceElementItems')[0]

                // console.log(target)
                let currentPrice = parseInt(getPrice.innerText.slice(4));
                let currentNumber = parseInt(getNumber.value)
                let currentQty = parseInt(qtyOrder.innerText)
                let currentTotal = parseInt(totalPrice.innerText)

                if (operator == '+') {
                    if (currentNumber >= 10) {
                        alert('order maks 10')
                    } else {
                        getNumber.value = currentNumber += 1
                        totalPrice.innerText = currentTotal + currentPrice
                        qtyOrder.innerText = currentQty += 1
                    }
                }
                if (operator == '-') {
                    if (currentNumber <= 1) {
                        getNumber.value = 0
                        totalPrice.innerText = currentTotal -= currentPrice
                        qtyOrder.innerText = currentQty -= 1
                        ElementOrder.style.display = "block"
                        ElementGroup.style.display = "none"
                    } else {
                        getNumber.value = currentNumber -= 1
                        totalPrice.innerText = currentTotal -= currentPrice
                        qtyOrder.innerText = currentQty -= 1
                    }
                }
                if (currentQty > 0) {
                    cartElement.style.removeProperty('display')
                    cartElement.addEventListener('click', getData);
                } else {
                    cartElement.style.display = "none"
                }
            }

            function getData() {

                const listMenu = document.getElementsByClassName('cards-menus');
                const id = document.getElementsByClassName('cards-menu-id');
                const nama = document.getElementsByClassName('menu-nama');
                const kategori = document.getElementsByClassName('category-menu');
                const gambar = document.getElementsByClassName('menu-gambar');
                const jumlah = document.getElementsByClassName('js-input-spinner-number');
                const harga = document.getElementsByClassName('priceElementItems');

                getDataTransaksi = [];

                for (let i = 0; i <= listMenu.length - 1; i++) {
                    if (jumlah[i].value > 0) {
                        getDataTransaksi.push({
                            id: id[i].value,
                            nama: nama[i].innerText,
                            kategori: kategori[i].innerText,
                            gambar: gambar[i].src,
                            jumlah: jumlah[i].value,
                            harga: harga[i].innerText,
                        })
                    }
                }
                sessionStorage.setItem("order-list", JSON.stringify(getDataTransaksi));
                console.log(getDataTransaksi)
                window.location.href = '/menu/cart';


            }
        });
    </script>
@endsection
