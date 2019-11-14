@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Create Employee
        </div>
        <div class="card-body">
            @include('fragment.message')
            <form class="form-horizontal" action="{{route('storeEmployee')}}" role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" class="form-control" id="inputFirstName" maxlength="29" placeholder="FirstName">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="last_name" class="form-control" id="inputLastName" maxlength="29" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" maxlength="39" id="inputEmail" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="number" name="phone" class="form-control"  max="999999999" id="inputphone" placeholder="Phone">
                    </div>
                </div>
                <input type="text" hidden name="company_id" value="{{$company->id}}">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{route('listEmployee', $company->id)}}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection