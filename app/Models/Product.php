<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Description',
        'Price',
        'Stock',
        'Barcode',
        'Platform',
        'Discount',
        'ImageUrl'
    ];

    //Used to grab the price of a product including discount
    public function getPrice() : float
    {
        $price = $this->Price;
        if($this->Discount > 0)
        {
            $discount = number_format((float) $price * ((float)$this->Discount / 100), 2);
            $price -= $discount;
        }

        return $price;
    }
}
