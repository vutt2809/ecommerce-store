<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportController extends Controller
{
    public function allReport() {
        return view('backend.report.report_view');
    }

    public function reportByDate (Request $request) {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatDate)->latest()->get();

        return view('backend.report.report_by_date', compact('orders', 'formatDate'));
    }

    public function reportByMonth (Request $request) {
        $month = $request->month;
        $year = $request->year_name;
        
        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();

        return view('backend.report.report_by_month', compact('orders', 'month', 'year'));
    }

    public function reportByYear(Request $request) {
        $year = $request->year_name;
        
        $orders = Order::where('order_year', $year)->where('order_year', $year)->latest()->get();
        return view('backend.report.report_by_year', compact('orders', 'year'));
    }

    public function productReportView() {
        return view('backend.report.product.product_report_view');
    }

    public function bestSellerProduct(Request $request) {
        $number = $request->number;

        $ids = OrderItem::select('product_id', DB::raw('count(qty) as total'))
            ->groupBy('product_id')
            ->orderByRaw('count(qty) DESC')
            ->limit($number)
            ->pluck('product_id', 'total');

        $products = Product::whereIn('id', $ids)->get();

        return view('backend.report.product.product_report_result', compact('products', 'ids'));
    }

    
}