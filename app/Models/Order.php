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

    // DATA BASE fillable
    protected $fillable = [
        'id',
        'OrderDate',
        'Status',
        'CustomerId',
    ];

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


    // ===================================
    //        GETTERS AND SETTERS
    //=====================================
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getOrderDate(): DateTime
    {
        return $this->OrderDate;
    }

    /**
     * @param DateTime $OrderDate
     */
    public function setOrderDate(DateTime $OrderDate): void
    {
        $this->OrderDate = $OrderDate;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->Status;
    }

    /**
     * @param string $Status
     */
    public function setStatus(string $Status): void
    {
        $this->Status = $Status;
    }

    /**
     * @return OrderLine[]
     */
    public function getOrderLines(): array
    {
        return $this->OrderLines;
    }

    /**
     * @param OrderLine[] $OrderLines
     */
    public function setOrderLines(array $OrderLines): void
    {
        $this->OrderLines = $OrderLines;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->CustomerId;
    }

    /**
     * @param string $CustomerId
     */
    public function setCustomerId(string $CustomerId): void
    {
        $this->CustomerId = $CustomerId;
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
