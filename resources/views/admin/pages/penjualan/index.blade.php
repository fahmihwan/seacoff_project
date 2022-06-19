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

    span.menu-add {
        ound-color: #0e6efd;
        border-radius: 0px 0px 0px 3px;
        text-decoration: none;
        padding: 0px 4px;
        color: white;
        transition: 0.3s;
        background-color: #da291c;
        width: 50px;
        height: 20px;
        cursor: pointer;
    }

    span.menu-add:hover {
        background-color: white;
        color: blue;
    }

    .btn-outline-primary {
        border-radius: 2px;
    }

    .cart-menu {
        position: fixed;
        top: 140px;
        right: 20px;
        background-color: white;
        height: 77vh;
        transition: 0.4s;

    }

    ul#list-cart-menu {
        overflow: scroll;
    }

    ul#list-cart-menu li {
        list-style-type: none;
        background-color: #fff9eb;
        border-radius: 5px;
        margin-bottom: 10px;
        padding: 0 5px 0 5px;
    }

    ul.list-cart-price li {
        list-style-type: none;
        margin-bottom: 5px;
        padding: 0 5px 0 5px;
    }

    .btn-plus,
    .btn-minus {
        width: 50px;
        height: 25px;
    }

    .item-name {
        padding-top: 5px;
        color: black;
    }

    .item-price {

        color: black;
    }

    .item-qty {
        line-height: 22px;
        color: black;
    }

    .item-category {
        color: grey;
    }

    .item-btn-group {
        width: 100px;
        padding-top: 5px;
    }

    table.tb-modal-kembalian {
        width: 100%;
    }


    table.tb-modal-kembalian tr th {

        width: 120px;
    }

    table.tb-modal-kembalian tr th,
    td {
        padding: 10px 0;
    }


    span.total-dotted {
        border-bottom-style: dashed;
        border-color: gray;
        width: 100%;
        display: block;
    }

    section .category-group button {
        background-color: #464dee;
        color: white;
        height: 70px;
        border-radius: 2px;
    }

    section .category-group button:hover {
        background-color: #0910ce;
        color: white
    }

    section .category-group button.category-active {
        background-color: rgb(250, 250, 250);
        color: black;
    }
</style>
@endsection


@section('container')
<div class="row">
    <div class="col-sm-12   mb-xl-0">
        <div class="d-flex bd-highlight ">
            <div class="me-auto p-0 bd-highlight">
                <h5 class="text-dark font-weight-bold p-0 m-0">Penjualan</h5>
                <p class="text-muted"> Last login was 23 hours ago. </p>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-md-1">
        <section>
            <div class="card category-group">
                <button class="btn mb-2 mt-2 category-name category-active">All</button>
                <button class="btn mb-2 category-name">Hot</button>
                <button class="btn mb-2 category-name">Ice</button>
                <button class="btn mb-2 category-name">Food</button>
                <button class="btn mb-2 category-name">Snack</button>
            </div>
        </section>

    </div>
    <div class="col-md-7">
        <div class="d-flex flex-wrap" id="list-menu">
            @foreach ($all_menu as $menu)
            <div class="card card-dashboard-item me-md-3" style="width :11rem; ">
                <div class="img-container-item ">
                    <span data-id="{{ $menu->id }}" class="menu-add ">
                        Add
                    </span>
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="..." width="100%" height="100%">
                </div>
                <div class="card-body p-2">
                    <div class="d-flex bd-highlight  ">
                        <div class="me-auto bd-highlight">
                            <h5 class="menu-nama card-title p-0 m-0" data-menu-id="{{ $menu->id }}">
                                {{ $menu->nama }}
                            </h5>
                            <p class="text-danger">Rp. <span class="menu-harga">{{ $menu->harga }}</span>
                            </p>
                        </div>
                        <div class="bd-highlight text-end ">
                            <p class="menu-kategori text-muted p-0 m-0">{{ $menu->kategori }}</p>
                            <p class="menu-status p-0 m-0 text-success">{{ $menu->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- <div class="card">Americano</div> --}}

        </div>
    </div>


    <div class="col-md-4 cart-menu card">
        <h5 class="text-center py-3"><i class="fas fa-cart-arrow-down"></i> &nbsp; keranjang menu</h5>

        <ul id="list-cart-menu" class=" ps-0" style="height: 300px;">
            <p class="text-center text-muted" style="margin-top: 120px;">Tidak ada</p>
        </ul>

        <ul class="list-cart-price  ps-0 m-0">
            <hr>
            <li>Dasar Pengenaan Pajak <span class="float-end">Rp. <span id="harga-asli">0</span> </span></li>
            <li>PPN(10%) <span class="float-end">Rp. <span id="ppn">0</span></span></li>
            <li>Total <span class=" float-end">Rp. <span id="total">0</span></span></li>
        </ul>
        <div class="d-flex align-items-end mb-4 " style="height:55px">


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 100%" id="modal-bayar">
                Bayar
            </button>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview Tambah Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">

                        <table class="tb-modal-kembalian">
                            <tr>
                                <th>Total Harga</th>
                                <td><span class="text-muted">Rp <span id="modal-total-harga"> 27,200</span></span>
                                </td>
                            </tr>
                            <tr>
                                <th>PPN</th>
                                <td><span class="text-muted" id="modal-ppn"></span></td>
                            </tr>
                            <tr>
                                <th>Total Bayar</th>
                                <td> <span class="text-muted total-dotted" id="modal-total-bayar">7000</span></td>
                            </tr>
                        </table>


                    </div>
                    <div class="col-md-7">


                        <table class="tb-modal-kembalian">
                            <tr>
                                <th>Uang Tunai</th>
                                <td>
                                    <span class="text-muted">
                                        <input type="number" class="form-control" value="" id="modal-uang-tunai">
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <Button class="btn-sm btn-success btn-tunai me-2" data-uang-tunai="10000">Rp.10000</Button>
                                    <Button class="btn-sm btn-success btn-tunai me-2" data-uang-tunai="20000">Rp.20000</Button>
                                    <Button class="btn-sm btn-success btn-tunai me-2" data-uang-tunai="50000">Rp.50000</Button>
                                    <Button class="btn-sm btn-success btn-tunai me-2" data-uang-tunai="100000">Rp.100000</Button>
                                </td>
                            </tr>
                            <tr>
                                <th id="table-kembalian">Kembalian</th>
                                <td><span class="text-muted total-dotted" id="modal-kembalian"></span></td>
                            </tr>
                        </table>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="pay-now">Bayar Sekarang</button>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="/admin/penjualan/store" id="form-submit" hidden>
    @csrf
    <input type="text" name="kembalian" value="">
    <input type="text" name="cart" value="">
    <input type="text" name="total" value=""><br>
    <button class="btn btn-primary" type="button" style="width: 100%" id="payment">bayar</button>
</form>
@endsection

@section('script')
<script>
    if (document.readyState == 'loading') {
        document.addEventListener('DOMContentLoaded', handleAjaxCategory)
    } else {
        handleAjaxCategory()

    }



    let _dataCart = []
    let _dataTotal = {
        harga: 0,
        ppn: 0,
        total: 0
    }
    let _dataKembalian = {
        uangTunai: null,
        kembalian: null
    }





    function handleAjaxCategory() {
        ready()
        const categoryName = document.getElementsByClassName('category-name')
        for (let i = 0; i <= categoryName.length - 1; i++) {
            categoryName[i].addEventListener('click', function() {
                handleUICategoryActive(i)
                switch (i) {
                    case 0:
                        ajaxCategory('all')
                        break;
                    case 1:
                        ajaxCategory('hot')
                        break;
                    case 2:
                        ajaxCategory('ice')
                        break;
                    case 3:
                        ajaxCategory('food')
                        break;
                    case 4:
                        ajaxCategory('snack')
                        break;
                    default:
                }
            });
        }
    }



    function handleUICategoryActive(increment) {
        const categoryName = document.getElementsByClassName('category-name')
        for (let i = 0; i <= categoryName.length - 1; i++) {
            if (categoryName[i].classList.contains('category-active')) {
                categoryName[i].classList.remove('category-active');
            }
        }
        categoryName[increment].classList.add('category-active')
    }

    function ajaxCategory(category) {
        fetch('/json/category-menu/' + category)
            .then(response => response.json())
            .then(res => changeMenuByCategory(res))
            .catch(err => console.log(err))
    }

    function changeMenuByCategory(res) {
        const listMenu = document.getElementById('list-menu');
        let text = ''
        res.forEach(e => {
            text += `<div class="card card-dashboard-item me-md-3" style="width :11rem; ">
                <div class="img-container-item ">
                    <span data-id="${e.id}" class="menu-add ">
                        Add
                    </span>
                    <img src="/storage/${e.gambar}" alt="..." width="100%" height="100%">
                </div>
                <div class="card-body p-2">
                    <div class="d-flex bd-highlight  ">
                        <div class="me-auto bd-highlight">
                            <h5 class="menu-nama card-title p-0 m-0" data-menu-id="${e.id}">
                                ${e.nama}
                            </h5>
                            <p class="text-danger">Rp. <span class="menu-harga">${e.harga}</span>
                            </p>
                        </div>
                        <div class="bd-highlight text-end ">
                            <p class="menu-kategori text-muted p-0 m-0">${e.kategori}</p>
                            <p class="menu-status p-0 m-0 text-success">${e.status}</p>
                        </div>
                    </div>
                </div>
            </div>`

            listMenu.innerHTML = text

        });
        ready()
    }




    function ready() {
        const btnAddCart = document.getElementsByClassName('menu-add');
        for (let i = 0; i <= btnAddCart.length - 1; i++) {
            btnAddCart[i].addEventListener('click', () => addCartList(i));
        }

    }

    function addCartList(i) {
        clearModal()
        const id = document.getElementsByClassName('menu-nama')[i].getAttribute("data-menu-id")
        const menu = document.getElementsByClassName('menu-nama')[i].innerText
        const category = document.getElementsByClassName('menu-kategori')[i].innerText
        const price = document.getElementsByClassName('menu-harga')[i].innerText
        const status = document.getElementsByClassName('menu-status')[i].innerText

        if (status == 'tersedia') {
            createJson(parseInt(id), menu, category, parseInt(price));
        } else {
            alert('menu habis')
        }
    }

    function createJson(id, menu, category, price) {
        if (_dataCart.length != 0) {
            if (cekJson(id, 'returnJsonExist')) {
                const key = cekJson(id, 'returnKey');
                _dataCart[key].qty += 1
            } else {
                storeJson(id, menu, category, price)
            }
        } else {
            storeJson(id, menu, category, price)
        }
        cartMenu()
    }

    function cekJson(id, cek) {
        for (let k = 0; k <= _dataCart.length - 1; k++) {
            if (_dataCart[k].id == id && cek == 'returnJsonExist') {
                return true
            }
            if (_dataCart[k].id == id && cek == 'returnKey') {
                return k
            }
        }
    }

    function storeJson(id, menu, category, price) {
        _dataCart.push({
            id: id,
            nama: menu,
            kategori: category,
            harga: price,
            currentPrice: price,
            qty: 1,
        });
    }

    function cartMenu() {
        const listCart = document.getElementById('list-cart-menu')
        let text = '';

        if (_dataCart.length != 0) {
            for (let i = 0; i <= _dataCart.length - 1; i++) {
                handlePrice(i);
                text += `<li>
                    <div class="d-flex bd-highlight ">
                    <div class="me-auto bd-highlight item-name">${_dataCart[i].nama} <span class="item-category">(${_dataCart[i].kategori})</span></div>
                <div class="bd-highlight me-2 ">
                <div class="d-flex item-btn-group ">
                    <button class="btn-minus btn btn-primary badge rounded rounded-pill">-</button>
                    <p class="item-qty px-2 ">${_dataCart[i].qty}</p>
                    <button class="btn-plus btn btn-primary badge rounded rounded-pill">+</button>
                </div>
                </div>
                    <div class="px-3 item-price bd-highlight text-success">Rp. ${_dataCart[i].qty == 1?_dataCart[i].harga:_dataCart[i].currentPrice}</div>
                    </div>
                </li>`
                listCart.innerHTML = text;
                handleQty()
                handleTotal()
            }
        } else {
            listCart.innerHTML = ''
        }
    }

    function handlePrice(i) {
        _dataCart[i].currentPrice = _dataCart[i].qty * _dataCart[i].harga

    }

    function handleQty() {
        const btnPlus = document.getElementsByClassName('btn-plus')
        const btnMinus = document.getElementsByClassName('btn-minus')

        for (let i = 0; i <= btnPlus.length - 1; i++) {
            btnPlus[i].addEventListener('click', function() {
                _dataCart[i].qty += 1
                cartMenu()
                handleTotal()
                clearModal()
            })
            btnMinus[i].addEventListener('click', function() {
                _dataCart[i].qty -= 1
                if (_dataCart[i].qty < 1) {
                    _dataCart.splice(i, 1);
                }
                handleTotal()
                cartMenu()
                clearModal()
            })
        }

    }

    function clearModal() {
        document.getElementById('modal-uang-tunai').value = '';
        document.getElementById('modal-kembalian').innerHTML = ''
    }



    function handleTotal() {
        const hargaAsli = document.getElementById('harga-asli')
        const ppn = document.getElementById('ppn')
        const bayar = document.getElementById('total');

        const harga = _dataCart.reduce(function(previous, current) {
            return previous + current.currentPrice;
        }, 0);

        // ppn
        let hargaPPn = 10 / 100 * harga
        let totalBayar = hargaPPn + harga

        _dataTotal = {
            harga: harga,
            hargaPPn: hargaPPn,
            totalBayar: totalBayar
        }

        hargaAsli.innerText = harga
        ppn.innerText = hargaPPn
        bayar.innerText = totalBayar

        handleIfExistCart()
    }


    function handleModal() {
        const totalHarga = document.getElementById('modal-total-harga');
        const ppn = document.getElementById('modal-ppn');
        const totalBayar = document.getElementById('modal-total-bayar');
        const uangTunai = document.getElementById('modal-uang-tunai');
        const kembalian = document.getElementById('modal-kembalian');

        totalHarga.innerText = _dataTotal.harga
        ppn.innerText = `Rp ${_dataTotal.hargaPPn}`
        totalBayar.innerText = `Rp ${_dataTotal.totalBayar}`

    }

    function paymentMethod() {
        if (_dataCart.length < 1) {
            Swal.fire(
                'The Internet?',
                'That thing is still around?',
                'question'
            )
        }

    }

    handleIfExistCart()

    function handleIfExistCart() {
        const modalBayar = document.getElementById('modal-bayar');
        if (_dataCart.length < 1) {
            modalBayar.setAttribute('disabled', '')
            modalBayar.classList.replace('btn-primary', 'btn-secondary')
        } else {
            modalBayar.removeAttribute('disabled')
            modalBayar.classList.replace('btn-secondary', 'btn-primary')
        }

        const modalUangTunai = document.getElementById('modal-uang-tunai');

        modalBayar.addEventListener('click', function(e) {
            handleModal()
        })
    }



    const btnTunai = document.getElementsByClassName('btn-tunai');
    const modalUangTunai = document.getElementById('modal-uang-tunai');

    modalUangTunai.addEventListener('keyup', () => handleKembalian())

    for (let i = 0; i <= btnTunai.length - 1; i++) {
        btnTunai[i].addEventListener('click', () => handleKembalian('tunai', i))
    }

    function handleKembalian(uang, increment) {
        const modalUangTunai = document.getElementById('modal-uang-tunai');
        const modalKembalian = document.getElementById('modal-kembalian');
        if (uang == 'tunai') {
            modalUangTunai.value = btnTunai[increment].getAttribute('data-uang-tunai');
        }
        if (modalUangTunai.value == '') {
            modalKembalian.innerHTML = '<span class="text-danger p-0 m-0 d-inline-block"> masukan uang tunai<span>';
            handleDataKembalian(null, null)
        } else {
            const uangTunai = parseInt(modalUangTunai.value)
            const kembalian = uangTunai - _dataTotal.totalBayar;

            if (_dataTotal.totalBayar > uangTunai) {
                // console.log('--KURANG--')
                modalKembalian.innerHTML = `<span class="text-danger p-0 m-0 d">  ${kembalian}<span>`
                handleDataKembalian(null, null)
                document.getElementById('table-kembalian').innerText = "Kurang"
            }
            if (_dataTotal.totalBayar < uangTunai) {
                // console.log('--KELEBIHAN--')
                modalKembalian.innerHTML = `<span class="text-success"> Rp ${kembalian}  </span>`;
                handleDataKembalian(kembalian, parseInt(modalUangTunai.value))
                document.getElementById('table-kembalian').innerText = "Kembalian"
            }
            if (_dataTotal.totalBayar == uangTunai) {
                // console.log('--PASS--');
                modalKembalian.innerHTML = `<span class="text-success"> Tidak ada kembalian </span>`;
                handleDataKembalian(0, parseInt(modalUangTunai.value))
                document.getElementById('table-kembalian').innerText = "Uang Pass"

            }
        }
    }

    function handleDataKembalian(kembalian, uangTunai) {
        _dataKembalian.kembalian = kembalian;
        _dataKembalian.uangTunai = uangTunai
    }

    const payNow = document.getElementById('pay-now');
    payNow.addEventListener('click', function() {
        if (_dataKembalian.uangTunai != null && _dataKembalian.kembalian != null) {
            console.log(_dataKembalian)
            document.querySelector('[name=kembalian]').value = JSON.stringify(_dataKembalian);
            document.querySelector('[name=cart]').value = JSON.stringify(_dataCart);
            document.querySelector('[name=total]').value = JSON.stringify(_dataTotal)
            document.getElementById('form-submit').submit();
        } else {
            alert('harap lenkapi data')
        }
    })

    const btnStatus = document.getElementsByClassName('confirm-status');
    const cartMenuUi = document.getElementsByClassName('cart-menu')[0];


    for (let i = 0; i <= btnStatus.length - 1; i++) {
        if (btnStatus[i].innerText == 'habis') {
            btnStatus[i].style.backgroundColor = "red";
        }
    }

    window.addEventListener('scroll', function() {
        const currentScroll = window.scrollY //74

        if (currentScroll >= 75) {
            cartMenuUi.style.top = "85px"
            cartMenuUi.style.height = "85vh"
            // cartMenu.style.marginTop = "100px"
        }

        if (currentScroll <= 76) {
            cartMenuUi.style.top = "140px"
            cartMenuUi.style.height = "77vh"
        }
    })
</script>
@endsection