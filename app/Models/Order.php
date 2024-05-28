<?php

namespace App\Models;

use Carbon\Carbon;
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
     * @var string
     */
    private string $OrderDate;
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
        'PointsSpent',
    ];


    // ===================================
    //        PRIVATE FUNCTIONS
    //=====================================
    /**
     * @return float
     */
    private function calcTotal() : float
    {
        $total = (float) 0.00;
        foreach($this->OrderLines as $ol)
        {
            $total += (float) $ol->Quantity * $ol->product->Price;
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
            'OrderDate' => Carbon::now()->format('Y-m-d H:i:s'),
            'Status' => $this->Status,
            'CustomerId' => $this->CustomerId,
            'PointsSpent' => $this->fillable['PointsSpent'],
        ];
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->calcTotal() - ($this->PointsSpent * 0.1);
    }

    // ===================================
    //        CONSTRUCTORS
    //=====================================
    public function __construct(array $attributes = [
        //'id' => "-1",
        'OrderDate' => null,
        'Status' => "Test",
        'OrderLines' => [],
        'CustomerId' => "-1"
    ])
    {
        //parent::__construct($attributes);
        //$this->id           = $attributes['id'];
        $this->fillable['OrderDate']    = Carbon::now()->format('Y-m-d H:i:s');
        $this->fillable['Status']       = $attributes['Status'];
        $this->fillable['CustomerId']   = $attributes['CustomerId'];
        $this->fillable['PointsSpent']  = 0;

        $this->OrderDate    = Carbon::now()->format('Y-m-d H:i:s');
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
