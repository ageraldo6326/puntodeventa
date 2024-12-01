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

class EditPurchase extends Component
{

    public $id, $idProduct, $title, $price = 0.0, $quantity = 1, $description, $stock, $image, $idProvider, $nameProvider, $nif, $rfc, 
    $factura, $note, $payment_method, $payment_status, $due_date, $paid_date, $purchase_date, $purchase_id, $purchase, $purchase_details, $currency, $total, 
    $subtotal, $tax_itbs, $transaction_id, $code ;

    public function mount($purchase)
    {
        Cart::destroy();

        $this->purchase_id = $purchase;

        $this->purchase = Purchase::find($this->purchase_id); 

        $this->purchase_details = PurchaseDetail::where('purchase_id', $this->purchase->id)->get();

        foreach ($this->purchase_details as $purchase_detail) {
            $product = Product::find($purchase_detail->product_id);
            Cart::add($product->id, $product->title, $purchase_detail->quantity, $purchase_detail->price, ['description' => $product->description],18);
        }


        $this->idProduct = "";

        $this->total = str_replace(',', '', Cart::total());

        $this->subtotal = str_replace(',', '', Cart::subtotal());

        $this->tax_itbs = str_replace(',', '', Cart::tax());

        $this->currency = $this->purchase->currency;

        $this->note = $this->purchase->note;

        $this->payment_method = $this->purchase->payment_method;

        $this->factura = $this->purchase->factura;

        $this->purchase_date = $this->purchase->purchase_date;

        $this->payment_status = $this->purchase->payment_status;

        $this->due_date = $this->purchase->due_date;

        $this->paid_date = $this->purchase->paid_date;

        $this->nif = $this->purchase->nif;

        $this->rfc = $this->purchase->rfc;

        $this->idProvider = $this->purchase->provider_id;

        $this->transaction_id = $this->purchase->transaction_id;



    }
    public function render()
    {
        $products = Product::all();
        $providers = Provider::all();
        $purchase = Purchase::find($this->id);
        return view('livewire.edit-purchase', compact('products', 'providers', 'purchase'));
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


    public function updatePurchase(){
        $this->validate([
            'idProvider' => 'required',
        ]);

        $purchase = Purchase::find($this->purchase_id);
        $purchase->purchase_date = $this->purchase_date;
        $purchase->tax_itbs = str_replace(',', '', Cart::tax());
        $purchase->subtotal = str_replace(',', '',Cart::subtotal());
        $purchase->total = str_replace(',', '',Cart::total());
        $purchase->payment_method = $this->payment_method;
        $purchase->transaction_id = $this->transaction_id;
        $purchase->payment_status = $this->payment_status;
        $purchase->due_date = $this->due_date;
        $purchase->paid_date = $this->paid_date;
        $purchase->currency = 'USD';
        $purchase->note = $this->note;
        $purchase->save();


        PurchaseDetail::where('purchase_id', $this->purchase_id)->delete();

        foreach (Cart::content() as $item) {
            $purchaseDetail = new PurchaseDetail();
            $purchaseDetail->purchase_id = $this->purchase_id;

            $product = Product::find($item->id);
            $diferencia = $item->qty - $product->stock;
            $product->stock += $diferencia;
            $product->save();
            
            $purchaseDetail->product_id = $item->id;
            $purchaseDetail->quantity = $item->qty;
            $purchaseDetail->price = $item->price;            
            $purchaseDetail->total_price = $item->price * $item->qty;
            $purchaseDetail->save();
        }

        Cart::destroy();
        $this->dispatch('updatePurchaseSweetalert');
        sleep(2);
        return redirect()->route('admin.purchases-list');
    }
}
