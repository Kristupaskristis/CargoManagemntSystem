<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{ $cargo->shipper }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="meta">
            <div class="row">
                <div class="col-2">ID</div>
                <div class="col-10">{{ $cargo->id }}</div>
            </div>

            <div class="row">
                <div class="col-2">Kliento el. paštas</div>
                <div class="col-10">{{ $cargo->user->email }}</div>
            </div>

            @if ($cargo->arrival)
                <div class="row">
                    <div class="col-2">Atvykimo numeriai</div>
                    <div class="col-10">{{ $cargo->arrival->plate_number }}</div>
                </div>
            @endif

            @if ($cargo->departure)
                <div class="row">
                    <div class="col-2">Išvykimo numeriai</div>
                    <div class="col-10">{{ $cargo->departure->plate_number }}</div>
                </div>
            @endif

            <div class="row">
                <div class="col-2">Krovinys</div>
                <div class="col-10">{{ $cargo->name }}</div>
            </div>

            <div class="row">
                <div class="col-2">Kiekis</div>
                <div class="col-10">{{ $cargo->amount }}</div>
            </div>

            <div class="row">
                <div class="col-2">Svoris</div>
                <div class="col-10">{{ $cargo->weight }}</div>
            </div>
        </div>

        @if ($cargo->files->isNotEmpty())
            <hr>

            <div class="files">
                <div class="row">
                    <div class="col-2">Įkelti failai</div>
                    <div class="col-10">
                        <ul>
                            @foreach ($cargo->files as $file)
                                <li>
                                    <a href="{{ route('files.download', $file->id) }}">{{ basename($file->file) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if ($cargo->comments->isNotEmpty())
            <hr>

            <div class="history">
                <div class="row">
                    <div class="col-2">Komentarai</div>
                    <div class="col-10">
                        @foreach($cargo->comments as $comment)
                            <div class="comment">
                                <b>{{ $comment->user->email }}</b>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    @role('admin')
        <div class="modal-footer">
            <form action="{{ route('cargoes.update', $cargo->id) }}" method="post">
                {{ csrf_field() }}

                @if ($cargo->isShipped())
                        <input type="hidden" name="status" value="{{ App::CARGO_STATUS_ARRIVED }}">

                        <button class="btn btn-info">
                            Atvyko
                        </button>
                    </form>
                @endif

                @if ($cargo->isArrived())
                    <input type="hidden" name="status" value="{{ App::CARGO_STATUS_DEPARTURED }}">

                    <button class="btn btn-info">
                        Išvyko
                    </button>
                @endif
            </form>
        </div>
    @endrole
</div>
