<?php

namespace App\Http\Controllers\Incomes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incomes;

class IncomesReportController extends Controller
{
    public function show(){

        return view('reports.incomes_report');

       }

       public function search_income(Request $request){

    // في حالة عدم تحديد تاريخ
           if ($request->start_at =='' && $request->end_at =='') {

              $incomes = Incomes::all();

              return view('reports.incomes_report',compact('incomes'));
           }

           // في حالة تحديد تاريخ استحقاق
           else {

             $start_at = date($request->start_at);
             $end_at = date($request->end_at);

             $incomes = Incomes::whereBetween('incomeDate',[$start_at,$end_at])->get();
             return view('reports.incomes_report',compact('incomes','start_at','end_at'));

           }



       }

   //====================================================================






}
