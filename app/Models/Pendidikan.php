<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = "pendidikan";
    protected $primaryKey = 'id_pendidikan';
    protected $fillable = [
        'pendidikan'
    ];
    public function anak(): HasMany
    {
        return $this->hasMany(Anak::class, 'id_pendidikan', 'id_pendidikan');
    }
}
