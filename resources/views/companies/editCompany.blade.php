@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{route('updateCompany'. $company->id)}}" role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$company->name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{$company->email}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputWebsite" class="col-sm-2 control-label">Website</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputWebsite" placeholder="Website" value="{{$company->website}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputFileLogo">Logo</label>
        <input type="file" id="inputFileLogo">
        <p class="help-block"></p>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection