<?php

namespace App\Http\Controllers;

use App\Models\Anak as Model;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Koordinator;
use App\Models\Userlog;
use App\Models\Survior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        $request->session()->forget(['id_role', 'username', 'id_userlog', 'aktif', 'nama', 'id_survior', 'id_kecamatan', 'id_desa', 'role']);
        if ($user = Auth::user()) {
            if ($user->id_role == '1') {
                return redirect()->intended('superadmin/dashboard');
            } elseif ($user->id_role == '2') {
                return redirect()->intended('pimpinan/pimpinan');
            } elseif ($user->id_role == 3) {
                if ($user->aktif == 1) {
                    return redirect('/verifikator/data_verifikator');
                } elseif ($user->aktif == 0) {
                    return redirect('/verifikator/data_verifikator/create');
                } else {
                    return view('auth.login');
                }
            } elseif ($user->id_role == 4) {
                if ($user->aktif == 1) {
                    return redirect('/survior/dashboard_survior');
                } elseif ($user->aktif == 0) {
                    return redirect('/survior/data_survior/create');
                } else {
                    return view('auth.login');
                }
            } elseif ($user->id_role == 5) {
                if ($user->aktif == 1) {
                    return redirect('/koordinator/data_koordinator');
                } elseif ($user->aktif == 0) {
                    return redirect('/koordinator/data_koordinator/create');
                } else {
                    return view('auth.login');
                }
            }
        }
        return view('auth.login');
    }
    public function actionlogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->id_kecamatan) {
                $kecamatan = Kecamatan::findOrFail($user->id_kecamatan);
                Session::put('nama_kecamatan', $kecamatan->nama_kecamatan);
            }
            // dd($user);
            if ($user->id_role == 1) {
                return redirect('/superadmin/dashboard');
            } elseif ($user->id_role == 2) {
                return redirect('/pimpinan/pimpinan');
            } elseif ($user->id_role == 3) {
                if ($user->aktif == 1) {
                    return redirect('/verifikator/data_verifikator');
                } elseif ($user->aktif == 0) {
                    // echo $user->aktif;
                    // die;
                    return redirect('/verifikator/data_verifikator/create');
                } else {
                    // echo $user->aktif;
                    // die;
                    return redirect()
                        ->route('login')
                        ->withInput()
                        ->with([
                            'error' => 'Your Account is Not Aktive Permanent ! '
                        ]);
                }
            } elseif ($user->id_role == 4) {
                if ($user->aktif == 1) {
                    $data_user = Survior::where('id_userlog', '=', $user->id)->get()->first();
                    // dd($request);
                    $request->session()->put('id_survior', $data_user->id_survior);
                    $request->session()->put('id_kecamatan', $data_user->id_kecamatan);
                    $request->session()->put('id_desa', $data_user->id_desa);
                    return redirect('/survior/dashboard_survior');
                } elseif ($user->aktif == 0) {
                    return redirect('/survior/data_survior/create');
                } else {
                    return redirect()
                        ->route('login')
                        ->withInput()
                        ->with([
                            'error' => 'Your Account is Not Aktive Permanent ! '
                        ]);
                }
            } elseif ($user->id_role == 5) {
                if ($user->aktif == 1) {
                    $data_user = Koordinator::where('id_user', '=', $user->id)->get()->first();
                    // dd($data_user);
                    $request->session()->put('id_koordinator', $data_user->id_koordinator);
                    $request->session()->put('id_kecamatan', $data_user->id_kecamatan);
                    // $request->session()->put('id_desa', $data_user->id_desa);
                    return redirect('/koordinator/data_koordinator');
                } elseif ($user->aktif == 0) {
                    // echo "oke";
                    return redirect('/koordinator/data_koordinator/create');
                } else {
                    return redirect()
                        ->route('login')
                        ->withInput()
                        ->with([
                            'error' => 'Your Account is Not Aktive Permanent ! '
                        ]);
                }
            }
        } else {
            return redirect()
                ->route('login')
                ->withInput()
                ->with([
                    'error' => 'Username Atau password anda Salah ! '
                ]);
        }
    }
    public function activation($token)
    {
        $id_userlog = $token / 2524;
        $userlog = Userlog::findOrFail($id_userlog);
        $userlog->update([
            'aktif' => 1,
        ]);
        if ($userlog) {
            return redirect()
                ->route('index')
                ->with([
                    'success' => 'Your Account has been activation successfully'
                ]);
        } else {
            return redirect()
                ->route('index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function logout(Request $request)
    {
        // $request->session()->forget(['id_role', 'username', 'id_userlog', 'aktif', 'nama', 'id_survior', 'id_kecamatan', 'id_desa', 'role']);
        Auth::logout();
        return redirect()
            ->route('login')
            ->with([
                'success' => 'You Succes Logout !'
            ]);
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
}
