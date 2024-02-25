<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelasPendidikan as Model;

class KelasPendidikanController extends Controller
{
    private $routePrefix = 'kelaspendidikan';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Kelas Pendidikan',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_kelas_pendidikan'  => $request->query('id_kelas_pendidikan'),
        ];
        $query = Model::where(function ($query) use ($data) {
            $query->where('kelas_pendidikan', 'like', '%' . $data['q'] . '%');
        });

        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.kelas_pendidikan.index', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas' => 'required|string|max:100',
        ]);
        $cek_kelas = Model::where('kelas_pendidikan', '=', $request->kelas)->get()->first();
        if (!$cek_kelas) {
            $kelas = Model::create([
                'kelas_pendidikan' => $request->kelas,
            ]);
            if ($kelas) {
                return redirect()
                    ->route('kelaspendidikan.index')
                    ->with([
                        'success' => 'New Kelas has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('kelaspendidikan.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('kelaspendidikan.index')
                ->withInput()
                ->with([
                    'error' => 'Kelas already exists, please try again'
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
            'kelas_ubah' => 'required|string|max:100',
        ]);
        $cek_kelas = Model::where('kelas_pendidikan', '=', $request->kelas_ubah)->where('id_kelas_pendidikan', '!=', $id)->get()->first();
        if (!$cek_kelas) {
            $kelas = Model::findOrFail($id);
            $kelas->update([
                'kelas_pendidikan' => $request->kelas_ubah,
            ]);
            if ($kelas) {
                return redirect()
                    ->route('kelaspendidikan.index')
                    ->with([
                        'success' => 'New kelas has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('kelaspendidikan.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('kelaspendidikan.index')
                ->withInput()
                ->with([
                    'error' => 'Kelas already exists, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $post = Model::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('kelaspendidikan.index')
                ->with([
                    'success' => 'Kelas has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('kelaspendidikan.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
