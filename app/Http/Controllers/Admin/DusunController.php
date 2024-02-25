<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dusun as Model;
use App\Models\Desa;
use App\Models\Kecamatan;

class DusunController extends Controller
{
    private $routePrefix = 'dusun';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Dusun',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_kecamatan'  => $request->query('id_kecamatan'),
            'id_desa'       => $request->query('id_desa'),
            'kecamatan'     => Kecamatan::pluck('nama_kecamatan', 'id_kecamatan'),
            'desa'          => Desa::pluck('nama_desa', 'id_desa'),
        ];
        $query = Model::join('desa', 'desa.id_desa', '=', 'dusun.id_desa')->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'dusun.id_kecamatan')->where(function ($query) use ($data) {
            $query->where('dusun', 'like', '%' . $data['q'] . '%');
        });;

        if ($data['id_kecamatan'])
            $query->where('dusun.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_desa'])
            $query->where('dusun.id_desa', $data['id_desa']);
        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.dusun.index', $data);
    }
    public function getdesa()
    {
        $id = $_GET['id'];
        $kecamatan = Desa::where('id_kecamatan', '=', $id)->get();
        echo json_encode($kecamatan);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'dusun' => 'required|string|max:100',
            'desa' => 'required',
            'kec' => 'required',
        ]);
        // dd($request->kec);
        $dusun = Model::create([
            'dusun' => $request->dusun,
            'id_desa' => $request->desa,
            'id_kecamatan' => $request->kec,
        ]);
        if ($dusun) {
            return redirect()
                ->route('dusun.index')
                ->with([
                    'success' => 'New Dusun has been created successfully'
                ]);
        } else {
            return redirect()
                ->route('dusun.index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function edit($id)
    {
        $dusun = Model::findOrFail($id);

        echo json_encode($dusun);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dusun_ubah' => 'required|string|max:100',
            'desa_ubah' => 'required',
            'kecamatan_ubah' => 'required',
        ]);
        $dusun = Model::findOrFail($id);
        $dusun->update([
            'dusun' => $request->dusun_ubah,
            'id_desa' => $request->desa_ubah,
            'id_kecamatan' => $request->kecamatan_ubah,
        ]);
        if ($dusun) {
            return redirect()
                ->route('dusun.index')
                ->with([
                    'success' => 'New dusun has been update successfully'
                ]);
        } else {
            return redirect()
                ->route('dusun.index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $dusun = Model::findOrFail($id);
        $dusun->delete();

        if ($dusun) {
            return redirect()
                ->route('dusun.index')
                ->with([
                    'success' => 'Dusun has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('dusun.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
