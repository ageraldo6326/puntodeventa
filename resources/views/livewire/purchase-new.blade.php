<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div><input type="button" class="btn btn-success float-right" wire:click="storePurchase" value="Grabar"></div>
                Fecha
                <strong>{{ date('d-m-Y') }}</strong>
                <div>Usuario: {{ Auth::user()->name }}</div>
                <div>Email: {{ Auth::user()->email }}</div>

                <span class="float-right"> <strong>Status:</strong> Pendiente</span>
                

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <label for="provider">Clientes:</label>
  
                            <select class="form-control" wire:change='setProvider' wire:model="idProvider" required>
                                <option>-- Proveedores --</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}" >{{ $provider->company }}</option> 
                                @endforeach
                            </select>
                            @error('idProvider')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                    </div>                    

                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="title">RNC</label>
                        <input type="text" class="form-control" wire:model="rfc" required>
                        @error('rfc')
                            <span class="text-danger">{{ $message }}</span>                      
                        @enderror
                      </div>
                    </div>                     

                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="title">NCF</label>
                        <input type="text" class="form-control" wire:model="nif" required>
                        @error('nif')
                            <span class="text-danger">{{ $message }}</span>                      
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="title"># Factura</label>
                        <input type="text" class="form-control" wire:model="factura" required>
                        @error('factura')
                            <span class="text-danger">{{ $message }}</span>                      
                        @enderror
                      </div>
                    </div>   
                    
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="title">Fecha de Compra</label>
                        <input type="date" class="form-control" wire:model="purchase_date" required>
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>                      
                        @enderror
                      </div>
                    </div>                     

                </div>


                <div class="row m-2">

                    <div class="col-md-1">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" wire:model="code" placeholder="Codigo" >
                    </div>

                    <div class="col-md-1 d-flex justify-content-left" style="margin-top: 30px">
                        <button type="button" class="btn btn-primary mb-auto" wire:click='setProduct'>
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    

                    <div class="col-md-3" wire:ignore>
                            <label for="product">Producto:</label><br>
                            <select class="form-control" id="product-select"  wire:change='setProduct' wire:model="idProduct" required>
                                <option>-- Producto --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-image="{{ '/storage/' . $product->image }}" >{{ $product->title }}</option>
                                    {{-- <option value="{{ $product->id }}" >{{ $product->title }}</option>  --}}
                                @endforeach
                            </select>
                            @error('idProduct')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <label for="product">Descripción:</label>
                        <span class="form-text">{{ $description}}</span>
                    </div>
                    <div class="col-md-1">
                        <label for="product">Precio:</label>
                        <input type="text" class="form-control" wire:model="price" placeholder="Precio" >
                    </div>
                    <div class="col-md-2">
                        <label for="product">Cantidad:</label>
                        <input type="number" class="form-control" wire:model="quantity" placeholder="Cantidad" >
                    </div>
                    <div class="col-md-1 d-flex justify-content-center " style="margin-top: 30px">
                        <button type="button" class="btn btn-primary mb-auto" wire:click='addProduct'>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                </div>


                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                                <th class="right">Total</th>
                                <th class="right"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach (Cart::content() as $item)

                            <tr>
                                <td class="center">{{ $item->id }}</td>
                                <td class="left strong">{{ $item->name }}</td>
                                <td class="left">{{ $item->options->description }}</td>

                                <td class="right">{{ number_format($item->price, 2) }}</td>
                                <td class="center">{{ $item->qty }}</td>
                                <td class="right">{{ number_format($item->price * $item->qty, 2) }}</td>
                                <td>
                                <input type="button" class="btn btn-danger btn-sm" value="x" x-on:click="$wire.removeProduct('{{ $item->rowId }}')">
                                </td>
                            </tr>
                                
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Métodos  de pago</strong>
                                    </td>
                                    <td class="right">
                                        <select class="form-control" wire:model="payment_method">
                                            <option value="">-- Metodo de pago --</option>
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Tarjeta">Tarjeta</option>
                                            <option value="Transferencia">Transferencia</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Transación ID</strong>
                                    </td>
                                    <td class="right">
                                        <input type="text" class="form-control" wire:model="transaction_id">
                                    </td>
                                </tr>                                
                                <tr>
                                    <td class="left">
                                        <strong>Fecha de vencimiento</strong>
                                    </td>
                                    <td class="right">
                                        <input type="date" class="form-control" wire:model="due_date">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Fecha de pago</strong>
                                    </td>
                                    <td class="right">
                                        <input type="date" class="form-control" wire:model="paid_date">
                                    </td>
                                </tr>                                
                                
                                
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">{{ Cart::subtotal() }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>ITBS (18%)</strong>
                                    </td>
                                    <td class="right">{{ Cart::tax(), 2 }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>{{ Cart::total() }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            <div class="card-footer">
                <div class="form-group">
                    <label for="nota">Nota</label>
                    <textarea class="form-control" wire:model="note" rows="3"></textarea>
                    <div><input type="button" class="btn btn-success float-right mt-2" wire:click="storePurchase" value="Grabar"></div>
                  </div>        
            </div>
        </div>
    </div>

</div>
