@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Errors!</strong> Please fix errors below:
                        <ul>
                            {{-- $errors->all() возвращает массив всех сообщений об ошибках --}}
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <div>
                  
                        <form action="{{ route('companies-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Upload Image (Optional, min 100x100)</label>
                                <input 
                                    type="file" 
                                    name="logo" 
                                    id="image" 
                                    class="form-control"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="emailfield" class="form-label">Email address</label>
                                <input type="email"  name="email" class="form-control" id="emailfield" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" name="website" class="form-control" id="website" aria-describedby="website">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
