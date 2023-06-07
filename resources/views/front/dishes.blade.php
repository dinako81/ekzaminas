('layouts.front')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            @include('front.countries')
        </div>
        <div class="col-9">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>{{$dish->title}}</h2>
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
                <div class="card-body">
                    <ul class="list-group">
                        <div class="one-dish">

                            {{-- @include('front.stars') --}}

                            <div class="dish-info">
                                <div class="buy">
                                    <span>{{$dish->price}} eur</span>
                                    <section class="--add--to--cart" data-url="{{route('cart-add')}}">
                                        <button type="button" class="btn btn-primary">add to cart</button>
                                        <input type="hidden" name="id" value={{$dish->id}}>
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
