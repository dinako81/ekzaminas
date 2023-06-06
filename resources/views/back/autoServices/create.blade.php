@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add Service</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('services-store')}}" method="post">

                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Service Tile</label>
                                        <input type="text" class="form-control" name="title" value={{old('title')}}>
                                        <div class="form-text">Please add service title here</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Service Duration</label>
                                        <input type="text" class="form-control" name="duration" value={{old('duration')}}>
                                        <div class="form-text">Please add duration here</div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Service Price</label>
                                        <input type="text" class="form-control" name="price" value={{old('price')}}>
                                        <div class="form-text">Please add service here</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Car Service List</label>
                                        <select class="form-select" name="cat_id">
                                            {{-- <option value="0">Car services list</option> --}}
                                            @foreach($cats as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Please select car service</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="mt-5 btn btn-outline-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
