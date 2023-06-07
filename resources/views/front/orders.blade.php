@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        {{-- <div class="col-3">
            @include('front.countries')
        </div> --}}
        <div class="col-9">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Mano užsakymai</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($orders as $order)
                        <li class="list-group-item">
                            <div class="front-orders">
                                <div class="front-order">
                                    <div class="front-order-number">#{{$order->id}}</div>
                                    <div class="front-order-status">{{$status[$order->status]}}</div>
                                    @if($order->status == 2)
                                    <a href="{{route('front-download', $order)}}">Download invoce</a>
                                    @endif
                                </div>
                                <div class="front-order-dishes">
                                    <ul class="list-group">
                                        @foreach($order->dishes as $dish)
                                        <li class="list-group-item">
                                            <div class="front-order-dishes-list">
                                                <span>Hotel title: {{$dish['title']}}</span>
                                                {{-- <i>{{$dish['price']}} eur</i> --}}
                                                X
                                                <i>Holyday duration: {{$dish['count']}} days </i>

                                            </div>
                                        </li>
                                        @endforeach
                                        <li class="list-group-item">
                                            {{-- <div class="front-order-dishes-list">
                                                <b>{{$order->price}} eur</b>
                                </div> --}}
                        </li>
                    </ul>
                </div>

            </div>
            </li>
            @empty
            <li class="list-group-item">
                No orders
            </li>
            @endforelse
            </ul>
        </div>
    </div>
</div>
</div>
</div>
@endsection
