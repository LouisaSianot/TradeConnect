<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPosting extends Model
{
    use HasFactory;

    protected $table = 'jobs_board';

    protected $fillable = [
        'customer_id',
        'trade_category_id',
        'tradesperson_id',
        'title',
        'description',
        'location',
        'status',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function tradesperson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tradesperson_id');
    }

    public function tradeCategory(): BelongsTo
    {
        return $this->belongsTo(TradeCategory::class);
    }

    public function isOpen(): bool
    {
        return $this->status === 'open';
    }
}