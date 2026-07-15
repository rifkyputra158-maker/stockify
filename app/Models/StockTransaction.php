<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'type', 'quantity', 'date', 'status', 'notes','confirmed_by'];

public function product()
{   
    return $this->belongsTo(Product::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
public function confirmedBy()
{
    return $this->belongsTo(User::class, 'confirmed_by');
}
}
