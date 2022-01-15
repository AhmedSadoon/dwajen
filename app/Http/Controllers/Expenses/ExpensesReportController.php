<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\expenses;

class ExpensesReportController extends Controller
{
    public function show(){

        return view('reports.expenses_report');

       }

       public function search_expenses(Request $request){

    // في حالة عدم تحديد تاريخ
           if ($request->start_at =='' && $request->end_at =='') {

              $expenses = expenses::all();

              return view('reports.expenses_report',compact('expenses'));
           }

           // في حالة تحديد تاريخ استحقاق
           else {

             $start_at = date($request->start_at);
             $end_at = date($request->end_at);

             $expenses = expenses::whereBetween('expenseDate',[$start_at,$end_at])->get();
             return view('reports.expenses_report',compact('expenses','start_at','end_at'));

           }



       }

   //====================================================================






}
