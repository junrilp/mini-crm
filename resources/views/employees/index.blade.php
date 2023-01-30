@extends('layouts.app')

@section('content')
<div class="overflow-x-auto">
   <div class="w-full">
        <div class="bg-white shadow-md rounded my-6 p-3">
            <a href="{{ route('employees.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 border border-green-500 rounded">Add Employee</a>
            <table class="table min-w-max w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-center">Table No.</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $key => $employee)
                    <tr>
                        <td class="text-center">{{ $employees->firstItem() + $key }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->company->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td class="p-2 text-left block">
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}" />
                                <a href="/employees/{{ $employee->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded">Edit</a>
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded" onclick="return confirm('Are you sure to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">{{ $employees->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('.table').DataTable({
                "bPaginate": false,
                "bInfo": false, // hide showing entries
                columnDefs: [
                    // Center align the header content of column 1
                    { className: "dt-head-center", targets: [ 5 ] },
                    { className: "dt-body-center", targets: [ 5 ] }
                ]
            });
        } );
    </script>
@endsection