<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PanelSubstrates;
use App\Models\PanelThickness;
use Illuminate\Http\Request;

class PanelOptionsController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data['menu'] = 'components';        
    }

    public function index()
    {
        $this->data['nav'] = 'panel-options';
        $this->data['collection'] = PanelSubstrates::with(['status'])->get();
       return view('admin.components')->with($this->data);
    }

    public function storeSubstrate(Request $request)
    {
        $record = PanelSubstrates::create([
            'name'             => $request->name,
            'status_id'         => $request->status
        ]);
        return PanelSubstrates::with(['status'])->where('id', $record->id)->first();
    }

    public function updateSubstrate(Request $request)
    {
        $record = PanelSubstrates::find($request->id);
        
        $record->name = $request->name;
        $record->status_id = $request->status;

        $record->save();
        return PanelSubstrates::with(['status'])->where('id', $record->id)->first();
    }

    public function bulkActionSubstrate(Request $request)
    {
        $ids = explode(',', $request->bulk_records);
        if($request->bulk_action_type == 'stats') {
            if($request->bulk_status == 'publish') {
                $status = 1;
            } else {
                $status = 2;
            }
            PanelSubstrates::whereIn('id', $ids)->update(['status_id' =>  $status]);
        } 
        elseif($request->bulk_action_type == 'del') {
            PanelSubstrates::whereIn('id', $ids)->update(['status_id' =>  2]);
            PanelSubstrates::whereIn('id', $ids)->delete();
        }
        return ['success'];
    }

    public function destroySubstrate(Request $request)
    {
        $record = PanelSubstrates::find($request->id);
        $record->delete();
        return ['success']; 
    }

    public function thickness()
    {
        $this->data['nav'] = 'core-thickness';
        $this->data['collection'] = PanelThickness::with(['status'])->get();
       return view('admin.components')->with($this->data);
    }

    public function storeThickness(Request $request)
    {
        $record = PanelThickness::create([
            'name'             => $request->name,
            'status_id'         => $request->status
        ]);
        return PanelThickness::with(['status'])->where('id', $record->id)->first();
    }

    public function updateThickness(Request $request)
    {
        $record = PanelThickness::find($request->id);
        
        $record->name = $request->name;
        $record->status_id = $request->status;

        $record->save();
        return PanelThickness::with(['status'])->where('id', $record->id)->first();
    }

    public function bulkActionThickness(Request $request)
    {
        $ids = explode(',', $request->bulk_records);
        if($request->bulk_action_type == 'stats') {
            if($request->bulk_status == 'publish') {
                $status = 1;
            } else {
                $status = 2;
            }
            PanelThickness::whereIn('id', $ids)->update(['status_id' =>  $status]);
        } 
        elseif($request->bulk_action_type == 'del') {
            PanelThickness::whereIn('id', $ids)->update(['status_id' =>  2]);
            PanelThickness::whereIn('id', $ids)->delete();
        }
        return ['success'];
    }

    public function destroyThickness(Request $request)
    {
        $record = PanelThickness::find($request->id);
        $record->delete();
        return ['success']; 
    }
}
