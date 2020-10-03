<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function companies()
    {
    	return $this->BelongsTo(Company::class);
    }
}
