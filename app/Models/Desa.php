<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    use HasFactory;
    protected $table = "desa";
    protected $primaryKey = 'id_desa';
    protected $fillable = [
        'id_kecamatan', 'nama_desa'
    ];
    public function anak(): HasMany
    {
        return $this->hasMany(Anak::class, 'id_desa', 'id_desa');
    }
}
