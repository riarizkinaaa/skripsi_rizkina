<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    use HasFactory;
    protected $table = "koordinator";
    protected $primaryKey = 'id_koordinator';
    protected $fillable = [
        'id_user','id_kecamatan','nama',  'nik', 'alamat', 'email', 'no_hp'
    ];
}
