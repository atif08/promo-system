<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;
    protected $guarded = [];

    const Percent = 'percent';
    const Flat = 'flat';

    /**
     * Set the promo code to uppercase.
     *
     * @param  string  $value
     * @return void
     */
    public function setPromoCodeAttribute($value): void
    {
        $this->attributes['promo_code'] = strtoupper($value);
    }

    public function hasLimit(): bool
    {
        return $this->usage_limit <= 0;
    }
}
