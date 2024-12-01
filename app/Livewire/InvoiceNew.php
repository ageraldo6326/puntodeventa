<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;
use App\Models\Comprobantes;
use App\Models\InvoiceDetails;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class InvoiceNew extends Component
{
    public $id, $idProduct, $title, $price = 0.0, $quantity = 1, $description, $stock, $image, $idCustomer, $nameCustomer, $nif, 
    $note, $payment_method, $due_date, $paid_date, $transaction_id, $code;

    function mount(){
        $this->reset();
        Cart::destroy();
    }
    public function render()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('livewire.invoice-new', compact('products', 'customers'));
    }

    public function setProduct(){

        $product = Product::Where('code', $this->code)->first();
        if ($product) {
            $this->title = $product->title;
            $this->price = $product->price;
            $this->description = $product->description;
            $this->image = $product->image;
            $this->stock = $product->stock;
            $this->idProduct = $product->id;
        } else {
            $this->reset(['idProduct', 'quantity', 'price', 'description', 'image', 'code']);
        }

        $this->dispatch('update-select2', id: $product->id);

    }

    #[On('setProduct2')]
    public function setProduct2($id){

        $product = Product::where('id', $id)->first();
        if ($product) {
            $this->title = $product->title;
            $this->price = $product->price;
            $this->description = $product->description;
            $this->image = $product->image;
            $this->stock = $product->stock;
            $this->code = $product->code;
            $this->idProduct = $product->id;
        } else {
            $this->reset(['idProduct', 'quantity', 'price', 'description', 'image', 'code']);
        }

    }


    public function setCustomer(){
        
        $customer = Customer::find($this->idCustomer);
        if ($customer) {
            $this->nameCustomer = $customer->name . ' ' . $customer->last_name;
        }

    }    

    public function addProduct(){

        $this->validate([
            'idProduct' => 'required',
        ]);

        $product = Product::where('id', $this->idProduct)->orWhere('code', $this->code)->first();
        Cart::add($product->id, $product->title, $this->quantity, $this->price, ['description' => $product->description],18);
        $this->reset(['idProduct', 'quantity', 'price', 'description', 'image','code']);
        
    }

    public function removeProduct($rowId){
        Cart::remove($rowId);
    }

    public function storeInvoice(){

        $this->validate([
            'idCustomer' => 'required',
        ]);

        $invoice = new Invoice();
        $invoice->customer_id = $this->idCustomer;
        $invoice->user_id = Auth::user()->id; 
        $invoice->date = date('Y-m-d H:i:s');
        $invoice->tax_itbs = str_replace(',', '', Cart::tax());
        $invoice->subtotal = str_replace(',', '',Cart::subtotal());
        $invoice->total = str_replace(',', '',Cart::total());
        $invoice->payment_method = $this->payment_method;
        $invoice->transaction_id = $this->transaction_id;
        $invoice->currency = env('CURRENCY');

        $company = Company::first();
        $invoice->rfc = $company->rfc;
        

        $ncf = Comprobantes::where('estado', 'ACTIVO')->first();

        if ($ncf==null) {
            abort(403,"NO TIENE COMPROBANTES FISCALES");
        }

        if ($ncf->finsecuencia == $ncf->ultsecuencia) {
            $ncf->estado = 'INACTIVO';
        }


        $this->nif = $ncf->serie . $ncf->tipo . str_pad(($ncf->ultsecuencia + 1), 8, "0", STR_PAD_LEFT);
        $ncf->ultsecuencia = $ncf->ultsecuencia + 1;
        $ncf->fechaultsecuencia = date('Y-m-d H:i:s');
        $ncf->save();


        $invoice->nif = $this->nif;
        $invoice->note = $this->note;
        $invoice->due_date = $this->due_date;
        $invoice->paid_date = $this->paid_date;
        $invoice->save();
        $this->id = $invoice->id;

        foreach (Cart::content() as $item) {
            $invoiceDetails = new InvoiceDetails();
            $invoiceDetails->invoice_id = $invoice->id;
            $invoiceDetails->product_id = $item->id;
            $invoiceDetails->quantity = $item->qty;

            $product = Product::find($item->id);
            $product->stock = $product->stock - $item->qty;
            $product->save();

            $invoiceDetails->price = $item->price;            
            $invoiceDetails->total_price = $item->price * $item->qty;
            $invoiceDetails->save();
        }

        Cart::destroy();
        $this->dispatch('newInvoiceSweetalert');
        sleep(2);
        return redirect()->route('admin.invoices-list');

    }
}
