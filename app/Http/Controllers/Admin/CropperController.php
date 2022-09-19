<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CropperController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data['nav'] = 'backers';
       return view('admin.cropper')->with($this->data);
    }

    public function upload(Request $request)
    {
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.png';

        file_put_contents($file, $image_base64);

        return response()->json(['success'=>'success']);
    }
}
