<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Settings;
use App\Models\User;
USE DB;
use File;

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

    public function configurations($type = null)
    {
        $setting = Settings::where('section', base64_decode($type))->where('status', 1)->get();
        $this->data['setting'] = $setting;
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
                $destinationImagePath = public_path('/uploads/');
                $uploadStatus = $value1->move($destinationImagePath,$value);
            }
            $settings = Settings::where('name',$key)->update(['value'=>$value]);
        }
        return redirect()->back()->with('success', 'Settings has been updated successfully.');
    }

    public function updateAdmins(Request $request, $id)
    {
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->mobile = $request->mobile;
        $users->username = $request->username;
        $users->status_id = $request->status;

        $users->save();

        return redirect()->back()->with('success', 'Admin Data Updated.');
    }
}