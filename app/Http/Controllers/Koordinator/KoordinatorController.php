<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Koordinator as Model;
use App\Models\Userlog;
use Illuminate\Support\Facades\Hash;
use App\Models\Kecamatan;

class KoordinatorController extends Controller
{
    //
    //
    public function index()
    {
        return view('koordinator.dashboard');
    }
    public function create()
    {
        $data['kecamatan'] = Kecamatan::latest()->get();
        return view('koordinator.data_koordinator.formadd', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:100',
            'nama'     => 'required|string|max:100',
            'nik' => 'required|max:16',
            'no_hp' => 'required|max:12',
            'alamat' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'kecamatan' => 'required',
        ]);
        // dd($request);

        // Mengecek Email
        $email = $request->email;
        $cek_email = Model::where('email', '=', $email)->get()->first();
        // dd($cek_email);
        if ($cek_email) {
            return redirect()
                ->route('data_koordinator.create')
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
                    ->route('data_koordinator.create')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('data_koordinator.create')
                ->withInput()
                ->with([
                    'error' => 'Username already in use, please try again'
                ]);
        }
        // akhir Update Userlog


        // menginput data Ke Tabel Koordinator
        $koordinator = Model::create([
            'id_user' => $request->id_userlog,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'id_kecamatan' => $request->kecamatan,
        ]);
        if ($koordinator) {
            return redirect()
                ->route('data_koordinator.index')
                ->with([
                    'success' => 'New Koordinator has been created successfully, Please Login Again!'
                ]);
        } else {
            return redirect()
                ->route('data_koordinator.index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
        // Akhir menginput data Ke Tabel Koordinator

    }
}