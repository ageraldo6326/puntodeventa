<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Company;
use App\Models\QuoteDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class QuoteController extends Controller
{
    public function showquote($id)
    {
        $quote = Quote::find($id);
        $company = Company::first();

        $quote_details = QuoteDetail::where('quote_id', $quote->id)->get();

        return view('admin.show-quote', compact('quote','quote_details','company'));
    }

    public function generateQuote($id)
    {
        $quote = Quote::find($id);

        $quote_details = QuoteDetail::where('quote_id', $quote->id)->get();

        $company = Company::first();

        $pdf = Pdf::loadView('admin.quote', compact('quote','quote_details','company'));

        return $pdf->download('quote.pdf');

    }
    
}
