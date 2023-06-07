@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Menu sąrašas</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($menus as $menu)
                        <li class="list-group-item">
                            <div class="menus-list">
                                <div class="menu">
                                    <div class="title-price">
                                        <div class="col-8">
                                            <h2> {{$menu->title}}</h2>
                                        </div>
                                        <div class="col-8">
                                            <h2><span><i> *****Restoranas: {{$menu->cat->title}}***</i></span></h2>
                                        </div>
                                        <div class="col-8">
                                            @if(Auth::user()->role < 5) <div class="buttons">
                                                <a href="{{route('menus-edit', $menu)}}" class="btn btn-outline-success">Edit</a>
                                                <form action="{{route('menus-delete', $menu)}}" method="post">
                                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                </div>
                </li>
                @empty
                <li class="list-group-item">
                    <div class="cat-line">No menus</div>
                </li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
