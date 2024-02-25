<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Desa as Model;
use App\Models\Kecamatan;

class DesaController extends Controller
{
    private $routePrefix = 'desa';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Desa',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_kecamatan'  => $request->query('id_kecamatan'),
            'kecamatan'     => Kecamatan::pluck('nama_kecamatan', 'id_kecamatan'),
        ];
    
        // Menghitung jumlah seluruh desa
        $totalDesa = Model::count();
    
        $query = Model::join('kecamatan', 'kecamatan.id_kecamatan', '=', 'desa.id_kecamatan')->where(function ($query) use ($data) {
            $query->where('nama_desa', 'like', '%' . $data['q'] . '%');
        });
        if ($data['id_kecamatan'])
            $query->where('desa.id_kecamatan', $data['id_kecamatan']);
        $data['models'] = $query->paginate(10)->appends($_GET);
    
        // Menambahkan jumlah seluruh desa ke dalam array data
        $data['totalDesa'] = $totalDesa;
    
        return view('superadmin.desa.index', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'desa' => 'required|string|max:100',
            'kec' => 'required',
        ]);
        $cek_desa = Model::where('nama_desa', '=', $request->desa)->where('id_kecamatan', '=', $request->kec)->get()->first();
        // dd($request->desa);
        if (!$cek_desa) {
            $desa = Model::create([
                'id_kecamatan' => $request->kec,
                'nama_desa' => $request->desa,
            ]);
            if ($desa) {
                return redirect()
                    ->route('desa.index')
                    ->with([
                        'success' => 'New Desa has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('desa.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('desa.index')
                ->withInput()
                ->with([
                    'error' => 'Desa already exists, please try again'
                ]);
        }
    }
    public function edit($id)
    {
        $desa = Model::findOrFail($id);
        echo json_encode($desa);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'desa_ubah' => 'required|string|max:100',
            'kecamatan_ubah' => 'required',
        ]);
        $cek_desa = Model::where('nama_desa', '=', $request->desa_ubah)->where('id_kecamatan', '!=', $request->kecamatan_ubah)->get()->first();
        if (!$cek_desa) {
            $desa = Model::findOrFail($id);
            $desa->update([
                'id_kecamatan' => $request->kecamatan_ubah,
                'nama_desa' => $request->desa_ubah,
            ]);
            if ($desa) {
                return redirect()
                    ->route('desa.index')
                    ->with([
                        'success' => 'Desa has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('desa.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('desa.index')
                ->withInput()
                ->with([
                    'error' => 'Desa already exists, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $desa = Model::findOrFail($id);
        $desa->delete();

        if ($desa) {
            return redirect()
                ->route('desa.index')
                ->with([
                    'success' => 'Desa has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('desa.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
