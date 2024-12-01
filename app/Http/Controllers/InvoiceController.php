<?php

namespace App\Http\Controllers;

use App\Models\Company as CompanyTable;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function showinvoice($id)
    {
        $invoice = Invoice::find($id);
        $company = CompanyTable::first();

        $invoice_details = InvoiceDetails::where('invoice_id', $invoice->id)->get();

        return view('admin.show-invoice', compact('invoice','invoice_details','company'));
    }
    
    public function generateInvoice($id)
    {
        $invoice = Invoice::find($id);

        $invoice_details = InvoiceDetails::where('invoice_id', $invoice->id)->get();

        $company = CompanyTable::first();

        $pdf = Pdf::loadView('admin.invoice', compact('invoice','invoice_details','company'));

        return $pdf->download('invoice'.$invoice->id.'.pdf');

    }


}
