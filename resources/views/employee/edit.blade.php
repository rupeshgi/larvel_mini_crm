@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Company</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employee.index') }}"> Back</a>
        </div>
    </div>
</div>
     
@if ($errors->any())
    <div class="alert alert-danger" style="margin-top: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     
<form action="{{ route('employee.update',$emp[0]->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
      @method('PUT')
    
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" name="first_name" class="form-control" value="{{ $emp[0]->first_name}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Last Name</strong>
                <input type="text" name="last_name" class="form-control" value="{{ $emp[0]->last_name}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company</strong>
                <select  name="company" class="form-select form-control" required>
                
                           @foreach($company as $value)
                           @if($emp[0]->company==$value->id)
                              <option selected value="{{$value->id}}">
                                 @else
                              <option  value="{{$value->id}}">
                                 @endif 
                                 {{$value->name}}
                              </option>

                           @endforeach 
                           
                        </select>   


            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email</strong>
                <input type="email" name="email" class="form-control" value="{{ $emp[0]->email}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone</strong>
                <input type="number" name="phone" class="form-control" value="{{ $emp[0]->phone}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
     
</form>

</div>
@endsection