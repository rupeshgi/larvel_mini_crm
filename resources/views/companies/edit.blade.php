@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Company</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('company.index') }}"> Back</a>
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
     
<form action="{{ route('company.update',$companies[0]->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company Name:</strong>
                <input type="text" name="name" class="form-control" value="{{$companies[0]->name}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email</strong>
                <input type="email" name="email" class="form-control" value="{{$companies[0]->email}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Website</strong>
                <input type="text" name="website" class="form-control" value="{{$companies[0]->website}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company Logo:</strong>
                <input type="file" name="company_logo" class="form-control" placeholder="image">
                <img src="{{asset('/storage/images/'.$companies[0]->company_logo)}}" width="100px" style="margin-top: 20px;">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">update</button>
        </div>
    </div>
     
</form>

</div>
@endsection