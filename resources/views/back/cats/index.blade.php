@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Restoranų sarašas:</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($cats as $cat)
                        <li class="list-group-item">
                            <div class="cat-line">
                                <div class="cat-info">
                                    {{-- <div class="photo">
                                        @if($cat->photo)
                                        <img src="{{asset('cats-photo') .'/t_'. $cat->photo}}">
                                    @else
                                    <img src="{{asset('cats-photo') .'/no.jpg'}}">
                                    @endif
                                </div> --}}
                                <div class="mb-3">
                                    Restorano pavadinimas: <h2>{{$cat->title}}</h2>
                                    <span>Adresas: {{$cat->address}}, Kodas: {{$cat->code}} </span>
                                </div>
                                {{-- <div class="cat-colors-count">
                                        @for($i = 0; $i < $cat->colors_count; $i++)
                                            <div class="--random--color"></div>
                                            @endfor
                                    </div> --}}
                            </div>
                            <div class="buttons">
                                <a href="{{route('cats-edit', $cat)}}" class="btn btn-outline-success">Koreguoti</a>
                                <form action="{{route('cats-delete', $cat)}}" method="post">
                                    <button type="submit" class="btn btn-outline-danger">Ištrinti</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                </div>
                </li>
                @empty
                <li class="list-group-item">
                    <div class="cat-line">No categories</div>
                </li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
