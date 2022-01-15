<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Fx3costa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        

        $chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 350, 'height' => 200])
         ->labels(['Label x', 'Label y'])
         ->datasets([
             [
                 "label" => "My First dataset",
                 'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'], //المصروفات والواردات
                 'data' => [69, 59]
             ],
             [
                 "label" => "My First dataset",
                 'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],// الاجمالي
                 'data' => [65, 12]
             ]
         ])
         ->options([]);



        return view('home', compact('chartjs'));






    // $chartjs_2 = app()->chartjs
    //     ->name('pieChartTest')
    //     ->type('pie')
    //     ->size(['width' => 340, 'height' => 200])
    //     ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
    //     ->datasets([
    //         [
    //             'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
    //             'data' => [2, 2,2]
    //         ]
    //     ])
    //     ->options([]);



    // return view('home', compact('chartjs','chartjs_2'));



    }
}
