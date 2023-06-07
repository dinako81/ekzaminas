@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Pridėti naują restoraną</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('cats-store')}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Restorano pavadinimas</label>
                            <input type="text" class="form-control" name="title" value={{old('title')}}>
                            <div class="form-text">Įveskite restorano pavadinimą</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Restorano kodas</label>
                            <input type="text" class="form-control" name="code" value={{old('code')}}>
                            <div class="form-text">Įveskite restorano kodą</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Restorano adresas</label>
                            <input type="text" class="form-control" name="address" value={{old('address')}}>
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
