@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Edit Service</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('menus-update', $menu)}}" method="post">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Menu pavadinimas</label>
                                        <input type="text" class="form-control" name="title" value={{old('title', $menu->title)}}>
                                        <div class="form-text">Įveskite menu pavadinima</div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Car Service List:</label>
                                        <select class="form-select" name="cat_id">
                                            @foreach($cats as $cat)
                                            <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Please select Car Service</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="mt-5 btn btn-outline-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
