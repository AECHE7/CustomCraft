<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'design_file' => 'required|file|mimes:jpeg,png|max:5120',
        ]);

        $file = $request->file('design_file');
        $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('designs', $fileName, 'local');

        return response()->json(['file_path' => $filePath]);
    }
}
