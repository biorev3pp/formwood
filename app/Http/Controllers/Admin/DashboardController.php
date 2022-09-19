<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $data;
    
    public function index()
    {
        $this->data['menu'] = 'home';
        return view('admin.dashboard')->with($this->data);
    }
}
