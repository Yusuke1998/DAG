<?php
// PRODUCTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code','name','description','unity_m','quantity','date_maturity',
    ];

    public function area(){
    	return $this->belongsTo(Area::class);
    }

    public function site(){
    	return $this->belongsTo(Site::class);
    }

    public function entrances(){
    	return $this->hasMany(Entrance::class);
    }

    public function deliverys(){
    	return $this->hasMany(Delivery::class);
    }

    public function shoppings(){
    	return $this->hasMany(Shopping::class);
    }
}
