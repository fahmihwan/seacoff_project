@extends('layout/main')
@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .sticky-title {
        background-color: white;
        position: sticky;
        position: -webkit-sticky;
        top: 0px;
        z-index: 3;
    }
</style>
@endsection

@section('container')
<div class="row sticky-title  pt-2">
    <a href="/menu" class="d-inline w-25">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <h5 class="text-center w-auto">Tinjauan Pesanan</h5>
</div>
<div class="row mt-2">
    <div class="col-md-12" style="background-color: white">
        <span class="text-muted">Tempat</span>
        <h5>Meja nomer 5</h5>
        <span class="text-muted " style="font-size: 10px">
            <p>cek status pesanan di buat. dan tunggu hingga waiters
                menganterkan pesanan and</p>
        </span>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12" style="background-color: white">
        <span class="text-muted">Detail Pesanan</span>
        <div id="detail-pesanan" style="min-height: 37vh">
            {{-- DATA --}}
        </div>
    </div>
    <div class="col-md-12 text-center py-2" style="background-color: white">
        <b> <a href="" class="text-decoration-none">Tambah Lagi</a></b>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12 py-2" style="background-color: white">
        <p class="text-muted ">Ringkasan Pesanan</p>
        <div class="d-flex bd-highlight pb-1">
            <div class="me-auto bd-highlight">Dasar Pengenaan Pajak</div>
            <div class=" bd-highlight" id="price-without-ppn">Rp0</div>
        </div>
        <div class="d-flex bd-highlight pb-1">
            <div class="me-auto  bd-highlight">PPN(10%)</div>
            <div class=" bd-highlight" id="ppn">Rp0</div>
        </div>
        <hr>
        <div class="d-flex bd-highlight pb-1">
            <div class="me-auto  bd-highlight"><b>TOTAL</b></div>
            <div class=" bd-highlight"><b id="total-price">Rp0</b></div>
        </div>
        <div class="d-grid gap-2 mb-3">
            <form action="/menu/payment/" method="POST" id="send_json">
                @csrf
                <input type="hidden" value="" name="json" id="json_callback">
                <button class=" btn btn-danger btn-sm " type=" button" id="pay-button" style="width: 100%;">Pesan
                    Sekarang!</button>
            </form>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        let orderList = JSON.parse(sessionStorage.getItem("order-list"));
        const detailPesanan = document.getElementById('detail-pesanan')

        loadData()

        function loadData() {
            valuess = "";

            for (let i = 0; i <= orderList.length - 1; i++) {
                valuess += `<div class=" cards-menus ps-2 me-md-2 mb-2 border-bottom">
                        <input type="hidden" value="${orderList[i].id}" class="cards-menu-id">
                        <div class="row g-0">
                            <div class="col-4 col-sm-4 col-md-4 py-2 ">
                                <img src="${orderList[i].gambar}"
                                    class="rounded menu-gambar" alt="americano" width="100%" height="100%">
                            </div>
                            <div class="col-8 col-sm-8 col-md-8">
                                <div class="menuItems card-body">
                                    <h5 class="card-title menu-nama pb-2 m-0">${orderList[i].nama}</h5>
                                    <span class="text-muted category-menu">${orderList[i].kategori}</span>
                                    <div class="d-flex bd-highlight ">
                                        <div class="bd-highlight ">
                                            <p class="priceElementItems card-text pt-3 text-danger fw-bold"
                                                style="font-size: 12px">
                                                ${orderList[i].harga}
                                            </p>
                                        </div>
                                        <div class="ms-auto pt-2 bd-highlight js-order-group">
                                            <div class="js-btn-group-input input-group input-group-sm input-group-md"
                                                style="width:95px;">
                                                <button class="btn js-btn-arrow-spinner-min btn-warning btn-outline-none"
                                                    type="button" id="button-addon1">-</button>
                                                <input type="number" class="js-input-spinner-number form-control" min="0"
                                                    max="100" value="${orderList[i].jumlah}" disabled>
                                                <button class="btn js-btn-arrow-spinner-plus btn-warning " type="button"
                                                    id="button-addon1">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                // render
                detailPesanan.innerHTML = valuess;
            }
            summaryOrders()
            totalValidation()
            action()
        }

        function totalValidation() {
            const hargaSatuan = document.getElementsByClassName('priceElementItems');
            const inputNumber = document.getElementsByClassName('js-input-spinner-number');
            for (let j = 0; j <= orderList.length - 1; j++) {
                if (inputNumber[j].value > 1) {
                    changePriceElement(orderList[j], hargaSatuan[j], inputNumber[j])
                }
            }
        }


        function action() {
            // CHART JS
            // input arrow spinner
            const btnPlus = document.getElementsByClassName(`js-btn-arrow-spinner-plus`);
            const btnMin = document.getElementsByClassName(`js-btn-arrow-spinner-min`);
            const inputNumber = document.getElementsByClassName(`js-input-spinner-number`);

            const hargaSatuan = document.getElementsByClassName('priceElementItems');

            for (let i = 0; i <= orderList.length - 1; i++) {
                btnPlus[i].addEventListener('click', function() {
                    let values = parseInt(inputNumber[i].value);
                    values += 1
                    inputNumber[i].value = values;
                    changePriceElement(orderList[i], hargaSatuan[i], inputNumber[i])
                    summaryOrders()
                });

                btnMin[i].addEventListener('click', function() {
                    let values = parseInt(inputNumber[i].value);
                    values -= 1
                    inputNumber[i].value = values;
                    changePriceElement(orderList[i], hargaSatuan[i], inputNumber[i])
                    summaryOrders()

                    if (values < 1) {
                        inputNumber[i].value = 0;
                        const id = orderList[i].id;
                        orderList.splice(i, 1);
                        sessionStorage.setItem("order-list", JSON.stringify(orderList));
                        loadData();
                        if (orderList.length < 1) {
                            window.location.href = '/menu';
                        }
                    }
                });
            }
        }

        function changePriceElement(dataJson, eHargaSatuan, jumlah) {
            const price = parseInt(dataJson.harga.slice(2).replace(/[Rp.]+/g, ''));

            let total = price * jumlah.value;
            eHargaSatuan.innerText = 'Rp. ' + total;

            summaryOrders()
        }


        function summaryOrders() {
            let dataJson = [];
            let priceWithOutppn = document.getElementById('price-without-ppn');
            let ppn = document.getElementById('ppn')
            let totalPrice = document.getElementById('total-price')
            const priceElements = document.getElementsByClassName('priceElementItems');
            // passing json
            const id = document.getElementsByClassName('cards-menu-id');
            const name = document.getElementsByClassName('card-title ');
            const quantity = document.getElementsByClassName('js-input-spinner-number ')
            const inputJson = document.getElementById('json_callback');

            let realPrice = 0;
            for (let i = 0; i <= priceElements.length - 1; i++) {
                realPrice += parseInt(priceElements[i].innerText.slice(2).replace(/[Rp.]+/g, ''));
                let harga = parseInt(orderList[i].harga.slice(2).replace(/[Rp.]+/g, ''))
                dataJson.push({
                    id: orderList[i].id,
                    name: orderList[i].nama,
                    price: harga,
                    quantity: quantity[i].value,
                })
            }
            sessionStorage.setItem('detailOrder-list', JSON.stringify(dataJson))



            dataJson.push({
                name: "Tax",
                price: parseInt(ppn.innerText.slice(2).replace(/[Rp.]+/g, '')),
                quantity: 1,
                id: "T01",
            })

            dataJson.push({
                "gross_amount": parseInt(totalPrice.innerText.slice(2).replace(/[Rp.]+/g, ''))
            })
            inputJson.value = JSON.stringify(dataJson);

            priceWithOutppn.innerText = 'Rp' + realPrice;
            // ppn
            let ppnRessult = 10 / 100 * realPrice

            //
            let totalWithPPN = realPrice + ppnRessult;
            ppn.innerText = 'Rp' + ppnRessult;

            // // total
            totalPrice.innerText = 'Rp' + totalWithPPN
        }

        const form = document.getElementById('send_json');
        const inputJson = document.getElementById('json_callback');
        form.addEventListener('submit', function(e) {
            summaryOrders()
        })








        // function convert_to_json() {

        //     // console.log(inputNumber)
        //     // console.log(hargaSatuan)




        //     // for (let i = 0; i <= priceElements.length - 1; i++) {
        //     //     // realPrice += parseInt(priceElements[i].innerText.slice(2).replace(/[Rp.]+/g, ''));
        //     // }


        // }


    })
</script>
@endsection