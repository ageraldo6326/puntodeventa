<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Company as CompanyTable;

class PurchaseController extends Controller
{
    public function showpurchase($id)
    {
        $purchase = Purchase::find($id);
        $company = CompanyTable::first();

        $purchase_details = PurchaseDetail::where('purchase_id', $purchase->id)->get();

        return view('admin.show-purchase', compact('purchase','purchase_details','company'));
    }
    
    public function generatePurchase($id)
    {        
        $purchase = Purchase::find($id);

        $company = Company::first();

        $purchase_details = PurchaseDetail::where('purchase_id', $purchase->id)->get();

        $pdf = Pdf::loadView('admin.purchase', compact('purchase','purchase_details','company'));

        return $pdf->download('purchase-'.$purchase->id.'.pdf');

    }


}
