<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstimateProducts;
use App\Models\Estimates;

class EnquiriesController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data['menu'] = 'enquiries';
    }

    public function index()
    {
        return view('admin.enquiries')->with($this->data);
    }

    public function list(Request $request)
    {
        $this->data['records'] = Estimates::withCount('products')->whereBetween('created_at', [$request->sdate, $request->edate])->get();
        return view('admin.enquiry_list')->with($this->data);
    }

    public function view($id = null)
    {
        $this->data['estimate'] = Estimates::where('id', $id)->first();
        $this->data['products'] = EstimateProducts::with(['specie', 'cut', 'quality', 'matching', 'backer', 'thickness', 'category', 'substrate', 'size'])->where('estimate_id', $id)->get();
        return view('admin.enquiry_detail')->with($this->data);
    }

    public function bulkAction(Request $request)
    {
        $ids = explode(',', $request->bulk_records);
        if($request->bulk_action_type == 'del') {
            Estimates::whereIn('id', $ids)->delete();
        }
        return ['success'];
    }

    public function destroy(Request $request)
    {
        $record = Estimates::find($request->id);
        $record->delete();  
        return ['success'];
    }

    public function estimatesReport(Request $request)
    {
        if($request->eids) {
            $ids = explode(',', $request->eids);
            $enquiries = Estimates::whereIn('id', $ids)->withCount('products')->get();
        } else {
            $enquiries = Estimates::withCount('products')->get();
        }
        $memoryToUse = 50*1024*1024*1024*1024;
        $output = fopen('php://temp/maxmemory:'.$memoryToUse, 'r+');
        $columns = array('SNo', 'Inquiry Date', 'Name', 'Email', 'Phone', 'Company', 'Address','City', 'State', 'Zip Code', 'Country', 'Remarks', 'Species', 'Cut', 'Quality', 'Matching', 'Product Category', 'Size', 'Quantity', 'Panel Substrate', 'Panel Thickness', 'Backer');
        fputcsv($output, $columns);
        
        if($enquiries->count() >= 1):
            $i = 1;
            foreach($enquiries as $m => $index):
                if($index->products_count >= 1):
                    $products = EstimateProducts::with(['specie', 'cut', 'quality', 'matching', 'backer', 'thickness', 'category', 'substrate', 'size'])->where('estimate_id', $index->id)->get();

                    foreach($products as $key => $product):
                        $data = [
                            ($key == 0)?$i++:'.',
                            ($key == 0)?date('jS M Y', strtotime($index->created_at)):'.',
                            ($key >= 1)?'.':(($index->name)?$index->name:'-'),
                            ($key >= 1)?'.':(($index->email)?$index->email:'-'),
                            ($key >= 1)?'.':(($index->phone)?$index->phone:'-'),
                            ($key >= 1)?'.':(($index->company)?$index->company:'-'),
                            ($key >= 1)?'.':(($index->address_line1)?$index->address_line1:'-'),
                            ($key >= 1)?'.':(($index->city)?$index->city:'-'),
                            ($key >= 1)?'.':(($index->state)?$index->state:'-'),
                            ($key >= 1)?'.':(($index->postal_code)?$index->postal_code:'-'),
                            ($key >= 1)?'.':(($index->country)?$index->country:'-'),
                            ($key >= 1)?'.':(($index->remarks)?$index->remarks:'-'),
                            ($product->species_id)?$product->specie->name:'--',
                            ($product->cut_id)?$product->cut->name:'--',
                            ($product->quality_id && $product->quality)?$product->quality->name:'--',
                            ($product->matching_id)?$product->matching->name:'--',
                            ($product->sheet_type_id)?$product->category->name:'--',
                            ($product->custom_width || $product->custom_length)
                                    ? 'Custom Size: '.number_format($product->custom_width).' x '.number_format($product->custom_length).' Inch'
                                    : (($product->size_id >= 1)? $product->size->width.' x '.$product->size->length.' Inch' :' -- ' ),
                            $product->qty,
                            ($product->substrate_id)?$product->substrate->name:'--',
                            ($product->thickness_id)?$product->thickness->name:'--',
                            ($product->backer_id)?$product->backer->name:'--',
                        ];
                        fputcsv($output, $data);
                    endforeach;
                else:
                    $data = [

                    ];
                    fputcsv($output, $data);
                endif;
            endforeach;
        else:
            $data = ['No records found'];
            fputcsv($output, $data);
        endif;    
        rewind($output);
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename="inquiries-report-'.time().'.csv"');
        echo stream_get_contents($output);
        fclose($output);
        die;
    }
}
