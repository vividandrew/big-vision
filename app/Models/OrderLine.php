<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderLine extends Model
{
    // ===================================
    //        CLASS VARIABLES
    //=====================================
    /**
     * @var integer
     */
    private int $Id;
    /**
     * @var integer
     */
    private int $ProductId;
    /**
     * @var integer
     */
    private int $Quantity;
    /**
     * @var integer
     */
    private int $OrderId;

    //


    public function allDB()
    {
        return [
        $this->ProductId,
        $this->Quantiy,
        $this->OrderId,
        ];
    }

    // ===================================
    //        GETTERS AND SETTERS
    //=====================================
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * @param int $Id
     */
    public function setId(int $Id): void
    {
        $this->Id = $Id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->ProductId;
    }

    /**
     * @param int $ProductId
     */
    public function setProductId(int $ProductId): void
    {
        $this->ProductId = $ProductId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->Quantity;
    }

    /**
     * @param int $Quantity
     */
    public function setQuantity(int $Quantity): void
    {
        $this->Quantity = $Quantity;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->OrderId;
    }

    /**
     * @param int $OrderId
     */
    public function setOrderId(int $OrderId): void
    {
        $this->OrderId = $OrderId;
    }
    // ===================================
    //        CONSTRUCTORS
    //=====================================
    public function __construct(array $attributes =
                                [
                                    //'id' => -1,
                                    'ProductId' => -1,
                                    'Quantity' => 0,
                                    'OrderId' => -1
                                ])
    {
        //parent::__construct($attributes);
        $this->Id           = $attributes['id'];
        $this->ProductId    = $attributes['ProductId'];
        $this->Quantity     = $attributes['Quantity'];
        $this->OrderId      = $attributes['OrderId'];
    }

    // ===================================
    //        GENERATED
    //=====================================
    protected function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
