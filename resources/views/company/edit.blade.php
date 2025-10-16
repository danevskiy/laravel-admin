@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Company edit') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                <div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Errors!</strong> Please fix errors below:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <div>
                  
                        <form action="{{ route('company.update', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value="{{$data->name}}" name="name" class="form-control" id="name" aria-describedby="name">
                            </div>
                            <div class="mb-3">
                                @if($data->logo)
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $data->logo) }}" class="rounded w-50" alt="logo">
                                </div>
                                @endif
                                <label for="logo" class="form-label">Upload new Logo or Update existing (Optional, min 100x100)</label>
                                <input 
                                    type="file" 
                                    name="logo" 
                                    id="image" 
                                    class="form-control"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="emailfield" class="form-label">Email address</label>
                                <input type="email" value="{{$data->email}}"  name="email" class="form-control" id="emailfield" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" value="{{$data->website}}" name="website" class="form-control" id="website" aria-describedby="website">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
