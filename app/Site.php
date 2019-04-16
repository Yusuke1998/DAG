<?php
// UBICACION
namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
    	'site','area_id','product_id',
    ];

    public function area(){
    	return $this->belognsTo(Area::class);
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }
}
