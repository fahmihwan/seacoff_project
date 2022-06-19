<div class="btn-group">
    <ul>
        <li><a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i> <br>
                Home</a>
        </li>
        <li><a href="/home/my-order" class="{{ request()->is('home/my-order*') ? 'active' : '' }}">
                <i class="fas fa-business-time"></i> <br>
                My order</a></li>
        <li><a href="/home/event" class="{{ request()->is('home/event') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i> <br>
                Event</a></li>
        <li>

            @if (Session::has('token'))
                <a href="/menu" class="scanQr ">
                    <img src="{{ asset('assets/images/add-to-cart.png') }}" alt=""
                        style="width: 40px;  filter:brightness(0) invert(1);">
                </a>
            @else
                <a href="/home/scan" class="scanQr ">
                    <img src="{{ asset('assets/images/qrcode.png') }}" alt=""
                        style="width: 55px;  filter:brightness(0) invert(1);">
                </a>
            @endif

        </li>

    </ul>
</div>
