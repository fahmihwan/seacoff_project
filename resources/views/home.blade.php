@extends('layout/landingPage')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    <style>
        body {
            background-color: #a03129;
        }

        .my-carousel {
            display: flex;
        }

        .img-slick {
            width: auto;
            height: 100%;
            max-width: 250px;
            max-height: 250px;
            margin: auto;
            align-self: center;
        }

        .btn-group ul li a.scanQr {
            color: white;
            border: 8px solid #a03129;
            /* background-color: rgb(157, 135, 135); */
            background-color: rgb(233, 132, 8);
            height: 80px;
            width: 80px;
            border-radius: 80px;
            display: block;
            font-size: 30px;
            transform: translateY(-40px);
            line-height: 60px;
        }

    </style>
@endsection

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ">
                <div class="mt-5 mb-3 border rounded-pill d-inline-block overflow-hidden">
                    <img src="{{ asset('assets/images/sea_coff-logo.jpeg') }}" alt="" style="width: 80px">
                </div>
                <p class="text-light pb-0  mb-0" style="font-size: 20px"> SEA COFFEE</p>
                <p class="text-light my-0 py-0" style="font-size: 14px">Jl.Kartini No.5 Madiun </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pt-4 ">
                <div class=" d-flex justify-content-evenly">
                    <p style="color: rgb(241, 238, 238)">event Seacoff</p>
                    <a href="" class="" style="color: rgb(241, 238, 238)">event lainnya</a>
                </div>
                <div class="m-auto d-flex justify-content-around">
                    <div class="my-carousel rounded" style="width: 250px; height: 250px; background-color: #872922;">
                        <div><img src="{{ asset('assets/event/vakansi2.jpg') }}" alt="Image 1" class="img-slick">
                        </div>
                        <div><img src="{{ asset('assets/event/vakansi1.jpg') }}" alt="Image 1" class="img-slick">
                        </div>

                        <div><img src="{{ asset('assets/event/java-jaz.jpg') }}" alt="Image 1" class="img-slick">
                        </div>

                        <div><img src="{{ asset('assets/event/skte.jpg') }}" alt="Image 1" class="img-slick">
                        </div>
                    </div>
                </div>
                <p class="text-center" style="color: rgb(215, 210, 210)">We are OPEN Everyday <br> 08.00 - 23.00 (close
                    order)
                </p>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Some other code right here -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.my-carousel').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

        });
    </script>
@endsection
