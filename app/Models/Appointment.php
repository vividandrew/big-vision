<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;

class Appointment extends Model
{
    // ===================================
    //        CLASS VARIABLES
    //=====================================
    /**
     * @var string
     */
    private string $id;
    /**
     * @var Date
     */
    private Date $DateOf;
    /**
     * @var string
     */
    private string $Status;
    /**
     * @var string
     */
    private string $CustomerId;
    /**
     * @var string
     */
    private string $StaffId;
    /**
     * @var array<integer, Product>
     */
    private array $ProductsInvolved;
    /**
     * @var string
     */
    private string $AddressLine1;
    /**
     * @var string
     */
    private string $AddressLine2;
    /**
     * @var string
     */
    private string $Town;
    /**
     * @var string
     */
    private string $PostCode;
    /**
     * @var string
     */
    private String $LoyaltyNo;
    /**
     * @var Order[]
     */
    private array $Orders;
    /**
     * @var Appointment[]
     */
    private array $Appointments;


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
     * @return Date
     */
    public function getDateOf(): Date
    {
        return $this->DateOf;
    }

    /**
     * @param Date $DateOf
     */
    public function setDateOf(Date $DateOf): void
    {
        $this->DateOf = $DateOf;
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

    /**
     * @return string
     */
    public function getStaffId(): string
    {
        return $this->StaffId;
    }

    /**
     * @param string $StaffId
     */
    public function setStaffId(string $StaffId): void
    {
        $this->StaffId = $StaffId;
    }

    /**
     * @return Product[]
     */
    public function getProductsInvolved(): array
    {
        return $this->ProductsInvolved;
    }

    /**
     * @param Product[] $ProductsInvolved
     */
    public function setProductsInvolved(array $ProductsInvolved): void
    {
        $this->ProductsInvolved = $ProductsInvolved;
    }

    // ===================================
    //        CONSTRUCTORS
    //=====================================
    public function __construct(array $attributes = [
        //'id' => "-1",
        'DateOf' => new Date(),
        'Status' => "Test",
        'CustomerId' => "-1",
        'StaffId' => "-1",
        'ProductsInvolved' => [new Product(),],
    ])
    {
        //parent::__construct($attributes);
        //$this->id                   = $attributes['id'];
        $this->DateOf               = $attributes['DateOf'];
        $this->Status               = $attributes['Status'];
        $this->CustomerId           = $attributes['CustomerId'];
        $this->StaffId              = $attributes['StaffId'];
        $this->ProductsInvolved     = $attributes['ProductsInvolved'];
    }


    // ===================================
    //        GENERATED
    //=====================================
    protected function customerId(): BelongsTo
    {
        return $this->belongsTo(\User::class, 'CustomerId');
    }

    protected function staffId(): BelongsTo
    {
        return $this->belongsTo(\User::class, 'StaffId');
    }

    protected function casts()
    {
        return [
            'DateOf' => 'datetime',
        ];
    }
}
