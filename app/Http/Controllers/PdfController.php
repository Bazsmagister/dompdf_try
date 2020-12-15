<?php

namespace App\Http\Controllers;

use App\Models\User;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function tempshow()
    {
        //$data = User::find(1);
        //dd($data);

        $data = [
            'title' => 'Welcome to Anywhere',
            'date' => date('m/d/Y'),
        ];
        return view('ordertablepdf', $data);
    }
    public function exportpdf()
    {
        $data = [
            'title' => 'Welcome to Anywhere',
            'date' => date('m/d/Y'),
        ];

        $pdf = App::make('dompdf.wrapper');

        //$pdf->loadHTML('<h1>Test</h1>');

        $pdf = PDF::loadView('ordertablepdf', $data);

        return $pdf->stream();
    }
}
