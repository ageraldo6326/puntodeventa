<?php

namespace App\Livewire;

use App\Models\Quote;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\QuoteDetail;
use Livewire\Attributes\On;
use App\Models\InvoiceDetails;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class EditQuote extends Component
{

    public $id, $quote_id, $idProduct, $title, $quantity = 1, $price, $description, $stock, $image, $idCustomer, $nameCustomer, $quote,
    $quote_details, $total, $subtotal, $tax_itbs, $payment_method, $payment_status, $currency, $note, $due_date, $paid_date,
    $nif, $code;

    public function mount($quote)
    {
        Cart::destroy();

        $this->quote_id = $quote;

        $this->quote = Quote::find($this->quote_id); 

        $this->quote_details = QuoteDetail::where('quote_id', $this->quote->id)->get();

        foreach ($this->quote_details as $quote_detail) {
            $product = Product::find($quote_detail->product_id);
            Cart::add($product->id, $product->title, $quote_detail->quantity, $quote_detail->price, ['description' => $product->description],18);
        }


        $this->idProduct = "";

        $this->total = str_replace(',', '', Cart::total());

        $this->subtotal = str_replace(',', '', Cart::subtotal());

        $this->tax_itbs = str_replace(',', '', Cart::tax());

        $this->currency = $this->quote->currency;

        $this->note = $this->quote->note;

        $this->payment_method = $this->quote->payment_method;

        $this->payment_status = $this->quote->payment_status;

        $this->due_date = $this->quote->due_date;

        $this->paid_date = $this->quote->paid_date;

        $this->nif = $this->quote->nif;

    }

    public function render()
    {

        $quote = $this->quote;
        $quote_details = $this->quote_details;

        $products = Product::all();

        return view('livewire.edit-quote', compact('quote','quote_details','products'));

    }

    public function removeProduct($rowId){
        Cart::remove($rowId);

        $this->quote = Quote::find($this->quote_id);  
        
        $this->quote_details = QuoteDetail::where('quote_id', $this->quote->id)->get();      
        
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

        $this->reset(['idProduct', 'quantity', 'price', 'description', 'image','code']);
    }



    public function updateQuote(){

        $quote = Quote::find($this->quote_id);
        $quote->date = date('Y-m-d H:i:s');
        $quote->tax_itbs = str_replace(',', '', Cart::tax());
        $quote->subtotal = str_replace(',', '',Cart::subtotal());
        $quote->total = str_replace(',', '',Cart::total());
        $quote->payment_method = $this->payment_method;
        $quote->payment_status = $this->payment_status;
        $quote->due_date = $this->due_date;
        $quote->paid_date = $this->paid_date;
        $quote->currency = 'USD';
        $quote->note = $this->note;
        $quote->save();


        QuoteDetail::where('quote_id', $this->quote_id)->delete();

        foreach (Cart::content() as $item) {
            $quoteDetail = new QuoteDetail();
            $quoteDetail->quote_id = $this->quote_id;
            $quoteDetail->product_id = $item->id;
            $quoteDetail->quantity = $item->qty;
            $quoteDetail->price = $item->price;            
            $quoteDetail->total_price = $item->price * $item->qty;
            $quoteDetail->save();
        }

        Cart::destroy();
        $this->dispatch('updateQuoteSweetalert');
        sleep(2);
        return redirect()->route('admin.quotes-list');

    }

}
