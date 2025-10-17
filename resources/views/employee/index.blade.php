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
                   
                     <table id="myTable" class="table table-bordered data-table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                   

                    </div>
                 
               
                
            </div>
        </div>
    </div>
</div>
        <script>
    $(document).ready( function () {
       const company_table = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('employees')}}",
        columns: [
        {data: 'id', name: 'id'},
        {data: 'first_name', name: 'first_name'},
        {data: 'action', name: 'action', orderable:false, searchable:false}
        ]
        });

        $('table').on('click', '.delete-it', function(){
            const id = $(this).data('id');
            if(id && confirm('Are you sure, you want to delete ?')){
                $.ajax({
                    url: `{{ url('employees/delete') }}/${id}`,
                    method:'DELETE',
                    data: {
                    _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status === 'success'){
                        company_table.ajax.reload(null, false);
                        } else{
                            alert(response.message)
                        }
                    },
                    error: function(error) {
                         alert('Something went wrong')
                    }
                })
            }
        })
    } );
    </script>
@endsection
