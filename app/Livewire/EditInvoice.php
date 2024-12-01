<?php

namespace App\Livewire;

use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;
use App\Models\InvoiceDetails;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class EditInvoice extends Component
{

    public $id, $invoice_id, $idProduct, $title, $quantity = 1, $price, $description, $stock, $image, $idCustomer, $nameCustomer, $invoice,
    $invoice_details, $total, $subtotal, $tax_itbs, $payment_method, $payment_status, $currency, $note, $due_date, $paid_date,
    $nif, $transaction_id, $code;

    public function mount($invoice)
    {
        Cart::destroy();

        $this->invoice_id = $invoice;

        $this->invoice = Invoice::find($this->invoice_id);  
        
        $this->invoice_details = InvoiceDetails::where('invoice_id', $this->invoice->id)->get();

        foreach ($this->invoice_details as $invoice_detail) {
            $product = Product::find($invoice_detail->product_id);
            Cart::add($product->id, $product->title, $invoice_detail->quantity, $invoice_detail->price, ['description' => $product->description],18);
        }

        $this->idProduct = "";

        $this->total = str_replace(',', '', Cart::total());

        $this->subtotal = str_replace(',', '', Cart::subtotal());

        $this->tax_itbs = str_replace(',', '', Cart::tax());

        $this->currency = $this->invoice->currency;

        $this->note = $this->invoice->note;

        $this->payment_method = $this->invoice->payment_method;

        $this->payment_status = $this->invoice->payment_status;

        $this->due_date = $this->invoice->due_date;

        $this->paid_date = $this->invoice->paid_date;

        $this->nif = $this->invoice->nif;

        $this->transaction_id = $this->invoice->transaction_id;

    }

    public function render()
    {

        $invoice = $this->invoice;
        $invoice_details = $this->invoice_details;

        $products = Product::all();

        return view('livewire.edit-invoice', compact('invoice','invoice_details','products'));

    }

    public function removeProduct($rowId){
        Cart::remove($rowId);

        $this->invoice = Invoice::find($this->invoice_id);  
        
        $this->invoice_details = InvoiceDetails::where('invoice_id', $this->invoice->id)->get();      
        
        $this->total = str_replace(',', '', Cart::total());

        $this->subtotal = str_replace(',', '', Cart::subtotal());

        $this->tax_itbs = str_replace(',', '', Cart::tax());
        
        Log::info('Product added to cart', Cart::content()->toArray());
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

        $product = Product::find($this->idProduct);
        Cart::add($product->id, $product->title, $this->quantity, $this->price, ['description' => $product->description],18);

        $this->total = str_replace(',', '', Cart::total());

        $this->subtotal = str_replace(',', '', Cart::subtotal());

        $this->tax_itbs = str_replace(',', '', Cart::tax());

        $this->reset(['idProduct', 'quantity', 'price', 'description', 'image', 'code']);
    }



    public function updateInvoice(){

        $invoice = Invoice::find($this->invoice_id);
        $invoice->date = date('Y-m-d H:i:s');
        $invoice->tax_itbs = str_replace(',', '', Cart::tax());
        $invoice->subtotal = str_replace(',', '',Cart::subtotal());
        $invoice->total = str_replace(',', '',Cart::total());
        $invoice->payment_method = $this->payment_method;
        $invoice->payment_status = $this->payment_status;
        $invoice->due_date = $this->due_date;
        $invoice->paid_date = $this->paid_date;
        $invoice->currency = 'USD';
        $invoice->note = $this->note;
        $invoice->transaction_id = $this->transaction_id;
        $invoice->save();


        InvoiceDetails::where('invoice_id', $this->invoice_id)->delete();

        foreach (Cart::content() as $item) {
            $invoiceDetails = new InvoiceDetails();
            $invoiceDetails->invoice_id = $this->invoice_id;
            $invoiceDetails->product_id = $item->id;

            $product = Product::find($item->id);
            $diferencia = $item->qty - $product->stock;
            $product->stock += $diferencia;
            $product->save();

            $invoiceDetails->quantity = $item->qty;
            $invoiceDetails->price = $item->price;            
            $invoiceDetails->total_price = $item->price * $item->qty;
            $invoiceDetails->save();
        }

        Cart::destroy();
        $this->dispatch('updateInvoiceSweetalert');
        sleep(2);
        return redirect()->route('admin.invoices-list');

    }

}
