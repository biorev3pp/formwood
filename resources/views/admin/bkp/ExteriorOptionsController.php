<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Homes;
use App\Models\Elevations;
use App\Models\HomeDesignTypes;
use App\Models\HomeDesigns;

class ExteriorOptionsController extends Controller
{
  
    public function createDesignType(Request $request)
    {
        $destination_path = public_path('media/thumbnails');
        if($request->file('thumbnail_image'))
        {
            $thumbnail_file = $request->file('thumbnail_image');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
        }

        else
        {
            $thumbnail_name = null;
        }

        if($request->title)
        {
            $design_type = HomeDesignTypes::create([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title, '-'),
                'elevation_id'   => base64_decode($request->elevation_id),
                'thumbnail'         => ($thumbnail_name)?$thumbnail_name:'',
                'status_id'         => $request->status,
                'priority'          => $request->priority
            ]);
            return $design_type;
        }
    }

    public function modifyDesignType(Request $request)
    {
        $design_type = HomeDesignTypes::find($request->design_type_id);
        
        if($request->title)
        {
            $design_type->title = $request->title;
            $design_type->slug = Str::slug($request->title, '-');   
        }
        
        $design_type->status_id = $request->status;
        $design_type->priority = $request->priority;

        $destination_path = public_path('media/thumbnails');
        if($request->file('thumbnail_image'))
        {
            $thumbnail_file = $request->file('thumbnail_image');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
            $design_type->thumbnail = $thumbnail_name;
        }

        $design_type->save();
        return $design_type;
    }
    
    public function deleteDesignType(Request $request){
        $design_type = HomeDesignTypes::find($request->design_type_id);
        $design_type->status_id = 2;
        $design_type->save();  
    }

    public function createDesign(Request $request)
    {   
        $design_type = HomeDesignTypes::find(base64_decode($request->design_type_id));

        $destination_path = public_path('media/uploads/exterior/'.$design_type->slug.'_'.$design_type->id);
        if($request->file('thumbnail'))
        {
            $thumbnail_file = $request->file('thumbnail');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
        }

        else
        {
            $thumbnail_name = null;
        }

        if($request->file('view1_image'))
        {
            $view1_image_file = $request->file('view1_image');
            $view1_image_name = $view1_image_file->getClientOriginalName();
            $view1_image_file->move($destination_path, $view1_image_name);
        }

        else
        {
            $view1_image_name = null;
        }

        if($request->title)
        {   
            $design = HomeDesigns::create([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title, '-'),
                'elevation_id'   => base64_decode($request->elevation_id),
                'home_design_type_id'    => base64_decode($request->design_type_id),
                'thumbnail'         => ($thumbnail_name)?$thumbnail_name:'',
                'image_view1'       => ($view1_image_name)?$view1_image_name:'',
                'price'             => $request->price,
                'material'          => $request->material,
                'manufacturer'      => $request->manufacturer,
                'product_id'        => $request->product_id,
                'status_id'         => $request->status
            ]);
        }
        return $design;
    }

    public function modifyDesign(Request $request)
    {   
        $design = HomeDesigns::find($request->design_id);
        if($request->title)
        {
            $design->title = $request->title;
            $design->slug = Str::slug($request->title, '-');   
        }

        if($request->price)
        {
            $design->price = $request->price;
        }

        if($request->material)
        {
            $design->material = $request->material;
        }
        
        if($request->manufacturer)
        {
            $design->manufacturer = $request->manufacturer;
        }

        if($request->product_id)
        {
            $design->product_id = $request->product_id;
        }

        $design->status_id = $request->status;

        $design_type = HomeDesignTypes::find(base64_decode($request->design_type_id));

        $destination_path = public_path('media/uploads/exterior/'.$design_type->slug.'_'.$design_type->id);

        if($request->file('thumbnail'))
        {
            $thumbnail_file = $request->file('thumbnail');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
            $design->thumbnail = $thumbnail_name;
        }

        if($request->file('view1_image'))
        {
            $view1_image_file = $request->file('view1_image');
            $view1_image_name = $view1_image_file->getClientOriginalName();
            $view1_image_file->move($destination_path, $view1_image_name);
            $design->image_view1 = $view1_image_name;
        }

        $design->save();
        return $design;
    }

    public function deleteDesign(Request $request)
    {
        $design = HomeDesigns::find($request->design_id);
        if($design->is_default == 1){
            return response()->json('Cannot delete default design.', 422); 
        }
        $design->status_id = 2;
        $design->save();  
    }

    public function updateDefault(Request $request)
    {
        $design = HomeDesigns::find($request->design_id);
        if($design->status_id != 1)
        {
            return response()->json('Design is not active.', 422); 
        }
        HomeDesigns::where('home_design_type_id', $design->design_type_id)->update([
            'is_default' => 0
        ]);
        $design->is_default = 1;
        $design->save();  
    }

    public function tempImages()
    {
        $images = [];
        $images1 = HomeDesigns::where('status_id', 1)->with('design_type')->get()->toArray();
        foreach ($images1 as $key => $value) {
            if($value['image_view1']) array_push($images, '/media/uploads/'.$value['design_type']['title'].'/'.$value['image_view1']);
            if($value['image_view2']) array_push($images, '/media/uploads/'.$value['design_type']['title'].'/'.$value['image_view2']);
            if($value['open_view_image']) array_push($images, '/media/uploads/'.$value['design_type']['title'].'/'.$value['open_view_image']);
            if($value['open_view2_image']) array_push($images, '/media/uploads/'.$value['design_type']['title'].'/'.$value['open_view2_image']);
        }
        $images = array_values(array_filter($images));
        return $images;
    }
}