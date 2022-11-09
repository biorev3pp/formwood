<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Backers;
use Illuminate\Http\Request;
use App\Models\Species;
use App\Models\Cuts;
use App\Models\SpeciesCuts;
use App\Models\CutsQualities;
use App\Models\EstimateProducts;
use App\Models\Estimates;
use App\Models\Matchings;
use App\Models\PanelSubstrates;
use App\Models\PanelThickness;
use App\Models\Qualities;
use App\Models\Settings;
use App\Models\SheetTypes;
use App\Models\Sizes;
use App\Models\SizesBackers;

class FrontendController extends Controller
{
    public function index()
    {
        $settings = [];
        $ss =  Settings::where('status', 1)->get();
        foreach ($ss as $v) {
            $settings[$v->name] = $v->value;
        }
        return base64_encode(json_encode($settings));
    }

    public function speciesData()
    {
        $species = Species::where('status_id', 1)->get();
        return base64_encode(json_encode($species));
    }

    public function categoryData()
    {
        $records['category'] = SheetTypes::where('status_id', 1)->get();
        $records['sizes'] = Sizes::where('status_id', 1)->get();
        return base64_encode(json_encode($records));
    }

    public function cutsData($sid = null)
    {
        $species = Species::whereId(base64_decode($sid))->first();
        $cuts = Cuts::where('status_id', 1)->whereIn('id', explode(',',$species->cuts))->get();
        return base64_encode(json_encode($cuts));
    }

    public function qualityData($sid = null)
    {
        $species = Species::whereId(base64_decode($sid))->first();
        $quality = Qualities::where('status_id', 1)->whereIn('id', explode(',',$species->qualities))->get();
        return base64_encode(json_encode($quality));
    }

    public function matchingsData($cid = null)
    {
        $cuts = Cuts::whereId(base64_decode($cid))->first();
        $matchings = Matchings::where('status_id', 1)->whereIn('id', explode(',',$cuts->matchings))->get();
        return base64_encode(json_encode($matchings));
    }

    public function panelOptionsData()
    {
        $records['substrates'] = PanelSubstrates::where('status_id', 1)->get();
        $records['thickness'] = PanelThickness::where('status_id', 1)->get();
        return base64_encode(json_encode($records));
    }

    public function backersData($sid = null)
    {
        $size = Sizes::whereId(base64_decode($sid))->first();
        if($size && $size->sheet_type_id == 1) {
            $backers = Backers::where('sheet_type_id', 1)->get();
        } else {
            $szb = SizesBackers::where('size_id', $size->id)->get()->pluck('backer_id')->toArray();
            $backers = Backers::whereIn('id', $szb)->get();
        }
        return base64_encode(json_encode($backers));
    }

    public function getItemString(Request $request)
    {
        $data = json_decode(base64_decode($request->string));
        $return = [];
        array_push($return, $this->__setString($data->current_item));
        if(count($data->items) >= 1) {
            foreach ($data->items as $value) {
                array_push($return, $this->__setString($value));
            }
        }
        return base64_encode(json_encode($return));
    }

    public function submitQuery(Request $request)
    {
        $files = [];
        $customer = json_decode(base64_decode($request->cr));
        $current_item = json_decode(base64_decode($request->ci));
        $items = json_decode(base64_decode($request->it));

        if($request->attachments && count($request->attachments) >= 1)
        {
            $destination_path = public_path('attachments/');
            foreach ($request->attachments as $key => $value) 
            {
                $name = 'E'.$key. uniqid().'.'. $value->getClientOriginalExtension();
                $value->move($destination_path, $name);
                array_push($files, $name);
            }
            $files = implode(',', $files);
        } 
        else {
            $files = '';
        }

        $estimate = Estimates::create([
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => ($customer->phone)?$customer->phone:NULL,
            'company' => ($customer->company)?$customer->company:NULL,
            'address_line1' => ($customer->address_line_1)?$customer->address_line_1:NULL,
            'address_line2' => ($customer->address_line_2)?$customer->address_line_2:NULL,
            'city' => ($customer->city)?$customer->city:NULL,
            'state' => ($customer->state)?$customer->state:NULL,
            'postal_code' => ($customer->postal_code)?$customer->postal_code:NULL,
            'country' => ($customer->country)?$customer->country:NULL,
            'remarks' => ($customer->remarks)?$customer->remarks:NULL,
            'attachments' => $files
        ]);
        $this->__setCart($estimate->id, $current_item);
        
        if(count($items) >= 1) {
            foreach ($items as $value) {
                $this->__setCart($estimate->id, $value);
            }
        }
        return ['status' => 'success'];
    }

    public function __setString($obj = null)
    {
        $seprator = ' - ';
        $s[] = ($obj->species_id)?Species::whereId($obj->species_id)->first()->name:'No Specie';
        $s[] = ($obj->cut_id)?Cuts::whereId($obj->cut_id)->first()->name:'No Cut';
        $s[] = ($obj->quality_id)?Qualities::whereId($obj->quality_id)->first()->name:'No Quality';
        $s[] = ($obj->matching_id)?Matchings::whereId($obj->matching_id)->first()->name:'No matching';
        $s[] = ($obj->sheet_type_id)?SheetTypes::whereId($obj->sheet_type_id)->first()->name:'No Product Category';
        if(isset($obj->size_id)) {
            if($obj->size_id === 0) {
                $s[] = 'Custom Size: '.$obj->custom_width.'x'.$obj->custom_length.' Inch';
            } elseif($obj->size_id >= 1) { 
                $s[] = 'Size: '.Sizes::whereId($obj->size_id)->first()->width.'x'.Sizes::whereId($obj->size_id)->first()->length.' Inch';
            } else {
                $s[] = 'No Size';    
            }
        } else {
            $s[] = 'No Size';
        }
        $s[] = 'Quantity: '.$obj->quantity;
        if(isset($obj->sheet_type_id) && $obj->sheet_type_id == 1) {
            $s[] = ($obj->panel_substrate_id)?PanelSubstrates::whereId($obj->panel_substrate_id)->first()->name:'No Substrate';
            $s[] = ($obj->panel_thickness_id)?PanelThickness::whereId($obj->panel_thickness_id)->first()->name:'No Core Thickness';
        } else {
            $s[] = 'No Panel Options';
        }
        $s[] = ($obj->backer_id)?Backers::whereId($obj->backer_id)->first()->name:'No Backer';
        return implode($seprator, $s);
    }

    public function __setCart($id, $obj = null)
    {
        if($obj->species_id && $obj->cut_id) {
            EstimateProducts::create([
                'estimate_id' => $id,
                'species_id' => ($obj->species_id)?$obj->species_id:NULL,
                'cut_id' => ($obj->cut_id)?$obj->cut_id:NULL,
                'quality_id' => ($obj->quality_id)?$obj->quality_id:NULL,
                'matching_id' => ($obj->matching_id)?$obj->matching_id:NULL,
                'sheet_type_id' => ($obj->sheet_type_id)?$obj->sheet_type_id:NULL,
                'size_id' => ($obj->size_id)?$obj->size_id:NULL,
                'substrate_id' => ($obj->panel_substrate_id)?$obj->panel_substrate_id:NULL,
                'thickness_id' => ($obj->panel_thickness_id)?$obj->panel_thickness_id:NULL,
                'backer_id' => ($obj->backer_id)?$obj->backer_id:NULL,
                'qty' => ($obj->quantity)?$obj->quantity:NULL,
                'custom_width' => $obj->custom_width,
                'custom_length' => $obj->custom_length
            ]);
        }
    }
}