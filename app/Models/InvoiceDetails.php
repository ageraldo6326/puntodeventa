<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }   

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
