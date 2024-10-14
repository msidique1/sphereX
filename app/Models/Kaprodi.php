<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kaprodi extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'kaprodi';

    protected $fillable = [
        'user_id',
        'kode_dosen',
        'nip',
        'name',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
