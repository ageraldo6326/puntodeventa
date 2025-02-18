<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteDetail extends Model
{
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
