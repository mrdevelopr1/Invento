<?php

namespace App\Http\Controllers\Pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function DailySalesReport()
    {
        return view('backend.sales.daily_sales_report');
    }

    public function DailySalesPdf(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Convert dates to Y-m-d format
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));

        // Retrieve all products
        $products = Product::all();

        // Retrieve purchases and sales data for each product within the date range
        foreach ($products as $product) {
            $product->purchases = Purchase::where('product_id', $product->id)
                ->whereBetween('date', [$start_date, $end_date])
                ->where('status', '1')
                ->get();

            $product->sales = InvoiceDetail::where('product_id', $product->id)
                ->whereHas('invoice', function($query) use ($start_date, $end_date) {
                    $query->whereBetween('date', [$start_date, $end_date])
                          ->where('status', '1');
                })
                ->get();
        }

        // Pass data to the view
        return view('backend.pdf.daily_sales_report_pdf', compact('products', 'start_date', 'end_date'));
    }
}
