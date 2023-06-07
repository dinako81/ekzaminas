@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Koreguoti patiekalą</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('dishes-update', $dish)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Patiekalo pavadinimas</label>
                            <input type="text" class="form-control" name="title" value={{old('title', $dish->title)}}>
                            <div class="form-text">Įveskite patiekalo pavadinimą</div>
                        </div>
                        <div class="col-9">
                            <div class="mb-3">
                                <label class="form-label">Patiekalo aprašas</label>
                                <textarea id="" class="form-control" rows="7" cols="50" name="description" value={{old('description', $dish->description)}}>...</textarea>
                                <div class="form-text">Įveskite patiekalo aprašymą</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" name="menu_id">
                                <option value="0">Menu sąrašas</option>
                                @foreach($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->title}}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Pasirinkite menu</div>
                        </div>

                        <div class="mb-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        @if($dish->photo)
                                        <img src="{{asset('dishes-photo') .'/t_'. $dish->photo}}">
                                        @else
                                        <img src="{{asset('dishes-photo') .'/no.png'}}">
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label">Pagrindinė patiekalo nuotrauka</label>
                                        <input type="file" class="form-control" name="photo">
                                        <button type="submit" name="delete" value="1" class="mt-2 btn btn-danger">Delete photo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3" data-gallery="0">
                            <label class="form-label">Galerija<span class="rem">X</span></label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="gallery-inputs">

                        </div>

                        <button type="button" class="btn btn-secondary --add--gallery">add gallery photo</button>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
