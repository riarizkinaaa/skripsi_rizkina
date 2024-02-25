<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verifikator as Model;

class VerifikatorController extends Controller
{
    private $routePrefix = 'verifikator';
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Data Verfikator',
            'routePrefix'   => $this->routePrefix,
            'q'             => $request->query('q'),
            'id_verifikator'  => $request->query('id_verifikator'),
        ];
        $query = Model::join('users', 'users.id', '=', 'verifikator.id_userlog')->where(function ($query) use ($data) {
            $query->where('nama_lengkap', 'like', '%' . $data['q'] . '%');
        });

        $data['models'] = $query->paginate(10)->appends($_GET);
        return view('superadmin.verifikator.index', $data);
    }
    public function destroy($id)
    {
        $verifikator = Model::findOrFail($id);
        $verifikator->delete();

        if ($verifikator) {
            return redirect()
                ->route('verifikator.index')
                ->with([
                    'success' => 'Verifikator has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('verifikator.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
