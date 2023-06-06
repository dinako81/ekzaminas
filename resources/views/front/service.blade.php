@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            @include('front.cats')
        </div>
        <div class="col-9">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>{{$service->title}}</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <div class="one-service">
                            {{-- <div class="one-service-colors">
                                @foreach($service->color as $color)
                                <div class="color" style="background-color:{{$color->hex}};">{{$color->title}}</div>
                        @endforeach
                </div> --}}
                <div class="service-info">
                    <div class="buy">
                        <span>{{$service->price}} eur</span>
                        <section class="--add--to--cart" data-url="{{route('cart-add')}}">
                            <button type="button" class="btn btn-primary">add to cart</button>
                            <input type="hidden" name="id" value={{$service->id}}>
                            <input type="number" value="1" min="1" name="count">
                        </section>
                    </div>
                </div>
            </div>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
@endsection
