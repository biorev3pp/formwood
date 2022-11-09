<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuts;

class CutsController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data['menu'] = 'components';                 
    }

    public function index()
    {
       $this->data['nav'] = 'cuts';
       $this->data['collection'] = Cuts::with('status')->get();
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
            $record = Cuts::create([
                'name'      => $request->name,
                'remark'      => $request->remark,
                'image'     => ($file)?$file:'',
                'status_id' => $request->status
            ]);
            return $record;
        }
    }

    public function update(Request $request, $id = null)
    {
        $record = Cuts::find($request->id);
        $record->name = $request->name;
        $record->remark = $request->remark;
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

    public function bulkAction(Request $request)
    {
        $ids = explode(',', $request->bulk_records);
        if($request->bulk_action_type == 'stats') {
            if($request->bulk_status == 'publish') {
                $status = 1;
            } else {
                $status = 2;
            }
            Cuts::whereIn('id', $ids)->update(['status_id' =>  $status]);
        } 
        elseif($request->bulk_action_type == 'del') {
            Cuts::whereIn('id', $ids)->update(['status_id' =>  2]);
            Cuts::whereIn('id', $ids)->delete();
        }
        return ['success'];
    }

    public function destroy(Request $request)
    {
        $record = Cuts::find($request->id);
        $record->delete();  
        return ['success'];
    }
}
