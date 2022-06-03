@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('company.create') }}"> Create New Company</a>
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
            <th>Name</th>
            <th>email</th>
            <th>website</th>
            <th>company_logo</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($companys as $company)
        <tr>
            <td>{{ ucfirst($company->name) }}</td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->website }}</td>
<td><img src="{{asset('/storage/images/'.$company->company_logo)}}" width="80px">

            </td>
            <td>
                <form action="{{ route('company.destroy',$company->id) }}" method="POST">
     
                    
      
<a class="btn btn-primary" href="{{ route('company.edit',$company->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    

    {{$companys->links('pagination::bootstrap-4')}}



</div>
@endsection