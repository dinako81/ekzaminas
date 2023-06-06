@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add Car Service</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('cats-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Car service title</label>
                            <input type="text" class="form-control" name="title" value={{old('title')}}>
                            <div class="form-text">Please add Car service title here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Car service address</label>
                            <input type="text" class="form-control" name="address" value={{old('address')}}>
                            <div class="form-text">Please add address here</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Car service pohpne number</label>
                            <input type="text" class="form-control" name="phoneNumber" value={{+370 - old('phoneNumber')}}>
                            <div class="form-text">Please add phone number here</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
