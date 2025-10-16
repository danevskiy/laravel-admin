@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee create') }}</div>

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
                  
                        <form action="{{ route('employee.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" aria-describedby="first_name">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name">
                            </div>
                            <div class="mb-3">
                                <label for="emailfield" class="form-label">Email address</label>
                                <input type="email"  name="email" class="form-control" id="emailfield" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phone">
                            </div>

                            <select class="mb-3 form-select form-select-lg" name="company_id" aria-label="companies">
                                <option selected value="">Select company</option>
                                 @foreach ($companies as $company)
                                  <option value="{{ $company->id }}">{{ $company->name }}</option>
                                 @endforeach  
                            </select>



                           
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
