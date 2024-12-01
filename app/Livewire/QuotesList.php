<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Quote;
use App\Models\Company;
use App\Models\QuoteDetail;
use Dompdf\Dompdf;
use Dompdf\Options;

class QuotesList extends Component
{
    public $search;
    public function render()
    {
        $quotes = Quote::Where('id', 'like', '%' . $this->search . '%')->orderby('id', 'desc')->paginate(10); 
        return view('livewire.quotes-list' , compact('quotes'));
    }

    public function generateQuote(Quote $quote)
    {

        $quote_details = QuoteDetail::where('quote_id', $quote->id)->get();

        $company = Company::first();

        $pdf = Pdf::loadView('admin.quote', compact('quote','quote_details','company'));

       

        $fileName = 'cotizacion_' . $quote->id . '.pdf';


        return response()->stream(function () use ($pdf) {
            echo $pdf->stream();
        }, 200, ['Content-Type' => 'application/pdf; charset=utf-8', 'Content-Disposition' => 'attachment; filename="' . $fileName . '"']);



    }

}
