<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return view('Products.product',compact('products'));
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
        $input=$request->all();

        $validated = $request->validate([
            'nameProduct'=>'required|unique:products|max:255',
            
        ],[
            'nameProduct.required'=>'يرجى ادخال اسم المنتج',
            'nameProduct.unique'=>'اسم المنتج مدخل مسبقاً',
        ]);
       
            Product::create([
                'nameProduct'=>$request->nameProduct,
                'Description'=>$request->description,
                'Created_by'=>(Auth::user()->name),
            ]);

            session()->flash('Add','تم اضافة المنتج');
            return redirect('products');
        
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
        $id = $request->id;

        $this->validate($request, [

            'nameProduct' => 'required|max:255|unique:products,nameProduct,'.$id,
            
        ],[

            'nameProduct.required' =>'يرجي ادخال اسم القسم',
            'nameProduct.unique' =>'اسم القسم مسجل مسبقا',

        ]);

        $product = product::find($id);
        $product->update([
            'nameProduct' => $request->nameProduct,
            'Description'=>$request->description,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Product::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/products');
    }
}
