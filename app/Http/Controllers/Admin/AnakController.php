<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak as Model;
use App\Models\Anak;
use App\Models\Survior;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Dusun;
use App\Models\KelasPendidikan;
use  Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnakController extends Controller
{
    private $viewIndex = 'anak.index';
    private $viewCreate = 'anak.formadd';
    private $viewEdit = 'anak.formedit';
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
        $data['routePrefix'] = $this->routePrefix;
        $data['kecamatan'] = Kecamatan::pluck('nama_kecamatan', 'id_kecamatan');
        $data['survior'] = Survior::pluck('nama_lengkap', 'id_survior');
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $data['desa'] = Desa::pluck('nama_desa', 'id_desa');

        // menghitung jumlah anak
        $id_kecamatan = $request->input('id_kecamatan'); // Ambil id_kecamatan dari request

// $anakPerKecamatan = Anak::select('id_kecamatan', DB::raw('count(*) as total_anak'))
//     ->where('id_kecamatan', $id_kecamatan) // Menyaring berdasarkan id_kecamatan yang dipilih
//     ->groupBy('id_kecamatan')
//     ->get();
    
        // akhirnya

        $query = Model::join('survior', 'survior.id_survior', '=', 'anak.id_survior')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'anak.id_pendidikan')
            ->join('kelas_pendidikan', 'kelas_pendidikan.id_kelas_pendidikan', '=', 'anak.id_kelas_pendidikan')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'anak.id_kecamatan')
            ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
            ->where('anak.usia', '<', 19)
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

        // foreach ($data['models'] as $anak) {
        //     $anak->umur = Carbon::parse($anak->tanggal_lahir)->age;
        // }

        $anakPerKecamatan = Anak::select('id_kecamatan', DB::raw('count(*) as total_anak'))
    ->where('id_kecamatan', $id_kecamatan) // Menyaring berdasarkan id_kecamatan yang dipilih
    ->groupBy('id_kecamatan')
    ->get();

    $data['anakPerKecamatan'] = $anakPerKecamatan;
        return view('superadmin.' . $this->viewIndex, $data);
        // ->with('anakPerKecamatan', $anakPerKecamatan);;
    }
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Tambah Data',
            'survior' => Survior::pluck('nama_lengkap', 'id_survior'),
            'pekerjaan' => Pekerjaan::pluck('pekerjaan', 'id_pekerjaan'),
            'kecamatan' => Kecamatan::pluck('nama_kecamatan', 'id_kecamatan'),
            'pendidikan' => Pendidikan::pluck('pendidikan', 'id_pendidikan'),
            'kelas_pendidikan' => KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan'),
            // 'desa' => Desa::pluck('nama_desa', 'id_desa')
        ];
        return view('superadmin.' . $this->viewCreate, $data);
    }
    public function getKecamatan(Request $request){
        $surviorId = $request->input('survior');
        // Ambil id kecamatan berdasarkan pendata yang dipilih
        $kecamatanId = Survior::findOrFail($surviorId)->id_kecamatan;
        
        // Kemudian, ambil nama kecamatan berdasarkan id kecamatan
        $kecamatan = Kecamatan::findOrFail($kecamatanId)->nama_kecamatan;
        
        // Mengambil semua kecamatan untuk dropdown
        $data['kecamatan'] = Kecamatan::pluck('nama_kecamatan', 'id_kecamatan');
    
        return response()->json(['nama_kecamatan' => $kecamatan, 'data' => $data]);
    }
    
    
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required|string|max:100',
            'kk' => 'required|max:16',
            'nik' => 'required|max:16',
            'alamat' => 'required|string|max:100',
            'jk' => 'required',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required',
            'nama_wali' => 'required|string|max:100',
            'alamat_sekolah' => 'required|string|max:100',
            'status_anak' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'kelas' => 'required',
        ]);
        // menghitung usia Anak yatim
        $tgl_lahir = $request->tgl_lahir;
        $ulang_tahun = new \DateTime($tgl_lahir);
        $hari_ini = new \DateTime("today");
        $usia = $hari_ini->diff($ulang_tahun)->y;

        if ($usia > 19) {
            return redirect()
                ->route('anak_pendata.create')
                ->withInput()
                ->with([
                    'error' => 'Anda sudah dewasa. Data tidak perlu ditambahkan.'
                ]);
        }
        // akhir menghitung usia anak yatim

        $cek_nik = Model::where('nomor_nik', '=', $request->nik)->get()->first();
        // dd($request->non_formal);
        $get_survior = Survior::where('id_survior', '=', $request->survior)->get()->first();
        // dd($get_survior);

        if (!$cek_nik) {
            $anak = Model::create([
                'id_survior' => $request->survior,
                'id_pekerjaan_wali' => $request->pekerjaan,
                'id_pendidikan' => $request->pendidikan,
                'id_kecamatan' => $get_survior['id_kecamatan'],
                'id_desa' => $get_survior['id_desa'],
                'id_dusun' => 0,
                'id_kelas_pendidikan' => $request->kelas,
                'nama_anak' => $request->nama,
                'nomor_kk' => $request->kk,
                'nomor_nik' => $request->nik,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'usia' => $usia,
                'nama_wali' => $request->nama_wali,
                'alamat_sekolah' => $request->alamat_sekolah,
                'status_anak' => $request->status_anak,
                'status_verifikasi' => 0,
                'foto_anak'   => '-',
                'latitide' => 0,
                'longitude' => 0,
                'tahun' => date('Y'),
            ]);
            if ($anak) {
                return redirect()
                    ->route('anak.index')
                    ->with([
                        'success' => 'New Anak Yatim has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('anak.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('anak.create')
                ->with([
                    'error' => 'Nomor Induk Keluarga already in use, please try again'
                ]);
        }
    }
    // controller untuk peta
    public function indexJson()
    {
        $jumlahAnak = Anak::count();
        return response()->json(['jumlah_anak' => $jumlahAnak]);
    }
    public function edit($id)
    {
        $data = [
            'model' => Model::findOrFail($id),
            'survior' => Survior::pluck('nama_lengkap', 'id_survior'),
            'pekerjaan' => Pekerjaan::pluck('pekerjaan', 'id_pekerjaan'),
            // 'kecamatan' => Kecamatan::pluck('nama_kecamatan', 'id_kecamatan'),
            'pendidikan' => Pendidikan::pluck('pendidikan', 'id_pendidikan'),
            'kelas_pendidikan' => KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan'),
            // 'desa' => Desa::pluck('nama_desa', 'id_desa')
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Ubah Data'
        ];

        return view('superadmin.' . $this->viewEdit, $data);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'     => 'required|string|max:100',
            'kk' => 'required|max:16',
            'nik' => 'required|max:16',
            'alamat' => 'required|string|max:100',
            'jk' => 'required',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required',
            'nama_wali' => 'required|string|max:100',
            'alamat_sekolah' => 'required|string|max:100',
            'status_anak' => 'required',
            'pekerjaan' => 'required',
            'pendidikan' => 'required',
            'kelas' => 'required',
        ]);
        // menghitung usia Anak yatim
        $tgl_lahir = $request->tgl_lahir;
        $ulang_tahun = new \DateTime($tgl_lahir);
        $hari_ini = new \DateTime("today");
        $usia = $hari_ini->diff($ulang_tahun)->y;

        if ($usia > 19) {
            return redirect()
                ->route('anak_pendata.create')
                ->withInput()
                ->with([
                    'error' => 'Anda sudah dewasa. Data tidak perlu ditambahkan.'
                ]);
        }
        // akhir menghitung usia anak yatim

        $cek_nik = Model::where('nomor_nik', '=', $request->nik)->where('id_anak', '!=', $id)->get()->first();
        // dd($request->non_formal);

        $anak = Model::findOrFail($id);
        if (!$cek_nik) {
            $anak->update([

                'id_pekerjaan_wali' => $request->pekerjaan,
                'id_pendidikan' => $request->pendidikan,
                'id_kelas_pendidikan' => $request->kelas,
                'nama_anak' => $request->nama,
                'nomor_kk' => $request->kk,
                'nomor_nik' => $request->nik,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'usia' => $usia,
                'nama_wali' => $request->nama_wali,
                'alamat_sekolah' => $request->alamat_sekolah,
                'status_anak' => $request->status_anak,
            ]);

            if ($anak) {
                return redirect()
                    ->route('anak.index')
                    ->with([
                        'success' => 'Data Anak has been updated successfully'
                    ]);
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'error' => 'Some problem has occured, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('anak.index')
                ->with([
                    'error' => 'Nomor Induk Keluarga already in use, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $model = Model::findOrFail($id);
        $model->delete();
        if ($model) {
            return redirect()
                ->route('anak.index')
                ->with([
                    'success' => 'Anak has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('anak.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
    public function all_anak()
    {
        // ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
        $data = array(
            'anak' => Model::all(),
            'kecamatan' => Kecamatan::all(),
            'desa' => Desa::all()
        );
        // $data = 
        echo json_encode($data);
    }
    public function anakex(Request $request)
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

        $query = Model::with('pendidikan', 'kelas_pendidikan', 'kecamatan', 'desa');

        if ($data['id_survior'])
            $query->where('anak.id_survior', $data['id_survior'])->get();
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan'])->get();
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan'])->get();
        if ($data['id_kecamatan'])
            $query->where('anak.id_kecamatan', $data['id_kecamatan'])->get();
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa'])->get();

        $data['models'] = $query->latest()->get();

        return view('survior.anak.export', $data);
    }
}
