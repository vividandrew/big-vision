<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visionary extends Model
{
    // ===================================
    //        CLASS VARIABLES
    //=====================================
    private string $LoyaltyNo;
    private int $LoyaltyPoints;
    private string $CustomerId;

    protected $fillable = [
        'LoyaltyNo',
        'LoyaltyPoints',
        'CustomerId',
    ];

    public function allDb()
    {
        return [
            'LoyaltyNo' => $this->LoyaltyNo,
            'LoyaltyPoints' => $this->LoyaltyPoints,
            'CustomerId' => $this->CustomerId,
        ];
    }

    // ===================================
    //        CONSTRUCTORS
    //=====================================
    public function __construct(array $attributes = [
        'LoyaltyNo' => "-1",
        'LoyaltyPoints' => 0,
        'CustomerId' => "-1"
    ])
    {
        $this->fillable['LoyaltyNo']        = $attributes['LoyaltyNo'];
        $this->fillable['LoyaltyPoints']    = $attributes['LoyaltyPoints'];
        $this->fillable['CustomerId']       = $attributes['CustomerId'];

        $this->LoyaltyNo        = $attributes['LoyaltyNo'];
        $this->LoyaltyPoints    = $attributes['LoyaltyPoints'];
        $this->CustomerId       = $attributes['CustomerId'];
    }
    // ===================================
    //        GENERATED
    //=====================================
    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
