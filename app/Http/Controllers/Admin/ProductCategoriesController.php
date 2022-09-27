<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SheetTypes;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data['menu'] = 'components';                 
    }

    public function index()
    {
       $this->data['nav'] = 'product-categories';
       $this->data['collection'] = SheetTypes::with('status')->get();
       return view('admin.components')->with($this->data);
    }

    public function store(Request $request)
    {
        $destination_path = public_path('media/components/');

        if($request->image):
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = uniqid() . '.'.$image_type;
            file_put_contents($destination_path.$file, $image_base64);
        else:
            $file = null;
        endif;

        if($request->name)
        {
            $record = SheetTypes::create([
                'name'      => $request->name,
                'image'     => ($file)?$file:'',
                'status_id' => $request->status
            ]);
            return $record;
        }
    }

    public function update(Request $request)
    {
        $record = SheetTypes::find($request->id);
        
        $record->name = $request->name;
        $record->status_id = $request->status;

        $destination_path = public_path('media/components/');
        
        if($request->image && $request->image != null && $request->image != 'null'):
            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = uniqid() . '.'.$image_type;
            file_put_contents($destination_path.$file, $image_base64);
            $record->image = $file;
        endif;

        $record->save();
        return $record;
    }

    public function destroy(Request $request)
    {
        $record = SheetTypes::find($request->id);
        $record->delete();  
        return ['success'];
    }
}
