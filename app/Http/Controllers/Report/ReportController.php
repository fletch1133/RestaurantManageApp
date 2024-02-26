<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index(){
        return view('report.index', ['slot' => '']);
    }
    public function show(Request $request) {
        $request->validate([
            'dateStart' => 'required',
            'dateEnd' => 'required'
        ]);
        return view('report.index', ['slot' => '']);

        $dateStart = date("Y-m-d H:i:s", strtotime($request->dateStart. ' 00:00:00 '));
        $dateEnd = date("Y-m-d H:i:s", strtotime($request->dateEnd. ' 23:59:59 ')); 
        $sales = Sale::whereBetween('updated_at', [$dateStart, $dateEnd])->where('sale_status', 'paid');

        return view('report.showReport')
        ->with('dateStart', date("m/d/Y H:i:s", strtotime($request->dateStart. ' 00:00:00 ')))
        ->with('dateEnd', date("m/d/Y H:i:s", strtotime($request->dateEnd. ' 23:59:59 ')))
        ->with('totalSale', $sales->sum('total_price'))->with('sales', $sales->paginate(5));
    } 
}
?>
