<?php

namespace App\Http\Controllers;

use App\App;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cargoes = Cargo::count();
        $terminal = Cargo::where('status', App::CARGO_STATUS_ARRIVED)->count();
        $arrival = Cargo::where('status', App::CARGO_STATUS_SHIPPED)->count();
        $departure = Cargo::where('status', App::CARGO_STATUS_DEPARTURED)->count();
        $clients = User::role("client")->count();

        return view('dashboard', [
            'clients'   => $clients,
            'terminal'  => $terminal,
            'cargoes'   => $cargoes,
            'departure' => $departure,
            'arrival'   => $arrival,
        ]);
    }
}
