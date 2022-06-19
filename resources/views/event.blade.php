@extends('layout.landingPage')
@section('styles')
    <style>
        body {
            background-color: rgb(246, 246, 246)
        }

        .btn-group ul li a.scanQr {
            color: white;
            border: 8px solid white;
            background-color: rgb(233, 132, 8);
            height: 80px;
            width: 80px;
            border-radius: 80px;
            display: block;
            font-size: 30px;
            transform: translateY(-40px);
            line-height: 60px;
        }

        .img-cover {
            text-align: center;
            background-color: rgb(215, 215, 215);
        }

        .img-event {
            width: auto;
            height: 100%;
            max-width: 250px;
            max-height: 250px;
            margin: auto;
            align-self: center;
        }

        .expand {
            width: 200px;
            height: 100px;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .icon-expand {
            position: absolute;
            left: 0;
            padding: 5px;
            color: white
        }
    </style>
@endsection

@section('container')
    <div class="container">
        <div class="row mb-4" style="background-color: white">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="top-bar py-2">Even Seacoff</div>
            </div>
        </div>
        <div class="row " style="margin-bottom:200px">
            <div class="col-md-12 d-flex justify-content-center flex-wrap ">

                @foreach ($events as $event)
                    <div class="card mb-3" style="width: 18rem;">
                        <div class="img-cover">
                            <span class="icon-expand">
                                <img src="{{ asset('assets/icon/expand-icon.png') }}" alt=""
                                    style="width: 20px;  filter:brightness(0) invert(1);">
                            </span>
                            <div class="img-event">
                                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="..."
                                    style="width: 200px">
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="clearfix  " style="width: 100%">
                                <h5 class="float-start">{{ $event->title }}</h5>
                                <p class="float-end text-muted">{{ $event->date }}</p>
                            </div>
                            <article class="card-text m-0 expand e-expand">
                                {!! $event->description !!}
                            </article>
                            <a href="" class="float-end read-more">Read More</a>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="card mb-3" style="width: 18rem;">
                    <div class="img-cover">
                        <span class="icon-expand">
                            <img src="{{ asset('assets/icon/expand-icon.png') }}" alt=""
            style="width: 20px; filter:brightness(0) invert(1);">
            </span>
            <div class="img-event">
                <img src="{{ asset('assets/event/skte.jpg') }}" class="card-img-top" alt="..." style="width: 200px">
            </div>
        </div>
        <div class="card-body">
            <div class="clearfix" style="width: 100%">
                <h5 class="float-start">vakansea</h5>
                <p class="float-end text-muted">2022 02 11</p>
            </div>
            <p class="card-text m-0 expand e-expand">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi explicabo ratione quod facere
                delectus laboriosam veniam? A recusandae culpa laborum reprehenderit velit ipsam obcaecati eos,
                sed dolore, rerum minus quasi!
            </p>
            <a href="" class="float-end read-more">Read More

            </a>
        </div>
    </div>
    <div class="card mb-3" style="width: 18rem; ">
        <div class="img-cover">
            <span class="icon-expand">
                <img src="{{ asset('assets/icon/expand-icon.png') }}" alt="" style="width: 20px;  filter:brightness(0) invert(1);">
            </span>
            <div class="img-event">
                <img src="{{ asset('assets/event/vakansi2.jpg') }}" class="card-img-top" alt="..." style="width: 200px">
            </div>
        </div>
        <div class="card-body">
            <div class="clearfix" style="width: 100%">
                <h5 class="float-start">vakansea</h5>
                <p class="float-end text-muted">2022 02 11</p>
            </div>
            <p class="card-text m-0 expand e-expand">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi explicabo ratione quod facere
                delectus laboriosam veniam? A recusandae culpa laborum reprehenderit velit ipsam obcaecati eos,
                sed dolore, rerum minus quasi!
            </p>
            <a href="" class="float-end read-more">Read More

            </a>
        </div>
    </div> --}}

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const readMore = document.getElementsByClassName('read-more');
        const expand = document.getElementsByClassName('e-expand');
        const imgCover = document.getElementsByClassName('img-cover')
        const imgPreview = document.getElementsByClassName('card-img-top');

        for (let i = 0; i <= readMore.length - 1; i++) {
            readMore[i].addEventListener('click', function(e) {
                e.preventDefault()
                if (expand[i].classList.contains('expand')) {
                    expand[i].classList.remove('expand')
                    readMore[i].innerText = "Hide"
                } else {
                    expand[i].classList.add('expand')
                    readMore[i].innerText = "Read More"
                }
            })
            imgCover[i].addEventListener('click', () => showImg(i))
        }


        function showImg(i) {
            Swal.fire({
                position: 'top-end',
                showCloseButton: true,
                imageUrl: imgPreview[i].src,
                // imageWidth: 400,`
                // imageHeight: 200,
            })
        }
    </script>
@endsection
