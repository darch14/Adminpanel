@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Edit Employee
        </div>
        <div class="card-body">
            @include('fragment.message')
            <form class="form-horizontal" action="{{route('updateEmployee', $employee->id)}}" role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" class="form-control" id="inputFirstName" maxlength="29" value="{{$employee->first_name}}" placeholder="FirstName">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="last_name" class="form-control" id="inputLastName" maxlength="29" value="{{$employee->last_name}}" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail" maxlength="39" value="{{$employee->email}}" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="number" name="phone" class="form-control" id="inputphone" max="999999999" value="{{$employee->phone}}" placeholder="Phone">
                    </div>
                </div>
                <input type="text" hidden name="company_id" value="{{$employee->company_id}}">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{route('listEmployee', $employee->company_id)}}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection