<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradespersonProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trade_category_id',
        'location',
        'hourly_rate',
        'bio',
        'id_document_path',
        'verification_status',
    ];

    protected function casts(): array
    {
        return [
            'hourly_rate' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tradeCategory(): BelongsTo
    {
        return $this->belongsTo(TradeCategory::class);
    }

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }
}