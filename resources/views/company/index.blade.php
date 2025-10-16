@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex; justify-content:space-between;"><span>{{ __('Company') }}</span> <a href="/companies/create">Add new</a></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                <div>
                    @if(count($companies) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($companies as $company)
                                <tr>
                                    <th scope="row">{{ $company->id }}</th>
                                    <td>{{ $company->name }}</td>
                                    <td><a href="/companies/{{ $company->id }}">Edit</a></td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                     @else
                         <div>
                            <span>There are no any records yet</span>
                            <a href="/companies/create">Add new</a>

                        </div>
                     @endif

                    </div>
                   {{ $companies->links() }}
               
                
            </div>
        </div>
    </div>
</div>
@endsection
