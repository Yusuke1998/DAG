<?php
// AREA
namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
    	'name','description',
    ];

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function sites(){
    	return $this->hasMany(Site::class);
    }
}
