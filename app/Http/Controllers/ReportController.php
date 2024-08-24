<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    function ReportPage()
    {
        return view('pages.dashboard.report-page');
    }

    function SalesReport(Request $request)
    {


        $user_id = $request->header('id');
        $FormDate = date('Y-m-d', strtotime($request->FormDate));
        $ToDate = date('Y-m-d', strtotime($request->ToDate));

        $total = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('total');
        $vat = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('vat');
        $payable = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('payable');
        $discount = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('discount');

        // $invoiceID = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->pluck('id');

        //invoice id create

        // $invoiceRand = rand(100000, 999999);


        // $invoice = $str . $invoiceID;
        // $invoic_id = Invoice::where('user_id', $user_id)->where('id', $id)->first();


        $list = Invoice::where('user_id', $user_id)
            ->whereDate('created_at', '>=', $FormDate)
            ->whereDate('created_at', '<=', $ToDate)
            ->with('customer')->get();

        $date = Invoice::where('created_at')->first();

        $data = [
            'payable' => $payable,
            'discount' => $discount,
            'total' => $total,
            'vat' => $vat,
            'list' => $list,
            'FormDate' => $request->FormDate,
            'ToDate' => $request->ToDate,
            // 'invoiceID' => $invoiceRand,
            // 'date' => $date,
        ];


        $pdf = Pdf::loadView('report.SalesReport', $data);
        return $pdf->download('invoice.pdf');
    }
}
