@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <button type="button" class="btn btn-primary mb-3" style="float: right;" onclick="window.location='{{ url("cargoes/departure/create") }}'">
        Pridėti
    </button>

    <div class="clearfix"></div>

    <div class="stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kroviniai</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th> Siuntėjas</th>
                            <th> Gavėjas</th>
                            <th> Krovinys</th>
                            <th> Kiekis</th>
                            <th> Svoris</th>
                            <th> Išvykimo data</th>
                            <th>
                                Veiksmai
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cargoes as $cargo)
                            <tr>

                                <td>{{ $cargo->id }}</td>
                                <td>{{ $cargo->shipper }}</td>
                                <td>{{ $cargo->receiver }}</td>
                                <td>{{ $cargo->name }}</td>
                                <td>{{ $cargo->amount }}</td>
                                <td>{{ $cargo->weight }}</td>
                                <td>{{ date('Y-m-d', strtotime($cargo->departure->departure_date)) }}</td>
                                <td class="actions">
                                    <button class="btn btn-primary" data-id="{{ $cargo->id }}" data-toggle="modal" data-target="#cargoDetails">
                                        <i class="mdi mdi-eye"></i>
                                    </button>

                                    <a href="{{ route('cargoes.edit', $cargo->id) }}" class="btn btn-success">
                                        <i class="mdi mdi-message-plus"></i>
                                    </a>

                                    <form action="{{ route('cargoes.destroy', $cargo->id)}}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <button class="btn btn-danger" type="submit">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cargoDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document"></div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#cargoDetails').on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget), modal = $(this);

            $.get('/cargoes/' + button.data('id')).done(function (r) {
                modal.find('.modal-dialog').html(r);
            });
        });
    </script>
@endsection
