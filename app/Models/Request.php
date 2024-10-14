<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'mahasiswa_id',
        'kelas_id',
        'keterangan',
    ];

    public function mahasiswa(): BelongsTo {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function kelas(): BelongsTo {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
