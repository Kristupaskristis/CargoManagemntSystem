@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <a href="{{ url('users/create') }}" class="btn btn-primary mb-3 float-right">Pridėti</a>

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body"><h4 class="card-title">Vartotojai</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>El.paštas</td>
                                    <td>Rolė</td>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles[0]->display_name}}</td>


                                        {{--                                <td>--}}
                                        {{--                                      <a href="{{ route('products.edit', $cargo->id) }}" class="btn btn-primary">--}}
                                        {{--                                        Edit--}}
                                        {{--                                    </a>--}}
                                        {{--                                </td>--}}
                                        {{--                                <td>--}}
                                        {{--                                    <form action="{{ route('products.destroy', $cargo->id)}}" method="POST">--}}
                                        {{--                                        <input type="hidden" name="_method" value="DELETE">--}}
                                        {{--                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                        {{--                                        <button class="btn btn-danger" type="submit">Delete</button>--}}
                                        {{--                                    </form>--}}
                                        {{--                                </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>
@endsection



