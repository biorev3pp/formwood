<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
       return view('admin.components')->with($this->data);
    }
}
