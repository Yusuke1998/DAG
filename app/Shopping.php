<?php
// COMPRAS
namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $fillable = [
    	'date','supplier','price','quantity','product_id',
    ];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
