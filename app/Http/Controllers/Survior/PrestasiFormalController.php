<?php

namespace App\Http\Controllers\Survior;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrestasiFormal as Model;

class PrestasiFormalController extends Controller
{
    public function index()
    {
        $formal = Model::latest()->get();
        return view('superadmin.prestasi_formal.index', compact('formal'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:100',
            'tahun' => 'required',
        ]);

        $pendidikan = Model::create([
            'id_anak' => $request->id_anak,
            'prestasi_formal' => $request->nama,
            'tahun' => $request->tahun,
            'bukti' => '-',
        ]);
        if ($pendidikan) {
            return redirect()
                ->route('detail', $request->id_anak)
                ->with([
                    'success' => 'New Prestasi Formal has been created successfully'
                ]);
        } else {
            return redirect()
                ->route('detail', $request->id_anak)
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function edit($id)
    {
        $role = Model::findOrFail($id);
        echo json_encode($role);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_ubah' => 'required|string|max:100',
            'tahun_ubah' => 'required',
        ]);

        $prestasi = Model::findOrFail($id);
        $prestasi->update([
            'id_anak' => $request->id_anak_ubah,
            'prestasi_formal' => $request->nama_ubah,
            'tahun' => $request->tahun_ubah,
        ]);
        if ($prestasi) {
            return redirect()
                ->route('detail', $request->id_anak_ubah)
                ->with([
                    'success' => 'New Prestasi Formal has been update successfully'
                ]);
        } else {
            return redirect()
                ->route('detail', $request->id_anak_ubah)
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $prestasi = Model::findOrFail($id);

        // dd($prestasi);
        $prestasi->delete();

        if ($prestasi) {
            return redirect()
                ->route('detail', $prestasi->id_anak)
                ->with([
                    'success' => 'Prestasi Formal has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('detail', $prestasi->id_anak)
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
