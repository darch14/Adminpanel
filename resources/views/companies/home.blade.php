@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>
                <div class="card-body">
                    <a href="{{ route('createCompany') }}" class="btn btn-success">Create new company</a>
                    <br><br>
                    <div class="card">
                        <div class="card-header">
                            Companies List
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td><img src="{{ asset('Storage/logos/'.$company->logo) }}" class="img-rounded" alt="" width="100" height="100"></td>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->email}}</td>
                                    <td>{{$company->website}}</td>
                                    <td>
                                        <a href="{{ route('listEmployee', $company->id) }}" class="btn btn-primary">
                                            View
                                        </a>
                                        <a href="{{ route('editCompany', $company->id) }}" class="btn btn-warning">
                                            Edit
                                        </a>
                                        <a href="{{ route('destroyCompany', $company->id) }}" onclick="return confirm('¿Seguro que desea eliminarlo?')" class="btn btn-danger">
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
