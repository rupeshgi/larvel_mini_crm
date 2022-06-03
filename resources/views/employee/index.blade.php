@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employee.create') }}"> Create New Employee</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" style="margin-top: 10px;">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered" style="margin-top: 20px;">
        <tr>
            <th>First Name </th>
            <th>Last Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Phone</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($empl as $emp)
        <tr>
            <td>{{ ucfirst($emp->first_name)}}</td>
            <td>{{ ucfirst($emp->last_name)}}</td>
            <td>{{ ucfirst($emp->name )}}</td>
            <td>{{ $emp->email }}</td>
            <td>{{ $emp->phone }}</td>

            </td>
            <td>
                <form action="{{ route('employee.destroy',$emp->id) }}" method="POST">
     
                <a class="btn btn-primary" href="{{ route('employee.edit',$emp->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    

 {{$empl->links('pagination::bootstrap-4')}}



</div>
@endsection