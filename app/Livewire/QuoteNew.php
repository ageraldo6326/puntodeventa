<?php

namespace App\Livewire;

use App\Models\Quote;

use App\Models\Company;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\QuoteDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class QuoteNew extends Component
{
    public $id, $idProduct, $title, $price = 0.0, $quantity = 1, $stock, $description, $image, $idCustomer, $nameCustomer, $nif, 
    $note, $payment_method, $due_date, $paid_date, $code;

    function mount(){
        $this->reset();
        Cart::destroy();
    }
    public function render()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('livewire.quote-new', compact('products', 'customers'));
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
        $this->reset(['idProduct', 'quantity', 'price', 'description', 'image', 'code']);
        
        
    }

    public function removeProduct($rowId){
        Cart::remove($rowId);
    }

    public function storeQuote(){

        $this->validate([
            'idCustomer' => 'required',
        ]);

        $quote = new Quote();
        $quote->customer_id = $this->idCustomer;
        $quote->user_id = Auth::user()->id; 
        $quote->date = date('Y-m-d H:i:s');
        $quote->tax_itbs = str_replace(',', '', Cart::tax());
        $quote->subtotal = str_replace(',', '',Cart::subtotal());
        $quote->total = str_replace(',', '',Cart::total());
        $quote->payment_method = $this->payment_method;
        $quote->currency = env('CURRENCY');

        $company = Company::first();
        $quote->rfc = $company->rfc;
        $quote->note = $this->note;
        $quote->due_date = $this->due_date;
        $quote->paid_date = $this->paid_date;
        $quote->save();
        $this->id = $quote->id;

        foreach (Cart::content() as $item) {
            $quoteDetails = new QuoteDetail();
            $quoteDetails->quote_id = $quote->id;
            $quoteDetails->product_id = $item->id;
            $quoteDetails->quantity = $item->qty;

            $quoteDetails->price = $item->price;            
            $quoteDetails->total_price = $item->price * $item->qty;
            $quoteDetails->save();
        }

        Cart::destroy();
        $this->dispatch('newQuoteSweetalert');
        return redirect()->route('admin.quotes-list');

    }
}
