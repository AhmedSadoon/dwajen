<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Expenses\ExpensesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::resource('expenses', App\Http\Controllers\Expenses\ExpensesController::class);

Route::resource('products', App\Http\Controllers\Product\ProductController::class);


Route::get('/edit_expense/{id}',[ App\Http\Controllers\Expenses\ExpensesController::class,'edit']);

Route::post('/update_expense/{id}',[ App\Http\Controllers\Expenses\ExpensesController::class,'update'])->name('update.expense');

Route::get('expense_export',[ ExpensesController::class,'export'])->name('export');

Route::post('search_expenses', [App\Http\Controllers\Expenses\ExpensesReportController::class,'search_expenses'])->name('searchReport');

Route::resource('expensereport', App\Http\Controllers\Expenses\ExpensesReportController::class);



//ـــــــــــــــــــــــــــــ نهاية المصروفات ـــــــــــــــــــــــــــــــــــــ

//ـــــــــــــــــــــــــــــــــــ بداية الواردات ـــــــــــــــــــــــــ

Route::resource('incomes', App\Http\Controllers\Incomes\IncomesController::class);

Route::get('/edit_income/{id}',[ App\Http\Controllers\Incomes\IncomesController::class,'edit']);

Route::post('/update_income/{id}',[ App\Http\Controllers\Incomes\IncomesController::class,'update'])->name('update.income');

Route::get('incomes_export',[ App\Http\Controllers\Incomes\IncomesController::class,'exportIncomes']);

Route::resource('incomereport', App\Http\Controllers\Incomes\IncomesReportController::class);

Route::post('search_income', [App\Http\Controllers\Incomes\IncomesReportController::class,'search_income'])->name('searchIncomeReport');



//-------------------------------------------------------------------------------------

Route::get('/{page}', [App\Http\Controllers\AdminController::class,'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





