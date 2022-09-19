<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Homes;
use App\Models\Elevations;
use App\Models\HomeDesignTypes;
use App\Models\HomeDesigns;

class ExteriorController extends Controller
{
    public function createHome(Request $request)
    {
        $destination_path = public_path('media/uploads/exterior');
        if($request->file('base_image'))
        {
            $view1_file = $request->file('base_image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
        }

        else
        {
            $view1_name = null;
        }

        if($request->title)
        {
            $homeplan = Homes::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'base_image' => ($view1_name)?$view1_name:'',
                'status_id' => $request->status
            ]);
            return $homeplan;
        }
    }

    public function modifyHome(Request $request)
    {
        $homeplan = Homes::find($request->home_id);
        
        if($request->title)
        {
            $homeplan->title = $request->title;
        }

        $homeplan->status_id = $request->status;

        $destination_path = public_path('media/uploads/exterior');
        if($request->file('base_image'))
        {
            $view1_file = $request->file('base_image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
            $homeplan->base_image = $view1_name;
        }

        $homeplan->save();
        return $homeplan;
    }

    public function deleteHome(Request $request){
        $homeplan = Homes::find($request->homeplan_id);
        $homeplan->status_id = 2;
        $homeplan->save();  
    }

    public function createElevation(Request $request)
    {
        $destination_path = public_path('media/uploads/exterior');
        if($request->file('base_image'))
        {
            $view1_file = $request->file('base_image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
        }

        else
        {
            $view1_name = null;
        }

        if($request->title)
        {
            $elevation = Elevations::create([
                'home_id' => base64_decode($request->home_id),
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'base_image' => ($view1_name)?$view1_name:'',
                'status_id' => $request->status
            ]);
            return $elevation;
        }
    }

    public function duplicateElevation(Request $request)
    {
        $oelevation = Elevations::find($request->id);
        
        $elevation = Elevations::create([
            'home_id' => $oelevation->home_id,
            'title' => $oelevation->title.' copy',
            'slug' => Str::slug($oelevation->title.' copy', '-'),
            'base_image' => $oelevation->base_image,
            'status_id' => $oelevation->status_id
        ]);

        $home_design_types = HomeDesignTypes::where('elevation_id', $request->id)->get();
        
        if($home_design_types) {
            foreach ($home_design_types as $hdt) {
                $newdtype = HomeDesignTypes::create([
                                    'title' => $hdt->title,
                                    'slug' => Str::slug($hdt->title, '-'),
                                    'elevation_id' => $elevation->id,
                                    'thumbnail' => $hdt->thumbnail,
                                    'priority' => $hdt->priority,
                                    'status_id' => $hdt->status_id,
                            ]);
                $home_designs = HomeDesigns::where('home_design_type_id', $hdt->id)->get();
                if($home_designs) {
                    foreach ($home_designs as $hd) {
                        HomeDesigns::create([
                            'title'             => $hd->title,
                            'slug'              => Str::slug($hd->title, '-'),
                            'elevation_id'   => $elevation->id,
                            'home_design_type_id' => $newdtype->id,
                            'thumbnail'         => $hd->thumbnail,
                            'image_view1'       => $hd->image_view1,
                            'is_default'       => $hd->is_default,
                            'price'             => $hd->price,
                            'material'          => $hd->material,
                            'manufacturer'      => $hd->manufacturer,
                            'product_id'        => $hd->product_id,
                            'rating'        => $hd->rating,
                            'status_id'         => $hd->status_id
                        ]);
                    }
                }
            }
        }
        return $elevation;
    }

    public function modifyElevation(Request $request)
    {
        $elevation = Elevations::find($request->id);
        
        if($request->title)
        {
            $elevation->title = $request->title;
        }

        $elevation->status_id = $request->status;

        $destination_path = public_path('media/uploads/exterior');
        if($request->file('base_image'))
        {
            $view1_file = $request->file('base_image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
            $elevation->base_image = $view1_name;
        }

        $elevation->save();
        return $elevation;
    }

    public function deleteElevation(Request $request){
        $elevation = Elevations::find($request->elevation_id);
        $elevation->status_id = 2;
        $elevation->save();  
    }
}
