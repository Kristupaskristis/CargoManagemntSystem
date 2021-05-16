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
        <div class="panel-heading">Pridėti atvykimą</div>

        <div class="panel-body">
            <form action="{{ route('cargoes.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="shipper">Siuntėjas*</label>
                    <input class="form-control" type="text" name="shipper" id="shipper" placeholder="Įveskite krovinio siuntėją" required>
                </div>

                <div class="form-group">
                    <label for="receiver">Gavėjas*</label>
                    <input class="form-control" type="text" name="receiver" id="receiver" required>
                </div>

                <div class="form-group">
                    <label for="plate_number">Transporto priemonės numeriai* </label>
                    <input class="form-control" type="text" name="plate_number" id="plate_number" required>
                </div>

                <div class="form-group">
                    <label for="name">Krovinys* </label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="amount">Kiekis* </label>
                    <input class="form-control" type="text" name="amount" id="amount" required>
                </div>

                <div class="form-group">

                    <label for="weight">Svoris* </label>
                    <input class="form-control" type="number" name="weight" id="weight" placeholder="Svoris kilogramais" required>
                </div>

                <div class="form-group">
                    <label for="arrival_date">Atvykimo data*</label>
                    <input class="form-control" type="date" name="arrival_date" id="arrival_date" required>
                </div>

                <div class="form-group">
                    <label for="comment">Komentaras </label>
                    <textarea class="form-control" name="comment" id="comment"></textarea>
                </div>

                <div class="form-group">
                    <label for="files" class="btn btn-outline-info btn-fw btn-upload">
                        <i class="mdi mdi-upload"></i>
                        Įkelkite failus
                    </label>

                    <input type="file" name="files[]" class="form-control-files" id="files" multiple>
                    <span class="files-label">Failai nepasirinkti</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Pridėti</button>
                </div>
            </form>
        </div>
    </div>
@endsection
