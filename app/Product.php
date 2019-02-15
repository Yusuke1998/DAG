<?php
// PRODUCTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'code','name','description','image','unity_m','date_maturity',
    ];

    public function area(){
    	return $this->belognsTo(Area::class);
    }

    public function site(){
    	return $this->belognsTo(Site::class);
    }

    public function entrances(){
    	return $this->belognsTo(Entrance::class);
    }

    public function delivery(){
    	return $this->belognsTo(Delivery::class);
    }

    public function shoppings(){
    	return $this->belognsTo(Shopping::class);
    }
}
