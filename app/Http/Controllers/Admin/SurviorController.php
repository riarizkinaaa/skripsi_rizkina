<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survior as Model;

class SurviorController extends Controller
{
    private $routePrefix = 'survior';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Pendata',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_survior'  => $request->query('id_survior'),
        ];
        $query = Model::join('users', 'users.id', '=', 'survior.id_userlog')->where(function ($query) use ($data) {
            $query->where('nama_lengkap', 'like', '%' . $data['q'] . '%');
        });

        $data['models'] = $query->paginate(10)->appends($_GET);
        // dd($data['models']);

        return view('superadmin.survior.index', $data);
    }
    public function show($id)
    {
        $data = Model::join('kecamatan', 'kecamatan.id_kecamatan', '=', 'survior.id_kecamatan')
            ->join('desa', 'desa.id_desa', '=', 'survior.id_desa')
            ->where('survior.id_survior', '=', $id)
            ->get()->first();
        return view('superadmin.survior.detail', compact('data'));
    }
    public function destroy($id)
    {
        $survior = Model::findOrFail($id);
        $survior->delete();

        if ($survior) {
            return redirect()
                ->route('survior.index')
                ->with([
                    'success' => 'Survior has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('survior.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
