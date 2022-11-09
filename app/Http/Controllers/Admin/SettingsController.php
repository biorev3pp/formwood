<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->title = 'Settings';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'settings';
    }

    public function index()
    {
        $setting = Settings::where('section', 1)->where('status', 1)->get();
        $this->data['setting'] = $setting;
        $this->data['menu'] = 'settings';
        return view('admin.settings.index')->with($this->data);
    }

    public function configurations()
    {
        $this->data['settings'] = Settings::where('section', '>=', 2)->where('status', 1)->get();
        $this->data['menu'] = 'configurations';
        return view('admin.settings.configurations')->with($this->data);
    }

    
    public function update(Request $request)
    {
        $data = $request->except(['_token']);
        foreach($data as $key => $value)
        {
            if ($request->file($key)) 
            {
                $value1 = $request->file($key);
                $value = time().'.'.$value1->getClientOriginalExtension();
                $destinationImagePath = public_path('media/');
                $uploadStatus = $value1->move($destinationImagePath,$value);
            }
            $settings = Settings::where('name',$key)->update(['value'=>$value]);
        }
        return redirect()->back()->with('success', 'Settings has been updated successfully.');
    }

    public function resetImage(Request $request)
    {
        $data = $request->except(['_token']);
        $settings = Settings::where('name',$request->field)->update(['value'=> '']);
        
        return ['success'];
    }
}