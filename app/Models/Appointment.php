<?php

namespace App\Models;

use Carbon\Carbon;
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
     * @var string
     */
    private string $DateOf;
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

    protected $fillable =
        [
            'id',
            'Status',
            'DateOf',
            'CustomerId',
            'StaffId',
        ];

    private $CustomerName;
    private $StaffName;

    // ===================================
    //        CONSTRUCTORS
    //=====================================
    public function __construct(array $attributes = [
        'id' => "-1",
        'DateOf' => null,
        'Status' => "Test",
        'CustomerId' => "-1",
        'StaffId' => "-1",
        //'ProductsInvolved' => [new Product(),],
    ])
    {
        //parent::__construct($attributes);
        //$this->id                   = $attributes['id'];
        $this->DateOf               = Carbon::now()->format('Y-m-d H:i:s');
        $this->Status               = $attributes['Status'];
        $this->CustomerId           = $attributes['CustomerId'];
        $this->StaffId              = $attributes['StaffId'];
        //$this->ProductsInvolved     = $attributes['ProductsInvolved'];
    }

    public function allDB()
    {
        return[
            'DateOf' => $this->DateOf,
            'Status' => $this->Status,
            'CustomerId' => $this->CustomerId,
            'StaffId' => $this->StaffId
        ];
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
