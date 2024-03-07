<?php

namespace App\Http\Controllers\Survior;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survior as Model;
use App\Models\Userlog;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SurviorController extends Controller
{
    //
    private $viewCreate = 'data_survior.formadd';
    private $routePrefix = 'data_survior';
    public function index(Request $request)
    {

        $data = [
            'data' => Model::where('id_userlog', '=', Auth::user()->id)->get()->first(),
            // untuk ubah password
            'route' => $this->routePrefix  . "/" . Auth::user()->id,
        ];
        // dd($data);
        return view('survior.' . $this->routePrefix . '.profile', $data);
    }
    public function dashboard()
    {
        return view('survior.dashboard');
    }
    public function create()
    {
        $kecamatan = Kecamatan::latest()->get();
        return view('survior.' . $this->viewCreate, compact('kecamatan'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:100',
            'nama'     => 'required|string|max:100',
            'no_sk' => 'required|max:15',
            'nik' => 'required|max:16',
            'no_hp' => 'required|max:12',
            'alamat' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'kecamatan' => 'required',
            'desa' => 'required',
            'file_sk' => 'required|mimes:pdf',
        ]);

        // Mengecek Email
        $email = $request->email;
        // dd($email);
        $cek_email = Model::where('email', '=', $email)->get()->first();
        // dd($cek_email);
        if ($cek_email) {
            return redirect()
                ->route('survior.create')
                ->withInput()
                ->with([
                    'error' => 'Email already in use, please try again'
                ]);
        }
        // Akhir cek Email

        // update Username
        $id_userlog = $request->id_userlog;
        $cek_username = Userlog::where('username', '=', $request->username)->where('id', '!=', $id_userlog)->get()->first();
        if (!$cek_username) {
            $userlog = Userlog::findOrFail($id_userlog);
            $userlog->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'aktif' => 1,
            ]);
            if (!$userlog) {
                return redirect()
                    ->route('data_survior.create')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('data_survior.create')
                ->withInput()
                ->with([
                    'error' => 'Username already in use, please try again'
                ]);
        }
        // akhir Update Userlog

        // Awal upload file
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file_sk');
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'assets/file_sk/';
        $nama_file = time() . '.' . $file->extension();

        // upload file Ke dalam folder
        $file->move($tujuan_upload, $nama_file);
        // Akhir Upload Fiel



        // menginput data Ke Tabel Survior
        $survior = Model::create([
            'id_userlog' => $request->id_userlog,
            'id_desa' => $request->desa,
            'id_kecamatan' => $request->kecamatan,
            'nama_lengkap' => $request->nama,
            'nomor_sk' => $request->no_sk,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'file_sk' => $nama_file
        ]);
        if ($survior) {
            return redirect()
                ->route('survior.dashboard_survior')
                ->with([
                    'success' => 'New Pendata has been created successfully, Please Login Again!'
                ]);
        } else {
            return redirect()
                ->route('index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
        // Akhir menginput data Ke Tabel Survior
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:100',
        ]);

        $cek_username = Userlog::where('username', $request->username)->first();
        if (!$cek_username) {

            $userlog = Userlog::findOrFail($id);
            // dd($userlog);
            $userlog->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            if ($userlog) {
                return redirect()
                    ->route('data_survior.index')
                    ->with([
                        'success' => 'Password has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('data_survior.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('data_survior.index')
                ->withInput()
                ->with([
                    'error' => 'Username is already in use, please try again'
                ]);
        }
    }
    public function kontak()
    {
        return view('survior.data_survior.kontak');
    }
}
