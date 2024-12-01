<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Provider;
use App\Models\Purchase;
use Livewire\Attributes\On;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class PurchaseNew extends Component
{

    public $id, $idProduct, $title, $price = 0.0, $quantity = 1, $description, $stock, $image, $idProvider, $nameProvider, $nif, $rfc, 
    $factura, $note, $payment_method, $due_date, $paid_date, $purchase_date, $transaction_id, $code;

    function mount(){
        $this->reset();
        Cart::destroy();
    }
    public function render()
    {
        $products = Product::all();
        $providers = Provider::all();
        return view('livewire.purchase-new', compact('products', 'providers'));
    }

    public function setProduct(){

        $product = Product::Where('code', $this->code)->first();
        if ($product) {
            $this->title = $product->title;
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
            $this->description = $product->description;
            $this->image = $product->image;
            $this->stock = $product->stock;
            $this->code = $product->code;
            $this->idProduct = $product->id;
        } else {
            $this->reset(['idProduct', 'quantity', 'price', 'description', 'image', 'code']);
        }

    }


    public function setProvider(){
        
        $provider = Provider::find($this->idProvider);
        if ($provider) {
            $this->nameProvider = $provider->name . ' ' . $provider->last_name;
            $this->rfc = $provider->rfc;
        }

    }    

    public function addProduct(){

        $this->validate([
            'idProduct' => 'required',
        ]);

        $product = Product::find($this->idProduct);
        Cart::add($product->id, $product->title, $this->quantity, $this->price, ['description' => $product->description],18);
        $this->reset(['idProduct', 'quantity', 'price', 'description', 'image', 'stock', 'code']);
        
    }

    public function removeProduct($rowId){
        Cart::remove($rowId);
    }

    public function storePurchase(){

        $this->validate([
            'idProvider' => 'required',
        ]);

        $purchase = new Purchase();
        $purchase->provider_id = $this->idProvider;
        $purchase->user_id = Auth::user()->id; 
        $purchase->purchase_date = $this->purchase_date;
        $purchase->tax_itbs = str_replace(',', '', Cart::tax());
        $purchase->subtotal = str_replace(',', '',Cart::subtotal());
        $purchase->total = str_replace(',', '',Cart::total());
        $purchase->payment_method = $this->payment_method;
        $purchase->transaction_id = $this->transaction_id;
        $purchase->currency = env('CURRENCY');
        $purchase->factura = $this->factura;

        $provider = Provider::find($this->idProvider);
        $purchase->rfc = $provider->rfc;

        $purchase->nif = $this->nif;
        $purchase->note = $this->note;
        $purchase->due_date = $this->due_date;
        $purchase->paid_date = $this->paid_date;
        $purchase->save();
        $this->id = $purchase->id;

        foreach (Cart::content() as $item) {
            $purchaseDetail = new PurchaseDetail();
            $purchaseDetail->purchase_id = $purchase->id;
            $purchaseDetail->product_id = $item->id;
            $purchaseDetail->quantity = $item->qty;

            $product = Product::find($item->id);
            $product->stock = $product->stock + $item->qty;
            $product->save();
            

            $purchaseDetail->price = $item->price;            
            $purchaseDetail->total_price = $item->price * $item->qty;
            $purchaseDetail->save();
        }

        Cart::destroy();
        $this->dispatch('newPurchaseSweetalert');
        sleep(2);
        return redirect()->route('admin.purchases-list');

    }

}
