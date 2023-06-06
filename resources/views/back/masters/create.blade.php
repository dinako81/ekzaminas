@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add Master</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('masters-store')}}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Master name</label>
                            <input type="text" class="form-control" name="name" value={{old('name')}}>
                            <div class="form-text">Please add Master name here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Master surname</label>
                            <input type="text" class="form-control" name="surname" value={{old('surname')}}>
                            <div class="form-text">Please add Master surname here</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Car Service List</label>
                            <select class="form-select" name="cat_id">
                                <option value="0">Car Service List</option>
                                @foreach($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Please select provided service</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Master photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>

                        {{--
                        <div class="mb-3" data-gallery="0">
                            <label class="form-label">Gallery photo <span class="rem">X</span></label>
                            <input type="file" class="form-control">
                        </div>

                        <div class="gallery-inputs">

                        </div>

                        <button type="button" class="btn btn-secondary --add--gallery">add gallery photo</button> --}}

                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
