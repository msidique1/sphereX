<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'name',
        'jumlah',
    ];

    public function mahasiswa(): HasMany {
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosen(): HasOne {
        return $this->hasOne(Dosen::class);
    }

    public function request(): HasMany {
        return $this->hasMany(Request::class);
    }

    public function isFull(): bool {
        return $this->jumlah == $this->mahasiswa()->count() >= 10;
    }
}
