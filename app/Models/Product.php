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
        'Price',
        'Stock',
        'Barcode',
        'Platform',
        'Discount',
        'ImageUrl'
    ];
}
