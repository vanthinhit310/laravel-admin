<?php


namespace App\Admin\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Str;

class FileuploadController extends Controller
{
    public function index(Request $request)
    {
        $image = $request->file('upload');
        $name = Str::uuid();
        $extension = $image->getClientOriginalExtension();
        $newname = $name . '.' . $extension;

        $image->storeAs('uploads', $newname, 'admin');
        $url = asset('storage/uploads') . DIRECTORY_SEPARATOR . $newname;

        $param = [
            'uploaded' => 1,
            'fileName' => $newname,
            'url' => $url
        ];

        return response()->json($param, 200);
    }
}
