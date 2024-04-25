<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visionary extends Model
{
    // ===================================
    //        CLASS VARIABLES
    //=====================================
    private string $loyaltyNo;
    private int $LoyaltyPoints;
    private string $CustomerId;
    // ===================================
    //        GETTERS AND SETTERS
    //=====================================
    /**
     * @return string
     */
    public function getLoyaltyNo(): string
    {
        return $this->loyaltyNo;
    }

    /**
     * @param string $loyaltyNo
     */
    public function setLoyaltyNo(string $loyaltyNo): void
    {
        $this->loyaltyNo = $loyaltyNo;
    }

    /**
     * @return int
     */
    public function getLoyaltyPoints(): int
    {
        return $this->LoyaltyPoints;
    }

    /**
     * @param int $LoyaltyPoints
     */
    public function setLoyaltyPoints(int $LoyaltyPoints): void
    {
        $this->LoyaltyPoints = $LoyaltyPoints;
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
        'LoyaltyNo' => "-1",
        'LoyaltyPoints' => 0,
        'CustomerId' => "-1"
    ])
    {
        parent::__construct($attributes);
        $this->loyaltyNo        = $attributes['loyaltyNo'];
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
