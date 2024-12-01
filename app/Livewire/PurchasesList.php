<?php

namespace App\Livewire;

use Livewire\Component;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Company;
use Dompdf\Dompdf;
use Dompdf\Options;

class PurchasesList extends Component
{
    public $search;
    public function render()
    {
        $purchases = Purchase::Where('id', 'like', '%' . $this->search . '%')->orderby('id', 'desc')->paginate(10); 
        return view('livewire.purchases-list', compact('purchases'));
    }

    public function generatePurchase(Purchase $purchase)
    {

        $purchase_details = PurchaseDetail::where('purchase_id', $purchase->id)->get();

        $company = Company::first();

        $pdf = Pdf::loadView('admin.purchase', compact('purchase','purchase_details','company'));

        $fileName = 'compra_' . $purchase->id . '.pdf';


        return response()->stream(function () use ($pdf) {
            echo $pdf->stream();
        }, 200, ['Content-Type' => 'application/pdf; charset=utf-8', 'Content-Disposition' => 'attachment; filename="' . $fileName . '"']);

    }    

    
}
