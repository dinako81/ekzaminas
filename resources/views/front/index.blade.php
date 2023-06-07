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
                    <h2>{{$cat->title}} Visi menu:</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($menus as $menu)
                        <div class="menu-line">
                            <div class="cat-menu">
                                @foreach($cat->menu as $menu)
                                {{$menu->title}}
                                @endforeach
                            </div>
                            <div class="menu-info">
                                <a href="{{route('front-show-menu', $menu)}}">
                                    <h2>{{$menu->title}}</h2>
                                </a>

                                <div class="cat-menu">
                                    @foreach($menu->dish as $dish)
                                    {{$dish->title}}

                                    @endforeach
                                </div>
                                <div class="photo">
                                    @if($dish->photo)
                                    <img src="{{asset('dishes-photo') .'/t_'. $dish->photo}}">
                                    @else
                                    <img src="{{asset('dishes-photo') .'/no.png'}}">
                                    @endif
                                </div>

                                <div class="gallery">
                                    <div>
                                        @foreach($dish->gallery as $photo)
                                        <img src="{{asset('dishes-photo') .'/'. $photo->photo}}">
                                        @endforeach
                                    </div>
                                </div>

                                <div class="buy">

                                    <section class="--add--to--cart" data-url="{{route('cart-add')}}">
                                        <button type="button" class="btn btn-primary">add to cart</button>
                                        <input type="hidden" name="id" value={{$dish->id}}>
                                        <input type="number" value="1" min="1" name="count">
                                    </section>
                                </div>
                            </div>
                        </div>
                        @empty
                        <li class="list-group-item">
                            No menus
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
