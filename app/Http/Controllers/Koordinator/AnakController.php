<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak as Model;
use App\Models\Pendidikan;
use App\Models\KelasPendidikan;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Survior;

class AnakController extends Controller
{
    //
    private $viewIndex = 'anak.index';
    private $routePrefix = 'anak';
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
        $data['route_export'] = 'export-verifikasi-anak';
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
            ->where('status_verifikasi', '=', '0')
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
        return view('koordinator.' . $this->viewIndex, $data);
    }
    public function detail_anak($id)
    {
        $anak = Model::join('pekerjaan', 'pekerjaan.id_pekerjaan', '=', 'anak.id_pekerjaan_wali')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'anak.id_pendidikan')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'anak.id_kecamatan')
            ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
            // ->join('dusun', 'dusun.id_dusun', '=', 'anak.id_dusun')

            ->join('kelas_pendidikan', 'kelas_pendidikan.id_kelas_pendidikan', '=', 'anak.id_kelas_pendidikan')
            // ->where('anak.created_at', '>=', date('Y-m-d 00:00:00'))
            ->where('id_anak', '>=', $id)
            ->get()->first();
        // dd($anak);
        return view('koordinator.anak.detail_anak', compact('anak'));
    }
    public function verifi_anak($id)
    {
        $anak = Model::findOrFail($id);
        $anak->update([
            'status_verifikasi' => 1
        ]);
        if ($anak) {
            return redirect()
                ->route('sdh-verifikasi')
                ->with([
                    'success' => 'Data has been verivaction successfully'
                ]);
        } else {
            return redirect()
                ->route('sdh-verifikasi')
                ->with([
                    'error' => 'Data has been wrong'
                ]);
        }
    }
    public function sdh_verifikasi(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['id_survior'] = $request->query('id_survior');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');
        // $data['id_dusun'] = $request->query('id_dusun');
        $data['title'] = 'Data Anak';
        $data['route_export'] = 'export-verifikasi-sudah-anak';
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
            ->where('status_verifikasi', '=', '1')
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
        return view('koordinator.' . $this->viewIndex, $data);
    }
    public function export_verifikasi_anak(Request $request)
    {
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');

        $data['title'] = 'Data Anak';
        $data['routePrefix'] = $this->routePrefix;
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $query = Model::with('pendidikan', 'kelas_pendidikan', 'kecamatan', 'desa')
            ->where('status_verifikasi', '=', '0');
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        $data['models'] = $query->latest()->get();
        // dd($data['models']);

        return view('survior.anak.export', $data);
    }
    public function export_verifikasi_sudah_anak(Request $request)
    {
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');

        $data['title'] = 'Data Anak';
        $data['routePrefix'] = $this->routePrefix;
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $query = Model::with('pendidikan', 'kelas_pendidikan', 'kecamatan', 'desa')
            ->where('status_verifikasi', '=', '1');
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        $data['models'] = $query->latest()->get();
        // dd($data['models']);

        return view('survior.anak.export', $data);
    }
}
