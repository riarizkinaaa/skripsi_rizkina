<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;
use App\Models\Kecamatan as Model;

class KecamatanController extends Controller
{
    private $routePrefix = 'kecamatan';
    public function index(Request $request)
    {
        $kecamatan = Model::all(); // Mengambil semua data kecamatan
        $data = [
            'title'         => 'Data Kecamatan',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_kecamatan'  => $request->query('id_kecamatan'),
            'kecamatan'     => $kecamatan, // Menyertakan variabel kecamatan dalam data yang dikirimkan ke tampilan
        ];
        $query = Model::where(function ($query) use ($data) {
            $query->where('nama_kecamatan', 'like', '%' . $data['q'] . '%');
        });

        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.kecamatan.index', $data);

        $geojson1 = json_decode(file_get_contents(public_path('assets/semuafile/' . $data['models']->geojson)));
        // $geojson2 = json_decode(file_get_contents(public_path('assets/semuafile/' . $data['models']->file2)));
        return view('maps.map', $data)->with('geojson1', $geojson1);
    }
    public function store(Request $request)
    {

        try{

            
            $this->validate($request, [
                'kecamatan' => 'required|string|max:100',
                'geojson' => 'required',
                // 'file2' => 'required',
            ]);
            $file = $request->file('geohson');
            // $file2 = $request->file('file2');
            
            $tujuan_upload = 'assets/semuafile/';
            
            $nama_file1 = $file->getClientOriginalName();
            $file->move($tujuan_upload, $nama_file1);            
            // $nama_file2 = $file2->getClientOriginalName();
            // $file2->move($tujuan_upload, $nama_file2);
            
            $kecamatan = Model::create([
                'nama_kecamatan' => $request->kecamatan,
                'geojson' => $nama_file1,
                // 'file2' => $nama_file2,
            ]);
            
        }catch(\Exception $e){
            dd($e);
            // dd($request->file('file2'));
        
        }
    
        if ($kecamatan) {
            return redirect()
                ->route('kecamatan.index')
                ->with([
                    'success' => 'New kecamatan has been created successfully'
                ]);
        } else {
            return redirect()
                ->route('kecamatan.index')
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
    
    
    
    public function edit($id)
    {
        $kecamatan = Model::findOrFail($id);
        echo json_encode($kecamatan);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kecamatan_ubah' => 'required|string|max:100',
        ]);
        $cek_kecamatan = Model::where('nama_kecamatan', '=', $request->kecamatan_ubah)->where('id_kecamatan', '!=', $id)->get()->first();
        if (!$cek_kecamatan) {
            $kecamatan = Model::findOrFail($id);
            $kecamatan->update([
                'nama_kecamatan' => $request->kecamatan_ubah,
            ]);
            if ($kecamatan) {
                return redirect()
                    ->route('kecamatan.index')
                    ->with([
                        'success' => 'Kecamatan has been update successfully'
                    ]);
            } else {
                return redirect()
                    ->route('kecamatan.index')
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }
        } else {
            return redirect()
                ->route('kecamatan.index')
                ->withInput()
                ->with([
                    'error' => 'Kecamatan already exists, please try again'
                ]);
        }
    }
    public function destroy($id)
    {
        $post = Model::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('kecamatan.index')
                ->with([
                    'success' => 'Kecamatan has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('kecamatan.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
