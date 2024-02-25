<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pekerjaan as Model;

class PekerjaanController extends Controller
{
    private $routePrefix = 'pekerjaan';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Pekerjaan',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_pekerjaan'  => $request->query('id_pekerjaan'),
        ];
        $query = Model::where(function ($query) use ($data) {
            $query->where('pekerjaan', 'like', '%' . $data['q'] . '%');
        });

        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.pekerjaan.index', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'pekerjaan' => 'required|string|max:100',
        ]);
        $cek_pekerjaan = Model::where('pekerjaan', '=', $request->pekerjaan)->get()->first();
        if (!$cek_pekerjaan) {
            $pekerjaan = Model::create([
                'pekerjaan' => $request->pekerjaan,
            ]);
            if ($pekerjaan) {
                return redirect()
                    ->route('pekerjaan.index')
                    ->with([
                        'success' => 'New pekerjaan has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('pekerjaan.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('pekerjaan.index')
                ->withInput()
                ->with([
                    'error' => 'Pekerjaan already exists, please try again'
                ]);
        }
    }
    public function edit($id)
    {
        $pekerjaan = Model::findOrFail($id);
        echo json_encode($pekerjaan);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pekerjaan_ubah' => 'required|string|max:100',
        ]);
        $cek_pekerjaan = Model::where('pekerjaan', '=', $request->pekerjaan_ubah)->where('id_pekerjaan', '!=', $id)->get()->first();
        if (!$cek_pekerjaan) {
            $kelas = Model::findOrFail($id);
            $kelas->update([
                'pekerjaan' => $request->pekerjaan_ubah,
            ]);
            if ($kelas) {
                return redirect()
                    ->route('pekerjaan.index')
                    ->with([
                        'success' => 'New pekerjaan has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('pekerjaan.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('pekerjaan.index')
                ->withInput()
                ->with([
                    'error' => 'Pekerjaan already exists, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $post = Model::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('pekerjaan.index')
                ->with([
                    'success' => 'Pekerjaan has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('pekerjaan.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
