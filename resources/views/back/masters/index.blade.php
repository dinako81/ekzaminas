@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Our Masters</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($masters as $master)
                        <li class="list-group-item">
                            <div class="master-line">
                                <div class="master-info">
                                    <div class="photo">
                                        @if($master->photo)
                                        <img src="{{asset('masters-photo') .'/t_'. $master->photo}}">
                                        @else
                                        <img src="{{asset('masters-photo') .'/no.jpg'}}">
                                        @endif
                                    </div>
                                    <h2>{{$master->name}}</h2>
                                    <h2>{{$master->surname}}</h2>
                                    <h2>{{$master->cat->title}}
                                        <div class="buttons">
                                            <a href="{{route('masters-edit', $master)}}" class="btn btn-outline-success">Edit</a>
                                            <form action="{{route('masters-delete', $master)}}" method="post">
                                                <button type="submit" class="btn btn-outline-danger">delete</button>
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                </div>
                        </li>
                        @empty
                        <li class="list-group-item">
                            <div class="master-line">No categories</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
