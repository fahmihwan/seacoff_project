@extends('admin.layouts.main')

@section('styles')
    <style>
        .card-body-information {}

        .card {
            /* max-width: 220px; */
            /* min-height: 200px; */
            height: calc(100% * 200px);
            /* overflow: hidden; */
        }

        .card-text-dotted {
            max-height: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('container')
    <div class="row d-flex ">
        <div class="col-md-12 mb-xl-0">
            <div class="d-flex bd-highlight ">
                <div class="me-auto p-2 bd-highlight">
                    <h5 class="text-dark font-weight-bold p-0 m-0">Event </h5>
                    <p class="text-muted"> Last login was 23 hours ago. </p>
                </div>
                <div class="p-2 bd-highlight">
                </div>
                <div class="p-2 bd-highlight">
                    <a href="/admin/event/create" class="btn btn-primary">Tambah Event</a>
                </div>
            </div>
        </div>
    </div>



    <div class="row row-cols-1 row-cols-md-6 g-4">

        @foreach ($events as $event)
            <div class="col">
                <div class="card me-2 mb-2 ">
                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="..."
                        style="object-fit: contain;">
                    <div class="card-body card-body-information ">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <span class="text-muted mb-3 d-block">Jadwal : {{ $event->date }}</span>

                        <article class="card-text card-text-dotted ">
                            {!! $event->description !!}
                        </article>
                        <div class="clearfix mt-2">
                            <a href="#" class="float-start read-more">read more</a>
                            <a href="/admin/event/{{ $event->id }}/edit" class="float-end text-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
@section('script')
    <script>
        const readMore = document.getElementsByClassName('read-more');
        const cardText = document.getElementsByClassName('card-text');

        for (let i = 0; i <= readMore.length - 1; i++) {
            readMore[i].addEventListener('click', function() {
                if (cardText[i].classList.contains('card-text-dotted')) {
                    readMore[i].innerText = " hide"
                    cardText[i].classList.remove('card-text-dotted');
                } else {
                    readMore[i].innerText = "read more"
                    cardText[i].classList.add('card-text-dotted');
                }
            })
        }
    </script>
@endsection
