<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\CargoArrival;
use App\Models\CargoComment;
use App\Models\CargoDeparture;
use App\Models\CargoFile;
use App\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CargoController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'shipper'      => 'required',
            'receiver'     => 'required',
            'plate_number' => 'required',
            'name'         => 'required',
            'amount'       => 'required',
            'weight'       => 'required|integer|min:0',
            'arrival_date' => 'required',
            'files.*'      => 'mimes:pdf,jpg,jpeg,png,doc,docx,txt|max:2048',
        ]);

        $cargo = new Cargo([
            'user_id'  => Auth::id(),
            'status'   => App::CARGO_STATUS_SHIPPED,
            'shipper'  => $request->get('shipper'),
            'receiver' => $request->get('receiver'),
            'name'     => $request->get('name'),
            'amount'   => $request->get('amount'),
            'weight'   => $request->get('weight'),
        ]);

        $cargo->save();

        $arrival = new CargoArrival([
            'cargo_id'     => $cargo->id,
            'user_id'      => Auth::id(),
            'plate_number' => $request->get('plate_number'),
            'arrival_date' => date('Y-m-d H:i:s', strtotime($request->get('arrival_date'))),
        ]);

        $arrival->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $file = new CargoFile([
                    'cargo_id' => $cargo->id,
                    'user_id'  => Auth::id(),
                    'file'     => $filePath,
                ]);

                $file->save();
            }
        }

        if ($request->get('comment')) {
            $comment = new CargoComment([
                'cargo_id' => $cargo->id,
                'user_id'  => Auth::id(),
                'comment'  => $request->get('comment'),
            ]);

            $comment->save();
        }

        return redirect('/cargoes/arrival')->with('success', 'Krovinio atvykimas pridėtas');
    }

    public function create()
    {
        return view('cargoes.create');
    }

    public function departureCreate()
    {
        return view('cargoes.departure_create');
    }

    public function departureStore(Request $request)
    {
        $this->validate($request, [
            'cargo_id'       => 'required|exists:cargoes,id',
            'plate_number'   => 'required',
            'departure_date' => 'required',
        ]);

        $departure = new CargoDeparture([
            'cargo_id'       => $request->cargo_id,
            'user_id'        => Auth::id(),
            'plate_number'   => $request->plate_number,
            'departure_date' => $request->departure_date,
        ]);

        $departure->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $file = new CargoFile([
                    'cargo_id' => $request->cargo_id,
                    'user_id'  => Auth::id(),
                    'file'     => $filePath,
                ]);

                $file->save();
            }
        }

        if ($request->get('comment')) {
            $comment = new CargoComment([
                'cargo_id' => $request->cargo_id,
                'user_id'  => Auth::id(),
                'comment'  => $request->get('comment'),
            ]);

            $comment->save();
        }

        return redirect('/cargoes/departure')->with('success', 'Krovinio išvykimas pridėtas');
    }

    public function edit($id)
    {
        $cargo = Cargo::find($id);

        return view('cargoes.edit', [
            'cargo' => $cargo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'sometimes|in:' . implode(',', App::CARGO_STATUSES),
        ]);

        $cargo = Cargo::find($id);

        if ($request->get('status')) {
            $cargo->status = $request->get('status');
        }

        $cargo->save();

        return Redirect::back()->with('success', 'Krovinys atnaujintas!');
    }

    public function destroy($id)
    {
        $cargo = Cargo::find($id);

        try {
            $cargo->arrival()->delete();
            $cargo->departure()->delete();
            $cargo->files()->delete();
            $cargo->comments()->delete();
            $cargo->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('/products')->with('error', 'Cannot delete record due to use as foreign key!');
        }

        return redirect('/cargoes/arrival')->with('success', 'Krovinys ištrintas!');
    }

    public function arrival()
    {
        $cargoes = Cargo::where('status', App::CARGO_STATUS_SHIPPED)->orderBy('id', 'desc')->get();

        return view('cargoes.arrival', compact('cargoes'));
    }

    public function departure()
    {
        $cargoes = Cargo::has('departure')->orderBy('id', 'DESC')->get();

        return view('cargoes.departure', compact('cargoes'));
    }
    public function history()
    {
        $cargoes = Cargo::where('status', App::CARGO_STATUS_DEPARTURED)->orderBy('id', 'desc')->get();

        return view('cargoes.history', compact('cargoes'));
    }

    public function terminal()
    {
        $cargoes = Cargo::where('status', App::CARGO_STATUS_ARRIVED)->orderBy('id', 'desc')->get();

        return view('cargoes.terminal', compact('cargoes'));
    }

    public function show($id)
    {
        $cargo = Cargo::find($id);

        return view('cargoes.partials.details', [
            'cargo' => $cargo,
        ]);
    }

    public function comment(Request $request, $id)
    {
        $cargo = Cargo::find($id);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $file = new CargoFile([
                    'cargo_id' => $cargo->id,
                    'user_id'  => Auth::id(),
                    'file'     => $filePath,
                ]);

                $file->save();
            }
        }

        if ($request->get('comment')) {
            $comment = new CargoComment([
                'cargo_id' => $cargo->id,
                'user_id'  => Auth::id(),
                'comment'  => $request->get('comment'),
            ]);

            $comment->save();
        }

        return Redirect::back()->with('success', 'Įrašas pridėtas!');
    }

    public function search(Request $request)
    {
        $cargoes = [];

        if ($request->has('q')) {
            $search = $request->q;

            $cargoes = Cargo::select('id', 'shipper')
                ->whereIn('status', [App::CARGO_STATUS_SHIPPED, App::CARGO_STATUS_ARRIVED])
                ->where(function ($q) use ($search) {
                    $q
                        ->where('shipper', 'LIKE', "%$search%")
                        ->orWhere('id', $search);
                })->get();
        }

        return response()->json($cargoes);
    }
}
