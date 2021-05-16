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
        <div class="panel-heading">Pridėti išvykimą</div>

        <div class="panel-body">
            <form action="{{ route('cargoes.departure.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="cargoSearch">Krovinys</label>
                    <select class="form-control" id="cargoSearch" name="cargo_id"></select>
                </div>

                <div class="form-group">
                    <label for="plate_number">Transporto priemonės numeriai* </label>
                    <input class="form-control" type="text" name="plate_number" id="plate_number" required>
                </div>

                <div class="form-group">
                    <label for="arrival_date">Išvykimo data*</label>
                    <input class="form-control" type="date" name="departure_date" id="arrival_date" required>
                </div>

                <div class="form-group">
                    <label for="comment">Komentaras </label>
                    <textarea class="form-control" name="comment" id="comment" rows="12"></textarea>
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

@section('scripts')
    <script type="text/javascript">
        $('#cargoSearch').select2({
            placeholder: 'Pasirinkite krovinį',
            language: {
                noResults: function(){
                    return "Nėra rezultatų";
                },
                searching: function() {
                    return "Ieškoma...";
                }
            },
            ajax: {
                url: '/cargoes/search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: '[' + item.id + '] ' + item.shipper,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
