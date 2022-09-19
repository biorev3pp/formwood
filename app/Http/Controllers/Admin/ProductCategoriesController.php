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
        $destination_path = public_path('media/components');
        if($request->file('image'))
        {
            $view1_file = $request->file('image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
        }

        else
        {
            $view1_name = null;
        }

        if($request->name)
        {
            $record = SheetTypes::create([
                'name'             => $request->name,
                'image'  => ($view1_name)?$view1_name:'',
                'status_id'         => $request->status
            ]);
            return $record;
        }
    }

    public function update(Request $request)
    {
        $record = SheetTypes::find($request->id);
        
        $record->name = $request->name;
        $record->status_id = $request->status;

        $destination_path = public_path('media/components');
        if($request->file('image'))
        {
            $view1_file = $request->file('image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
            $record->image = $view1_name;
        }

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
