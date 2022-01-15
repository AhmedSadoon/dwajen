<?php

namespace App\Http\Controllers\Expenses;

use App\Exports\ExpensesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\expenses;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses=expenses::all();
        return view('expenses.expenses',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense=expenses::all();
        return view('expenses.add_expenses',compact('expense'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        expenses::create([
            'expenseName'=>$request->expensesName,
            'expensePrice'=>$request->expensePrice,
            'expenseDate'=>$request->expenseDate,
            'notes'=>$request->note,
            'user'=>Auth::user()->name,

        ]);

        session()->flash('Add','تم اضافة المصروف بنجاح');
        return back();

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
        $expense=expenses::where('id',$id)->first();
        return view('expenses.edit_expenses',compact('expense'));
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
        $expense=expenses::findOrFail($request->expense_id);

        $expense->update([
            'expenseName'=>$request->expensesName,
            'expensePrice'=>$request->expensePrice,
            'expenseDate'=>$request->expenseDate,
            'notes'=>$request->note,

        ]);

        session()->flash('edit','تم التعديل بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id=$request->expense_id;

        $expense=expenses::where('id',$id)->first();

        $expense->Delete();
        session()->flash('delete_expense');
        return redirect('/expenses');
    }

    public function export()
    {

            return Excel::download(new ExpensesExport, 'قائمة_المصروفات.xlsx');

    }



}
