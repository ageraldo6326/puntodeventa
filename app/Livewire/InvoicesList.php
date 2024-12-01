<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invoice as Invoice;
use App\Models\InvoiceDetails;
use App\Models\Company as CompanyTable;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvoicesList extends Component
{
    public $search;
    public function render()
    {
        $invoices = Invoice::Where('id', 'like', '%' . $this->search . '%')->orderby('id', 'desc')->paginate(10); 
        return view('livewire.invoices-list' , compact('invoices'));
    }

    public function generateInvoice(Invoice $invoice)
    {

        $invoice_details = InvoiceDetails::where('invoice_id', $invoice->id)->get();

        $company = CompanyTable::first();

        $pdf = Pdf::loadView('admin.invoice', compact('invoice','invoice_details','company'));

        $fileName = 'factura_' . $invoice->id . '.pdf';


        return response()->stream(function () use ($pdf) {
            echo $pdf->stream();
        }, 200, ['Content-Type' => 'application/pdf; charset=utf-8', 'Content-Disposition' => 'attachment; filename="' . $fileName . '"']);

    }
}
