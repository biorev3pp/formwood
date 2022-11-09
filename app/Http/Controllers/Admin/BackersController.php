<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backers;
use App\Models\SheetTypes;

class BackersController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data['menu'] = 'components';
        $this->data['categories'] = SheetTypes::orderBy('id', 'desc')->get();
    }

    public function index()
    {
        $this->data['nav'] = 'backers';
        $this->data['collection'] = Backers::with(['status', 'category'])->get();
        return view('admin.components')->with($this->data);
    }

    public function store(Request $request)
    {
        $record = Backers::create([
            'sheet_type_id'     => $request->sheet_type_id,
            'name'             => $request->name,
            'remark'            => $request->remark,
            'status_id'         => $request->status
        ]);
        return Backers::with(['status', 'category'])->where('id', $record->id)->first();
    }

    public function update(Request $request)
    {
        $record = Backers::find($request->id);
        
        $record->sheet_type_id = $request->sheet_type_id;
        $record->name = $request->name;
        $record->remark = $request->remark;
        $record->status_id = $request->status;
        $record->save();
        return Backers::with(['status', 'category'])->where('id', $record->id)->first();
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
            Backers::whereIn('id', $ids)->update(['status_id' =>  $status]);
        }
        elseif($request->bulk_action_type == 'del') {
            Backers::whereIn('id', $ids)->update(['status_id' =>  2]);
            Backers::whereIn('id', $ids)->delete();
        }
        return ['success'];
    }

    public function destroy(Request $request)
    {
        $record = Backers::find($request->id);
        $record->delete();
        return ['success']; 
    }
}
