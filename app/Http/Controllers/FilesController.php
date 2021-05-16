<?php

namespace App\Http\Controllers;

use App\Models\CargoFile;

class FilesController extends Controller
{
    public function downloadHistory($id)
    {
        $file = CargoFile::find($id)->file;
        return \Storage::disk('public')->download($file);
    }
}
