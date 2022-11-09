<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backers;
use App\Models\Cuts;
use App\Models\EstimateProducts;
use App\Models\Estimates;
use App\Models\Matchings;
use App\Models\PanelSubstrates;
use App\Models\PanelThickness;
use App\Models\Qualities;
use App\Models\SheetTypes;
use App\Models\Sizes;
use App\Models\Species;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['page_title'] = 'Analytics';
        $this->data['menu'] = 'analytics';
    }

    public function index()
    {
        return view('admin.analytics')->with($this->data);
    }
    
    public function analytics(Request $request)
    {
        $list_data = '';
        $array = [];
        $condition = [];
        $condition2 = [];
        $array['pie_chart_data'] = array();
        $array['lot_list_data'] = array();
        $array['title'] = array();
        
        if($request->country_name){
            $condition['country'] = $request->country_name;
        }
        if($request->state_name){
            $condition['state'] = $request->state_name;
        }
        if($request->city_name){
            $condition['city'] = $request->city_name;
        }
        if($request->species_id)
        {
        	$condition2['species_id'] = $request->species_id;
        }
        if($request->cut_id)
        {
            $condition2['cut_id'] = $request->cut_id;
        }
       
        $estimates = Estimates::where($condition)->whereBetween(DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->get()->pluck('id')->toArray();
        //print_r($estimates);
        switch ($request->type) {
        	case 'species':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = Species::where('id', $analytic->species_id)->first();
                    if($com && !in_array($analytic->species_id, $com_loop_ids))
                    {
                	    array_push($com_loop_ids, $analytic->species_id);	
    
    			        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('species_id',$analytic->species_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Species Analytics');
                break;

            case 'cuts':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = Cuts::where('id', $analytic->cut_id)->first();
                    if($com && !in_array($analytic->cut_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->cut_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('cut_id',$analytic->cut_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Slicing Technique Analytics');
                break;
        
            case 'quality':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = Qualities::where('id', $analytic->quality_id)->first();
                    if($com && !in_array($analytic->quality_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->quality_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('quality_id',$analytic->quality_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Quality Analytics');
                break;

            case 'matching':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = Matchings::where('id', $analytic->matching_id)->first();
                    if($com && !in_array($analytic->matching_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->matching_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('matching_id',$analytic->matching_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Matching Analytics');
                break;

            case 'type':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = SheetTypes::where('id', $analytic->sheet_type_id)->first();
                    if($com && !in_array($analytic->sheet_type_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->sheet_type_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('sheet_type_id',$analytic->sheet_type_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Product Category Analytics');
                break;
            case 'size':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = Sizes::where('id', $analytic->size_id)->with('category')->first();
                    if($com && !in_array($analytic->size_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->size_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('size_id',$analytic->size_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->category->name.'</td>
                                            <td>'.$com->width.' x '.$com->length.' Inch </td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Product Size Analytics');
                break;
            case 'substrate':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = PanelSubstrates::where('id', $analytic->substrate_id)->first();
                    if($com && !in_array($analytic->substrate_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->substrate_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('substrate_id',$analytic->substrate_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Panel Substrate Analytics');
                break;
            case 'thickness':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = PanelThickness::where('id', $analytic->thickness_id)->first();
                    if($com && !in_array($analytic->thickness_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->thickness_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('thickness_id',$analytic->thickness_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Panel Thickness Analytics');
                break;
            case 'backer':
                $records = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition);
            
                $analytics 		= $records->get();
                $total_session	= $records->count();
                $com_loop_ids  	= [];

                foreach($analytics as $k => $analytic) {
                
                    $com = Backers::where('id', $analytic->backer_id)->with('category')->first();
                    if($com && !in_array($analytic->backer_id, $com_loop_ids))
                    {
                        array_push($com_loop_ids, $analytic->backer_id);	
    
                        $com_session = EstimateProducts::whereIn('estimate_id', $estimates)->where($condition)->where('backer_id',$analytic->backer_id)->count();
                        
                        if($com_session):
    
                            $popularity = self::get_percentage($total_session, $com_session);
                            
                            $list_data .= '<tr><td>'.(($com->category)?$com->category->name:'-').'</td>
                                        <td>'.$com->name.'</td>
                                        <td>'.$com_session.'</td>
                                        <td>'.$total_session.'</td>
                                        <td>'.round($popularity).'%</td>
                                    </tr>'; 
                
                            $p = array(
                                'name' => $com->name,
                                'y'    => round($popularity),
                            );
                            array_push($array['pie_chart_data'],$p);
                        endif;
                    }
                }
                array_push($array['lot_list_data'],$list_data);
                array_push($array['title'], 'Backer Analytics');
                break;
            default:
        		break;
        }
      
        return ($array);
    }

    public function get_percentage($total,$to)
    {
        $ratio = $to / $total;
	    return  number_format( $ratio * 100, 2 );
    }
}

