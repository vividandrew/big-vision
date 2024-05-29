<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // ===================================
    //        CLASS VARIABLES
    //=====================================
    /**
     * @var integer
     */
    private int $id;
    /**
     * @var string
     */
    private string $Barcode;
    /**
     * @var float
     */
    private float $Price;
    /**
     * @var non-negative-int
     */
    private int $Stock;
    /**
     * @var string
     */
    private string $Name;
    /**
     * @var string
     */
    private string $Description;
    /**
     * @var string
     */
    private string $Platform;
    /**
     * @var integer
     */
    private int $GroupId;
    /**
     * @var float
     */
    private float $Discount;
    /**
     * @var string
     */
    private string $ImageUrl;
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

    //Used to grab the price with taking into consideration the discount
    public function getPrice() : float
    {
        $price = (float) $this->fillable['Price'];
        if($this->fillable['Discount'] > 0)
        {
            $discount = (float) $price * ((float)$this->fillable('Discount') / 100);
            $price -= $discount;
        }

        return $price;
    }
}
