@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

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
                            <th> Veiksmai
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
                                <td>{{ date('Y-m-d', strtotime($cargo->updated_at))}}</td>
                                <td class="actions">
                                    <button class="btn btn-primary" data-id="{{ $cargo->id }}" data-toggle="modal" data-target="#cargoDetails">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                    <button class="btn btn-success" data-id="{{ $cargo->id }}" data-toggle="modal" data-target="#cargoComment">
                                        <i class="mdi mdi-message-plus"></i>
                                    </button>

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
    <div class="modal fade" id="cargoDetails" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document"></div>
    </div>

    <div class="modal fade" id="cargoComment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pridėti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveComment">Išsaugoti</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
        $('#cargoComment').on('show.bs.modal', function (e) {
            $(this).find('form').attr('action', '/cargoes/' + $(e.relatedTarget).data('id') + '/comment');
        });

        $('#saveComment').on('click', function () {
            $('#cargoComment').find('form').submit();
        });
    </script>
@endsection
