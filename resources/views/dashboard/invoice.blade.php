@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Riwayat Pesanan</h1>
    </div>

    <div class="col-lg-10">
        @php
            $previousDate = null;
        @endphp

        @foreach ($groupedOrders as $date => $cartItems)
            @if ($previousDate !== $date) 
                <h5 class="mt-4">{{ $date }}</h5>
                <hr>
                @php
                    $previousDate = $date;
                @endphp
            @endif

            @php
                $totalPerDay = 0;
            @endphp

            @foreach ($cartItems as $order)
                <div class="order-item mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" style="width: 50px; height: 50px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">{{ $order->quantity }} x {{ $order->product->name }}</h6>
                                <p class="text-muted mb-0">{{ $order->created_at->format('H:i') }}</p>
                            </div>
                            @can('user-role', 1) 
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0">Pemesan: {{ $order->user->name }}</p>
                                    <p class="text-muted mb-0">Rp.{{ number_format($order->total_price, 2) }}</p>
                                </div>
                            @endcan
                            @can('user-role', 0) 
                                <div class="d-flex justify-content-between align-items-center">
                                    <p></p>
                                    <p class="text-muted mb-0">Rp.{{ number_format($order->total_price, 2) }}</p>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                @php
                    $totalPerDay += $order->total_price; 
                @endphp
            @endforeach

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Total</h6>
                <h6 class="text-muted mb-0">Rp.{{ number_format($totalPerDay, 2) }}</h6>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
