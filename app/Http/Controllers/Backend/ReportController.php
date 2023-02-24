<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderInterface;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderInterface $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function allReport() {
        return view('backend.report.report_view');
    }

    public function reportByDate(Request $request) {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = $this->orderRepository->getOrderByDate($formatDate);

        return view('backend.report.report_by_date', compact('orders', 'formatDate'));
    }

    public function reportByMonth(Request $request) {
        $month = $request->month;
        $year = $request->year_name;
        $orders = $this->orderRepository->getOrderByMonth($month, $year);

        return view('backend.report.report_by_month', compact('orders', 'month', 'year'));
    }

    public function reportByYear(Request $request) {
        $year = $request->year_name;
        $orders = $this->orderRepository->getOrderByYear($year);

        return view('backend.report.report_by_year', compact('orders', 'year'));
    }

    public function productReportView() {
        return view('backend.report.product.product_report_view');
    }

    public function bestSellerProduct(Request $request) {
        $number = $request->number;

        $data = $this->orderRepository->getTopBestSellerProduct($number);
        $products = $data['products'];
        $listItems = $data['listItems'];

        return view('backend.report.product.product_report_result', compact('products', 'listItems'));
    }
}
