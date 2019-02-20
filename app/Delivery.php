<?php
// ENTREGAS
namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
    	'quantity','date','commentary','functionary_e','functionary_s','area_id','product_id',
    ];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
