<?php

namespace App\Domain\Profile;

use App\Domain\User\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'photo',
        'bio',
        'networks',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
