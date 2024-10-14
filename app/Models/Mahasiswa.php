<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'edit',
        'kelas_id',
    ];

    public function kelas(): BelongsTo {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function request(): HasOne {
        return $this->hasOne(Request::class);
    }
}
