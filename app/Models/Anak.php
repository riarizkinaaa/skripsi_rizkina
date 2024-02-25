<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anak extends Model
{
    use HasFactory;
    protected $table = "anak";
    protected $primaryKey = 'id_anak';
    protected $fillable = [
        'id_survior', 'id_pekerjaan_wali', 'id_pendidikan', 'id_kecamatan', 'id_desa', 'id_dusun', 'id_kelas_pendidikan', 'nama_anak', 'nomor_kk', 'nomor_nik', 'alamat', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'usia', 'nama_wali', 'alamat_sekolah', 'status_anak', 'foto_anak', 'status_verifikasi', 'latitide', 'longitude', 'tahun'
    ];
    public function survior(): HasMany
    {
        return $this->hasMany(Survior::class, 'id_survior', 'id_survior');
    }
    public function pendidikan(): BelongsTo
    {
        return $this->belongsTo(Pendidikan::class, 'id_pendidikan', 'id_pendidikan');
    }
    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan', 'id_pekerjaan_wali');
    }
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }
    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id_desa');
    }
    public function kelas_pendidikan(): BelongsTo
    {
        return $this->belongsTo(KelasPendidikan::class, 'id_kelas_pendidikan', 'id_kelas_pendidikan');
    }
}
