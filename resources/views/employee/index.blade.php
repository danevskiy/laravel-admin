@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex; justify-content:space-between;"><span>{{ __('Employees') }}</span> <a href="/employees/create">Add new</a></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                <div>
                    @if(count($employees) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($employees as $employee)
                                <tr>
                                    <th scope="row">{{ $employee->id }}</th>
                                    <td>{{ $employee->first_name }}</td>
                                    <td><a href="/employees/{{ $employee->id }}">Edit</a></td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                     @else
                         <div>
                            <span>There are no any records yet</span>
                            <a href="/employees/create">Add new</a>

                        </div>
                     @endif

                    </div>
                   {{ $employees->links() }}
               
                
            </div>
        </div>
    </div>
</div>
@endsection
