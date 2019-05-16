<?php
// COMPRAS
namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $fillable = [
    	'date','supplier','price','quantity','product_id','unity_m'
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
