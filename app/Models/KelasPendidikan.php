<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KelasPendidikan extends Model
{
    use HasFactory;
    protected $table = "kelas_pendidikan";
    protected $primaryKey = 'id_kelas_pendidikan';
    protected $fillable = [
        'kelas_pendidikan'
    ];
    public function anak(): HasMany
    {
        return $this->hasMany(Anak::class, 'id_kelas_pendidikan', 'id_kelas_pendidikan');
    }
}
