<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Koordinator as Model;
use App\Models\Kecamatan;
use App\Models\Userlog;

class KoordinatorController extends Controller
{
    //
    private $routePrefix = 'koordinator';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Koordinator',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_kecamatan'  => $request->query('id_kecamatan'),
            'id_userlog'    => $request->query('id_userlog'),
            'kecamatan'     => Kecamatan::pluck('nama_kecamatan', 'id_kecamatan'),
            'userlog'       => Userlog::latest()->get()
        ];
        $query = Model::join('kecamatan', 'kecamatan.id_kecamatan', '=', 'koordinator.id_kecamatan')->where(function ($query) use ($data) {
            $query->where('nama', 'like', '%' . $data['q'] . '%');
        });
        if ($data['id_kecamatan'])
            $query->where('koordinator.id_kecamatan', $data['id_kecamatan']);
        if ($data['id_userlog'])
            $query->where('userlog.id', $data['id_userlog']);

        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.koordinator.index', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:100',
            'kec' => 'required',
            'userlog' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no' => 'required',
            'email' => 'required',
        ]);
        $cek_koordinator = Model::where('nama', '=', $request->koordinator)->where('id_kecamatan', '=', $request->kec)->get()->first();
        // dd($request->koordinator);
        if (!$cek_koordinator) {
            $koordinator = Model::create([
                'id_kecamatan' => $request->kec,
                'id_user' => $request->userlog,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_hp' => $request->no,
                'email' => $request->email,
            ]);
            if ($koordinator) {
                return redirect()
                    ->route('koordinator.index')
                    ->with([
                        'success' => 'New Koordinator has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->route('koordinator.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('koordinator.index')
                ->withInput()
                ->with([
                    'error' => 'Koordinator already exists, please try again'
                ]);
        }
    }
    public function edit($id)
    {
        $koordinator = Model::findOrFail($id);
        echo json_encode($koordinator);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'koordinator_ubah' => 'required|string|max:100',
            'kecamatan_ubah' => 'required',
        ]);
        $cek_koordinator = Model::where('nama_koordinator', '=', $request->koordinator_ubah)->where('id_kecamatan', '!=', $request->kecamatan_ubah)->get()->first();
        if (!$cek_koordinator) {
            $koordinator = Model::findOrFail($id);
            $koordinator->update([
                'id_kecamatan' => $request->kecamatan_ubah,
                'nama' => $request->nama_ubah,
            ]);
            if ($koordinator) {
                return redirect()
                    ->route('koordinator.index')
                    ->with([
                        'success' => 'koordinator has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('koordinator.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('koordinator.index')
                ->withInput()
                ->with([
                    'error' => 'koordinator already exists, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $koordinator = Model::findOrFail($id);
        $koordinator->delete();

        if ($koordinator) {
            return redirect()
                ->route('koordinator.index')
                ->with([
                    'success' => 'koordinator has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('koordinator.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
