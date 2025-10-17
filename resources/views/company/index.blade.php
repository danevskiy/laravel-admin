@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex; justify-content:space-between;"><span>{{ __('Companies') }}</span> <a href="/companies/create">Add new</a></div>

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
        ajax: "{{route('companies')}}",
        columns: [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'action', name: 'action', orderable:false, searchable:false}
        ]
        });

        $('table').on('click', '.delete-user', function(){
            const userId = $(this).data('id');
            if(userId && confirm('Are you sure, you want to delete ?')){
                $.ajax({
                    url: `{{ url('companies/delete') }}/${userId}`,
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
