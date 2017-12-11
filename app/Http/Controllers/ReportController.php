<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.reports');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateReport(Request $request)
    {

        $reportParams = $this->validate($request, [
            'year' => 'required|numeric',
            'month' => 'required|numeric'
        ]);

        $reportTemp = DB::table('orders')
            ->join('users', 'orders.user_id', 'users.id')
            ->select('orders.*',  'users.first_name', 'users.last_name')
            ->where('orders.status', '<>', config('constants.ORDER_STATUS_PENDING'))
            ->get();

        echo '<pre>';
        print_r($reportTemp);
        die;

        $data               = array();
        $data['year']       = $reportParams['year'];
        $data['monthName']  = date("F", mktime(0, 0, 0, $reportParams['month'], 10));

        $pdf = PDF::loadView('reports.salesReport', compact('data'));

        return $pdf->download('sales_report_'. '$month' . '_' . '$year' . '.pdf');

    }


}
