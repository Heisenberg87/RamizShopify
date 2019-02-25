<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $incrementing = false;

    /**
     * Get the variants for a product
     */
    public function variants()
    {
        return $this->hasMany('App\Variant');
    }

}
