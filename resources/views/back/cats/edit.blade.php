@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Edit Category</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('cats-update', $cat)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Car servise title</label>
                            <input type="text" class="form-control" name="title" value={{old('title', $cat->title)}}>
                            <div class="form-text">Please add car service title here</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Car service pohpne number</label>
                            <input type="text" class="form-control" name="code" value={{old('code', $cat->code)}}>
                            <div class="form-text">Please add phone number here</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Car service address</label>
                            <input type="text" class="form-control" name="address" value={{old('address', $cat->address)}}>
                            <div class="form-text">Please add address here</div>
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
