<?php

namespace App\Models;

use Faker\Core\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{

    // ===================================
    //        CLASS VARIABLES
    //=====================================
    /**
     * @var string
     */
    private string $id;
    /**
     * @var DateTime
     */
    private DateTime $OrderDate;
    /**
     * TODO: To Set Variables status is able to be
     *
     * @var string
     */
    private string $Status;
    /**
     * @var array<integer, OrderLine>
     */
    public array $OrderLines;
    /**
     * @var string
     */
    private string $CustomerId;
    /**
     * @var float
     */
    public float $Total;

    // DATA BASE fillable
    protected $fillable = [
        'id',
        'OrderDate',
        'Status',
        'CustomerId',
    ];

    // ===================================
    //        PRIVATE FUNCTIONS
    //=====================================
    /**
     * @return int
     */
    private function calcTotal() : int
    {
        $total = 0.00;
        foreach($this->OrderLines as $ol)
        {
            $total += $ol->Quantity * $ol->product->Price;
        }
        return $total;
    }

    // ===================================
    //        GETTERS AND SETTERS
    //=====================================
    /**
     * @return array
     */
    public function allDB() : array
    {
        return[
            'OrderDate' => date('d/m/y H:i'),
            'Status' => $this->Status,
            'CustomerId' => $this->CustomerId,
        ];
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->calcTotal();
    }

    // ===================================
    //        CONSTRUCTORS
    //=====================================
    public function __construct(array $attributes = [
        //'id' => "-1",
        'OrderDate' => new DateTime(),
        'Status' => "Test",
        'OrderLines' => [],
        'CustomerId' => "-1"
    ])
    {
        //parent::__construct($attributes);
        //$this->id           = $attributes['id'];
        $this->OrderDate    = $attributes['OrderDate'];
        $this->Status       = $attributes['Status'];
        $this->OrderLines   = $attributes['OrderLines'];
        $this->CustomerId   = $attributes['CustomerId'];
    }


    // ===================================
    //        GENERATED
    //=====================================
    protected function customerId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CustomerId');
    }

    protected function casts()
    {
        return [
            'OrderDate' => 'datetime',
        ];
    }
}
