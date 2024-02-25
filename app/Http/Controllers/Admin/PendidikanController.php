<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidikan as Model;

class PendidikanController extends Controller
{
    private $routePrefix = 'pendidikan';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Pendidikan',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_pendidikan'  => $request->query('id_pendidikan'),
        ];
        $query = Model::where(function ($query) use ($data) {
            $query->where('pendidikan', 'like', '%' . $data['q'] . '%');
        });

        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.pendidikan.index', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'pendidikan' => 'required|string|max:100',
        ]);
        $cek_pendidikan = Model::where('pendidikan', '=', $request->pendidikan)->get()->first();
        if (!$cek_pendidikan) {
            $pendidikan = Model::create([
                'pendidikan' => $request->pendidikan,
            ]);
            if ($pendidikan) {
                return redirect()
                    ->route('pendidikan.index')
                    ->with([
                        'success' => 'New Pendidikan has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('pendidikan.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('pendidikan.index')
                ->withInput()
                ->with([
                    'error' => 'Pendidikan already exists, please try again'
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
            'pendidikan_ubah' => 'required|string|max:100',
        ]);
        $cek_pendidikan = Model::where('pendidikan', '=', $request->pendidikan_ubah)->where('id_pendidikan', '!=', $id)->get()->first();
        if (!$cek_pendidikan) {
            $kelas = Model::findOrFail($id);
            $kelas->update([
                'pendidikan' => $request->pendidikan_ubah,
            ]);
            if ($kelas) {
                return redirect()
                    ->route('pendidikan.index')
                    ->with([
                        'success' => 'New pendidikan has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('pendidikan.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('pendidikan.index')
                ->withInput()
                ->with([
                    'error' => 'Pendidikan already exists, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $post = Model::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('pendidikan.index')
                ->with([
                    'success' => 'Pendidikan has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('pendidikan.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
