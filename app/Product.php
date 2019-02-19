<?php
// PRODUCTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'code','name','description','image','unity_m','quantity','date_maturity',
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

    public function delivery(){
    	return $this->belongsTo(Delivery::class);
    }

    public function shopping(){
    	return $this->belongsTo(Shopping::class);
    }
}
