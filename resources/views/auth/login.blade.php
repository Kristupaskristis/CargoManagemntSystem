@extends('layouts.auth')
@section('content')

    <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one"
         style="background-image: url({{ url('img/login_2.jpg') }}); background-size: cover;">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="auto-form-wrapper">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="label">El. paštas</label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="El. paštas" required>

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                      <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Slaptažodis</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="*********" required>

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                      <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary submit-btn btn-block">Prisijungti</button>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="form-check form-check-flat mt-0">
                                <input type="checkbox" class="form-check-input" id="keepSignedIn" checked>
                                <label class="form-check-label" for="keepSignedIn">Prisiminti</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
