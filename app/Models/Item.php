<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'sku', 'description', 'price', 'is_active'];

    protected $casts = [
        'name' => 'string',
        'sku' => 'string',
        'description' => 'string',
        'price' => 'integer',
        'is_active' => 'integer',
    ];
}

