<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = "kecamatan";
    protected $primaryKey = 'id_kecamatan';
    protected $fillable = [
        'nama_kecamatan',
        'geojson',
    ];

    public function anak(): HasMany
    {
        return $this->hasMany(Anak::class, 'id_kecamatan', 'id_kecamatan');
    }
}
