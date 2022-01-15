<?php

namespace App\Http\Controllers\Incomes;

use App\Exports\IncomesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incomes;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $incomes=Incomes::all();


        return view('incomes.incomes',compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $income=Incomes::all();
        return view('incomes.add_incomes',compact('income'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Incomes::create([
            'incomeName'=>$request->incomeName,
            'incomePrice'=>$request->incomePrice,
            'incomeDate'=>$request->incomeDate,
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
        $income=Incomes::where('id',$id)->first();
        return view('incomes.edit_incomes',compact('income'));
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
        $income=Incomes::findOrFail($request->income_id);

        $income->update([
            'incomeName'=>$request->incomeName,
            'incomePrice'=>$request->incomePrice,
            'incomeDate'=>$request->incomeDate,
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
        $id=$request->income_id;
        $incomes=Incomes::where('id',$id)->first();

        $incomes->Delete();
        session()->flash('delete_income');
        return redirect('/incomes');
    }

    public function exportIncomes()
    {

            return Excel::download(new IncomesExport, 'قائمة_الواردات.xlsx');

    }


}

