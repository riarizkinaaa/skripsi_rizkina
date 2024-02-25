<?php

namespace App\Http\Controllers\Verifikator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verifikator as Model;
use App\Models\Userlog;
use Illuminate\Support\Facades\Hash;

class VerifikatorController extends Controller
{
    //
    public function index()
    {
        return view('verifikator.dashboard');
    }
    public function create()
    {
        return view('verifikator.data_verifikator.formadd');
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
            'file_sk' => 'required|mimes:pdf',
        ]);

        // Mengecek Email
        $email = $request->email;
        $cek_email = Model::where('email', '=', $email)->get()->first();
        // dd($cek_email);
        if ($cek_email) {
            return redirect()
                ->route('verifikator.data_verifikator.create')
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
                'aktif'    => 1,
            ]);
            if (!$userlog) {
                return redirect()
                    ->route('verifikator.data_verifikator.create')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('verifikator.data_verifikator.create')
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
        $nama_file = Hash::make($file->getClientOriginalName());
        // upload file Ke dalam folder
        $file->move($tujuan_upload, $nama_file);
        // Akhir Upload Fiel


        // menginput data Ke Tabel Verifikator
        $verifikator = Model::create([
            'id_userlog' => $request->id_userlog,
            'nama_lengkap' => $request->nama,
            'nomor_sk' => $request->no_sk,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'file_sk' => $nama_file
        ]);
        if ($verifikator) {
            return redirect()
                ->route('index')
                ->with([
                    'success' => 'New Verifikator has been created successfully, Please Login Again!'
                ]);
        } else {
            return redirect()
                ->route('index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
        // Akhir menginput data Ke Tabel verifikator

    }
}
