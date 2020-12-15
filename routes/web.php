<?php

use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;

//use Barryvdh\DomPDF\PDF;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

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
    return view('welcome');
});


Route::get('/test', function () {
    //return view('welcome');

    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();
});


Route::get('/test3', function () {
    $html = '<h1>Test3</h1>';

    $pdf = App::make('dompdf.wrapper');

    $pdf->loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');

    return $pdf->stream();
});




Route::get('/test2', function () {
    //return view('welcome');

    $data = User::all();
    //dd($data);
    $pdf = PDF::loadView('pdf.invoice', $data);
    //Non-static method Barryvdh\DomPDF\PDF::loadView() should not be called statically
    //This happens because you are namespacing the wrong PDF class.
    //You are namespacing Barryvdh\DomPDF\PDF and try to use this class as "Facade" which is wrong.
    //To solve your problem
    //Set namespace to the facade:
    return $pdf->download('invoice.pdf');
});


Route::get('/orderpdf', [PdfController::class,'exportpdf'])->name('orderpdf');
Route::get('/orderpdfindex', [PdfController::class,'tempshow']);
