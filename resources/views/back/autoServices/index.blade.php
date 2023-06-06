@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Services List</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($services as $service)
                        <li class="list-group-item">
                            <div class="services-list">
                                <div class="service">
                                    <div class="title-price">
                                        <div class="col-8">
                                            <h2>{{$service->title}}</h2>
                                        </div>
                                        <div class="col-8">
                                            <h2><span>{{$service->price}} EUR</span></h2>
                                        </div>
                                        <div class="col-8">
                                            <h2><span>{{$service->cat->title}}</span></h2>
                                        </div>
                                        <div class="col-8">
                                            @if(Auth::user()->role < 5) <div class="buttons">
                                                <a href="{{route('services-edit', $service)}}" class="btn btn-outline-success">Edit</a>
                                                <form action="{{route('services-delete', $service)}}" method="post">
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
                    <div class="cat-line">No services</div>
                </li>
                @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
