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
use App\Models\PanelSubstrates;
use App\Models\PanelThickness;
use App\Models\Qualities;
use App\Models\SheetTypes;
use App\Models\Sizes;
use App\Models\SizesBackers;

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
    public function getCategorySizes()
    {
        $categorysizes = SheetTypes::with('sizes')->where('status_id', 1)->get();
        return view('admin.logicbox.categories')->with(compact('categorysizes'));
    }

    // By Step 5 For Step 6 ... PanelOptions
    public function getPanelOptions()
    {
        $substrates = PanelSubstrates::where('status_id', 1)->get();
        return view('admin.logicbox.panel_options')->with(compact('substrates'));
    }

    // By Step 6 For Step 6 part 2 ... PanelOptions - Core Thickness
    public function getPanelThickness($sid = null)
    {
        $substrates = PanelSubstrates::where('id', $sid)->first();
        $sthickness = explode(',',$substrates->thickness_ids);
        $thickness = PanelThickness::where('status_id', 1)->get();
        return view('admin.logicbox.panel_thickness')->with(compact('thickness', 'sthickness', 'sid', 'substrates'));
    }

    // By Step 6 For Step 7 ... Backers
    public function getBackers($cid = null)
    {
        $sbackers = SizesBackers::where('size_id', $cid)->get()->pluck('backer_id')->toArray();
        $category = Sizes::whereId($cid)->first();
        $backers = Backers::where('status_id', 1)->where('sheet_type_id', $category->sheet_type_id)->get();
        return view('admin.logicbox.backers')->with(compact('backers', 'sbackers', 'cid', 'category'));
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

    public function updateCutMatchings(Request $request)
    {
        Cuts::where('id', $request->cut_id)->update(['matchings' => $request->matching_ids]);
        return ['success'];
    }

    public function updatePanelThickness(Request $request)
    {
        PanelSubstrates::where('id', $request->substrate_id)->update(['thickness_ids' => $request->thickness_ids]);
        return ['success'];
    }
    
    public function updateSizeBackers(Request $request)
    {
        $backers_ids = explode(',', $request->backer_ids);
        SizesBackers::where('size_id', $request->size_id)->whereNotIn('backer_id', $backers_ids)->delete();
        foreach ($backers_ids as $key => $value) {
            if(SizesBackers::where('size_id', $request->size_id)->where('backer_id', $value)->count() == 0) {
                SizesBackers::create(['size_id' => $request->size_id, 'backer_id' => $value]);
            }
        }
        return ['success'];
    }  
}