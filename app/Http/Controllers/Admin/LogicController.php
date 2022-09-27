<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backers;
use Illuminate\Http\Request;
use App\Models\Species;
use App\Models\Cuts;
use App\Models\SpeciesCuts;
use App\Models\CutsQualities;
use App\Models\Matchings;
use App\Models\Qualities;

class LogicController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data['menu'] = 'logic-graph';
        $this->data['species'] = Species::where('status_id', 1)->get();
    }

    public function index()
    {
        return view('admin.graph')->with($this->data);
    }

    //--// Functions to get related data 
    
    // By Step 1 For Step 2 ... Cuts
    public function getCuts($sid = null)
    {
        $scuts = Species::where('id', $sid)->first();
        $scuts = explode(',',$scuts->cuts);
        $cuts = Cuts::where('status_id', 1)->get();
        return view('admin.logicbox.cuts')->with(compact('cuts', 'scuts', 'sid'));
    }

    // By Step 1 For Step 3 ... Qualities
    public function getQualities($cid = null)
    {
        $squalities = Species::where('id', $cid)->first();
        $squalities = explode(',',$squalities->qualities);
        $qualities = Qualities::where('status_id', 1)->get();
        return view('admin.logicbox.qualities')->with(compact('qualities', 'squalities', 'cid'));
    }

    // By Step 2 For Step 4 ... matchings
    public function getMatchings($cid = null)
    {
        $smatchings = Cuts::where('id', $cid)->first();
        $smatchings = explode(',',$smatchings->matchings);
        $matchings = Matchings::where('status_id', 1)->get();
        return view('admin.logicbox.matchings')->with(compact('matchings', 'smatchings', 'cid'));
    }

    // By Step 4 For Step 5 ... CategorySizes
    public function getCategorySizes($cid = null)
    {
        $squalities = CutsQualities::where('cut_id', $cid)->get()->pluck('qualities_id')->toArray();
        $qualities = Qualities::where('status_id', 1)->get();
        return view('admin.logicbox.qualities')->with(compact('qualities', 'squalities', 'cid'));
    }

    // By Step 5 For Step 6 ... PanelOptions
    public function getPanelOptions($cid = null)
    {
        $squalities = CutsQualities::where('cut_id', $cid)->get()->pluck('qualities_id')->toArray();
        $qualities = []; //PanelOptions::where('status_id', 1)->get();
        return view('admin.logicbox.qualities')->with(compact('qualities', 'squalities', 'cid'));
    }

    // By Step 6 For Step 7 ... Backers
    public function getBackers($cid = null)
    {
        $squalities = CutsQualities::where('cut_id', $cid)->get()->pluck('qualities_id')->toArray();
        $backers = Backers::where('status_id', 1)->get();
        return view('admin.logicbox.qualities')->with(compact('backers', 'squalities', 'cid'));
    }



    //--// Update logic relations between steps

    public function updateSpeciesCuts(Request $request)
    {
        Species::where('id', $request->species_id)->update(['cuts' => $request->cut_ids]);
        return ['success'];
    }

    public function updateSpeciesQualities(Request $request)
    {
        Species::where('id', $request->species_id)->update(['qualities' => $request->quality_ids]);
        return ['success'];
    }   
}