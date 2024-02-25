<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $table = "pekerjaan";
    protected $primaryKey = 'id_pekerjaan';
    protected $fillable = [
        'pekerjaan'
    ];
    public function anak(): HasMany
    {
        return $this->hasMany(Anak::class, 'id_pekerjaan_wali', 'id_pekerjaan');
    }
}
