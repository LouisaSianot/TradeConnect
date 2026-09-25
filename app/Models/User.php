<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyPhone; // optional custom contract, see note below
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function tradespersonProfile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
         return $this->hasOne(TradespersonProfile::class);
    }
    public function jobsPosted(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
          return $this->hasMany(JobPosting::class, 'customer_id');
    }
 
    public function jobsAssigned(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
          return $this->hasMany(JobPosting::class, 'tradesperson_id');
    }
}