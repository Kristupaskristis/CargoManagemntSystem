@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">Pridėti vartotoją</div>

        <div class="panel-body">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="emailInput">El. paštas*</label>
                    <input class="form-control" type="text" name="email" id="emailInput">
                </div>

                <div class="form-group">
                    <label for="passwordInput">Slaptažodis*</label>
                    <input class="form-control" type="password" name="password" id="passwordInput" required>
                </div>

                <div class="form-group">
                    <label for="passwordConfirmInput">Patvirtinti slaptažodį*</label>
                    <input id="passwordConfirmInput" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <label for="roleSelect">Rolė*</label>
                    <select id="roleSelect" name="role" class="form-control" required>
                        <option></option>

                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                </div>

                <hr>


                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="name">Vardas*</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>

                        <div class="form-group col-md-4">
                    <label for="surname">Pavardė*</label>
                    <input id="surname" type="text" class="form-control" name="surname" required>
                </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="company">Įmonė*</label>
                    <input class="form-control" type="text" name="company" id="company" required>
                </div>


                <div class="form-group col-md-4">
                    <label for="position">Pareigos*</label>
                    <input class="form-control" type="text" name="position" id="position" required>
                </div>
                </div>

                <div class="form-group">
                    <label for="phone_number">Telefono numeris*</label>
                    <input id="phone_number" type="text" class="form-control" name="phone_number" required>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Pridėti</button>
                </div>
            </form>
        </div>
    </div>
@endsection
