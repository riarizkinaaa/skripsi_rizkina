<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak as Model;
use App\Models\Pendidikan;
use App\Models\KelasPendidikan;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Survior;
use Carbon\Carbon;

class AnakController extends Controller
{
    //
    private $viewIndex = 'anak.index';
    private $routePrefix = 'data-anak';
    
    public function index(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['id_survior'] = $request->query('id_survior');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');
        // $data['id_dusun'] = $request->query('id_dusun');
        $data['title'] = 'Data Anak';
        $data['routePrefix'] = $this->routePrefix;
        $data['kecamatan'] = Kecamatan::pluck('nama_kecamatan', 'id_kecamatan');
        $data['survior'] = Survior::pluck('nama_lengkap', 'id_survior');
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $data['desa'] = Desa::pluck('nama_desa', 'id_desa');

        $query = Model::join('survior', 'survior.id_survior', '=', 'anak.id_survior')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'anak.id_pendidikan')
            ->join('kelas_pendidikan', 'kelas_pendidikan.id_kelas_pendidikan', '=', 'anak.id_kelas_pendidikan')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'anak.id_kecamatan')
            ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
            ->whereYear('anak.tgl_lahir', '>', now()->year - 19) // Filter anak yang berusia kurang dari 19 tahun
            ->where(function ($query) use ($data) {
                $query->where('nomor_nik', 'like', '%' . $data['q'] . '%');
            });

        if ($data['id_survior'])
            $query->where('anak.id_survior', $data['id_survior']);
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        if ($data['id_kecamatan'])
            $query->where('anak.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa']);

            
        $data['models'] = $query->paginate(10)->appends($_GET);
        foreach ($data['models'] as $anak) {
            $tanggal_lahir = Carbon::parse($anak->tgl_lahir);
            $usia = $tanggal_lahir->diff(Carbon::now())->format('%y th, %m bln, %d h');
            $anak->usia = $usia;
        }
        return view('pimpinan.' . $this->viewIndex, $data);
    }
    public function belum_verifikasi(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['id_survior'] = $request->query('id_survior');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');
        // $data['id_dusun'] = $request->query('id_dusun');
        $data['title'] = 'Data Anak';
        $data['routePrefix'] = 'belum_verifikasi';
        $data['kecamatan'] = Kecamatan::pluck('nama_kecamatan', 'id_kecamatan');
        $data['survior'] = Survior::pluck('nama_lengkap', 'id_survior');
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $data['desa'] = Desa::pluck('nama_desa', 'id_desa');

        $query = Model::join('survior', 'survior.id_survior', '=', 'anak.id_survior')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'anak.id_pendidikan')
            ->join('kelas_pendidikan', 'kelas_pendidikan.id_kelas_pendidikan', '=', 'anak.id_kelas_pendidikan')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'anak.id_kecamatan')
            ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
            ->where('anak.status_verifikasi', 0)
            ->whereYear('anak.tgl_lahir', '>', now()->year - 19) // Filter anak yang berusia kurang dari 19 tahun
            ->where(function ($query) use ($data) {
                $query->where('nomor_nik', 'like', '%' . $data['q'] . '%');
            });
        if ($data['id_survior'])
            $query->where('anak.id_survior', $data['id_survior']);
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        if ($data['id_kecamatan'])
            $query->where('anak.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa']);

        $data['models'] = $query->paginate(10)->appends($_GET);
        foreach ($data['models'] as $anak) {
            $tanggal_lahir = Carbon::parse($anak->tgl_lahir);
            $usia = $tanggal_lahir->diff(Carbon::now())->format('%y th, %m bln, %d h');
            $anak->usia = $usia;
        }
        return view('pimpinan.anak.belum_verifikasi', $data);
    }
    public function sudah_verifikasi(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['id_survior'] = $request->query('id_survior');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');
        // $data['id_dusun'] = $request->query('id_dusun');
        $data['title'] = 'Data Anak';
        $data['routePrefix'] = 'sudah_verifikasi';
        $data['kecamatan'] = Kecamatan::pluck('nama_kecamatan', 'id_kecamatan');
        $data['survior'] = Survior::pluck('nama_lengkap', 'id_survior');
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $data['desa'] = Desa::pluck('nama_desa', 'id_desa');

        $query = Model::join('survior', 'survior.id_survior', '=', 'anak.id_survior')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'anak.id_pendidikan')
            ->join('kelas_pendidikan', 'kelas_pendidikan.id_kelas_pendidikan', '=', 'anak.id_kelas_pendidikan')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'anak.id_kecamatan')
            ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
            ->where('anak.status_verifikasi', 1)
            ->whereYear('anak.tgl_lahir', '>', now()->year - 19) // Filter anak yang berusia kurang dari 19 tahun
            ->where(function ($query) use ($data) {
                $query->where('nomor_nik', 'like', '%' . $data['q'] . '%');
            });

        if ($data['id_survior'])
            $query->where('anak.id_survior', $data['id_survior']);
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        if ($data['id_kecamatan'])
            $query->where('anak.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa']);

        $data['models'] = $query->paginate(10)->appends($_GET);
        foreach ($data['models'] as $anak) {
            $tanggal_lahir = Carbon::parse($anak->tgl_lahir);
            $usia = $tanggal_lahir->diff(Carbon::now())->format('%y th, %m bln, %d h');
            $anak->usia = $usia;
        }
        return view('pimpinan.anak.sudah_verifikasi', $data);
    }
    public function export_anak(Request $request)
    {
        $data['id_survior'] = $request->query('id_survior');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');

        $query = Model::with('pendidikan', 'kelas_pendidikan', 'kecamatan', 'desa');
        if ($data['id_survior'])
            $query->where('anak.id_survior', $data['id_survior']);
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        if ($data['id_kecamatan'])
            $query->where('anak.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa']);
        $data['models'] = $query->latest()->get();
        // dd($data['models']);
        return view('survior.anak.export', $data);
    }
    public function export_anak_belum(Request $request)
    {
        $data['id_survior'] = $request->query('id_survior');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');

        $query = Model::with('pendidikan', 'kelas_pendidikan', 'kecamatan', 'desa')
            ->where('anak.status_verifikasi', 0);
        if ($data['id_survior'])
            $query->where('anak.id_survior', $data['id_survior']);
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        if ($data['id_kecamatan'])
            $query->where('anak.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa']);
        $data['models'] = $query->latest()->get();
        // dd($data['models']);
        return view('survior.anak.export', $data);
    }
    public function export_anak_sudah(Request $request)
    {
        $data['id_survior'] = $request->query('id_survior');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');

        $query = Model::with('pendidikan', 'kelas_pendidikan', 'kecamatan', 'desa')
            ->where('anak.status_verifikasi', 1);
        if ($data['id_survior'])
            $query->where('anak.id_survior', $data['id_survior']);
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        if ($data['id_kecamatan'])
            $query->where('anak.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa']);
        $data['models'] = $query->latest()->get();
        // dd($data['models']);
        return view('survior.anak.export', $data);
    }
}
