<?php
// ENTRADAS
namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    protected $fillable = [
    	'reception','commentary','date','product_id','quantity',
    ];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
