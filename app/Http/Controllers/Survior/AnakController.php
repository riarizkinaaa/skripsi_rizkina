<?php

namespace App\Http\Controllers\Survior;
use App\Jobs\UpdateUserAge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak as Model;
use App\Models\Anak;
use App\Models\Desa;
use App\Models\Survior;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\PrestasiFormal;
use App\Models\PrestasiNonFormal;
use App\Models\KelasPendidikan;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use  Carbon\Carbon;

class AnakController extends Controller
{
    private $viewIndex = 'anak.index';
    private $viewCreate = 'anak.formadd';
    private $viewEdit = 'anak.formedit';
    private $routePrefix = 'anak_pendata';
    public function index(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');
        $data['id_kecamatan'] = $request->query('id_kecamatan');
        $data['id_desa'] = $request->query('id_desa');
       
        // $data['id_dusun'] = $request->query('id_dusun');
        $data['title'] = 'Data Anak';
        $data['routePrefix'] = $this->routePrefix;
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $data['desa'] = Desa::pluck('nama_desa', 'id_desa');

        // menghitung jumlah data anak
       
        // akhir
        $query = Model::join('survior', 'survior.id_survior', '=', 'anak.id_survior')
        ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'anak.id_pendidikan')
        ->join('kelas_pendidikan', 'kelas_pendidikan.id_kelas_pendidikan', '=', 'anak.id_kelas_pendidikan')
        ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'anak.id_kecamatan')
        ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
        ->where('anak.id_survior', $request->session()->get('id_survior'))
        ->where('anak.usia', '<', 20)
        ->where(function ($query) use ($data) {
            $query->where('nomor_nik', 'like', '%' . $data['q'] . '%');
            // $data = Anak::where('usia', '<', 19)->get();
        });

        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        if ($data['id_desa'])
            $query->where('anak.id_desa', $data['id_desa']);

        $data['models'] = $query->paginate(10)->appends($_GET);

        // menghitung jumlah anak per desa
        $jumlah_anak_per_desa = Model::select('id_desa', DB::raw('count(*) as total_anak'))
        ->groupBy('id_desa')
        ->get();
        $jumlah_anak_desa = [];
        foreach ($jumlah_anak_per_desa as $item) {
            $desa = Desa::find($item->id_desa);
            $jumlah_anak_desa[$desa->nama_desa] = $item->total_anak;
        }

    $data['jumlah_anak_per_desa'] = $jumlah_anak_desa;

    foreach ($data['models'] as $anak) {
    $tanggal_lahir = Carbon::parse($anak->tgl_lahir);
    $diff = $tanggal_lahir->diff(Carbon::now());
    $usia = $diff->format('%y th, %m bln, %d h');
    
    $anak->usia = $usia;
}

        // foreach ($data['models'] as $anak) {
        //     $anak->umur = Carbon::parse($anak->tanggal_lahir)->age;
        // }

        // dd($data['models']);
        return view ('survior.' . $this->viewIndex, $data);
    }
    
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'Tambah Data',
            'pekerjaan' => Pekerjaan::pluck('pekerjaan', 'id_pekerjaan'),
            // 'kecamatan' => Kecamatan::pluck('nama_kecamatan', 'id_kecamatan'),
            'pendidikan' => Pendidikan::pluck('pendidikan', 'id_pendidikan'),
            'kelas_pendidikan' => KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan'),
            // 'desa' => Desa::pluck('nama_desa', 'id_desa')
        ];
        return view('survior.' . $this->viewCreate, $data);
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
        try{
            $tgl_lahir = $request->tgl_lahir;
            $ulang_tahun = new \DateTime($tgl_lahir);
            $hari_ini = new \DateTime("today");
            $usia = $hari_ini->diff($ulang_tahun)->y;
    
            if ($usia > 20) {
                return redirect()
                    ->route('anak_pendata.create')
                    ->withInput()
                    ->with([
                        'error' => 'Anda sudah dewasa. Data tidak perlu ditambahkan.'
                    ]);
            }
           
        }catch(\Exception $e){
            dd($e);
        }
        // akhir menghitung usia anak yatim

        $cek_nik = Model::where('nomor_nik', '=', $request->nik)->get()->first();
        // dd($request->non_formal);


        if (!$cek_nik) {
            $anak = Model::create([
                'id_survior' => $request->session()->get('id_survior'),
                'id_pekerjaan_wali' => $request->pekerjaan,
                'id_pendidikan' => $request->pendidikan,
                'id_kecamatan' => $request->session()->get('id_kecamatan'),
                'id_desa' => $request->session()->get('id_desa'),
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
                    ->route('anak_pendata.index')
                    ->with([
                        'success' => 'New Anak Yatim has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('anak_pendata.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('anak_pendata.create')
                ->with([
                    'error' => 'Nomor Induk Keluarga already in use, please try again'
                ]);
        }
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

        return view('survior.' . $this->viewEdit, $data);
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
        try{
        $tgl_lahir = $request->tgl_lahir;
        $ulang_tahun = new \DateTime($tgl_lahir);
        $hari_ini = new \DateTime("today");
        $usia = $hari_ini->diff($ulang_tahun)->y;

        if ($usia > 20) {
            return redirect()
                ->route('anak_pendata.create')
                ->withInput()
                ->with([
                    'error' => 'Anda sudah dewasa. Data tidak perlu ditambahkan.'
                ]);
        }
       
    }catch(\Exception $e){
        dd($e);
    }
        // akhir menghitung usia anak yatim


        // $cek_nik = Model::where('nomor_nik', '=', $request->nik)->where('id_anak', '!=', $id)->get()->first();
        // // dd($request->non_formal);

        $anak = Model::findOrFail($id);
        // if (!$cek_nik) {
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
                ->route('anak_pendata.index')
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
        // } else {
        //     if ($cek_nik) {
        //         # code...
        //     }
        //     return redirect()
        //         ->route('anak_pendata.index')
        //         ->with([
        //             'error' => 'Nomor Induk Keluarga already in use, please try again'
        //         ]);
        // }
    }
    public function destroy($id)
    {
        $model = Model::findOrFail($id);
        $model->delete();
        if ($model) {
            return redirect()
                ->route('anak_pendata.index')
                ->with([
                    'success' => 'Anak has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('anak_pendata.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
    public function detail($id)
    {
        $anak = Model::join('pekerjaan', 'pekerjaan.id_pekerjaan', '=', 'anak.id_pekerjaan_wali')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'anak.id_pendidikan')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'anak.id_kecamatan')
            ->join('desa', 'desa.id_desa', '=', 'anak.id_desa')
            ->join('kelas_pendidikan', 'kelas_pendidikan.id_kelas_pendidikan', '=', 'anak.id_kelas_pendidikan')
            ->where('anak.id_anak', '=', $id)
            ->get()->first();
        // dd($anak);
        $formal = PrestasiFormal::where('id_anak', '=', $id)->get();
        $nonformal = PrestasiNonFormal::where('id_anak', '=', $id)->get();
        return view('survior.anak.detail', compact('anak', 'formal', 'nonformal'));
    }
    public function view_import()
    {
        return view('survior.anak.import');
    }
    public function import_anak(Request $request)
    {
        // echo "oke";
        $this->validate($request, [
            'file_anak' => 'required|file|mimes:xlsx'
        ]);
        $the_file = $request->file('file_anak');
        $user = Auth::user();
        // dd($user);
        $survior = Survior::where('id_userlog', '=', $user->id)->get()->first();
        // dd($survior);
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('Y', $column_limit);
            $startcount = 2;
            $data = array();
            // dd($row_range);
            foreach ($row_range as $row) {
                $nama_anak = $sheet->getCell('B' . $row)->getValue();
                $nik =  $sheet->getCell('D' . $row)->getValue();
                $nokk = $sheet->getCell('C' . $row)->getValue();

                // dd(preg_replace("/[^a-zA-Z0-9]/", "", $nokk));


                if ($nama_anak && $nik && $nokk) {

                    // mengecek alamat
                    $alamat_anak = $sheet->getCell('E' . $row)->getValue();
                    if ($alamat_anak) {
                        $alamat = $alamat_anak;
                    } else {
                        $alamat = '-';
                    }
                    // mengecek Jenis Kelamin
                    $jenis_k = $sheet->getCell('F' . $row)->getValue();
                    if ($jenis_k != '') {
                        $jkel = $jenis_k;
                    } else {
                        $jkel = 1;
                    }

                    // echo $jkel;
                    // die;
                    // mengecek tempat lAHIR
                    $tempatl_anak = $sheet->getCell('G' . $row)->getValue();
                    if ($tempatl_anak) {
                        $tempatl = $tempatl_anak;
                    } else {
                        $tempatl = '-';
                    }
                    // mengecek Tgl Lahir
                    $str = $sheet->getCell('H' . $row)->getValue();
                    // $tgl_lahir = date("Y-m-d", ($str - 25569) * 86400);
                    // echo ($tgl_lahir);
                    // die;
                    if ($str) {
                        // Konversi Date Execel Ke Php
                        $tgl_lahir = date("Y-m-d", ($str - 25569) * 86400);
                        if ($tgl_lahir == FALSE) {
                            echo "Salah";
                            die;
                        }
                        // akhir konversi
                    } else {
                        $tgl_lahir = date("Y-m-d");
                    }
                    // mengecek Pendidikan
                    $pendidikan_anak = $sheet->getCell('I' . $row)->getValue();
                    if ($pendidikan_anak) {
                        $pendidikan = $pendidikan_anak;
                    } else {
                        $pendidikan = 2;
                    }
                    // mengecek Kelas Pendidikan
                    $kelas_pendidikan_anak = $sheet->getCell('J' . $row)->getValue();
                    if ($kelas_pendidikan_anak) {
                        $kelas_pendidikan = $kelas_pendidikan_anak;
                    } else {
                        $kelas_pendidikan = 2;
                    }
                    // mengecek alamat Sekolah
                    $alamat_sekolah_anak = $sheet->getCell('K' . $row)->getValue();
                    if ($alamat_sekolah_anak) {
                        $alamat_sekolah = $alamat_sekolah_anak;
                    } else {
                        $alamat_sekolah = '-';
                    }
                    // mengecek Status Anak
                    $status_anak = $sheet->getCell('L' . $row)->getValue();
                    if ($status_anak) {
                        $status_anak_val = $status_anak;
                    } else {
                        $status_anak_val = '-';
                    }
                    // mengecek  Nama Wali
                    $nama_wali = $sheet->getCell('M' . $row)->getValue();
                    if ($nama_wali) {
                        $wali = $nama_wali;
                    } else {
                        $wali = '-';
                    }
                    // mengecek Pekerjaan Wali
                    $pekerjaan_wali = $sheet->getCell('N' . $row)->getValue();
                    if ($pekerjaan_wali) {
                        $pekerjaan = $pekerjaan_wali;
                    } else {
                        $pekerjaan = 7;
                    }
                    // menghitung usia Anak yatim
                    try{
                        $tgl_lahir = $request->tgl_lahir;
                        $ulang_tahun = new \DateTime($tgl_lahir);
                        $hari_ini = new \DateTime("today");
                        $usia = $hari_ini->diff($ulang_tahun)->y;
                
                        if ($usia > 20) {
                            return redirect()
                                ->route('anak_pendata.create')
                                ->withInput()
                                ->with([
                                    'error' => 'Anda sudah dewasa. Data tidak perlu ditambahkan.'
                                ]);
                        }
                       
                    }catch(\Exception $e){
                        dd($e);
                    }
                    // akhir menghitung usia anak yatim

                    $data[] = [
                        'id_survior' => $survior->id_survior,
                        'id_pekerjaan_wali' => $pekerjaan,
                        'id_pendidikan'  => $pendidikan,
                        'id_kecamatan' => $survior->id_kecamatan,
                        'id_desa'  => $survior->id_desa,
                        'id_dusun' => 0,
                        'id_kelas_pendidikan' =>  $kelas_pendidikan,
                        'nama_anak' => $nama_anak,
                        'nomor_kk'  => preg_replace("/[^a-zA-Z0-9]/", "", $nokk),
                        'nomor_nik' => preg_replace("/[^a-zA-Z0-9]/", "", $nik),
                        'alamat'  => $alamat,
                        'jenis_kelamin' => $jkel,
                        'tempat_lahir'  => $tempatl,
                        'tgl_lahir'  => $tgl_lahir,
                        'usia'   => $usia,
                        'nama_wali'  => $wali,
                        'alamat_sekolah'   => $alamat_sekolah,
                        'status_anak'  => $status_anak_val,
                        'foto_anak'   => '-',
                        'status_verifikasi'  => 0,
                        'latitide'   => 0,
                        'longitude'  => 0,
                        'tahun'  => date('Y'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),

                    ];
                    $startcount++;
                }
                // var_dump($data);
            }
            // die;
            // dd($data);
            $create = DB::table('anak')->insert($data);
            if ($create) {
                return redirect()
                    ->route('anak_pendata.index')
                    ->with([
                        'success' => 'All New Anak Yatim has been impported successfully'
                    ]);
            } else {
                return redirect()
                    ->route('anak_pendata.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } catch (Exception $e) {

            return redirect()
                ->route('anak_pendata.index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function export_anak(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['id_pendidikan'] = $request->query('id_pendidikan');
        $data['id_kelas_pendidikan'] = $request->query('id_kelas_pendidikan');

        $data['title'] = 'Data Anak';
        $data['routePrefix'] = $this->routePrefix;
        $data['pendidikan'] = Pendidikan::pluck('pendidikan', 'id_pendidikan');
        $data['kelas_pendidikan'] = KelasPendidikan::pluck('kelas_pendidikan', 'id_kelas_pendidikan');
        $query = Model::with('pendidikan', 'kelas_pendidikan', 'kecamatan', 'desa')
            ->where('anak.id_survior', $request->session()->get('id_survior'));
        if ($data['id_pendidikan'])
            $query->where('anak.id_pendidikan', $data['id_pendidikan']);
        if ($data['id_kelas_pendidikan'])
            $query->where('anak.id_kelas_pendidikan', $data['id_kelas_pendidikan']);
        $data['models'] = $query->latest()->get();
        // dd($data['models']);

        return view('survior.anak.export', $data);
    }
    public function upload_gambar(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required|file|max:1024'
        ]);

        // Awal upload file
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/foto_anak/';
        $nama_file = time() . '.' . $file->extension();

        // upload file Ke dalam folder
        $file->move($tujuan_upload, $nama_file);
        // Akhir Upload Fiel


        $id = $request->id;
        $gambar =  $nama_file;
        $desa = Model::findOrFail($id);
        $desa->update([
            'foto_anak' => $gambar,
        ]);
        if ($desa) {
            return redirect()
                ->route('detail', $request->id)
                ->with([
                    'success' => 'Picture has been upload successfully'
                ]);
        } else {
            return redirect()
                ->route('detail', $request->id)
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function getDownload()
    {
        $path = public_path('assets/download/Format_Import_data.xlsx');
        $fileName = 'Format_Import_data.xlsx';

        return Response::download($path, $fileName, ['Content-Type: application/xlsx']);
    }
}
