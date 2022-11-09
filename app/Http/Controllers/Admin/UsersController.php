<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $data;

    public function index()
    {
        $this->data['menu'] = '';
        $this->data['admin'] = User::where(['id' => Auth::user()->id])->first();
        return view('admin.profile')->with($this->data);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;

        $destination_path = public_path('backend/images/');

        if($request->file('profile_image'))
        {
            $file = $request->file('profile_image');
            $name = $file->getClientOriginalName();
            $file->move($destination_path, $name);
            $user->profile_image = $name;
        }

        $user->save();
        return response()->json('Your Profile has been updated successfully.', 200); 
    }

    public function changePassword(Request $request)
    {
        $user = User::where(['id' => Auth::user()->id])->first();
        if(Hash::check($request->old_password, $user->password))
        {
            if($request->new_password == $request->confirm_password){
                $user->password = Hash::make($request->new_password);
                $user->save();
                return response()->json('Your password has been updated successfully.', 200);
            }
            else
            {
                return response()->json('New Password and Confirm new password fields does not match.', 422); 
            }
        }
        else
        {
            return response()->json('Old password is incorrect, Please check again', 422); 
        }
    }

}
