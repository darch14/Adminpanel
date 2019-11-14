@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> company employees {{$company->name}}</div>
                <div class="card-body">
                    <a href="{{route('home')}}" class="btn btn-danger">Back</a>
                    <a href="{{ route('createEmployee', $company->id) }}" class="btn btn-success">Create new employee</a>
                    <br><br>
                    <div class="card">
                        <div class="card-header">
                            Employees List
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->first_name.' '.$employee->last_name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                    <td>
                                        <a href="{{ route('editEmployee', $employee->id) }}" class="btn btn-warning">
                                            Edit
                                        </a>
                                        <a href="{{ route('destroyEmployee', $employee->id) }}" onclick="return confirm('¿Seguro que desea eliminarlo?')" class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            {{$render}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection