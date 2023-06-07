@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Edit Master</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('masters-update', $master)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Master Name</label>
                            <input type="text" class="form-control" name="name" value={{old('name', $master->name)}}>
                            <div class="form-text">Please add master name here</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Master surname</label>
                            <input type="text" class="form-control" name="surname" value={{old('surname', $master->surname)}}>
                            <div class="form-text">Please add Master surname here</div>
                        </div>

                        <div class="mb-3">

                            <select class="form-select" name="cat_id">
                                <option value="0">Car Service List</option>
                                @foreach($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Please select car service</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Master photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>

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
