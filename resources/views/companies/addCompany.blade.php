@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Create Company
        </div>
        <div class="card-body">
            @include('fragment.message')
            <form class="form-horizontal" action="{{route('storeCompany')}}" role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputWebsite" class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-10">
                        <input type="text" name="website" class="form-control" id="inputWebsite" placeholder="Website">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFileLogo">Logo</label>
                    <input type="file" name="file" id="inputFileLogo">
                    <p class="help-block"></p>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{route('home')}}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection