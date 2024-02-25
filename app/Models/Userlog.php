<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userlog extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = 'id';
    protected $fillable = [
        'username', 'password', 'aktif', 'id_role',
    ];
}
