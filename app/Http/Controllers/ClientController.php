<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ClientController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function clients()
    {


        $clients = User::role("client")->get();

        return view('clients', [
            'clients'   => $clients,


        ]);
    }
}
