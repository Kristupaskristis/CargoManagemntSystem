@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="clearfix"></div>

    <div class="panel panel">
        <div class="col-lg-12 stretch-card">
            <h4 class="card-title">Kroviniai</h4>
            <div class="table-responsive">
                <div class="panel-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td>El. paštas</td>
                                    <td>Vardas</td>
                                    <td>Pavardė</td>
                                    <td>Įmonė</td>
                                    <td>Pareigos</td>
                                    <td>Telefono numeris</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->user_info->name }}</td>
                                        <td>{{ $cargo->user_info->surname }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
