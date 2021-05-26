@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif


    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body"><h4 class="card-title">Vartotojai</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>El.paštas</td>
                        <td>Vardas</td>
                        <td>Pavardė</td>
                        <td>Įmonė</td>
                        <td>Pareigos</td>
                        <td>Telefono numeris</td>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->info['name']}}</td>
                            <td>{{ $client->info['surname']}}</td>
                            <td>{{ $client->info['company']}}</td>
                            <td>{{ $client->info['position']}}</td>
                            <td>{{ $client->info['phone_number']}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection



