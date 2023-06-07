@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>All dishes:</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($dishes as $dish)
                        <li class="list-group-item">
                            <div class="dish-line">
                                <div class="dish-info">
                                    <div class="photo">
                                        @if($dish->photo)
                                        <img src="{{asset('dishes-photo') .'/t_'. $dish->photo}}">
                                        @else
                                        <img src="{{asset('dishes-photo') .'/no.jpg'}}">
                                        @endif
                                    </div>
                                    <h2>{{$dish->title}}</h2>
                                    <h2>{{$dish->description}}</h2>
                                    <h2>{{$dish->cat->title}}
                                        <div class="buttons">
                                            <a href="{{route('dishes-edit', $dish)}}" class="btn btn-outline-success">Edit</a>
                                            <form action="{{route('dishes-delete', $dish)}}" method="post">
                                                <button type="submit" class="btn btn-outline-danger">delete</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <div class="dish-line">No categories</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
